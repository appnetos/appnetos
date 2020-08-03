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
 * @description     Admin application to manage static bottom apps.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\static_bottom__apps_list".
class static_bottom__apps_list
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
        $render->assign('admin__apps__static_bottom__apps_list', $this);

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
        // Get object "admin\apps\static_bottom__app".
        objects::get('admin/apps/static_bottom__app');

        // Initialize apps.
        $this->appsList = [];
        $error = false;
        $array = [];
        for ($i = 0; $i < count($this->staticBottom); $i++) {
            $staticBottomApp = objects::getNew('admin/apps/static_bottom__app');
            $staticBottomApp->id = $this->staticBottom[$i];
            $staticBottomApp->position = $i;
            if ($i === 0) {
                $staticBottomApp->first = true;
            }
            if ($i === (count($this->staticBottom) - 1)) {
                $staticBottomApp->last = true;
            }

            $staticBottomApp->init();
            if (!$staticBottomApp->error) {
                array_push($this->appsList, $staticBottomApp);
                array_push($array, $this->staticBottom[$i]);
            }
            else {
                $error = true;
            }
        }

        // If apps has error.
        if ($error) {
            $query = 'UPDATE application_static SET xt_bottom=? WHERE xt_id=?';
            $database->update($query, [implode('|', $array), 1]);
            $this->init();
        }
    }
}