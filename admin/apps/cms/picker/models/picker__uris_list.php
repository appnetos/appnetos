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
 * @description     Admin cms picker. Open modal popup to pick an URI ID.
 *                  Open:           "admin__cms__picker.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(URI ID);
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Controller "admin\cms\picker__uris_list".
class picker__uris_list
{

    /**
     * Count of search results.
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
     * URIs as model "admin\general\uri".
     *
     * @var array.
     */
    public $urisList = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__cms__picker__uris_list', $this);

        // Get model objects.
        $database = objects::get('database');
        $pickerSearch = objects::get('admin/cms/picker__search');

        // Set parameters.
        $search = '%' . $pickerSearch->search . '%';

        // Select count from database table "application_cms".
        $query = 'SELECT COUNT(*) FROM application_cms WHERE (xt_uri LIKE ? OR xt_title LIKE ?) AND xt_language_key=?';
        $this->count = $database->count($query, [$search, $search, 'global']);

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

        // Select parent contents from database table "application_cms".
        $query = 'SELECT xt_id, xt_uri FROM application_cms WHERE (xt_uri LIKE ? OR xt_title LIKE ?) AND xt_language_key=? ORDER BY ' . $pickerSearch->order .' LIMIT ' . $pickerSearch->number . ' OFFSET ' . $offset;
        $array = $database->selectArray($query, [$search, $search, 'global']);

        // If no entries.
        if (!$array) {
            return;
        }

        // Get URIs as model "admin\general\uri_picker__uri".
        objects::get('admin\cms\picker__uri');

        // Initialize URIs.
        for ($i = 0; $i < count($array); $i++) {
            $uri = objects::getNew('admin/cms/picker__uri');
            $uri->id = (int)$array[$i]['xt_id'];
            $uri->uri = $array[$i]['xt_uri'];
            $uri->init();
            array_push($this->urisList, $uri);
        }
    }

}