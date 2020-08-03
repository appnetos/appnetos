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
     * Array of registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['signIn', 'signOut'];

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Settings as \stdClass.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * Username for sign in form.
     *
     * @var string.
     */
    public $user = null;

    /**
     * Password for sign in form.
     *
     * @var string.
     */
    public $pass = null;

    /**
     * Stay signed in for sign in form.
     *
     * @var bool.
     */
    public $stay = false;

    /**
     * Error message.
     *
     * @var string.
     */
    public $error = null;

    /**
     * If user is active.
     *
     * @var bool.
     */
    public $active = false;

    /**
     * Used model "core\user".
     *
     * @var object.
     */
    protected $_user = null;

    /**
     * Used controller "core\extensions".
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
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp('appnetos/sign_in_form')->getId();

        // Get and set used objects.
        $this->_user = objects::get('user');
        $this->_extensions = objects::get('extensions');

        // Get if user is active.
        $this->active = $this->_user->getActive();

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
     * AJAX request sign in.
     */
    public function signIn()
    {
        // Prepare parameters.
        $data = new \stdClass();

        // Get used objects.
        $post = objects::get('post');
        $strings = objects::get('strings');

        // Get POST parameter.
        $this->user = trim($post->get('user'));
        $this->pass = trim($post->get('pass'));
        $this->stay = false;

        // Prepare parameters.
        if ($post->get('stay') !== '0') {
            $this->stay = true;
        }

        // If parameters exists.
        if (!$this->user || !$this->pass) {
            $this->error = $strings->get('appnetos__sign_in_form__err');
            $this->render();
            return false;
        }

        // Sign in.
        $user = objects::get('user');

        // If signed in.
        if ($user->signIn($this->user, $this->pass, $this->stay)) {
            header('Content-Type: application/json');
            echo '{"success":true}';
            return true;
        }

        // If not signed in.
        $this->error = $strings->get('appnetos__sign_in_form__err');
        $this->render();
        return false;
    }

    /**
     * AJAX request sign out.
     */
    public function signOut()
    {
        // Prepare parameters.
        $data = new \stdClass();

        // Get object "core\user".
        $user = objects::get('user');

        // Sign out.
        $user->signOut();

        // If Signed out.
        header('Content-Type: application/json');
        echo '{"success":true}';
        exit;
    }

    /**
     * Render AJAX.
     */
    protected function render()
    {
        $render = objects::get('render');
        $render->assign('appnetos__sign_in_form', $this);
        $template = $render->fetch('application/apps/appnetos/sign_in_form/application/views/sign_in_form__form.tpl');
        header('Content-Type: application/json');
        echo json_encode($template);
    }
}