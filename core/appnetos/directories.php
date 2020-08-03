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
 * @description     core/appnetos/directories.php ->    Directories cache. Contains all directory information separate
 *                  for application and admin section. Get directories from directories cache. Collects all directory at
 *                  runtime and add it to directories cache file.
 */

// Namespace.
namespace core;

// Class "core\directories".
class directories extends base
{

    /**
     * Cached class directories as \stdClass.
     *
     * @var \stdClass.
     */
    protected $class = null;

    /**
     * Cached custom class directories as \stdClass.
     *
     * @var \stdClass.
     */
    protected $customClass = null;

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
     * Used object "core/config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * If file cache is active from object "core\config".
     *
     * @var array.
     */
    protected $_cache = false;

    /**
     * Path to cache file from object "core\config".
     *
     * @var string.
     */
    protected $_file = null;

    /**
     * directories constructor.
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
        // Set parameters as \stdClass.
        $this->class = new \stdClass();
        $this->customClass = new \stdClass();

        // Get used variables from object "core\config".
        $this->_config = objects::get('config');
        $this->_cache = $this->_config->getDirectoryCache();
        $this->_file = trim($this->_config->getCacheDir(), "\\/") . '/directories.json';

        // If cache is not active.
        $uri = objects::get('uri');
        if ($uri->getAdmin()) {
            $this->_cache = false;
        }
        if (!$this->_cache) {
            return;
        }

        // If cache file not exists.
        if (!file_exists($this->_file)) {
            $this->initDirectories();
            return;
        }

        // Get cache file.
        $this->exists = true;
        $cache = json_decode(file_get_contents($this->_file));
        foreach ($cache as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Initialize directories.
     */
    protected function initDirectories()
    {
        // Add core directories.
        $this->setClass('core/appnetos');
        $this->setClass('core/smarty');

        // Add directories from core config.
        $directories = $this->_config->getDirectories();
        if (is_array($directories)) {
            foreach ($directories as $directory) {
                $this->setClass($directory);
            }
        }
    }

    /**
     * Add class directory.
     *
     * @param string $directory directory to add.
     */
    public function setClass($directory)
    {
        // Prepare parameters.
        $directory = str_replace("\\", "/", $directory);
        $directory = str_replace(BASEPATH, "", $directory);

        // If directory not is set.
        if (!isset($this->customClass->{$directory})) {
            if (is_dir(BASEPATH . 'custom/' . $directory)) {
                $this->customClass->{$directory} = 'custom/' . $directory;
            }
            else {
                $this->customClass->{$directory} = false;
            }
            $this->changed = true;
        }

        // If directory not is set.
        if (!isset($this->class->{$directory})) {
            if (is_dir(BASEPATH . $directory)) {
                $this->class->{$directory} = $directory;
            }
            else {
                $this->class->{$directory} = false;
            }
            $this->changed = true;
        }
    }

    /**
     * Get class directories.
     *
     * @return array.
     */
    public function getClass()
    {
        return (array)$this->class;
    }

    /**
     * Get custom class directories.
     *
     * @return array.
     */
    public function getCustomClass()
    {
        return (array)$this->customClass;
    }

    /**
     * Clear directories cache.
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