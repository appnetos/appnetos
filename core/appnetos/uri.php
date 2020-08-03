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
 * @description     core/appnetos/uri.php ->    Multilingual URI class. Process URI information. Get request if request
 *                  is application or admin section. Get if is AJAX request. Get apps from CMS database table.
 */

// Namespace.
namespace core;

// Class "core\uri".
class uri extends base
{

    /**
     * Server request URI.
     *
     * @var string.
     */
    protected $request = null;

    /**
     * Server request URI without URL from "config.inc.php".
     *
     * @var string.
     */
    protected $requestUri = null;

    /**
     * Server request URI index array, URI splitted by "/".
     *
     * @var array.
     */
    protected $requestIndex = [];

    /**
     * If is admin section request.
     *
     * @var bool.
     */
    protected $admin = false;

    /**
     * If is ajax request.
     *
     * @var bool.
     */
    protected $ajax = false;

    /**
     * If ajax request has errors.
     *
     * @var bool.
     */
    protected $ajaxError = false;

    /**
     * CMS ID, "xt_id" from cms database table "application_cms" or "admin_cms".
     *
     * @var int.
     */
    protected $id = null;

    /**
     * CMS language ID, "xt_id" from cms database table "application_cms" or "admin_cms" if request is language.
     *
     * @var int.
     */
    protected $languageId = null;

    /**
     * CMS URI, "xt_uri" from cms database table "application_cms" or "admin_cms".
     *
     * @var int.
     */
    protected $uri = null;

    /**
     * Index without CMS URI parts.
     *
     * @var array.
     */
    protected $index = [];

    /**
     * CMS language URI, "xt_uri" from cms database table "application_cms" or "admin_cms" if request is language.
     *
     * @var int.
     */
    protected $languageUri = null;

    /**
     * CMS count of views, "xt_views" from cms database table "application_cms" or "admin_cms".
     *
     * @var int.
     */
    protected $views = null;

    /**
     * CMS count of language views, "xt_views" from cms database table "application_cms" or "admin_cms" if request is
     * language.
     *
     * @var int.
     */
    protected $languageViews = null;

    /**
     * Request status code.
     *
     * @var int.
     */
    protected $status = null;

    /**
     * If requested uri has errors.
     *
     * @var bool.
     */
    protected $error = false;

    /**
     * Cached URLs by ID.
     *
     * @var array.
     */
    protected $_urlCacheId = [];

    /**
     * Cached URLs by URL.
     *
     * @var array.
     */
    protected $_urlCacheUrl = [];

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * Used object "core\post".
     *
     * @var object.
     */
    protected $_post = null;

    /**
     * Used object "core\session".
     *
     * @var object.
     */
    protected $_session = null;

    /**
     * Used object "core\config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * Used object "core\log".
     *
     * @var object.
     */
    protected $_log = null;

    /**
     * Used object "core\languages" get on runtime.
     *
     * @var object.
     */
    protected $_languages = null;

    /**
     * Used object "core\group" get on runtime.
     *
     * @var object.
     */
    protected $_group = null;

