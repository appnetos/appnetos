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
 * @description     Force sign in. Use this app on first static top app to force a login.
 */

// Namespace.
namespace appnetos;

// define objects
use core\objects;

// Controller "appnetos\force_sign_in".
class force_sign_in
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

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
     * Stay signed sign in form.
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
     * force_sign_in constructor.
     */
    public function __construct()
    {
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp('appnetos/force_sign_in')->getId();

        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Get parameters.
        $user = objects::get('user');
        $uri = objects::get('uri');
        $active = $user->getActive();
        $ajax = $uri->getAjax();

        // If user is active.
        if ($active) {
            return;
        }

        // If is AJAX request.
        if ($ajax) {
            $this->signIn();
            exit();
        }

        // If user is not active.
        $render = objects::get('render');
        $render->assign('appnetos__force_sign_in', $this);
        $render->display('application/apps/appnetos/force_sign_in/application/views/force_sign_in__container.tpl');
        exit();
    }

    /**
     * AJAX request sign in.
     */
    protected function signIn()
    {
        // Get object "core\post".
        $post = objects::get('post');
        $strings = objects::get('strings');

        // Get POST parameter.
        $data = $post->get('data');

        // Set parameters.
        $this->user = null;
        $this->pass = null;
        $this->stay = false;
        foreach ($data as $value) {
            if ($value['name'] === 'user') {
                $this->user = $value['value'];
            }
            elseif ($value['name'] === 'pass') {
                $this->pass = $value['value'];
            }
            elseif ($value['name'] === 'stay') {
                $this->stay = true;
            }
        }

        // If parameters exists.
        if (!$this->user || !$this->pass) {
            $this->error = $strings->get('appnetos__force_sign_in__err');
            $this->render();
            return;
        }

        // Sign in.
        $user = objects::get('user');

        // If signed in.
        if ($user->signIn($this->user, $this->pass, $this->stay)) {
            header('Content-Type: application/json');
            echo '{"success": true}';
            exit;
        }

        // If not signed in.
        $this->error = $strings->get('appnetos__force_sign_in__err');
        $this->render();
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     */
    protected function render()
    {
        // Render template.
        $render = objects::get('render');
        $render->assign('appnetos__force_sign_in', $this);
        $result = $render->fetch('application/apps/appnetos/force_sign_in/application/views/force_sign_in__form.tpl');

        // JSON Callback.
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}