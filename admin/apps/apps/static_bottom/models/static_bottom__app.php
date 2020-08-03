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
 * @description     Admin application to manage static bottom apps.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\static_bottom__app".
class static_bottom__app
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Position.
     *
     * @var int.
     */
    public $position = null;

    /**
     * First.
     *
     * @var bool.
     */
    public $first = false;

    /**
     * Last.
     *
     * @var bool.
     */
    public $last = false;

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Parsed name.
     *
     * @var string.
     */
    public $parsedName = null;

    /**
     * Directory.
     *
     * @var string.
     */
    public $directory = null;

    /**
     * Namespace.
     *
     * @var string.
     */
    public $namespace = null;

    /**
     * If is active.
     *
     * @var bool.
     */
    public $active = false;

    /**
     * If is static top.
     *
     * @var int.
     */
    public $staticTop = null;

    /**
     * If is static bottom.
     *
     * @var int.
     */
    public $staticBottom = null;

    /**
     * Description.
     *
     * @var string.
     */
    public $description = null;

    /**
     * If has widget.
     *
     * @var bool.
     */
    public $widget = false;

    /**
     * If is container app.
     *
     * @var bool.
     */
    public $container = false;

    /**
     * Container grid.
     *
     * @var string.
     */
    public $containerGrid = null;

    /**
     * Container-fluid CSS.
     *
     * @var string.
     */
    public $containerFluidCss = null;

    /**
     * Container CSS.
     *
     * @var string.
     */
    public $containerCss = null;

    /**
     * App CSS.
     *
     * @var string.
     */
    public $appCss = null;

    /**
     * Protected level.
     *
     * @var int.
     */
    public $protected = null;

    /**
     * Controllers
     *
     * @var int.
     */
    public $controllers = 0;

    /**
     * Models.
     *
     * @var int.
     */
    public $models = 0;

    /**
     * Views.
     *
     * @var int.
     */
    public $views = 0;

    /**
     * CSS.
     *
     * @var bool.
     */
    public $css = false;

    /**
     * JavaScript.
     *
     * @var bool.
     */
    public $js = false;

    /**
     * Admin controllers.
     *
     * @var int.
     */
    public $adminControllers = 0;

    /**
     * Admin models.
     *
     * @var int.
     */
    public $adminModels = 0;

    /**
     * Admin views.
     *
     * @var int.
     */
    public $adminViews = 0;

    /**
     * Admin CSS.
     *
     * @var bool.
     */
    public $adminCss = false;

    /**
     * Admin JavaScript.
     *
     * @var bool.
     */
    public $adminJs = false;

    /**
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * Initialize.
     */
    public function init()
    {
        // Initialize data.
        $this->initData();
        if ($this->error) {
            return;
        }

        // Initialize files.
        $this->initFiles();
    }

    /**
     * Initialize data.
     */
    protected function initData()
    {
        // Get used objects.
        $staticBottomAppsList = objects::get('admin/apps/static_bottom__apps_list');

        // Select from database table "application_apps".
        $database = objects::get('database');
        $query = 'SELECT * FROM application_apps WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set data to class.
        $parsedDirectory = str_replace(["/", "\\"], "/", $row['xt_directory']);
        $parsedDirectory = trim($parsedDirectory, '/');
        $parsedName = str_replace(' ', '_', strtolower($row['xt_name']));
        $this->parsedName = $parsedName;
        $this->directory = 'application/apps/' . $parsedDirectory . '/' . $parsedName . '/';
        $this->active = (bool)$row['xt_active'];
        $this->namespace = str_replace("/", "\\", $row['xt_namespace']);
        $this->name = $row['xt_name'];
        $this->description = $row['xt_description'];
        $this->widget = $row['xt_widget'];
        $this->container = (bool)$row['xt_container'];
        $this->containerGrid = $row['xt_container_grid'];
        if ($row['xt_container_fluid_css'] !== '') {
            $this->containerFluidCss = $row['xt_container_fluid_css'];
        }
        if ($row['xt_container_css'] !== '') {
            $this->containerCss = $row['xt_container_css'];
        }
        if ($row['xt_app_css'] !== '') {
            $this->appCss = $row['xt_app_css'];
        }
        $this->protected = (int)$row['xt_protected'];

        // Set static parameters.
        $indexes = array_keys($staticBottomAppsList->staticTop, $this->id);
        $this->staticTop = count($indexes);
        $indexes = array_keys($staticBottomAppsList->staticBottom, $this->id);
        $this->staticBottom = count($indexes);
    }

    /**
     * Initialize files.
     */
    protected function initFiles()
    {
        // Get controllers.
        if (file_exists($this->directory . '/application/controllers')) {
            $files = glob($this->directory . '/application/controllers/*.php');
            $this->controllers = count($files);
        }

        // Get models.
        if (file_exists($this->directory . '/application/models')) {
            $files = glob($this->directory . '/application/models/*.php');
            $this->models = count($files);
        }

        // Get views.
        if (file_exists($this->directory . '/application/views')) {
            $files = glob($this->directory . '/application/views/*.tpl');
            $this->views = count($files);
            $files = glob($this->directory . '/application/views/*.php');
            $this->views += count($files);
        }

        // Get CSS.
        if (file_exists($this->directory . '/application/css/' . $this->parsedName . '.css')) {
            $this->css = true;
        }

        // Get JavaScript.
        if (file_exists($this->directory . '/application/js/' . $this->parsedName . '.js')) {
            $this->js = true;
        }

        // Get admin controllers.
        if (file_exists($this->directory . '/admin/controllers')) {
            $files = glob($this->directory . '/admin/controllers/*.php');
            $this->adminControllers = count($files);
        }

        // Get models.
        if (file_exists($this->directory . '/admin/models')) {
            $files = glob($this->directory . '/admin/models/*.php');
            $this->adminModels = count($files);
        }

        // Get views.
        if (file_exists($this->directory . '/admin/views')) {
            $files = glob($this->directory . '/admin/views/*.tpl');
            $this->adminViews = count($files);
            $files = glob($this->directory . '/admin/views/*.php');
            $this->adminViews += count($files);
        }

        // Get CSS.
        if (file_exists($this->directory . '/admin/css/' . $this->parsedName . '.css')) {
            $this->adminCss = true;
        }

        // Get JavaScript.
        if (file_exists($this->directory . '/admin/js/' . $this->parsedName . '.js')) {
            $this->adminJs = true;
        }

        // Get widget.
        if (file_exists($this->directory . 'widget/views/' . $this->parsedName . '.tpl') || file_exists($this->directory . 'widget/views/' . $this->parsedName . '.php') || file_exists($this->directory . 'widget/views/' . $this->parsedName . '.html')) {
            $this->widget = true;
        }
    }
}