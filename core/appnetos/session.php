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
 * @description     core/appnetos/session.php ->    SESSION parameter class, get and set session parameters by using
 *                  prefix and manage distribution.
 */

// Namespace.
namespace core;

// Class "core\session".
class session extends base
{

    /**
     * Array of all SESSION parameters.
     *
     * @var array.
     */
    protected $session = [];

    /**
     * Used object "core/database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * Used object "core\config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * Prefix from object "core\config".
     *
     * @var string.
     */
    protected $_prefix = null;

    /**
     * session constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Get used data.
        $this->_database = objects::get('database');
        $this->_config = objects::get('config');
        $this->_prefix = mb_strtoupper($this->_config->getPrefix()) . '_';

        // Set SESSION timeout.
        $this->setSessionTimeout();

        // Get SESSION ID.
        $sessionId = $this->getSessionId();

        // Start session.
        session_id($sessionId);
        session_start();

        // Get all SESSION parameters.
        foreach ($_SESSION as $key => $value) {
            $session = [$key => $value];
            $this->session += $session;
        }
    }

    /**
     * Set SESSION timeout.
     */
    protected function setSessionTimeout()
    {
        // Set SESSION application
        if (!APPNETOS_ADMIN) {
            $this->setSessionTimeoutApplication();
        }

        // Set SESSION timeout admin section.
        else {
            $this->setSessionTimeoutAdmin();
        }
    }

    /**
     * Set SESSION timeout application.
     */
    protected function setSessionTimeoutApplication()
    {
        $sessionTimeoutApplication = $this->_config->getSessionTimeoutApplication();
        ini_set('session.gc_maxlifetime', $sessionTimeoutApplication);
    }

    /**
     * Set SESSION timeout admin section.
     */
    protected function setSessionTimeoutAdmin()
    {
        $sessionTimeoutAdmin = $this->_config->getSessionTimeoutAdmin();
        ini_set('session.gc_maxlifetime', $sessionTimeoutAdmin);
    }

    /**
     * Get SESSION ID.
     *
     * @return mixed.
     */
    protected function getSessionId()
    {
        // Get SESSION ID application.
        if (!APPNETOS_ADMIN) {
            return $this->getSessionIdApplication();
        }

        // Get SESSION ID admin section.
        else {
            return $this->getSessionIdAdmin();
        }
    }

    /**
     * Get SESSION ID application.
     *
     * @return mixed.
     */
    protected function getSessionIdApplication()
    {
        // Prepare parameters.
        $sessionId = null;

        // If SESSION COOKIE not is set.
        if (isset($_COOKIE[$this->_prefix . 'APPNETOS_SID'])) {
            $sessionId = $_COOKIE[$this->_prefix . 'APPNETOS_SID'];
        }

        // Generate SESSION ID.
        if (!$sessionId) {
            $sessionId = $this->generateSessionId();
        }

        // Set SESSION ID as COOKIE.
        setcookie($this->_prefix . 'APPNETOS_SID', $sessionId, 0, "/");

        // Return SESSION ID.
        return $sessionId;
    }

    /**
     * Get SESSION ID admin section.
     *
     * @return mixed.
     */
    protected function getSessionIdAdmin()
    {
        // Prepare parameters.
        $sessionId = null;

        // If SESSION COOKIE not is set.
        if (isset($_COOKIE[$this->_prefix . 'APPNETOS_ADMIN_SID'])) {
            $sessionId = $_COOKIE[$this->_prefix . 'APPNETOS_ADMIN_SID'];
        }

        // Generate SESSION ID.
        if (!$sessionId) {
            $sessionId = $this->generateSessionId();
        }

        // Set SESSION ID as COOKIE.
        setcookie($this->_prefix . 'APPNETOS_ADMIN_SID', $sessionId, 0, "/");

        // Return SESSION ID.
        return $sessionId;
    }

    /**
     * Generate SESSION ID.
     *
     * @return string.
     */
    protected function generateSessionId()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $sessionId = '';
        for ($i = 0; $i < 64; $i++) {
            $sessionId .= $characters[rand(0, $charactersLength - 1)];
        }
        return $sessionId;
    }

    /**
     * Get a SESSION parameter.
     *
     * @param string $key SESSION parameter key.
     * @return string or bool.
     */
    public function get($key)
    {
        // Add prefix to key.
        $key = $this->_prefix . $key;

        // If parameter is set.
        if (isset($this->session[$key])) {
            return $this->session[$key];
        }

        // Return.
        return false;
    }

    /**
     * Set a SESSION parameter.
     *
     * @param string $key SESSION parameter key.
     * @param string $value SESSION parameter.
     */
    public function set($key, $value)
    {
        // Delete SESSION parameter if exists.
        $this->delete($key);

        // Add prefix to key.
        $key = $this->_prefix . $key;

        // Set SESSION parameter.
        $_SESSION[$key] = $value;

        // Set SESSION parameter to array of SESSION parameters.
        if (isset($this->session[$key])) {
            $this->session[$key] = $value;
        } else {
            $session = [$key => $value];
            $this->session += $session;
        }
    }

    /**
     * Delete a SESSION parameter.
     *
     * @param string $key SESSION parameter key.
     * @return bool.
     */
    public function delete($key)
    {
        // Add prefix to key.
        $key = $this->_prefix . $key;

        // If SESSION parameter not exists.
        if (!isset($_SESSION[$key])) {
            return false;
        }

        // Delete SESSION parameter.
        unset($_SESSION[$key]);

        // Delete SESSION parameter from array of SESSION parameters.
        if (isset($this->session[$key])) {
            unset($this->session[$key]);
        }

        // Return.
        return true;
    }

    /**
     * Get all SESSION parameters.
     *
     * @return array.
     */
    public function getAll()
    {
        return $this->session;
    }
}