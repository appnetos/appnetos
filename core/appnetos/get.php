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
 * @description     core/appnetos/get.php ->    GET parameter class, get all GET parameters in array for easier request
 *                  and special GET commands.
 */

// Namespace.
namespace core;

// Class "core\get".
class get extends base
{

    /**
     * Array of all GET parameters.
     *
     * @var array.
     */
    protected $parameters = [];

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
        // Get all GET parameters and set to array.
        foreach ($_GET as $key => $value) {
            $parameter = array($key => $value);
            $this->parameters += $parameter;
        }

        // Unset all caches.
        if (isset($this->parameters['nocache'])) {
            if ((bool)$this->parameters['nocache']) {

                // Unset all caches.
                $config = objects::get('config');
                $config->unsetCache();
            }
        }
    }

    /**
     * Get a GET parameter.
     *
     * @param string $key GET parameter key.
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
     * Get all GET parameters.
     *
     * @return array.
     */
    public function getAll()
    {
        return $this->parameters;
    }
}