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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Namespace.
namespace admin\apps;

// Use.
use core\objects;

// Model "admin\apps\settings_data".
class settings__data
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['update'];

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
     * Update.
     */
    public function update()
    {
        // Get object "core\uri".
        $uri = objects::get('uri');
        $index = $uri->getRequestindex();
        $uriId = $uri->getId();

        // If URI parameters wrong.
        if($uriId !== 306 || !isset($index[3])) {
            $this->render('admin__apps__settings__data_err');
        }

        // Get parameters.
        $appId = $index[3];
        $post = objects::get('post');
        $parameters = trim($post->get('admin__apps__settings__parameters'));

        // If parameters nor exists.
        if (!$parameters === null) {
            $this->render('admin__apps__settings__data_err');
        }

        // Decode parameters.
        $parameters = json_decode($parameters);

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__apps__settings__data_err');
        }
        if (count($parameters) !== 7) {
            $this->render('admin__apps__settings__data_err');
        }

        // Prepare parameters.
        $cache = 0;
        if ($parameters[4] === 'on') {
            $cache = 1;
        }
        $jsCache = 0;
        if ($parameters[5] === 'on') {
            $jsCache = 1;
        }
        $cssCache = 0;
        if ($parameters[6] === 'on') {
            $cssCache = 1;
        }

        // Update database table "application_apps".
        $database = objects::get('database');
        $query = 'UPDATE application_apps SET xt_description=?, xt_container_css=?, xt_container_fluid_css=?, xt_app_css=?, xt_cache=?, xt_js_cache=?, xt_css_cache=?  WHERE xt_id=?';
        $database->update($query, [$parameters[0], $parameters[2], $parameters[1], $parameters[3], $cache, $jsCache, $cssCache, $appId]);

        // Render.
        $this->render(null, 'admin__apps__settings__data_conf');echo var_dump($parameters);
    }

    /**
     * Render template.
     * Echo rendered template.
     *
     * @param string $error.
     * @param string $confirm.
     * @throws \core\exception.
     */
    protected function render($error = null, $confirm = null)
    {
        // Get model "admin\apps\create__model".
        $createModel = objects::get('admin/apps/settings__model', true);
        $createModel->init();

        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Assign.
        $render->assign('admin__apps__settings__data', $this);

        // Render template.
        $output = $render->fetch('admin/apps/apps/settings/views/settings__data.tpl');
        echo $output;
        exit();
    }
}