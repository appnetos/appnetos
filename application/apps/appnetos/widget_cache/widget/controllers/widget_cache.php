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
 * @description     Admin section dashboard widget to show cache settings and cache options.
 */

// Namespace.
namespace appnetos\widgets;

// Use.
use core\objects;

// Controller "appnetos\widgets\widget_cache"
class widget_cache
{

    /**
     * Array of registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = [
        'clearAll',
        'clearData',
        'clearCompile',
        'clearJs',
        'clearCss',
        'clearFile',
        'clearDirectory',
        'clearString'
    ];

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * App cache.
     *
     * @param bool.
     */
    public $appCache = false;

    /**
     * If app cache files exists.
     *
     * @param bool.
     */
    public $dataCacheExists = false;

    /**
     * File cache.
     *
     * @param bool.
     */
    public $fileCache = false;

    /**
     * If file cache files exists.
     *
     * @param bool.
     */
    public $fileCacheExists = false;

    /**
     * Directory cache.
     *
     * @param bool.
     */
    public $directoryCache = false;

    /**
     * If directory cache files exists.
     *
     * @param bool.
     */
    public $directoryCacheExists = false;

    /**
     * String cache.
     *
     * @param bool.
     */
    public $stringCache = false;

    /**
     * If string cache files exists.
     *
     * @param bool.
     */
    public $stringCacheExists = false;

    /**
     * JavaScript cache.
     *
     * @param bool.
     */
    public $jsCache = false;

    /**
     * If JavaScript cache files exists.
     *
     * @param bool.
     */
    public $jsCacheExists = false;

    /**
     * CSS cache.
     *
     * @param bool.
     */
    public $cssCache = false;

    /**
     * If CSS cache files exists.
     *
     * @param bool.
     */
    public $cssCacheExists = false;

    /**
     * Confirm massage for AJAX.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     * Cache directory.
     *
     * @param string.
     */
    public $cacheDir = 'cache';

    /**
     * Smarty and twig compile directory.
     *
     * @param string.
     */
    public $compileDir = 'compile';

    /**
     * widget_cache constructor.
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

        // Get app ID by object "core\objects".
        $this->appId = objects::getApp()->getId();

        // Get objects.
        $config = objects::get('config');
        $database = objects::get('database');

        // Get config.
        $this->appCache = $config->getAppCache();
        $this->fileCache = $config->getFileCache();
        $this->directoryCache = $config->getDirectoryCache();
        $this->stringCache = $config->getStringCache();
        $this->jsCache = $config->getJsCache();
        $this->cssCache = $config->getCssCache();
        $this->cacheDir = $config->getCacheDir();
        $this->compileDir = $config->getCompileDir();

        // Check files.
        if (file_exists($this->cacheDir . '/files.json')) {
            $this->fileCacheExists = true;
        }
        if (file_exists($this->cacheDir . '/directories.json')) {
            $this->directoryCacheExists = true;
        }
        $files = glob($this->cacheDir . '/*');
        foreach ($files as $file) {
            if (strpos($file, 'strings_')) {
                $this->stringCacheExists = true;
                break;
            }
        }
        if (file_exists('out/css/main.min.css')) {
            $this->cssCacheExists = true;
        }
        if (file_exists('out/js/main.min.js')) {
            $this->jsCacheExists = true;
        }
        $query = 'SELECT COUNT(*) FROM cache';
        if ($database->count($query)) {
            $this->dataCacheExists = true;
        }
    }

    /**
     * AJAX request clear all caches.
     */
    public function clearAll()
    {
        // Get object "core\database" and object "core\config".
        $database = objects::get('database');
        $config = objects::get('config');

        // Clear all caches.
        if (is_dir($this->cacheDir)) {
            if (is_readable($this->cacheDir)) {
                if (!$this->isDirectoryEmpty($this->cacheDir)) {
                    $this->clearDirectoryContent($this->cacheDir);
                }
            }
        }
        if (file_exists('out/css/main.min.css')) {
            unlink('out/css/main.min.css');
        }
        if (file_exists('out/js/main.min.js')) {
            unlink('out/js/main.min.js');
        }
        if (is_dir($this->compileDir)) {
            if (is_readable($this->compileDir)) {
                if (!$this->isDirectoryEmpty($this->compileDir)) {
                    $this->clearDirectoryContent($this->compileDir);
                }
            }
        }
        $query = 'TRUNCATE TABLE ' . $config->prefix . '_application_cache';
        $database->execute($query);
        $this->fileCacheExists = false;
        $this->directoryCacheExists = false;
        $this->stringCacheExists = false;
        $this->cssCacheExists = false;
        $this->jsCacheExists = false;
        $this->dataCacheExists = false;

        // Render AJAX.
        $this->render(null, 'appnetos__widgets__cache__confirm');
    }

