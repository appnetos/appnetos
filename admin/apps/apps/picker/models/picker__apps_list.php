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

// Model "admin\apps\picker__apps_list".
class picker__apps_list
{

    /**
     * Count.
     *
     * @var int.
     */
    public $count = null;

    /**
     * Areas.
     *
     * @var int.
     */
    public $areas = null;

    /**
     * Start.
     *
     * @var int.
     */
    public $start = null;

    /**
     * End.
     *
     * @var int.
     */
    public $end = null;

    /**
     * List.
     *
     * @var array.
     */
    public $appsList = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__picker__apps_list', $this);

        // Get model objects.
        $database = objects::get('database');
        $pickerSearch = objects::get('admin/apps/picker__search');

        // Set search parameter.
        $search = '%' . $pickerSearch->search . '%';

        // Select count from database table "application_apps".
        $query = 'SELECT COUNT(*) FROM application_apps WHERE (xt_name LIKE ? OR xt_description LIKE ?)';
        $this->count = $database->count($query, [$search, $search]);

        // Prepare parameters.
        $this->areas = round($this->count / $pickerSearch->number + 0.49999999999);
        if ($pickerSearch->area > $this->areas || $pickerSearch->area < 1) {
            $pickerSearch->updateArea(1);
        }
        $this->start = $pickerSearch->area - 5;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $pickerSearch->area + 5;
        if ($this->end > $this->areas) {
            $this->end = $this->areas;
        }
        $offset = ($pickerSearch->area - 1) * $pickerSearch->number;

        // Select data from database table "application_apps".
        $query = 'SELECT xt_id FROM application_apps WHERE (xt_name LIKE ? OR xt_description LIKE ?) ORDER BY ' . $pickerSearch->order .' LIMIT ' . $pickerSearch->number . ' OFFSET ' . $offset;
        $array = $database->selectArray($query, [$search, $search]);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Get object "admin\apps\picker__app".
        objects::get('admin/apps/picker__app');

        // Initialize apps.
        for ($i = 0; $i < count($array); $i++) {
            $pickerApp = objects::getNew('admin/apps/picker__app');
            $pickerApp->id = (int)$array[$i]['xt_id'];
            $pickerApp->init();
            array_push($this->appsList, $pickerApp);
        }
    }
}