    /**
     * uri constructor.
     *
     * @throws.
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
        $this->_database = objects::get('database');
        $this->_post = objects::get('post');
        $this->_session = objects::get('session');
        $this->_config = objects::get('config');
        $this->_log = objects::get('log');

        // Initialize request.
        $this->initRequest();

        // Initialize admin section.
        if ($this->requestIndex[0] === 'admin') {
            $this->admin = true;
            $this->initAdmin();
        }

        // Initialize application.
        else {
            $this->initApplication();
        }

        // Initialize ajax request.
        $this->initAjax();
    }

    /**
     * Initialize request.
     *
     * @return bool.
     */
    protected function initRequest()
    {
        // If request URI is not set.
        if (!isset($_SERVER['REQUEST_URI'])) {
            return false;
        }

        // Set parameters.
        $this->request = urldecode($_SERVER['REQUEST_URI']);
        $this->request = trim($this->request);
        $this->request = trim($this->request, "/\\");
        $tmp = explode('?', $this->request);
        $this->request = $tmp[0];
        $basePath = str_replace("\\", "/", BASEPATH);
        $basePath = trim($basePath, "/");
        $basePath = explode('/', $basePath);
        $basePath = $basePath[count($basePath) - 1];
        $basePath = explode($basePath, $this->request);
        $basePath = $basePath[count($basePath) - 1];
        $basePath = trim($basePath, "/");
        $basePath = explode('/', $basePath);
        for ($i = 0; $i < count($basePath); $i++) {
            if (strlen($basePath[$i])) {
                $this->requestUri .= $basePath[$i];
                if ($i != (count($basePath) - 1)) {
                    $this->requestUri .= '/';
                }
            }
        }
        $tmp = trim($this->requestUri, '/');
        $this->requestIndex = explode('/', $tmp);

        // Return.
        return true;
    }

    /**
     * Initialize application.
     *
     * @return bool.
     * @throws exception. Error: Parent URI of requested multilingual URI not exists error.
     */
    protected function initApplication()
    {
        // Select CMS entry from database table "application_cms" by shortening of the URI.
        for ($i = count($this->requestIndex); $i >= 0; $i--) {

            // Build query by shortening of the URI.
            $arr = array_slice($this->requestIndex, 0, $i);
            $uri = implode('/', $arr);
            $query = 'SELECT xt_id, xt_uri, xt_parent_id, xt_views FROM application_cms WHERE xt_uri=?';
            $row = $this->_database->selectRow($query, [$uri]);

            // If data not exists.
            if (!$row) {
                continue;
            }

            // Generate index.
            $this->index = [];
            for ($ii = 0; $ii < count($this->requestIndex); $ii++) {
                if (!isset($arr[$ii])) {
                    array_push($this->index, $this->requestIndex[$ii]);
                }
            }

            // If URI is multilingual.
            if ((int)$row['xt_parent_id']) {

                // Set language URI data.
                $this->languageId = (int)$row['xt_id'];
                $this->languageUri = (int)$row['xt_uri'];
                $this->languageViews = (int)$row['xt_views'];

                // Select parent CMS entry from database table "application_cms".
                $query = 'SELECT xt_id, xt_uri, xt_views FROM application_cms WHERE xt_id=?';
                $row = $this->_database->selectRow($query, [(int)$row['xt_parent_id']]);

                // If data exists.
                if ($row) {

                    // Set URI data.
                    $this->id = (int)$row['xt_id'];
                    $this->uri = $row['xt_uri'];
                    $this->views = (int)$row['xt_views'];
                    return true;
                }

                // If data not exists.
                throw new exception('Parent URI of requested multilingual URI not exists error');
            }

            // If URI is not multilingual.
            else {

                // Set URI data.
                $this->id = (int)$row['xt_id'];
                $this->uri = $row['xt_uri'];
                $this->views = (int)$row['xt_views'];
                return true;
            }
        }

        // If page not found.
        $this->status = 404;
        return false;
    }

