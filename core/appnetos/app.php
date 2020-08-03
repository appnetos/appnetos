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
 * @description     core/appnetos/app.php ->    App object. Contains all data from app. Get app data from database table
 *                  "application_apps" for application, widgets or admin section part or from database table
 *                  "admin_apps" for admin section. Contains CSS as string, JavaScript as string and rendered view as
 *                  string.
 */

// Namespace.
namespace core;

// Class "core\app".
class app extends base
{

    /**
     * App ID from database column "xt_id".
     *
     * @var int.
     */
    protected $id = null;

    /**
     * If app is active from database column "xt_active".
     *
     * @var bool.
     */
    protected $active = null;

    /**
     * App namespace from database column "xt_namespace".
     *
     * @var string.
     */
    protected $namespace = null;

    /**
     * App directory from database column "xt_directory".
     *
     * @var string.
     */
    protected $directory = null;

    /**
     * App name from database column "xt_name".
     *
     * @var string.
     */
    protected $name = null;

    /**
     * If app view in container from database column "xt_container".
     *
     * @var bool.
     */
    protected $container = false;

    /**
     * App container fluid css from database column "xt_container_fluid_css".
     *
     * @var string.
     */
    protected $containerFluidCss = null;

    /**
     * App container grid from database column "xt_container_grid".
     *
     * @var string.
     */
    protected $containerGrid = null;

    /**
     * App container CSS from database column "xt_container_css".
     *
     * @var string.
     */
    protected $containerCss = null;

    /**
     * App CSS from database column "xt_app_css".
     *
     * @var string.
     */
    protected $appCss = null;

    /**
     * Is app cache active from database column "xt_cache".
     *
     * @var bool.
     */
    protected $cache = false;

    /**
     * App cache time expire from database column "xt_cache_expire".
     *
     * @var int.
     */
    protected $cacheExpire = 3600;

    /**
     * Is JavaScript cache active from database column "xt_js_cache".
     *
     * @var bool.
     */
    protected $jsCache = false;

    /**
     * Is CSS cache active from database column "xt_css_cache".
     *
     * @var bool.
     */
    protected $cssCache = false;

    /**
     * App view string, template rendered to string.
     *
     * @var string.
     */
    protected $view = null;

    /**
     * App controller object, controller defined as object.
     *
     * @var object.
     */
    protected $controller = null;

    /**
     * App key namespace . "/" . name.
     *
     * @var string.
     */
    protected $key = null;

    /**
     * If app contains errors.
     *
     * @var bool.
     */
    protected $error = false;

    /**
     * Used object "core\cache".
     *
     * @var object.
     */
    protected $_cache = null;

    /**
     * Used object "core\render".
     *
     * @var object.
     */
    protected $_render = null;

    /**
     * Used object "core\files".
     *
     * @var object.
     */
    protected $_files = null;

    /**
     * app constructor.
     */
    public function __construct()
    {
        // Get and set used objects.
        $this->_cache = objects::get('cache');
        $this->_files = objects::get('files');
        $this->_render = objects::get('render');
    }

