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

// Model "appnetos\mailer__mailbox".
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
     * Timeout in seconds.
     *
     * @var int.
     */
    public $timeout = 30;

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
}