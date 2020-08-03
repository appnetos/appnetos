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

// Controller "admin\apps\management".
class management
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = [
        'search',
        'activate',
        'deactivate',
        'remove',
        'delete',
        'reset',
        'duplicate'
    ];

    /**
     * management constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/apps/management', $this);

        // Get model "admin\apps\management__model".
        $managementModel = objects::get('admin/apps/management__model', true);
        $managementModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get model "admin\apps\management__search".
        $managementSearch = objects::get('admin/apps/management__search');
        $managementSearch->init();
        $managementSearch->update();

        // Get model "admin\apps\management__model".
        $managementModel = objects::get('admin/apps/management__model', true);
        $managementModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/apps/management/views/management__apps_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Activate AJAX request.
     */
    public function activate()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__apps__management__id');

        // If parameters not exists.
        if (!$id) {
            return;
        }

        // Install application.
        $managementApp = objects::get('admin/apps/management__app');
        $managementApp->id = (int)$id;
        $managementApp->init();
        $managementApp->activate();
    }

    /**
     * Deactivate AJAX request.
     */
    public function deactivate()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__apps__management__id');

        // If parameters not exists.
        if (!$id) {
            return;
        }

        // Install application.
        $managementApp = objects::get('admin/apps/management__app');
        $managementApp->id = (int)$id;
        $managementApp->init();
        $managementApp->deactivate();
    }

    /**
     * Remove AJAX request.
     */
    public function remove()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__apps__management__id');

        // If parameters not exists.
        if (!$id) {
            return;
        }

        // Install application.
        $managementApp = objects::get('admin/apps/management__app');
        $managementApp->id = (int)$id;
        $managementApp->init();
        $managementApp->remove();
    }

    /**
     * Delete AJAX request.
     */
    public function delete()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__apps__management__id');

        // If parameters not exists.
        if (!$id) {
            return;
        }

        // Delete application.
        $managementApp = objects::get('admin/apps/management__app');
        $managementApp->id = (int)$id;
        $managementApp->init();
        $managementApp->delete();
    }

    /**
     * Reset AJAX request.
     */
    public function reset()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__apps__management__id');

        // If parameters not exists.
        if (!$id) {
            return;
        }

        // Install application.
        $managementApp = objects::get('admin/apps/management__app');
        $managementApp->id = (int)$id;
        $managementApp->init();
        $managementApp->reset();
    }

    /**
     * Duplicate AJAX request.
     */
    public function duplicate()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__apps__management__id');

        // If parameters not exists.
        if (!$id) {
            return;
        }

        // Install application.
        $managementApp = objects::get('admin/apps/management__app');
        $managementApp->id = (int)$id;
        $managementApp->init();
        $managementApp->duplicate();
    }
}