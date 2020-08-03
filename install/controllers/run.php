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
 * @description     install/controllers/run.php ->    APPNET OS installer controller "installer\run".
 */

// Namespace.
namespace installer;

// Controller "installer\run".
class run {

    /**
     * Initialize.
     */
    public function init()
    {
        // Start Session.
        session_start();

        // Initialize objects.
        $objects = new objects();

        // Set this controller to object "installer\objects".
        $objects::set("run", $this);

        // Run.
        $this->run();
    }

    /**
     * Run active controller.
     */
    public function run()
    {
        // Get settings by object "installer\settings".
        $settings = objects::get("settings")->settings;

        // Get controller.
        $controller = "installer\\" . $settings->part;
        new $controller();
    }
}