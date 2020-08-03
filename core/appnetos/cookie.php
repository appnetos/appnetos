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
 * @description     core/appnetos/cookie.php ->    COOKIE class. Get and set COOKIES by using prefix and manage
 *                  distribution.
 */

// Namespace.
namespace core;

// Class "core\cookie".
class cookie extends base
{

    /**
     * Array of all COOKIES.
     *
     * @var array.
     */
    protected $cookies = [];

    /**
     * COOKIE status as \stdClass.
     *
     * @var \stdClass.
     */
    protected $status = null;

    /**
     * Error count if set COOKIE has errors.
     *
     * @var int.
     */
    protected $error = 0;

    /**
     * Used object "core\session".
     *
     * @var object.
     */
    protected $_session = null;

    /**
     * Used prefix from object "core\config".
     *
     * @var string.
     */
    protected $_prefix = null;

    /**
     * Used cookie look from object "core\config".
     *
     * @var bool.
     */
    protected $_cookieLock = false;

    /**
     * cookie constructor.
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
        // Get and set used data.
        $this->getSet();

        // If COOKIE lock is not active.
        if (!$this->_cookieLock) {
            return;
        }

        // Get COOKIE status from COOKIES.
        $status = $this->get('APPNETOS_COOKIES');

        // If status COOKIE is set.
        if ($status) {
            $this->status = json_decode($status);
        }

        // If status COOKIE not set.
        else {

            // Get COOKIE status from object "core\session".
            $status = $this->_session->get('APPNETOS_COOKIES');

            // If COOKIE status is set.
            if ($status) {
                $this->status = json_decode($status);
            }

            // If COOKIE status not is set.
            else {
                $this->initStatus();
            }
        }

        // Set error count.
        $this->error = $this->status->error;
        $this->status->error = 0;
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get all COOKIES.
        foreach ($_COOKIE as $key => $value) {
            $cookie = [$key => $value];
            $this->cookies += $cookie;
        }

        // Get data from object "core\config".
        $config = objects::get('config');
        $this->_prefix = mb_strtoupper($config->getPrefix()) . '_';
        $this->_cookieLock = $config->getCookieLock();

        // Get object "core\session".
        $this->_session = objects::get('session');
    }

    /**
     * Initialize COOKIE status.
     */
    protected function initStatus()
    {
        // Initialize COOKIE status.
        $this->status = new \stdClass();
        $necessary = new \stdClass();
        $necessary->allowed = false;
        $necessary->error = 0;
        $this->status->{'NECESSARY'} = $necessary;
        $function = new \stdClass();
        $function->allowed = false;
        $function->error = 0;
        $this->status->{'FUNCTION'} = $function;
        $statistics = new \stdClass();
        $statistics->allowed = false;
        $statistics->error = 0;
        $this->status->{'STATISTICS'} = $statistics;
        $marketing = new \stdClass();
        $marketing->allowed = false;
        $marketing->error = 0;
        $this->status->{'MARKETING'} = $marketing;
        $this->status->error = 0;

        // Set COOKIE status to object "core\session".
        $this->_session->set('APPNETOS_COOKIES', json_encode($this->status));
    }

    /**
     * Get COOKIE.
     *
     * @param string $key COOKIE key.
     * @param bool $prefix use prefix.
     * @return string or bool.
     */
    public function get($key, $prefix = true)
    {
        // Add prefix to key.
        if ($prefix) {
            $key = $this->_prefix . $key;
        }

        // Return COOKIE if set.
        if (isset($this->cookies[$key])) {
            return $this->cookies[$key];
        }

        // Return.
        return false;
    }

    /**
     * Set necessary COOKIE.
     *
     * @param string $key COOKIE key.
     * @param string $value COOKIE value.
     * @param bool $prefix use prefix.
     * @param int $timeExpires time expires in seconds -> standard 30 days.
     * @param string $path COOKIE path.
     * @return bool.
     */
    public function set($key, $value, $prefix = true, $timeExpires = null, $path = '/')
    {
        // Set cecessary cookie.
        $this->setCookie($key, $value, $prefix, $timeExpires, $path);
        return true;
    }

    /**
     * Set function COOKIE.
     *
     * @param string $key COOKIE key.
     * @param string $value COOKIE value.
     * @param bool $prefix use prefix.
     * @param int $timeExpires time expires in seconds -> standard 30 days.
     * @param string $path COOKIE path.
     * @return bool.
     */
    public function setFunction($key, $value, $prefix = true, $timeExpires = null, $path = '/')
    {
        // If COOKIE lock is not active.
        if (!$this->_cookieLock) {
            $this->setCookie($key, $value, $prefix, $timeExpires, $path = '/');
            return true;
        }

        // If function COOKIES allowed.
        if ($this->status->{'FUNCTION'}->allowed) {
            $this->setCookie($key, $value, $prefix, $timeExpires, $path = '/');
            return true;
        }

        // If function COOKIES not allowed.
        $this->setError('FUNCTION');
        return false;
    }

