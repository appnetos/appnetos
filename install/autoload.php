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
 * @description     install/autoload.php ->    APPNET OS installer "autoload.php".
 */

/**
 * Define function autoload, class autoloader.
 *
 * @param string $class class namespace and name.
 */
function autoload($class)
{
    // Get class name.
    $array = explode("\\", $class);
    $name = end($array);

    // Get class by install directories.
    $dirs = getDirectories();
    for ($i = 0; $i < count($dirs); $i++) {
        $file = $dirs[$i] . $name . ".php";
        if (file_exists($file)) {
            require_once $file;
        }
    }
}

/**
 * Return array of all install directories.
 *
 * @return array.
 */
if (!function_exists("getDirs")) {
    function getDirectories()
    {
        $dirs = [
            BASEPATH . "controllers/",
            BASEPATH . "models/",
        ];
        return $dirs;
    }
}

/**
 * Define function autoload_register.
 */
if (!function_exists("autoload_register")) {
    function autoload_register()
    {
        spl_autoload_register("autoload");
    }
}

// Register autoload.
autoload_register();