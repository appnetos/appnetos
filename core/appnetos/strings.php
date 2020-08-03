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
 * @description     core/appnetos/strings.php ->    Strings class. Contains all string. Collects string in runtime and
 *                  cache it to sting cache files sorted by languages.
 */

// Namespace.
namespace core;

// Class "core\strings".
class strings extends base
{

    /**
     * Array of all app strings.
     *
     * @var array
     */
    protected $strings = [];

    /**
     * Array of directories language files are loaded.
     *
     * @var array.
     */
    protected $directories = [];

    /**
     * If cache file exists.
     *
     * @var bool.
     */
    protected $exists = false;

    /**
     * If content has changed.
     *
     * @var bool.
     */
    protected $changed = false;

    /**
     * Used object "core\languages".
     *
     * @var object.
     */
    protected $_languages = null;

    /**
     * Used object "core\files".
     *
     * @var object.
     */
    protected $_files = null;

    /**
     * Used if file cache is active from object "core\config".
     *
     * @var array.
     */
    protected $_cache = false;

    /**
     * Used path to cache file from object "core\config".
     *
     * @var string.
     */
    protected $_file = null;

    /**
     * Used active language key from object "core\languages".
     *
     * @var strings.
     */
    protected $_active = null;

    /**
     * Used if is admin section from object "core\uri".
     *
     * @var bool.
     */
    protected $_admin = null;

    /**
     * strings constructor.
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
        $this->_languages = objects::get('languages');
        $this->_files = objects::get('files');

        // Get used variables.
        $this->_active = $this->_languages->getActive();
        $config = objects::get('config');
        $this->_cache = $config->getStringCache();
        $this->_file = trim($config->getCacheDir(), "\\/") . '/strings_' . $this->_active . '.json';
        $uri = objects::get('uri');
        $this->_admin = $uri->getAdmin();

        // If cache is not active.
        if ($this->_admin) {
            $this->_cache = false;
        }
        if (!$this->_cache) {
            return;
        }

        // If cache file not exists.
        if (!file_exists($this->_file)) {
            return;
        }

        // Get cache file.
        $this->exists = true;
        $cache = json_decode(file_get_contents($this->_file));
        foreach ($cache as $key => $value) {
            $this->{$key} = (array)$value;
        }
    }

    /**
     * Add strings to array of strings.
     *
     * @param string $directory app directory.
     */
    public function add($directory)
    {
        // If application.
        if (!$this->_admin) {
            $this->applicationAdd($directory);
        }

        // If admin.
        else {
            $this->adminAdd($directory);
        }
    }

    /**
     * Application add strings to array of strings.
     *
     * @param string $directory app directory.
     */
    protected function applicationAdd($directory)
    {
        // If string already loaded.
        if (in_array($directory, $this->directories)) {
            return;
        }

        // Add directory to array directories.
        array_push($this->directories, $directory);

        // Prepare parameters.
        $strings = [];

        // Try loading global string file.
        $keyGlobal = 'global';
        $fileGlobal = $this->_files->getString($directory . 'strings/global.php');
        if ($fileGlobal) {
            include_once $fileGlobal;
            $this->strings = array_merge($this->strings, $strings);
            $this->changed = true;
        }

        // Try loading default string file by main language key.
        $keyDefault = $this->_languages->getDefault();
        if ($keyDefault !== $keyGlobal) {
            $keyDefaultMain = $this->_languages->getMainKey($keyDefault);
            if ($keyDefault !== $keyDefaultMain) {
                $fileDefaultMain = $this->_files->getString($directory . 'strings/' . $keyDefaultMain . '.php');
                if ($fileDefaultMain) {
                    include_once $fileDefaultMain;
                    $this->strings = array_merge($this->strings, $strings);
                    $this->changed = true;
                }
            }

            // Try loading default string file by language key.
            $fileDefault = $this->_files->getString($directory . 'strings/' . $keyDefault . '.php');
            if ($fileDefault) {
                include_once $fileDefault;
                $this->strings = array_merge($this->strings, $strings);
                $this->changed = true;
            }
        }

        // Try loading active string file by main language key.
        $keyActive = $this->_languages->getActive();
        if ($keyActive !== $keyGlobal && $keyActive !== $keyDefault) {
            $keyActiveMain = $this->_languages->getMainKey($keyActive);
            if ($keyActive !== $keyActiveMain) {
                $fileActiveMain = $this->_files->getString($directory . 'strings/' . $keyActiveMain . '.php');
                if ($fileActiveMain) {
                    include_once $fileActiveMain;
                    $this->strings = array_merge($this->strings, $strings);
                    $this->changed = true;
                }
            }

            // Try loading active string file by language key.
            $fileActive = $this->_files->getString($directory . 'strings/' . $keyActive . '.php');
            if ($fileActive) {
                include_once $fileActive;
                $this->strings = array_merge($this->strings, $strings);
                $this->changed = true;
            }
        }
    }

