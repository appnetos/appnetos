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
 * @description     Admin URI apps management.
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Model "admin\cms\manage_apps__uri".
class manage_apps__uri
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
                    $manageAppsUri = objects::getNew('admin/cms/manage_apps__uri');
                    $manageAppsUri->id = (int)$array[$i]['xt_id'];
                    $manageAppsUri->init();
                    array_push($this->languages, $manageAppsUri);
                }
            }
        }
        $this->languagesCount = count($this->languages);
    }

    /**
     * Get languages.
     *
     * @return string.
     */
    public function getLanguages()
    {
        $array = [];
        array_push($array, 'global');
        foreach ($this->languages as $language) {
            array_push($array, $language->languageKey);
        }
        if (count($array)) {
            return implode(' | ', $array);
        }
    }
}