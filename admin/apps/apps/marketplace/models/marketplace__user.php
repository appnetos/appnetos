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
 * @description     APPNET OS Marketplace.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\marketplace__user".
class marketplace__user
{

    /**
     * Authentication token.
     *
     * @var string.
     */
    public $token = null;

    /**
     * Authentication secret.
     *
     * @var string.
     */
    public $secret = null;

    /**
     * Marketplace SESSION ID.
     *
     * @var string.
     */
    public $session = null;

    /**
     * User name.
     *
     * @var string.
     */
    public $user = null;

    /**
     * User image.
     *
     * @var string.
     */
    public $image = null;

    /**
     * User cart items count.
     *
     * @var int.
     */
    public $cart = null;

    /**
     * If user data updated.
     *
     * @var bool.
     */
    public $updated = false;

    /**
     * APPNET OS URL.
     *
     * @var string.
     */
    public $appnetosUrl = null;

    /**
     * Used object "core/session".
     *
     * @param object.
     */
    protected $_session = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__marketplace__user', $this);

        // et APPNET OS URL.
        $this->appnetosUrl = APPNETOS_URL;

        // Get used objects.
        $this->_session = objects::get('session');

        // Get user.
        $sessionUser = $this->_session->get('apps__marketplace__user');

        // If user not is set.
        if (!$sessionUser) {
            $this->set();
            return;
        }

        // Set user.
        $this->token = $sessionUser['token'];
        $this->secret = $sessionUser['secret'];
        $this->session = $sessionUser['session'];
        $this->user = $sessionUser['user'];
        $this->image = $sessionUser['image'];
        $this->cart = $sessionUser['cart'];
    }

    /**
     * Set user.
     */
    protected function set()
    {
        $user = [
            'token' => $this->token,
            'secret' => $this->secret,
            'session' => $this->session,
            'user' => $this->user,
            'image' => $this->image,
            'cart' => $this->cart,
        ];
        $this->_session->set('apps__marketplace__user', $user);
    }

    /**
     * Update user.
     *
     * @param array $data.
     * @return bool.
     */
    public function update($data)
    {
        // Check user data.
        if (!is_array($data)) {
            return false;
        }
        if (!array_key_exists('token', $data) ||
            !array_key_exists('secret', $data) ||
            !array_key_exists('session', $data) ||
            !array_key_exists('user', $data) ||
            !array_key_exists('image', $data) ||
            !array_key_exists('cart', $data)
        ) {
            return false;
        }

        // Update data.
        if ($this->token !== $data['token']) {
            $this->token = $data['token'];
            $this->updated = true;
        }
        if ($this->secret !== $data['secret']) {
            $this->secret = $data['secret'];
            $this->updated = true;
        }
        if ($this->session !== $data['session']) {
            $this->session = $data['session'];
            $this->updated = true;
        }
        if ($this->user !== $data['user']) {
            $this->user = $data['user'];
            $this->updated = true;
        }
        if ($this->image !== $data['image']) {
            $this->image = $data['image'];
            $this->updated = true;
        }
        if ($this->cart !== $data['cart']) {
            $this->cart = $data['cart'];
            $this->updated = true;
        }
        if ($this->updated) {
            $this->set();
        }

        // Return.
        return true;
    }

    /**
     * Sign in.
     */
    public function signIn()
    {
        // Prepare parameters.
        $error = '';

        // Get used objects.
        $post = objects::get('post');
        $strings = objects::get('strings');

        // Get sign in data.
        $signInData = $post->get('data');

        // If sign in data not exists.
        if (!$signInData) {
            exit;
        }

        // Set data.
        $data = [];
        $data['user'] = '';
        $data['pass'] = '';
        foreach ($signInData as $item) {
            if ($item['name'] === 'admin__apps__marketplace__sign_in_user') {
                $data['user'] = $item['value'];
            }
            if ($item['name'] === 'admin__apps__marketplace__sign_in_pass') {
                $data['pass'] = $item['value'];
            }
        }

        // If user data not entered.
        if (!$data['user']) {
            $error .= $strings->get('admin__apps__marketplace__sign_in_err_user') . '<br>';
        }
        if (!$data['pass']) {
            $error .= $strings->get('admin__apps__marketplace__sign_in_err_pass') . '<br>';
        }

        // If has errors.
        if ($error) {
            $this->error($error);
        }

        // Sign in by object "admin\apps\marketplace__api".
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('signin', $data);

        // On no result.
        if (!$result) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            $this->error($strings->get('admin__apps__marketplace__err_connection'));
        }
        if (!isset($result['signin'])) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            $this->error($strings->get('admin__apps__marketplace__err_connection'));
        }
        if (
            !isset($result['signin']['token']) ||
            !isset($result['signin']['secret']) ||
            !isset($result['signin']['user']) ||
            !isset($result['signin']['image'])
        ) {
            $this->error($strings->get('admin__apps__marketplace__access_denied'));
        }

        // Update user.
        $this->token = $result['signin']['token'];
        $this->secret = $result['signin']['secret'];
        $this->user = $result['signin']['user'];
        $this->image = $result['signin']['image'];

        // Set user data.
        $this->_session = objects::get('session');
        $this->set();

        // Prepare parameters.
        $render = objects::get('render');
        $data = [];
        $data['error'] = false;
        $data['menu_user'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl');

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Sign out.
     */
    public function signOut()
    {
        // Sign in by object "admin\apps\marketplace__api".
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('signout', []);

        // Unset user data.
        $this->_session = objects::get('session');
        $this->_session->delete('apps__marketplace__user');
        $this->user = null;

        // Render template.
        $render = objects::get('render');
        $return = $render->fetch('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl');
        echo json_encode($return);
        exit;
    }

    /**
     * Error message.
     *
     * @param error.
     */
    protected function error($error)
    {
        // Prepare parameters.
        $data = [];
        $data['error'] = $error;

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}