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
 * @description     application/apps/appnetos/navbar/admin/models/navbar__list.php ->    Admin model for
 *                  "appnetos\navbar". Admin controller to manage navbar menu and settings.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Model "appnetos\navbar__list".
class navbar__list
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Navbar entries as \stdClass.
     *
     * @var \stdClass.
     */
    public $entries = null;

    /**
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * Initialize.
     *
     * @param int $appId.
     * @throws \core\exception.
     */
    public function init($appId)
    {
        // Set parameters as \stdClass.
        $this->entries = new \stdClass();

        // Set app ID.
        $this->appId = $appId;

        // Select global data from database table "appnetos__navbar".
        $database = objects::get('database');
        $query = 'SELECT xt_id, xt_sort, xt_name, xt_link FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=? ORDER BY xt_sort';
        $array = $database->selectArray($query, [0, 'global']);

        // If data not exists.
        if (!$array) {
            return;
        }

        // If data exists.
        for ($i = 0; $i < count($array); $i++) {

            // Set global as \stdClass.
            $global = new \stdClass();
            $global->id = (int)$array[$i]['xt_id'];
            $global->sort = (int)$array[$i]['xt_sort'];
            $global->name = $array[$i]['xt_name'];
            $global->link = $array[$i]['xt_link'];
            $global->languages = new \stdClass();
            $global->submenus = new \stdClass();

            // Select languages data from database table "appnetos__navbar".
            $query = 'SELECT xt_id, xt_language_key, xt_name FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key!=?';
            $arrayLanguages = $database->selectArray($query, [$array[$i]['xt_id'], 'global']);

            // If no languages exists.
            if (!$arrayLanguages) {
                goto submenus;
            }

            // Set languages.
            for ($i2 = 0; $i2 < count($arrayLanguages); $i2++) {

                // Set language as \stdClass.
                $language = new \StdClass;
                $language->id = (int)$arrayLanguages[$i2]['xt_id'];
                $language->key = $arrayLanguages[$i2]['xt_language_key'];
                $language->name = $arrayLanguages[$i2]['xt_name'];

                // Set language to languages.
                $global->languages->{$language->key} = $language;
            }

            // Submenus.
            submenus:

            // Select submenus data from database table "appnetos__navbar".
            $query = 'SELECT xt_id, xt_sort, xt_name, xt_link FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=?  ORDER BY xt_sort';
            $arraySubmenus = $database->selectArray($query, [$array[$i]['xt_id'], 'global']);

            // In no submenu exists.
            if (!$arraySubmenus) {
                goto setEntry;
            }

            // Set submenus.
            for ($i2 = 0; $i2 < count($arraySubmenus); $i2++) {

                // Set submenu as \stdClass.
                $submenu = new \stdClass();
                $submenu->id = (int)$arraySubmenus[$i2]['xt_id'];
                $submenu->sort = (int)$arraySubmenus[$i2]['xt_sort'];
                $submenu->name = $arraySubmenus[$i2]['xt_name'];
                $submenu->link = $arraySubmenus[$i2]['xt_link'];
                $submenu->languages = new \stdClass();

                // Select submenus languages from database table "appnetos__navbar".
                $query = 'SELECT xt_id, xt_language_key, xt_name FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key!=?';
                $arrayLanguages = $database->selectArray($query, [$arraySubmenus[$i2]['xt_id'], 'global']);

                // If no languages exists.
                if (!$arrayLanguages) {
                    goto setSubmenu;
                }

                // Set languages.
                for ($i3 = 0; $i3 < count($arrayLanguages); $i3++) {

                    // Set language as \stdClass.
                    $language = new \StdClass;
                    $language->id = (int)$arrayLanguages[$i3]['xt_id'];
                    $language->key = $arrayLanguages[$i3]['xt_language_key'];
                    $language->name = $arrayLanguages[$i3]['xt_name'];

                    // Set language to languages.
                    $submenu->languages->{$language->key} = $language;
                }

                // set submenu.
                setSubmenu:
                $global->submenus->{$submenu->sort} = $submenu;
            }

            // Set entry.
            setEntry:
            $this->entries->{$global->sort} = $global;
        }
    }

    /**
     * Get entries as array.
     *
     * @return array.
     */
    public function getEntries()
    {
        $array = (array)$this->entries;
        if (count($array)) {
            return $array;
        }
    }

    /**
     * Get sub menus as array.
     *
     * @param object $entry.
     * @return array.
     */
    public function getSubmenus($entry)
    {
        if (isset($entry->submenus)) {
            $submenus = (array)$entry->submenus;
            if (count($submenus)) {
                return $submenus;
            }
        }
    }
}