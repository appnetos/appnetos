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
 * @description     install/controllers/database.php ->    APPNET OS installer controller "installer\database".
 */

// Namespace.
namespace installer;

// Controller "installer\database".
class database
{

    /**
     * Database type.
     *
     * @var string.
     */
    public $dbType = null;

    /**
     * Database host.
     *
     * @var string.
     */
    public $dbHost = null;

    /**
     * Database name.
     *
     * @var string.
     */
    public $dbName = null;

    /**
     * Database user name.
     *
     * @var string.
     */
    public $dbUser = null;

    /**
     * Database password.
     *
     * @var string.
     */
    public $dbPass = null;

    /**
     * Database charset.
     *
     * @var string.
     */
    public $dbCharset = "utf8";

    /**
     * Database prefix.
     *
     * @var string.
     */
    public $prefix = null;

    /**
     * Database PDO.
     *
     * @var object.
     */
    public $pdo = null;

    /**
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * Connect to database.
     *
     * Return string.
     */
    public function connect()
    {
        // Parameters.
        $error = null;

        // If database type mysql.
        if ($this->dbType === "mysql") {
            $dsn = "mysql:dbname=" . $this->dbName . ";host=" . $this->dbHost . ";charset=" . $this->dbCharset . ";port=" . $this->dbPort;
            try {
                $this->pdo = new \PDO($dsn, $this->dbUser, $this->dbPass);
                return;
            } catch (\PDOException $e) {
                $error = $e->getMessage();
                $this->pdo = null;
            }
        }

        // If database type postgresql.
        else if ($this->dbType === "postgresql") {
            $dsn = "pgsql:dbname=" . $this->dbName . ";host=" . $this->dbHost . ";charset=" . $this->dbCharset . ";user=" . $this->dbUser . ";password=" . $this->dbPass;
            try {
                $this->pdo = new \PDO($dsn);
                return;
            } catch (\PDOException $e) {
                $error = $e->getMessage();
                $this->pdo = null;
            }
        }

        // If is error.
        return $error;
    }

    /**
     * Select single row from database.
     *
     * @param string $query sql select query.
     * @param array $param sql prepared statements.
     * @param bool $prefix use prefix.
     * @return mixed.
     * @throws.
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
     * @throws.
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
     * @throws.
     */
    private function select($query, $param = [], $prefix, $array)
    {
        // If is error.
        if ($this->error) {
            return;
        }

        // Prepare parameters.
        $error = null;

        // Add prefix to query.
        if ($prefix) {
            $query = $this->addPrefix($query, "select");
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
            throw new exception("MySql select error.  Query:\"" . $query . "\"" . " Error:" . $error);
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
     * @throws.
     */
    public function insert($query, $param = [], $prefix = true)
    {
        // If is error.
        if ($this->error) {
            return;
        }

        // Prepare parameters.
        $error = null;
        $id = null;

        // Add prefix to query.
        if ($prefix) {
            $query = $this->addPrefix($query, "insert");
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
            throw new exception("MySql insert error.  Query:\"" . $query . "\"" . " Error:" . $error);
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
     * @param bool $error create error log.
     * @return bool.
     * @throws.
     */
    public function update($query, $param = [], $prefix = true, $error = true)
    {
        // If is error.
        if ($this->error) {
            return;
        }

        // Prepare parameters.
        $error = null;

        // Add prefix to query.
        if ($prefix) {
            $query = $this->addPrefix($query, "update");
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
            throw new exception("MySql update error.  Query:\"" . $query . "\"" . " Error:" . $error);
        }

        // Return.
        return true;
    }

    /**
     * Execute database.
     *
     * @param string $query sql update query.
     * @param array $param sql prepared statements.
     * @param bool $error create error log.
     * @return bool.
     * @throws.
     */
    public function execute($query, $param = [], $error = true)
    {
        // If is error.
        if ($this->error) {
            return;
        }

        // Prepare parameters.
        $error = null;

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
            throw new exception("MySql delete error.  Query:\"" . $query . "\"" . " Error:" . $error);
        }

        // Return.
        return true;
    }

    /**
     * Add prefix to database table.
     *
     * @param string $query query string to add prefix.
     * @param string $action database query action.
     * @return string.
     * @throws.
     */
    private function addPrefix($query, $action)
    {
        // String split.
        $split = null;

        // Generate split string.
        if ($action == "insert") {
            $split = " into ";
        } elseif ($action === "select" || $action === "delete" || $action === "count") {
            $split = " from ";
        } elseif ($action == "update") {
            $split = "update ";
        }

        // Split query.
        $tmp = mb_strtolower($query, mb_detect_encoding($query));
        $a = explode($split, $tmp);

        // If is error.
        if (count($a) === 1) {
            throw new exception("MySql add prefix error.  Query:\"" . $query);
        }

        // Add prefix.
        $i = strlen($a[0]);
        $start = substr($query, 0, ($i + strlen($split)));
        $end = substr($query, ($i + strlen($split)), strlen($query));
        $end = trim($end);
        $query = $start . $this->prefix . "_" . $end;
        return $query;
    }
}