    /**
     * Set statistics COOKIE.
     *
     * @param string $key COOKIE key.
     * @param string $value COOKIE value.
     * @param bool $prefix use prefix.
     * @param int $timeExpires time expires in seconds -> standard 30 days.
     * @param string $path COOKIE path.
     * @return bool.
     */
    public function setStatistics($key, $value, $prefix = true, $timeExpires = null, $path = '/')
    {
        // If COOKIE lock is not active.
        if (!$this->_cookieLock) {
            $this->setCookie($key, $value, $prefix, $timeExpires, $path);
            return true;
        }

        // If statistics COOKIEs allowed.
        if ($this->status->{'STATISTICS'}->allowed) {
            $this->setCookie($key, $value, $prefix, $timeExpires, $path);
            return true;
        }

        // If statistics COOKIES not allowed.
        $this->setError('STATISTICS');
        return false;
    }

    /**
     * Set marketing COOKIE.
     *
     * @param string $key COOKIE key.
     * @param string $value COOKIE value.
     * @param bool $prefix use prefix.
     * @param int $timeExpires time expires in seconds -> standard 30 days.
     * @param string $path COOKIE path.
     * @return bool.
     */
    public function setMarketing($key, $value, $prefix = true, $timeExpires = null, $path = '/')
    {
        // If COOKIE lock is not active.
        if (!$this->_cookieLock) {
            $this->setCookie($key, $value, $prefix, $timeExpires, $path);
            return true;
        }

        // If marketing COOKIES allowed.
        if ($this->status->{'MARKETING'}->allowed) {
            $this->setCookie($key, $value, $prefix, $timeExpires, $path);
            return true;
        }

        // If marketing COOKIES not allowed.
        $this->setError('MARKETING');
        return false;
    }

    /**
     * Set admin section COOKIE.
     *
     * @param string $key COOKIE key.
     * @param string $value COOKIE value.
     * @param bool $prefix use prefix.
     * @param int $timeExpires time expires in seconds -> standard 30 days.
     * @param string $path COOKIE path.
     */
    public function setAdmin($key, $value, $prefix = true, $timeExpires = null, $path = '/')
    {
        $this->setCookie($key, $value, $prefix, $timeExpires, $path);
    }

    /**
     * Set COOKIE.
     *
     * @param string $key COOKIE key.
     * @param string $value COOKIE value.
     * @param bool $prefix use prefix.
     * @param int $timeExpires time expires in seconds -> standard 30 days.
     * @param string $path COOKIE path.
     */
    public function setCookie($key, $value, $prefix = true, $timeExpires = null, $path = '/')
    {
        // Delete COOKIE if exists.
        $this->delete($key, $prefix, $path);

        // Add seconds of 30 days to time expires in not exists.
        if (!$timeExpires) {
            $timeExpires = time() + 2592000;
        }

        // Add prefix to key.
        if ($prefix) {
            $key = $this->_prefix . $key;
        }

        // Set COOKIE.
        setcookie($key, $value, $timeExpires, $path);
        $_COOKIE[$key] = $value;

        // Set COOKIE to array of COOKIES.
        $this->cookies[$key] = $value;
    }