    /**
     * Initialize application app.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    public function initApplication($id)
    {
        // Initialize application app data from database.
        $this->initApplicationData($id);

        // If is error.
        if ($this->error) {
            return false;
        }

        // If app cache is active.
        if ($this->cache) {
            $this->getAppCache();
        }

        // Add application app directories to object "core\directories".
        $this->addApplicationDirectories();

        // Add CSS to object "core\css".
        $this->addCss();

        // Add JavaScript to object "core\js".
        $this->addJs();

        // If view exists.
        if ($this->view) {

            // Set container data.
            $this->setContainer();

            // Return.
            return true;
        }

        // Set app to object "core\objects".
        objects::setApp($this->key, $this);

        // Add strings to object "core\strings".
        $this->addStrings();

        // Set controller as object.
        $this->setController();

        // Render app view as string.
        $this->render();

        // Set container data.
        $this->setContainer();

        // If app cache is active.
        if ($this->cache) {
            $this->setCache();
        }

        // Return.
        return true;
    }

    /**
     * Initialize application app ajax request.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    public function initApplicationAjax($id)
    {
        // Initialize application app data from database.
        $this->initApplicationData($id);

        // If is error.
        if ($this->error) {
            return false;
        }

        // Set app at object "core\objects".
        objects::setApp($this->key, $this);

        // Add application app directories to object "core\directories".
        $this->addApplicationDirectories();

        // Add strings to object "core\strings".
        $this->addStrings();

        // Set controller as object.
        $this->setController();

        // Return.
        return true;
    }

    /**
     * Initialize application app data from database.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    protected function initApplicationData($id)
    {
        // Get app data from database table "application__apps".
        $database = objects::get('database');
        $query = 'SELECT xt_id, xt_active, xt_namespace, xt_directory, xt_name, xt_container, xt_container_fluid_css, xt_container_grid, xt_container_css, xt_app_css, xt_cache, xt_cache_expire, xt_js_cache, xt_css_cache FROM application_apps WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            $log =objects::get('log');
            $log->add ('App not exists error. ID: ' . $id);
            return false;
        }

        // Set data.
        $this->id = (int)($row['xt_id']);
        $this->active = (bool)$row['xt_active'];
        $this->namespace = trim($row['xt_namespace'], '\\/ ');
        $this->namespace = str_replace('/', '\\', $this->namespace);
        $this->directory = trim($row['xt_directory'], '\\/ ');
        $this->directory = str_replace('\\', '/', $this->directory);
        $this->name = trim($row['xt_name']);
        $this->name = str_replace(' ', '_', strtolower($this->name));
        $this->key = str_replace('\\', '/', $this->namespace) . '/' . $this->name;
        $this->container = (bool)$row['xt_container'];
        $this->containerGrid = trim($row['xt_container_grid']);
        $this->containerCss = trim($row['xt_container_css']);
        $this->containerFluidCss = trim($row['xt_container_fluid_css']);
        $this->appCss = trim($row['xt_app_css']);
        $this->cache = (bool)($row['xt_cache']);
        $this->cacheExpire = (int)($row['xt_cache_expire']);
        $this->jsCache = (bool)($row['xt_js_cache']);
        $this->cssCache = (bool)($row['xt_css_cache']);

        // Return.
        return true;
    }

    /**
     * Add application app directories to object "core\directories".
     */
    protected function addApplicationDirectories()
    {
        // Set directory.
        $directory = 'application/apps/' . $this->directory . '/' . $this->name . '/';
        $this->directory = 'application/apps/' . $this->directory . '/' . $this->name . '/application/';

        // Add directories to object "core\directories".
        $directories = objects::get('directories');
        $directories->setClass($directory . 'shared/controllers/');
        $directories->setClass($directory . 'shared/models/');
        $directories->setClass($directory . 'application/controllers/');
        $directories->setClass($directory . 'application/models/');
    }

    /**
     * Initialize admin app.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    public function initAdmin($id)
    {
        // Initialize admin app data from database.
        $this->initAdminData($id);

        // If is error.
        if ($this->error) {
            return false;
        }

        // If app cache is active.
        if ($this->cache) {
            $this->getCache();
        }

        // Add admin app directories to object "core\directories".
        $this->addAdminDirectories();

        // Add css to object "core\css".
        $this->addCss();

        // Add JavaScript to object "core\js".
        $this->addJs();

        // If view exists.
        if ($this->view) {

            // Set container data.
            $this->setContainer();

            // Return.
            return true;
        }

        // Set app at object "core\objects".
        objects::setApp($this->key, $this);

        // Add strings to object "core\strings".
        $this->addStrings();

        // Set controller as object.
        $this->setController();

        // Render app view as string.
        $this->render();

        // Set container data.
        $this->setContainer();

        // If app cache is active.
        if ($this->cache) {
            $this->setCache();
        }

        // Return.
        return true;
    }

    /**
     * Initialize admin app ajax request.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    public function initAdminAjax($id)
    {
        // Initialize admin app data from database.
        $this->initAdminData($id);

        // If is error.
        if ($this->error) {
            return false;
        }

        // Set app at object "core\objects".
        objects::setApp($this->key, $this);

        // Add admin app directories to object "core\directories".
        $this->addAdminDirectories();

        // Add strings to object "core\strings".
        $this->addStrings();

        // Set controller as object.
        $this->setController();

        // Return.
        return true;
    }

    /**
     * Initialize admin app data from database.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    protected function initAdminData($id)
    {
        // Get app data from database table "admin_apps".
        $database = objects::get('database');
        $query = 'SELECT xt_id, xt_active, xt_namespace, xt_directory, xt_name, xt_container, xt_container_grid, xt_container_css, xt_app_css, xt_cache, xt_cache_expire FROM admin_apps WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            $log =objects::get('log');
            $log->add ('App not exists error. ID: ' . $id);
            return false;
        }

        // Set data.
        $this->id = (int)($row['xt_id']);
        $this->active = $row['xt_active'];
        $this->namespace = trim($row['xt_namespace'], "\\/ ");
        $this->namespace = str_replace("/", "\\", $this->namespace);
        $this->directory = trim($row['xt_directory'], "\\/ ");
        $this->directory = str_replace("\\", "/", $this->directory);
        $this->name = trim($row['xt_name']);
        $this->name = str_replace(" ", "_", strtolower($this->name));
        $this->key = str_replace("\\", "/", $this->namespace) . "/" . $this->name;
        $this->container = (bool)$row['xt_container'];
        $this->containerGrid = trim($row['xt_container_grid']);
        $this->containerCss = trim($row['xt_container_css']);
        $this->appCss = trim($row['xt_app_css']);
        $this->cache = (bool)($row['xt_cache']);
        $this->cacheExpire = (int)($row['xt_cache_expire']);

        // Return.
        return true;
    }

    /**
     * Add admin app directories to object "core\directories".
     */
    protected function addAdminDirectories()
    {
        // Set directory.
        $appDirectory = null;
        if ($this->directory) {
            $appDirectory = $this->directory . '/';
        }
        $this->directory = 'admin/apps/' . $appDirectory . $this->name . '/';

        // Add class directories to object "core\directories".
        $directories = objects::get('directories');
        $directories->setClass($this->directory . 'controllers/');
        $directories->setClass($this->directory . 'models/');
    }

