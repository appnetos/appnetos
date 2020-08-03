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

// Controller "admin\groups\application_groups".
class application_groups
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search', 'add', 'edit', 'delete', 'setDefault', 'addGranted', 'removeGranted', 'addDenied', 'removeDenied'];

    /**
     * application_groups constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__model".
        $groupsModel = objects::get('admin/groups/application_groups__model', true);
        $groupsModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object "admin\groups\application_groups__search".
        $groupsSearch = objects::get('admin/groups/application_groups__search');
        $groupsSearch->init();
        $groupsSearch->update();

        // Get model "admin\apps\application_groups__model".
        $groupsModel = objects::get('admin/groups/application_groups__model', true);
        $groupsModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/groups/application_groups/views/application_groups__groups_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Add AJAX request.
     */
    public function add()
    {
        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__groups_list".
        $groupsList = objects::get('admin/groups/application_groups__groups_list', true);
        $groupsList->add();
    }

    /**
     * Set as default AJAX request.
     */
    public function setDefault()
    {
        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__groups_list".
        $groupsList = objects::get('admin/groups/application_groups__groups_list', true);
        $groupsList->setDefault();
    }

    /**
     * Edit AJAX request.
     */
    public function edit()
    {
        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__groups_group".
        $groupsGroup = objects::get('admin/groups/application_groups__group', true);
        $groupsGroup->edit();
    }

    /**
     * Delete AJAX request.
     */
    public function delete()
    {
        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__groups_list".
        $groupsList = objects::get('admin/groups/application_groups__groups_list', true);
        $groupsList->delete();
    }

    /**
     * Add granted AJAX request.
     */
    public function addGranted()
    {
        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__groups_group".
        $groupsGroup = objects::get('admin/groups/application_groups__group', true);
        $groupsGroup->addGranted();
    }

    /**
     * Add denied AJAX request.
     */
    public function addDenied()
    {
        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__groups_list".
        $groupsGroup = objects::get('admin/groups/application_groups__group', true);
        $groupsGroup->addDenied();
    }

    /**
     * Remove granted AJAX request.
     */
    public function removeGranted()
    {
        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__groups_list".
        $groupsGroup = objects::get('admin/groups/application_groups__group', true);
        $groupsGroup->removeGranted();
    }

    /**
     * Remove denied AJAX request.
     */
    public function removeDenied()
    {
        // Set object.
        objects::set('admin/groups/application_groups', $this);

        // Get model "admin\groups\application_groups__groups_list".
        $groupsGroup = objects::get('admin/groups/application_groups__group', true);
        $groupsGroup->removeDenied();
    }
}