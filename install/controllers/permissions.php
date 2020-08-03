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
 * @description     install/controllers/permissions.php ->    APPNET OS installer controller "installer\permissions".
 */

// Namespace.
namespace installer;

// Model "installer\permissions".
class permissions
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
        // If go back.
        If (isset($_POST["action"])) {
            if($_POST["action"] === "back") {

                // Get object "installer\settings".
                $settings = objects::get("settings");

                // Set part.
                $settings->settings->part = "license";

                // Redirect.
                $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                header("Location: " . $link);
                die();
            }
        }

        // Try create a file in root folder.
        $file = "../test.txt";
        $content = "1";

        // If file can be created.
        if (file_put_contents($file, $content)) {

            // Delete file.
            unlink("../test.txt");

            // Get object "installer\settings".
            $settings = objects::get("settings");

            // Set settings.
            $settings->settings->error = null;
            $settings->settings->part = "sql";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }
    }
}