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

// Model "admin\mailer\mailer__settings".
class mailer__settings
{

    /**
     * Number of error logs.
     *
     * @var int.
     */
    public $errorLogs = 1000;

    /**
     * Number of confirm logs.
     *
     * @var int.
     */
    public $confirmLogs = 1000;

    /**
     * Default mailbox.
     *
     * @var string.
     */
    public $defaultMailbox = null;

    /**
     * Lock IP requests.
     *
     * @var int.
     */
    public $lockIpRequests = 3;

    /**
     * Lock IP time in seconds.
     *
     * @var int.
     */
    public $lockIpTime = 60;

    /**
     * Lock IP expire time in seconds.
     *
     * @var int.
     */
    public $lockIpExpire = 28800;

    /**
     * Lock email requests.
     *
     * @var int.
     */
    public $lockEmailRequests = 3;

    /**
     * Lock email time in seconds.
     *
     * @var int.
     */
    public $lockEmailTime = 60;

    /**
     * Lock email expire time in seconds.
     *
     * @var int.
     */
    public $lockEmailExpire = 0;

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
        $render->assign('admin__mailer__mailer__settings', $this);

        // Get settings.
        $this->_extensions = objects::get('extensions');
        $settings = $this->_extensions->get('text', 1, 'appnetos/mailer');

        // If settings not exists.
        if (!$settings) {
            $this->set();
            return;
        }

        // Set settings.
        $array = json_decode($settings, true);
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Set settings.
     */
    protected function set()
    {
        $settings = json_encode($this);
        $this->_extensions->set($settings, 'text', 1, 'appnetos/mailer');
    }

    /**
     * Update settings.
     */
    public function update()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__mailer__mailer__parameters');

        // Update settings.
        $compareLogs = [0, 100, 250, 500, 1000, 2500, 5000];
        $compareRequest = [0, 3, 5, 10, 15, 25, 50, 100];
        $compareTime = [60, 120, 300, 600, 900, 1500, 3000, 6000];
        $compareExpire = [0, 3600, 7200, 14400, 28800, 57600, 86400, 172800];
        $errorLogs = $parameters['admin__mailer__mailer__settings__error_log'];
        $errorLogs = (int)$errorLogs;
        if (!in_array($errorLogs, $compareLogs)) {
            $this->render('admin__mailer__mailer__settings__error');
        }
        $confirmLogs = $parameters['admin__mailer__mailer__settings__confirm_log'];
        $confirmLogs = (int)$confirmLogs;
        if (!in_array($confirmLogs, $compareLogs)) {
            $this->render('admin__mailer__mailer__settings__error');
        }
        $defaultMailbox = $parameters['admin__mailer__mailer__settings__default_mailbox'];
        if ($defaultMailbox === '') {
            $defaultMailbox = null;
        }
        else {
            $mailerMailboxesList = objects::get('admin/mailer/mailer__mailboxes_list');
            $isset = false;
            foreach ($mailerMailboxesList->mailboxesList as $mailerMailbox) {
                if ($mailerMailbox->uuid === $defaultMailbox) {
                    $isset = true;
                    break;
                }
            }
            if (!$isset) {
                $this->render('admin__mailer__mailer__settings__error');
            }
        }
        $lockIpRequests = $parameters['admin__mailer__mailer__settings__lock_ip_request'];
        $lockIpRequests = (int)$lockIpRequests;
        if (!in_array($lockIpRequests, $compareRequest)) {
            $this->render('admin__mailer__mailer__settings__error');
        }
        $lockIpTime = $parameters['admin__mailer__mailer__settings__lock_ip_time'];
        $lockIpTime = (int)$lockIpTime;
        if (!in_array($lockIpTime, $compareTime)) {
            $this->render('admin__mailer__mailer__settings__error');
        }
        $lockIpExpire = $parameters['admin__mailer__mailer__settings__lock_ip_expire'];
        $lockIpExpire = (int)$lockIpExpire;
        if (!in_array($lockIpExpire, $compareExpire)) {
            $this->render('admin__mailer__mailer__settings__error');
        }
        $lockEmailRequests = $parameters['admin__mailer__mailer__settings__lock_email_request'];
        $lockEmailRequests = (int)$lockEmailRequests;
        if (!in_array($lockEmailRequests, $compareRequest)) {
            $this->render('admin__mailer__mailer__settings__error');
        }
        $lockEmailTime = $parameters['admin__mailer__mailer__settings__lock_email_time'];
        $lockEmailTime = (int)$lockEmailTime;
        if (!in_array($lockEmailTime, $compareTime)) {
            $this->render('admin__mailer__mailer__settings__error');
        }
        $lockEmailExpire = $parameters['admin__mailer__mailer__settings__lock_email_expire'];
        $lockEmailExpire = (int)$lockEmailExpire;
        if (!in_array($lockEmailExpire, $compareExpire)) {
            $this->render('admin__mailer__mailer__settings__error');
        }

        // Set settings.
        $this->errorLogs = $errorLogs;
        $this->confirmLogs = $confirmLogs;
        $this->defaultMailbox = $defaultMailbox;
        $this->lockIpRequests = $lockIpRequests;
        $this->lockIpTime = $lockIpTime;
        $this->lockIpExpire = $lockIpExpire;
        $this->lockEmailRequests = $lockEmailRequests;
        $this->lockEmailTime = $lockEmailTime;
        $this->lockEmailExpire = $lockEmailExpire;
        $this->set();

        // Render.
        $this->render(null, 'admin__mailer__mailer__settings__confirm');
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
        $render->assign('admin__mailer__mailer__settings', $this);

        // Set messages.
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/mailer/views/mailer__settings.tpl');
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