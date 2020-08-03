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
 * @description     core/appnetos/cms.php ->    Content management class. Contains CMS data. Get CMS Data from CMS
 *                  database table and set app data, title, favicon and canonical data.
 */

// Namespace.
namespace core;

// Class "core\cms".
class cms extends base
{

    /**
     * ID from database column "xt_id".
     *
     * @var int.
     */
    protected $id = null;

    /**
     * Language ID from database column "xt_id".
     *
     * @var int.
     */
    protected $languageId = null;

    /**
     * Title from database column "xt_title".
     *
     * @var string.
     */
    protected $title = null;

    /**
     * Favicon from database column "xt_favicon".
     *
     * @var string.
     */
    protected $favicon = null;

    /**
     * Canonical id from database column "xt_canonical_id".
     *
     * @var int.
     */
    protected $canonicalId = null;

    /**
     * Meta tags from database column "xt_cms".
     *
     * @var array.
     */
    protected $meta = [];

    /**
     * Array of apps from database column "xt_apps".
     *
     * @var array.
     */
    protected $apps = [];

    /**
     * Array of included apps from database column "xt_include".
     *
     * @var array.
     */
    protected $include = [];

    /**
     * Array of included apps from object "core\render".
     *
     * @var array.
     */
    protected $included = [];

    /**
     * If is cms error.
     *
     * @var bool.
     */
    protected $error = false;

    /**
     * Used object "core\uri".
     *
     * @var object.
     */
    protected $_uri = null;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * cms constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Get used objects.
        $this->_uri = objects::get('uri');
        $this->_database = objects::get('database');

        // Get used variables.
        $this->id = $this->_uri->getId();
        $this->languageId = $this->_uri->getLanguageId();
        $languages = objects::get('languages');
        $this->title = $languages->getTitle();
        $this->favicon = $languages->getFavicon();

        // If is admin.
        if ($this->_uri->getAdmin()) {
            $this->initAdmin();
        }

