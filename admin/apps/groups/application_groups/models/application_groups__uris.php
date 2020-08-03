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
 * @description     Application user groups. Groups can be used to define which users can view which areas.
 */

// Namespace.
namespace admin\groups;

// Use.
use \core\objects;

// Model "admin\groups\application_groups__uris".
class application_groups__uris
{

    /**
     * Cached URIs.
     *
     * @var array.
     */
    protected $_uris = [];

    /**
     * Cached object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * application_groups__uris constructor.
     */
    public function __construct()
    {
        // Get and set used objects.
        $this->_database = objects::get('database');
    }

    /**
     * Get URI.
     *
     * @param int $id.
     * @return string.
     */
    public function get($id)
    {
        // If URI cached.
        if (isset($this->_uris[$id])) {
            return $this->_uris[$id];
        }

        // Select from database table "application_cms".
        $query = 'SELECT xt_uri FROM application_cms WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Set object to cache and return.
        $this->_uris[$id] = $row['xt_uri'];
        return $row['xt_uri'];
    }
}