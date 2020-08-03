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

// Model "admin\settings\settings__size".
class settings__size
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['update'];

    /**
     * App bootstrap col data.
     *
     * @var array.
     */
    public $col = [12, 12, 12, 12, 12];

    /**
     * App bootstrap offset data.
     *
     * @var array.
     */
    public $offset = [0, 0, 0, 0, 0];

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
        // Get objects.
        $settingsApp = objects::get('admin/apps/settings__app');

        // Process grid data.
        $tags = explode(' ', $settingsApp->containerGrid);
        for ($i = 0; $i < count($tags); $i++) {
            if (strpos($tags[$i], 'col-sm-') !== false) {
                $tmp = explode('col-sm-', $tags[$i]);
                $this->col[1] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'col-md-') !== false) {
                $tmp = explode('col-md-', $tags[$i]);
                $this->col[2] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'col-lg-') !== false) {
                $tmp = explode('col-lg-', $tags[$i]);
                $this->col[3] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'col-xl-') !== false) {
                $tmp = explode('col-xl-', $tags[$i]);
                $this->col[4] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'col-') !== false) {
                $tmp = explode('col-', $tags[$i]);
                $this->col[0] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'offset-sm-') !== false) {
                $tmp = explode('offset-sm-', $tags[$i]);
                $this->offset[1] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'offset-md-') !== false) {
                $tmp = explode('offset-md-', $tags[$i]);
                $this->offset[2] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'offset-lg-') !== false) {
                $tmp = explode('offset-lg-', $tags[$i]);
                $this->offset[3] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'offset-xl-') !== false) {
                $tmp = explode('offset-xl-', $tags[$i]);
                $this->offset[4] = (int)$tmp[1];
            } elseif (strpos($tags[$i], 'offset-') !== false) {
                $tmp = explode('offset-', $tags[$i]);
                $this->offset[0] = (int)$tmp[1];
            }
        }
    }

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
        if($uriId !== 307 || !isset($index[4])) {
            $this->render('admin__apps__settings__size_err');
        }

        // Get parameters.
        $appId = $index[4];
        $post = objects::get('post');
        $parameters = trim($post->get('admin__apps__settings__parameters'));

        // If parameters nor exists.
        if (!$parameters === null) {
            $this->render('admin__apps__settings__size_err');
        }

        // Update database table "application_apps".
        $database = objects::get('database');
        $query = 'UPDATE application_apps SET xt_container_grid=? WHERE xt_id=?';
        $database->update($query, [$parameters, $appId]);

        // Render.
        $this->render(null, 'admin__apps__settings__size_conf');
    }

    /**
     * Render template.
     * Echo rendered template.
     *
     * @param string $error.
     * @param string $confirm.
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
        $render->assign('admin__apps__settings__size', $this);

        // Render template.
        $output = $render->fetch('admin/apps/apps/settings/views/settings__size.tpl');
        echo $output;
        exit();
    }
}