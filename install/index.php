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
 * @description     install/index.php ->    APPNET OS installer "index.php".
 */

// Error reporting.
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// Define base path.
if(!defined("BASEPATH")) define("BASEPATH", dirname(__FILE__) . "/");

// Require autoload.
require_once BASEPATH . "autoload.php";

// Define object "install\run".
$run = new installer\run();

// Initialize object "installer\run".
$run->init();