    /**
     * Initialize admin section.
     *
     * @return bool.
     * @throws exception. Error: Parent URI of requested multilingual URI not exists error.
     */
    protected function initAdmin()
    {
        // Select CMS entry from database table "admin_cms" by shortening of the URI.
        for ($i = count($this->requestIndex); $i > 0; $i--) {

            // Build query by shortening of the URI.
            $arr = array_slice($this->requestIndex, 0, $i);
            $uri = implode('/', $arr);
            $query = 'SELECT xt_id, xt_uri, xt_parent_id, xt_uri FROM admin_cms WHERE xt_uri=?';
            $row = $this->_database->selectRow($query, [$uri]);

            // If data not exists.
            if (!$row) {
                continue;
            }

            // Generate index.
            $this->index = [];
            for ($ii = 0; $ii < count($this->requestIndex); $ii++) {
                if (!isset($arr[$ii])) {
                    array_push($this->index, $this->requestIndex[$ii]);
                }
            }

            // If URI is multilingual.
            if ((int)$row['xt_parent_id']) {

                // Set language URI data.
                $this->languageId = (int)$row['xt_id'];
                $this->languageUri = (int)$row['xt_uri'];

                // Select parent CMS entry from database table "admin_cms".
                $query = 'SELECT xt_id, xt_uri FROM admin_cms WHERE xt_id=?';
                $row = $this->_database->selectRow($query, [(int)$row['xt_parent_id']]);

                // If data exists.
                if ($row) {
                    $this->id = (int)$row['xt_id'];
                    $this->uri = $row['xt_uri'];
                    return true;
                }

                // If data not exists.
                throw new exception('Parent URI of requested multilingual URI not exists error');
            }

            // If URI is not multilingual.
            else {

                // Set URI data.
                $this->id = (int)$row['xt_id'];
                $this->uri = $row['xt_uri'];
                return true;
            }

        }

        // If page not found.
        $this->status = 404;
        return false;
    }

    /**
     * Initialize ajax request.
     *
     * @return bool.
     * @throws exception. Errors: SESSION AJAX ID is not set error,
     *                            POST AJAX ID and SESSION AJAX ID does not match error.
     */
    protected function initAjax()
    {
        // Get POST AJAX UUID.
        $postAid = $this->_post->get('aid');

        // If POST AJAX UUID was not sent.
        if (!$postAid) {
            return false;
        }

        // Get SESSION AJAX UUID.
        $sessionUuid = $this->_session->get('APPNETOS_AJAX_UUID');

        // If SESSION AJAX UUID is not set.
        if (!$sessionUuid && !$this->admin){
            $this->ajaxError = true;
            throw new exception('SESSION AJAX ID is not set error');
        }

        // If POST AJAX UUID and SESSION AJAX UUID does not match.
        if (($postAid !== $sessionUuid) && !$this->ajaxError && !$this->admin) {
            $this->ajaxError = true;
            throw new exception('POST AJAX ID and SESSION AJAX ID does not match error');
        }

        // Set ajax.
        $this->ajax = true;
        return true;
    }

    /**
     * Update CMS view count.
     */
    public function updateViews()
    {
        // Update "xt_views" in database table "application_cms".
        $query = 'UPDATE application_cms SET xt_views=? WHERE xt_id=?';
        $this->_database->update($query, [($this->views + 1), $this->id]);
        if ($this->languageId) {
            $query = 'UPDATE application_cms SET xt_views=? WHERE xt_id=?';
            $this->_database->update($query, [($this->languageViews + 1), $this->languageId]);
        }
    }

    /*
     * Get multilingual URL ID by int of global URI ID or string of global URI.
     *
     * @param mixed $key URI or URI ID.
     * @return int or bool.
     * @throws exception.
     */
    public function getUrlId($key)
    {
        // If URI is cached.
        if (gettype($key) === 'string') {
            if (isset($this->_urlCacheUrl[$key])) {
                return $this->_urlCacheUrl[$key]->id;
            }
        }
        elseif (gettype($key) === 'integer') {
            $keyCache = (string)$key;
            if (isset($this->_urlCacheId[$keyCache])) {
                return $this->_urlCacheId[$keyCache]->id;
            }
        }

        // If is admin.
        if ($this->admin) {
            $urlCache = $this->getUrlAdmin($key);
            if ($urlCache) {
                return $urlCache->id;
            }
            return false;
        }

        // If is application.
        $urlCache = $this->getUrlApplication($key);
        if ($urlCache) {
            return $urlCache->id;
        }
        return false;
    }

