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
 * @description     Admin app installer to install or reinstall apps with install events.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Controller "admin\apps\install".
class install
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search', 'install'];

    /**
     * install constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/apps/install', $this);

        // Get model "admin\apps\install_model".
        $installModel = objects::get('admin/apps/install__model', true);
        $installModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object search.
        $installSearch = objects::get('admin/apps/install__search');
        $installSearch->init();
        $installSearch->update();

        // Get model "admin\apps\install__model".
        $installModel = objects::get('admin/apps/install__model', true);
        $installModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/install/views/install__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Install AJAX request.
     */
    public function install()
    {
        // Get parameters.
        $post = objects::get('post');
        $directory = $post->get('admin__apps__installer__directory');

        // If parameters not exists.
        if (!$directory) {
            return;
        }

        // Install application.
        $installApp = objects::get('admin/apps/install__app');
        $installApp->directory = $directory;
        $installApp->init();
        $installApp->install();
    }
}