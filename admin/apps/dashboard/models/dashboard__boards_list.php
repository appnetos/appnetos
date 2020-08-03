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
 * @description     Admin start page and dashboards.
 */

// Namespace.
namespace admin\dashboard;

// Use.
use \core\objects;

// Model "admin\dashboard\dashboard__boards_list".
class dashboard__boards_list
{

    /**
     * Boards list.
     *
     * @var array.
     */
    public $boardsList = [];

    /**
     * Used object "core\extensions".
     *
     * @var object.
     */
    private $_extensions = null;

    /**
     * Used object "core\user".
     *
     * @var object.
     */
    private $_user = null;

    /**
     * AJAX error.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * AJAX confirm.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Reset.
        $this->boardsList = [];

        // Assign.
        $render = objects::get('render');
        $render->assign('admin__dashboard__dashboard__boards_list', $this);

        // Get used objects.
        $this->_extensions = objects::get('extensions');
        $this->_user = objects::get('user');

        // Get settings.
        $boardsList = $this->_extensions->get('longtext', $this->_user->getId(), 'appnetos/dashboard');

        // If dashboards list exists.
        if ($boardsList) {
            $boardsList = json_decode($boardsList, true);
            foreach ($boardsList as $board) {
                $dashboardBoard = objects::getNew('admin/dashboard/dashboard__board');
                $dashboardBoard->uuid = $board['uuid'];
                $dashboardBoard->name = $board['name'];
                $dashboardBoard->appsList = $board['appsList'];
                array_push($this->boardsList, $dashboardBoard);
            }
        }

        // If dashboards list not exists.
        else {
            // Get model "admin\dashboard\dashboard__board".
            objects::get('admin\dashboard\dashboard__board');

            // Set board.
            $dashboardBoard = objects::getNew('admin/dashboard/dashboard__board');
            $dashboardBoard->uuid = $this->generateUuid();
            $dashboardBoard->name = '{home}';
            array_push($this->boardsList, $dashboardBoard);
            $this->set();
        }
    }

    /**
     * Set boards list.
     */
    public function set()
    {
        $boardList = json_encode($this->boardsList);
        $this->_extensions->set($boardList, 'longtext', $this->_user->getId(), 'appnetos/dashboard');
    }


