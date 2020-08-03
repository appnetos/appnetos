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

// Model "appnetos\mailer__blacklist_list".
class mailer__blacklist_list
{

    /**
     * Blacklist list.
     *
     * @var array.
     */
    public $blacklistList = [];

    /**
     * Model "appnetos\mailer__settings".
     *
     * @var object.
     */
    protected $_mailerSettings = null;

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
        // Get objects.
        $this->_extensions = objects::get('extensions');
        $this->_mailerSettings = objects::get('appnetos/mailer__settings');
        $this->_mailerSettings->init();

        // Get whitelist list.
        $blacklistList = $this->_extensions->get('text', 4, 'appnetos/mailer');

        // If settings not exists.
        if (!$blacklistList) {
            $this->set();
            return;
        }

        // Get model "admin\mailer\mailer_blacklist".
        objects::get('appnetos/mailer__blacklist');

        // Set blacklist list.
        $array = json_decode($blacklistList);
        $isset = false;
        foreach ($array as $value) {
            if ($value->ip && !$value->static && $this->_mailerSettings->lockIpExpire !== 0) {
                $expire = time() - $value->timestamp;
                if ($expire > $this->_mailerSettings->lockIpExpire) {
                    $isset = true;
                    continue;
                }
            }
            if ($value->address && !$value->static && $this->_mailerSettings->lockEmailExpire !== 0) {
                $expire = time() - $value->timestamp;
                if ($expire > $this->_mailerSettings->lockEmailExpire) {
                    $isset = true;
                    continue;
                }
            }
            $mailerBlacklist = objects::getNew('appnetos/mailer__blacklist');
            $mailerBlacklist->ip = $value->ip;
            $mailerBlacklist->address = $value->address;
            $mailerBlacklist->timestamp = $value->timestamp;
            $mailerBlacklist->static = $value->static;

            array_push($this->blacklistList, $mailerBlacklist);
        }

        // Set on changes.
        if ($isset) {
            $this->set();
        }
    }

    /**
     * Set blacklist list.
     */
    protected function set()
    {
        $blacklistList = json_encode($this->blacklistList);
        $this->_extensions->set($blacklistList, 'text', 4, 'appnetos/mailer');
    }

    /**
     * Check request blacklist.
     *
     * @param string $email .
     * @return bool or string.
     * @throws \core\exception.
     */
    public function check($email)
    {
        // Get IP address.
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Check whitelist.
        $mailerWhitelistList = objects::get('appnetos/mailer__whitelist_list');
        $mailerWhitelistList->init();
        if ($mailerWhitelistList->check($email, $ip)) {
            return true;
        }

        // Check if IP address or email address blacklist.
        foreach ($this->blacklistList as $blacklist) {
            if ($blacklist->address === $email) {
                return 'appnetos__mailer__error_email_in_blacklist';
            }
            elseif ($blacklist->ip === $ip) {
                return 'appnetos__mailer__error_ip_in_blacklist';
            }
        }

        // Compare IP address and email address with logs list.
        $mailerLogsList = objects::get('appnetos/mailer__logs_list');
        $mailerLogsList->init();
        $requestsAddress = $mailerLogsList->getRequestsAddress($email);
        if ($requestsAddress > $this->_mailerSettings->lockEmailRequests) {
            $mailerBlacklist = objects::getNew('appnetos/mailer__blacklist');
            $mailerBlacklist->address = $email;
            $mailerBlacklist->timestamp = time();
            array_push($this->blacklistList, $mailerBlacklist);
            $this->set();
            return 'appnetos__mailer__error_email_to_blacklist';
        }
        $requestsIp = $mailerLogsList->getRequestsAddress($email);
        if ($requestsIp > $this->_mailerSettings->lockIpRequests) {
            $mailerBlacklist = objects::getNew('appnetos/mailer__blacklist');
            $mailerBlacklist->ip = $ip;
            $mailerBlacklist->timestamp = time();
            array_push($this->blacklistList, $mailerBlacklist);
            $this->set();
            return 'appnetos__mailer__error_ip_to_blacklist';
        }

        // Return.
        return true;
    }
}