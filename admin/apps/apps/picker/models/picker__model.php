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
 * @description     Admin app picker. Open modal popup to pick an app ID.
 *                  Open:           "admin__apps__picker.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(APP ID);
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\picker__model".
class picker__model
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
        $this->_render = objects::get('render');
        $this->_render->assign('admin__apps__picker__model', $this);

        // Initialize objects.
        $pickerSearch = objects::get('admin/apps/picker__search', true);
        $pickerSearch->init();
        $pickerAppList = objects::get('admin/apps/picker__apps_list', true);
        $pickerAppList->init();
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