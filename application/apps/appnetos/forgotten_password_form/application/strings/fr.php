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
    "appnetos__forgotten_password_form__err_mailer" => "Mailer non inclus. Pour que le formulaire de mot de passe oublié fonctionne correctement, l'application Mailer doit être intégrée à l'URI avant le formulaire de mot de passe oublié de l'application.",
    "appnetos__forgotten_password_form__err_settings" => "Paramètres non trouvés. Le formulaire de mot de passe oublié doit être configuré dans la zone d'administration.",
    "appnetos__forgotten_password_form__err_code" => "Le lien demandé n'est pas valide ou a expiré.",
    "appnetos__forgotten_password_form__err_signed_in" => "Vous êtes déjà connecté",
    "appnetos__forgotten_password_form__submit" => "Soumettre",
    "appnetos__forgotten_password_form__address" => "Adresse électronique",
    "appnetos__forgotten_password_form__address_conf" => "Lorsque vous avez entré la bonne adresse email, un message a été envoyé. Ce message contient un lien permettant de réinitialiser le mot de passe.<br>Si vous ne trouvez pas notre adresse de réinitialisation du mot de passe dans votre boîte de réception, vérifiez votre dossier courrier indésirable / spam.",
    "appnetos__forgotten_password_form__subject" => "Demande de réinitialisation du mot de passe.",
    "appnetos__forgotten_password_form__mail" => "Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe.",
    "appnetos__forgotten_password_form__err_address" => "L'adresse e-mail entrée est incorrecte.",
    "appnetos__forgotten_password_form__pass" => "Mot de passe",
    "appnetos__forgotten_password_form__pass_repeat" => "Répéter le mot de passe",
    "appnetos__forgotten_password_form__err_pass_compare" => "Le mot de passe et la répétition du mot de passe ne sont pas identiques.",
    "appnetos__forgotten_password_form__err_mail_enter" => "S'il vous plaît entrer une adresse email.",
    "appnetos__forgotten_password_form__err_pass_enter" => "Veuillez entrer un mot de passe.",
    "appnetos__forgotten_password_form__err_pass_valid" => "Le mot de passe n'est pas autorisé.",
    "appnetos__forgotten_password_form__pass_conf" => "Le mot de passe a été réinitialisé.",
    "appnetos__forgotten_password_form__pass_err" => "Le mot de passe n'a pas pu être réinitialisé.",
];