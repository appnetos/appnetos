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

// Model "admin\menu\language_menu__model".
class language_menu__model
{

    /**
     * Admin active.
     *
     * @var string.
     */
    protected $adminActive = null;

    /**
     * Admin default.
     *
     * @var string.
     */
    protected $adminDefault = null;

    /**
     * Object "core\render".
     *
     * @var object.
     */
    private $_render = null;

    /**
     * Object "core\languages".
     *
     * @var object.
     */
    private $_languages = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Get used objects.
        $this->_languages = objects::get('languages');
        $this->_render = objects::get('render');

        // Assign.
        $this->_render->assign('admin__menu__language_menu__model', $this);

        // Initialize model "admin\menu\language_menu__languages_list".
        $languageMenuLanguagesList = objects::get('admin/menu/language_menu__languages_list', true);
        $languageMenuLanguagesList->init();
    }

    /**
     * Get admin active language.
     *
     * @return string.
     */
    public function getAdminActive()
    {
        // If is set.
        if ($this->adminActive !== null) {
            return $this->adminActive;
        }

        // Return admin active language.
        $adminActive = $this->_languages->getAdminActive();

        // Get active language.
        $languageMenuLanguagesList = objects::get('admin/menu/language_menu__languages_list');
        foreach ($languageMenuLanguagesList->languagesList as $language) {
            if ($language->key === $adminActive) {
                $this->adminActive = $language->name;
                return $this->adminActive;
            }
        }
    }

    /**
     * Get admin default.
     *
     * @return string.
     */
    public function getAdminDefault()
    {
        // If is set.
        if ($this->adminDefault !== null) {
            return $this->adminDefault;
        }

        // Return admin active language.
        $this->adminDefault = $this->_languages->getAdminDefault();
        return $this->adminDefault;
    }

    /**
     * Assign object.
     *
     * @param string $name.
     * @param object $object.
     */
    public function assign($name, $object)
    {
        $this->_render->assign($name, $object);
    }
}