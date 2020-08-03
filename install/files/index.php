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
 * @description     core/index.php ->     APPNET OS entry point. Define base variables. Load extend function and
 *                                        SPL autoloader. Initialize and start APPNET OS.
 */

// Error reporting.
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// Define base path.
if (!defined('BASEPATH')) {
    define('BASEPATH', str_replace("\\", "/",dirname(__FILE__)) . '/');
}

// Include bootstrap.
if (file_exists(BASEPATH .'core/bootstrap.php')) {
    require_once (BASEPATH .'core/bootstrap.php');
}

// Initialize object "core\run".
$run->init();
