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
 * @description     Admin language settings.
 */

// Namespace.
namespace admin\settings;

// Use.
use core\get;
use \core\objects;

// Model "admin\settings\languages__languages_list".
class languages__languages_list
{

    /**
     * Count.
     *
     * @var int.
     */
    public $count = null;

    /**
     * Global title.
     *
     * @var string.
     */
    public $globalTitle = null;

    /**
     * Global favicon.
     *
     * @var string.
     */
    public $globalFavicon = null;

    /**
     * Default title.
     *
     * @var string.
     */
    public $defaultTitle = null;

    /**
     * Default favicon.
     *
     * @var string.
     */
    public $defaultFavicon = null;

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
        // Get used objects.
        $database = objects::get('database');

        // Get global data.
        $query = 'SELECT xt_title, xt_favicon FROM languages WHERE xt_key=?';
        $row = $database->selectRow($query, ['global']);
        if ($row) {
            $this->globalTitle = $row['xt_title'];
            $this->globalFavicon = $row['xt_favicon'];
        }

        // Get default data.
        $query = 'SELECT xt_title, xt_favicon FROM languages WHERE xt_default=?';
        $row = $database->selectRow($query, [1]);
        if ($row) {
            $this->defaultTitle = $row['xt_title'];
            $this->defaultFavicon = $row['xt_favicon'];
        }

        // Get data from database table "languages".
        $query = 'SELECT xt_id FROM languages WHERE xt_active=?';
        $array = $database->selectArray($query, [1]);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Set count.
        $this->count = count($array);

        // Get object "admin\settings\languages__language".
        objects::get('admin/settings/languages__language');

        // Initialize apps.
        for ($i = 0; $i < count($array); $i++) {
            $languagesLanguage = objects::getNew('admin/settings/languages__language');
            $languagesLanguage->id = (int)$array[$i]['xt_id'];
            $languagesLanguage->init();
            array_push($this->languagesList, $languagesLanguage);
        }
    }
}