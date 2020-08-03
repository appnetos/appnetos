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
 * @description     Admin app creator to build apps.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\create__model".
class create__model
{

    /**
     * Template to render.
     *
     * @var string.
     */
    public $template = 'admin/apps/apps/create/views/create__overview.tpl';

    /**
     * Part.
     *
     * @var string.
     */
    public $part = 'overview';

    /**
     * Initialize.
     */
    public function init()
    {
        // Get object "core\uri".
        $uri = objects::get('uri');
        $index = $uri->getRequestindex();

        // If index not exists.
        if (!isset($index[3])) {
            return;
        }

        // If model and view exists.
        $part = str_replace('-', '_', $index[3]);
        if (file_exists('admin/apps/apps/create/models/create__' . $part . '.php')) {
            if (file_exists('admin/apps/apps/create/views/create__' . $part . '.tpl')) {
                $this->part = $part;
                $this->template = 'admin/apps/apps/create/views/create__' . $part . '.tpl';
                $class = '/admin/apps/create__' . $part;
                $model = objects::get($class, true);
                $render = objects::get('render');
                $render->assign('admin__apps__create__' . $part, $model);
            }
        }
    }
}