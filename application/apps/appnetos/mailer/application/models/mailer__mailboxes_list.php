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

// Model "appnetos\mailer__mailboxes_list".
class mailer__mailboxes_list
{

    /**
     * Mailboxes list.
     *
     * @var array.
     */
    public $mailboxesList = [];

    /**
     * If is initialized.
     *
     * @var bool.
     */
    protected $_initialized = false;

    /**
     * Controller "core\extensions".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // If is initialized.
        if ($this->_initialized) {
            return;
        }

        // Get mailboxes list.
        $this->_extensions = objects::get('extensions');
        $mailboxesList = $this->_extensions->get('text', 2, 'appnetos/mailer');

        // If mailboxes list not exists.
        if (!$mailboxesList) {
            $this->set();
            return;
        }

        // Set mailboxes list.
        objects::get('appnetos/mailer__mailbox');
        $array = json_decode($mailboxesList, true);
        foreach ($array as $mailbox) {
            $mailerMailbox = objects::getNew('appnetos/mailer__mailbox');
            $mailerMailbox->uuid = $mailbox['uuid'];
            $mailerMailbox->name = $mailbox['name'];
            $mailerMailbox->address = $mailbox['address'];
            $mailerMailbox->host = $mailbox['host'];
            $mailerMailbox->port = $mailbox['port'];
            $mailerMailbox->user = $mailbox['user'];
            $mailerMailbox->pass = $mailbox['pass'];
            $mailerMailbox->timeout = $mailbox['timeout'];
            $mailerMailbox->smtp = $mailbox['smtp'];
            $mailerMailbox->smtpAuthentication = $mailbox['smtpAuthentication'];
            $mailerMailbox->smtpSecure = $mailbox['smtpSecure'];
            $mailerMailbox->firewall = $mailbox['firewall'];
            $mailerMailbox->fromName = $mailbox['fromName'];
            $mailerMailbox->confirmCount = $mailbox['confirmCount'];
            $mailerMailbox->errorCount = $mailbox['errorCount'];
            array_push($this->mailboxesList, $mailerMailbox);
        }

        // If is initialized.
        $this->_initialized = true;
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
     * Raise mailbox confirm count.
     *
     * @param $uuid.
     */
    public function raiseConfirmCount($uuid)
    {
        foreach ($this->mailboxesList as $mailerMailbox) {
            if ($mailerMailbox->uuid === $uuid) {
                $mailerMailbox->confirmCount++;
                $this->set();
                return;
            }
        }
    }

    /**
     * Raise mailbox error count.
     *
     * @param $uuid.
     */
    public function raiseErrorCount($uuid)
    {
        foreach ($this->mailboxesList as $mailerMailbox) {
            if ($mailerMailbox->uuid === $uuid) {
                $mailerMailbox->errorCount++;
                $this->set();
                return;
            }
        }
    }
}