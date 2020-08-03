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
 * @description     core/autoload.php ->    Start functions. Define class autoload, define application and admin
 *                  directories, define object run.
 */

// Use.
use core\objects;

/**
 * Define function autoload, class autoloader.
 *
 * @param string $class class namespace and name.
 * @throws.
 */
function GLOBAL__APPNETOS__AUTOLOAD($class)
{
    // Get class by file cache.
    if (class_exists("core\\files", false)) {
        $files = objects::get('files');
        $file = $files->getClass($class);
        if ($file) {
            return;
        }
    }

    // Prepare parameters.
    $array = explode("\\", $class);
    $name = end($array);

    // Get class by core components directories.
    $coreComponentsDirectories = GLOBAL__APPNETOS__GET_COMPONENTS_DIRECTORIES();
    foreach ($coreComponentsDirectories as $directory) {
        $file = rtrim($directory, '\\/ ') . '/' . $name . '.php';
        if (file_exists(BASEPATH . $file)) {
            require_once BASEPATH. $file;
            return;
        }
    }

    // Get class by core directories.
    $coreDirectories = GLOBAL__APPNETOS__GET_CORE_DIRECTORIES();
    foreach ($coreDirectories as $directory) {
        $file = rtrim($directory, '\\/ ') . '/' . $name . '.php';
        if (file_exists(BASEPATH . $file)) {
            require_once BASEPATH. $file;
            return;
        }
    }

    // Get class by config directories.
    if (class_exists(\core\config::class)) {
        $config = objects::get('config');
        $configDirectories = $config->getDirectories();
        foreach ($configDirectories as $directory) {
            $file = rtrim($directory, '\\/ ') . '/' . $name . '.php';
            if (file_exists(BASEPATH . $file)) {
                require_once BASEPATH. $file;
                return;
            }
        }
    }
}

/**
 * Return array of all core components directories.
 *
 * @return array.
 */
if (!function_exists('getCoreDirs')) {
    function GLOBAL__APPNETOS__GET_COMPONENTS_DIRECTORIES()
    {
        $coreComponentsDirectories = [
            'core/components/smarty/'
        ];
        return $coreComponentsDirectories;
    }
}

/**
 * Return array of all core directories.
 *
 * @return array.
 */
if (!function_exists('getCoreDirs')) {
    function GLOBAL__APPNETOS__GET_CORE_DIRECTORIES()
    {
        $coreDirectories = [
            'custom/core/appnetos/',
            'core/appnetos/',
        ];
        return $coreDirectories;
    }
}

/**
 * Define function autoload_register.
 */
if (!function_exists('GLOBAL__APPNETOS__AUTOLOAD_REGISTER')) {
    function GLOBAL__APPNETOS__AUTOLOAD_REGISTER()
    {
        spl_autoload_register('GLOBAL__APPNETOS__AUTOLOAD');
        require_once 'core/components/autoload.php';
    }
}

// Register autoload.
GLOBAL__APPNETOS__AUTOLOAD_REGISTER();
