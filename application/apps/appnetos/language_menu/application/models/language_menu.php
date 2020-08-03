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
 * @description     Language Menu, lists all languages and sets the language cookie by
 *                  selection.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Model "appnetos\language_menu".
class language_menu
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Array of registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['set'];

    /**
     * Used model "core\languages".
     *
     * @var object.
     */
    protected $_languages = null;

    /**
     * language_menu constructor.
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
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp()->getId();

        // Get and set used objects.
        $this->_languages = objects::get('languages');
    }

    /**
     * AJAX set language.
     * Echo true.
     */
    public function set()
    {
        // Set header.
        header('Content-Type: application/json');

        // Get object "core\post" and object "core\languages".
        $languages = objects::get('languages');
        $post = objects::get('post');

        // Get languages.
        $languages = (array)$languages->languages;

        // Get POST parameters.
        $key = $post->get('key');

        // If is set.
        $isSet = false;

        // Check if language exists.
        foreach ($languages as $language) {
            if ($language->key === $key) {

                // Get objects "core\cookie".
                $cookie = objects::get('cookie');
                $cookie->set('APPNETOS_LANGUAGE', $key);
                $isSet = true;
                break;
            }
        }

        // If language not is set.
        if (!$isSet) {
            echo json_encode('{"link": false}');
            exit;
        }

        // Get multilingual URI.
        $uri = objects::get('uri');
        $id = $uri->getId();

        // Select language URI from database table "application/cms".
        $database = objects::get('database');
        $query = "SELECT xt_uri FROM application_cms WHERE xt_parent_id=? AND xt_language_key=?";
        $row = $database->selectRow($query, [$id, $key]);

        // If data exists.
        if ($row) {
            $config = objects::get('config');
            $link = $config->getUrl() . '/' . $row['xt_uri'];
            echo '{"link": "' . $link . '"}';
            exit;
        }

        // Select global URI from database table "application/cms".
        $query = "SELECT xt_uri FROM application_cms WHERE xt_id=? AND xt_language_key=?";
        $row = $database->selectRow($query, [$id, 'global']);

        // If data exists.
        if ($row) {
            $config = objects::get('config');
            $link = $config->getUrl() . '/' . $row['xt_uri'];
            echo '{"link": "' . $link . '"}';
            exit;
        }

        // Return false;
        echo json_encode('{"link": false}');
        exit;
    }

    /**
     * Get languages.
     *
     * @return array.
     */
    public function getLanguages()
    {
        // Get languages as array.
        $array = (array)$this->_languages->getLanguages();

        // return.
        if (count($array)) return $array;
    }

    /**
     * Get active language.
     *
     * @return string.
     */
    public function getActive()
    {
        // Return active language.
        return $this->_languages->getActive();
    }

    /**
     * Get language name by language key.
     *
     * @param string $key language key.
     * @return string or null.
     */
    public function getName($key)
    {
        // Return language name.
        return $this->_languages->getName($key);
    }
}