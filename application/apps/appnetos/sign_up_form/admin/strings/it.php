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
    "appnetos__sign_up_form__header" => "Modulo di iscrizione",
    "appnetos__sign_up_form__info" => "Questa app è un modulo di contatto facile da usare. Contact Form utilizza l'APP OSNET Mailer. Il programma di posta OS APPNET deve essere integrato nello stesso URI prima del modulo di contatto dell'app. Contact Form utilizza l'ID univoco del Mailer e la Blacklist del Mailer e lo rende sicuro dagli attacchi di spam. Per poter utilizzare Contact Form, è necessario configurare una casella di posta per l'invio nel Mailer.",
    "appnetos__sign_up_form__settings" => "impostazioni",
    "appnetos__sign_up_form__directly" => "Iscriviti nuovi utenti senza email di conferma",
    "appnetos__sign_up_form__mailbox" => "Cassetta postale",
    "appnetos__sign_up_form__terms" => "Link alla pagina dei termini di utilizzo",
    "appnetos__sign_up_form__terms_info" => "URL o ID URI. Lascia vuoto se non vuoi utilizzare un link alla pagina dei termini di utilizzo.",
    "appnetos__sign_up_form__terms_holder" => "Url o URI ID.",
    "appnetos__sign_up_form__err_mailbox" => "La cassetta postale non esiste nel mailer",
    "appnetos__sign_up_form__conf" => "Le impostazioni sono state modificate",
    "appnetos__sign_up_form__name" => "Oggetto e nome dell'e-mail di conferma",
    "appnetos__sign_up_form__license" => "Questa app è disponibile per l'uso privato e commerciale del libero disponibile. I testi dell'app vengono tradotti automaticamente. xtrose Media Studio non si assume alcuna responsabilità per il contenuto dell'app. I contenuti dell'applicazione possono essere modificati dall'utente. Aiuta a migliorare questa app e a inviarci nei tuoi file di traduzione in lingua. Grazie mille.",
    "appnetos__sign_up_form__save" => "Salvare",
    "appnetos__sign_up_form__select_mailbox" => "Seleziona cassetta postale",
];