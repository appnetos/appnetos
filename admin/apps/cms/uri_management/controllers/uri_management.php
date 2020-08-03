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
 * @description     Admin URI management to add and delete URIs.
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Controller "admin\cms\uri_management".
class uri_management
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['search', 'add', 'delete'];

    /**
     * URI illegal characters.
     *
     * @var array
     */
    protected $illegalCharacters = [";", "?", ":", "@", "=", "&", "'", "\\", "\"", "<", ">", "#", "%", "{", "}", "|", "^", "~", "[", "]", "`", " "];

    /**
     * uri_management constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/cms/uri_management', $this);

        // Get model "admin\cms\uri_management__model".
        $uriManagementModel = objects::get('admin/cms/uri_management__model', true);
        $uriManagementModel->init();
    }

    /**
     * Search AJAX request.
     */
    public function search()
    {
        // Get object search.
        $uriManagementSearch = objects::get('admin/cms/uri_management__search');
        $uriManagementSearch->init();
        $uriManagementSearch->update();

        // Get model "admin\cms\uri_management__model".
        $uriManagementModel = objects::get('admin/cms/uri_management__model', true);
        $uriManagementModel->init();

        // Render template.
        $render = objects::get('render');
        $output = $render->fetch('admin/apps/cms/uri_management/views/uri_management__uris_list.tpl');
        echo $output;
        exit();
    }

    /**
     * Delete AJAX request.
     */
    public function delete()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__cms__uri_management__id');

        // If parameters not exists.
        if (!$id) {
            return;
        }

        // Delete URI.
        $cmsUriManagementUri = objects::get('admin/cms/uri_management__uri');
        $cmsUriManagementUri->id = $id;
        $cmsUriManagementUri->init();
        $cmsUriManagementUri->delete();
    }

    /**
     * Add AJAX request.
     */
    public function add()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__cms__uri_management__parameters');
        $parameters = json_decode($parameters);

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__cms__uri_management__err_add');
        }
        if (count($parameters) !== 3) {
            $this->render('admin__cms__uri_management__err_add');
        }

        // Prepare parameters.
        $uri = $parameters[0];
        $title = $parameters[1];
        $favicon = $parameters[2];

        // if URI is invalid.
        foreach ($this->illegalCharacters as $illegalCharacter) {
            if (strpos($uri, $illegalCharacter)) {
                $this->render('admin__cms__uri_management__err_add_valid');
            }
        }

        // If favicon is invalid.
        $tmp = filter_var($favicon, FILTER_SANITIZE_URL);
        if ($tmp != $favicon) {
            $this->render('admin__cms__uri_management__err_add_favicon');
        }

        // If cms already exists.
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM application_cms WHERE xt_uri=?';
        $row = $database->selectRow($query, [$uri]);
        if ($row) {
            $this->render('admin__cms__uri_management__err_add_exists');
        }

        // Set title.
        if (trim($title) === '') {
            $title = $uri;
        }

        // Insert into database table "application_cms".
        $database = objects::get('database');
        $query = 'INSERT INTO application_cms (xt_parent_id, xt_language_key, xt_title, xt_favicon, xt_canonical_id, xt_uri, xt_apps, xt_include, xt_protected, xt_views) VALUES (0, ?, ?, ?, 0, ?, "", "", 0, 0)';

        // If not inserted.
        if (!$database->insert($query, ['global', $title, $favicon, $uri])) {
            $this->render('admin__cms__uri_management__err_add');
        }

        // Render.
        $this->render(null, 'admin__cms__uri_management__conf_add');
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     */
    protected function render($error = null, $confirm = null) {

        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');

        // Set object.
        objects::set('admin/cms/uri_management', $this);

        // Get model "admin\cms\uri_management__model".
        $uriManagementModel = objects::get('admin/cms/uri_management__model', true);
        $uriManagementModel->init();

        // Get model "admin\cms\uri_management__uris_list".
        $uriManagementUrisList = objects::get('admin/cms/uri_management__uris_list');
        if ($error) {
            $uriManagementUrisList->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $uriManagementUrisList->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/cms/uri_management/views/uri_management__uris_list.tpl');
        echo $output;
        exit();
    }
}