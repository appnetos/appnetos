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
 * @description     application/apps/appnetos/header/admin/models/header__list.php ->    Admin Model for app admin area
 *                  "appnetos\header__list". Define an multilingual header with logo and social media icons.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Model "appnetos\header__list".
class header__list
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Icons as \stdClass.
     *
     * @var \stdClass.
     */
    public $icons = null;

    /**
     * Logo as \stdClass.
     *
     * @var \stdClass.
     */
    public $logo = null;

    /**
     * Icons for fast select as array.
     *
     * @var array.
     */
    public $fastSelect = [];

    /**
     * If is error.
     *
     * echo bool.
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
        $this->error = $this->initLanguage();

        // Initialize data.
        if (!$this->error) {
            $this->initData();
        }

        // initialize icons.
        if (!$this->error) {
            $this->initIcons();
        }
    }

    /**
     * Initialize data.
     */
    private function initData()
    {
        // Set parameters as \stdClass.
        $this->icons = new \stdClass();

        // Select from database table "appnetos__header".
        $database = objects::get('database');
        $query = 'SELECT xt_id, xt_active, xt_language_key, xt_logo, xt_sort, xt_img, xt_link, xt_width FROM appnetos__header_' . $this->appId . ' WHERE xt_language_key=? ORDER BY xt_sort';
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
            $parent->active = (bool)$array[$i]['xt_active'];
            $parent->languageKey = 'global';
            $parent->logo = (bool)$array[$i]['xt_logo'];
            $parent->sort = (int)$array[$i]['xt_sort'];
            $parent->img = $array[$i]['xt_img'];
            $parent->link = $array[$i]['xt_link'];
            $parent->width = (int)$array[$i]['xt_width'];
            $parent->children = new \stdClass();

            // Select from database table "appnetos__header".
            $query = 'SELECT xt_id, xt_language_key, xt_img FROM appnetos__header_' . $this->appId . ' WHERE xt_parent_id=? ORDER BY xt_language_key';
            $children = $database->selectArray($query, [(int)$array[$i]['xt_id']]);

            // If children exists.
            if ($children) {
                for ($i2 = 0; $i2 < count($children); $i2++) {

                    // Set child as \stdClass.
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

            // If is logo.
            if ((bool)$array[$i]['xt_logo']) {
                $this->logo = $parent;
            }

            // Set parent to data.
            else {
                $this->icons->{$parent->id} = $parent;
            }
        }
    }

    /**
     * Initialize icons.
     */
    private function initIcons()
    {
        // Get icons in app directory.
        $dir = 'application/apps/appnetos/header/admin/files';
        $this->fastSelect = glob($dir . '/*.{[sS][vV][gG],[jJ][pP][gG],[pP][nN][gG],[gG][iI][fF]}', GLOB_BRACE);
    }

    /**
     * Initialize language.
     */
    private function initLanguage()
    {
        // Get languages as \stdClass from object "core\languages".
        $languages = objects::get('languages');
        $this->languages = $languages->languages;
    }

    /**
     * Get icons as array.
     *
     * @return array.
     */
    public function getIcons()
    {
        $array = (array)$this->icons;
        if (count($array)) {
            return $array;
        }
    }
}