    /*
     * Get multilingual URL by int of global URI ID or string of global URI.
     *
     * @param mixed $key URI or URI ID or null.
     * @return string or bool.
     * @throws exception.
     */
    public function getUrl($key = null)
    {
        // If key not is set.
        if (!$key) {
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }

        // If URI is cached.
        if (gettype($key) === 'string') {
            if (isset($this->_urlCacheUrl[$key])) {
                return $this->_urlCacheUrl[$key]->url;
            }
        }
        elseif (gettype($key) === 'integer') {
            $keyCache = (string)$key;
            if (isset($this->_urlCacheId[$keyCache])) {
                return $this->_urlCacheId[$keyCache]->url;
            }
        }

        // If is admin.
        if ($this->admin) {
            $urlCache = $this->getUrlAdmin($key);
            if ($urlCache) {
                return $urlCache->url;
            }
            return false;
        }

        // If is application.
        $urlCache = $this->getUrlApplication($key);
        if ($urlCache) {
            return $urlCache->url;
        }

        // Return:
        return false;
    }

    /**
     * Get multilingual URL by int of global URI ID or string of global URI for application.
     *
     * @param mixed $key URI or URI ID.
     * @param bool $ignore ignore user group.
     * @return \stdClass or bool.
     * @throws exception.
     */
    public function getUrlApplication($key, $ignore = false)
    {
        // Get URI by global URI.
        if (gettype($key) === 'string') {

            // Select data from database table "application_cms".
            $query = 'SELECT xt_id, xt_parent_id FROM application_cms WHERE xt_uri=?';
            $row = $this->_database->selectRow($query, [$key]);

            // If URI exists.
            if ($row) {

                // If URI is global.
                if ((int)$row['xt_id'] && !(int)$row['xt_parent_id']) {
                    $key = (int)$row['xt_id'];
                }

                // If URI not is global.
                elseif ((int)$row['xt_id'] && (int)$row['xt_parent_id']) {
                    $key = (int)$row['xt_parent_id'];
                }

                // If URI not exists.
                else {

                    return false;
                }
            }

            // If URI not exists.
            else {

                // Return.
                return false;
            }
        }

        // Get URI by ID.
        if (gettype($key) === 'integer') {

            // Check user group.
            if (!$ignore) {
                if (!$this->_group) {
                    $this->_group = objects::get('group');
                }
                if (!$this->_group->getGranted($key)) {
                    return false;
                }
            }

            // Get URL from object "core\config".
            $url = $this->_config->getUrl();

            // Select data from database table "application_cms".
            $query = 'SELECT xt_id, xt_parent_id, xt_language_key, xt_uri FROM application_cms WHERE xt_id=? OR xt_parent_id=?';
            $array = $this->_database->selectArray($query, [$key, $key]);

            // If URI not exists.
            if (!$array) {
                return false;
            }

            // Get object "core\languages".
            if (!$this->_languages) {
                $this->_languages = objects::get('languages');
            }

            // Try get URI by active language.
            $active = $this->_languages->getActive();
            for ($i = 0; $i < count($array); $i++) {
                if ($active === $array[$i]['xt_language_key']) {
                    $urlCache = new \stdClass();
                    $urlCache->url = $url . '/' . $array[$i]['xt_uri'];
                    if ((int)$array[$i]['xt_parent_id'] === 0) {
                        $urlCache->id = (int)$array[$i]['xt_id'];
                    }
                    else {
                        $urlCache->id = (int)$array[$i]['xt_parent_id'];
                    }
                    $this->_urlCacheId[(string)$urlCache->id] = $urlCache;
                    $this->_urlCacheUrl[$urlCache->url] = $urlCache;
                    return $urlCache;
                }
            }

            // Try get URI by default language.
            $default = $this->_languages->getDefault();
            for ($i = 0; $i < count($array); $i++) {
                if ($default === $array[$i]['xt_language_key']) {
                    $urlCache = new \stdClass();
                    $urlCache->url = $url . '/' . $array[$i]['xt_uri'];
                    if ((int)$array[$i]['xt_parent_id'] === 0) {
                        $urlCache->id = (int)$array[$i]['xt_id'];
                    }
                    else {
                        $urlCache->id = (int)$array[$i]['xt_parent_id'];
                    }
                    $this->_urlCacheId[(string)$urlCache->id] = $urlCache;
                    $this->_urlCacheUrl[$urlCache->url] = $urlCache;
                    return $urlCache;
                }
            }

            // Get global URI.
            for ($i = 0; $i < count($array); $i++) {
                if (!(int)$array[$i]['xt_parent_id'] || (int)$array[$i]['xt_parent_id'] === 0) {
                    $urlCache = new \stdClass();
                    $urlCache->url = $url . '/' . $array[$i]['xt_uri'];
                    if ((int)$array[$i]['xt_parent_id'] === 0) {
                        $urlCache->id = (int)$array[$i]['xt_id'];
                    }
                    else {
                        $urlCache->id = (int)$array[$i]['xt_parent_id'];
                    }
                    $this->_urlCacheId[(string)$urlCache->id] = $urlCache;
                    $this->_urlCacheUrl[$urlCache->url] = $urlCache;
                    return $urlCache;
                }
            }

            // Return.
            return false;
        }
    }

