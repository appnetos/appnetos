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
 * @description     install/controllers/render.php ->    APPNET OS installer controller "installer\render".
 */

// Namespace.
namespace installer;

// Controller render.
class render
{

    /**
     * Render template.
     *
     * @param object $object.
     * @return string.
     */
    public function render($object)
    {
        // Get settings by object "installer\settings".
        $settings = objects::get("settings")->settings;

        // Get strings by object "installer\strings".
        $strings = objects::get("strings")->strings;

        // Get languages by object "installer\languages".
        $languages = objects::get("languages")->languages;

        // Get active language.
        $active = objects::get("languages")->active;

        // Activate output puffer.
        ob_start();

        // Including view.
        include("views/body.php");

        // Render view to string.
        $string = ob_get_contents();

        // Deactivate puffer.
        ob_end_clean();

        // Echo rendered string.
        echo $string;
    }

    /**
     * Get error.
     *
     * @return string.
     */
    public function getError()
    {
        // Get settings by object "installer\settings".
        $settings = objects::get("settings")->settings;

        // Get error.
        $error = $settings->error;

        // Unset error.
        $settings->error = null;

        // Return error.
        return $error;
    }
}