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

// Model "admin\mailer\mailer__whitelist_list".
class mailer__whitelist_list
{

    /**
     * IPs.
     *
     * @var array.
     */
    public $ips = [];

    /**
     * Emails.
     *
     * @var array.
     */
    public $emails = [];

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
     * Controller "core\extensions".
     *
     * @var object.
     */
    private $_extensions = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__mailer__mailer__whitelist_list', $this);

        // Get whitelist list.
        $this->_extensions = objects::get('extensions');
        $whitelistList = $this->_extensions->get('text', 3, 'appnetos/mailer');

        // If settings not exists.
        if (!$whitelistList) {
            $this->set();
            return;
        }

        // Set whitelist list.
        $array = json_decode($whitelistList, true);
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Set whitelist list.
     */
    protected function set()
    {
        $whitelistList = json_encode($this);
        $this->_extensions->set($whitelistList, 'text', 3, 'appnetos/mailer');
    }

    /**
     * Add to whitelist.
     */
    public function add()
    {
        // Get parameters.
        $post = objects::get('post');
        $entry = trim($post->get('admin__mailer__mailer__parameters'));

        // If entry not exists.
        if ($entry === '') {
            $this->render('admin__mailer__mailer__list_add_err');
        }

        // If is email address.
        if(filter_var($entry, FILTER_VALIDATE_EMAIL) !== false) {
            if (in_array($entry, $this->emails)) {
                $this->render('admin__mailer__mailer__err_exists');
            }
            array_push($this->emails, $entry);
            $this->set();
            $this->render(null, 'admin__mailer__mailer__list_add_conf');
        }

        // If is IP address.
        elseif(filter_var($entry, FILTER_VALIDATE_IP) !== false) {
            if (in_array($entry, $this->ips)) {
                $this->render('admin__mailer__mailer__err_exists');
            }
            array_push($this->ips, $entry);
            $this->set();
            $this->render(null, 'admin__mailer__mailer__list_add_conf');
        }

        // If is error.
        $this->render('admin__mailer__mailer__list_add_err');
    }

    /**
     * Remove from whitelist.
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

        // If is Email.
        if (in_array($entry, $this->emails)) {
            $index = array_search($entry, $this->emails);
            if($index !== FALSE){
                unset($this->emails[$index]);
            }
            $this->set();
            $this->render(null, 'admin__mailer__mailer__list_remove_conf');
        }

        // If is IP.
        if (in_array($entry, $this->ips)) {
            $index = array_search($entry, $this->ips);
            if($index !== FALSE){
                unset($this->ips[$index]);
            }
            $this->set();
            $this->render(null, 'admin__mailer__mailer__list_remove_conf');
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
        $strings = objects::get('strings');
        $render = objects::get('render');

        // Assign.
        $render->assign('admin__mailer__mailer__whitelist_list', $this);

        // Set messages.
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/mailer/views/mailer__whitelist_list.tpl');
        echo $output;
        exit();
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