    /**
     * Get multilingual URL by int of global URI ID or string of global URI for admin section.
     *
     * @param mixed $key URI or URI ID.
     * @param bool $ignore ignore user group.
     * @return string.
     * @throws exception.
     */
    public function getUrlAdmin($key, $ignore = false)
    {
        // Get URI by global URI.
        if (gettype($key) === 'string') {

            // Select data from database table "admin_cms".
            $query = 'SELECT xt_id, xt_parent_id FROM admin_cms WHERE xt_uri=?';
            $row = $this->_database->selectRow($query, [$key]);

            // If URI exists.
            if ($row) {

                // If URI is global.
                if (!(int)$row['xt_parent_id'] || (int)$row['xt_parent_id'] === 0) {
                    $key = (int)$row['xt_id'];
                }

                // If URI not is global.
                else {

                    // Generate trace.
                    $exception = new exception();
                    $stacktrace = $exception->getTraceAsString();

                    // Set warning to log.
                    $this->_log->addWarning('Multilingual URI is not global "' . $key . '"', $stacktrace);
                }
            }

            // If URI not exists.
            else {

                // Generate trace.
                $exception = new exception();
                $stacktrace = $exception->getTraceAsString();

                // Set warning to log.
                $this->_log->addWarning('Multilingual URI does not exists "' . $key . '"', $stacktrace);
            }
        }

        // Get URI by ID.
        if (gettype($key) === 'integer') {

            // Check user group.
            if (!$ignore) {
                if (!$this->_group) {
                    $this->_group = objects::get('group');
                }
                if (!$this->_group->getGranted($key)) {
                    return false;
                }
            }

            // Get URL from object "core\config".
            $url = $this->_config->getUrl();

            // Select data from database table "admin_cms".
            $query = 'SELECT xt_id, xt_parent_id, xt_language_key, xt_uri FROM admin_cms WHERE xt_id=? OR xt_parent_id=?';
            $array = $this->_database->selectArray($query, [$key, $key]);

            // If URI exists.
            if ($array) {

                // Get object "core\languages".
                if (!$this->_languages) $this->_languages = objects::get('languages');

                // Try get URI by active language.
                $active = $this->_languages->getAdminActive();
                for ($i = 0; $i < count($array); $i++) {
                    if ($active === $array[$i]['xt_language_key']) {
                        $urlCache = new \stdClass();
                        $urlCache->url = $url . '/' . $array[$i]['xt_uri'];
                        if ((int)$array[$i]['xt_parent_id'] === 0) {
                            $urlCache->id = (int)$array[$i]['xt_id'];
                        }
                        else {
                            $urlCache->id = (int)$array[$i]['xt_parent_id'];
                        }
                        $this->_urlCacheId[(string)$urlCache->id] = $urlCache;
                        $this->_urlCacheUrl[$urlCache->url] = $urlCache;
                        return $urlCache;
                    }
                }

                // Try get URI by default language.
                $default = $this->_languages->getAdminDefault();
                for ($i = 0; $i < count($array); $i++) {
                    if ($default === $array[$i]['xt_language_key']) {
                        $urlCache = new \stdClass();
                        $urlCache->url = $url . '/' . $array[$i]['xt_uri'];
                        if ((int)$array[$i]['xt_parent_id'] === 0) {
                            $urlCache->id = (int)$array[$i]['xt_id'];
                        }
                        else {
                            $urlCache->id = (int)$array[$i]['xt_parent_id'];
                        }
                        $this->_urlCacheId[(string)$urlCache->id] = $urlCache;
                        $this->_urlCacheUrl[$urlCache->url] = $urlCache;
                        return $urlCache;
                    }
                }

                // Get global URI.
                for ($i = 0; $i < count($array); $i++) {
                    if (!(int)$array[$i]['xt_parent_id'] || (int)$array[$i]['xt_parent_id'] === 0) {
                        $urlCache = new \stdClass();
                        $urlCache->url = $url . '/' . $array[$i]['xt_uri'];
                        if ((int)$array[$i]['xt_parent_id'] === 0) {
                            $urlCache->id = (int)$array[$i]['xt_id'];
                        }
                        else {
                            $urlCache->id = (int)$array[$i]['xt_parent_id'];
                        }
                        $this->_urlCacheId[(string)$urlCache->id] = $urlCache;
                        $this->_urlCacheUrl[$urlCache->url] = $urlCache;
                        return $urlCache;
                    }
                }
            }

            // If URI not exists.
            else {

                // Generate trace.
                $exception = new exception();
                $stacktrace = $exception->getTraceAsString();

                // Set warning to log.
                $this->_log->addWarning('Multilingual URI is not global or not exists "' . $key . '"', $stacktrace);
            }
        }
    }

