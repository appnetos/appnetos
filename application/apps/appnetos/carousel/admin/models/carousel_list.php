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
use \core\objects;

// Model "appnetos\carousel_list".
class carousel_list
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Data as \stdClass.
     *
     * @var \stdClass.
     */
    public $data = null;

    /**
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * Active languages as \stdClass from object "core\languages".
     *
     * @var \stdClass.
     */
    public $languages = null;

    /**
     * Initialize.
     *
     * @param int $id app ID.
     */
    public function init($id)
    {
        // Set app ID.
        $this->appId = $id;

        // Initialize languages.
        if (!$this->error) {
            $this->initLanguage();
        }

        // Initialize data.
        if (!$this->error) {
            $this->initData();
        }
    }

    /**
     * Initialize data.
     */
    protected function initData()
    {
        // Set parameters as \stdClass.
        $this->data = new \stdClass();

        // Select data from database table "appnetos__carousel".
        $database = objects::get('database');
        $query = 'SELECT xt_id, xt_language_key, xt_sort, xt_img, xt_link FROM appnetos__carousel_' . $this->appId . ' WHERE xt_language_key=? ORDER BY xt_sort';
        $array = $database->selectArray($query, ['global']);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Set parent data.
        for ($i = 0; $i < count($array); $i++) {

            // Set parent as \stdClass.
            $parent = new \stdClass();
            $parent->id = (int)$array[$i]['xt_id'];
            $parent->languageKey = 'global';
            $parent->sort = (int)$array[$i]['xt_sort'];
            $parent->img = $array[$i]['xt_img'];
            $parent->link = $array[$i]['xt_link'];
            $parent->children = new \stdClass();

            // Select data from database table "appnetos_carousel".
            $query = 'SELECT xt_id, xt_language_key, xt_img FROM appnetos__carousel_' . $this->appId . ' WHERE xt_parent_id=? ORDER BY xt_language_key';
            $children = $database->selectArray($query, [(int)$array[$i]['xt_id']]);

            // If children exists.
            if ($children) {
                for ($i2 = 0; $i2 < count($children); $i2++) {

                    // Set children as \stdClass.
                    $child = new \stdClass();
                    $child->id = $children[$i2]['xt_id'];
                    $child->languageKey = $children[$i2]['xt_language_key'];
                    $child->img = $children[$i2]['xt_img'];

                    // Set child as children
                    $parent->children->{$child->languageKey} = $child;
                }
            }

            // Set unused language keys.
            $unused = [];
            $languages = (array)$this->languages;
            foreach ($languages as $language) {
                if ($language->key === 'global') {
                    continue;
                }
                $isSet = false;
                $children = (array)$parent->children;
                foreach ($children as $child) {
                    if ($language->key === $child->languageKey) {
                        $isSet = true;
                        break;
                    }
                }
                if (!$isSet) {
                    array_push($unused, $language->key);
                }
            }
            $parent->unused = $unused;

            // Set parent to data.
            $this->data->{$parent->id} = $parent;
        }
    }

    /**
     * Initialize language.
     */
    protected function initLanguage()
    {
        // Get languages as \stdClass from object "core\languages".
        $languages = objects::get('languages');
        $this->languages = $languages->languages;
    }

    /**
     * Get data as array.
     *
     * @return array.
     */
    public function getData()
    {
        $array = (array)$this->data;
        if (count($array)) {
            return $array;
        }
    }
}