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
 * @description     install/models/settings.php ->    APPNET OS installer model "installer\settings".
 */

// Namespace.
namespace installer;

// Model "installer\settings".
class settings
{
    /**
     * Install settings as \stdClass.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * settings constructor.
     */
    public function __construct()
    {
        // If settings as SESSION already exists.
        if (isset($_SESSION["APPNETOS_SETTINGS"])) {
            $this->settings = json_decode($_SESSION["APPNETOS_SETTINGS"]);
        }

        // If settings not exists.
        else {

            // Set settings as \stdClass.
            $this->settings = new \stdClass();
            $this->settings->part = "language";
            $this->settings->language = "en";
            $this->settings->prefix = "xtr";
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url = str_replace("/install/", "", $url);
            $this->settings->url = $url;
            $dir = str_replace("\\", "/", __DIR__);
            $dir = str_replace("/install/models", "", $dir);
            $this->settings->dir = $dir;
            $this->settings->cacheDir = "cache";
            $this->settings->tmpDir = "tmp";
            $this->settings->logDir = "log";
            $this->settings->smartyCompileDir = "compile";
            $this->settings->smartyConfigDir = "config";
            $this->settings->error = null;
            $this->settings->systemExtend = false;
            $this->settings->appCache = true;
            $this->settings->cacheExpire = 3600;
            $this->settings->fileCache = true;
            $this->settings->directoryCache = true;
            $this->settings->stringCache = true;
            $this->settings->jsCache = false;
            $this->settings->cssCache = false;
            $this->settings->minify = false;
            $this->settings->expertMode = false;
            $this->settings->cookieLock = true;
            $this->settings->signInErrorCount = 10;
            $this->settings->userMin = false;
            $this->settings->mailMin = false;
            $this->settings->passMin = false;
            $this->settings->additional = null;
            $this->settings->resetPasswordExpire = 21600;
            $this->settings->compressor = false;
            $this->settings->disableGroupsApplication = false;
            $this->settings->authenticationLifetimeApplication = 2592000;
            $this->settings->sessionTimeoutApplication = 3600;
            $this->settings->disableGroupsAdmin = false;
            $this->settings->sessionTimeoutAdmin = 3600;
            $this->settings->debug = false;
        }
    }

    /**
     * settings destructor.
     */
    public function __destruct()
    {
        // Set settings to SESSION.
        $_SESSION["APPNETOS_SETTINGS"] = json_encode($this->settings);
    }
}