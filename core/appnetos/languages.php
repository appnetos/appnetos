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
 * @description     core/appnetos/languages.php ->    Language class, get language settings from object "core\config"
 *                  and set active and default language by browser and cookie language.
 */

// Namespace.
namespace core;

// Class "core\languages".
class languages extends base
{

    /**
     * Application active languages..
     *
     * @var array.
     */
    protected $languages = null;

    /**
     * Application default language key.
     *
     * @var string.
     */
    protected $default = null;

    /**
     * Application default language main key.
     *
     * @var string.
     */
    protected $defaultMain = null;

    /**
     * Application active language key.
     *
     * @var string.
     */
    protected $active = null;

    /**
     * Application active language main key.
     *
     * @var string.
     */
    protected $activeMain = null;

    /**
     * Application language set as COOKIE key.
     *
     * @var string.
     */
    protected $cookie = null;

    /**
     * Application language set in browser key.
     *
     * @var string.
     */
    protected $browser = null;

    /**
     * Admin active languages as \stdClass.
     *
     * @var \stdClass.
     */
    protected $adminLanguages = null;

    /**
     * Admin default language key.
     *
     * @var string.
     */
    protected $adminDefault = null;

    /**
     * Admin default language main key.
     *
     * @var string.
     */
    protected $adminDefaultMain = null;

    /**
     * Admin active language key.
     *
     * @var string.
     */
    protected $adminActive = null;

    /**
     * Admin active language main key.
     *
     * @var string.
     */
    protected $adminActiveMain = null;

    /**
     * Admin language set as COOKIE key.
     *
     * @var string.
     */
    protected $adminCookie = null;

    /**
     * Application language title.
     *
     * @var string.
     */
    protected $title = null;

    /**
     * Application language favicon.
     *
     * @var string.
     */
    protected $favicon = null;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * Used object "core\cookie".
     *
     * @var object.
     */
    protected $_cookie = null;

    /**
     * languages constructor.
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
     *
     * @throws.
     */
    protected function init()
    {
        // Set parameters as \stdClass.
        $this->languages = new \stdClass();
        $this->adminLanguages = new \stdClass();

        // Get used objects.
        $this->_database = objects::get('database');
        $this->_cookie = objects::get('cookie');

        // Get object "core\uri".
        $uri = objects::get('uri');

        // Initialize application.
        $this->initApplicationData();
        $this->initApplication();

        // If admin section.
        if ($uri->getAdmin()) {

            // Initialize admin section.
            $this->initAdminData();
            $this->initAdmin();
        }
    }

    /**
     * Initialize application data.
     *
     * @throws exception. Error: Languages incorrectly specified error.
     */
    protected function initApplicationData()
    {
        // Get data from database table "languages".
        $query = 'SELECT xt_key, xt_name, xt_name_en, xt_default, xt_title, xt_favicon  FROM languages WHERE xt_active=? ORDER BY xt_key';
        $array = $this->_database->selectArray($query, [1]);

        // If data not exists.
        if (!$array) {
            throw new exception('Languages incorrectly specified error');
        }

        // Set data.
        for ($i = 0; $i < count($array); $i++) {

            // Set language as \stdClass.
            $language = new \stdClass();
            $language->key = $array[$i]['xt_key'];
            $split = explode('_', $array[$i]['xt_key']);
            $language->mainKey = $split[0];
            if ($array[$i]['xt_name'] !== '') {
                $language->name = $array[$i]['xt_name'];
            }
            else {
                $language->name = $array[$i]['xt_name_en'];
            }
            $language->nameEn = $array[$i]['xt_name_en'];
            $language->title = $array[$i]['xt_title'];
            $language->favicon = $array[$i]['xt_favicon'];

            // Add language to languages.
            $this->languages->{$language->key} = $language;

            // If language is default language.
            if ((int)$array[$i]['xt_default'] === 1) {
                $this->default = $array[$i]['xt_key'];
                $this->defaultMain = $this->getMainKey($array[$i]['xt_key']);
            }
        }

        // If default language not is set.
        if ($this->default === null) {
            $this->default = 'global';
            $this->defaultMain = 'global';
        }
    }

