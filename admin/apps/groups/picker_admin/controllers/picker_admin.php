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
 * @description     Admin admin group picker. Open modal popup to pick an app ID.
 *                  Open:           "admin__groups__picker_admin.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(APP ID);
 */

// Namespace.
namespace admin\groups;

// Use.
use \core\objects;

// Controller "admin\groups\picker_admin".
class picker_admin
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search'];

    /**
     * picker constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/groups/picker_admin', $this);

        // Get model "admin\groups\picker_admin__model".
        $pickerModel = objects::get('admin/groups/picker_admin__model', true);
        $pickerModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object search.
        $pickerSearch = objects::get('admin/groups/picker_admin__search');
        $pickerSearch->init();
        $pickerSearch->update();

        // Get model "admin\apps\picker__model".
        $pickerModel = objects::get('admin/groups/picker_admin__model', true);
        $pickerModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/groups/picker_admin/views/picker_admin__groups_list.tpl');
        echo $output;
        exit();
    }
}