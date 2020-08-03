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
 * @description     core/appnetos/post.php ->    POST parameter class, get all POST parameters in array for easier
 *                  request and special POST commands.
 */

// Namespace.
namespace core;

// Class "core\post".
class post extends base
{

    /**
     * Array of all POST parameters.
     *
     * @var array.
     */
    protected $parameters = [];

    /**
     * post constructor.
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
        // Get all POST parameters and set to array.
        foreach ($_POST as $key => $value) {
            $parameter = array($key => $value);
            $this->parameters += $parameter;
        }
    }

    /**
     * Get a POST parameter.
     *
     * @param string $key POST parameter key.
     * @return string or bool.
     */
    public function get($key)
    {
        // If parameter is set.
        if (isset($this->parameters[$key])) {
            return $this->parameters[$key];
        }

        // Return.
        return false;
    }

    /**
     * Get all POST parameters.
     *
     * @return array.
     */
    public function getAll()
    {
        // Return all parameters.
        return $this->parameters;
    }
}