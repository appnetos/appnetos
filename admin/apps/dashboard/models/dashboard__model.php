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

// Model "admin\dashboard\dashboard__model".
class dashboard__model
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = [
        'createDashboard',
        'addWidget',
        'removeWidget',
        'moveWidgetUp',
        'moveWidgetDown',
        'editDashboardName',
        'removeDashboard'
    ];

    /**
     * Uri ID.
     *
     * @var int.
     */
    public $uriId = null;

    /**
     * Template to render.
     *
     * @var string.
     */
    public $template = null;

    /**
     * Part.
     *
     * @var string.
     */
    public $part = 'dashboard';

    /**
     * Model "admin\dashboard\dashboard__boards_list".
     *
     * @var object.
     */
    private $_dashboardBoardsList = null;

    /**
     * Model "admin\dashboard\dashboard__board".
     *
     * @var object.
     */
    private $_dashboardBoard = null;

    /**
     * Controller "core\render".
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
        $this->_render->assign('admin__dashboard__dashboard__model', $this);

        // Get model "admin\dashboard\dashboard__boards_list".
        $this->_dashboardBoardsList = objects::get('admin/dashboard/dashboard__boards_list');
        $this->_dashboardBoardsList->init();

        // Get URI.
        $uri = objects::get('uri');
        $this->uriId = $uri->getId();

        // Get dashboard UUID.
        $uuid = null;
        $index = $uri->getRequestindex();
        if ($this->uriId === 1) {
            if (isset($index[1])) {
                $uuid = $index[1];
            }
        }
        else {
            if (isset($index[2])) {
                $uuid = $index[2];
            }
        }

        // If dashboard not exists.
        if ($this->uriId === 2) {
             if ($uuid === null) {
                 $this->redirect();
             }
        }

        // Get dashboard.
        $dashboardBoard = null;
        if ($uuid) {
            foreach ($this->_dashboardBoardsList->boardsList as $dashboardsBoardsListBoard) {
                if ($dashboardsBoardsListBoard->uuid === $uuid) {
                    $dashboardBoard = $dashboardsBoardsListBoard;
                    break;
                }
            }
            if (!$dashboardBoard) {
                $this->redirect();
            }
        }

        // Get home dashboard.
        if (!$dashboardBoard) {
            foreach ($this->_dashboardBoardsList->boardsList as $dashboardsBoardsListBoard) {
                if ($dashboardsBoardsListBoard->name === '{home}') {
                    $dashboardBoard = $dashboardsBoardsListBoard;
                }
            }
        }

        // Assign.
        if ($dashboardBoard->init()) {
            $this->_dashboardBoardsList->set();
        }
        $this->_dashboardBoard = $dashboardBoard;
        $this->_render->assign('admin__dashboard__dashboard__board', $dashboardBoard);

        // Dashboard.
        if ($this->uriId === 1) {

            // Set part.
            $this->part = 'dashboard';

            // Set object "core\widgets" and render with object "core\render".
            $widgets = objects::getNew('core/widgets');
            $render = objects::get('render');
            $render->assign('core__widgets', $widgets);

            // Set widgets apps.
            foreach ($this->_dashboardBoard->appsList as $app) {
                $widgets->add($app);
            }

            // Set template.
            $this->template = 'admin/apps/dashboard/views/dashboard__board.tpl';
        }

        // Dashboard edit.
        elseif ($this->uriId === 2) {

            // Set part.
            $this->part = 'edit';

            // Set template.
            $this->template = 'admin/apps/dashboard/views/dashboard__edit_board.tpl';
        }
    }

    /**
     * Redirect.
     */
    protected function redirect()
    {
        // Redirect.
        $url = $this->_render->getUrl(1);
        header('Location: ' . $url);
        die();
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

    /**
     * Create dashboard.
     */
    public function createDashboard()
    {
        // Initialize.
        $this->init();

        // Create dashboard.
        $this->_dashboardBoardsList->create();
    }

    /**
     * Add widget.
     */
    public function addWidget()
    {
        // Initialize.
        $this->init();

        // Add widget.
        $this->_dashboardBoardsList->addWidget($this->_dashboardBoard->uuid);
    }

    /**
     * Remove widget.
     */
    public function removeWidget()
    {
        // Initialize.
        $this->init();

        // Remove widget.
        $this->_dashboardBoardsList->removeWidget($this->_dashboardBoard->uuid);
    }

    /**
     * Move widget up.
     */
    public function moveWidgetUp()
    {
        // Initialize.
        $this->init();

        // Move widget up.
        $this->_dashboardBoardsList->moveWidgetUp($this->_dashboardBoard->uuid);
    }

    /**
     * Move widget down.
     */
    public function moveWidgetDown()
    {
        // Initialize.
        $this->init();

        // Move widget down.
        $this->_dashboardBoardsList->moveWidgetDown($this->_dashboardBoard->uuid);
    }

    /**
     * Edit dashboard name.
     */
    public function editDashboardName()
    {
        // Initialize.
        $this->init();

        // Edit dashboard name.
        $this->_dashboardBoardsList->editDashboardName($this->_dashboardBoard->uuid);
    }

    /**
     * Remove dashboard.
     */
    public function removeDashboard()
    {
        // Initialize.
        $this->init();

        // Remove dashboard.
        $this->_dashboardBoardsList->removeDashboard($this->_dashboardBoard->uuid);
    }

    /**
     * Get admin info.
     *
     * @return bool.
     * @throws exception.
     */
    public function getInfoAdmin()
    {
        $config = objects::get('config');
        $infoAdmin = $config->getInfoAdmin();
        return $infoAdmin;
    }
}