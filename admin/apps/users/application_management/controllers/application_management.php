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

// Controller "admin\users\application_management".
class application_management
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search', 'add', 'edit', 'lock', 'activate', 'delete', 'restore'];

    /**
     * management constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/users/application_management', $this);

        // Get model "admin\users\application_management__model".
        $managementModel = objects::get('admin/users/application_management__model', true);
        $managementModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object "admin\users\application_management__search".
        $managementSearch = objects::get('admin/users/application_management__search');
        $managementSearch->init();
        $managementSearch->update();

        // Get model "admin\apps\application_management__model".
        $managementModel = objects::get('admin/users/application_management__model', true);
        $managementModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/users/application_management/views/application_management__users_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX request.
     */
    public function add()
    {
        // Set object.
        objects::set('admin/users/application_management', $this);

        // Get model "admin\users\application_management__users_list".
        $managementUsersList = objects::get('admin/users/application_management__users_list', true);
        $managementUsersList->add();
    }

    /**
     * Edit AJAX request.
     */
    public function edit()
    {
        // Set object.
        objects::set('admin/users/application_management', $this);

        // Get model "admin\users\application_management__user".
        $managementUser = objects::get('admin/users/application_management__user', true);
        $managementUser->edit();
    }

    /**
     * Lock AJAX request.
     */
    public function lock()
    {
        // Set object.
        objects::set('admin/users/application_management', $this);

        // Get model "admin\users\application_management__user".
        $managementUser = objects::get('admin/users/application_management__user', true);
        $managementUser->lock();
    }

    /**
     * Activate AJAX request.
     */
    public function activate()
    {
        // Set object.
        objects::set('admin/users/application_management', $this);

        // Get model "admin\users\application_management__user".
        $managementUser = objects::get('admin/users/application_management__user', true);
        $managementUser->activate();
    }

    /**
     * Delete AJAX request.
     */
    public function delete()
    {
        // Set object.
        objects::set('admin/users/application_management', $this);

        // Get model "admin\users\application_management__users_list".
        $managementUsersList = objects::get('admin/users/application_management__users_list', true);
        $managementUsersList->delete();
    }

    /**
     * Restore AJAX request.
     */
    public function restore()
    {
        // Set object.
        objects::set('admin/users/application_management', $this);

        // Get model "admin\users\application_management__users_list".
        $managementUsersList = objects::get('admin/users/application_management__users_list', true);
        $managementUsersList->restore();
    }
}