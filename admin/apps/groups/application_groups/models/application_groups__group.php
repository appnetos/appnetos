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

// Model "admin\groups\application_groups__group".
class application_groups__group
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Granted URIs.
     *
     * @var array.
     */
    public $granted = [];

    /**
     * Count grant URIs.
     *
     * @var int.
     */
    public $grantedCount = 0;

    /**
     * Denied URIs.
     *
     * @var array.
     */
    public $denied = [];

    /**
     * Count denied URIs.
     *
     * @var int.
     */
    public $deniedCount = 0;

    /**
     * Default group.
     *
     * @var bool.
     */
    public $default = false;

    /**
     * If is error loading.
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
     * Open tab.
     *
     * @var string.
     */
    public $tab = 'edit';

    /**
     * Initialize.
     */
    public function init()
    {
        // Get used objects.
        $strings = objects::get('strings');
        $groupsUris = objects::get('admin/groups/application_groups__uris');

        // Select from database table "application_groups".
        $database = objects::get('database');
        $query = 'SELECT * FROM application_groups WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set content.
        $this->id = (int)$row['xt_id'];
        $this->name = $row['xt_name'];
        $rowGranted = $row['xt_granted'];
        $rowDenied = $row['xt_denied'];
        $this->default = (bool)$row['xt_default'];
        $deprecate = false;
        if (trim($rowGranted) !== '') {
            $granteds = array_map('intval', explode('|', $rowGranted));
            foreach ($granteds as $granted) {
                $uri = $groupsUris->get($granted);
                if ($uri !== false) {
                    if ($uri === '') {
                        $this->granted[$granted] = $strings->get('admin__groups__application_groups__home');
                    }
                    else {
                        $this->granted[$granted] = $uri;
                    }
                }
                else {
                    $deprecate = true;
                }
            }
        }
        $this->grantedCount = count($this->granted);
        if (trim($rowDenied) !== '') {
            $denieds = array_map('intval', explode('|', $rowDenied));
            foreach ($denieds as $denied) {
                $uri = $groupsUris->get($denied);
                if ($uri !== false) {
                    if ($uri === '') {
                        $this->denied[$denied] = $strings->get('admin__groups__application_groups__home');
                    }
                    else {
                        $this->denied[$denied] = $uri;
                    }
                }
                else {
                    $deprecate = true;
                }
            }
        }
        $this->deniedCount = count($this->denied);

        // Restore entries if deprecate.
        if ($deprecate) {
            $this->restore();
        }
    }

    /**
     * Restore entries if deprecate.
     */
    protected function restore()
    {
        // Get used objects.
        $groupsUris = objects::get('admin/groups/application_groups__uris');

        // Select from database table "application_groups".
        $database = objects::get('database');
        $query = 'SELECT * FROM application_groups WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            return;
        }

        // Restore.
        $newGranted = [];
        $rowGranted = $row['xt_granted'];
        if (trim($rowGranted) !== '') {
            $granteds = array_map('intval', explode('|', $rowGranted));
            foreach ($granteds as $granted) {
                $uri = $groupsUris->get($granted);
                if ($uri !== false) {
                    array_push($newGranted, $granted);
                }
            }
        }
        $newDenied = [];
        $rowDenied = $row['xt_denied'];
        if (trim($rowDenied) !== '') {
            $denieds = array_map('intval', explode('|', $rowDenied));
            foreach ($denieds as $denied) {
                $uri = $groupsUris->get($denied);
                if ($uri !== false) {
                    array_push($newDenied, $denied);
                }
            }
        }

        // Update database table "application_groups".
        $query = "UPDATE application_groups SET xt_granted=?, xt_denied=? WHERE xt_id=?";
        $database->update($query, [implode('|', $newGranted), implode('|', $newDenied), $this->id]);

        // Redirect.
        $cms =  objects::get('cms');
        $id = $cms->getId();
        $uri = objects::get('uri');
        $url = $uri->getUrl($id);
        header('Location: ' . $url);
        exit;
    }

    /**
     * Edit.
     */
    public function edit()
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
        $name = trim(strip_tags($parameters['name']));

        // Initialize.
        $this->id = $id;
        $this->init();

        // If group not exists.
        if ($this->error) {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // If no URIS to add.
        if (!$name) {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // Update database table "application_groups".
        $database = objects::get('database');
        $query = 'UPDATE application_groups SET xt_name=? WHERE xt_id=?';
        $database->update($query, [$name, $id]);

        // Set parameters.
        $this->name = $name;

        // Render.
        $this->render(null, 'admin__groups__application_groups__edit_conf');
    }

    /**
     * Add granted.
     */
    public function addGranted()
    {
        // Set tab.
        $this->tab = 'granted';

        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__groups__application_groups__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // Prepare parameters.
        $id = (int)$parameters['id'];
        $add = $parameters['add'];

        // Initialize.
        $this->id = $id;
        $this->init();

        // If group not exists.
        if ($this->error) {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // If no URIS to add.
        if (!count($add)) {
            $this->render('admin__groups__application_groups__no_uris_err');
        }

        // Prepare parameters.
        $granted = [];
        foreach ($this->granted as $key => $value) {
            array_push($granted, $key);
        }

        // Add URIs.
        foreach ($add as $value) {
            if (!in_array($value, $granted)) {
                array_push($granted, $value);
            }
        }

        // Sort entries.
        sort($granted);

        // Update database table "application_groups".
        $database = objects::get('database');
        $query = 'UPDATE application_groups SET xt_granted=? WHERE xt_id=?';
        $database->update($query, [implode('|', $granted), $id]);

        // Set parameters.
        $strings = objects::get('strings');
        $groupsUris = objects::get('admin/groups/application_groups__uris');
        $this->granted = [];
        foreach ($granted as $value) {
            $uri = $groupsUris->get($value);
            if ($uri === '') {
                $this->granted[$value] = $strings->get('admin__groups__application_groups__home');
            }
            else {
                $this->granted[$value] = $uri;
            }
        }
        $this->grantedCount = count($this->granted);

        // Render.
        $this->render(null, 'admin__groups__application_groups__add_uri_conf');
    }

    /**
     * Add denied.
     */
    public function addDenied()
    {
        // Set tab.
        $this->tab = 'denied';

        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__groups__application_groups__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // Prepare parameters.
        $id = (int)$parameters['id'];
        $add = $parameters['add'];

        // Initialize.
        $this->id = $id;
        $this->init();

        // If group not exists.
        if ($this->error) {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // If no URIS to add.
        if (!count($add)) {
            $this->render('admin__groups__application_groups__no_uris_err');
        }

        // Prepare parameters.
        $denied = [];
        foreach ($this->denied as $key => $value) {
            array_push($denied, $key);
        }

        // Add URIs.
        foreach ($add as $value) {
            if (!in_array($value, $denied)) {
                array_push($denied, $value);
            }
        }

        // Sort entries.
        sort($denied);

        // Update database table "application_groups".
        $database = objects::get('database');
        $query = 'UPDATE application_groups SET xt_denied=? WHERE xt_id=?';
        $database->update($query, [implode('|', $denied), $id]);

        // Set parameters.
        $strings = objects::get('strings');
        $groupsUris = objects::get('admin/groups/application_groups__uris');
        $this->denied = [];
        foreach ($denied as $value) {
            $uri = $groupsUris->get($value);
            if ($uri === '') {
                $this->denied[$value] = $strings->get('admin__groups__application_groups__home');
            }
            else {
                $this->denied[$value] = $uri;
            }
        }
        $this->deniedCount = count($this->denied);

        // Render.
        $this->render(null, 'admin__groups__application_groups__add_uri_conf');
    }

    /**
     * Remove granted.
     */
    public function removeGranted()
    {
        // Set tab.
        $this->tab = 'granted';

        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__groups__application_groups__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // Prepare parameters.
        $id = (int)$parameters['id'];
        $remove = $parameters['remove'];

        // Initialize.
        $this->id = $id;
        $this->init();

        // If group not exists.
        if ($this->error) {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // If no URIS to remove.
        if (!count($remove)) {
            $this->render('admin__groups__application_groups__no_uris_err');
        }

        // Prepare parameters.
        $granted = [];
        foreach ($this->granted as $key => $value) {
            if (!in_array($key, $remove)) {
                array_push($granted, $key);
            }
        }

        // Sort entries.
        sort($granted);

        // Update database table "application_groups".
        $database = objects::get('database');
        $query = 'UPDATE application_groups SET xt_granted=? WHERE xt_id=?';
        $database->update($query, [implode('|', $granted), $id]);

        // Set parameters.
        $strings = objects::get('strings');
        $groupsUris = objects::get('admin/groups/application_groups__uris');
        $this->granted = [];
        foreach ($granted as $value) {
            $uri = $groupsUris->get($value);
            if ($uri === '') {
                $this->granted[$value] = $strings->get('admin__groups__application_groups__home');
            }
            else {
                $this->granted[$value] = $uri;
            }
        }
        $this->grantedCount = count($this->granted);

        // Render.
        $this->render(null, 'admin__groups__application_groups__remove_uri_conf');
    }

    /**
     * Remove denied.
     */
    public function removeDenied()
    {
        // Set tab.
        $this->tab = 'denied';

        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__groups__application_groups__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // Prepare parameters.
        $id = (int)$parameters['id'];
        $remove = $parameters['remove'];

        // Initialize.
        $this->id = $id;
        $this->init();

        // If group not exists.
        if ($this->error) {
            $this->render('admin__groups__application_groups__edit_err');
        }

        // If no URIS to remove.
        if (!count($remove)) {
            $this->render('admin__groups__application_groups__no_uris_err');
        }

        // Prepare parameters.
        $denied = [];
        foreach ($this->denied as $key => $value) {
            if (!in_array($key, $remove)) {
                array_push($denied, $key);
            }
        }

        // Sort entries.
        sort($denied);

        // Update database table "application_groups".
        $database = objects::get('database');
        $query = 'UPDATE application_groups SET xt_denied=? WHERE xt_id=?';
        $database->update($query, [implode('|', $denied), $id]);

        // Set parameters.
        $strings = objects::get('strings');
        $groupsUris = objects::get('admin/groups/application_groups__uris');
        $this->denied = [];
        foreach ($denied as $value) {
            $uri = $groupsUris->get($value);
            if ($uri === '') {
                $this->denied[$value] = $strings->get('admin__groups__application_groups__home');
            }
            else {
                $this->denied[$value] = $uri;
            }
        }
        $this->deniedCount = count($this->denied);

        // Render.
        $this->render(null, 'admin__groups__application_groups__remove_uri_conf');
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
        $render->assign('admin__groups__application_groups__group', $this);
        $strings = objects::get('strings');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $groupsSearch = objects::get('admin/groups/application_groups__search');
        $groupsSearch->init();
        $output = $render->fetch('admin/apps/groups/application_groups/views/application_groups__group.tpl');
        echo $output;
        exit();
    }

    /**
     * Get granted json.
     *
     * @return string.
     */
    public function getUsed()
    {
        $array = [];
        foreach ($this->granted as $key => $value) {
            array_push($array, (int)$key);
        }
        foreach ($this->denied as $key => $value) {
            array_push($array, (int)$key);
        }
        return json_encode($array);
    }
}