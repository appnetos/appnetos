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
 * @description     Admin application to manage static top apps.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\static_top__model".
class static_top__model
{

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
     * Object "core\render".
     *
     * @var object.
     */
    private $_render = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $this->_render = objects::get('render');
        $this->_render->assign('admin__apps__static_top__model', $this);

        // Initialize objects.
        $staticTopSearch = objects::get('admin/apps/static_top__search', true);
        $staticTopSearch->init();
        $staticTopAppList = objects::get('admin/apps/static_top__apps_list', true);
        $staticTopAppList->init();
    }

    /**
     * Add application.
     */
    public function add()
    {
        // Get used objects.
        $post = objects::get('post');
        $database = objects::get('database');
        $strings = objects::get('strings');

        // Get POST parameters.
        $id = $post->get('admin__apps__static_top__id');
        $id = (int)$id;

        // If parameters not exists.
        if (!$id) {
            $this->ajaxError = $strings->get('admin__apps__static_top__err_add');
            return;
        }

        // Select from database table "application_apps".
        $query = 'SELECT xt_id FROM application_apps WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->ajaxError = $strings->get('admin__apps__static_top__err_add');
            return;
        }

        // Select from database table "application_static".
        $query = 'SELECT xt_top FROM application_static WHERE xt_id=?';
        $row = $database->selectRow($query, [1]);
        $staticTop = [];
        if ($row['xt_top'] !== '') {
            $staticTop = array_map('intval', explode('|', $row['xt_top']));
        }

        // Update database table "application_static".
        array_push($staticTop, $id);
        $query = 'UPDATE application_static SET xt_top=? WHERE xt_id=?';
        $database->update($query, [implode('|', $staticTop), 1]);

        // Set confirm message.
        $this->ajaxConfirm = $strings->get('admin__apps__static_top__conf_add');
    }

    /**
     * Remove application.
     */
    public function remove()
    {
        // Get used objects.
        $post = objects::get('post');
        $database = objects::get('database');
        $strings = objects::get('strings');

        // Get POST parameters.
        $position = $post->get('admin__apps__static_top__id');
        $position = (int)$position;

        // If parameters not exists.
        if (!$post) {
            $this->ajaxError = $strings->get('admin__apps__static_top__err_remove');
            return;
        }

        // Select from database table "application_static".
        $query = 'SELECT xt_top FROM application_static WHERE xt_id=?';
        $row = $database->selectRow($query, [1]);
        $staticTop = [];
        if ($row['xt_top'] !== '') {
            $staticTop = array_map('intval', explode('|', $row['xt_top']));
        }

        // If position not exists.
        if (!isset($staticTop[$position])) {
            $this->ajaxError = $strings->get('admin__apps__static_top__err_remove');
            return;
        }

        // Update database table "application_static".
        unset($staticTop[$position]);
        $query = 'UPDATE application_static SET xt_top=? WHERE xt_id=?';
        $database->update($query, [implode('|', $staticTop), 1]);

        // Set confirm message.
        $this->ajaxConfirm = $strings->get('admin__apps__static_top__conf_remove');
    }

    /**
     * Move application.
     */
    public function move()
    {
        // Get used objects.
        $post = objects::get('post');
        $database = objects::get('database');
        $strings = objects::get('strings');

        // Get POST parameters.
        $position = $post->get('admin__apps__static_top__id');
        $position = (int)$position;
        $to = $post->get('admin__apps__static_top__parameters');

        // Select from database table "application_static".
        $query = 'SELECT xt_top FROM application_static WHERE xt_id=?';
        $row = $database->selectRow($query, [1]);
        $staticTop = [];
        if ($row['xt_top'] !== '') {
            $staticTop = array_map('intval', explode('|', $row['xt_top']));
        }

        // If position not exists.
        if (!isset($staticTop[$position])) {
            $this->ajaxError = $strings->get('admin__apps__static_top__err_remove');
            return;
        }

        // Move app up.
        if ($to === 'up') {
            if (!isset($staticTop[($position - 1)])) {
                $this->ajaxError = $strings->get('admin__apps__static_top__err_remove');
                return;
            }
            $idOne = $staticTop[($position)];
            $idTwo = $staticTop[($position - 1)];
            $staticTop[$position] = $idTwo;
            $staticTop[$position - 1] = $idOne;
        }

        // Move app down.
        else {
            if (!isset($staticTop[($position + 1)])) {
                $this->ajaxError = $strings->get('admin__apps__static_top__err_remove');
                return;
            }
            $idOne = $staticTop[($position)];
            $idTwo = $staticTop[($position + 1)];
            $staticTop[$position] = $idTwo;
            $staticTop[$position + 1] = $idOne;
        }

        // Update database table "application_static".
        $query = 'UPDATE application_static SET xt_top=? WHERE xt_id=?';
        $database->update($query, [implode('|', $staticTop), 1]);

        // Set confirm message.
        $this->ajaxConfirm = $strings->get('admin__apps__static_top__conf_move');
    }

    /**
     * Get admin info.
     *
     * @return bool.
     * @throws.
     */
    public function getInfoAdmin()
    {
        $config = objects::get('config');
        $infoAdmin = $config->getInfoAdmin();
        return $infoAdmin;
    }

    /**
     * Assign object.
     *
     * @param string $name.
     * @param object $object.
     */
    public function assign($name, $object)
    {
        $this->_render->assign($name, $object);
    }
}