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
    "appnetos__forgotten_password_form__header" => "Modulo Password dimenticata",
    "appnetos__forgotten_password_form__info" => "Facile integrazione del modulo per reimpostare la password. Il modulo Password dimenticata utilizza il mailer del sistema operativo APPNET. Il programma di posta OS APPNET deve essere integrato nello stesso URI prima del modulo Password dimenticata dell'app. Dopo aver inserito l'indirizzo email, il mittente invia un collegamento. Questo collegamento può essere utilizzato per creare una nuova password.",
    "appnetos__forgotten_password_form__settings" => "impostazioni",
    "appnetos__forgotten_password_form__mailbox" => "Cassetta postale",
    "appnetos__forgotten_password_form__err_mailbox" => "La cassetta postale non esiste nel mailer",
    "appnetos__forgotten_password_form__conf" => "Le impostazioni sono state modificate",
    "appnetos__forgotten_password_form__name" => "Oggetto e nome dell'e-mail di conferma",
    "appnetos__forgotten_password_form__license" => "Questa app è disponibile per l'uso privato e commerciale del libero disponibile. I testi dell'app vengono tradotti automaticamente. xtrose Media Studio non si assume alcuna responsabilità per il contenuto dell'app. I contenuti dell'applicazione possono essere modificati dall'utente. Aiuta a migliorare questa app e a inviarci nei tuoi file di traduzione in lingua. Grazie mille.",
    "appnetos__forgotten_password_form__save" => "Salvare",
    "appnetos__forgotten_password_form__select_mailbox" => "Seleziona cassetta postale",
];