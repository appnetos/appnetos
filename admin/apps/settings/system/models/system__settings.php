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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 */

// Namespace.
namespace admin\settings;

// Use.
use core\objects;

// Model "admin\settings\system__settings".
class system__settings
{

    /**
     * Cache expire.
     *
     * @var int.
     */
    public $cacheExpire = 3600;

    /**
     * App cache.
     *
     * @var bool.
     */
    public $appCache = false;

    /**
     * File cache.
     *
     * @var bool.
     */
    public $fileCache = false;

    /**
     * Directory cache.
     *
     * @var bool.
     */
    public $directoryCache = false;

    /**
     * String cache.
     *
     * @var bool.
     */
    public $stringCache = false;

    /**
     * JavaScript cache.
     *
     * @var bool.
     */
    public $jsCache = false;

    /**
     * CSS cache.
     *
     * @var bool.
     */
    public $cssCache = false;

    /**
     * Minify.
     *
     * @var bool.
     */
    public $minify = false;

    /**
     * HTML source code compressor.
     *
     * @var bool.
     */
    public $compressor = false;

    /**
     * Debug.
     *
     * @var bool.
     */
    public $debug = false;

    /**
     * Debug AJAX.
     *
     * @var bool.
     */
    public $debugAjax = false;

    /**
     * Expert mode.
     *
     * @var bool.
     */
    public $expertModeAdmin = false;

    /**
     * Admin info.
     *
     * @var bool.
     */
    public $infoAdmin = true;

    /**
     * Object "core\extensions".
     *
     * @var object.
     */
    private $_extensions = null;

    /**
     * system__settings initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__settings__system__settings', $this);

        // Get settings.
        $this->_extensions = objects::get('extensions');
        $settings = $this->_extensions->get('text', 1, 'appnetos/settings');

        // If settings not exists.
        if (!$settings) {
            $this->getSet();
            return;
        }

        // Set settings.
        $array = json_decode($settings, true);
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Get settings from "core\config" and set.
     */
    protected function getSet()
    {
        // Get model "core\config".
        $config = objects::get('config');

        // Set settings by object "core\config".
        $this->cacheExpire = $config->getCacheExpire();
        $this->appCache = $config->getAppCache();
        $this->fileCache = $config->getFileCache();
        $this->directoryCache = $config->getDirectoryCache();
        $this->stringCache = $config->getStringCache();
        $this->jsCache = $config->getJsCache();
        $this->cssCache = $config->getCssCache();
        $this->minify = $config->getMinify();
        $this->compressor = $config->getCompressor();
        $this->debug = $config->getDebug();
        $this->debugAjax = $config->getDebugAjax();
        $this->expertModeAdmin = $config->getExpertModeAdmin();

        // Set settings.
        $this->set();
    }

    /**
     * Set settings.
     */
    protected function set()
    {
        $settings = json_encode($this);

        $this->_extensions->set($settings, 'text', 1, 'appnetos/settings');
    }

    /**
     * Update settings.
     */
    public function update()
    {
        // Get model "core\post".
        $post = objects::get('post');

        // Update settings.
        $cacheExpire = $post->get('admin__settings__system__cache_expire');
        if ($cacheExpire !== null) {
            $cacheExpire = (int)$cacheExpire;
            $this->cacheExpire = $cacheExpire;
        }

        $appCache = $post->get('admin__settings__system__app_cache');
        if ($appCache) {
            if ($appCache === 'on') {
                $this->appCache = true;
            }
            else {
                $this->appCache = false;
            }
        }

        $fileCache = $post->get('admin__settings__system__file_cache');
        if ($fileCache) {
            if ($fileCache === 'on') {
                $this->fileCache = true;
            }
            else {
                $this->fileCache = false;
            }
        }

        $directoryCache = $post->get('admin__settings__system__directory_cache');
        if ($directoryCache) {
            if ($directoryCache === 'on') {
                $this->directoryCache = true;
            }
            else {
                $this->directoryCache = false;
            }
        }

        $stringCache = $post->get('admin__settings__system__string_cache');
        if ($stringCache) {
            if ($stringCache === 'on') {
                $this->stringCache = true;
            }
            else {
                $this->stringCache = false;
            }
        }
        $jsCache = $post->get('admin__settings__system__js_cache');
        if ($jsCache) {
            if ($jsCache === 'on') {
                $this->jsCache = true;
            }
            else {
                $this->jsCache = false;
            }
        }
        $cssCache = $post->get('admin__settings__system__css_cache');
        if ($cssCache) {
            if ($cssCache === 'on') {
                $this->cssCache = true;
            }
            else {
                $this->cssCache = false;
            }
        }

        $minify = $post->get('admin__settings__system__minify');
        if ($minify) {
            if ($minify === 'on') {
                $this->minify = true;
            }
            else {
                $this->minify = false;
            }
        }

        $compressor = $post->get('admin__settings__system__compressor');
        if ($compressor) {
            if ($compressor === 'on') {
                $this->compressor = true;
            }
            else {
                $this->compressor = false;
            }
        }

        $debug = $post->get('admin__settings__system__debug');
        if ($debug) {
            if ($debug === 'on') {
                $this->debug = true;
            }
            else {
                $this->debug = false;
            }
        }

        $debugAjax = $post->get('admin__settings__system__debug_ajax');
        if ($debugAjax) {
            if ($debugAjax === 'on') {
                $this->debugAjax = true;
            }
            else {
                $this->debugAjax = false;
            }
        }

        $exportModeAdmin = $post->get('admin__settings__system__expert_mode');
        if ($exportModeAdmin) {
            if ($exportModeAdmin === 'on') {
                $this->expertModeAdmin = true;
            }
            else {
                $this->expertModeAdmin = false;
            }
        }

        $infoAdmin = $post->get('admin__settings__system__info');
        if ($infoAdmin) {
            if ($infoAdmin === 'on') {
                $this->infoAdmin = true;
            }
            else {
                $this->infoAdmin = false;
            }
        }

        //  Set settings.
        $this->set();
    }
}