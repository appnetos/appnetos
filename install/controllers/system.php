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
 * @description     install/controllers/system.php ->    APPNET OS installer controller "installer\system".
 */

// Namespace.
namespace installer;

// Controller "installer\system".
class system
{

    /**
     * system constructor.
     */
    public function __construct()
    {
        // Action.
        $this->action();

        // Get object "installer\render".
        $render = objects::get("render");

        // Render template.
        $render->render($this);
    }

    /**
     * Action.
     */
    public function action()
    {
        // Get POST parameters.
        if (!isset($_POST["action"])) {
            return;
        }

        // If go back.
        If ($_POST["action"] === "back") {

            // Get object "installer\settings".
            $settings = objects::get("settings")->settings;

            // Set part.
            $settings->part = "sql";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // If extend.
        If ($_POST["action"] === "extend") {

            // Get object "installer\settings".
            $settings = objects::get("settings")->settings;

            //Set extend
            $settings->systemExtend = false;
            if (isset($_POST["extend"])) {
                if ($_POST["extend"] === "on") {
                    $settings->systemExtend = true;
                }
            }

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // If action not system.
        if ($_POST["action"] !== "system") {
            return;
        }

        // Prepare parameters.
        $error = "";

        // Get object "installer\strings" and object "installer\settings".
        $strings = objects::get("strings")->strings;
        $settings = objects::get("settings")->settings;

        // Get POST parameters.
        $settings->prefix = str_replace(" ", "", $_POST["prefix"]);
        $settings->url = str_replace(" ", "", trim($_POST["url"], "/\\"));
        $settings->dir = str_replace(" ", "", trim($_POST["dir"], "/\\"));
        $settings->cacheDir = str_replace(" ", "", trim($_POST["cacheDir"], "/\\"));
        $settings->tmpDir = str_replace(" ", "", trim($_POST["tmpDir"], "/\\"));
        $settings->logDir = str_replace(" ", "", trim($_POST["logDir"], "/\\"));
        $settings->smartyComileDir = str_replace(" ", "", trim($_POST["smartyCompileDir"], "/\\"));
        $settings->smartyConfigDir = str_replace(" ", "", trim($_POST["smartyConfigDir"], "/\\"));
        if ($_POST["cookieLock"]) {
            $settings->cookieLock = true;
        }
        else {
            $settings->cookieLock = false;
        }
        if ($_POST["appCache"]) {
            $settings->appCache = true;
        }
        else {
            $settings->appCache = false;
        }
        if ($_POST["fileCache"]) {
            $settings->fileCache = true;
        }
        else {
            $settings->fileCache = false;
        }
        if ($_POST["directoryCache"]) {
            $settings->directoryCache = true;
        }
        else {
            $settings->directoryCache = false;
        }
        if ($_POST["stringCache"]) {
            $settings->stringCache = true;
        }
        else {
            $settings->stringCache = false;
        }
        if ($_POST["jsCache"]) {
            $settings->jsCache = true;
        }
        else {
            $settings->jsCache = false;
        }
        if ($_POST["cssCache"]) {
            $settings->cssCache = true;
        }
        else {
            $settings->cssCache = false;
        }
        if ($_POST["minify"]) {
            $settings->minify = true;
        }
        else {
            $settings->minify = false;
        }
        if ($_POST["expertMode"]) {
            $settings->expertMode = true;
        }
        else {
            $settings->expertMode = false;
        }
        $cacheExpire = $_POST["cacheExpire"];
        if (!is_numeric($cacheExpire)) {
            $cacheExpire = 3600;
        }
        else {
            $cacheExpire = (int)$cacheExpire;
        }
        if ($cacheExpire > 2580000) {
            $cacheExpire = 2580000;
        }
        if ($cacheExpire < 1) {
            $cacheExpire = 3600;
        }
        $settings->cacheExpire = $cacheExpire;
        $signInErrorCount = $_POST["signInErrorCount"];
        if (!is_numeric($signInErrorCount)) {
            $signInErrorCount = 10;
        }
        else {
            $signInErrorCount = (int)$signInErrorCount;
        }
        if ($signInErrorCount > 1000) {
            $signInErrorCount = 1000;
        }
        if ($signInErrorCount < 1) {
            $signInErrorCount = 10;
        }
        $settings->signInErrorCount = $signInErrorCount;
        $resetPasswordExpire = $_POST["resetPasswordExpire"];
        if (!is_numeric($resetPasswordExpire)) {
            $resetPasswordExpire = 21600;
        }
        else {
            $resetPasswordExpire = (int)$resetPasswordExpire;
        }
        if ($resetPasswordExpire < 1) {
            $resetPasswordExpire = 21600;
        }
        $settings->resetPasswordExpire = $resetPasswordExpire;
        if ($_POST["disableGroupsApplication"]) {
            $settings->disableGroupsApplication = true;
        }
        else {
            $settings->disableGroupsApplication = false;
        }
        if ($_POST["disableGroupsAdmin"]) {
            $settings->disableGroupsAdmin = true;
        }
        else {
            $settings->disableGroupsAdmin = false;
        }
        $authenticationLifetimeApplication = $_POST["authenticationLifetimeApplication"];
        if (!is_numeric($authenticationLifetimeApplication)) {
            $authenticationLifetimeApplication = 2592000;
        }
        else {
            $authenticationLifetimeApplication = (int)$authenticationLifetimeApplication;
        }
        if ($authenticationLifetimeApplication < 1) {
            $authenticationLifetimeApplication = 2592000;
        }
        $settings->authenticationLifetimeApplication = $authenticationLifetimeApplication;
        $sessionTimeoutApplication = $_POST["sessionTimeoutApplication"];
        if (!is_numeric($sessionTimeoutApplication)) {
            $sessionTimeoutApplication = 3600;
        }
        else {
            $sessionTimeoutApplication = (int)$sessionTimeoutApplication;
        }
        if ($sessionTimeoutApplication < 300) {
            $sessionTimeoutApplication = 300;
        }
        $settings->sessionTimeoutApplication = $sessionTimeoutApplication;
        $sessionTimeoutAdmin = $_POST["sessionTimeoutAdmin"];
        if (!is_numeric($sessionTimeoutAdmin)) {
            $sessionTimeoutAdmin = 3600;
        }
        else {
            $sessionTimeoutAdmin = (int)$sessionTimeoutAdmin;
        }
        if ($sessionTimeoutAdmin < 300) {
            $sessionTimeoutAdmin = 300;
        }
        $settings->sessionTimeoutAdmin = $sessionTimeoutAdmin;
        if ($_POST["compressor"]) {
            $settings->compressor = true;
        }
        else {
            $settings->compressor = false;
        }
        if ($_POST["debug"]) {
            $settings->debug = true;
        }
        else {
            $settings->debug = false;
        }
        $admin_languages = new \stdClass();
        $admin_languages->de = true;
        $admin_languages->en = true;
        $admin_languages->es = true;
        $admin_languages->fr = true;
        $admin_languages->it = true;
        $admin_languages->ru = true;
        $settings->admin_languages = $admin_languages;

        // Check prefix.
        if ($settings->prefix === "") {
            $error .= $strings["installer__prefix_error"] . "<br>";
        }
        else if (strlen($settings->prefix) !== 3) {
            $error .= $strings["installer__prefix_error_1"] . "<br>";
        }
        else if (!preg_match('/^[a-z]+$/', $settings->prefix)) {
            $error .= $strings["installer__prefix_error_1"] . "<br>";
        }
        else if (!$this->checkPrefix($settings->prefix)) {
            $error .= $strings["installer__prefix_error_2"] . "<br>";
        }

        // If is error.
        if ($error !== "") {

            // Set error to settings.
            $settings->error = $error;

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // Set settings.
        $settings->error = null;
        $settings->part = "admin_languages";

        // Redirect.
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("Location: " . $link);
        die();
    }

    /**
     * Check prefix.
     *
     * @param string $prefix.
     * @return bool.
     */
    private function checkPrefix($prefix)
    {
        // get object "installer\database" and object "installer\settings".
        $database = objects::get("database");
        $settings = objects::get("settings")->settings;

        // Initialize database.
        $database->prefix = $prefix;
        $database->dbType = $settings->dbType;
        $database->dbHost = $settings->dbHost;
        $database->dbName = $settings->dbName;
        $database->dbUser = $settings->dbUser;
        $database->dbPass = $settings->dbPass;
        $database->dbPort = $settings->dbPort;
        $database->connect();

        // Select from database "users";
        $query = "SELECT * FROM users LIMIT 1";
        $row = $database->selectRow($query);

        // If row not exists.
        if (!$row) {
            return true;
        }
    }
}