    /**
     * Admin section add strings to array of strings.
     *
     * @param string $directory app directory.
     */
    protected function adminAdd($directory)
    {
        // If string already loaded.
        if (in_array($directory, $this->directories)) {
            return;
        }

        // Add directory to array directories.
        array_push($this->directories, $directory);

        // Prepare parameters.
        $strings = [];

        // Try loading global string file.
        $keyGlobal = 'global';
        $fileGlobal = $this->_files->getString($directory . 'strings/global.php');
        if ($fileGlobal) {
            include_once $fileGlobal;
            $this->strings = array_merge($this->strings, $strings);
        }

        // Try loading default string file by main language key.
        $keyDefault = $this->_languages->getAdminDefault();
        if ($keyDefault !== $keyGlobal) {
            $keyDefaultMain = $this->_languages->getMainKey($keyDefault);
            if ($keyDefault !== $keyDefaultMain) {
                $fileDefaultMain = $this->_files->getString($directory . 'strings/' . $keyDefaultMain . '.php');
                if ($fileDefaultMain) {
                    include_once $fileDefaultMain;
                    $this->strings = array_merge($this->strings, $strings);
                }
            }

            // Try loading default string file by language key.
            $fileDefault = $this->_files->getString($directory . 'strings/' . $keyDefault . '.php');
            if ($fileDefault) {
                include_once $fileDefault;
                $this->strings = array_merge($this->strings, $strings);
            }
        }

        // Try loading active string file by main language key.
        $keyActive = $this->_languages->getAdminActive();
        if ($keyActive !== $keyGlobal && $keyActive !== $keyDefault) {
            $keyActiveMain = $this->_languages->getMainKey($keyActive);
            if ($keyActive !== $keyActiveMain) {
                $fileActiveMain = $this->_files->getString($directory . 'strings/' . $keyActiveMain . '.php');
                if ($fileActiveMain) {
                    include_once $fileActiveMain;
                    $this->strings = array_merge($this->strings, $strings);
                }
            }

            // Try loading active string file by language key.
            $fileActive = $this->_files->getString($directory . 'strings/' . $keyActive . '.php');
            if ($fileActive) {
                include_once $fileActive;
                $this->strings = array_merge($this->strings, $strings);
            }
        }
    }

    /**
     * Get string by key.
     *
     * @param string $key string key.
     * @return string.
     */
    public function get($key)
    {
        // If language key exists.
        if (isset($this->strings[$key])) {
            return $this->strings[$key];
        }

        // If language key not exist.
        return 'Warning: String not found "' . $key . '"';
    }

    /**
     * Clear strings cache.
     *
     * @return bool.
     * @throws exception.
     */
    public function clearCache()
    {
        // Get used objects.
        $uri = objects::get('uri');

        // If is not admin.
        if (!$uri->getAdmin()) {
            return false;
        }

        // If cache file not exists.
        if (!file_exists($this->_file)) {
            return false;
        }

        // If cache file exists.
        unlink($this->_file);
        return true;
    }

    /**
     * Destruct by object "core\destruct".
     *
     * @return bool.
     */
    public function destruct()
    {
        // If cache not active or no changes.
        if (!$this->_cache || !$this->changed) {
            return false;
        }

        // Save cache file.
        file_put_contents(BASEPATH . $this->_file, json_encode($this));

        // Return.
        return true;
    }
}