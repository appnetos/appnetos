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
 * @description     core/appnetos/install.php ->    Class to help install apps. Collects app information and install
 *                  apps. Its necessary that apps use this installer.
 */

// Namespace.
namespace core;

// Class "core\install".
class install extends base
{

    /**
     * If app is active for database column "xt_active".
     *
     * @var bool.
     */
    protected $active = 1;

    /**
     * App namespace for database column "xt_namespace".
     *
     * @var string.
     */
    protected $namespace = '';

    /**
     * App directory for database column "xt_directory".
     *
     * @var string.
     */
    protected $directory = '';

    /**
     * App name for database column "xt_name".
     *
     * @var string.
     */
    protected $name = '';

    /**
     * App description for database column "xt_description".
     *
     * @var string.
     */
    protected $description = '';

    /**
     * If app view has a widget for database column "xt_container".
     *
     * @var int.
     */
    protected $widget = 0;

    /**
     * If app view in container for database column "xt_container".
     *
     * @var int.
     */
    protected $container = 0;

    /**
     * App container grid for database column "xt_container_grid".
     *
     * @var string.
     */
    protected $containerGrid = '';

    /**
     * App container CSS for database column "xt_container_css".
     *
     * @var string.
     */
    protected $containerCss = '';

    /**
     * App container fluid CSS for database column "xt_container_fluid_css".
     *
     * @var string.
     */
    protected $containerFluidCss = '';

    /**
     * App CSS for database column "xt_app_css".
     *
     * @var string.
     */
    protected $appCss = '';

    /**
     * Is app is cacheable for database column "xt_cacheable".
     *
     * @var int.
     */
    protected $cacheable = 0;

    /**
     * Is app cache active from database column "xt_cache".
     *
     * @var int.
     */
    protected $cache = 0;

    /**
     * App cache time expire for database column "xt_cache_expire".
     *
     * @var int.
     */
    protected $cacheExpire = 0;

    /**
     * Is JavaScript cache active for database column "xt_js_cache".
     *
     * @var int.
     */
    protected $jsCache = 1;

    /**
     * Is CSS cache active for database column "xt_css_cache".
     *
     * @var int.
     */
    protected $cssCache = 1;

    /**
     * Install app.
     *
     * @return int app ID.
     * @throws exception.
     */
    public function install()
    {
        // Prepare parameters.
        $this->namespace = trim($this->namespace);
        $this->name = trim($this->name);
        $this->directory = trim($this->directory, '\\/ ');
        $this->directory = str_replace('\\', '/', $this->directory);
        $this->description = trim($this->description);
        $this->containerGrid = trim($this->containerGrid);
        $this->containerCss = trim($this->containerCss);
        $this->appCss = trim ($this->appCss);
        $this->cacheExpire = (int)$this->cacheExpire;

        // Check parameters.
        if ((int)$this->active !== 1 && (int)$this->active !== 0) {
            return false;
        }
        if ($this->directory === '') {
            return false;
        }
        if ($this->name === '') {
            return false;
        }
        if ((int)$this->widget !== 1 && (int)$this->widget !== 0) {
            return false;
        }
        if ((int)$this->container !== 1 && (int)$this->container !== 0) {
            return false;
        }
        if ((int)$this->cacheable !== 1 && (int)$this->cacheable !== 0) {
            return false;
        }
        if ((int)$this->jsCache !== 1 && (int)$this->jsCache !== 0) {
            return false;
        }
        if ((int)$this->cssCache !== 1 && (int)$this->cssCache !== 0) {
            return false;
        }

        // Get object "core\database".
        $database = objects::get('database');

        // Insert app in database table "application_apps".
        $query = 'INSERT INTO application_apps(xt_active, xt_namespace, xt_directory, xt_name, xt_description, xt_widget, xt_container, xt_container_grid, xt_container_css, xt_container_fluid_css, xt_app_css, xt_cacheable, xt_cache, xt_cache_expire, xt_js_cache, xt_css_cache, xt_protected) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        return $database->insert($query, [(int)$this->active, (string)$this->namespace, (string)$this->directory, (string)$this->name, (string)$this->description, (int)$this->widget, (int)$this->container, (string)$this->containerGrid, (string)$this->containerCss, (string)$this->containerFluidCss, (string)$this->appCss, (int)$this->cacheable, (int)$this->cache, (int)$this->cacheExpire, (int)$this->jsCache, (int)$this->cssCache, 0]);
    }

    /**
     * Set active.
     *
     * @param mixed $active.
     * @return bool.
     */
    public function setActive($active)
    {
        if ($active === true || $active === 1) {
            $this->cache = 1;
            return true;
        }
        if ($active === false || $active === 0) {
            $this->cache = 0;
            return true;
        }
        return false;
    }

    /**
     * Set namespace.
     *
     * @param string $namespace.
     * @return bool.
     */
    public function setNamespace($namespace)
    {
        if (gettype($namespace) === 'string') {
            if (trim($namespace) !== '') {
                $this->namespace = trim($namespace);
                return true;
            }
        }
        return false;
    }

