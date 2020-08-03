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
     * If already initialized.
     *
     * @var bool.
     */
    protected $_initialized = false;

    /**
     * Model "appnetos\mailer__settings".
     *
     * @var object.
     */
    protected $_mailerSettings = null;

    /**
     * Model "core\extensions".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // If already initialized.
        if ($this->_initialized) {
            return;
        }

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
        objects::get('appnetos/mailer__log_error');
        $errorsList = json_decode($errors);
        foreach ($errorsList as $logError) {
            $mailerLogError = objects::get('appnetos/mailer__log_error');
            $mailerLogError->ip = $logError->ip;
            $mailerLogError->address = $logError->address;
            $mailerLogError->mailboxUuid = $logError->mailboxUuid;
            $mailerLogError->timestamp = $logError->timestamp;
            $mailerLogError->message = $logError->message;
            $mailerLogError->phpMailerInfo = $logError->phpMailerInfo;
            array_push($this->errorsList, $mailerLogError);
        }

        // Confirm logs.
        objects::get('appnetos/mailer__log_confirm');
        $confirmsList = json_decode($confirms);
        foreach ($confirmsList as $logConfirm) {
            $mailerLogConfirm = objects::getNew('appnetos/mailer__log_confirm');
            $mailerLogConfirm->ip = $logConfirm->ip;
            $mailerLogConfirm->address = $logConfirm->address;
            $mailerLogConfirm->mailboxUuid = $logConfirm->mailboxUuid;
            $mailerLogConfirm->timestamp = $logConfirm->timestamp;
            array_push($this->confirmsList, $mailerLogConfirm);
        }

        // If already initialized.
        $this->_initialized = true;
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
     * Get number of requests with email address.
     *
     * @param string $email.
     * @return int.
     * @throws \core\exception.
     */
    public function getRequestsAddress($email)
    {
        // Get model "appnetos\mailer__settings".
        if (!$this->_mailerSettings) {
            $this->_mailerSettings = objects::get('appnetos/mailer__settings');
        }

        // Check log lists.
        $expire = time() - $this->_mailerSettings->lockEmailTime;
        $count = 0;
        foreach ($this->confirmsList as $logConfirm) {
            if ($logConfirm->address === $email) {
                if ($logConfirm->timestamp > $expire) {
                    $count++;
                }
            }
        }
        foreach ($this->errorsList as $logError) {
            if ($logError->address === $email) {
                if ($logError->timestamp > $expire) {
                    $count++;
                }
            }
        }

        // Return.
        return $count;
    }

    /**
     * Get number of requests with IP address.
     *
     * @param string $ip.
     * @return int.
     * @throws \core\exception.
     */
    public function getRequestsIp($ip)
    {
        // Get model "appnetos\mailer__settings".
        if (!$this->_mailerSettings) {
            $this->_mailerSettings = objects::get('appnetos/mailer__settings');
        }

        // Check log lists.
        $expire = time() - $this->_mailerSettings->lockIpTime;
        $count = 0;
        foreach ($this->confirmsList as $logConfirm) {
            if ($logConfirm->ip === $ip) {
                if ($logConfirm->timestamp > $expire) {
                    $count++;
                }
            }
        }
        foreach ($this->errorsList as $logError) {
            if ($logError->ip === $ip) {
                if ($logError->timestamp > $expire) {
                    $count++;
                }
            }
        }

        // Return.
        return $count;
    }

    /**
     * Add confirm log.
     *
     * @param $mailerLogConfirm object.
     */
    public function addConfirm($mailerLogConfirm)
    {
        array_push($this->confirmsList, $mailerLogConfirm);
        $confirm = json_encode($this->confirmsList);
        $this->_extensions->set($confirm, 'longtext', 6, 'appnetos/mailer');
    }

    /**
     * Add error log.
     *
     * @param $mailerLogError object.
     */
    public function addError($mailerLogError)
    {
        array_push($this->errorsList, $mailerLogError);
        $error = json_encode($this->errorsList);
        $this->_extensions->set($error, 'longtext', 5, 'appnetos/mailer');
    }
}