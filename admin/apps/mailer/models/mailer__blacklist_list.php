<?php
/**
 * START LICENSE HEADER
 *
 * The license header may not be removed.
 *
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * @copyright       (C) xtrose Media Studio 2019
 * @author          Moses Rivera
 *                  Im Wiesengrund 24
 *                  73540 Heubach
 * @mail            media.studio@xtrose.de
 *
 * END LICENSE HEADER
 *
 * @description     Mailer logs, blacklist, settings, mailboxes.
 */

// Namespace.
namespace admin\mailer;

// Use.
use \core\objects;

// Model "admin\mailer\mailer__blacklist_list".
class mailer__blacklist_list
{

    /**
     * Blacklist list.
     *
     * @var array.
     */
    public $blacklistList = [];

    /**
     * AJAX error.
     *
     * @var string.
     */
    protected $ajaxError = null;

    /**
     * AJAX confirm.
     *
     * @var string.
     */
    protected $ajaxConfirm = null;

    /**
     * Model "admin\mailer\mailer__settings".
     *
     * @var object.
     */
    public $_mailerSettings = null;

    /**
     * Controller "core\extensions".
     *
     * @var object.
     */
    private $_extensions = null;

    /**
     * Model "core\strings".
     *
     * @var object.
     */
    private $_strings = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__mailer__mailer__blacklist_list', $this);

        // Get objects.
        $this->_extensions = objects::get('extensions');
        $this->_strings = objects::get('strings');
        $this->_mailerSettings = objects::get('admin/mailer/mailer__settings');
        $this->_mailerSettings->init();

        // Get whitelist list.
        $blacklistList = $this->_extensions->get('text', 4, 'appnetos/mailer');

        // If settings not exists.
        if (!$blacklistList) {
            $this->set();
            return;
        }

        // Get model "admin\mailer\mailer_blacklist".
        objects::get('admin/mailer/mailer__blacklist');

        // Set whitelist list.
        $array = json_decode($blacklistList);
        $isset = false;
        foreach ($array as $value) {
            if ($value->ip && !$value->static && $this->_mailerSettings->lockIpExpire !== 0) {
                $expire = time() - $value->timestamp;
                if ($expire > $this->_mailerSettings->lockIpExpire) {
                    $isset = true;
                    continue;
                }
            }
            if ($value->address && !$value->static && $this->_mailerSettings->lockEmailExpire !== 0) {
                $expire = time() - $value->timestamp;
                if ($expire > $this->_mailerSettings->lockEmailExpire) {
                    $isset = true;
                    continue;
                }
            }
            $mailerBlacklist = objects::getNew('admin/mailer/mailer__blacklist');
            $mailerBlacklist->ip = $value->ip;
            $mailerBlacklist->address = $value->address;
            $mailerBlacklist->timestamp = $value->timestamp;
            $mailerBlacklist->static = $value->static;

            array_push($this->blacklistList, $mailerBlacklist);
        }

