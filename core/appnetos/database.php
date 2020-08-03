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
 * @description     core/appnetos/database.php ->    Database class, get database settings from object config, connect
 *                  to database and process all database actions.
 */

// Namespace.
namespace core;

// Class "core\database".
class database extends base
{

    /**
     * Database PDO.
     *
     * @var object.
     */
    protected $pdo = null;

    /**
     * If is error.
     *
     * @var bool.
     */
    protected $error = false;

    /**
     * Used object "core\config".
     */
    protected $_config = null;

    /**
     * Used prefix from object "core\config".
     *
     * @var string.
     */
    protected $_prefix = null;

    /**
     * database constructor.
     *
     * @throws exception.
     */
    public function __construct()
    {
        // Get and set used data.
        $this->getSet();

        // Connect to database.
        $this->connect();
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get data from object "core\config".
        $this->_config = objects::get('config');
        $this->_prefix = $this->_config->getPrefix();
    }

    /**
     * Connect to database.
     *
     * @throws exception. Error: MySql connect error.
     */
    protected function connect()
    {
        // Parameters.
        $error = null;

        // If database type mysql.
        if ($this->_config->getDbType() === 'mysql') {
            $dsn = 'mysql:dbname=' . $this->_config->getDbName() . ';host=' . $this->_config->getDbHost() . ';charset=' . $this->_config->getDbCharset() . ';port=' . $this->_config->getDbPort();
            try {
                $this->pdo = new \PDO($dsn, $this->_config->getDbUser(), $this->_config->getDbPass());
                return;
            } catch (\PDOException $exception) {
                $error = $exception->getMessage();
                $this->pdo = null;
            }
        }

        // If database type postgresql.
        elseif ($this->_config->getDbType() === 'postgresql') {
            $dsn = 'pgsql:dbname=' . $this->_config->getDbName() . ';host=' . $this->_config->getDbHost() . ';charset=' . $this->_config->getDbCharset() . ';user=' . $this->_config->getDbUser() . ';password=' . $this->_config->getDbPass();
            try {
                $this->pdo = new \PDO($dsn);
                return;
            } catch (\PDOException $exception) {
                $error = $exception->getMessage();
                $this->pdo = null;
            }
        }

        // If is error.
        throw new exception('MySql connect error "' . $error . '"');
    }

    /**
     * Select single row from database.
     *
     * @param string $query sql select query.
     * @param array $param sql prepared statements.
     * @param bool $prefix use prefix.
     * @return mixed.
     * @throws exception. Error: MySql select error.
     */
    public function selectRow($query, $param = [], $prefix = true)
    {
        return $this->select($query, $param, $prefix, false);
    }

    /**
     * Select multiple rows as array from database.
     *
     * @param string $query sql select query.
     * @param array $param sql prepared statements.
     * @param bool $prefix use prefix.
     * @return mixed.
     * @throws exception. Error: MySql select error.
     */
    public function selectArray($query, $param = [], $prefix = true)
    {
        return $this->select($query, $param, $prefix, true);
    }

    /**
     * Select from database.
     *
     * @param string $query sql select query.
     * @param array $param sql prepared statements.
     * @param bool $prefix use prefix.
     * @param bool $array return as array.
     * @return mixed.
     * @throws exception. Error: MySql select error.
     */
    protected function select($query, $param, $prefix, $array)
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Prepare parameters.
        $error = null;

        // Add prefix to query.
        if ($prefix) {
            $query = $this->addPrefix($query, 'select');
        }

        // Prepare PDO.
        $stmt = $this->pdo->prepare($query);

        // Try Execute parameters.
        try {
            $stmt->execute($param);
        }

        // Catch exception.
        catch (\PDOException $e) {
            $error = $e->getMessage();
        }

        // If is error.
        if ($error) {
            throw new exception('MySql select error. Query: "' . $query . '"' . ' Error: ' . $error);
        }

        // If no result.
        if (!$stmt->rowCount()) {
            return null;
        }

        // If return as row.
        if (!$array) {
            return $stmt->fetch();
        }