    /**
     * Initialize application.
     *
     * @throws exception. Error: Languages incorrectly specified error.
     */
    protected function initApplication()
    {
        // Get language COOKIE from object "core\cookie".
        $this->cookie = $this->_cookie->get('APPNETOS_LANGUAGE');

        // Get browser language.
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $this->browser = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }

        // Set active language by cookie language.
        if ($this->cookie) {
            $this->active = $this->cookie;
            $this->activeMain = $this->getMainKey($this->active);
        }

        // Set active language by browser language.
        elseif ($this->browser) {
            $this->active = $this->browser;
            $this->activeMain = $this->getMainKey($this->active);
        }

        // Set active language by default language.
        if (!$this->active) {
            $this->active = $this->default;
            $this->activeMain = $this->getMainKey($this->active);
        }

        // If active language is not set.
        if (!$this->active) {
            throw new exception('Languages incorrectly specified error');
        }

        // Set language as COOKIE.
        $this->_cookie->set('APPNETOS_LANGUAGE', $this->active);
    }

    /**
     * Initialize admin section data.
     *
     * @throws exception. Error: Languages incorrectly specified error.
     */
    protected function initAdminData()
    {
        // Get data from database table "languages".
        $query = 'SELECT xt_key, xt_name, xt_name_en, xt_admin_default  FROM languages WHERE xt_admin_active=? ORDER BY xt_key';
        $array = $this->_database->selectArray($query, [1]);

        // If data not exists.
        if (!$array) {
            throw new exception('Languages incorrectly specified error');
        }

        // Set data.
        for ($i = 0; $i < count($array); $i++) {

            // Set language as \stdClass.
            $language = new \stdClass();
            $language->key = $array[$i]['xt_key'];
            $split = explode("_", $array[$i]['xt_key']);
            $language->mainKey = $split[0];
            if ($array[$i]['xt_name'] !== '') {
                $language->name = $array[$i]['xt_name'];
            }
            else {
                $language->name = $array[$i]['xt_name_en'];
            }
            $language->nameEn = $array[$i]['xt_name_en'];

            // Add language to languages.
            $this->adminLanguages->{$language->key} = $language;

            // If language is default language.
            if ((int)$array[$i]['xt_admin_default'] === 1) {
                $this->adminDefault = $array[$i]['xt_key'];
                $this->adminDefaultMain = $this->getMainKey($array[$i]['xt_key']);
            }
        }

        // If default language not is set.
        if ($this->adminDefault === null) {
            $this->adminDefault = 'global';
            $this->adminDefaultMain = 'global';
        }
    }

    /**
     * Initialize admin section.
     *
     * @throws exception. Error: Languages incorrectly specified error.
     */
    protected function initAdmin()
    {
        // Get language COOKIE from object "core\cookie".
        $this->adminCookie = $this->_cookie->get('APPNETOS_ADMIN_LANGUAGE');

        // Get browser language.
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $this->browser = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        }

        // Set active language by cookie language.
        if ($this->adminCookie) {
            $this->adminActive = $this->adminCookie;
            $this->adminActiveMain = $this->getMainKey($this->adminActive);
        }

        // Set active language by browser language.
        elseif ($this->browser) {
            $this->adminActive = $this->browser;
            $this->adminActiveMain = $this->getMainKey($this->adminActive);
        }

        // Set active language by default language.
        if (!$this->adminActive) {
            $this->adminActive = $this->adminDefault;
            $this->adminActiveMain = $this->getMainKey($this->adminActive);
        }

        // If active language is not set.
        if (!$this->adminActive) {
            throw new exception('Languages incorrectly specified error');
        }

        // Set language as COOKIE.
        $this->_cookie->set('APPNETOS_ADMIN_LANGUAGE', $this->adminActive, 31556926);
    }

    /**
     * Get application active languages.
     *
     * @param bool $assoc.
     * @return \stdClass || array.
     */
    public function getLanguages($assoc = false)
    {
        if ($assoc) {
            return (array)$this->languages;
        }
        else {
            return $this->languages;
        }
    }

    /**
     * Get application default language key.
     *
     * @return string.
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Get application default language main key.
     *
     * @return string.
     */
    public function getDefaultMain()
    {
        return $this->defaultMain;
    }

    /**
     * Get application active language key.
     *
     * @return string.
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get application active language main key.
     *
     * @return string.
     */
    public function getActiveMain()
    {
        return $this->activeMain;
    }

    /**
     * Get application language set as COOKIE key.
     *
     * @return string.
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * Get application language set in browser key.
     *
     * @return string.
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Get admin section active languages.
     *
     * @return \stdClass.
     */
    public function getAdminLanguages()
    {
        return $this->adminLanguages;
    }

    /**
     * Get admin section default language key.
     *
     * @return string.
     */
    public function getAdminDefault()
    {
        return $this->adminDefault;
    }

    /**
     * Get admin section default language main key.
     *
     * @return string.
     */
    public function getAdminDefaultMain()
    {
        return $this->adminDefaultMain;
    }

    /**
     * Get admin section active language key.
     *
     * @return string.
     */
    public function getAdminActive()
    {
        return $this->adminActive;
    }

    /**
     * Get admin section active language main key.
     *
     * @return string.
     */
    public function getAdminActiveMain()
    {
        return $this->adminActiveMain;
    }

    /**
     * Get admin section language set as COOKIE key.
     *
     * @return string.
     */
    public function getAdminCookie()
    {
        return $this->adminCookie;
    }

    /**
     * Get language title.
     *
     * @return string or bool.
     */
    public function getTitle()
    {
        // Get title.
        if ($this->title) {
            return $this->title;
        }

        // Get active title.
        if (isset($this->languages->{$this->active})) {
            if (isset($this->languages->{$this->active}->title)) {
                if ($this->languages->{$this->active}->title !== '') {
                    $this->title = $this->languages->{$this->active}->title;
                    return $this->title;
                }
            }
        }

        // Get default title.
        if (isset($this->languages->{$this->default})) {
            if (isset($this->languages->{$this->default}->title)) {
                if ($this->languages->{$this->default}->title !== '') {
                    $this->title = $this->languages->{$this->default}->title;
                    return $this->title;
                }
            }
        }

        // Get global title.
        if (isset($this->languages->{'global'})) {
            $this->title = $this->languages->{'global'}->title;
            return $this->title;
        }

        // Return.
        return false;
    }

    /**
     * Get language favicon.
     *
     * @return string or bool.
     */
    public function getFavicon()
    {
        // Get favicon.
        if ($this->favicon) {
            return $this->favicon;
        }

        // Get active favicon.
        if (isset($this->languages->{$this->active})) {
            if (isset($this->languages->{$this->active}->favicon)) {
                if ($this->languages->{$this->active}->favicon !== '') {
                    $this->favicon = $this->languages->{$this->active}->favicon;
                    return $this->favicon;
                }
            }
        }

        // Get default favicon.
        if (isset($this->languages->{$this->default})) {
            if (isset($this->languages->{$this->default}->favicon)) {
                if ($this->languages->{$this->default}->favicon !== '') {
                    $this->favicon = $this->languages->{$this->default}->favicon;
                    return $this->favicon;
                }
            }
        }

        // Get global favicon.
        if (isset($this->languages->{'global'})) {
            $this->favicon = $this->languages->{'global'}->favicon;
            return $this->favicon;
        }

        // Return.
        return false;
    }

    /**
     * Get language main key.
     *
     * @param string $key language key.
     * @return string.
     */
    public function getMainKey($key)
    {
        $split = explode('_', $key);
        return $split[0];
    }

    /**
     * Get language name.
     *
     * @param string $key language key.
     * @return string
     */
    public function getName($key)
    {
        if (isset($this->languages->{$key})) {
            return $this->languages->{$key}->name;
        }
    }

    /**
     * Get english language name.
     *
     * @param string $key language key.
     * @return string
     */
    public function getNameEn($key)
    {
        if (isset($this->languages->{$key})) {
            return $this->languages->{$key}->nameEn;
        }
    }

    /**
     * Get admin section language name.
     *
     * @param string $key language key.
     * @return string
     */
    public function getAdminName($key)
    {
        if (isset($this->adminLanguages->{$key})) {
            return $this->adminLanguages->{$key}->name;
        }
    }

    /**
     * Get english admin section language name.
     *
     * @param string $key language key.
     * @return string
     */
    public function getAdminNameEn($key)
    {
        if (isset($this->adminLanguages->{$key})) {
            return $this->adminLanguages->{$key}->nameEn;
        }
    }
}