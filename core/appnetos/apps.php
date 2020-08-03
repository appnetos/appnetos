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
 * @description     core/appnetos/apps.php ->   Apps class. Contains all used application apps or admin section apps as
 *                  array of object "core\app". Render application by view "core/views/application.tpl" or admin section
 *                  by view "core/views/admin.tpl".
 */

// Namespace.
namespace core;

// Class "core\apps".
class apps extends base
{

    /**
     * Array of objects "core\app".
     *
     * @var array.
     */
    protected $apps = [];

    /**
     * If is AJAX request from object "core\uri".
     *
     * @var bool.
     */
    protected $_ajax = null;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * Add application apps as object "core\app".
     *
     * @param mixed $apps array with app IDs or app names, int with App ID, string with app name.
     * @throws.
     */
    public function addApplication($apps)
    {
        // Get if is AJAX request from object "core\uri".
        if ($this->_ajax === null) {
            $uri = objects::get('uri');
            $this->_ajax = $uri->getAjax();
        }

        // Add apps array of IDs or names.
        if (gettype($apps) === 'array') {
            for ($i = 0; $i < count($apps); $i++) {
                $this->addApplicationApp($apps[$i]);
            }
        }

        // Add app as int ID or string name.
        else {
            $this->addApplicationApp($apps);
        }
    }

    /**
     * Add application apps as object "core\app" by string or int.
     *
     * @param mixed $apps string or int app ID or name.
     * @throws.
     */
    protected function addApplicationApp($apps)
    {
        // Add app by int.
        if (gettype($apps) === 'integer') {

            // Set object "core\app".
            $app = objects::getNew('app');

            // If is AJAX request.
            if ($this->_ajax) {
                $app->initApplicationAjax($apps);
            }

            // If is not AJAX request.
            else {
                $app->initApplication($apps);
            }

            // If app is not active.
            if (!$app->getActive()) {
                return;
            }

            // Add app to array of apps.
            array_push($this->apps, $app);
        }

        // Add app by string.
        elseif (gettype($apps) === 'string') {

            // Get data of all apps by directory.
            if (!$this->_database) {
                $this->_database = objects::get('database');
            }
            $query = 'SELECT xt_id FROM application_apps WHERE xt_directory=? ORDER BY xt_id';
            $array = $this->_database->selectArray($query, [$apps]);

            // If data not exists.
            if (!$array) {
                return;
            }

            // Recursive add apps by int.
            for ($i = 0; $i < count($array); $i++) {
                $this->addApplicationApp((int)$array[$i]['xt_id']);
            }
        }
    }

    /**
     * Render application.
     */
    public function renderApplication()
    {
        // Define template.
        $uri = objects::get('uri');
        $status = $uri->getStatus();
        if ($status) {
            $template = 'core/views/' . $status . '.tpl';
        }
        else {
            $template = 'core/views/application.tpl';
        }

        // Render template.
        $render = objects::get('render');
        $render->assign('core__apps', $this);
        $render->display($template);
    }

    /**
     * Add admin section apps as object "core\app".
     *
     * @param mixed $apps array with app IDs or app name, int with app ID, string with app name.
     * @throws.
     */
    public function addAdmin($apps)
    {
        // Get if is AJAX request from object "core\uri".
        if ($this->_ajax === null) {
            $uri = objects::get('uri');
            $this->_ajax = $uri->getAjax();
        }

        // Add apps array of IDs or names.
        if (gettype($apps) === 'array') {
            for ($i = 0; $i < count($apps); $i++) {
                $this->addAdminApp($apps[$i]);
            }
        }

        // Add app as int ID or string name.
        else {
            $this->addAdminApp($apps);
        }
    }

    /**
     * Add admin section app as object "core\app" by string or int.
     *
     * @param mixed $apps string or int app Id or name.
     * @throws.
     */
    protected function addAdminApp($apps)
    {
        // Add app by int.
        if (gettype($apps) === 'integer') {

            // Set object "core\app".
            $app = objects::getNew('app');
            array_push($this->apps, $app);

            // If is AJAX request.
            if ($this->_ajax) {
                $app->initAdminAjax($apps);
            }

            // If is not AJAX request.
            else {
                $app->initAdmin($apps);
            }
        }

        // Add app by string.
        elseif (gettype($apps) === 'string') {

            // Get data of all apps by directory from database table "admin_apps".
            if (!$this->_database) {
                $this->_database = objects::get('database');
            }
            $query = 'SELECT xt_id FROM admin_apps WHERE xt_name=? ORDER BY xt_id';
            $array = $this->_database->selectArray($query, [$apps]);

            // If data not exists.
            if (!$array) {
                return;
            }

            // Recursive add apps by int.
            for ($i = 0; $i < count($array); $i++) {
                $this->addAdminApp((int)$array[$i]['xt_id']);
            }
        }
    }

    /**
     * Render admin section.
     */
    public function renderAdmin()
    {
        // Define template.
        $template = 'core/views/admin.tpl';
        $render = objects::get('render');
        $render->assign('core__apps', $this);
        $render->display($template);
    }

    /**
     * Add app admin section apps as object "core\app".
     *
     * @param mixed $apps array with app IDs or app name, int with app ID, string with app name.
     * @throws.
     */
    public function addAppAdmin($apps)
    {
        // Get if is AJAX request from object "core\uri".
        if ($this->_ajax === null) {
            $uri = objects::get('uri');
            $this->_ajax = $uri->getAjax();
        }

        // Add apps array of IDs or names.
        if (gettype($apps) === 'array') {
            for ($i = 0; $i < count($apps); $i++) {
                $this->addAppAdminApp($apps[$i]);
            }
        }

        // Add app as int ID or string name.
        else {
            $this->addAppAdminApp($apps);
        }
    }

    /**
     * Add app admin section app as object "core\app".
     *
     * @param mixed $apps string or int app ID or name.
     * @throws.
     */
    protected function addAppAdminApp($apps)
    {
        // Add app by int.
        if (gettype($apps) === 'integer') {

            // Set object "core\app".
            $app = objects::getNew('app');
            array_push($this->apps, $app);

            // If is AJAX request.
            if ($this->_ajax) {
                $app->initAppAdminAjax($apps);
            }

            // If is not AJAX request.
            else {
                $app->initAppAdmin($apps);
            }
        }

        // Add app by string.
        elseif (gettype($apps) === 'string') {

            // Get data of all apps by directory from database table "application_apps".
            if (!$this->_database) {
                $this->_database = objects::get('database');
            }
            $query = 'SELECT xt_id FROM application_apps WHERE xt_directory=? ORDER BY xt_id';
            $array = $this->_database->selectArray($query, [$apps]);

            // If data exists.
            if (!$array) {
                return;
            }

            // Recursive add apps by int.
            for ($i = 0; $i < count($array); $i++) {
                $this->addAppAdminApp((int)$array[$i]['xt_id']);
            }
        }
    }

    /**
     * Get rendered views of apps.
     *
     * @return string.
     */
    public function renderViews()
    {
        $buffer = '';
        foreach ($this->apps as $app) {
            if ($app->view) {
                $buffer .= $app->view . "\n";
            }
        }
        return $buffer;
    }

    /**
     * Get new object "core\container".
     *
     * @return object.
     * @throws.
     */
    public function getContainer()
    {
        return objects::getNew('container');;
    }

    /**
     * Get array of app objects.
     *
     * @return array.
     */
    public function getApps()
    {
        return $this->apps;
    }
}