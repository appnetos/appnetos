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
 * @description     Admin URI apps management.
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Model "admin\cms\manage_apps__apps_list".
class manage_apps__apps_list
{

    /**
     * Static top apps.
     *
     * @var array.
     */
    public $staticTop = [];

    /**
     * Static bottom apps.
     *
     * @var array.
     */
    public $staticBottom = [];

    /**
     * URI ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * List.
     *
     * @var array.
     */
    public $appsList = [];

    /**
     * Error message for AJAX request.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * Confirm massage for AJAX request.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        objects::set('admin/cms/manage_apps__apps_list', $this);
        $render = objects::get('render');
        $render->assign('admin__cms__manage_apps__apps_list', $this);

        // Select from database table "application_static".
        $database = objects::get('database');
        $query = 'SELECT xt_top, xt_bottom FROM application_static WHERE xt_id=?';
        $row = $database->selectRow($query, [1]);
        $this->staticTop = [];
        if ($row['xt_top'] !== '') {
            $this->staticTop = array_map('intval', explode('|', $row['xt_top']));
        }
        $this->staticBottom = [];
        if ($row['xt_bottom'] !== '') {
            $this->staticBottom = array_map('intval', explode('|', $row['xt_bottom']));
        }

        // Get model "admin\cms\manage_apps__uri".
        $manageAppsUri = objects::get('admin/cms/manage_apps__uri');

        // Get object "admin\cms\management_apps__app".
        objects::get('admin/cms/manage_apps__app');

        // Initialize apps.
        foreach ($manageAppsUri->apps as $app) {
            $manageAppsApp = objects::getNew('admin/cms/manage_apps__app');
            $manageAppsApp->id = (int)$app;
            $manageAppsApp->init();
            array_push($this->appsList, $manageAppsApp);
        }
        if (count($this->appsList)) {
            for ($i = 0; $i < count($this->appsList) ; $i++) {
                $this->appsList[$i]->position = $i;
            }
            $this->appsList[0]->first = true;
            $this->appsList[(count($this->appsList) - 1)]->last = true;
        }
    }

    /**
     * Add.
     */
    public function add()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $id = $post->get('admin__cms__manage_apps__parameters');
        $id = (int)$id;

        // Get model "admin\cms\manage_apps__uri".
        $manageAppsUri = objects::get('admin/cms/manage_apps__uri');

        // If has error.
        if ($manageAppsUri->error) {
            $this->render('admin__cms__manage_apps__err_add');
        }

        // If parameters not exists.
        if (!$id) {
            $this->render('admin__cms__manage_apps__err_add');
        }

        // Update database.
        $array = $manageAppsUri->apps;
        array_push($array, $id);
        $database = objects::get('database');
        $query = 'UPDATE application_cms SET xt_apps=? WHERE xt_id=?';
        $database->update($query, [implode('|', $array), $this->id]);

        // Render.
        $this->render(null, 'admin__cms__manage_apps__conf_add');
    }

    /**
     * Remove.
     */
    public function remove()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $id = $post->get('admin__cms__manage_apps__parameters');
        $id = (int)$id;

        // Get model "admin\cms\manage_apps__uri".
        $manageAppsUri = objects::get('admin/cms/manage_apps__uri');

        // If has error.
        if ($manageAppsUri->error) {
            $this->render('admin__cms__manage_apps__err_remove');
        }

        // If parameters not exists.
        if (!$id) {
            $this->render('admin__cms__manage_apps__err_remove');
        }
        $array = $manageAppsUri->apps;
        if (!in_array($id, $array)) {
            $this->render('admin__cms__manage_apps__err_remove');
        }

        // Update database.
        if (($key = array_search($id, $array)) !== false) {
            unset($array[$key]);
        }
        $database = objects::get('database');
        $query = 'UPDATE application_cms SET xt_apps=? WHERE xt_id=?';
        $database->update($query, [implode('|', $array), $this->id]);

        // Render.
        $this->render(null, 'admin__cms__manage_apps__conf_remove');
    }

    /**
     * Move.
     */
    public function move()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__cms__manage_apps__parameters');
        $parameters = json_decode($parameters);

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__cms__manage_apps__err_move');
        }
        if (count($parameters) !== 2) {
            $this->render('admin__cms__manage_apps__err_move');
        }

        // Prepare parameters.
        $position = trim($parameters[0]);
        $to = trim($parameters[1]);

        // Get model "admin\cms\manage_apps__uri".
        $manageAppsUri = objects::get('admin/cms/manage_apps__uri');

        // If has error.
        if ($manageAppsUri->error) {
            $this->render('admin__cms__manage_apps__err_move');
        }

        // If parameters not exists.
        if (!$to) {
            $this->render('admin__cms__manage_apps__err_move');
        }
        $array = $manageAppsUri->apps;
        if (!isset($array[$position])) {
            $this->render('admin__cms__manage_apps__err_move');
        }

        // Move up.
        if ($to === 'up') {
            if ($position < 1) {
                $this->render('admin__cms__manage_apps__err_move');
            }
            $one = $array[($position - 1)];
            $two = $array[($position)];
            $array[($position - 1)] = $two;
            $array[$position] = $one;
        }

        // Move down.
        else {
            if ($position > (count($array) - 2)) {
                $this->render('admin__cms__manage_apps__err_move');
            }
            $one = $array[($position + 1)];
            $two = $array[($position)];
            $array[($position + 1)] = $two;
            $array[$position] = $one;
        }

        // Update database.
        $database = objects::get('database');
        $query = 'UPDATE application_cms SET xt_apps=? WHERE xt_id=?';
        $database->update($query, [implode('|', $array), $this->id]);

        // Render.
        $this->render(null, 'admin__cms__manage_apps__conf_move');
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');

        // Get model "admin\cms\edit_uri__model".
        $manageAppsModel = objects::get('admin/cms/manage_apps__model', true);
        $manageAppsModel->init();

        // Set object.
        $manageAppsAppsList = objects::get('admin/cms/manage_apps__apps_list');
        if ($error) {
            $manageAppsAppsList->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $manageAppsAppsList->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/cms/manage_apps/views/manage_apps__apps_list.tpl');
        echo $output;
        exit();
    }
}