    /**
     * Initialize app admin app.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    public function initAppAdmin($id)
    {
        // Initialize app admin app data from database.
        $this->initAppAdminData($id);

        // If is error.
        if ($this->error) {
            return false;
        }

        // Set app to object "core\objects".
        objects::setApp($this->key, $this);

        // Add app admin app directories to object "core\directories".
        $this->addAppAdminDirectories();

        // Add strings to object "core\strings".
        $this->addStrings();

        // Add CSS to object "core\css".
        $this->addCss();

        // Add JavaScript to object "core\js".
        $this->addJs();

        // Set controller as object.
        $this->setController();

        // Render app view as string.
        $this->render();

        // Return.
        return true;
    }

    /**
     * Initialize app admin app ajax request.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    public function initAppAdminAjax($id)
    {
        // Initialize app admin app data from database.
        $this->initAppAdminData($id);

        // If is error.
        if ($this->error) {
            return false;
        }

        // Set app at object "core\objects".
        objects::setApp($this->key, $this);

        // Add app admin app directories to object "core\directories".
        $this->addAppAdminDirectories();

        // Add strings to object "core\strings".
        $this->addStrings();

        // Set controller as object.
        $this->setController();

        // Return.
        return true;
    }

    /**
     * Initialize app admin app data from database.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    protected function initAppAdminData($id)
    {
        // Get app data from database table "application_apps".
        $database = objects::get('database');
        $query = 'SELECT xt_id, xt_active, xt_namespace, xt_directory, xt_name FROM application_apps WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            $log = objects::get('log');
            $log->add ('App not exists error. ID: ' . $id);
            return false;
        }

        // Set data.
        $this->id = (int)($row['xt_id']);
        $this->active = (bool)$row['xt_active'];
        $this->namespace = trim($row['xt_namespace'], "\\/ ");
        $this->namespace = str_replace("/", "\\", $this->namespace);
        $this->directory = trim($row['xt_directory'], "\\/ ");
        $this->directory = str_replace("\\", "/", $this->directory);
        $this->name = trim($row['xt_name']);
        $this->name = str_replace(" ", "_", strtolower($this->name));
        $this->key = str_replace("\\", "/", $this->namespace) . "/" . $this->name;

        // Return.
        return true;
    }

    /**
     * Add app admin app directories to object "core\directories".
     */
    protected function addAppAdminDirectories()
    {
        // Set directory.
        $appDirectory = null;
        if ($this->directory) {
            $appDirectory = $this->directory . '/';
        }
        $directory = 'application/apps/' . $appDirectory . $this->name . "/";
        $this->directory = 'application/apps/' . $appDirectory . $this->name . "/admin/";

        // Add directories to object "core\directories".
        $directories = objects::get('directories');
        $directories->setClass($directory . 'shared/controllers/');
        $directories->setClass($directory . 'shared/models/');
        $directories->setClass($directory . 'admin/controllers/');
        $directories->setClass($directory . 'admin/models/');
    }

