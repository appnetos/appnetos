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
 * @description     Admin application group picker. Open modal popup to pick an app ID.
 *                  Open:           "admin__groups__picker_application.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(APP ID);
 */

// Namespace.
namespace admin\groups;

// Use.
use \core\objects;

// Model "admin\groups\picker_application__group".
class picker_application__group
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Granted URIs.
     *
     * @var array.
     */
    public $granted = [];

    /**
     * Count grant URIs.
     *
     * @var int.
     */
    public $grantedCount = 0;

    /**
     * Denied URIs.
     *
     * @var array.
     */
    public $denied = [];

    /**
     * Count denied URIs.
     *
     * @var int.
     */
    public $deniedCount = 0;

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
        // Select from database table "application_groups".
        $database = objects::get('database');
        $query = 'SELECT xt_name, xt_granted, xt_denied FROM application_groups WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set data to class.
        $this->name = $row['xt_name'];
        if ($row['xt_granted']) {
            $this->granted = array_map('intval', explode('|', $row['xt_granted']));
            $this->grantedCount = count($this->granted);
        }
        if ($row['xt_denied']) {
            $this->denied = array_map('intval', explode('|', $row['xt_denied']));
            $this->deniedCount = count($this->denied);
        }
    }
}