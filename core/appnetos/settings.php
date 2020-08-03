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
 * @description     core/appnetos/settings.php ->    Settings class. Get custom settings by object "core\extension"
 *                  and override it at object "core\config".
 */

// Core.
namespace core;

// Class "core\settings".
class settings extends base
{

    /**
     * Used object "core\extensions".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * Used object "core\config" get on runtime.
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * settings constructor.
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
        // Get and set used objects.
        $this->_extensions = objects::get('extensions');

        // Get object "core\uri".
        $uri = objects::get('uri');

        // If is application.
        if (!$uri->getAdmin()) {
            $this->initSettingsApplication();
        }

        // If is admin section.
        else {
            $this->initSettingsApplication();
            $this->initSettingsAdmin();
        }
    }

    /**
     * Initialize settings application.
     */
    public function initSettingsApplication()
    {
        // Get extension cache settings.
        $extension = $this->_extensions->get('text', 1, 'appnetos/settings');

        // If extension exists.
        if ($extension) {

            // Get object "core\config".
            $this->_config = objects::get('config');

            // Set settings.
            $settings = json_decode($extension);
            $this->_config->setCacheExpire($settings->cacheExpire);
            $this->_config->setAppCache($settings->appCache);
            $this->_config->setFileCache($settings->fileCache);
            $this->_config->setDirectoryCache($settings->directoryCache);
            $this->_config->setStringCache($settings->stringCache);
            $this->_config->setJsCache($settings->jsCache);
            $this->_config->setCssCache($settings->cssCache);
            $this->_config->setMinify($settings->minify);
            $this->_config->setCompressor($settings->compressor);
            $this->_config->setDebug($settings->debug);
            $this->_config->setDebugAjax($settings->debugAjax);
        }
    }

    /**
     * Initialize settings admin section.
     */
    public function initSettingsAdmin()
    {
        // Get extension cache settings.
        $extension = $this->_extensions->get('text', 1, 'appnetos/settings');

        // If extension exists.
        if ($extension) {

            // Get object "core\config".
            $this->_config = objects::get('config');

            // Set settings.
            $settings = json_decode($extension);
            $this->_config->setExpertModeAdmin($settings->expertModeAdmin);
            $this->_config->setInfoAdmin($settings->infoAdmin);
        }
    }
}