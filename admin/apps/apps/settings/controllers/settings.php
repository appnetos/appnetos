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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Controller "admin\apps\settings".
class settings
{

    /**
     * settings constructor.
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
        // If is AJAX.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Get model "admin\apps\create__model".
        $createModel = objects::get('admin/apps/settings__model', true);
        $createModel->init();
    }
}