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
 * @description     Admin main menu.
 */

// Namespace.
namespace admin\menu;

// Use.
use core\objects;

// Controller "admin\menu\menu".
class menu
{

    /**
     * menu constructor.
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
        // If user sign out.
        $get = objects::get('get');
        if ($get->get('signout') === 'true') {
            $this->signOut();
        }

        // Get object "admin\menu\menu__model".
        objects::getNew('admin/menu/menu__model');
    }

    /**
     * Sign out.
     */
    protected function signOut()
    {
        // Sign out user.
        $user = objects::get('user');
        $user->signOut();

        // Redirect.
        $uri = objects::get('uri');
        $redirect = $uri->getUrl(1);
        header('Location: ' . $redirect);
        exit;
    }
}