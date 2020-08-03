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
 * @description     install/controllers/sql.php ->    APPNET OS installer controller "installer\sql".
 */

// Namespace.
namespace installer;

// Controller "installer\sql".
class sql
{

    /**
     * PHP Version.
     *
     * @var string.
     */
    public $version = null;

    /**
     * PDO extensions.
     *
     * @var array.
     */
    public $pdoExtensions = ["mysql" => "MySQL", "pgsql" => "PostgreSQL"];

    /**
     * Error Message.
     *
     * @var string.
     */
    public $error = "";


    /**
     * sql constructor.
     */
    public function __construct()
    {
        // Check system.
        $this->checkSystem();

        // Action.
        $this->action();

        // Get object "installer\render".
        $render = objects::get("render");

        // Render template.
        $render->render($this);
    }

    /**
     * Check system.
     */
    private function checkSystem()
    {
        // Get object "installer\strings".
        $strings = objects::get("strings")->strings;

        // Get PHP Version.
        $this->version = phpversion();
        if ((int)$this->version < 7) {
            $this->error .= $strings["installer__version_error"] . "<br>";
        }

        // Get if PDO extension is available.
        if (!extension_loaded("pdo")) {
            $this->error .= $strings["installer__pdo_error"] . "<br>";
        }
    }

    /**
     * Action.
     */
    private function action()
    {
        // Get POST parameters.
        if (!isset($_POST["action"])) {
            return;
        }

        // If go back.
        If ($_POST["action"] === "back") {

            // Get object languages.
            $languages = objects::get("languages");
            $languages->initLanguages();

            // Get object "installer\settings".
            $settings = objects::get("settings");

            // Set part.
            $settings->settings->part = "license";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // If action not sql.
        if ($_POST["action"] !== "sql") {
            return;
        }

        // Get object "installer\settings".
        $settings = objects::get("settings");

        // Get POST parameters.
        $settings->settings->dbType = $_POST["dbType"];
        $settings->settings->dbHost = $_POST["dbHost"];
        $settings->settings->dbName = $_POST["dbName"];
        $settings->settings->dbUser = $_POST["dbUser"];
        $settings->settings->dbPass = $_POST["dbPass"];
        $settings->settings->dbPort = $_POST["dbPort"];

        // Get object "installer\database".
        $database = objects::get("database");

        // Initialize database.
        $database->dbType = $settings->settings->dbType;
        $database->dbHost = $settings->settings->dbHost;
        $database->dbName = $settings->settings->dbName;
        $database->dbUser = $settings->settings->dbUser;
        $database->dbPass = $settings->settings->dbPass;
        $database->dbPort = $settings->settings->dbPort;

        // Connect to database.
        $error = $database->connect();

        // If is not error.
        if ($error) {

            // Set error.
            $settings->settings->error = "installer__connect_error";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // Check database prefix.
        for ($i = 0; $i < 1; $i = 0) {

            // Select from database "users";
            $database->prefix = $settings->settings->prefix;
            $query = "SELECT * FROM users LIMIT 1";
            $row = $database->selectRow($query);

            // If row not exists.
            if (!$row) {
                break;
            }

            // If row exists.
            $settings->settings->prefix = $this->randomString();
        }

        // Set settings.
        $settings->settings->error = null;
        $settings->settings->part = "system";

        // Redirect.
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("Location: " . $link);
        die();
    }

    /**
     * Generate random string.
     *
     * @param int $length.
     * @return string.
     */
    private function randomString($length = 3)
    {
        $characters = "abcdefghijklmnopqrstuvwxyz";
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}