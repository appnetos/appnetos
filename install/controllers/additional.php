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
 * @description     install/controllers/additional.php ->    APPNET OS installer controller "installer\additional".
 *                  To use the additional license you have to configure the variable $license. Set the path to the
 *                  additional license files. The files has to be HTML files and must placed into the LICENSE directory
 *                  or an sub directory of LICENSE directory. Example: File path: LICENSE/mylicense/LICENSE.html.
 *                  $license: mylicense/LICENSE.html. To set multilingual license files you have to create the same file
 *                  with the language suffix. Example: German file: mylicense/LICENSE_de.html. English file:
 *                  mylicense/LICENSE_en.html. If no file exist for the setup language, the global license file will be
 *                  loaded.
 */

// Namespace.
namespace installer;

// Model "installer\additional".
class additional
{

    /**
     * Path to additional license.
     * To use the additional license you have to configure this variable. Set the path to the additional license files.
     * The files has to be HTML files and must placed into the LICENSE directory or an sub directory of LICENSE
     * directory. Example: File path: LICENSE/mylicense/LICENSE.html. $license: mylicense/LICENSE.html. To set
     * multilingual license files you have to create the same file with the language suffix. Example: German file:
     * mylicense/LICENSE_de.html. English file: mylicense/LICENSE_en.html. If no file exist for the setup language, the
     * global license file will be loaded.
     *
     * @var string.
     */
    public $license = "test.html";

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
        // Set this to object "installer\objects".
        objects::set("additional", $this);

        // If an additional license exists.
        if ($this->license) {

            // If file not exists
            $path = "../LICENSE/" . $this->license;
            $path = str_replace("\\", "/", $path);
            $path = str_replace("//", "/", $path);
            if (!file_exists($path)) {
                $this->license = null;
                goto license;
            }
            $this->license = $path;
            $array = explode(".", $this->license);
            if (count($array) < 1) {
                goto license;
            }
            $languages = objects::get("languages");
            $active = $languages->active;
            $array[(count($array) - 2)] = $array[(count($array) - 2)] . "_" . $active;
            $license = implode(".", $array);
            if (file_exists($license)) {
                $this->license = $license;
            }
        }

        // If no additional license exists
        license:
        if (!$this->license) {

            // Get object "installer\settings".
            $settings = objects::get("settings");

            // Set part.
            $settings->settings->part = "permissions";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // Get POST parameters.
        if (!isset($_POST["action"])) {
            return;
        }

        // If go back.
        If ($_POST["action"] === "back") {

            // Get object "installer\settings".
            $settings = objects::get("settings");

            // Set part.
            $settings->settings->part = "license";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // If action not license.
        if ($_POST["action"] !== "additional") {
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
            $settings->settings->part = "permissions";

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