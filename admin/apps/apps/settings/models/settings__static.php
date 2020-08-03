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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Namespace.
namespace admin\apps;

// Model "admin\settings\settings__static".
use core\objects;

class settings__static
{

    /**
     * Static apps on top.
     *
     * @var array.
     */
    public $staticTop = [];

    /**
     * Static apps on bottom.
     *
     * @var array.
     */
    public $staticBottom = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__settings__static', $this);

        // Get model objects.
        $database = objects::get('database');

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
    }
}