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
 * @description     Force sign in for admin section.
 */

// Namespace.
namespace admin;

// Use.
use \core\objects;

// Controller "admin\sign_in".
class sign_in
{

    /**
     * Array of registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = [
        'signIn',
    ];

    /**
     * AJAX sign in, returns sign in status.
     *
     * @return string.
     * @throws \core\exception.
     */
    public function signIn()
    {
        // Get object "core\user" and object "core\post".
        $user = objects::get('user');
        $post = objects::get('post');

        // Get POST parameters.
        $data = $post->get('data');
        if (!$data) {
            $this->renderError();
        }

        // Set parameters.
        $username = null;
        $password = null;
        foreach ($data as $value) {
            if ($value['name'] === 'user') {
                $username = $value['value'];
            }
            elseif ($value['name'] === 'pass') {
                $password = $value['value'];
            }
        }

        // If parameters not exists.
        if (!$username || !$password) {
            $this->renderError();
        }

        // If user not signed in.
        if (!$user->SignIn($username, $password)) {
            $this->renderError();
        }

        // If user not admin.
        if (!$user->getActive()) {
            $this->renderError();
        }

        // JSON Callback.
        header('Content-Type: application/json');
        echo '{"success": true}';
        exit;
    }

    /**
     * Render error.
     */
    protected function renderError()
    {
        // JSON Callback.
        header('Content-Type: application/json');
        echo '{"error": true}';
        exit;
    }

}