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

// Model "appnetos\mailer__log_error".
class mailer__log_error
{

    /**
     * IP.
     *
     * @var string.
     */
    public $ip = null;

    /**
     * Mail address.
     *
     * @var string.
     */
    public $address = null;

    /**
     * Timestamp.
     *
     * @var int.
     */
    public $timestamp = null;

    /**
     * Mailbox UUID.
     *
     * @var string.
     */
    public $mailboxUuid = null;

    /**
     * Error message.
     *
     * @var string.
     */
    public $message = null;

    /**
     * PHP mailer error info.
     *
     * @var string.
     */
    public $phpMailerInfo = null;
}