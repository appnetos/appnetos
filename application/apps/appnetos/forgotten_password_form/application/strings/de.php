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
    "appnetos__forgotten_password_form__err_mailer"        => "Mailer nicht eingebunden. Damit die App Sign Up Form richtig funktioniert muss die App Mailer vor der App Sign Up Form in derselben URI eingebunden werden.",
    "appnetos__forgotten_password_form__err_settings"      => "Einstellungen nicht gefunden. Forgotten Password Form muss im Admin Bereich konfiguriert werden.",
    "appnetos__forgotten_password_form__err_code"          => "Der angefragte Link ist ungültig oder abgelaufen",
    "appnetos__forgotten_password_form__err_signed_in"     => "Sie sind bereits angemeldet",
    "appnetos__forgotten_password_form__submit"            => "Absenden",
    "appnetos__forgotten_password_form__address"           => "Email Adresse",
    "appnetos__forgotten_password_form__address_conf"      => "Bei Eingabe der richtigen Email Adresse wurde eine Nachricht versendet. Diese Nachricht enthält einen Link zum zurücksetzten des Passworts.<br>Falls Sie unsere E-Mail nicht in Ihrem Posteingang finden, prüfen Sie bitte Ihren Spam-Ordner.",
    "appnetos__forgotten_password_form__subject"           => "Anfrage zum zurücksetzten des Passworts.",
    "appnetos__forgotten_password_form__mail"              => "Klicken Sie nachfolgenden Link um Ihr Passwort zurückzusetzten.",
    "appnetos__forgotten_password_form__err_address"       => "Die eingegebene Email Adresse ist falsch.",
    "appnetos__forgotten_password_form__pass"              => "Passwort",
    "appnetos__forgotten_password_form__pass_repeat"       => "Passwort wiederholen",
    "appnetos__forgotten_password_form__err_pass_compare"  => "Das Passwort und die Passwort Wiederholung sind nicht identisch.",
    "appnetos__forgotten_password_form__err_mail_enter"    => "Bitte geben Sie eine Email Adresse ein.",
    "appnetos__forgotten_password_form__err_pass_enter"    => "Bitte geben Sie eine Passwort ein.",
    "appnetos__forgotten_password_form__err_pass_valid"    => "Das Passwort ist nicht zulässig.",
    "appnetos__forgotten_password_form__pass_conf"         => "Das Passwort wurde zurückgesetzt.",
    "appnetos__forgotten_password_form__pass_err"          => "Das Passwort konnte nicht zurückgesetzt werden.",
];