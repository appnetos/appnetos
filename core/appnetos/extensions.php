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
 * @description     core/appnetos/extension.php ->    Class for app extensions information stores in database table
 *                  "app_extensions" for related app data and app settings.
 */

// Namespace.
namespace core;

// Class "core\extensions".
class extensions extends base
{

    /**
     * Possible types to get.
     *
     * @param array.
     */
    protected $types = ['bool', 'tinyint', 'longtext', 'int', 'integer', 'varchar', 'text'];

    /**
     * Used object "core\database".
     *
     * @param object.
     */
    protected $_database = null;

    /**
     * extension constructor.
     */
    public function __construct()
    {
        // Get object "core\database".
        $this->_database = objects::get('database');
    }

    /**
     * Set data to database table "app_extensions".
     *
     * @param mixed $value bool or string or int.
     * @param string $type database row type.
     * @param int $index entry index.
     * @param string $key app key.
     * @return bool or int.
     * @throws exception. Errors: Wrong parameter error,
     *                            Key "$key" not exists error.
     */
    public function set($value, $type, $index = 0, $key = null)
    {
        // If key not exists.
        if (!$key) {

            // Get app from object "core\objects".
            $app = $this->getApp($key);
            $key = $app->key;
        }

        // If key not exists.
        if (!$key) {
            throw new exception('Key "$key" not exists error');
        }

        // Check parameters.
        $type = strtolower($type);
        if (!in_array($type, $this->types)) {
            throw new exception('Wrong parameter error. Error: $type must be "bool", "tinyint", "int", "integer", "varchar" or "text"');
        }

        // If type is "tinyint".
        if ($type === 'tinyint') {
            if (gettype($value) !== 'bool' && gettype($value) !== 'integer' && $value !== null) {
                throw new exception('Wrong parameter error. Error: $type is "tinyint" and $value ' . gettype($value));
            }
            if ($value === true) {
                $value = 1;
            }
            elseif ($value === false) {
                $value = 0;
            }
            if ($value < 0 || $value > 255) {
                throw new exception('Wrong parameter error. Error: if $type is "tinyint", "$value" has to be int 0-255');
            }
        }

        // If type is "int" or "integer".
        elseif ($type === 'int' || $type === 'integer') {
            $type = 'int';
        }

        // If type is "bool".
        elseif ($type === 'bool') {
            if (gettype($value) !== 'bool' && $value !== 0 && $value !== 1 && $value !== null) {
                throw new exception('Wrong parameter error. Error: $type is "bool" and $value ' . gettype($value));
            }
            if ($value === null) {
                $value = 0;
            }
            $type = 'tinyint';
        }

        // If type is "varchar" or "text".
        elseif ($type === 'varchar' || $type === 'text' || $type === 'longtext') {
            $value = (string)$value;
            if ($type === 'varchar' && strlen($value) > 255) {
                throw new exception('Wrong parameter error. Error: If $type is "varchar", "$value" has a length to have 0-255 characters');
            }
            elseif ($type === 'text' && strlen($value) > 65000) {
                throw new exception('Wrong parameter error. Error: If $type is "text", "$value" has a length to have 0-65000 characters');
            }
        }

        // Check index.
        if (gettype($index) !== 'integer' && gettype($index) !== null) {
            throw new exception('Wrong parameter error. Error: $index must be integer or null');
        }
        if (!$index) {
            $index = 0;
        }

        // Select data from database table "app_extensions".
        $query = 'SELECT xt_key FROM app_extensions WHERE xt_key=? AND xt_index=?';
        $row = $this->_database->selectRow($query, [md5($key), $index]);

        // Update data in database table "app_extensions".
        if ($row) {
            $query = 'UPDATE app_extensions SET xt_' . $type . '=? WHERE xt_key=? AND xt_index=?';
            return $this->_database->update($query, [$value, md5($key), $index]);
        }

        // Insert into database table "app_extensions".
        $query = 'INSERT INTO app_extensions (xt_key, xt_index, xt_' . $type . ') VALUES (?,?,?)';
        return $this->_database->insert($query, [md5($key), $index, $value]);
    }

    /**
     * Get data from database table "app_extensions".
     *
     * @param string $type database row type.
     * @param int $index entry index.
     * @param string $key app key.
     * @return mixed bool or int or string.
     * @throws exception. Errors: Wrong parameter error,
     *                            Key "$key" not exists error.
     */
    public function get($type, $index = 0, $key = null)
    {
        // If key not exists.
        if (!$key) {

            // Get app from object "core\objects".
            $app = $this->getApp($key);
            $key = $app->getKey();
        }

        // If key not exists.
        if (!$key) {
            throw new exception('Key "$key" not exists error');
        }

        // Check parameters.
        $type = strtolower($type);
        if (!in_array($type, $this->types)) {
            throw new exception('Wrong parameter error. Error: $type must be "bool", "tinyint", "int", "integer", "varchar" or "text"');
        }
        if ($type === 'integer') {
            $type = 'int';
        }
        if (gettype($index) !== 'integer' && gettype($index) !== null) {
            throw new exception('Wrong parameter error. Error: $index must be integer or null');
        }
        if ($index === null) {
            $index = 0;
        }

        // Select from database table "app_extensions".
        $query = 'SELECT xt_' . $type . ' FROM app_extensions WHERE xt_key=? AND xt_index=?';
        $row = $this->_database->selectRow($query, [md5($key), $index]);

        // If data exists.
        if ($row) {
            if ($type === 'bool') {
                return (bool)$row['xt_' . $type];
            }
            if ($type === 'tinyint' || $type === 'int') {
                return (int)$row['xt_' . $type];
            }
            return $row['xt_' . $type];
        }

        // Return.
        return false;
    }

    /**
     * Get app from object "core\objects" for set data to database.
     *
     * @param string $key app key.
     * @return object.
     * @throws exception. Error: App not found error.
     */
    protected function getApp($key)
    {
        // Get app.
        $app = objects::getApp($key);
        if (!$app) {
            throw new exception('App not found error. Error: Object ' . $key . ' not found');
        }
        return $app;
    }
}