    /**
     * Generate UUID.
     *
     * @return string.
     */
    protected function generateUuid()
    {
        return strtoupper(
            sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                mt_rand( 0, 0xffff ),
                mt_rand( 0, 0x0fff ) | 0x4000,
                mt_rand( 0, 0x3fff ) | 0x8000,
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            ));
    }

    /**
     * Create dashboard.
     */
    public function create()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = trim($post->get('admin__dashboard__dashboard__parameters'));

        // If parameters not exists.
        if ($parameters === null) {
            return;
        }

        // Check name.
        if ($parameters === '') {
            $this->render('admin__dashboard__dashboard__err_create');
        }
        foreach ($this->boardsList as $board) {
            if ($board->name === $parameters) {
                $this->render('admin__dashboard__dashboard__err_create');
            }
        }

        // Create board
        $dashboardBoard = objects::getNew('admin/dashboard/dashboard__board');
        $dashboardBoard->uuid = $this->generateUuid();
        $dashboardBoard->name = $parameters;
        array_push($this->boardsList, $dashboardBoard);
        $this->set();
        echo $dashboardBoard->uuid;
        exit();
    }

    /**
     * Add widget.
     *
     * @param string $uuid dashboard UUID.
     * @throws.
     */
    public function addWidget($uuid)
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = trim($post->get('admin__dashboard__dashboard__parameters'));
        $parameters = (int)$parameters;

        // Check ID.
        if (!$parameters) {
            $this->render('admin__dashboard__dashboard__err_add');
        }
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM application_apps WHERE xt_id=? AND xt_widget=?';
        $row = $database->selectRow($query, [$parameters, 1]);
        if (!$row) {
            $this->render('admin__dashboard__dashboard__err_add');
        }

        // Add widget.
        foreach ($this->boardsList as $board) {
            if ($board->uuid === $uuid) {
                array_push($board->appsList, $parameters);
                $this->set();
                $this->render(null, 'admin__dashboard__dashboard__conf_add');
            }
        }

        // Render.
        $this->render('admin__dashboard__dashboard__err_add');
    }

    /**
     * Remove widget.
     *
     * @param string $uuid dashboard UUID.
     * @throws exception.
     */
    public function removeWidget($uuid)
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = trim($post->get('admin__dashboard__dashboard__parameters'));
        $parameters = (int)$parameters;

        // Check parameters.
        if ($parameters === null) {
            $this->render('admin__dashboard__dashboard__err_rm');
        }

        // Remove widget.
        foreach ($this->boardsList as $board) {
            if ($board->uuid === $uuid) {
                if (!isset($board->appsList[$parameters])) {
                    $this->render('admin__dashboard__dashboard__err_rm');
                }
                $array = [];
                for ($i = 0; $i < count($board->appsList); $i++) {
                    if ($i !== $parameters) {
                        array_push($array, $board->appsList[$i]);
                    }
                }
                $board->appsList = $array;
                $this->set();
                $this->render(null, 'admin__dashboard__dashboard__conf_rm');
            }
        }

        // Render.
        $this->render('admin__dashboard__dashboard__err_rm');
    }

    /**
     * Move widget up.
     *
     * @param string $uuid dashboard UUID.
     * @throws exception.
     */
    public function moveWidgetUp($uuid)
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = trim($post->get('admin__dashboard__dashboard__parameters'));
        $parameters = (int)$parameters;

        // Check parameters.
        if ($parameters === null || $parameters === 0) {
            $this->render('admin__dashboard__dashboard__err_mov');
        }

        // Move widget.
        foreach ($this->boardsList as $board) {
            if ($board->uuid === $uuid) {
                if (!isset($board->appsList[$parameters]) || !isset($board->appsList[($parameters - 1)])) {
                    $this->render('admin__dashboard__dashboard__err_mov');
                }
                $cache = $board->appsList[$parameters];
                $board->appsList[$parameters] = $board->appsList[($parameters - 1)];
                $board->appsList[($parameters - 1)] = $cache;
                $this->set();
                $this->render(null, 'admin__dashboard__dashboard__conf_mov');
            }
        }

        // Render.
        $this->render('admin__dashboard__dashboard__err_mov');
    }

    /**
     * Move widget down.
     *
     * @param string $uuid dashboard UUID.
     * @throws exception.
     */
    public function moveWidgetDown($uuid)
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = trim($post->get('admin__dashboard__dashboard__parameters'));
        $parameters = (int)$parameters;

        // Check parameters.
        if ($parameters === null) {
            $this->render('admin__dashboard__dashboard__err_mov');
        }

        // Move widget.
        foreach ($this->boardsList as $board) {
            if ($board->uuid === $uuid) {
                if (!isset($board->appsList[$parameters]) || !isset($board->appsList[($parameters +1)])) {
                    $this->render('admin__dashboard__dashboard__err_mov');
                }
                $cache = $board->appsList[$parameters];
                $board->appsList[$parameters] = $board->appsList[($parameters + 1)];
                $board->appsList[($parameters + 1)] = $cache;
                $this->set();
                $this->render(null, 'admin__dashboard__dashboard__conf_mov');
            }
        }

        // Render.
        $this->render('admin__dashboard__dashboard__err_mov');
    }

    /**
     * Edit dashboard name.
     *
     * @param string $uuid dashboard UUID.
     * @throws exception.
     */
    public function editDashboardName($uuid)
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = trim($post->get('admin__dashboard__dashboard__parameters'));

        // Check parameters.
        if ($parameters === null) {
            $this->render('admin__dashboard__dashboard__err_edit_name');
        }

        // Check name.
        if ($parameters === '') {
            $this->render('admin__dashboard__dashboard__err_edit_name');
        }
        foreach ($this->boardsList as $board) {
            if ($board->name === $parameters) {
                $this->render('admin__dashboard__dashboard__err_edit_name');
            }
        }
        foreach ($this->boardsList as $board) {
            if ($board->uuid === $uuid) {
                if ($board->name === '{home') {
                    $this->render('admin__dashboard__dashboard__err_edit_name');
                }
                $board->name = $parameters;
                $this->set();
                echo $board->uuid;
                exit();
            }
        }

        // Render.
        $this->render('admin__dashboard__dashboard__err_edit_name');
    }

    /**
     * Remove dashboard.
     *
     * @param string $uuid dashboard UUID.
     * @throws exception.
     */
    public function removeDashboard($uuid)
    {
        // Remove dashboard.
        $array = [];
        $homeUuid = null;
        for ($i = 0; $i < count($this->boardsList); $i++) {
            if ($this->boardsList[$i]->uuid === $uuid) {
                if ($this->boardsList[$i]->name === '{home}') {
                    $this->render('admin__dashboard__dashboard__err_remove_dashboard');
                }
            }
            else {
                array_push($array, $this->boardsList[$i]);
            }
            if ($this->boardsList[$i]->name === '{home}') {
                $homeUuid = $this->boardsList[$i]->uuid;
            }
        }
        $this->boardsList = $array;
        $this->set();
        echo $homeUuid;
        exit();
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     * @throws exception.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');

        // Initialize.
        $dashboardModel = objects::get('admin\dashboard\dashboard__model');
        $dashboardModel->init();

        // Set messages.
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/dashboard/views/dashboard__edit_board.tpl');
        echo $output;
        exit();
    }

}