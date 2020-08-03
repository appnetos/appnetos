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
 * @description     Admin application cms multi picker. Open modal popup to pick an list of URI IDs.
 *                  Open:           "admin__cms__picker_application.pick('mynamespace.myfunction', array with excluded IDs);
 *                  Select: Execute "mynamespace.myfunction(URI ID);
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Controller "admin\cms\picker_application".
class picker_application
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search'];

    /**
     * picker_application constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/cms/picker_application', $this);

        // Get model "admin\cms\picker_application__model".
        $pickerModel = objects::get('admin/cms/picker_application__model', true);
        $pickerModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object search.
        $pickerSearch = objects::get('admin/cms/picker_application__search');
        $pickerSearch->init();
        $pickerSearch->update();

        // Get model "admin\cms\picker_application__model".
        $pickerModel = objects::get('admin/cms/picker_application__model', true);
        $pickerModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/cms/picker_application/views/picker_application__uris_list.tpl');
        echo $output;
        exit();
    }
}