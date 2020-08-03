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
    "appnetos__forgotten_password_form__err_mailer" => "Mailer non incluso. Affinché Modulo password dimenticata funzioni correttamente, l'app Mailer deve essere integrata nell'URI prima dell'app Password modulo dimenticato.",
    "appnetos__forgotten_password_form__err_settings" => "Impostazioni non trovate. Il modulo Password dimenticata deve essere configurato nell'area di amministrazione.",
    "appnetos__forgotten_password_form__err_code" => "Il link richiesto non è valido o è scaduto.",
    "appnetos__forgotten_password_form__err_signed_in" => "Sei già iscritto",
    "appnetos__forgotten_password_form__submit" => "Sottoscrivi",
    "appnetos__forgotten_password_form__address" => "Indirizzo email",
    "appnetos__forgotten_password_form__address_conf" => "Quando hai inserito l'indirizzo email corretto, è stato inviato un messaggio. Questo messaggio contiene un collegamento per reimpostare la password.<br>Nel caso in cui non trovi l'e-mail di reimpostazione della password nella posta in arrivo, controlla la tua cartella junk / spam.",
    "appnetos__forgotten_password_form__subject" => "Richiesta di reimpostare la password.",
    "appnetos__forgotten_password_form__mail" => "Fai clic sul link sottostante per reimpostare la password.",
    "appnetos__forgotten_password_form__err_address" => "L'indirizzo email inserito non è corretto.",
    "appnetos__forgotten_password_form__pass" => "Parola d'ordine",
    "appnetos__forgotten_password_form__pass_repeat" => "ripeti la password",
    "appnetos__forgotten_password_form__err_pass_compare" => "La ripetizione della password e della password non sono identiche.",
    "appnetos__forgotten_password_form__err_mail_enter" => "Si prega di inserire un indirizzo email.",
    "appnetos__forgotten_password_form__err_pass_enter" => "Per favore inserire una password.",
    "appnetos__forgotten_password_form__err_pass_valid" => "La password non è consentita.",
    "appnetos__forgotten_password_form__pass_conf" => "La password è stata ripristinata.",
    "appnetos__forgotten_password_form__pass_err" => "La password non può essere ripristinata.",
];