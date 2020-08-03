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
 * @description     install/models/objects.php ->    APPNET OS installer model "installer\objects".
 */

// Namespace.
namespace installer;

// Model "installer\objects".
class objects
{

    /**
     * \stdClass with all registered objects.
     *
     * @var \stdClass.
     */
    public static $objects = null;

    /**
     * objects constructor.
     */
    public function __construct()
    {
        // Set objects.
        self::$objects = new \stdClass();

        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    private function init()
    {
        // Set model "installer\settings".
        self::set("settings", new settings());

        // Set model "installer\languages".
        self::set("languages", new languages());

        // Set model "installer\strings".
        self::set("strings", new strings());

        // Set controller "installer\database".
        self::set("database", new database());

        // Set controller "installer\render".
        self::set("render", new render());
    }

    /**
     * Register object and set to object of registered objects by class name.
     *
     * @param string $name class name.
     * @param object $object object.
     * @return bool.
     */
    public static function set($name, $object)
    {
        // Set object to objects.
        if (gettype($object) === "object") {
            self::$objects->{$name} = $object;
            return true;
        }
    }

    /**
     * Get object from registered objects by class name.
     *
     * @param string $name class name.
     * @return object.
     */
    public static function get($name)
    {
        // If object exists.
        if (isset(self::$objects->{$name})) {
            return self::$objects->{$name};
        }
    }
}