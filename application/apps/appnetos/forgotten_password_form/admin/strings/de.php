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
    "appnetos__forgotten_password_form__header" => "Passwort vergessen Formular<br>",
    "appnetos__forgotten_password_form__info" => "Einfach einzubindendes Formular um das Passwort zurückzusetzen. Forgotten Password Form verwendet den APPNET OS Mailer. Der APPNET OS Mailer muss, vor der App Forgotten Password Form, in derselben URI eingebunden werden. Nach der Eingabe der Email Adresse versendet der Mailer einen Link. Mit diesem Link kann ein neues Passwort erstellt werden.",
    "appnetos__forgotten_password_form__settings" => "Einstellungen",
    "appnetos__forgotten_password_form__mailbox" => "Postfach",
    "appnetos__forgotten_password_form__err_mailbox" => "Die Mailbox existiert nicht im Mailer",
    "appnetos__forgotten_password_form__conf" => "Die Einstellungen wurden bearbeitet",
    "appnetos__forgotten_password_form__name" => "Bestätigungs-Email Betreff und Name",
    "appnetos__forgotten_password_form__license" => "Diese App steht zur für private und komerzielle Nutzung frei zur Verfügung. Texte der App sind teilweise automatisch übersetzt. xtrose Media Studio übernimmt keine Haftung für den Inhalt der App. Der Inhalt der App kann vom Verwender nach belieben angepasst werden. Helfen Sie diese App zu verbessern und senden Sie uns Übersetzungsdateien in Ihrer Sprache. Vielen Dank.",
    "appnetos__forgotten_password_form__save" => "Speichern",
    "appnetos__forgotten_password_form__select_mailbox" => "Postfach auswählen",
];