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
 * @description     Admin app installer to install or reinstall apps with install events.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\install__app".
class install__app
{

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Directory.
     *
     * @var string.
     */
    public $directory = null;

    /**
     * If is installed.
     *
     * @var bool.
     */
    public $installed = false;

    /**
     * IDs of installed.
     *
     * @var array.
     */
    public $ids = [];

    /**
     * Image.
     *
     * @var string.
     */
    public $image = null;

    /**
     * Description.
     *
     * @var string.
     */
    public $description = null;

    /**
     * License.
     *
     * @var string.
     */
    public $license = null;

    /**
     * If error.
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
     * Initialize.
     */
    public function init()
    {
        // Initialize files.
        $this->initFiles();
    }

    /**
     * Initialize data.
     *
     * @throws \core\exception.
     */
    protected function initFiles()
    {
        // If directory not exists.
        if (!$this->directory) {
            $this->error = true;
            return;
        }

        // Get used objects.
        $languages = objects::get('languages');

        // Get name.
        $explode = explode('/', $this->directory);
        $this->name = end($explode);

        // Get description.
        if (is_dir('application/apps/' . $this->directory . '/description')) {
            if (file_exists('application/apps/' . $this->directory . '/description/global.txt')) {
                $this->description = file_get_contents('application/apps/' . $this->directory . '/description/global.txt');
            }
            if (file_exists('application/apps/' . $this->directory . '/description/' . $languages->getAdminDefault() . '.txt')) {
                $this->description = file_get_contents('application/apps/' . $this->directory . '/description/' . $languages->getAdminDefault() . '.txt');
            }
            if ($languages->getAdminDefault() !== $languages->getAdminDefaultMain()) {
                if (file_exists('application/apps/' . $this->directory . '/description/' . $languages->getAdminDefaultMain() . '.txt')) {
                    $this->description = file_get_contents('application/apps/' . $this->directory . '/description/' . $languages->getAdminDefaultMain() . '.txt');
                }
            }
            if (file_exists('application/apps/' . $this->directory . '/description/' . $languages->getAdminActive() . '.txt')) {
                $this->description = file_get_contents('application/apps/' . $this->directory . '/description/' . $languages->getAdminActive() . '.txt');
            }
            if ($languages->getAdminActive() !== $languages->getAdminActiveMain()) {
                if (file_exists('application/apps/' . $this->directory . '/description/' . $languages->getAdminActiveMain() . '.txt')) {
                    $this->description = file_get_contents('application/apps/' . $this->directory . '/description/' . $languages->getAdminActiveMain() . '.txt');
                }
            }
        }
        if ($this->description) {
            $this->description = strip_tags($this->description);
            $this->description = nl2br($this->description);
            $this->description = str_replace('    ', '&nbsp;&nbsp;&nbsp;&nbsp;', $this->description);
        }

        // Get license.
        if (is_dir('application/apps/' . $this->directory . '/license')) {
            if (file_exists('application/apps/' . $this->directory . '/license/global.txt')) {
                $this->license = file_get_contents('application/apps/' . $this->directory . '/license/global.txt');
            }
            if (file_exists('application/apps/' . $this->directory . '/license/' . $languages->getAdminDefault() . '.txt')) {
                $this->license = file_get_contents('application/apps/' . $this->directory . '/license/' . $languages->getAdminDefault() . '.txt');
            }
            if ($languages->getAdminDefault() !== $languages->getAdminDefaultMain()) {
                if (file_exists('application/apps/' . $this->directory . '/license/' . $languages->getAdminDefaultMain() . '.txt')) {
                    $this->license = file_get_contents('application/apps/' . $this->directory . '/license/' . $languages->getAdminDefaultMain() . '.txt');
                }
            }
            if (file_exists('application/apps/' . $this->directory . '/license/' . $languages->getAdminActive() . '.txt')) {
                $this->license = file_get_contents('application/apps/' . $this->directory . '/license/' . $languages->getAdminActive() . '.txt');
            }
            if ($languages->getAdminActive() !== $languages->getAdminActiveMain()) {
                if (file_exists('application/apps/' . $this->directory . '/license/' . $languages->getAdminActiveMain() . '.txt')) {
                    $this->license = file_get_contents('application/apps/' . $this->directory . '/license/' . $languages->getAdminActiveMain() . '.txt');
                }
            }
        }
        if ($this->license) {
            $this->license = strip_tags($this->license);
            $this->license = nl2br($this->license);
            $this->license = str_replace('    ', '&nbsp;&nbsp;&nbsp;&nbsp;', $this->license);
        }

        // Get image.
        if (file_exists('application/apps/' . $this->directory . '/image.svg')) {
            $this->image = 'svg';
        }
        else if (file_exists('application/apps/' . $this->directory . '/image.jpg')) {
            $this->image = 'jpg';
        }
        else if (file_exists('application/apps/' . $this->directory . '/image.jpeg')) {
            $this->image = 'jpeg';
        }
        else if (file_exists('application/apps/' . $this->directory . '/image.png')) {
            $this->image = 'png';
        }

        // Get app information.
        $array = explode('/', $this->directory);
        unset($array[(count($array) - 1)]);
        $directory = implode('/', $array);
        $database = objects::get('database');
        $query = 'SELECT xt_id, xt_name FROM application_apps WHERE xt_directory=?';
        $array = $database->selectArray($query, [$directory]);
        if (!$array) {
            return;
        }
        for ($i = 0; $i < count($array); $i++) {
            if (strtolower(str_replace(' ', '_', $array[$i]['xt_name'])) === strtolower(str_replace(' ', '_', $this->name))) {
                $this->installed = true;
                $this->name = $array[$i]['xt_name'];
                array_push($this->ids, $array[$i]['xt_id']);
            }
        }
    }

