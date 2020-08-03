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
 * @description     install/controllers/license.php ->    APPNET OS installer controller "installer\license".
 */

// Namespace.
namespace installer;

// Model "installer\license".
class license
{

    /**
     * license constructor.
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

        // If go back.
        If ($_POST["action"] === "back") {

            // Get object languages.
            $languages = objects::get("languages");
            $languages->initLanguages();

            // Get object "installer\settings".
            $settings = objects::get("settings");

            // Set part.
            $settings->settings->part = "language";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // If action not license.
        if ($_POST["action"] !== "license") {
            return;
        }

        // Get POST parameters.
        $licenseCheckbox = "off";
        if (isset($_POST["license__checkbox"])) {
            $licenseCheckbox = $_POST["license__checkbox"];
        }

        // Get object "installer\settings".
        $settings = objects::get("settings");

        // If license checkbox is set.
        if ($licenseCheckbox === "on") {

            // Set settings.
            $settings->settings->error = null;
            $settings->settings->part = "additional";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // Set error.
        $settings->settings->error = "installer__accept_error";

        // Redirect.
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("Location: " . $link);
        die();
    }
}