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

// Model "admin\mailer\mailer__log_confirm".
class mailer__log_confirm
{

    /**
     * IP.
     *
     * @var string.
     */
    public $ip = null;

    /**
     * Address.
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
}