    /**
     * Install.
     */
    public function install()
    {
        // Prepare parameters.
        $directory = str_replace(["/", "\\"], "/", $this->directory);

        // If parameters not exists.
        if (!$directory) {
            $this->render('admin__apps__install__err_install');
        }

        // Set app installer path.
        $file = 'application/apps/' . $directory . '/admin/events/install.php';

        // If install event not exists.
        if (!file_exists($file)) {
            $this->render('admin__apps__install__err_install');
        }

        // Including install event.
        include $file;

        // If install function not exists.
        if (!function_exists('install')) {
            $this->render('admin__apps__install__err_install');
        }

        // Install app.
        install();

        // Sort static apps.
        $this->sortStatic();

        // Render template.
        $this->render(null, 'admin__apps__install__conf_install');
    }

    /**
     * Sort static apps.
     */
    protected function sortStatic()
    {
        // Select data from database table "application_apps".
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM application_apps WHERE xt_static_top != 0 ORDER BY xt_static_top';
        $arr = $database->selectArray($query);

        // Sort static apps on top.
        if ($arr) {
            for ($i = 0; $i < count($arr); $i++) {
                $query = 'UPDATE application_apps SET xt_static_top = ' . ($i + 1) . ' WHERE xt_id = ' . (int)$arr[$i]['xt_id'];
                $database->update($query);
            }
        }

        // Sort static apps on bottom.
        $query = 'SELECT xt_id FROM application_apps WHERE xt_static_bottom != 0 ORDER BY xt_static_bottom';
        $arr = $database->selectArray($query);
        if ($arr) {
            for ($i = 0; $i < count($arr); $i++) {
                $query = 'UPDATE application_apps SET xt_static_bottom = ' . ($i + 1) . ' WHERE xt_id = ' . (int)$arr[$i]['xt_id'];
                $database->update($query);
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
        $render->assign('admin__apps__install__app', $this);
        $strings = objects::get('strings');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/apps/install/views/install__app.tpl');
        echo $output;
        exit();
    }
}