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

// Model "admin\apps\marketplace__cart".
class marketplace__cart
{

    /**
     * Cart.
     *
     * @var string.
     */
    public $cart = null;

    /**
     * Error message.
     *
     * @var string.
     */
    public $error = null;

    /**
     * Success message.
     *
     * @var string.
     */
    public $success = null;

    /**
     * Used object marketplace "admin\apps\marketplace_user".
     *
     * @var object.
     */
    protected $_marketplaceUser = null;

    /**
     * Initialize
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__marketplace__cart', $this);

        // Get object marketplace user.
        $this->_marketplaceUser = objects::get('admin/apps/marketplace__user');

        // If user not signed in.
        if (!$this->_marketplaceUser->token || !$this->_marketplaceUser->user) {
            return;
        }

        // Get cart.
        $this->getCart();
    }

    /**
     * Get cart.
     */
    protected function getCart()
    {
        // Get apps by object "admin\apps\marketplace__api".
        $data = [];
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('cart', $data);

        // On no result.
        if (!$result) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }
        if (!isset($result['cart'])) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }

        // If user not signed in.
        if (!$this->_marketplaceUser->token || !$this->_marketplaceUser->user) {
            return;
        }

        // Set cart.
        $this->cart = $result['cart'];
    }

    /**
     * Remove from cart.
     */
    public function removeFromCart()
    {
        // Prepare variables.
        $data = [];

        // Get object "admin/apps/marketplace__user".
        $marketplaceUser = objects::get('admin/apps/marketplace__user');
        $marketplaceUser->init();

        // If user not signed in.
        if (!$marketplaceUser->user) {
            $this->onError('admin__apps__marketplace__err_not_signed_in');
        }

        // Get used objects.
        $post = objects::get('post');

        // Set data.
        $data['id'] = $post->get('data');

        // If data not exists.
        if (!$data['id']) {
            $this->onError('admin__apps__marketplace__err_connection');
        }

        // Get apps by object "admin\apps\marketplace__api".
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('removefromcart', $data);

        // On no result.
        if (!$result) {
            $this->onError('admin__apps__marketplace__err_connection');
        }
        if (!isset($result['cart'])) {
            $this->onError('admin__apps__marketplace__err_connection');
        }
        if (!$result['cart']) {
            $this->onError('admin__apps__marketplace__err_connection');
        }

        // On success.
        $this->cart = $result['cart'];
        $this->onSuccess('admin__apps__marketplace__conf_remove_from_cart');
    }

    /**
     * Edit cart.
     */
    public function editCart()
    {
        // Prepare variables.
        $data = [];

        // Get object "admin/apps/marketplace__user".
        $marketplaceUser = objects::get('admin/apps/marketplace__user');
        $marketplaceUser->init();

        // If user not signed in.
        if (!$marketplaceUser->user) {
            $this->onError('admin__apps__marketplace__err_not_signed_in');
        }

        // Get used objects.
        $post = objects::get('post');

        // Set data.
        $data['quantity'] = $post->get('data');

        // If data not exists.
        if (!$data['quantity']) {
            $this->onError('admin__apps__marketplace__err_connection');
        }

        // Get apps by object "admin\apps\marketplace__api".
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('editcart', $data);

        // On no result.
        if (!$result) {
            $this->onError('admin__apps__marketplace__err_connection');
        }
        if (!isset($result['cart'])) {
            $this->onError('admin__apps__marketplace__err_connection');
        }
        if (!$result['cart']) {
            $this->onError('admin__apps__marketplace__err_connection');
        }

        // On success.
        $this->cart = $result['cart'];
        $this->onSuccess('admin__apps__marketplace__conf_edit_cart');
    }

    /**
     * On error.
     *
     * @param string $error.
     * @throws.
     */
    public function onError($error)
    {
        // Get cart.
        $this->getCart();

        // Get used objects.
        $render = objects::get('render');

        // Get error message.
        $strings = objects::get('strings');
        $this->error = $strings->get($error);

        // Build return.
        $data = [];
        $data['user'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl');
        $data['cart'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__cart.tpl');

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * On success.
     *
     * @param string $success.
     * @throws.
     */
    public function onSuccess($success)
    {
        // Get used objects.
        $render = objects::get('render');

        // Get success message.
        $strings = objects::get('strings');
        $this->success = $strings->get($success);

        // Build return.
        $data = [];
        $data['user'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl');
        $data['cart'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__cart.tpl');

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}