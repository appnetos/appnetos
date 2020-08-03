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
 * @description     Admin URI management to add and delete URIs.
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Model "admin\cms\uri_management__uris__list".
class uri_management__uris_list
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
    public $urisList = [];

    /**
     * AJAX error message.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * AJAX confirm message.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__cms__uri_management__uris_list', $this);

        // Get model objects.
        $database = objects::get('database');
        $uriManagementSearch = objects::get('admin/cms/uri_management__search');

        // Set search parameter.
        $search = '%' . $uriManagementSearch->search . '%';

        // Select count from database table "application_cms".
        $query = 'SELECT COUNT(*) FROM application_cms WHERE (xt_uri LIKE ? OR xt_title LIKE ?) AND xt_parent_id=?';
        $this->count = $database->count($query, [$search, $search, 0]);

        // Prepare parameters.
        $this->areas = round($this->count / $uriManagementSearch->number + 0.49999999999);
        if ($uriManagementSearch->area > $this->areas || $uriManagementSearch->area < 1) {
            $uriManagementSearch->updateArea(1);
        }
        $this->start = $uriManagementSearch->area - 5;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $uriManagementSearch->area + 5;
        if ($this->end > $this->areas) {
            $this->end = $this->areas;
        }
        $offset = ($uriManagementSearch->area - 1) * $uriManagementSearch->number;

        // Select data from database table "application_cms".
        $query = 'SELECT xt_id FROM application_cms WHERE (xt_uri LIKE ? OR xt_title LIKE ?) AND xt_parent_id=? ORDER BY ' . $uriManagementSearch->order .' LIMIT ' . $uriManagementSearch->number . ' OFFSET ' . $offset;
        $array = $database->selectArray($query, [$search, $search, 0]);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Get object "admin\cms\uri_management__uri".
        objects::get('admin/cms/uri_management__uri');

        // Initialize apps.
        for ($i = 0; $i < count($array); $i++) {
            $uriManagementUri = objects::getNew('admin/cms/uri_management__uri');
            $uriManagementUri->id = (int)$array[$i]['xt_id'];
            $uriManagementUri->init();
            array_push($this->urisList, $uriManagementUri);
        }
    }
}