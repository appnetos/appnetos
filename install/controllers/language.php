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
 * @description     install/controllers/language.php ->    APPNET OS installer controller "installer\language".
 */

// Namespace.
namespace installer;

// Model "installer\language".
class language
{

    /**
     * language constructor.
     */
    public function __construct()
    {
        // Action.
        $this->action();

        // Get object "installer\render".
        $render = objects::get("render");

        // Render template.
        $render->render($this);
    }

    /**
     * Action.
     */
    private function action()
    {
        // Get POST parameters.
        if (!isset($_POST["action"])) {
            return;
        }
        if ($_POST["action"] !== "language") {
            return;
        }
        $language = $_POST["language"];

        // Get object "installer\settings".
        $settings = objects::get("settings");

        // Set settings.
        $settings->settings->language = $language;

        // Initialize objects.
        $languages = objects::get("languages");
        $languages->active = $language;
        $strings = new strings();
        objects::set("strings", $strings);

        // Set settings.
        $settings->settings->error = null;
        $settings->settings->part = "license";

        // Redirect.
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("Location: " . $link);
        die();
    }
}