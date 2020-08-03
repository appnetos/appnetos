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
 * @description     Admin language management.
 */

// Namespace.
namespace admin\settings;

// Use.
use \core\objects;

// Model "admin\settings\manage_languages__languages_list".
class manage_languages__languages_list
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
    public $languagesList = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__settings__manage_languages__languages_list', $this);

        // Get used objects.
        $database = objects::get('database');
        $manageLanguagesSearch = objects::get('admin/settings/manage_languages__search');

        // Set search parameter.
        $search = '%' . $manageLanguagesSearch->search . '%';

        // Select count from database table "languages".
        $query = 'SELECT COUNT(*) FROM languages WHERE (xt_key LIKE ? OR xt_name LIKE ?) AND xt_key!=?';
        $this->count = $database->count($query, [$search, $search, 'global']);

        // Prepare parameters.
        $this->areas = round($this->count / $manageLanguagesSearch->number + 0.49999999999);
        if ($manageLanguagesSearch->area > $this->areas || $manageLanguagesSearch->area < 1) {
            $manageLanguagesSearch->updateArea(1);
        }
        $this->start = $manageLanguagesSearch->area - 5;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $manageLanguagesSearch->area + 5;
        if ($this->end > $this->areas) {
            $this->end = $this->areas;
        }
        $offset = ($manageLanguagesSearch->area - 1) * $manageLanguagesSearch->number;

        // Select data from database table "languages".
        $query = 'SELECT xt_id FROM languages WHERE (xt_key LIKE ? OR xt_name LIKE ?) AND xt_key!=? LIMIT ' . $manageLanguagesSearch->number . ' OFFSET ' . $offset;
        $array = $database->selectArray($query, [$search, $search, 'global']);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Get object "admin\settings\manage_languages__language".
        objects::get('admin/settings/manage_languages__language');

        // Initialize apps.
        for ($i = 0; $i < count($array); $i++) {
            $manageLanguagesLanguage = objects::getNew('admin/settings/manage_languages__language');
            $manageLanguagesLanguage->id = (int)$array[$i]['xt_id'];
            $manageLanguagesLanguage->init();
            array_push($this->languagesList, $manageLanguagesLanguage);
        }
    }
}