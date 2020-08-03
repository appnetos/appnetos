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
 * @description     Admin language settings.
 */

// Namespace.
namespace admin\settings;

// Use.
use \core\objects;

// Model "admin\settings\languages__language".
class languages__language
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Key.
     *
     * @var string.
     */
    public $key = null;

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * English name.
     *
     * @var string.
     */
    public $nameEn = null;

    /**
     * If is active.
     *
     * @var bool.
     */
    public $active = false;

    /**
     * If is default.
     *
     * @var bool.
     */
    public $default = false;

    /**
     * Title.
     *
     * @var string.
     */
    public $title = null;

    /**
     * Favicon.
     *
     * @var string.
     */
    public $favicon = null;

    /**
     * If is admin active.
     *
     * @var bool.
     */
    public $adminActive = false;

    /**
     * If is admin default.
     *
     * @var bool.
     */
    public $adminDefault = false;

    /**
     * If is error.
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
     * Initialize.
     */
    public function init()
    {
        // Select from database table "languages".
        $database = objects::get('database');
        $query = 'SELECT * FROM languages WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set data to class.
        $this->id = (int)$row['xt_id'];
        $this->key = $row['xt_key'];
        if ($row['xt_name'] === '') {
            $this->name = $row['xt_name_en'];
        }
        else {
            $this->name = $row['xt_name'];
        }
        $this->nameEn = $row['xt_name_en'];
        $this->active = (bool)$row['xt_active'];
        $this->default = (bool)$row['xt_default'];
        $this->title = $row['xt_title'];
        $this->favicon = $row['xt_favicon'];
        $this->adminActive = (bool)$row['xt_admin_active'];
        $this->adminDefault = (bool)$row['xt_admin_default'];
    }

    /**
     * Default.
     */
    public function default()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__settings__languages__parameters');
        $id = (int)$id;

        // Initialize.
        $this->id = $id;
        $this->init();

        // If language not exists.
        if ($this->error) {
            $this->render('admin__settings__languages__err_default');
        }

        // Update database table "languages".
        $database = objects::get('database');
        $query = 'UPDATE languages SET xt_default=0';
        $database->update($query);
        $query = 'UPDATE languages SET xt_default=1 WHERE xt_id=?';
        $database->update($query, [$id]);

        // Render.
        $this->init();
        $this->render(null, 'admin__settings__languages__conf_default');
    }

    /**
     * Edit.
     */
    public function edit()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__settings__languages__parameters');
        $parameters = json_decode($parameters);

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__settings__languages__err_edit');
        }
        if (count($parameters) !== 3) {
            $this->render('admin__settings__languages__err_edit');
        }

        // Prepare parameters.
        $id = trim($parameters[0]);
        $id = (int)$id;
        $title = trim($parameters[1]);
        $favicon = trim($parameters[2]);

        // Initialize.
        $this->id = $id;
        $this->init();

        // If user not exists.
        if ($this->error) {
            $this->render('admin__settings__languages__err_edit');
        }

        // Update database table "languages".
        $database = objects::get('database');
        $query = 'UPDATE languages SET xt_title=?, xt_favicon=? WHERE xt_id=?';
        $database->update($query, [$title, $favicon, $id]);

        // Render.
        $this->init();
        $this->render(null, 'admin__settings__languages__conf_edit');
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $render = objects::get('render');
        $render->assign('admin__settings__languages__language', $this);
        $strings = objects::get('strings');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Get used objects.
        $languagesLanguagesList = objects::get('admin/settings/languages__languages_list', true);
        $languagesLanguagesList->init();

        // Render template.
        $output = $render->fetch('admin/apps/settings/languages/views/languages__language.tpl');
        echo $output;
        exit();
    }
}