    /**
     * Initialize widget app.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    public function initWidget($id)
    {
        // Initialize widget app data from database.
        $this->initWidgetData($id);

        // If is error.
        if ($this->error) {
            return false;
        }

        // Set app at object "core\objects".
        objects::setApp($this->key, $this);

        // Add widget app directories to object "core\directories".
        $this->addWidgetDirectories();

        // Add strings to object "core\strings".
        $this->addStrings();

        // Add CSS to object "core\css".
        $this->addCss();

        // Add JavaScript to object "core\js".
        $this->addJs();

        // Set controller as object.
        $this->setController();

        // render app view to string.
        $this->render();

        // Return.
        return true;
    }

    /**
     * Initialize widget app ajax request.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    public function initWidgetAjax($id)
    {
        // Initialize widget app data from database.
        $this->initWidgetData($id);

        // If is error.
        if ($this->error) {
            return false;
        }

        // Set app at object "core\objects".
        objects::setApp($this->key, $this);

        // Add widget directories to object "core\directories".
        $this->addWidgetDirectories();

        // Add strings to object "core\strings".
        $this->addStrings();

        // Set controller as object.
        $this->setController();

        // Return.
        return true;
    }

    /**
     * Initialize widget app data from database.
     *
     * @param int $id app ID.
     * @return bool.
     * @throws exception.
     */
    protected function initWidgetData($id)
    {
        // Get app data from database table "application_apps".
        $database = objects::get('database');
        $query = 'SELECT xt_id, xt_active, xt_namespace, xt_directory, xt_name FROM application_apps WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            $log = objects::get('log');
            $log->add ('App not exists error. ID: ' . $id);
            return false;
        }

        // Set data.
        $this->id = (int)($row['xt_id']);
        $this->active = (bool)$row['xt_active'];
        $this->namespace = trim($row['xt_namespace'], "\\/ ");
        $this->namespace = str_replace("/", "\\", $this->namespace);
        $this->directory = trim($row['xt_directory'], "\\/ ");
        $this->directory = str_replace("\\", "/", $this->directory);
        $this->name = trim($row['xt_name']);
        $this->name = str_replace(" ", "_", strtolower($this->name));
        $this->key = str_replace("\\", "/", $this->namespace) . "/" . $this->name;

