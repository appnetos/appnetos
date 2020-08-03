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
 * @description     Admin app overview and app management.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\management__apps_list".
class management__apps_list
{

    /**
     * Static top apps.
     *
     * @var array.
     */
    public $staticTop = [];

    /**
     * Static bottom apps.
     *
     * @var array.
     */
    public $staticBottom = [];

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
        $render->assign('admin__apps__management__apps_list', $this);

        // Get used objects.
        $database = objects::get('database');
        $managementSearch = objects::get('admin/apps/management__search');

        // Select from database table "application_static".
        $query = 'SELECT xt_top, xt_bottom FROM application_static WHERE xt_id=?';
        $row = $database->selectRow($query, [1]);
        $this->staticTop = [];
        if ($row['xt_top'] !== '') {
            $this->staticTop = array_map('intval', explode('|', $row['xt_top']));
        }
        $this->staticBottom = [];
        if ($row['xt_bottom'] !== '') {
            $this->staticBottom = array_map('intval', explode('|', $row['xt_bottom']));
        }

        // Set search parameter.
        $search = '%' . $managementSearch->search . '%';

        // Select count from database table "application_apps".
        $query = 'SELECT COUNT(*) FROM application_apps WHERE (xt_name LIKE ? OR xt_description LIKE ?)';
        $this->count = $database->count($query, [$search, $search]);

        // Prepare parameters.
        $this->areas = round($this->count / $managementSearch->number + 0.49999999999);
        if ($managementSearch->area > $this->areas || $managementSearch->area < 1) {
            $managementSearch->updateArea(1);
        }
        $this->start = $managementSearch->area - 5;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $managementSearch->area + 5;
        if ($this->end > $this->areas) {
            $this->end = $this->areas;
        }
        $offset = ($managementSearch->area - 1) * $managementSearch->number;

        // Select data from database table "application_apps".
        $query = 'SELECT xt_id FROM application_apps WHERE (xt_name LIKE ? OR xt_description LIKE ?) ORDER BY ' . $managementSearch->order .' LIMIT ' . $managementSearch->number . ' OFFSET ' . $offset;
        $array = $database->selectArray($query, [$search, $search]);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Get object "admin\apps\management__app".
        objects::get('admin/apps/management__app');

        // Initialize apps.
        for ($i = 0; $i < count($array); $i++) {
            $managementApp = objects::getNew('admin/apps/management__app');
            $managementApp->id = (int)$array[$i]['xt_id'];
            $managementApp->init();
            array_push($this->appsList, $managementApp);
        }
    }
}