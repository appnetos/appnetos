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
 * @description     Application user groups. Groups can be used to define which users can view which areas.
 */

// Namespace.
namespace admin\groups;

// Use.
use \core\objects;

// Model "admin\groups\application_groups__groups_list".
class application_groups__groups_list
{

    /**
     * Count.
     *
     * @var int.
     */
    public $count = null;

    /**
     * Areas.
     *
     * @var int.
     */
    public $areas = null;

    /**
     * Start.
     *
     * @var int.
     */
    public $start = null;

    /**
     * End.
     *
     * @var int.
     */
    public $end = null;

    /**
     * List.
     *
     * @var array.
     */
    public $groupsList = [];

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
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__groups__application_groups__groups_list', $this);

        // Get used objects.
        $database = objects::get('database');
        $groupsSearch = objects::get('admin/groups/application_groups__search');

        // Set search parameter.
        $search = '%' . $groupsSearch->search . '%';

        // Select count from database table "application_groups".
        $query = 'SELECT COUNT(*) FROM application_groups WHERE xt_name LIKE ?';
        $this->count = $database->count($query, [$search]);

        // Prepare parameters.
        $this->areas = round($this->count / $groupsSearch->number + 0.49999999999);
        if ($groupsSearch->area > $this->areas || $groupsSearch->area < 1) {
            $groupsSearch->updateArea(1);
        }
        $this->start = $groupsSearch->area - 5;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $groupsSearch->area + 5;
        if ($this->end > $this->areas) {
            $this->end = $this->areas;
        }
        $offset = ($groupsSearch->area - 1) * $groupsSearch->number;

        // Select from database table "application_groups".
        $query = 'SELECT xt_id FROM application_groups WHERE xt_name LIKE ? ORDER BY ' . $groupsSearch->order .' LIMIT ' . $groupsSearch->number . ' OFFSET ' . $offset;
        $array = $database->selectArray($query, [$search]);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Get object "admin\groups\application_groups__group".
        objects::get('admin/groups/application_groups__group');

        // Initialize groups.
        for ($i = 0; $i < count($array); $i++) {
            $group = objects::getNew('admin/groups/application_groups__group');
            $group->id = (int)$array[$i]['xt_id'];
            $group->init();
            array_push($this->groupsList, $group);
        }
    }

    /**
     * Add.
     */
    public function add()
    {
        // Get parameters.
        $post = objects::get('post');
        $name = trim(strip_tags($post->get('admin__groups__application_groups__parameters')));

        // If parameters wrong.
        if (!$name) {
            $this->render('admin__groups__application_groups__add_err_name_enter');
        }

        // If group name already exists.
        $database = objects::get('database');
        $query = 'SELECT xt_name FROM application_groups WHERE xt_name=?';
        $row = $database->selectRow($query, [$name]);
        if ($row) {
            $this->render('admin__groups__application_groups__add_err_name_exists');
        }

        // Insert into "application_groups".
        $query = 'INSERT INTO application_groups (xt_name, xt_granted, xt_denied, xt_default) VALUES (?,?,?,?)';
        $database->insert($query, [$name, '', '', 0]);

        // Render.
        $this->render(null, 'admin__groups__application_groups__add_conf');
    }

    /**
     * Delete.
     */
    public function delete()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__groups__application_groups__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__groups__application_groups__delete_err');
        }

        // Prepare parameters.
        $id = (int)$parameters['id'];
        $default = 0;

        // If ID not exists.
        if (!$id) {
            $this->render('admin__groups__application_groups__delete_err');
        }

        // Select from database table "application_groups".
        $database = objects::get('database');
        $query = "SELECT xt_id FROM application_groups WHERE xt_default=?";
        $row = $database->selectRow($query, [1]);
        if ($row) {
            $default = (int)$row['xt_id'];
        }

        // Delete from database table "application_groups".
        $query = "DELETE FROM application_groups WHERE xt_id=?";
        $database->delete($query, [$id]);

        // If is default group.
        if ($id === $default) {
            $query = "UPDATE application_users SET xt_group=? WHERE xt_group=?";
            $database->update($query, [0, $id]);
        }

        // If is not default group.
        else {
            $query = "UPDATE application_users SET xt_group=? WHERE xt_group=?";
            $database->update($query, [$default, $id]);
        }

        // Render.
        $this->render(null, 'admin__groups__application_groups__delete_conf');
    }

    /**
     * Set as default.
     */
    public function setDefault()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__groups__application_groups__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // Prepare parameters.
        $id = (int)$parameters['id'];

        // If ID not exists.
        if (!$id) {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // Update database table "application_groups".
        $database = objects::get('database');
        $query = 'UPDATE application_groups SET xt_default=? WHERE xt_id>?';
        $database->update($query, [0, 0]);
        $query = 'UPDATE application_groups SET xt_default=? WHERE xt_id=?';
        $database->update($query, [1, $id]);

        // Render.
        $this->render(null, 'admin__groups__application_groups__edit_conf');
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
        $strings = objects::get('strings');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Get object "admin\groups\application_groups__model".
        $groupsModel = objects::get('admin/groups/application_groups__model');
        $groupsModel->init();

        // Render template.
        $output = $render->fetch('admin/apps/groups/application_groups/views/application_groups__groups_list.tpl');
        echo $output;
        exit();
    }
}