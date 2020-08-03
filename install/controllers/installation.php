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
 * @description     install/controllers/installation.php ->    APPNET OS installer controller "installer\installation".
 */

// Namespace.
namespace installer;

// Model "installer\installation".
class installation
{

    /**
     * Object "installer\settings".
     *
     * @var object.
     */
    public $settings = null;

    /**
     * Object "installer\database".
     *
     * @var object.
     */
    public $database = null;

    /**
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * installation constructor.
     */
    public function __construct()
    {
        // Get object "installer\settings" and object "installer\database".
        $this->settings = objects::get("settings")->settings;
        $this->database = objects::get("database");

        // Initialize database.
        $this->initDatabase();

        // Install system.
        $this->installSystem();

        // Install application.
        $this->installApplication();

        // Create user.
        $this->createUser();

        // Copy files.
        $this->copyFiles();

        // Delete install directories and project directories.
        $directory = dirname(__FILE__);
        $directory = str_replace('install/controllers', '.git', $directory);
        if (is_dir($directory)) {
            $this->rrmdir($directory);
        }
        $directory = dirname(__FILE__);
        $directory = str_replace('install/controllers', '.idea', $directory);
        if (is_dir($directory)) {
            $this->rrmdir($directory);
        }
        $directory = dirname(__FILE__);
        $directory = str_replace('/controllers', '', $directory);
        if (is_dir($directory)) {
            $this->rrmdir($directory);
        }

        // Delete readme file.
        $file = dirname(__FILE__);
        $file = str_replace('install/controllers', 'README.md', $file);
        if (file_exists($file)) {
            unlink($file);
        }

        // Destroy SESSION.
        session_destroy();
    }

    /**
     * Initialize database.
     */
    private function initDatabase()
    {
        $this->database->prefix = $this->settings->prefix;
        $this->database->dbType = $this->settings->dbType;
        $this->database->dbHost = $this->settings->dbHost;
        $this->database->dbName = $this->settings->dbName;
        $this->database->dbUser = $this->settings->dbUser;
        $this->database->dbPass = $this->settings->dbPass;
        $this->database->dbPort = $this->settings->dbPort;
        $this->database->connect();
    }

    /**
     * Install system.
     */
    private function installSystem()
    {
        // Get SQL for system.
        $queries = [];
        include ("sql/system.php");

        // Get URI.
        $uri = trim($_SERVER["REQUEST_URI"], "/");
        $uri = str_replace("/install", "", $uri);

        // Modify all queries and execute.
        foreach ($queries as $query) {
            $query = str_replace("***PREFIX***", $this->settings->prefix, $query);
            $query = str_replace("***LANGDE***", $this->boolToIntString($this->settings->admin_languages->de), $query);
            $query = str_replace("***LANGEN***", $this->boolToIntString($this->settings->admin_languages->en), $query);
            $query = str_replace("***LANGES***", $this->boolToIntString($this->settings->admin_languages->es), $query);
            $query = str_replace("***LANGFR***", $this->boolToIntString($this->settings->admin_languages->fr), $query);
            $query = str_replace("***LANGIT***", $this->boolToIntString($this->settings->admin_languages->it), $query);
            $query = str_replace("***LANGRU***", $this->boolToIntString($this->settings->admin_languages->ru), $query);
            $query = str_replace("***URI***", $uri, $query);
            $this->database->execute($query);
        }
    }

    /**
     * Install application.
     */
    private function installApplication()
    {
        // Get SQL for application.
        $queries = [];
        include ("sql/application.php");

        // Get URI.
        $uri = trim($_SERVER["REQUEST_URI"], "/");
        $uri = str_replace("/install", "", $uri);

        // Modify all queries and execute.
        foreach ($queries as $query) {
            $query = str_replace("***PREFIX***", $this->settings->prefix, $query);
            $query = str_replace("***URI***", $uri, $query);
            $this->database->execute($query);
        }
    }

    /**
     * Create user.
     */
    private function createUser()
    {
        // Prepare parameters.
        $userLower = strtolower($this->settings->user);
        $passSalt = md5(uniqid());
        $pass = md5(md5($this->settings->pass) . $passSalt);
        $ip = $_SERVER['REMOTE_ADDR'];
        $ts = time();

        // Get SQL for user.
        $queries = [];
        include ("sql/user.php");

        // Modify all queries and execute.
        foreach ($queries as $query) {
            $query = str_replace("***PREFIX***", $this->settings->prefix, $query);
            $query = str_replace("***USER***", $this->settings->user, $query);
            $query = str_replace("***USERLOWER***", $userLower, $query);
            $query = str_replace("***PASS***", $pass, $query);
            $query = str_replace("***PASSSALT***", $passSalt, $query);
            $query = str_replace("***MAIL***", $this->settings->mail, $query);
            $query = str_replace("***IP***", $ip, $query);
            $query = str_replace("***TS***", $ts, $query);
            $this->database->execute($query);
        }
    }

