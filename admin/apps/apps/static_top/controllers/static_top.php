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
 * @description     Admin application to manage static top apps.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Controller "admin\apps\static_top".
class static_top
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search', 'add', 'remove', 'move'];

    /**
     * static_top constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/apps/static_top', $this);

        // Get model "admin\apps\static_top__model".
        $staticTopModel = objects::get('admin/apps/static_top__model', true);
        $staticTopModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object search.
        $staticTopSearch = objects::get('admin/apps/static_top__search');
        $staticTopSearch->init();
        $staticTopSearch->update();

        // Get model "admin\apps\static_top__model".
        $staticTopModel = objects::get('admin/apps/static_top__model', true);
        $staticTopModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/static_top/views/static_top__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX request.
     */
    public function add()
    {
        // Get model "admin\apps\static_top__model".
        $staticTopModel = objects::get('admin/apps/static_top__model', true);
        $staticTopModel->add();
        $staticTopModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/static_top/views/static_top__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX remove.
     */
    public function remove()
    {
        // Get model "admin\apps\static_top__model".
        $staticTopModel = objects::get('admin/apps/static_top__model', true);
        $staticTopModel->remove();
        $staticTopModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/static_top/views/static_top__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX remove.
     */
    public function move()
    {
        // Get model "admin\apps\static_top__model".
        $staticTopModel = objects::get('admin/apps/static_top__model', true);
        $staticTopModel->move();
        $staticTopModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/static_top/views/static_top__apps_list.tpl');
        echo $output;
        exit();
    }
}