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
 * @description     Admin app overview and app management.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\management__app".
class management__app
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Raw database data.
     *
     * @var array.
     */
    public $data = null;

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
     * Strings.
     *
     * @var int.
     */
    public $strings = 0;

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
     * Admin string.
     *
     * @var int.
     */
    public $adminString = 0;

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
     * Events.
     *
     * @var array.
     */
    public $events = [];

    /**
     * Event install.
     *
     * @var bool.
     */
    public $eventInstall = false;

    /**
     * Event delete.
     *
     * @var bool.
     */
    public $eventDelete = false;

    /**
     * Event remove.
     *
     * @var bool.
     */
    public $eventRemove = false;

    /**
     * Event duplicate.
     *
     * @var bool.
     */
    public $eventDuplicate = false;

    /**
     * Event activate.
     *
     * @var bool.
     */
    public $eventActivate = false;

    /**
     * Event deactivate.
     *
     * @var bool.
     */
    public $eventDeactivate = false;

    /**
     * Event revert.
     *
     * @var bool.
     */
    public $eventRevert = false;

    /**
     * Class extensions.
     *
     * @var array.
     */
    public $extends = [];

    /**
     * Version.
     *
     * @var string.
     */
    public $version = null;

    /**
     * Version status.
     *
     * @var string.
     */
    public $status = null;

    /**
     * APPNET OS version.
     *
     * @var string.
     */
    public $appnetos = null;

    /**
     * Vendor name.
     *
     * @var string.
     */
    public $vendor = null;

    /**
     * Vendor web address.
     *
     * @var string.
     */
    public $web = null;

    /**
     * Vendor mail address.
     *
     * @var string.
     */
    public $mail = null;

    /**
     * Vendor author.
     *
     * @var string.
     */
    public $author = null;

    /**
     * Store API hash.
     *
     * @var string.
     */
    public $store = null;

    /**
     * App store image.
     *
     * @var string.
     */
    public $image = null;

    /**
     * App store description.
     *
     * @var string.
     */
    public $storeDescription = null;

    /**
     * App store license.
     *
     * @var string.
     */
    public $storeLicense = null;

    /**
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * AJAX error message.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * AJAX confirm message.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     * APPNETOS URL.
     *
     * @var string.
     */
    public $appnetosUrl = null;

    /**
     * Used object "core/config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * Used object "core/database".
     *
     * @var object.
     */
    protected $_database = null;

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
        // Prepare parameters.
        $this->appnetosUrl = APPNETOS_URL;

        // Get used objects.
        $this->_config = objects::get('config');
        $this->_database = objects::get('database');
        $managementAppsList = objects::get('admin/apps/management__apps_list');

        // Select from database table "application_apps".
        $query = 'SELECT * FROM application_apps WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set data to class.
        $this->data = $row;
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
        $indexes = array_keys($managementAppsList->staticTop, $this->id);
        $this->staticTop = count($indexes);
        $indexes = array_keys($managementAppsList->staticBottom, $this->id);
        $this->staticBottom = count($indexes);
    }

    /**
     * Initialize files.
     */
    protected function initFiles()
    {
        // Get used objects.
        $strings = objects::get('strings');
        $languages = objects::get('languages');

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

        // Get strings.
        if (file_exists($this->directory . '/application/string')) {
            $files = glob($this->directory . '/application/strings/*.php');
            $this->strings = count($files);
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

        // Get strings.
        if (file_exists($this->directory . '/admin/string')) {
            $files = glob($this->directory . '/admin/strings/*.php');
            $this->adminString = count($files);
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

        // Get event activate.
        if (file_exists($this->directory . 'admin/events/activate.php')) {
            $this->eventActivate = true;
            array_push($this->events, $strings->get('admin__apps__management__activate'));
        }

        // Get event deactivate.
        if (file_exists($this->directory . 'admin/events/deactivate.php')) {
            $this->eventDeactivate = true;
            array_push($this->events, $strings->get('admin__apps__management__deactivate'));
        }

        // Get event duplicate.
        if (file_exists($this->directory . 'admin/events/duplicate.php')) {
            $this->eventDuplicate = true;
            array_push($this->events, $strings->get('admin__apps__management__duplicate'));
        }

        // Get event revert.
        if (file_exists($this->directory . 'admin/events/revert.php')) {
            $this->eventRevert = true;
            array_push($this->events, $strings->get('admin__apps__management__revert'));
        }

        // Get event install.
        if (file_exists($this->directory . 'admin/events/install.php')) {
            $this->eventInstall = true;
            array_push($this->events, $strings->get('admin__apps__management__install'));
        }

        // Get event remove.
        if (file_exists($this->directory . 'admin/events/remove.php')) {
            $this->eventRemove = true;
            array_push($this->events, $strings->get('admin__apps__management__remove'));
        }

        // Get event delete.
        if (file_exists($this->directory . 'admin/events/delete.php')) {
            $this->eventDelete = true;
            array_push($this->events, $strings->get('admin__apps__management__delete'));
        }

        // Get class extensions.
        if (file_exists($this->directory . 'custom/extends.php')) {
            $extends = [];
            include ($this->directory . 'custom/extends.php');
            foreach ($extends as $extend) {
                $add = [];
                if (!isset($extend['key']) &&
                    !isset($extend['parent']) &&
                    !isset($extend['children']))
                {
                    continue;
                }
                $add['key'] = $extend['key'];
                $add['parent'] = $extend['parent'];
                $add['children'] = $extend['children'];
                if (!isset($extend['active'])) {
                    $add['active'] = true;
                }
                else {
                    $add['active'] = $extend['active'];
                }
                $this->extends[] = $add;
            }
        }

        // Get store description.
        if (is_dir($this->directory . 'description')) {
            if (file_exists($this->directory . 'description/global.txt')) {
                $this->storeDescription = file_get_contents($this->directory . 'description/global.txt');
            }
            if (file_exists($this->directory . 'description/' . $languages->getAdminDefault() . '.txt')) {
                $this->storeDescription = file_get_contents($this->directory . 'description/' . $languages->getAdminDefault() . '.txt');
            }
            if ($languages->getAdminDefault() !== $languages->getAdminDefaultMain()) {
                if (file_exists($this->directory . 'description/' . $languages->getAdminDefaultMain() . '.txt')) {
                    $this->storeDescription = file_get_contents($this->directory . 'description/' . $languages->getAdminDefaultMain() . '.txt');
                }
            }
            if (file_exists($this->directory . 'description/' . $languages->getAdminActive() . '.txt')) {
                $this->storeDescription = file_get_contents($this->directory . 'description/' . $languages->getAdminActive() . '.txt');
            }
            if ($languages->getAdminActive() !== $languages->getAdminActiveMain()) {
                if (file_exists($this->directory . 'description/' . $languages->getAdminActiveMain() . '.txt')) {
                    $this->storeDescription = file_get_contents($this->directory . 'description/' . $languages->getAdminActiveMain() . '.txt');
                }
            }
        }
        if ($this->storeDescription) {
            $this->storeDescription = strip_tags($this->storeDescription);
            $this->storeDescription = nl2br($this->storeDescription);
            $this->storeDescription = str_replace('    ', '&nbsp;&nbsp;&nbsp;&nbsp;', $this->storeDescription);
        }

        // Get license.
        if (is_dir($this->directory . 'license')) {
            if (file_exists($this->directory . 'license/global.txt')) {
                $this->storeLicense = file_get_contents($this->directory . 'license/global.txt');
            }
            if (file_exists($this->directory . 'license/' . $languages->getAdminDefault() . '.txt')) {
                $this->storeLicense = file_get_contents($this->directory . 'license/' . $languages->getAdminDefault() . '.txt');
            }
            if ($languages->getAdminDefault() !== $languages->getAdminDefaultMain()) {
                if (file_exists($this->directory . 'license/' . $languages->getAdminDefaultMain() . '.txt')) {
                    $this->storeLicense = file_get_contents($this->directory . 'license/' . $languages->getAdminDefaultMain() . '.txt');
                }
            }
            if (file_exists($this->directory . 'license/' . $languages->getAdminActive() . '.txt')) {
                $this->storeLicense = file_get_contents($this->directory . 'license/' . $languages->getAdminActive() . '.txt');
            }
            if ($languages->getAdminActive() !== $languages->getAdminActiveMain()) {
                if (file_exists($this->directory . 'license/' . $languages->getAdminActiveMain() . '.txt')) {
                    $this->storeLicense = file_get_contents($this->directory . 'license/' . $languages->getAdminActiveMain() . '.txt');
                }
            }
        }
        if ($this->storeLicense) {
            $this->storeLicense = strip_tags($this->storeLicense);
            $this->storeLicense = nl2br($this->storeLicense);
            $this->storeLicense = str_replace('    ', '&nbsp;&nbsp;&nbsp;&nbsp;', $this->storeLicense);
        }

        // Get image.
        $url = $this->_config->getUrl() . '/';
        if (file_exists($this->directory . 'image.jpg')) {
            $this->image = $url . $this->directory . 'image.jpg';
        }
        else if (file_exists($this->directory . 'image.jpeg')) {
            $this->image = $url . $this->directory . 'image.jpeg';
        }
        else if (file_exists($this->directory . 'image.png')) {
            $this->image = $url . $this->directory . 'image.png';
        }

        // Get data.
        if (file_exists($this->directory . 'data.php')) {
            include $this->directory . 'data.php';
        }
    }

    /**
     * Activate.
     */
    public function activate()
    {
        // If is error.
        if ($this->error) {
            $this->render('admin__apps__management__err_activate');
        }

        // Activate app.
        $this->active = true;
        $query = 'UPDATE application_apps SET xt_active=? WHERE xt_id=?';
        $this->_database->update($query, [1, $this->id]);

        // Run event activate.
        $file = $this->directory . 'admin/events/activate.php';
        if (file_exists($file)) {
            include $file;
            if (function_exists('activate')) {
                activate($this->id);
            }
        }

        // Sort static apps.
        $this->sortStatic();

        // Add class extensions.
        $this->addClassExtends();

        // Clear all caches.
        $this->clearCache();

        // Render template.
        $this->render(null, 'admin__apps__management__conf_activate');
    }

    /**
     * Deactivate.
     */
    public function deactivate()
    {
        // If is error.
        if ($this->error) {
            $this->render('admin__apps__management__err_activate');
        }

        // Deactivate app.
        $this->active = false;
        $query = 'UPDATE application_apps SET xt_active=? WHERE xt_id=?';
        $this->_database->update($query, [0, $this->id]);

        // Run event deactivate.
        $file = $this->directory . 'admin/events/deactivate.php';
        if (file_exists($file)) {
            include $file;
            if (function_exists('deactivate')) {
                deactivate($this->id);
            }
        }

        // Sort static apps.
        $this->sortStatic();

        // Deactivate class extensions.
        $this->deactivateClassExtends();

        // Clear all caches.
        $this->clearCache();

        // Render template.
        $this->render(null, 'admin__apps__management__conf_deactivate');
    }

    /**
     * Remove.
     */
    public function remove()
    {
        // If is error.
        if ($this->error) {
            $this->render('admin__apps__management__err_remove');
        }

        // Run event remove.
        $file = $this->directory . 'admin/events/remove.php';
        if (file_exists($file)) {
            include $file;
            if (function_exists('remove')) {
                remove($this->id);
            }
        }

        // Delete data from database table "application_apps".
        $query = 'DELETE FROM application_apps WHERE xt_id=?';
        $this->_database->delete($query, [$this->id]);

        // Delete app from CMS.
        $this->deleteFromCms();

        // Delete app from static apps.
        $this->deleteFromStatic();

        // Remove class extensions.
        $this->removeClassExtends();

        // Clear all caches.
        $this->clearCache();

        // Render template.
        $this->error = true;
        $this->render(null, 'admin__apps__management__conf_remove');
    }

    /**
     * Reset.
     */
    public function reset()
    {
        // If is error.
        if ($this->error) {
            $this->render('admin__apps__management__err_reset');
        }

        // Run event revert.
        $file = $this->directory . 'admin/events/revert.php';
        if (file_exists($file)) {
            include $file;
            if (function_exists('revert')) {
                revert($this->id);
            }
        }

        // Sort static apps.
        $this->sortStatic();

        // Remove class extensions.
        $this->removeClassExtends();

        // Add class extensions.
        $this->addClassExtends();

        // Clear all caches.
        $this->clearCache();

        // Render template.
        $this->render(null, 'admin__apps__management__conf_reset');
    }

    /**
     * Duplicate.
     */
    public function duplicate()
    {
        // If is error.
        if ($this->error) {
            $this->render('admin__apps__management__err_duplicate');
        }

        // Remove class extensions.
        $this->removeClassExtends();

        // Run event duplicate.
        $file = $this->directory . 'admin/events/duplicate.php';
        if (file_exists($file)) {
            include $file;
            if (function_exists('duplicate')) {
                duplicate($this->id);
            }
        }

        // Add class extensions.
        $this->addClassExtends();

        // Render template.
        $this->render(null, 'admin__apps__management__conf_duplicate');
    }

    /**
     * Delete.
     */
    public function delete()
    {
        // If is error.
        if ($this->error) {
            $this->render('admin__apps__management__err_delete');
        }

        // Run event delete.
        $file = $this->directory . 'admin/events/delete.php';
        if (file_exists($file)) {
            include $file;
            if (function_exists('delete')) {
                delete($this->id);
            }
        }

        // Delete app from database table "application_apps".
        $query = 'DELETE FROM application_apps WHERE xt_id=?';
        $this->_database->delete($query, [$this->id]);

        // Delete app from CMS.
        $this->deleteFromCms();

        // Delete app from static apps.
        $this->deleteFromStatic();

        // Remove class extensions.
        $this->removeClassExtends();

        // Clear all caches.
        $this->clearCache();

        // Render template.
        $this->error = true;
        $this->render(null, 'admin__apps__management__conf_delete');
    }

    /**
     * Delete app from CMS.
     */
    protected function deleteFromCms()
    {
        // Get possibilities from database table "application_cms".
        $query = 'SELECT xt_id, xt_apps, xt_include FROM application_cms WHERE xt_apps LIKE ? OR xt_include LIKE ?';
        $array = $this->_database->selectArray($query, ['%' . $this->id . '%', '%' . $this->id . '%']);

        // If no possibilities exists.
        if (!$array) {
            return;
        }

        // Delete app from CMS.
        foreach ($array as $value) {
            $update = false;
            if ($value['xt_apps']) {
                $apps = explode('|', $value['xt_apps']);
                for ($i = (count($apps) - 1); $i >= 0; $i--) {
                    if ($apps[$i] === (string)$this->id) {
                        unset($apps[$i]);
                        $value['xt_apps'] = implode('|', $apps);
                        $update = true;
                    }
                }
            }
            if ($value['xt_include']) {
                if ($update && !$value['xt_apps']) {
                    $value['xt_include'] = '';
                }
                else {
                    $include = explode('|', $value['xt_include']);
                    for ($i = (count($include) - 1); $i >= 0; $i--) {
                        if ($include[$i] === (string)$this->id) {
                            unset($include[$i]);
                            $value['xt_include'] = implode('|', $include);
                            $update = true;
                        }
                    }
                }
            }
            if (!$update) {
                continue;
            }
            $query = 'UPDATE application_cms SET xt_apps = ?, xt_include = ? WHERE xt_id = ?';
            $this->_database->update($query, [$value['xt_apps'], $value['xt_include'], $value['xt_id']]);
        }
    }

    /**
     * Delete from static.
     */
    protected function deleteFromStatic()
    {
        // Get possibilities from database table "application_static".
        $query = 'SELECT xt_id, xt_top, xt_bottom FROM application_static WHERE xt_top LIKE ? OR xt_bottom LIKE ?';
        $array = $this->_database->selectArray($query, ['%' . $this->id . '%', '%' . $this->id . '%']);

        // If no possibilities exists.
        if (!$array) {
            return;
        }

        // Delete app from static.
        foreach ($array as $value) {
            $update = false;
            if ($value['xt_top']) {
                $top = explode('|', $value['xt_top']);
                for ($i = (count($top) - 1); $i >= 0; $i--) {
                    if ($top[$i] === (string)$this->id) {
                        unset($top[$i]);
                        $value['xt_top'] = implode('|', $top);
                        $update = true;
                    }
                }
            }
            if ($value['xt_bottom']) {
                $bottom = explode('|', $value['xt_bottom']);
                for ($i = (count($bottom) - 1); $i >= 0; $i--) {
                    if ($bottom[$i] === (string)$this->id) {
                        unset($bottom[$i]);
                        $value['xt_bottom'] = implode('|', $bottom);
                        $update = true;
                    }
                }
            }
            if (!$update) {
                continue;
            }
            $query = 'UPDATE application_static SET xt_top = ?, xt_bottom = ? WHERE xt_id = ?';
            $this->_database->update($query, [$value['xt_top'], $value['xt_bottom'], $value['xt_id']]);
        }
    }

    /**
     * Sort static apps.
     */
    protected function sortStatic()
    {
        // Select data from database table "application_apps".
        $query = 'SELECT xt_id FROM application_apps WHERE xt_static_top != 0 ORDER BY xt_static_top';

        // Sort static apps top.
        $arr = $this->_database->selectArray($query);
        if ($arr) {
            for ($i = 0; $i < count($arr); $i++) {
                $query = 'UPDATE application_apps SET xt_static_top = ' . ($i + 1) . ' WHERE xt_id = ' . (int)$arr[$i]['xt_id'];
                $this->_database->update($query);
            }
        }

        // Select data from database table "application_apps".
        $query = 'SELECT xt_id FROM application_apps WHERE xt_static_bottom != 0 ORDER BY xt_static_bottom';
        $arr = $this->_database->selectArray($query);

        // Sort static apps bottom.
        if ($arr) {
            for ($i = 0; $i < count($arr); $i++) {
                $query = 'UPDATE application_apps SET xt_static_bottom = ' . ($i + 1) . ' WHERE xt_id = ' . (int)$arr[$i]['xt_id'];
                $this->_database->update($query);
            }
        }
    }

    /**
     * Add class extends.
     *
     * @return bool.
     */
    protected function addClassExtends()
    {
        // Get class extends.
        $GLOBAL__APPNETOS__EXTENDS = $this->getClassExtends();

        // Add class extends.
        foreach ($this->extends as $extend) {
            if (!isset($extend['key']) ||
                !isset($extend['parent']) ||
                !isset($extend['children']))
            {
                continue;
            }
            if (!isset($extend['active'])) {
                $extend['active'] = true;
            }
            if (!file_exists($extend['parent']) ||
                !file_exists(($extend['children'])))
            {
                $extend['active'] = false;
            }
            if (count($GLOBAL__APPNETOS__EXTENDS)) {
                $index = null;
                for ($i = 0; $i < count($GLOBAL__APPNETOS__EXTENDS); $i++) {
                    if ($GLOBAL__APPNETOS__EXTENDS[$i]['key'] === $extend['key'] &&
                        $GLOBAL__APPNETOS__EXTENDS[$i]['parent'] === $extend['parent'] &&
                        $GLOBAL__APPNETOS__EXTENDS[$i]['children'] === $extend['children'])
                    {
                        $GLOBAL__APPNETOS__EXTENDS[$i]['active'] = $extend['active'];
                        $index = $i;
                        break;
                    }
                }
                if ($index === null) {
                    $GLOBAL__APPNETOS__EXTENDS[] = $extend;
                }
            }
            else {
                $GLOBAL__APPNETOS__EXTENDS[] = $extend;
            }
        }

        // Set class extends.
        $this->setClassExtends($GLOBAL__APPNETOS__EXTENDS);

        // Return.
        return true;
    }

    /**
     * Deactivate class extends.
     *
     * @return bool.
     */
    protected function deactivateClassExtends()
    {
        // Get if app already installed and active.
        $query = 'SELECT xt_id FROM application_apps WHERE xt_name=? AND xt_namespace=? AND xt_active=?';
        $array = $this->_database->selectArray($query, [$this->data['xt_name'], $this->data['xt_namespace'], 1]);

        // If app already installed and active.
        if ($array) {
            return false;
        }

        // Get class extends.
        $GLOBAL__APPNETOS__EXTENDS = $this->getClassExtends();

        // Add class extends.
        foreach ($this->extends as $extend) {
            if (!isset($extend['key']) ||
                !isset($extend['parent']) ||
                !isset($extend['children']))
            {
                continue;
            }
            $extend['active'] = false;
            for ($i = 0; $i < count($GLOBAL__APPNETOS__EXTENDS); $i++) {
                if ($GLOBAL__APPNETOS__EXTENDS[$i]['key'] === $extend['key'] &&
                    $GLOBAL__APPNETOS__EXTENDS[$i]['parent'] === $extend['parent'] &&
                    $GLOBAL__APPNETOS__EXTENDS[$i]['children'] === $extend['children'])
                {
                    $GLOBAL__APPNETOS__EXTENDS[$i]['active'] = $extend['active'];
                    continue;
                }
            }
        }

        // Set class extends.
        $this->setClassExtends($GLOBAL__APPNETOS__EXTENDS);

        // Return.
        return true;
    }

    /**
     * Remove class extends.
     *
     * @return bool.
     */
    protected function removeClassExtends()
    {
        // Get if app already installed and active.
        $query = 'SELECT xt_id FROM application_apps WHERE xt_name=? AND xt_namespace=? AND xt_active=?';
        $array = $this->_database->selectArray($query, [$this->data['xt_name'], $this->data['xt_namespace'], 1]);

        // If app already installed and active.
        if ($array) {
            return false;
        }

        // Get class extends.
        $GLOBAL__APPNETOS__EXTENDS = $this->getClassExtends();

        // Remove class extends.
        $extends = [];
        foreach ($GLOBAL__APPNETOS__EXTENDS as $globalExtend) {
            $remove = false;
            foreach ($this->extends as $extend) {
                if (!isset($extend['key']) ||
                    !isset($extend['parent']) ||
                    !isset($extend['children']))
                {
                    continue;
                }
                if ($globalExtend['key'] !== $extend['key'] ||
                    $globalExtend['parent'] !== $extend['parent'] ||
                    $globalExtend['children'] !== $extend['children'])
                {
                    $remove = true;
                    break;
                }
            }
            if (!$remove) {
                $extends[] = $globalExtend;
            }
        }

        // Set class extends.
        $this->setClassExtends($extends);

        // Return.
        return true;
    }

    /**
     * Get class extensions.
     *
     * @return array.
     */
    protected function getClassExtends()
    {
        // Get PHP class extends.
        $GLOBAL__APPNETOS__EXTENDS = null;
        if (file_exists('custom/extends.php')) {
            include ('custom/extends.php');
            if (!$GLOBAL__APPNETOS__EXTENDS) {
                return [];
            }
            elseif (!is_array($GLOBAL__APPNETOS__EXTENDS)) {
                return [];
            }
        }

        return $GLOBAL__APPNETOS__EXTENDS;
    }

    /**
     * Set class extensions.
     *
     * @param array $GLOBAL__APPNETOS__EXTENDS.
     * @return bool.
     */
    protected function setClassExtends($GLOBAL__APPNETOS__EXTENDS)
    {
        // Prepare variables.
        $extends = [];

        // Sort extends.
        foreach ($GLOBAL__APPNETOS__EXTENDS as $extend) {
            if (!isset($extend['key']) ||
                !isset($extend['parent']) ||
                !isset($extend['children']))
            {
                continue;
            }
            if (!isset($extend['active'])) {
                $extend['active'] = true;
            }
            if (!file_exists($extend['parent']) ||
                !file_exists(($extend['children'])))
            {
                $extend['active'] = false;
            }
            $extends[] = $extend;
        }

        // Sort extends by classes.
        $classes = [];
        foreach ($extends as $extend) {
            if (!in_array($extend['key'], $classes)) {
                $classes[] = $extend['key'];
            }
        }
        sort($classes);
        $sorted = [];
        foreach ($classes as $key) {
            $sorted[$key] = [];
        }
        foreach ($extends as $extend) {
            $exists = false;
            foreach ($sorted[$extend['key']] as $entry) {
                if ($entry['key'] === $extend['key'] &&
                    $entry['parent'] === $extend['parent'] &&
                    $entry['children'] === $extend['children']
                ) {
                    $exists = true;
                    break;
                }
            }
            if ($exists) {
                continue;
            }
            $sorted[$extend['key']][] = $extend;
        }

        $new = [];
        foreach ($sorted as $sort) {
            foreach ($sort as $entry) {
                $new[] = $entry;
            }
        }

        // Set PHP extends.
        $export = file_get_contents('core/files/extends_header.php');
        $export .= '$GLOBAL__APPNETOS__EXTENDS = ' . var_export($new, true) . ';';
        file_put_contents('custom/extends.php', $export);

        // Return.
        return true;
    }

    /**
     * Clear all caches.
     */
    protected function clearCache()
    {
        // Get object "core\database" and object "core\config".
        $config = objects::get('config');

        // Clear all caches.
        $cacheDir = $config->getCacheDir();
        if (is_dir($cacheDir)) {
            if (is_readable($cacheDir)) {
                if (!$this->isDirectoryEmpty($cacheDir)) {
                    $this->clearDirectoryContent($cacheDir);
                }
            }
        }
        if (file_exists('out/css/main.min.css')) {
            unlink('out/css/main.min.css');
        }
        if (file_exists('out/js/main.min.js')) {
            unlink('out/js/main.min.js');
        }
        $compileDir = $config->getCompileDir();
        if (is_dir($compileDir)) {
            if (is_readable($compileDir)) {
                if (!$this->isDirectoryEmpty($compileDir)) {
                    $this->clearDirectoryContent($compileDir);
                }
            }
        }
        $query = 'TRUNCATE TABLE ' . $config->prefix . '_cache';
        $this->_database->execute($query);
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
     * Clear directory.
     *
     * @param $directory string.
     */
    protected function clearDirectoryContent($directory)
    {
        $files = glob($directory . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     * @throws.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $render = objects::get('render');
        $render->assign('admin__apps__management__app', $this);
        $strings = objects::get('strings');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $managementSearch = objects::get('admin/apps/management__search');
        $managementSearch->init();
        $output = $render->fetch('admin/apps/apps/management/views/management__app.tpl');
        echo $output;
        exit();
    }

    /**
     * Get events.
     *
     * @return string.
     */
    public function getEvents()
    {
        $events = implode(' | ', $this->events);
        return $events;
    }
}