    /**
     * AJAX request clear app cache.
     */
    public function clearData()
    {
        // Get objects.
        $database = objects::get('database');
        $config = objects::get('config');

        // Truncate database table "cache".
        $query = 'TRUNCATE TABLE ' . $config->prefix . '_application_cache';
        $database->execute($query);
        $this->dataCacheExists = false;

        // Render AJAX template.
        $this->render(null, 'appnetos__widgets__cache__confirm');
    }

    /**
     * AJAX request clear compile directory.
     */
    public function clearCompile()
    {
        // Clear compile directory.
        if (is_dir($this->compileDir)) {
            if (is_readable($this->compileDir)) {
                if (!$this->isDirectoryEmpty($this->compileDir)) {
                    $this->clearDirectoryContent($this->compileDir);
                }
            }
        }

        // Render AJAX template.
        $this->render(null, 'appnetos__widgets__cache__confirm');
    }

    /**
     * AJAX request clear JavaScript cache.
     */
    public function clearJs()
    {
        // Delete "main.min.js".
        if (file_exists('out/js/main.min.js')) {
            unlink('out/js/main.min.js');
        }
        $this->jsCacheExists = false;

        // Render AJAX template.
        $this->render(null, 'appnetos__widgets__cache__confirm');
    }

    /**
     * AJAX request clear CSS cache.
     */
    public function clearCss()
    {
        // Delete "main.min.css".
        if (file_exists('out/css/main.min.css')) {
            unlink('out/css/main.min.css');
        }
        $this->cssCacheExists = false;

        // Render AJAX template.
        $this->render(null, 'appnetos__widgets__cache__confirm');
    }

    /**
     * AJAX request clear file cache.
     */
    public function clearFile()
    {
        // Delete file cache file.
        if (file_exists($this->cacheDir . '/files.json')) {
            unlink($this->cacheDir . '/files.json');
        }
        $this->fileCacheExists = false;

        // Render AJAX.
        $this->render(null, 'appnetos__widgets__cache__confirm');
    }

    /**
     * AJAX request clear directory cache.
     */
    public function clearDirectory()
    {
        // Delete file cache file.
        if (file_exists($this->cacheDir . '/directories.json')) {
            unlink($this->cacheDir . '/directories.json');
        }
        $this->directoryCacheExists = false;

        // Render AJAX.
        $this->render(null, 'appnetos__widgets__cache__confirm');
    }

    /**
     * AJAX request clear directory string.
     */
    public function clearString()
    {
        // Delete string cache files.
        $files = glob($this->cacheDir . '/*');
        foreach ($files as $file) {
            if (strpos($file, 'strings_')) {
                unlink($file);
            }
        }
        $this->stringCacheExists = false;

        // Render AJAX.
        $this->render(null, 'appnetos__widgets__cache__confirm');
    }

    /**
     * Check if directory is empty.
     *
     * @param string $directory.
     * @return bool.
     */
    protected function isDirectoryEmpty($directory)
    {
        $handle = opendir($directory);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != '.' && $entry != '..') {
                closedir($handle);
                return false;
            }
        }
        closedir($handle);
        return true;
    }

    /**
     * Clear directory content.
     *
     * @param $directory string.
     * @param $first bool.
     */
    protected function clearDirectoryContent($directory, $first = true)
    {
        if (is_dir($directory)) {
            $objects = scandir($directory);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($directory."/".$object) && !is_link($directory."/".$object))
                        $this->clearDirectoryContent($directory."/".$object, false);
                    else
                        unlink($directory."/".$object);
                }
            }
            if (!$first) {
                rmdir($directory);
            }
        }
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm.
     * @param string $error.
     * @throws \core\exception.
     */
    protected function render($error = null, $confirm = null) {

        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }
        $render->assign('appnetos__widgets__widget_cache', $this);

        // Render template.
        $render->include('application/apps/appnetos/widget_cache/widget/views/widget_cache__list.tpl');
    }
}