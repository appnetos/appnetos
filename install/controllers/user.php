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
 * @description     install/controllers/user.php ->    APPNET OS installer controller "installer\user".
 */

// Namespace.
namespace installer;

// Controller "installer\user".
class user
{

    /**
     * user constructor.
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

            // Get object "installer\settings".
            $settings = objects::get("settings")->settings;

            // Set part.
            $settings->part = "admin_languages";

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // If action not license.
        if ($_POST["action"] !== "user") {
            return;
        }

        // Prepare parameters.
        $error = "";

        // Get object "installer\settings" and object "installer\strings".
        $settings = objects::get("settings")->settings;
        $strings = objects::get("strings")->strings;

        // Get POST parameters.
        $settings->userMin = false;
        if (isset($_POST["userMin"])) {
            if ($_POST["userMin"] === "on") {
                $settings->userMin = true;
            }
        }
        $settings->mailMin = false;
        if (isset($_POST["mailMin"])) {
            if ($_POST["mailMin"] === "on") {
                $settings->mailMin = true;
            }
        }
        $settings->passMin = false;
        if (isset($_POST["passMin"])) {
            if ($_POST["passMin"] === "on") {
                $settings->passMin = true;
            }
        }
        $settings->user = trim($_POST["user"]);
        $settings->pass = trim($_POST["pass"]);
        $settings->pass2 = trim($_POST["pass2"]);
        $settings->mail = trim($_POST["mail"]);

        // Get object "installer\Account".
        $account = new \installer\account();

        // Verify user name if min user verification.
        if ($settings->userMin) {
            $account->minPassVerify = true;
            if (!$account->verifyUserEntered($settings->user)) {
                $error .= $strings["installer__err_user_enter"] . "<br>";
            }
        }

        // Verify user name if not min user verification.
        else {
            if (!$account->verifyUserEntered($settings->user)) {
                $error .= $strings["installer__err_user_enter"] . "<br>";
            }
            else if (!$account->verifyUserValid($settings->user)) {
                $error .= $strings["installer__err_user_valid"] . "<br>";
            }
        }

        // Verify mail address if min mail verification.
        if ($settings->mailMin) {
            $account->minMailVerify = true;
            if (!$account->verifyMailEntered($settings->mail)) {
                $error .= $strings["installer__err_mail_enter"] . "<br>";
            }
        }

        // Verify mail address if not min mail verification.
        else {
            if (!$account->verifyMailEntered($settings->mail)) {
                $error .= $strings["installer__err_mail_enter"] . "<br>";
            }
            else if (!$account->verifyMailValid($settings->mail)) {
                $error .= $strings["installer__err_mail_valid"] . "<br>";
            }
        }

        // Verify password if min password verification.
        if ($settings->passMin) {
            $account->minPassVerify = true;
            if ($settings->pass !== $settings->pass2) {
                $error .= $strings["installer__err_pass_compare"] . "<br>";
            }
            else if (!$account->verifyPassEntered($settings->pass)) {
                $error .= $strings["installer__err_pass_enter"] . "<br>";
            }
        }

        // Verify password if not min password verification.
        else {
            if ($settings->pass !== $settings->pass2) {
                $error .= $strings["installer__err_pass_compare"] . "<br>";
            }
            else if (!$account->verifyPassEntered($settings->pass)) {
                $error .= $strings["installer__err_pass_enter"] . "<br>";
            }
            else if (!$account->verifyPassValid($settings->pass)) {
                $error .= $strings["installer__err_pass_valid"] . "<br>";
            }
        }

        // If is error.
        if ($error !== "") {

            // Set error to settings.
            $settings->error = $error;

            // Redirect.
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            header("Location: " . $link);
            die();
        }

        // Set settings.
        $settings->error = null;
        $settings->part = "install";

        // Redirect.
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        header("Location: " . $link);
        die();
    }
}