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
 * @description     Admin language menu.
 */

// Namespace.
namespace admin\menu;

// Use.
use \core\objects;

// Model "admin\menu\language_menu__languages_list".
class language_menu__languages_list
{

    /**
     * List.
     *
     * @var array.
     */
    public $languagesList = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Get model "core\languages".
        $coreLanguages = objects::get('languages');
        $languages = (array)$coreLanguages->getAdminLanguages();

        // Get model "admin\menu\language_menu__language".
        objects::get('admin/menu/language_menu__language');

        // Initialize languages.
        foreach ($languages as $language) {
            if ($language->key === 'global') {
                continue;
            }
            $languageMenuLanguage = objects::getNew('admin/menu/language_menu__language');
            $languageMenuLanguage->init(
                $language->key,
                $language->name,
                $language->nameEn
            );
            array_push($this->languagesList, $languageMenuLanguage);
        }
    }
}