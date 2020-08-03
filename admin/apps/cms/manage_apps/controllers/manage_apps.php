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
 * @description     Admin URI apps management.
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Controller "admin\cms\manage_apps".
class manage_apps
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search', 'add', 'remove', 'move'];

    /**
     * manage_apps constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/cms/manage_apps', $this);

        // Get model "admin\cms\manage_apps__model".
        $editUriModel = objects::get('admin/cms/manage_apps__model', true);
        $editUriModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object search.
        $manageAppsSearch = objects::get('admin/cms/manage_apps__search');
        $manageAppsSearch->init();
        $manageAppsSearch->update();

        // Get model "admin\cms\manage_apps__model".
        $manageAppsModel = objects::get('admin/cms/manage_apps__model', true);
        $manageAppsModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/cms/manage_apps/views/manage_apps__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX request.
     */
    public function add()
    {
        // Set object.
        objects::set('admin/cms/manage_apps', $this);

        // Get model "admin\cms\manage_apps__model".
        $manageAppsModel = objects::get('admin/cms/manage_apps__model', true);
        $manageAppsModel->init();

        // Get model "admin\cms\manage_apps__apps_list".
        $manageAppsAppsList = objects::get('admin/cms/manage_apps__apps_list');
        $manageAppsAppsList->add();
    }

    /**
     * Remove AJAX request.
     */
    public function remove()
    {
        // Set object.
        objects::set('admin/cms/manage_apps', $this);

        // Get model "admin\cms\manage_apps__model".
        $manageAppsModel = objects::get('admin/cms/manage_apps__model', true);
        $manageAppsModel->init();

        // Get model "admin\cms\manage_apps__apps_list".
        $manageAppsAppsList = objects::get('admin/cms/manage_apps__apps_list');
        $manageAppsAppsList->remove();
    }

    /**
     * Move AJAX request.
     */
    public function move()
    {
        // Set object.
        objects::set('admin/cms/manage_apps', $this);

        // Get model "admin\cms\manage_apps__model".
        $manageAppsModel = objects::get('admin/cms/manage_apps__model', true);
        $manageAppsModel->init();

        // Get model "admin\cms\manage_apps__apps_list".
        $manageAppsAppsList = objects::get('admin/cms/manage_apps__apps_list');
        $manageAppsAppsList->move();
    }
}