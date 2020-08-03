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
 * @description     Simple form to sign in by email or username and password.
 */

// Namespace.
namespace appnetos;

// define objects
use core\objects;

// Controller "appnetos\sign_in_form".
class sign_in_form
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Error message.
     *
     * @var string.
     */
    public $errorMsg = null;

    /**
     * Confirm message.
     *
     * @var string.
     */
    public $confirmMsg = null;

    /**
     * Settings.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * Used controller "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * sign_in_form constructor.
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

        // Initialize settings.
        $this->initSettings();

        // Process data.
        $this->processData();
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get and set used objects.
        $this->_extensions = objects::get('extensions');

        // Get last process message.
        $session = objects::get('session');
        $this->errorMsg = ($session->get('appnetos__sign_in_form__errorMsg'));
        if ($this->errorMsg) {
            $session->delete('appnetos__sign_in_form__errorMsg');
        }
        $this->confirmMsg = ($session->get('appnetos__sign_in_form__confirmMsg'));
        if ($this->confirmMsg) {
            $session->delete('appnetos__sign_in_form__confirmMsg');
        }
    }

    /**
     * Initialize.
     */
    protected function initSettings()
    {
        // Get app ID by index from object "core\uri".
        $uri = objects::get('uri');
        $index = $uri->getRequestIndex();
        if (isset($index[3])) {
            $this->appId = (int)$index[3];
        }

        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get settings.
        $settings = $this->_extensions->get('text', $this->appId);

        // If settings exists.
        if ($settings) {
            $this->settings = json_decode($settings);
        }

        // If settings not exists.
        else {
            $this->settings->signup = null;
            $this->settings->forgetPass = null;
            $this->_extensions->set(json_encode($this->settings), 'text', $this->appId);
        }
    }

    /**
     * Process data and set settings.
     */
    protected function processData()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $action = $post->get('action');

        // Edit settings.
        if ($action === 'sign_in_form__edit_settings') {
            $this->editSettings();
        }
    }

    /**
     * Edit settings.
     */
    protected function editSettings()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $signup = trim($post->get('sign_in_form__signup'));
        $signup = str_replace("\\", "/", $signup);
        $forgetPass = trim($post->get('sign_in_form__forgetPass'));
        $forgetPass = str_replace("\\", "/", $forgetPass);

        // Verifying settings.
        $uri = objects::get('uri');
        if (is_numeric($signup)) {
            $signup = (int)$signup;
            $seoUrl = $uri->getUrlApplication($signup);
            if (!$seoUrl) {
                $this->redirect('appnetos__sign_in_form__sign_up_err_seo');
            }
        }
        elseif (strlen($signup) === 0) {
            $signup = null;
        }
        if (is_numeric($forgetPass)) {
            $forgetPass = (int)$forgetPass;
            $seoUrl = $uri->getUrlApplication($forgetPass);
            if (!$seoUrl) {
                $this->redirect('appnetos__sign_in_form__forgott_err_seo');
            }
        }
        elseif (strlen($signup) === 0) {
            $signup = null;
        }

        // Set settings.
        $this->settings->signup = $signup;
        $this->settings->forgetPass = $forgetPass;

        // Save settings.
        $this->_extensions->set(json_encode($this->settings), 'text', $this->appId);

        // Redirect.
        $this->redirect(null, 'appnetos__sign_in_form__settings_conf');
    }

    /**
     * Set message and redirect.
     *
     * @param $errorMsg string.
     * @param $confirmMsg string.
     * @throws.
     */
    protected function redirect($errorMsg = null, $confirmMsg = null)
    {
        // Get objects.
        $session = objects::get('session');
        $strings = objects::get('strings');

        // Set messages.
        if ($errorMsg) {
            $session->set('appnetos__sign_in_form__errorMsg', $strings->get($errorMsg));
        }
        if ($confirmMsg) {
            $session->set('appnetos__sign_in_form__confirmMsg', $strings->get($confirmMsg));
        }

        // Redirect.
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
}