    /**
     * Get request.
     *
     * @return string.
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get request URI.
     *
     * @return string.
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * Get Server request URI index.
     *
     * @param int $index.
     * @return array or string or bool.
     */
    public function getRequestIndex($index = null)
    {
        // If index not exists.
        if ($index === null) {
            return $this->requestIndex;
        }

        // If index exists.
        if (isset($this->requestIndex[$index])) {
            return $this->requestIndex[$index];
        }

        // Return.
        return false;
    }

    /**
     * Get if is admin section request.
     *
     * @return bool.
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Get if is AJAX request.
     *
     * @return bool.
     */
    public function getAjax()
    {
        return $this->ajax;
    }

    /**
     * Get if AJAX request has errors.
     *
     * @return bool.
     */
    public function getAjaxError()
    {
        return $this->ajaxError;
    }

    /**
     * Get URI ID.
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
        if ($this->languageId) {
            return $this->languageId;
        }

        return $this->id;
    }

    /**
     * Get URI.
     *
     * @return int.
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get URI index.
     *
     * @param int $index.
     * @return array or string or bool.
     */
    public function getIndex($index = null)
    {
        // If index not exists.
        if ($index === null) {
            return $this->index;
        }

        // If index exists.
        if (isset($this->index[$index])) {
            return $this->index[$index];
        }

        // Return.
        return false;
    }

    /**
     * Get language URI.
     *
     * @return int.
     */
    public function getLanguageUri()
    {
        if ($this->languageUri) {
            return $this->languageUri;
        }

        return $this->uri;
    }

    /**
     * Get CMS count of views.
     *
     * @return int.
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Get CMS count of language views.
     *
     * @return int.
     */
    public function getLanguageViews()
    {
        if ($this->languageViews) {
            return $this->languageViews;
        }

        return $this->views;
    }

    /**
     * Get requested status code.
     *
     * @return bool.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get if requested uri has errors.
     *
     * @return bool.
     */
    public function getError()
    {
        return $this->error;
    }
}