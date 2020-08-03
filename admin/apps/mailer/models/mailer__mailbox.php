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

// Model "admin\mailer\mailer__mailbox".
class mailer__mailbox
{

    /**
     * UUID.
     *
     * @var string.
     */
    public $uuid = null;

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Address.
     *
     * @var string.
     */
    public $address = null;

    /**
     * Host.
     *
     * @var string.
     */
    public $host = null;

    /**
     * Port.
     *
     * @var int.
     */
    public $port = null;

    /**
     * Timeout in seconds.
     *
     * @var int.
     */
    public $timeout = 30;

    /**
     * Username.
     *
     * @var string.
     */
    public $user = null;

    /**
     * Password.
     *
     * @var string.
     */
    public $pass = null;

    /**
     * If is SMTP.
     *
     * @var bool.
     */
    public $smtp = false;

    /**
     * If is SMTP authentication.
     *
     * @var bool.
     */
    public $smtpAuthentication = true;

    /**
     * SMTP secure.
     *
     * @var string.
     */
    public $smtpSecure = null;

    /**
     * Use firewall.
     *
     * @var bool.
     */
    public $firewall = true;

    /**
     * Sender name.
     *
     * @var string.
     */
    public $fromName = null;

    /**
     * Sent confirm count.
     *
     * @var int.
     */
    public $confirmCount = 0;

    /**
     * Sent error count.
     *
     * @var int.
     */
    public $errorCount = 0;

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
     * Edit.
     */
    public function edit()
    {
        // Get model "admin\mailer\mailer__mailboxes_list".
        $mailerMaileboxesList = objects::get('admin/mailer/mailer__mailboxes_list');

        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__mailer__mailer__parameters');

        // Check parameters.
        $name = trim($parameters['admin__mailer__mailer__mailbox__edit_name']);
        if ($name === '') {
            $this->render('admin__mailer__mailer__mailbox__err_no_name');
        }
        foreach ($mailerMaileboxesList->mailboxesList as $mailbox) {
            if ($mailbox->name === $name && $mailbox->uuid !== $parameters['admin__mailer__mailer__mailbox__edit_uuid']) {
                $this->render('admin__mailer__mailer__mailbox__err_name_exists');
            }
        }
        $address = trim($parameters['admin__mailer__mailer__mailbox__edit_address']);
        if (!filter_var($address)) {
            $this->render('admin__mailer__mailer__mailbox__err_mail');
        }
        $host = trim($parameters['admin__mailer__mailer__mailbox__edit_host']);
        if ($host === '') {
            $this->render('admin__mailer__mailer__mailbox__err_host');
        }
        $port = trim($parameters['admin__mailer__mailer__mailbox__edit_port']);
        $port = (int)$port;
        if (!$port) {
            $port = 25;
        }
        $user = trim($parameters['admin__mailer__mailer__mailbox__edit_user']);
        if ($user === '') {
            $this->render('admin__mailer__mailer__mailbox__err_user');
        }
        $timeout = trim($parameters['admin__mailer__mailer__mailbox__edit_timeout']);
        $timeout = (int)$timeout;
        if (!$timeout) {
            $timeout = 30;
        }
        $smtp = trim($parameters['admin__mailer__mailer__mailbox__edit_is_smtp']);
        if ($smtp === 'on') {
            $this->smtp = true;
        }
        else {
            $this->smtp = false;
        }
        $smtpAuthentication = trim($parameters['admin__mailer__mailer__mailbox__edit_smtp_auth']);
        if ($smtpAuthentication === 'on') {
            $this->smtpAuthentication = true;
        }
        else {
            $this->smtpAuthentication = false;
        }
        $smtpSecure = trim($parameters['admin__mailer__mailer__mailbox__edit_smtp_secure']);
        if ($smtpSecure !== 'tls' && $smtpSecure !== 'ssl') {
            $smtpSecure = false;
        }
        $this->smtpSecure = $smtpSecure;
        $firewall = trim($parameters['admin__mailer__mailer__mailbox__edit_firewall']);
        if ($firewall === 'on') {
            $this->firewall = true;
        }
        else {
            $this->firewall = false;
        }
        $fromName = trim($parameters['admin__mailer__mailer__mailbox__edit_from_name']);
        if ($fromName !== '') {
            $this->fromName = $fromName;
        }
        else {
            $this->fromName = null;
        }

        // Set mailboxes.
        $this->name = $name;
        $this->address = $address;
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->timeout = $timeout;
        $pass = trim($parameters['admin__mailer__mailer__mailbox__edit_pass']);
        if ($pass !== '') {
            $this->pass = $pass;
        }
        $mailerMaileboxesList->set();

        // Render.
        $this->render(null, 'admin__mailer__mailer__mailboxes__conf_edit');
    }

    /**
     * Set UUID.
     */
    public function setUuid()
    {
        $uuid = $this->generateUuid();
        $mailerMailboxesList = objects::get('admin/mailer/mailer__mailboxes_list');
        foreach ($mailerMailboxesList->mailboxesList as $mailerMailbox) {
            if ($mailerMailbox->uuid === $uuid) {
                $this->generateUuid();
                return;
            }
        }
        $this->uuid = $uuid;
    }

    /**
     * Generate UUID.
     *
     * return string.
     */
    protected function generateUuid()
    {
        return strtoupper(
            sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                mt_rand( 0, 0xffff ),
                mt_rand( 0, 0x0fff ) | 0x4000,
                mt_rand( 0, 0x3fff ) | 0x8000,
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            ));
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     * @throws exception.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');

        // Assign.
        $render->assign('admin__mailer__mailer__mailbox', $this);

        // Set messages.
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/mailer/views/mailer__mailbox.tpl');
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