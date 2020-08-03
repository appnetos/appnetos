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
 * @description     APPNET OS Marketplace.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Controller "admin\apps\marketplace__url".
class marketplace__url
{

    /**
     * APPNET OS URLs.
     *
     * @var array.
     */
    public $url = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__marketplace__url', $this);
    }

    /**
     * Update APPNET OS URLs.
     *
     * @param array $url.
     */
    public function update($url)
    {
        $this->url = $url;
    }

    /**
     * Get APPNET OS URL.
     *
     * @param $key.
     * @return string.
     */
    public function get($key)
    {
        if (isset($this->url[$key])) {
            return $this->url[$key];
        }
        return null;
    }
}