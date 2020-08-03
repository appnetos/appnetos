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

// Model "admin\menu\menu".
class menu__model
{

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
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__menu__menu__model', $this);

        // Get user information.
        $user = objects::get('user');
        $this->user = $user->getUser();
        $this->image = $user->getImage();
    }
}