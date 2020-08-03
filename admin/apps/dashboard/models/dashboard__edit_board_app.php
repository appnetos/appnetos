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
 * @description     Admin start page and dashboards.
 */

// Namespace.
namespace admin\dashboard;

// Use.
use \core\objects;

// Model "admin\dashboard\dashboard__edit_board_app".
class dashboard__edit_board_app
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Position.
     *
     * @var int.
     */
    public $position = null;

    /**
     * First.
     *
     * @var bool.
     */
    public $first = false;

    /**
     * Last.
     *
     * @var bool.
     */
    public $last = false;

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * If is active.
     *
     * @var bool.
     */
    public $active = false;

    /**
     * Description.
     *
     * @var string.
     */
    public $description = null;

    /**
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * Initialize.
     */
    public function init()
    {
        // Initialize data.
        $this->initData();
        if ($this->error) {
            return;
        }
    }

    /**
     * Initialize data.
     */
    protected function initData()
    {
        // Select from database table "application_apps".
        $database = objects::get('database');
        $query = 'SELECT xt_name, xt_description, xt_active FROM application_apps WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set data to class.
        $this->active = (bool)$row['xt_active'];
        $this->name = $row['xt_name'];
        $this->description = $row['xt_description'];
    }
}