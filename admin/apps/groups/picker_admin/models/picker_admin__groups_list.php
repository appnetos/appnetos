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

// Model "admin\apps\picker_admin__groups_list".
class picker_admin__groups_list
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
    public $groupsList = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__groups__picker_admin__groups_list', $this);

        // Get model objects.
        $database = objects::get('database');
        $pickerSearch = objects::get('admin/groups/picker_admin__search');

        // Set search parameter.
        $search = '%' . $pickerSearch->search . '%';

        // Select count from database table "admin_groups".
        $query = 'SELECT COUNT(*) FROM admin_groups WHERE xt_name LIKE ?';
        $this->count = $database->count($query, [$search]);

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

        // Select data from database table "admin_groups".
        $query = 'SELECT xt_id FROM admin_groups WHERE xt_name LIKE ? ORDER BY ' . $pickerSearch->order .' LIMIT ' . $pickerSearch->number . ' OFFSET ' . $offset;
        $array = $database->selectArray($query, [$search]);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Get object "admin\groups\picker_admin__group".
        objects::get('admin/groups/picker_admin__group');

        // Initialize apps.
        for ($i = 0; $i < count($array); $i++) {
            $pickerGroup = objects::getNew('admin/groups/picker_admin__group');
            $pickerGroup->id = (int)$array[$i]['xt_id'];
            $pickerGroup->init();
            array_push($this->groupsList, $pickerGroup);
        }
    }
}