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
 * @description     Extended cookie note, with list of all cookies and their use. App admin settings to set kind of used
 *                  cookies and the notifications.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\cookie_note".
class cookie_note
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Array of registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['accept'];

    /**
     * Settings as \stdClass.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * Used variable COOKIE lock from object "core\config".
     *
     * @var bool.
     */
    public $cookieLock = false;

    /**
     * If necessary COOKIE can be set.
     *
     * @var bool.
     */
    public $cookie = false;

    /**
     * Errors as \stdClass.
     *
     * @var bool.
     */
    public $errors = null;

    /**
     * cookie_note constructor.
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

        // Initialize app.
        if ($this->cookieLock) {
            $this->initApp();
        }
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp('appnetos/cookie_note')->getId();

        // Get used variable COOKIE lock from object "core\config".
        $config = objects::get('config');
        $this->cookieLock = $config->getCookieLock();
    }

    /**
     *  Initialize app.
     */
    protected function initApp()
    {
        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get app ID by object "core\objects".
        $id = objects::getApp()->getId();

        // Get settings.
        $extensions = objects::get('extensions');
        $settings = $extensions->get('text', $id, 'appnetos/cookie_note');

        // If settings exists.
        if ($settings) {
            $this->settings = json_decode($settings);
        }

        // If settings not exists.
        else {
            $this->settings->function = true;
            $this->settings->functionOn = true;
            $this->settings->functionMsg = true;
            $this->settings->statistics = true;
            $this->settings->statisticsOn = true;
            $this->settings->statisticsMsg = true;
            $this->settings->marketing = true;
            $this->settings->marketingOn = true;
            $this->settings->marketingMsg = true;
            $extensions = objects::get('extensions');
            $extensions->set(json_encode($this->settings), 'text', $id);
        }

        // Get status from object "core\cookies".
        $cookie = objects::get('cookie');
        $status = $cookie->getStatus();
        $this->cookie = $status->NECESSARY->allowed;
    }

    /**
     * AJAX function accept.
     * Echo true.
     *
     * @return string
     * @throws \core\exception.
     */
    public function accept()
    {
        // Get POST parameters.
        $cookie = objects::get('cookie');
        $post = objects::get('post');
        $data = $post->get('data');

        // Set parameters.
        $cookie->unlock();
        foreach ($data as $value) {
            if ($value['name'] === 'function') {
                $cookie->unlockFunction();
            }
            elseif ($value['name'] === 'statistics') {
                $cookie->unlockStatistics();
            }
            elseif ($value['name'] === 'marketing') {
                $cookie->unlockMarketing();
            }
        }

        // JSON Callback.
        $result = 'true';
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Get cookie errors.
     *
     * @return bool.
     * @throws \core\exception.
     */
    public function getErrors()
    {
        // If errors not is set.
        if ($this->errors === null) {

            // Set parameters as new \stdClass.
            $this->errors = new \stdClass();

            // Get errors from object "core\cookie".
            $cookie = objects::get('cookie');
            $this->errors->necessary = $cookie->getErrorsNecessary();
            $this->errors->function = $cookie->getErrorsFunction();
            $this->errors->statistics = $cookie->getErrorsStatistics();
            $this->errors->marketing = $cookie->getErrorsMarketing();
        }

        // If is errors.
        if ($this->errors->necessary) {
            return true;
        }
        if ($this->settings->functionMsg && $this->errors->function) {
            return true;
        }
        if ($this->settings->statisticsMsg && $this->errors->statistics) {
            return true;
        }
        if ($this->settings->marketingMsg && $this->errors->marketing) {
            return true;
        }

        // If no errors.
        return false;
    }
}