    /**
     * Set directory.
     *
     * @param string $directory.
     * @return bool.
     */
    public function setDirectory($directory)
    {
        if (gettype($directory) === 'string') {
            if (trim($directory) !== '') {
                $this->directory = trim($directory);
                return true;
            }
        }
        return false;
    }

    /**
     * Set name.
     *
     * @param string $name.
     * @return bool.
     */
    public function setName($name)
    {
        if (gettype($name) === 'string') {
            if (trim($name) !== '') {
                $this->name = trim($name);
                return true;
            }
        }
        return false;
    }

    /**
     * Set description.
     *
     * @param string $description.
     * @return bool.
     */
    public function setDescription($description)
    {
        if (gettype($description) === 'string') {
            if (trim($description) !== '') {
                $this->description = trim($description);
                return true;
            }
        }
        return false;
    }

    /**
     * Set widget.
     *
     * @param mixed $widget.
     * @return bool.
     */
    public function setWidget($widget)
    {
        if ($widget === true || $widget === 1) {
            $this->widget = 1;
            return true;
        }
        if ($widget === false || $widget === 0) {
            $this->widget = 0;
            return true;
        }
        return false;
    }

    /**
     * Set container.
     *
     * @param mixed $container.
     * @return bool.
     */
    public function setContainer($container)
    {
        if ($container === true || $container === 1) {
            $this->container = 1;
            return true;
        }
        if ($container === false || $container === 0) {
            $this->container = 0;
            return true;
        }
        return false;
    }

    /**
     * Set container grid.
     *
     * @param string $containerGrid.
     * @return bool.
     */
    public function setContainerGrid($containerGrid)
    {
        if (gettype($containerGrid) === 'string') {
            if (trim($containerGrid) !== '') {
                $this->containerGrid = trim($containerGrid);
                return true;
            }
        }
        return false;
    }

    /**
     * Set container CSS.
     *
     * @param string $containerCss.
     * @return bool.
     */
    public function setContainerCss($containerCss)
    {
        if (gettype($containerCss) === 'string') {
            if (trim($containerCss) !== '') {
                $this->containerCss = trim($containerCss);
                return true;
            }
        }
        return false;
    }

    /**
     * Set container fluid CSS.
     *
     * @param string $containerFluidCss.
     * @return bool.
     */
    public function setContainerFluidCss($containerFluidCss)
    {
        if (gettype($containerFluidCss) === 'string') {
            if (trim($containerFluidCss) !== '') {
                $this->containerFluidCss = trim($containerFluidCss);
                return true;
            }
        }
        return false;
    }

    /**
     * Set app CSS.
     *
     * @param string $appCss.
     * @return bool.
     */
    public function setAppCss($appCss)
    {
        if (gettype($appCss) === 'string') {
            if (trim($appCss) !== '') {
                $this->appCss = trim($appCss);
                return true;
            }
        }
        return false;
    }

    /**
     * Set cacheable.
     *
     * @param mixed $cacheable.
     * @return bool.
     */
    public function setCacheable($cacheable)
    {
        if ($cacheable === true || $cacheable === 1) {
            $this->cacheable = 1;
            return true;
        }
        if ($cacheable === false || $cacheable === 0) {
            $this->cacheable = 0;
            return true;
        }
        return false;
    }

    /**
     * Set cache.
     *
     * @param mixed $cache.
     * @return bool.
     */
    public function setCache($cache)
    {
        if ($cache === true || $cache === 1) {
            $this->cache = 1;
            return true;
        }
        if ($cache === false || $cache === 0) {
            $this->cache = 0;
            return true;
        }
        return false;
    }

    /**
     * Set cache expire.
     *
     * @param int $cacheExpire.
     * @return bool.
     */
    public function setCacheExpire($cacheExpire)
    {
        $cacheExpire = (int)$cacheExpire;
        if ($cacheExpire >= 0 && $cacheExpire <= 2592000) {
            $this->cacheExpire = $cacheExpire;
            return true;
        }
        return false;
    }

    /**
     * Set JavaScript Cache.
     *
     * @param int $jsCache.
     * @return bool.
     */
    public function setJsCache($jsCache)
    {
        if ($jsCache === true || $jsCache === 1) {
            $this->jsCache = 1;
            return true;
        }
        if ($jsCache === false || $jsCache === 0) {
            $this->jsCache = 0;
            return true;
        }
        return false;
    }

    /**
     * Set CSS Cache.
     *
     * @param int $cssCache.
     * @return bool.
     */
    public function setCssCache($cssCache)
    {
        if ($cssCache === true || $cssCache === 1) {
            $this->cssCache = 1;
            return true;
        }
        if ($cssCache === false || $cssCache === 0) {
            $this->cssCache = 0;
            return true;
        }
        return false;
    }
}