        // If return as array.
        else {
            return $stmt->fetchAll();
        }
    }

    /**
     * Update database.
     *
     * @param string $query sql update query.
     * @param array $param sql prepared statements.
     * @param bool $prefix use prefix.
     * @return mixed int or bool.
     * @throws exception. Error: MySql insert error.
     */
    public function insert($query, $param = [], $prefix = true)
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Prepare parameters.
        $error = null;
        $id = null;

        // Add prefix to query.
        if ($prefix) {
            $query = $this->addPrefix($query, 'insert');
        }

        // Prepare PDO.
        $stmt = $this->pdo->prepare($query);

        // Try execute parameters.
        try {
            $stmt->execute($param);
            $id = $this->pdo->lastInsertId();
        }

        // Catch exception.
        catch (\PDOException $e) {
            $error = $e->getMessage();
        }

        // If is error.
        if ($error) {
            throw new exception('MySql insert error. Query: "' . $query . '"' . ' Error: ' . $error);
        }

        // If has ID.
        if ($id) {
            return $id;
        }
        return true;
    }

    /**
     * Update database.
     *
     * @param string $query sql update query.
     * @param array $param sql prepared statements.
     * @param bool $prefix use prefix.
     * @return bool.
     * @throws exception. Error: MySql update error.
     */
    public function update($query, $param = [], $prefix = true)
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Prepare parameters.
        $error = null;

        // Add prefix to query.
        if ($prefix) {
            $query = $this->addPrefix($query, 'update');
        }

        // Prepare PDO.
        $stmt = $this->pdo->prepare($query);

        // Try execute parameter.
        try {
            $stmt->execute($param);
        }

        // Catch exception.
        catch (\PDOException $e) {
            $error = $e->getMessage();
        }

        // If is error.
        if ($error) {
            throw new exception('MySql update error. Query: "' . $query . '"' . ' Error: ' . $error);
        }

        // Return.
        return true;
    }

    /**
     * Delete database.
     *
     * @param string $query sql update query.
     * @param array $param sql prepared statements.
     * @param bool $prefix use prefix.
     * @return bool.
     * @throws exception. Error: MySql delete error.
     */
    public function delete($query, $param = [], $prefix = true)
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Prepare parameters.
        $error = null;

        // Add prefix to query.
        if ($prefix) $query = $this->addPrefix($query, 'delete');

        // Prepare PDO.
        $stmt = $this->pdo->prepare($query);

        // Try Execute parameter.
        try {
            $stmt->execute($param);
        }

        // Catch exception.
        catch (\PDOException $e) {
            $error = $e->getMessage();
        }

        // If is error.
        if ($error) {
            throw new exception('MySql delete error. Query: "' . $query . '"' . ' Error: ' . $error);
        }

        // Return.
        return true;
    }

    /**
     * Count database.
     *
     * @param string $query sql count query.
     * @param array $param sql prepared statements.
     * @param bool $prefix use prefix.
     * @return mixed int or bool.
     * @throws exception. Error: MySql count error.
     */
    public function count($query, $param = [], $prefix = true)
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Prepare parameters.
        $error = null;
        $count = null;

        // Add prefix to query.
        if ($prefix) $query = $this->addPrefix($query, 'count');

        // Prepare PDO.
        $stmt = $this->pdo->prepare($query);

        // Try execute parameter.
        try {
            $stmt->execute($param);
        }

        // Catch exception.
        catch (\PDOException $e) {
            $error = $e->getMessage();
        }

        // If is error.
        if ($error) {
            throw new exception('MySql count error. Query:"' . $query . '"' . ' Error: ' . $error);
        }

        // Return.
        return $stmt->fetchColumn();
    }

    /**
     * Execute database.
     *
     * @param string $query sql update query.
     * @param array $param sql prepared statements.
     * @return mixed.
     * @throws exception. Error: MySql execute error.
     */
    public function execute($query, $param = [])
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Prepare parameters.
        $error = null;
        $result = null;

        // Prepare PDO.
        $stmt = $this->pdo->prepare($query);

        // Try execute parameter.
        try {
            $result = $stmt->execute($param);
        }

        // Catch exception.
        catch (\PDOException $e) {
            $error = $e->getMessage();
        }

        // If is error.
        if ($error) {
            throw new exception('MySql execute error.  Query: "' . $query . '"' . ' Error: ' . $error);
        }

        // Return.
        if ($result) {
            return $result;
        }
        return true;
    }

    /**
     * Add prefix to database table.
     *
     * @param string $query query string to add prefix.
     * @param string $action database query action.
     * @return string.
     */
    protected function addPrefix($query, $action)
    {
        // String split.
        $split = null;

        // Generate split string.
        if ($action == 'insert') {
            $split = [' into ', ' join '];
        } elseif ($action === 'select' || $action === 'delete' || $action === 'count') {
            $split = [' from ', ' join '];
        } elseif ($action == 'update') {
            $split = ['update '];
        }

        // Add prefix.
        $result = '';
        foreach ($split as $value) {

            // Split query.
            $lower = mb_strtolower($query, mb_detect_encoding($query));
            $arraySource = explode($value, $lower);

            // If is error.
            if (count($arraySource) === 1) {
                continue;
            }

            // Prepare query.
            $arrayResult = [];
            $lengthStart = 0;
            $end = null;
            for ($i = 0; $i < (count($arraySource) - 1); $i++) {
                $length = strlen($arraySource[$i]);
                $lengthEnd = $length + strlen($value);
                $start = substr($query, $lengthStart, $lengthEnd);
                array_push($arrayResult, $start);
                $lengthStart += $length + strlen($value);
                $end = substr($query, $lengthStart, strlen($query));
            }
            $result = implode($this->_prefix . '_', $arrayResult) . $this->_prefix . '_' . $end;
            $query = $result;
        }

        return $result;
    }

    /**
     * Get PDO.
     *
     * @return object.
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}