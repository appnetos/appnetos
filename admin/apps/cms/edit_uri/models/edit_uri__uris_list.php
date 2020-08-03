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

// Model "admin\cms\edit_uri__uris_list".
class edit_uri__uris_list
{

    /**
     * URI ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Languages keys for new language.
     *
     * @var array.
     */
    public $languagesNew = [];

    /**
     * Languages IDs for canonical selection.
     *
     * @var array.
     */
    public $languagesCanonical = [];

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
     * URI illegal characters.
     *
     * @var array
     */
    protected $illegalCharacters = [";", "?", ":", "@", "=", "&", "'", "\\", "\"", "<", ">", "#", "%", "{", "}", "|", "^", "~", "[", "]", "`", " "];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        objects::set('admin/cms/edit_uri__uris_list', $this);
        $render = objects::get('render');
        $render->assign('admin__cms__edit_uri__uris_list', $this);

        // Get model "admin\cms\edit_uri__uri".
        objects::get('admin/cms/edit_uri__uri');
        $editUriUri = objects::getNew('admin/cms/edit_uri__uri');
        $render->assign('admin__cms__edit_uri__uri', $editUriUri);
        $editUriUri->id = $this->id;
        $editUriUri->init();

        // Assign.
        objects::set('admin/cms/edit_uri__uri', $editUriUri);

        // Get languages keys for new language.
        if (!$editUriUri->error) {
            $languages = objects::get('languages')->languages;
            foreach ($languages as $languagesLanguage) {
                if ($languagesLanguage->key === 'global') continue;
                $exists = false;
                foreach ($editUriUri->languages as $editUriUriLanguage) {
                    if ($languagesLanguage->key === $editUriUriLanguage->languageKey) {
                        $exists = true;
                        break;
                    }
                }
                if (!$exists) {
                    array_push($this->languagesNew, $languagesLanguage->key);
                }
            }
        }

        // Get languages IDs for canonical selection.
        array_push($this->languagesCanonical, $this->id);
        foreach ($editUriUri->languages as $editUriUriLanguage) {
            array_push($this->languagesCanonical, $editUriUriLanguage->id);
        }
    }

    /**
     * Add.
     */
    public function add()
    {
        // Get model "admin\cms\edit_uri__uri".
        $editUriUri = objects::get('admin/cms/edit_uri__uri');

        // If has error.
        if ($editUriUri->error) {
            $this->render('admin__cms__edit_uri__err_add');
        }

        // Get POST parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__cms__edit_uri__parameters');
        $parameters = json_decode($parameters);

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__cms__edit_uri__err_add');
        }
        if (count($parameters) !== 4) {
            $this->render('admin__cms__edit_uri__err_add');
        }

        // Prepare parameters.
        $language = trim($parameters[0]);
        $uri = trim($parameters[1]);
        $title = trim($parameters[2]);
        $favicon = trim($parameters[3]);

        // If parameters not exists.
        if ($language === '' || $uri === '') {
            $this->render('admin__cms__edit_uri__err_add_valid');
        }

        // Get languages from object "core\languages".
        $languages = objects::get('languages')->languages;
        $exists = false;
        foreach ($languages as $languagesLanguage) {
            if ($languagesLanguage->key === 'global') continue;
            if ($languagesLanguage->key === $language) {
                $exists = true;
                break;
            }
        }

        // If language not active.
        if (!$exists) {
            $this->render('admin__cms__edit_uri__err_load');
        }

        // If language already exists.
        foreach ($editUriUri->languages as $languages) {
            if ($languages->languageKey === $language) {
                $this->render('admin__cms__edit_uri__err_add');
            }
        }

        // If URI is invalid.
        foreach ($this->illegalCharacters as $illegalCharacter) {
            if (strpos($uri, $illegalCharacter)) {
                $this->render('admin__cms__edit_uri__err_add_valid');
            }
        }

        // If URI already exists.
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM application_cms WHERE xt_uri=?';
        $row = $database->selectRow($query, [$uri]);
        if ($row) {
            $this->render('admin__cms__edit_uri__add_exists');
        }

        // Insert data to database table "application_cms".
        $database = objects::get('database');
        $query = 'INSERT INTO application_cms (xt_parent_id, xt_language_key, xt_title, xt_favicon, xt_canonical_id, xt_uri, xt_apps, xt_include, xt_protected, xt_views) VALUES (?, ?, ?, ?, 0, ?, "", "", 0, 0)';
        $database->insert($query, [$this->id, $language, $title, $favicon, $uri]);

        // Render.
        $this->render(null, 'admin__cms__edit_uri__conf_add');
    }

    /**
     * Remove.
     */
    public function remove()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $id= $post->get('admin__cms__edit_uri__parameters');
        $id = (int)$id;

        // If parameters not exists.
        if (!$id) {
            $this->render('admin__cms__edit_uri__err_remove');
        }

        // Select data from database table "application_cms".
        $database = objects::get('database');
        $query = 'SELECT xt_language_key FROM application_cms WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If entry not exists.
        if(!$row) {
            $this->render('admin__cms__edit_uri__err_remove');
        }

        // If entry is global.
        if ($row['xt_language_key'] === 'global') {
            $this->render('admin__cms__edit_uri__err_remove');
        }

        // Delete CMS entry.
        $database = objects::get('database');
        $query = 'DELETE FROM application_cms WHERE xt_id=?';
        $database->delete($query, [$id]);

        // Render.
        $this->render(null, 'admin__cms__edit_uri__conf_remove');
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
        $strings = objects::get('strings');
        $render = objects::get('render');

        // Get model "admin\cms\edit_uri__model".
        $editUriModel = objects::get('admin/cms/edit_uri__model', true);
        $editUriModel->init();

        // Set object.
        $editUriUrisList = objects::get('admin/cms/edit_uri__uris_list');
        if ($error) {
            $editUriUrisList->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $editUriUrisList->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/cms/edit_uri/views/edit_uri__uris_list.tpl');
        echo $output;
        exit();
    }
}