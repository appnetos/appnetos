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
 * @description     Admin section dashboard widget to show apps information.
 */

// Namespace.
namespace appnetos\widgets;

// Use.
use core\objects;

// Controller "appnetos\widgets\widget_apps".
class widget_apps
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Apps total.
     *
     * @var int.
     */
    public $total = 0;

    /**
     * Apps active.
     *
     * @var int.
     */
    public $active = 0;

    /**
     * Apps static top.
     *
     * @var int.
     */
    public $staticTop = 0;

    /**
     * Apps static_bottom.
     *
     * @var int.
     */
    public $staticBottom = 0;

    /**
     * widget_apps constructor.
     */
    public function __construct()
    {
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp()->getId();

        // Get object "core\database".
        $database = objects::get('database');

        // Select from database table "application__apps".
        $query = 'SELECT xt_active FROM application_apps';
        $array = $database->selectArray($query);

        // Set data.
        if ($array) {
            $this->total = count($array);
            foreach ($array as $value) {
                if ((int)$value['xt_active']) {
                    $this->active++;
                }
            }
        }

        // Select from database table "application_static".
        $query = 'SELECT xt_top, xt_bottom FROM application_static WHERE xt_id=?';
        $row = $database->selectRow($query, [1]);

        // Set data.
        If ($row) {
            if ($row['xt_top']) {
                $staticTop = explode('|', $row['xt_top']);
                $this->staticTop = count($staticTop);
            }
            if ($row['xt_bottom']) {
                $staticBottom = explode('|', $row['xt_bottom']);
                $this->staticBottom = count($staticBottom);
            }
        }
    }
}