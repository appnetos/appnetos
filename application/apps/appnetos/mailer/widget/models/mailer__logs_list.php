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
 * @description     Allows other apps to send messages through the set-up mailmail mailboxes. Creates logs for advanced
 *                  information and a widget for the dashboard.
 */

// Namespace.
namespace appnetos;

// Use.
use \core\objects;

// Model "appnetos\mailer__logs_list".
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
     * Model "admin\mailer\mailer__mailboxes_list".
     *
     * @var object.
     */
    protected $_mailerMailboxesList = null;

    /**
     * Model "core\extensions".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * Model "core\strings".
     *
     * @var object.
     */
    protected $_strings = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('appnetos__mailer__logs_list', $this);

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
            objects::get('appnetos/mailer__log_error');
            $errorsList = json_decode($errors);
            foreach ($errorsList as $logError) {
                $mailerLogError = new mailer__log_error();
                $mailerLogError->ip = $logError->ip;
                $mailerLogError->address = $logError->address;
                $mailerLogError->mailboxUuid = $logError->mailboxUuid;
                $mailerLogError->timestamp = $logError->timestamp;
                $mailerLogError->message = $logError->message;
                $mailerLogError->phpMailerInfo = $logError->phpMailerInfo;
                array_push($this->errorsList, $mailerLogError);
            }
        }

        // Confirm logs.
        if ($confirms) {
            objects::get('appnetos/mailer__log_confirm');
            $confirmsList = json_decode($confirms);
            foreach ($confirmsList as $logConfirm) {
                $mailerLogConfirm = new mailer__log_confirm();
                $mailerLogConfirm->ip = $logConfirm->ip;
                $mailerLogConfirm->address = $logConfirm->address;
                $mailerLogConfirm->mailboxUuid = $logConfirm->mailboxUuid;
                $mailerLogConfirm->timestamp = $logConfirm->timestamp;
                array_push($this->confirmsList, $mailerLogConfirm);
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
     * @throws \core\exception.
     */
    public function getMailboxName($uuid)
    {
        // Get used objects.
        if (!$this->_mailerMailboxesList) {
            $this->_mailerMailboxesList = objects::get('appnetos/mailer__mailboxes_list', true);
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
        return $this->_strings->get('appnetos__mailer__widget_not_defined');
    }
}