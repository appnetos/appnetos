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

// Model "appnetos\mailer__whitelist_list".
class mailer__whitelist_list
{

    /**
     * IPs.
     *
     * @var array.
     */
    public $ips = [];

    /**
     * Emails.
     *
     * @var array.
     */
    public $emails = [];

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
        // Get whitelist list.
        $this->_extensions = objects::get('extensions');
        $whitelistList = $this->_extensions->get('text', 3, 'appnetos/mailer');

        // If settings not exists.
        if (!$whitelistList) {
            $this->set();
            return;
        }

        // Set whitelist list.
        $array = json_decode($whitelistList, true);
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Set whitelist list.
     */
    protected function set()
    {
        $whitelistList = json_encode($this);
        $this->_extensions->set($whitelistList, 'text', 3, 'appnetos/mailer');
    }

    /**
     * Check request whitelist.
     *
     * @param string $email.
     * @param string $ip.
     * @return bool.
     */
    public function check($email, $ip)
    {
        // Check entries.
        foreach ($this->emails as $emailsEmail) {
            if ($emailsEmail === $email) {
                return true;
            }
        }
        foreach ($this->ips as $ipsIp) {
            if ($ipsIp === $ip) {
                return true;
            }
        }

        // Return.
        return false;
    }
}