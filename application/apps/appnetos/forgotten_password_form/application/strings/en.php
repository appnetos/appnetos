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
 * @description     Password recovery form. Resets the password and sends an email with a link to recover the password
 *                  by using APPNET OS Mailer.
 */

// Strings.
$strings = [
    "appnetos__forgotten_password_form__err_mailer"        => "Mailer not included. In order for Forgotten Password Form to function properly, the app Mailer must be integrated into the URI before the app Forgotten Password Form.",
    "appnetos__forgotten_password_form__err_settings"      => "Settings not found. Forgotten Password Form must be configured in the admin area.",
    "appnetos__forgotten_password_form__err_code"          => "The requested Link is invalid or has expired.",
    "appnetos__forgotten_password_form__err_signed_in"     => "You are already signed in",
    "appnetos__forgotten_password_form__submit"            => "Submit",
    "appnetos__forgotten_password_form__address"           => "Email address",
    "appnetos__forgotten_password_form__address_conf"      => "When you entered the correct email address, a message was sent. This message contains a link to reset the password.<br>In case you do not find our password reset email in your inbox, please check your junk/spam folder.",
    "appnetos__forgotten_password_form__subject"           => "Request to reset the password.",
    "appnetos__forgotten_password_form__mail"              => "Click the link below to reset your password.",
    "appnetos__forgotten_password_form__err_address"       => "The email address entered is incorrect.",
    "appnetos__forgotten_password_form__pass"              => "Password",
    "appnetos__forgotten_password_form__pass_repeat"       => "Repeat password",
    "appnetos__forgotten_password_form__err_pass_compare"  => "The password and password repetition are not identical.",
    "appnetos__forgotten_password_form__err_mail_enter"    => "Please enter a email address.",
    "appnetos__forgotten_password_form__err_pass_enter"    => "Please enter a password.",
    "appnetos__forgotten_password_form__err_pass_valid"    => "The password is not allowed.",
    "appnetos__forgotten_password_form__pass_conf"         => "The password has been reset.",
    "appnetos__forgotten_password_form__pass_err"          => "The password could not be reset.",
];