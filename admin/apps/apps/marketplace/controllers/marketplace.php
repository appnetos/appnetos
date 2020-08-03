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

// Controller "admin\apps\marketplace".
class marketplace
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = [
        'search',
        'signIn',
        'signOut',
        'install',
        'update',
        'addToCart',
        'removeFromCart',
        'editCart',
        'getDownloadsByArea'
    ];

    /**
     * API URL.
     */
    public $api = null;

    /**
     * marketplace constructor.
     */
    public function __construct()
    {
        // Set APPNET OS API.
        $this->api = APPNETOS_URL . 'api/';

        // Set object.
        objects::set('admin/apps/marketplace', $this);

        // Get model "admin\apps\marketplace__model".
        $marketplaceModel = objects::get('admin/apps/marketplace__model', true);
        $marketplaceModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get model "admin\apps\marketplace__search".
        $marketplaceSearch = objects::get('admin/apps/marketplace__search');
        $marketplaceSearch->init();
        $marketplaceSearch->update();
    }

    /**
     * Sign in.
     */
    public function signIn()
    {
        // Get model "admin\apps\marketplace__user".
        $marketplaceUser = objects::get('admin/apps/marketplace__user', true);
        $marketplaceUser->signIn();
    }

    /**
     * Sign out.
     */
    public function signOut()
    {
        // Get model "admin\apps\marketplace__user".
        $marketplaceUser = objects::get('admin/apps/marketplace__user', true);
        $marketplaceUser->signOut();
    }

    /**
     * Install.
     */
    public function install()
    {
        // Get model "admin\apps\marketplace__install".
        $marketplaceInstall = objects::get('admin/apps/marketplace__install', true);
        $marketplaceInstall->install();
    }

    /**
     * Update.
     */
    public function update()
    {
        // Get model "admin\apps\marketplace__install".
        $marketplaceInstall = objects::get('admin/apps/marketplace__install', true);
        $marketplaceInstall->update();
    }

    /**
     * Add to cart.
     */
    public function addToCart()
    {
        // Get model "admin\apps\marketplace__apps_list".
        $marketplaceAppsList = objects::get('admin/apps/marketplace__apps_list', true);
        $marketplaceAppsList->addToCart();
    }

    /**
     * Remove from cart.
     */
    public function removeFromCart()
    {
        // Get model "admin\apps\marketplace__cart".
        $marketplaceAppsList = objects::get('admin/apps/marketplace__cart', true);
        $marketplaceAppsList->removeFromCart();
    }

    /**
     * Edit cart.
     */
    public function editCart()
    {
        // Get model "admin\apps\marketplace__cart".
        $marketplaceAppsList = objects::get('admin/apps/marketplace__cart', true);
        $marketplaceAppsList->editCart();
    }

    /**
     * Search downloads by area.
     */
    public function getDownloadsByArea()
    {
        // Get model "admin\apps\marketplace__downloads".
        $marketplaceDownloads = objects::get('admin/apps/marketplace__downloads', true);
        $marketplaceDownloads->getDownloadsByArea();
    }
}