        // If is application.
        else {
            $this->initApplication();
        }
    }

    /**
     * Initialize application.
     *
     * @return bool.
     * @throws exception.
     */
    protected function initApplication()
    {
        // Get CMS content from database table "application_cms".
        if (!$this->_database) {
            $this->_database = objects::get('database');
        }
        $query = 'SELECT xt_id, xt_title, xt_favicon, xt_apps, xt_include, xt_meta FROM application_cms WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$this->id]);

        // If CMS content not exists.
        if (!$row) {
            $this->error = true;
            return false;
        }

        // Set CMS content.
        $this->id = (int)$row['xt_id'];
        $title = trim($row['xt_title']);
        if ($title) {
            $this->title = $title;
        }
        $favicon = trim($row['xt_favicon']);
        if ($favicon) {
            $this->favicon = $favicon;
        }
        $apps = trim($row['xt_apps']);
        if ($apps !== '') {
            $this->apps = array_map('intval', explode('|', $apps));
        }
        $include = trim($row['xt_include']);
        if ($include !== '') {
            $this->include = array_map('intval', explode('|', $include));
        }
        $meta = trim($row['xt_meta']);
        if ($meta) {
            $this->meta = json_decode($meta);
        }

        // Update views in object "core\uri".
        $this->_uri->updateViews();

        // If from language.
        if ($this->languageId) {
            $query = 'SELECT xt_title, xt_favicon, xt_canonical_id, xt_meta FROM application_cms WHERE xt_id=?';
            $row = $this->_database->selectRow($query, [$this->languageId]);
            if ($row) {
                $title = trim($row['xt_title']);
                if ($title) {
                    $this->title = $title;
                }
                $favicon = trim($row['xt_favicon']);
                if ($favicon) {
                    $this->favicon = $favicon;
                }
                $canonicalId = (int)$row['xt_canonical_id'];
                if ($canonicalId) {
                    $this->canonicalId = $canonicalId;
                }
                $meta = trim($row['xt_meta']);
                if ($meta) {
                    $this->meta = json_decode($meta);
                }
            }
        }

        // Set static apps.
        $query = 'SELECT xt_top, xt_bottom FROM application_static WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [1]);
        $staticTop = [];
        if ($row['xt_top']) {
            $staticTop = array_map('intval', explode('|', $row['xt_top']));
        }
        $staticBottom = [];
        if ($row['xt_bottom']) {
            $staticBottom = array_map('intval', explode('|', $row['xt_bottom']));
        }
        $this->apps = array_merge($staticTop, $this->apps, $staticBottom);

        // Return.
        return true;
    }

    /**
     * Initialize admin section.
     *
     * @return bool.
     * @throws exception.
     */
    protected function initAdmin()
    {
        // Get CMS content from database table "admin_cms".
        if (!$this->_database) {
            $this->_database = objects::get('database');
        }
        $query = 'SELECT xt_id, xt_title, xt_favicon, xt_apps, xt_include FROM admin_cms WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$this->id]);

        // If CMS content not exists.
        if (!$row) {
            return false;
        }

        // Set CMS content.
        $this->id = $row['xt_id'];
        if ($row['xt_title'] && $row['xt_title'] !== '') {
            $this->title = $row['xt_title'];
        }
        if ($row['xt_favicon'] && $row['xt_favicon'] !== '') {
            $this->favicon = $row['xt_favicon'];
        }
        $apps = trim($row['xt_apps']);
        if ($apps !== '') {
            $this->apps = array_map('intval', explode('|', $apps));
        }
        $include = trim($row['xt_include']);
        if ($include !== '') {
            $this->include = array_map('intval', explode('|', $include));
        }

        // If from language.
        if ($this->languageId) {
            $query = 'SELECT xt_title, xt_favicon FROM admin_cms WHERE xt_id=?';
            $row = $this->_database->selectRow($query, [$this->languageId]);
            if ($row) {
                if ($row['xt_title'] && $row['xt_title'] !== '') {
                    $this->title = $row['xt_title'];
                }
                if ($row['xt_favicon'] && $row['xt_favicon'] !== '') {
                    $this->favicon = $row['xt_favicon'];
                }
            }
        }

        // Set static apps.
        $query = 'SELECT xt_top, xt_bottom FROM admin_static WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [1]);
        $staticTop = [];
        if ($row['xt_top'] !== '') {
            $staticTop = array_map('intval', explode('|', $row['xt_top']));
        }
        $staticBottom = [];
        if ($row['xt_bottom'] !== '') {
            $staticBottom = array_map('intval', explode('|', $row['xt_bottom']));
        }
        $this->apps = array_merge($staticTop, $this->apps, $staticBottom);

        // Return.
        return true;
    }

    /**
     * Set title.
     *
     * @param string $title.
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set favicon.
     *
     * @param string $favicon.
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;
    }

    /**
     * Add meta tag.
     *
     * @param string $name.
     * @param string $content.
     * @param string $nameTag.
     * @param string $contentTag.
     */
    public function addMeta($name, $content, $nameTag = 'name', $contentTag = 'content')
    {
        // Search to meta object.
        for ($i = 0; $i < count($this->meta); $i++) {
            if ($this->meta[$i]->nameTag === $nameTag && $this->meta[$i]->contentTag === $contentTag) {
                $this->meta[$i]->name = $name;
                $this->meta[$i]->content = $content;
                return;
            }
        }

        // Create meta object.
        $meta = new \stdClass();
        $meta->nameTag = $nameTag;
        $meta->name = $name;
        $meta->contentTag = $contentTag;
        $meta->content = $content;

        // Add object to meta.
        array_push($this->meta, $meta);
    }

    /**
     * Add included app.
     *
     * @param $id int app ID.
     */
    public function addIncluded($id)
    {
        // Prepare parameters.
        $id = (int)$id;

        // Add ID to included apps.
        array_push($this->included, $id);
    }

    /**
     * Get ID.
     *
     * @return int.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get language ID.
     *
     * @return int.
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * Get title.
     *
     * @return string.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get favicon.
     *
     * @return string.
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * Get array of apps.
     *
     * @return array.
     */
    public function getApps()
    {
        return $this->apps;
    }

    /**
     * Get array of included apps.
     *
     * @return array.
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * Get Canonical.
     *
     * @return string.
     * @throws.
     */
    public function getCanonical()
    {
        // If canonical id not exists.
        if (!$this->canonicalId) {
            return;
        }

        // Get data from database table "application_cms".
        $query = "SELECT xt_uri FROM application_cms WHERE xt_id=?";
        $row = $this->_database->selectRow($query, [$this->canonicalId]);

        // If data not exists.
        if (!$row) {
            throw new exception('Canonical target does not exists. Please unset canonical in _uri editor for _uri');
        }

        // If data exists.
        $config = objects::get('config');
        return $config->getUrl() . '/' . $row['xt_uri'];
    }

    /**
     * Get meta tags.
     *
     * @param string $name.
     * @param string $nameTag.
     * @return mixed.
     */
    public function getMeta($name = null, $nameTag = null)
    {
        // If no name parameter exists.
        if (!$name) {
            return $this->meta;
        }

        // If no name tag parameters exists.
        if (!$nameTag) {
            $nameTag = 'name';
        }

        // Search and return meta object.
        foreach ($this->meta as $meta) {
            if ($meta->nameTag === $nameTag && $meta->name === $name) {
                return $meta;
            }
        }

        // If no meta object found.
        return false;
    }

    /**
     * Destruct by object "core\destruct".
     */
    public function destruct()
    {
        // Get from object "core\uri".
        if (!$this->_uri) {
            $this->_uri = objects::get('uri');
        }

        // If is AJAX.
        if ($this->_uri->getAjax()) {
            return;
        }

        // If no changes.
        sort($this->include);
        sort($this->included);
        if ($this->include == $this->included) {
            return;
        }

        // Prepare parameters.
        $included = implode('|', $this->included);

        // Get object "core\uri" and object "core\database".
        if (!$this->_uri) {
            $this->_uri = objects::get('uri');
        }
        if (!$this->_database) {
            $this->_database = objects::get('database');
        }

        // If user is not admin.
        if (!$this->_uri->admin) {

            // Update database table "application__cms".
            $query = 'UPDATE application_cms SET xt_include=? WHERE xt_id=?';
            $this->_database->update($query, [$included, $this->id]);
            return;
        }

        // Update database table "admin__cms".
        $query = 'UPDATE admin_cms SET xt_include=? WHERE xt_id=?';
        $this->_database->update($query, [$included, $this->id]);
        return;
    }
}