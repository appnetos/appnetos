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
 * @description     APPNET OS Bootstrap carousel. Simply create a picture carousel via the app admin section.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Modelodel "appnetos\carousel".
class carousel {

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Settings.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * Data as \stdClass.
     *
     * @var \stdClass.
     */
    public $data = null;

    /**
     * Used controller "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * Used model "core\uri" get on runtime.
     *
     * @var object.
     */
    protected $_uri = null;

    /**
     * carousel constructor.
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
        // Get and set used data.
        $this->getSet();

        // Initialize settings.
        $this->initSettings();

        // Initialize data.
        $this->initData();
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp()->getId();

        // Get and set used objects.
        $this->_extensions = objects::get('extensions');
    }

    /**
     * Get settings.
     */
    protected function initSettings()
    {
        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get settings.
        $settings = $this->_extensions->get('text', $this->appId);

        // If settings exists.
        if ($settings) {
            $this->settings = json_decode($settings);
        }

        // If settings not exists.
        else {
            $this->settings->random = true;
            $this->settings->indicators = true;
            $this->settings->controls = true;
            $this->settings->time = 5;
            $this->_extensions->set(json_encode($this->settings), 'text', $this->appId);
        }
    }

    /**
     * Get data.
     */
    protected function initData()
    {
        // Get objects "core\languages" and object "core\database".
        $languages = objects::get('languages');
        $database = objects::get('database');

        // Set parameters as \stdClass.
        $this->data = new \stdClass();

        // Prepare parameters.
        $row = null;

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_id, xt_language_key, xt_sort, xt_img, xt_link FROM appnetos__carousel_' . $this->appId . ' WHERE xt_language_key=? ORDER BY xt_sort';
        $array = $database->selectArray($query, ['global']);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Set parent data.
        for ($i = 0; $i < count($array); $i++) {

            // Set parent as \stdClass.
            $entry = new \stdClass();
            $entry->id = (int)$array[$i]['xt_id'];
            $entry->languageKey = 'global';
            $entry->sort = (int)$array[$i]['xt_sort'];
            $entry->img = $array[$i]['xt_img'];
            $link = $this->getUrl($this->getUrl($array[$i]['xt_link']));
            if ($link !== '' && $link !== null) {
                $entry->link = $link;
            }
            else {
                ($entry->link = null);
            }

            // Get active main entry.
            if ($languages->activeMain !== $languages->active) {

                // Select from database table "appnetos__carousel".
                $query = 'SELECT xt_id, xt_img, xt_language_key FROM appnetos__carousel_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=?';
                $row = $database->selectRow($query, [(int)$array[$i]['xt_id'], $languages->activeMain]);

                // If entry exists.
                if ($row) {
                    goto change;
                }
            }

            // Get active entry.
            $query = 'SELECT xt_id, xt_img, xt_language_key FROM appnetos__carousel_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=?';
            $row = $database->selectRow($query, [(int)$array[$i]['xt_id'], $languages->active]);

            // If entry exists.
            if ($row) {
                goto change;
            }

            // Get default main entry.
            if ($languages->activeMain !== $languages->active) {

                // Select from database table "appnetos__carousel".
                $query = 'SELECT xt_id, xt_img, xt_language_key FROM appnetos__carousel_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=?';
                $row = $database->selectRow($query, [(int)$array[$i]['xt_id'], $languages->defaultMain]);

                // If entry exists.
                if ($row) {
                    goto change;
                }
            }

            // Get default entry.
            $query = 'SELECT xt_id, xt_img, xt_language_key FROM appnetos__carousel_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=?';
            $row = $database->selectRow($query, [(int)$array[$i]['xt_id'], $languages->default]);

            // Change entry.
            change:

            // If language entry not exists.
            if (!$row) {
                goto set;
            }

            // Change language entry.
            $entry->id = $row['xt_id'];
            $entry->languageKey = $row['xt_language_key'];
            $entry->img = $row['xt_img'];

            // Set entry.
            set:

            // Set parent to data.
            $this->data->{$entry->sort} = $entry;
        }
    }

    /**
     * Get Url.
     *
     * @param int $key URL ID or link.
     * @return string.
     */
    public function getUrl($key)
    {
        // If key is numeric.
        if (is_numeric($key)) {
            if (!$this->_uri) {
                $this->_uri = objects::get('uri');
            }

            // Get URL by _uri ID.
            $url = $this->_uri->getUrl((int)$key);

            // If URL exists.
            if ($url) {
                return $url;
            }
        }

        // If key is not numeric.
        return $key;
    }

    /**
     * Get images as array.
     *
     * @return array.
     */
    public function getImages()
    {
        $array = (array)$this->data;
        if (count($array)) {
            return $array;
        }
    }

    /**
     * Get random sort key.
     *
     * @return int.
     */
    public function getRandom()
    {
        $array = (array)$this->data;
        return (rand(1, count($array)));
    }
}