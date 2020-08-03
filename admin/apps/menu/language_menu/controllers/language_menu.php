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
use core\objects;

// Model "admin\menu\language_menu".
class language_menu
{

    /**
     * Registered AJAX functions.
     */
    public $ajax = ['select'];

    /**
     *  language_menu constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Set object.
        objects::set('admin/menu/language_menu', $this);

        // Initialize model "admin\menu\language_menu__model".
        $languageMenuModel = objects::get('admin/menu/language_menu__model', true);
        $languageMenuModel->init();
    }

    /**
     * Select language.
     *
     * @echo string.
     */
    public function select()
    {
        // Get model "core\post".
        $post = objects::get('post');
        $key = $post->get('admin__menu__language_menu__key');

        // If key not exists.
        if (!$key) {
            echo 'false';
            return;
        }

        // Initialize.
        $this->init();

        // Get model "admin\menu\language_menu__languages_list".
        $languageMenuLanguagesList = objects::get('admin/menu/language_menu__languages_list');
        $languages = $languageMenuLanguagesList->languagesList;

        // Check if language exists.
        foreach ($languages as $language) {
            echo $language->key;
            if ($language->key === $key) {

                // Get objects "core\cookie".
                $cookie = objects::get('cookie');
                $cookie->setAdmin('APPNETOS_ADMIN_LANGUAGE', $key);
                break;
            }
        }

        echo 'true';
    }
}