        // Set on changes.
        if ($isset) {
            $this->set();
        }
    }

    /**
     * Set blacklist list.
     */
    protected function set()
    {
        $blacklistList = json_encode($this->blacklistList);
        $this->_extensions->set($blacklistList, 'text', 4, 'appnetos/mailer');
    }

    /**
     * Add to blacklist.
     */
    public function add()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__mailer__mailer__parameters');

        // If entry not exists.
        if (!$parameters) {
            $this->render('admin__mailer__mailer__list_add_err');
        }

        // If parameters not exists.
        if (!isset($parameters['admin__mailer__mailer__blacklist__add_email_or_ip'])) {
            $this->render('admin__mailer__mailer__list_add_err');
        }

        // Get model "admin/mailer/mailer__blacklist".
        objects::get("admin/mailer/mailer_blacklist");
        $mailerBlacklist = objects::getNew('admin/mailer/mailer__blacklist');
        $isset = false;

        // If is email address.
        $entry = trim($parameters['admin__mailer__mailer__blacklist__add_email_or_ip']);
        if(filter_var($entry, FILTER_VALIDATE_EMAIL) !== false) {
            foreach ($this->blacklistList as $blacklist) {
                if ($blacklist->address === $entry) {
                    $this->render('admin__mailer__mailer__err_exists');
                }
            }
            $mailerBlacklist->address = $entry;
            $isset = true;
        }

        // If is IP address.
        elseif(filter_var($entry, FILTER_VALIDATE_IP) !== false) {
            foreach ($this->blacklistList as $blacklist) {
                if ($blacklist->ip === $entry) {
                    $this->render('admin__mailer__mailer__err_exists');
                }
            }
            $mailerBlacklist->ip = $entry;
            $isset = true;
        }

        // If entry isset.
        if ($isset) {
            $mailerBlacklist->timestamp = time();
            if (isset($parameters['admin__mailer__mailer__blacklist__add_static'])) {
                if ($parameters['admin__mailer__mailer__blacklist__add_static'] === 'on') {
                    $mailerBlacklist->static = true;
                }
            }
            array_push($this->blacklistList, $mailerBlacklist);
            $this->set();
            $this->render(null, 'admin__mailer__mailer__list_add_conf');
        }

        // If is error.
        $this->render('admin__mailer__mailer__list_add_err');
    }

    /**
     * Remove from blacklist.
     */
    public function remove()
    {
        // Get parameters.
        $post = objects::get('post');
        $entry = trim($post->get('admin__mailer__mailer__parameters'));

        // If entry not exists.
        if ($entry === '') {
            $this->render('admin__mailer__mailer__list_remove_err');
        }

        // Go through all entries.
        for ($i = 0; $i < $this->blacklistList; $i++) {
            if ($this->blacklistList[$i]->ip === $entry || $this->blacklistList[$i]->address === $entry) {

                // Delete from logs list.
                $mailerLogsList = objects::get('admin/mailer/mailer__logs_list');
                $mailerLogsList->init();
                if ($this->blacklistList[$i]->ip === $entry) {
                    $mailerLogsList->clearIp($entry);
                }
                if ($this->blacklistList[$i]->address === $entry) {
                    $mailerLogsList->clearAddress($entry);
                }

                // Unset entry.
                unset($this->blacklistList[$i]);
                $this->set();

                // Render.
                $this->render(null, 'admin__mailer__mailer__list_remove_conf');
            }
        }

        // If is error.
        $this->render('admin__mailer__mailer__list_remove_err');
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $render = objects::get('render');

        // Assign.
        $render->assign('admin__mailer__mailer__blacklist_list', $this);

        // Set messages.
        if ($error) {
            $this->ajaxError = $this->_strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $this->_strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/mailer/views/mailer__blacklist_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Get IP expiration.
     *
     * @param int $timestamp.
     * @return string.
     */
    public function getIpExpiration($timestamp)
    {
        if (!$this->_mailerSettings->lockIpExpire) {
            return $this->_strings->get('admin__mailer__mailer__static');
        }
        $expire = time() - $timestamp;
        $rest = $this->_mailerSettings->lockIpExpire - $expire;

        return gmdate("H:i:s", $rest);
    }

    /**
     * Get email expiration.
     *
     * @param int $timestamp.
     * @return string.
     */
    public function getEmailExpiration($timestamp)
    {
        if (!$this->_mailerSettings->lockEmailExpire) {
            return $this->_strings->get('admin__mailer__mailer__static');
        }
        $expire = time() - $timestamp;
        $rest = $this->_mailerSettings->lockEmailExpire - $expire;

        return gmdate("H:i:s", $rest);
    }

    /**
     * Get AJAX error.
     *
     * @return string.
     */
    public function getAjaxError()
    {
        return $this->ajaxError;
    }

    /**
     * Get AJAX confirm.
     *
     * @return string.
     */
    public function getAjaxConfirm()
    {
        return $this->ajaxConfirm;
    }
}