    /**
     * Delete COOKIE.
     *
     * @param string $key COOKIE key.
     * @param bool $prefix use prefix.
     * @param string $path.
     * @return bool.
     */
    public function delete($key, $prefix = true, $path = '/')
    {
        // Add prefix to key.
        if ($prefix) {
            $key = $this->_prefix . $key;
        }

        // Delete COOKIE.
        setcookie($key, "", time() - 3600, $path);
        if (isset($this->cookies[$key])) {
            unset($this->cookies[$key]);
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Set error.
     *
     * @param string $type COOKIE type.
     */
    protected function setError($type)
    {
        // Set error.
        $this->error = true;

        // Set error to status.
        if ($type === 'NECESSARY') {
            $this->status->NECESSARY->error++;
        }
        elseif ($type === 'FUNCTION') {
            $this->status->FUNCTION->error++;
        }
        elseif ($type === 'STATISTICS') {
            $this->status->STATISTICS->error++;
        }
        elseif ($type === 'MARKETING') {
            $this->status->MARKETING->error++;
        }
        $this->status->error++;

        // If necessary allowed.
        if ($this->status->{'NECESSARY'}->allowed) {
            $this->set('APPNETOS_COOKIES', json_encode($this->status));
        }

        // If necessary not allowed.
        else {
            $this->_session->set('APPNETOS_COOKIES', json_encode($this->status));
        }
    }

    /**
     * Unlock COOKIE lock.
     */
    public function unlock()
    {
        $this->unlockNecessary();
    }

    /**
     * Unlock necessary COOKIES.
     */
    public function unlockNecessary()
    {
        // Set status COOKIE.
        $this->status->{'NECESSARY'}->allowed = true;
        $this->status->{'NECESSARY'}->error = 0;
        $this->set('APPNETOS_COOKIES', json_encode($this->status));

        // Delete status SESSION.
        $this->_session->delete('APPNETOS_COOKIES');
    }

    /**
     * Unlock function COOKIES.
     */
    public function unlockFunction()
    {
        // Set status COOKIE.
        $this->status->{'NECESSARY'}->allowed = true;
        $this->status->{'NECESSARY'}->error = 0;
        $this->status->{'FUNCTION'}->allowed = true;
        $this->status->{'FUNCTION'}->error = 0;
        $this->set('APPNETOS_COOKIES', json_encode($this->status));

        // Delete status SESSION.
        $this->_session->delete('APPNETOS_COOKIES');
    }

    /**
     * Unlock statistics COOKIES.
     */
    public function unlockStatistics()
    {
        // Set status COOKIE.
        $this->status->{'NECESSARY'}->allowed = true;
        $this->status->{'NECESSARY'}->error = 0;
        $this->status->{'STATISTICS'}->allowed = true;
        $this->status->{'STATISTICS'}->error = 0;
        $this->set('APPNETOS_COOKIES', json_encode($this->status));

        // Delete status SESSION.
        $this->_session->delete('APPNETOS_COOKIES');
    }

    /**
     * Unlock marketing COOKIES.
     */
    public function unlockMarketing()
    {
        // Set status COOKIE.
        $this->status->{'NECESSARY'}->allowed = true;
        $this->status->{'NECESSARY'}->error = 0;
        $this->status->{'MARKETING'}->allowed = true;
        $this->status->{'MARKETING'}->error = 0;
        $this->set('APPNETOS_COOKIES', json_encode($this->status));

        // Delete status SESSION.
        $this->_session->delete('APPNETOS_COOKIES');
    }

    /**
     * Get error count necessary COOKIES.
     *
     * @return int.
     */
    public function getErrorsNecessary()
    {
        // Get errors from status.
        $errors = $this->status->{'NECESSARY'}->error;
        $this->status->{'NECESSARY'}->error = 0;

        // If necessary COOKIES allowed.
        if ($this->status->{'NECESSARY'}->allowed) {
            $this->set('APPNETOS_COOKIES', json_encode($this->status));
        }

        // If necessary COOKIES not allowed.
        else {
            $this->_session->delete('APPNETOS_COOKIES');
        }

        // Return errors.
        return $errors;
    }

    /**
     * Get error count function COOKIES.
     *
     * @return int.
     */
    public function getErrorsFunction()
    {
        // Get errors from status.
        $errors = $this->status->{'FUNCTION'}->error;
        $this->status->{'FUNCTION'}->error = 0;

        // If necessary COOKIES allowed.
        if ($this->status->{'NECESSARY'}->allowed) {
            $this->set('APPNETOS_COOKIES', json_encode($this->status));
        }

        // If necessary COOKIES not allowed.
        else {
            $this->_session->delete('APPNETOS_COOKIES');
        }

        // Return errors.
        return $errors;
    }

    /**
     * Get error count statistics COOKIES.
     *
     * @return int.
     */
    public function getErrorsStatistics()
    {
        // Get errors from status.
        $errors = $this->status->{'STATISTICS'}->error;
        $this->status->{'STATISTICS'}->error = 0;

        // If necessary COOKIES allowed.
        if ($this->status->{'NECESSARY'}->allowed) {
            $this->set('APPNETOS_COOKIES', json_encode($this->status));
        }

        // If necessary COOKIES not allowed.
        else {
            $this->_session->delete('APPNETOS_COOKIES');
        }

        // Return errors.
        return $errors;
    }

    /**
     * Get error count marketing COOKIES.
     *
     * @return int.
     */
    public function getErrorsMarketing()
    {
        // Get errors from status.
        $errors = $this->status->{'MARKETING'}->error;
        $this->status->{'MARKETING'}->error = 0;

        // If necessary COOKIES allowed.
        if ($this->status->{'NECESSARY'}->allowed) {
            $this->set('APPNETOS_COOKIES', json_encode($this->status));
        }

        // If necessary COOKIES not allowed.
        else {
            $this->_session->delete('APPNETOS_COOKIES');
        }

        // Return errors.
        return $errors;
    }

    /**
     * Get COOKIE status.
     *
     * @return object.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get error count.
     *
     * @return int.
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Get all COOKIES.
     *
     * @return array.
     */
    public function getAll()
    {
        return $this->cookies;
    }
}