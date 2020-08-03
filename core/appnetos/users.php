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
 * @description     core/appnetos/users.php ->    Class for user information. Get user information from database table
 *                  "users" and cache in \stdClass.
 */

// Namespace.
namespace core;

// Class "core\users".
Class users extends base
{

    /**
     * User information.
     *
     * @var \stdClass.
     */
    protected $users = null;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * user constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Get used objects.
        $this->users = new \stdClass();
        $this->_database = objects::get('core\database');
    }

    /**
     * Get user.
     *
     * @param int $id user ID.
     * @return bool.
     */
    protected function getUserData($id)
    {
        // Select from database table "users".
        $query = 'SELECT xt_id, xt_user, xt_mail, xt_image, xt_active, xt_ts_first, xt_ts_last, xt_locked, xt_group, xt_data FROM application_users WHERE xt_id=? AND xt_deleted=?';
        $row = $this->_database->selectRow($query, [$id, 0]);

        // If user not exists.
        if (!$row) {
            return false;
        }

        // Set user as \stdClass.
        $user = new \stdClass();
        $user->id = (int)$row['xt_id'];
        $user->user = $row['xt_user'];
        $user->mail = $row['xt_mail'];
        $user->image = $row['xt_image'];
        $user->active = (bool)$row['xt_active'];
        $user->tsFirst = (int)$row['xt_ts_first'];
        $user->tsLast = (int)$row['xt_ts_last'];
        $user->locked = (bool)$row['xt_locked'];
        $user->group = (int)$row['xt_group'];
        $user->data = json_decode($row['xt_data'], true);
        $this->users->{$user->id} = $user;

        // Return.
        return true;
    }

    /**
     * Get user by user ID.
     *
     * @param string $id.
     * @param bool $assoc.
     * @return mixed.
     */
    public function getUser($id, $assoc = false)
    {
        // Get user.
        if (!isset($this->users->{$id})) {
            $this->getUserData($id);
        }
        if (!isset($this->users->{$id})) {
            return false;
        }

        // Return user as array.
        if ($assoc) {
            return (array)$this->users->{$id};
        }

        // Return user as \stdClass.
        return $this->users->{$id};
    }

    /**
     * Get user data by user ID.
     *
     * @param int $id user ID.
     * @param string $data to return.
     * @return mixed.
     */
    public function getData($id, $data)
    {
        // Get user.
        if (!isset($this->users->{$id})) {
            $this->getUserData($id);
        }
        if (!isset($this->users->{$id})) {
            return false;
        }

        // Return user information if information exists.
        if (isset($this->users->{$id}->{$data})) {
            $this->users->{$id}->{$data};
        }

        // Return user data if information not exists.
        if (isset($this->users->{$id}->{'data'}[$data])) {
            return $this->users->{$id}->{'data'}[$data];
        }

        // Return.
        return false;
    }
}