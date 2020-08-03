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
    "appnetos__forgotten_password_form__header" => "Formulaire de mot<br>de passe oublié",
    "appnetos__forgotten_password_form__info" => "Intégrez facilement le formulaire pour réinitialiser le mot de passe. Le formulaire de mot de passe oublié utilise le logiciel de messagerie APPNET OS. APPNET OS Mailer doit être intégré dans le même URI avant le formulaire de mot de passe oublié de l'application. Après avoir entré l'adresse e-mail, l'expéditeur envoie un lien. Ce lien peut être utilisé pour créer un nouveau mot de passe.",
    "appnetos__forgotten_password_form__settings" => "Réglages",
    "appnetos__forgotten_password_form__mailbox" => "Boites aux lettres",
    "appnetos__forgotten_password_form__err_mailbox" => "La boîte aux lettres n'existe pas dans mailer",
    "appnetos__forgotten_password_form__conf" => "Les paramètres ont été modifiés",
    "appnetos__forgotten_password_form__name" => "Sujet et nom de l'email de confirmation",
    "appnetos__forgotten_password_form__license" => "Cette application est disponible pour l'utilisation privée et commerciale librement disponible. Les textes de l'application sont traduits automatiquement. xtrose Media Studio n'assume aucune responsabilité pour le contenu de l'application. Le contenu de l'application peut être par l'utilisateur à sera ajusté. Aidez à améliorer cette application et envoyez-nous vos fichiers de traduction dans votre langue. Merci beaucoup.",
    "appnetos__forgotten_password_form__save" => "Sauvegarder",
    "appnetos__forgotten_password_form__select_mailbox" => "Sélectionnez la boîte aux lettres",
];