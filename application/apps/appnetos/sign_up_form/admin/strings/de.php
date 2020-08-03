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
 * @description     Sign up form form to provide user information. Can be used with and without email confirmation.
 *                  Creates a user and sends a confirmation by the APPNET OS mailer with confirmation link.
 */

// Strings.
$strings = [
    "appnetos__sign_up_form__header" => "Anmeldeformular",
    "appnetos__sign_up_form__info" => "Diese App ist ein einfach einzubindendes Anmeldeformular. Sign Up Form verwendet den APPNET OS Mailer. Der APPNET OS Mailer muss, vor der App Sign Form, in derselben URI eingebunden werden.",
    "appnetos__sign_up_form__settings" => "Einstellungen",
    "appnetos__sign_up_form__directly" => "Neue Benutzer ohne Bestätigungs-Email anmelden",
    "appnetos__sign_up_form__mailbox" => "Postfach",
    "appnetos__sign_up_form__terms" => "Link zur Seiter der Nutzungsbestimmungen",
    "appnetos__sign_up_form__terms_info" => "Url oder URI ID. Leer lassen wenn kein Link zur Seite der Nutzungsbestimmungen verwendet werden soll.",
    "appnetos__sign_up_form__terms_holder" => "Url oder URI ID",
    "appnetos__sign_up_form__err_mailbox" => "Die Mailbox existiert nicht im Mailer",
    "appnetos__sign_up_form__conf" => "Die Einstellungen wurden bearbeitet",
    "appnetos__sign_up_form__name" => "Bestätigungs-Email Betreff und Name",
    "appnetos__sign_up_form__license" => "Diese App steht zur für private und komerzielle Nutzung frei zur Verfügung. Texte der App sind teilweise automatisch übersetzt. xtrose Media Studio übernimmt keine Haftung für den Inhalt der App. Der Inhalt der App kann vom Verwender nach belieben angepasst werden. Helfen Sie diese App zu verbessern und senden Sie uns Übersetzungsdateien in Ihrer Sprache. Vielen Dank.",
    "appnetos__sign_up_form__save" => "Speichern",
    "appnetos__sign_up_form__select_mailbox" => "Postfach auswählen",
];