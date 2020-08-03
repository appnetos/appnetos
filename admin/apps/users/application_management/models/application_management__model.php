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
 * @description     Admin overview and management for application users.
 */

// Namespace.
namespace admin\users;

// Use.
use \core\objects;

// Model "admin\users\application_management__model".
class application_management__model
{
    /**
     * Object "core\render".
     *
     * @var object.
     */
    private $_render = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        objects::set('admin/users/application_management__model', $this);
        $this->_render = objects::get('render');
        $this->_render->assign('admin__users__application_management__model', $this);

        // Initialize objects.
        $managementSearch = objects::get('admin/users/application_management__search', true);
        $managementSearch->init();
        $managementUsersList = objects::get('admin/users/application_management__users_list', true);
        $managementUsersList->init();
    }

    /**
     * Get admin info.
     *
     * @return bool.
     * @throws.
     */
    public function getInfoAdmin()
    {
        $config = objects::get('config');
        $infoAdmin = $config->getInfoAdmin();
        return $infoAdmin;
    }

    /**
     * Assign object.
     *
     * @param string $name.
     * @param object $object.
     */
    public function assign($name, $object)
    {
        $this->_render->assign($name, $object);
    }
}