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
 * @description     Admin language settings.
 */

// Namespace.
namespace admin\settings;

// Use.
use \core\objects;

// Controller "admin\settings\languages".
class languages
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['default', 'edit'];

    /**
     *  constructor.
     */
    public function __construct()
    {
        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Set object.
        objects::set('admin/settings/languages', $this);

        // Get model "admin\settings\languages__model".
        $languagesModel = objects::get('admin/settings/languages__model', true);
        $languagesModel->init();
    }

    /**
     * Default AJAX request.
     */
    public function default()
    {
        // Set object.
        objects::set('admin/settings/languages', $this);

        // Get model "admin\settings\languages__language".
        $languagesLanguage = objects::get('admin/settings/languages__language', true);
        $languagesLanguage->default();
    }

    /**
     * Edit AJAX request.
     */
    public function edit()
    {
        // Set object.
        objects::set('admin/settings/languages', $this);

        // Get model "admin\settings\languages__language".
        $languagesLanguage = objects::get('admin/settings/languages__language', true);
        $languagesLanguage->edit();
    }
}