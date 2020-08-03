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

// Model "appnetos\mailer__settings".
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
}