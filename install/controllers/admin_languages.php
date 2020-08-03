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
 * @description     install/controllers/admin_languages.php ->    APPNET OS installer controller
 *                  "installer\admin_languages".
 */

// Namespace.
namespace installer;

// Controller "installer\languages".
class admin_languages
{

    /**
     * system constructor.
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
    public function action()
    {
        // Get POST parameters.
        if (!isset($_POST["action"])) {
            return;
        }

        // If go back.
        If ($_POST["action"] === "back") {

            // Get object "installer\settings".
            $settings = objects::get("settings")->settings;

            // Set part.
            $settings->part = "system";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // If action not system.
        if ($_POST["action"] !== "admin_languages") {
            return;
        }

        // Get object "installer\settings".
        $settings = objects::get("settings")->settings;

        if ($_POST["de"]) {
            $settings->admin_languages->de = true;
        }
        else {
            $settings->admin_languages->de = false;
        }
        if ($_POST["en"]) {
            $settings->admin_languages->en = true;
        }
        else {
            $settings->admin_languages->en = false;
        }
        if ($_POST["es"]) {
            $settings->admin_languages->es = true;
        }
        else {
            $settings->admin_languages->es = false;
        }
        if ($_POST["fr"]) {
            $settings->admin_languages->fr = true;
        }
        else {
            $settings->admin_languages->fr = false;
        }
        if ($_POST["it"]) {
            $settings->admin_languages->it = true;
        }
        else {
            $settings->admin_languages->it = false;
        }
        if ($_POST["ru"]) {
            $settings->admin_languages->ru = true;
        }
        else {
            $settings->admin_languages->ru = false;
        }

        // Set settings.
        $settings->error = null;
        $settings->part = "user";

        // Redirect.
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("Location: " . $link);
        die();
    }
}