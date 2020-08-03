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

// Model "admin\mailer\mailer__logs_list".
class mailer__logs_list
{

    /**
     * Error logs list.
     *
     * @var array.
     */
    public $errorsList = [];

    /**
     * Confirm logs list.
     *
     * @var array.
     */
    public $confirmsList = [];

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
     * Model "admin\mailer\mailer__mailboxes_list".
     *
     * @var object.
     */
    private $_mailerMailboxesList = null;

    /**
     * Model "core\extensions".
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
        $render->assign('admin__mailer__mailer__logs_list', $this);

        // Get logs.
        $this->_extensions = objects::get('extensions');
        $errors = $this->_extensions->get('longtext', 5, 'appnetos/mailer');
        $confirms = $this->_extensions->get('longtext', 6, 'appnetos/mailer');

        // If logs not set.
        if ($errors === null || $confirms === null) {
            $this->set();
            return;
        }

        // Error logs.
        if ($errors) {
            objects::get('admin/mailer/mailer__log_error');
            $errorsList = json_decode($errors);
            foreach ($errorsList as $logError) {
                $mailerLogError = objects::getNew('admin/mailer/mailer__log_error');
                $mailerLogError->ip = $logError->ip;
                $mailerLogError->address = $logError->address;
                $mailerLogError->mailboxUuid = $logError->mailboxUuid;
                $mailerLogError->timestamp = $logError->timestamp;
                $mailerLogError->message = $logError->message;
                $mailerLogError->phpMailerInfo = $logError->phpMailerInfo;
                array_unshift($this->errorsList, $mailerLogError);
            }
        }

        // Confirm logs.
        if ($confirms) {
            objects::get('admin/mailer/mailer__log_confirm');
            $confirmsList = json_decode($confirms);
            foreach ($confirmsList as $logConfirm) {
                $mailerLogConfirm = objects::getNew('admin/mailer/mailer__log_confirm');
                $mailerLogConfirm->ip = $logConfirm->ip;
                $mailerLogConfirm->address = $logConfirm->address;
                $mailerLogConfirm->mailboxUuid = $logConfirm->mailboxUuid;
                $mailerLogConfirm->timestamp = $logConfirm->timestamp;
                array_unshift($this->confirmsList, $mailerLogConfirm);
            }
        }

        // If logs not exists.
        if (!$errors || !$confirms) {
            $this->set();
        }
    }

    /**
     * Set logs.
     */
    protected function set()
    {
        $error = json_encode($this->errorsList);
        $this->_extensions->set($error, 'longtext', 5, 'appnetos/mailer');

        $confirm = json_encode($this->confirmsList);
        $this->_extensions->set($confirm, 'longtext', 6, 'appnetos/mailer');
    }

    /**
     * Get mailbox name.
     *
     * @param string $uuid.
     * @return string $name.
     * @throws.
     */
    public function getMailboxName($uuid)
    {
        // Get used objects.
        if (!$this->_mailerMailboxesList) {
            $this->_mailerMailboxesList = objects::get('admin/mailer/mailer__mailboxes_list', true);
            $this->_mailerMailboxesList->init();
        }
        if (!$this->_strings) {
            $this->_strings = objects::get('strings');
        }

        // Get mailbox name.
        foreach ($this->_mailerMailboxesList->mailboxesList as $mailerMailbox) {
            if ($mailerMailbox->uuid == $uuid) {
                return $mailerMailbox->name;
            }
        }

        // Return not defined.
        return $this->_strings->get('admin__mailer__mailer__mailboxes_not_defined');
    }

    /**
     * Clear entry with IP from log lists.
     *
     * @param $ip.
     */
    public function clearIp($ip)
    {
        // Clear from errors list.
        $count = count($this->errorsList) - 1;
        for ($i = $count; $i >= 0; $i--) {
            if ($this->errorsList[$i]->ip === $ip) {
                unset($this->errorsList[$i]);
            }
        }

        // Clear from confirms list.
        $count = count($this->confirmsList) - 1;
        for ($i = $count; $i >= 0; $i--) {
            if ($this->confirmsList[$i]->ip === $ip) {
                unset($this->confirmsList[$i]);
            }
        }

        // Set.
        $this->set();
    }

    /**
     * Clear entry with address from log lists.
     *
     * @param $address.
     */
    public function clearAddress($address)
    {
        // Clear from errors list.
        $count = count($this->errorsList) - 1;
        for ($i = $count; $i >= 0; $i--) {
            if ($this->errorsList[$i]->address === $address) {
                unset($this->errorsList[$i]);
            }
        }

        // Clear from confirms list.
        $count = count($this->confirmsList) - 1;
        for ($i = $count; $i >= 0; $i--) {
            if ($this->confirmsList[$i]->address === $address) {
                unset($this->confirmsList[$i]);
            }
        }

        // Set.
        $this->set();
    }

    /**
     * Clear error logs.
     */
    public function clearError()
    {
        // Clear logs.
        $this->errorsList = [];
        $this->set();

        // If is error.
        $this->render('admin__mailer__mailer__logs__conf_clear');
    }

    /**
     * Clear confirm logs.
     */
    public function clearConfirm()
    {
        // Clear logs.
        $this->confirmsList = [];
        $this->set();

        // If is error.
        $this->render('admin__mailer__mailer__logs__conf_clear');
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     * @throws.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $render = objects::get('render');
        $strings = objects::get('strings');

        // Assign.
        $render->assign('admin__mailer__mailer__logs_list', $this);

        // Set messages.
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/mailer/views/mailer__logs_list.tpl');
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