    /**
     * Copy files.
     */
    private function copyFiles()
    {
        // Create "config.inc.php".
        $file = file_get_contents("files/config.inc.txt");
        $file = str_replace("***DBTYPE***", $this->settings->dbType, $file);
        $file = str_replace("***DBHOST***", $this->settings->dbHost, $file);
        $file = str_replace("***DBNAME***", $this->settings->dbName, $file);
        $file = str_replace("***DBUSER***", $this->settings->dbUser, $file);
        $file = str_replace("***DBPASS***", $this->settings->dbPass, $file);
        $file = str_replace("***DBPORT***", $this->settings->dbPort, $file);
        $file = str_replace("***DBCHARSET***", "utf8", $file);

        $file = str_replace("***PREFIX***", $this->settings->prefix, $file);
        $file = str_replace("***URL***", $this->settings->url, $file);
        $file = str_replace("***DIR***", $this->settings->dir, $file);
        $file = str_replace("***CACHEDIR***", $this->settings->cacheDir, $file);
        $file = str_replace("***TMPDIR***", $this->settings->tmpDir, $file);
        $file = str_replace("***LOGDIR***", $this->settings->logDir, $file);
        $file = str_replace("***SMARTYCOMPILEDIR***", $this->settings->smartyCompileDir, $file);
        $file = str_replace("***SMARTYCONFIGDIR***", $this->settings->smartyConfigDir, $file);

        $file = str_replace("***APPCACHE***", $this->boolToString($this->settings->appCache), $file);
        $file = str_replace("***CACHEEXPIRE***", $this->settings->cacheExpire, $file);
        $file = str_replace("***FILECACHE***", $this->boolToString($this->settings->fileCache), $file);
        $file = str_replace("***DIRECTORYCACHE***", $this->boolToString($this->settings->directoryCache), $file);
        $file = str_replace("***STRINGCACHE***", $this->boolToString($this->settings->stringCache), $file);
        $file = str_replace("***JSCACHE***", $this->boolToString($this->settings->jsCache), $file);
        $file = str_replace("***CSSCACHE***", $this->boolToString($this->settings->cssCache), $file);

        $file = str_replace("***MINIFY***", $this->boolToString($this->settings->minify), $file);
        $file = str_replace("***EXPERTMODE***", $this->boolToString($this->settings->expertMode), $file);
        $file = str_replace("***COOKIELOCK***", $this->boolToString($this->settings->cookieLock), $file);
        $file = str_replace("***SIGNINERRORCOUNT***", $this->settings->signInErrorCount, $file);

        $file = str_replace("***COMPRESSOR***", $this->boolToString($this->settings->compressor), $file);
        $file = str_replace("***RESETPASSWORDEXPIRE***", $this->settings->resetPasswordExpire, $file);
        $file = str_replace("***DISABLEGROUPSAPPLICATION***", $this->boolToString($this->settings->disableGroupsApplication), $file);
        $file = str_replace("***DISABLEGROUPSADMIN***", $this->boolToString($this->settings->disableGroupsAdmin), $file);
        $file = str_replace("***AUTHENTICATIONLIFETIMEAPPLICATION***", $this->settings->authenticationLifetimeApplication, $file);
        $file = str_replace("***SESSIONTIMEOUTAPPLICATION***", $this->settings->sessionTimeoutApplication, $file);
        $file = str_replace("***SESSIONTIMEADMIN***", $this->settings->sessionTimeoutAdmin, $file);
        $file = str_replace("***DEBUG***", $this->boolToString($this->settings->debug), $file);
        $file = str_replace("***DEBUGAJAX***", $this->boolToString($this->settings->debugAjax), $file);

        file_put_contents("../config.inc.php", $file);

        // Create ".htaccess".
        $file = file_get_contents("files/htaccess.txt");
        $uri = trim($_SERVER["REQUEST_URI"], "/");
        $uri = str_replace("/install", "", $uri);
        $file = str_replace("***URI***", $uri, $file);

        file_put_contents("../.htaccess", $file);

        // Copy root files.
        copy("files/index.php", "../index.php");
        copy("files/config.local.php", "../config.local.php");
        copy("files/include.php", "../include.php");
    }

    /**
     * Convert bool to string.
     *
     * @param bool $bool.
     * @return string.
     */
    private function boolToString($bool)
    {
        if ($bool) {
            return "true";
        }
        return "false";
    }

    /**
     * Convert bool to int string.
     *
     * @param bool $bool.
     * @return string.
     */
    private function boolToIntString($bool)
    {
        if ($bool) {
            return "1";
        }
        return "0";
    }

    /**
     * Recursive delete directory.
     *
     * @param $dir.
     */
    protected function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                        $this->rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                    else
                        unlink($dir. DIRECTORY_SEPARATOR .$object);
                }
            }
            rmdir($dir);
        }
    }
}