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
 * @description     core/appnetos/request.php ->    Request parameter class, get all POST, GET and COOKIE from
 *                  parameters object.
 */

// Namespace.
namespace core;

// Class "core\request".
class request extends base
{

    /**
     * Used object "core\post".
     *
     * @var object.
     */
    protected $_post = null;

    /*
     * Used object "core\get".
     *
     * @var object.
     */
    protected $_get = null;

    /**
     * Used object "core\cookie".
     *
     * @var object.
     */
    protected $_cookie = null;

    /**
     * get constructor.
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
        // Get used objects.
        $this->_post = objects::get('post');
        $this->_get = objects::get('get');
        $this->_cookie = objects::get('cookie');
    }

    /**
     * Get a GET parameter.
     *
     * @param string $key REQUEST parameter key.
     * @return string or bool.
     */
    public function get($key)
    {
        // Get parameter from object "core\post".
        $value = $this->_post->get($key);
        if ($value) {
            return $value;
        }

        // Get parameter from object "core\get".
        $value = $this->_get->get($key);
        if ($value) {
            return $value;
        }

        // Get parameter from object "core\cookie".
        $value = $this->_cookie->get($key);
        if ($value) {
            return $value;
        }

        // Return.
        return false;
    }
}