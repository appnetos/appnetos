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
 * @description     Admin application to manage static bottom apps.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Controller "admin\apps\static_bottom".
class static_bottom
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search', 'add', 'remove', 'move'];

    /**
     * static_bottom constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/apps/static_bottom', $this);

        // Get model "admin\apps\static_bottom__model".
        $staticBottomModel = objects::get('admin/apps/static_bottom__model', true);
        $staticBottomModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object search.
        $staticBottomSearch = objects::get('admin/apps/static_bottom__search');
        $staticBottomSearch->init();
        $staticBottomSearch->update();

        // Get model "admin\apps\static_bottom__model".
        $staticBottomModel = objects::get('admin/apps/static_bottom__model', true);
        $staticBottomModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/static_bottom/views/static_bottom__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX request.
     */
    public function add()
    {
        // Get model "admin\apps\static_bottom__model".
        $staticBottomModel = objects::get('admin/apps/static_bottom__model', true);
        $staticBottomModel->add();
        $staticBottomModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/static_bottom/views/static_bottom__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX remove.
     */
    public function remove()
    {
        // Get model "admin\apps\static_bottom__model".
        $staticBottomModel = objects::get('admin/apps/static_bottom__model', true);
        $staticBottomModel->remove();
        $staticBottomModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/static_bottom/views/static_bottom__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX remove.
     */
    public function move()
    {
        // Get model "admin\apps\static_bottom__model".
        $staticBottomModel = objects::get('admin/apps/static_bottom__model', true);
        $staticBottomModel->move();
        $staticBottomModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/static_bottom/views/static_bottom__apps_list.tpl');
        echo $output;
        exit();
    }
}