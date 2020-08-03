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

// Model "admin\mailer\mailer__mailboxes_list".
class mailer__mailboxes_list
{

    /**
     * Mailboxes list.
     *
     * @var array.
     */
    public $mailboxesList = [];

    /**
     * AJAX error.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * AJAX confirm.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

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
        $render->assign('admin__mailer__mailer__mailboxes_list', $this);

        // Get mailboxes list.
        $this->_extensions = objects::get('extensions');
        $mailboxesList = $this->_extensions->get('text', 2, 'appnetos/mailer');

        // If mailboxes list not exists.
        if (!$mailboxesList) {
            $this->set();
            return;
        }

        // Set mailboxes list.
        objects::get('admin\mailer\mailer__mailbox');
        $array = json_decode($mailboxesList, true);
        foreach ($array as $mailbox) {
            $mailerMailbox = objects::getNew('admin/mailer/mailer__mailbox');
            $mailerMailbox->uuid = $mailbox['uuid'];
            $mailerMailbox->name = $mailbox['name'];
            $mailerMailbox->address = $mailbox['address'];
            $mailerMailbox->host = $mailbox['host'];
            $mailerMailbox->port = $mailbox['port'];
            $mailerMailbox->user = $mailbox['user'];
            $mailerMailbox->pass = $mailbox['pass'];
            $mailerMailbox->smtp = $mailbox['smtp'];
            $mailerMailbox->smtpAuthentication = $mailbox['smtpAuthentication'];
            $mailerMailbox->smtpSecure = $mailbox['smtpSecure'];
            $mailerMailbox->firewall = $mailbox['firewall'];
            $mailerMailbox->fromName = $mailbox['fromName'];
            $mailerMailbox->confirmCount = $mailbox['confirmCount'];
            $mailerMailbox->errorCount = $mailbox['errorCount'];

            array_push($this->mailboxesList, $mailerMailbox);
        }
    }

    /**
     * Set mailboxes.
     */
    public function set()
    {
        $mailboxesList = json_encode($this->mailboxesList);
        $this->_extensions->set($mailboxesList, 'text', 2, 'appnetos/mailer');
    }

    /**
     * Add mailbox.
     */
    public function add()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__mailer__mailer__parameters');

        // If parameters not exists.
        if (!is_array($parameters)) {
            return;
        }

        // Get model "admin\mailer\mailer__mailbox".
        objects::get('admin/mailer/mailer__mailbox');
        $mailerMailbox = objects::getNew('admin/mailer/mailer__mailbox');
        $mailerMailbox->setUuid();

        // Check parameters.
        $name = trim($parameters['admin__mailer__mailer__mailboxes__add_name']);
        if ($name === '') {
            $this->render('admin__mailer__mailer__mailboxes__err_no_name');
        }
        foreach ($this->mailboxesList as $mailbox) {
            if ($mailbox->name === $name) {
                $this->render('admin__mailer__mailer__mailboxes__err_name_exists');
            }
        }
        $mailerMailbox->name = $name;
        $address = trim($parameters['admin__mailer__mailer__mailboxes__add_address']);
        if (!filter_var($address)) {
            $this->render('admin__mailer__mailer__mailboxes__err_mail');
        }
        $mailerMailbox->address = $address;
        $host = trim($parameters['admin__mailer__mailer__mailboxes__add_host']);
        if ($host === '') {
            $this->render('admin__mailer__mailer__mailboxes__err_host');
        }
        $mailerMailbox->host = $host;
        $port = trim($parameters['admin__mailer__mailer__mailboxes__add_port']);
        $port = (int)$port;
        if (!$port) {
            $port = 25;
        }
        $mailerMailbox->port = $port;
        $user = trim($parameters['admin__mailer__mailer__mailboxes__add_user']);
        if ($user === '') {
            $this->render('admin__mailer__mailer__mailboxes__err_user');
        }
        $mailerMailbox->user = $user;
        $pass = trim($parameters['admin__mailer__mailer__mailboxes__add_pass']);
        if ($pass === '') {
            $this->render('admin__mailer__mailer__mailboxes__err_pass');
        }
        $mailerMailbox->pass = $pass;
        $timeout = trim($parameters['admin__mailer__mailer__mailboxes__add_timeout']);
        $timeout = (int)$timeout;
        if (!$timeout) {
            $timeout = 30;
        }
        $mailerMailbox->timeout = $timeout;
        $smtp = trim($parameters['admin__mailer__mailer__mailboxes__add_is_smtp']);
        if ($smtp === 'on') {
            $mailerMailbox->smtp = true;
        }
        else {
            $mailerMailbox->smtp = false;
        }
        $smtpAuthentication = trim($parameters['admin__mailer__mailer__mailboxes__add_smtp_auth']);
        if ($smtpAuthentication === 'on') {
            $mailerMailbox->smtpAuthentication = true;
        }
        else {
            $mailerMailbox->smtpAuthentication = false;
        }
        $smtpSecure = trim($parameters['admin__mailer__mailer__mailboxes__add_smtp_secure']);
        if ($smtpSecure !== 'tls' && $smtpSecure !== 'ssl') {
            $smtpSecure = false;
        }
        $mailerMailbox->smtpSecure = $smtpSecure;
        $firewall = trim($parameters['admin__mailer__mailer__mailboxes__add_firewall']);
        if ($firewall === 'on') {
            $mailerMailbox->firewall = true;
        }
        else {
            $mailerMailbox->firewall = false;
        }
        $fromName = trim($parameters['admin__mailer__mailer__mailboxes__add_from_name']);
        if ($fromName !== '') {
            $mailerMailbox->fromName = $fromName;
        }

        // Set mailboxes.
        array_push($this->mailboxesList, $mailerMailbox);
        $this->set();

        // Render.
        $this->render(null, 'admin__mailer__mailer__mailboxes__conf_add');
    }

    /**
     * Delete mailbox.
     */
    public function delete()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__mailer__mailer__parameters');

        // If parameters not exists.
        if (!$parameters) {
            return;
        }

        // Delete mailbox.
        $index = null;
        for ($i = 0; $i < count($this->mailboxesList); $i++) {
            if ($this->mailboxesList[$i]->uuid === $parameters) {
                $index = $i;
                break;
            }
        }

        // If mailbox not exists.
        if ($index === null) {
            $this->render('admin__mailer__mailer__mailboxes__err_delete');
        }

        // Delete mailbox.
        unset($this->mailboxesList[$index]);
        $this->set();

        // Render.
        $this->render(null, 'admin__mailer__mailer__mailboxes__conf_delete');
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

        // Set messages.
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/mailer/views/mailer__mailboxes_list.tpl');
        echo $output;
        exit();
    }
}