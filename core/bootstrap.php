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
 * @description     core/bootstrap.php ->    Prepare system for APPNET OS. Define global parameters.
 */

// Defined start time.
if (!defined('MICROTIME__START')) {
    define('MICROTIME__START', microtime(true));
}

// PHP modifications.
ini_set('session.use_cookies', '0');

// Define APPNETOS data.
if (!defined('APPNETOS_VERSION')) {
    define('APPNETOS_VERSION', 1.0);
}
if (!defined('APPNETOS_URL')) {
    define('APPNETOS_URL', 'https://www.appnetos.com/');
}

// Include Smarty autoload register.
include_once ('core/components/smarty/Smarty.php');

// Get if admin section.
function GLOBAL__DEFINE__ADMIN()
{
    $request = urldecode($_SERVER['REQUEST_URI']);
    $request = trim($request);
    $request = trim($request, "/\\");
    $tmp = explode('?', $request);
    $request = $tmp[0];
    $basePath = str_replace("\\", "/", BASEPATH);
    $basePath = trim($basePath, "/");
    $basePath = explode('/', $basePath);
    $basePath = $basePath[count($basePath) - 1];
    $basePath = explode($basePath, $request);
    $basePath = $basePath[count($basePath) - 1];
    $basePath = trim($basePath, "/");
    $basePath = explode('/', $basePath);
    $requestUri = '';
    for ($i = 0; $i < count($basePath); $i++) {
        if (strlen($basePath[$i])) {
            $requestUri .= $basePath[$i];
            if ($i != (count($basePath) - 1)) {
                $requestUri .= '/';
            }
        }
    }
    $tmp = trim($requestUri, '/');
    $requestIndex = explode('/', $tmp);
    if ($requestIndex[0] === 'admin') {
        define('APPNETOS_ADMIN', true);
    }
    else {
        define('APPNETOS_ADMIN', false);
    }
}
if (!defined('APPNETOS_ADMIN')) {
    GLOBAL__DEFINE__ADMIN();
}

// Load include file to include code before loading the core classes.
if (file_exists(BASEPATH . 'include.php')) {
    require_once (BASEPATH . 'include.php');
}

// Require custom class extensions.
if (file_exists(BASEPATH . 'custom/extends.php')) {
    require_once (BASEPATH . 'custom/extends.php');
}
if (file_exists(BASEPATH . 'core/extends.php')) {
    require_once (BASEPATH . 'core/extends.php');
}

// Require autoload.
require_once (BASEPATH . 'core/autoload.php');

// Define controller "core\run".
$GLOBAL__APPNETOS__CONTROLLER_RUN = 'core\\run';
if (defined('EXTENDED__CLASSES')) {
    $array = EXTENDED__CLASSES;
    if (isset($array['core/run'])) {
        $GLOBAL__APPNETOS__CONTROLLER_RUN = $array['core/run'];
    }
}
$run = new $GLOBAL__APPNETOS__CONTROLLER_RUN;
