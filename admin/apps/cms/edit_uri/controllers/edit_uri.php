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
 * @description     Admin edit URI and languages URIs.
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Controller "admin\cms\edit_uri".
class edit_uri
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['add', 'remove', 'editUri', 'editMeta'];

    /**
     * edit_uri constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Assign.
        objects::set('admin/cms/edit_uri', $this);

        // Get model "admin\cms\edit_uri__model".
        $editUriModel = objects::get('admin/cms/edit_uri__model', true);
        $editUriModel->init();
    }

    /**
     * Add AJAX request.
     */
    public function add()
    {
        // Set object.
        objects::set('admin/cms/edit_uri', $this);

        // Get model "admin\cms\edit_uri__model".
        $editUriModel = objects::get('admin/cms/edit_uri__model', true);
        $editUriModel->init();

        // Get model "admin\cms\edit_uri__uris_list".
        $editUriUrisList = objects::get('admin/cms/edit_uri__uris_list');
        $editUriUrisList->add();
    }

    /**
     * Remove AJAX request.
     */
    public function remove()
    {
        // Set object.
        objects::set('admin/cms/edit_uri', $this);

        // Get model "admin\cms\edit_uri__model".
        $editUriModel = objects::get('admin/cms/edit_uri__model', true);
        $editUriModel->init();

        // Get model "admin\cms\edit_uri__uris_list".
        $editUriUrisList = objects::get('admin/cms/edit_uri__uris_list');
        $editUriUrisList->remove();
    }

    /**
     * Edit URI AJAX request.
     */
    public function editUri()
    {
        // Set object.
        objects::set('admin/cms/edit_uri', $this);

        // Get model "admin\cms\edit_uri__model".
        $editUriModel = objects::get('admin/cms/edit_uri__model', true);
        $editUriModel->init();

        // Edit URI.
        $editUriUri = objects::get('admin/cms/edit_uri__uri');
        $editUriUri->editUri();
    }

    /**
     * Edit meta AJAX request
     */
    public function editMeta()
    {
        // Set object.
        objects::set('admin/cms/edit_uri', $this);

        // Get model "admin\cms\edit_uri__model".
        $editUriModel = objects::get('admin/cms/edit_uri__model', true);
        $editUriModel->init();

        // Edit Meta.
        $editUriUri = objects::get('admin/cms/edit_uri__uri');
        $editUriUri->editMeta();
    }
}