        // Return.
        return true;
    }

    /**
     * Add widget app directories to object "core\directories".
     */
    protected function addWidgetDirectories()
    {
        // Set directory.
        $appDirectory = null;
        if ($this->directory) {
            $appDirectory = $this->directory . '/';
        }
        $directory = 'application/apps/' . $appDirectory . $this->name . '/';
        $this->directory = 'application/apps/' . $appDirectory . $this->name . '/widget/';

        // Add directories to object "core\directories".
        $directories = objects::get('directories');
        $directories->setClass($directory . 'shared/controllers/');
        $directories->setClass($directory . 'shared/models/');
        $directories->setClass($directory . 'widget/controllers/');
        $directories->setClass($directory . 'widget/models/');
    }

    /**
     * Get app from cache.
     */
    protected function getAppCache() {

        // Get app from cache.
        $this->_cache = objects::get('cache');
        $this->view = $this->_cache->getApp($this->id, $this->namespace, $this->name);
    }

    /**
     * Set app to cache.
     */
    protected function setCache() {

        // Set app to cache.
        $this->_cache->setApp($this->view, $this->id, $this->namespace, $this->name, $this->cacheExpire);
    }

    /**
     * Add strings to object "core\strings".
     */
    protected function addStrings()
    {
        // Add strings.
        $strings = objects::get('strings');
        $strings->add($this->directory);
    }

    /**
     * Add CSS to object "core\css".
     */
    protected function addCss()
    {
        // Add CSS.
        $css = objects::get('css');
        $css->addAppCss($this->directory . 'css/' . $this->name . '.css', $this->cssCache);
    }

    /**
     * Add JavaScript to object "core\js".
     */
    protected function addJs()
    {
        // Add JavaScript.
        $js = objects::get('js');
        $js->addAppJs($this->directory . 'js/' . $this->name . '.js');
    }

    /**
     * Set controller or object as object.
     *
     * @return bool.
     * @throws.
     */
    protected function setController()
    {
        // Prepare parameters.
        $class = $this->namespace . "\\" . $this->name;

        // Get controller file over object files.
        $file = $this->_files->getClass($class);

        // If file not exists.
        if (!$file) {
            return false;
        }

        // Set controller.
        include_once BASEPATH . $file;
        $this->controller = objects::getNew($class);

        // If controller not exists.
        if (!$this->controller) {
            return false;
        }

        // Set object to object "core\objects".
        objects::set(str_replace("\\", "/", $class), $this->controller);

        // Assign controller to object "core\render".
        $assign = $this->name;
        if ($this->namespace !== '') {
            $namespace = str_replace("\\", "__", $this->namespace);
            $assign = $namespace . '__' . $this->name;
        }
        $this->_render->assign($assign, $this->controller);
        $this->_render->assign('view', $this->controller);

        // Return.
        return true;
    }

    /**
     * Render view to string.
     *
     * @return mixed.
     */
    protected function render()
    {
        // Get view file over object "core\files".
        $name = $this->directory . 'views/' . $this->name;
        $stdClass = $this->_files->getView($name, $this->id);

        // If file not exists.
        if (!$stdClass) {
            return false;
        }

        // Render from .tpl to string.
        if ($stdClass->extension === '.tpl') {
            $this->view = $this->_render->fetch($stdClass->file);
            return '.tpl';
        }

        // Render from .twig to string.
        if ($stdClass->extension === '.twig') {
            $this->view = $this->_render->fetch($stdClass->file);
            return '.twig';
        }

        // Render from .php or .html to string.
        if ($stdClass->extension === '.php' || $stdClass->extension === '.html') {
            $this->view = $this->_render->render($stdClass->file);
            return '.php';
        }
    }

    /**
     * Set container data.
     */
    protected function setContainer()
    {
        // If container is active and view exists.
        if ($this->container && $this->view) {

            // Set container CSS.
            if ($this->containerCss === '')  {
                $this->containerCss = null;
            }

            // Set container grid.
            if ($this->containerGrid === '') {
                $this->containerGrid = 'col-sm-12 col-md-12 col-lg-12 col-xl-12';
            }

            // Set app CSS to container grid.
            if ($this->appCss !== '') {
                $this->containerGrid .= ' ' . $this->appCss;
            }
        }

        // If container is not active or view not exists.
        else {

            // Set container data to null.
            $this->container = null;
            $this->containerCss = null;
            $this->containerGrid = null;
            $this->appCss = null;
        }
    }

    /**
     * Get app ID.
     *
     * @return int.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get if app is active.
     *
     * @return bool.
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get app namespace.
     *
     * @return string.
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Get app directory.
     *
     * @return string.
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * Get app name.
     *
     * @return string.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get if app view in container.
     *
     * @return bool.
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Get if container grid.
     *
     * @return string.
     */
    public function getContainerGrid()
    {
        return $this->containerGrid;
    }

    /**
     * Get container CSS.
     *
     * @return string.
     */
    public function getContainerCss()
    {
        return $this->containerCss;
    }

    /**
     * Get container fluid CSS.
     *
     * @return string.
     */
    public function getContainerFluidCss()
    {
        return $this->containerFluidCss;
    }

    /**
     * Get app CSS.
     *
     * @return string.
     */
    public function getAppCss()
    {
        return $this->appCss;
    }

    /**
     * Get if cache is active.
     *
     * @return bool.
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * Get cache time expire.
     *
     * @return int.
     */
    public function getCacheExpire()
    {
        return $this->cacheExpire;
    }

    /**
     * Get if JavaScript cache is active.
     *
     * @return bool.
     */
    public function getJsCache()
    {
        return $this->jsCache;
    }

    /**
     * Get if CSS cache is active.
     *
     * @return bool.
     */
    public function getCssCache()
    {
        return $this->cssCache;
    }

    /**
     * Get app view string, template rendered to string.
     *
     * @return string.
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Get app controller.
     *
     * @return object.
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Get app key.
     *
     * @return string.
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get if app has error.
     *
     * @return bool.
     */
    public function getError()
    {
        return $this->error;
    }
}