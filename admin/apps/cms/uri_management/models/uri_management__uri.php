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

// Model "admin\cms\uri_management__uri".
class uri_management__uri
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Parent ID.
     *
     * @var int.
     */
    public $parentId = null;

    /**
     * Language key.
     *
     * @var int.
     */
    public $languageKey = null;

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
     * Canonical URI ID.
     *
     * @var string.
     */
    public $canonical = 0;

    /**
     * URI.
     *
     * @var string.
     */
    public $uri = null;

    /**
     * Apps.
     *
     * @var array.
     */
    public $apps = [];

    /**
     * Apps count.
     *
     * @var int.
     */
    public $appsCount = 0;

    /**
     * Include apps.
     *
     * @var array.
     */
    public $include = [];

    /**
     * Include apps count.
     *
     * @var int.
     */
    public $includeCount = 0;

    /**
     * Views.
     *
     * @var int.
     */
    public $views = 0;

    /**
     * Languages children.
     *
     * @var array.
     */
    public $languages = [];

    /**
     * Languages children count.
     *
     * @var int.
     */
    public $languagesCount = 0;

    /**
     * Protected level.
     *
     * @var int.
     */
    public $protected = null;

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
        // Select from database table "application_cms".
        $database = objects::get('database');
        $query = 'SELECT * FROM application_cms WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set data to class.
        $this->title = $row['xt_title'];
        $this->parentId = $row['xt_parent_id'];
        $this->parentId = (int)$this->parentId;
        $this->languageKey = $row['xt_language_key'];
        $this->favicon = $row['xt_favicon'];
        $this->canonical = $row['xt_canonical_id'];
        $this->canonical = (int)$this->canonical;
        $this->uri = $row['xt_uri'];
        $apps = trim($row['xt_apps']);
        if ($apps !== '') {
            $this->apps = array_map('intval', explode('|', $apps));
        }
        $include = trim($row['xt_include']);
        if ($include !== '') {
            $this->include = array_map('intval', explode('|', $include));
        }
        $this->views = $row['xt_views'];
        $this->protected = $row['xt_protected'];
        $this->protected = (int)$this->protected;

        // Get languages.
        if (!$this->parentId) {

            // Select from database table "application_cms".
            $query = 'SELECT xt_id FROM application_cms WHERE xt_parent_id=?';
            $array = $database->selectArray($query, [$this->id]);

            // Set languages.
            if ($array) {
                for ($i = 0; $i < count($array); $i++) {
                    $uriManagementUri = objects::getNew('admin/cms/uri_management__uri');
                    $uriManagementUri->id = $array[$i]['xt_id'];
                    $uriManagementUri->init();
                    array_push($this->languages, $uriManagementUri);
                }
            }
        }
        $this->languagesCount = count($this->languages);
    }

    /**
     * Delete.
     */
    public function delete()
    {
        // If is error.
        if ($this->error) {
            $this->render('admin__cms__uri_management__err_delete');
        }

        // Delete from database table "application_cms".
        $database = objects::get('database');
        $query = 'DELETE FROM application_cms WHERE xt_id=? OR xt_parent_id=?';

        // If CMS entry not exists.
        if (!$database->delete($query, [$this->id, $this->id])) {
            $this->render('admin__cms__uri_management__err_delete');
        }

        // Render template.
        $this->error = true;
        $this->render(null, 'admin__cms__uri_management__conf_delete');
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     * @throws.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $render = objects::get('render');
        $render->assign('admin__cms__uri_management__uri', $this);
        $strings = objects::get('strings');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $uriManagementSearch = objects::get('admin/cms/uri_management__search');
        $uriManagementSearch->init();
        $output = $render->fetch('admin/apps/cms/uri_management/views/uri_management__uri.tpl');
        echo $output;
        exit();
    }

    /**
     * Get languages.
     *
     * @return string.
     */
    public function getLanguages()
    {
        $array = [];
        foreach ($this->languages as $language) {
            array_push($array, $language->languageKey);
        }
        if (count($array)) {
            return implode(' | ', $array);
        }
    }
}