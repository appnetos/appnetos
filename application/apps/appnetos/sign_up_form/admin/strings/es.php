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
    "appnetos__sign_up_form__header" => "Formulario de registro",
    "appnetos__sign_up_form__info" => "Esta aplicación es un formulario de contacto fácil de usar. Formulario de contacto utiliza el APPNET OS Mailer. El APPNET OS Mailer debe estar integrado en el mismo URI antes del formulario de contacto de la aplicación. El Formulario de contacto utiliza el ID exclusivo de Mailer y la Lista negra de Mailer para protegerlo de los ataques de spam. Para poder utilizar el Formulario de contacto, debe configurarse un buzón de correo para enviarlo al remitente.",
    "appnetos__sign_up_form__settings" => "Ajustes",
    "appnetos__sign_up_form__directly" => "Registre nuevos usuarios sin un email de confirmación",
    "appnetos__sign_up_form__mailbox" => "Buzón",
    "appnetos__sign_up_form__terms" => "Enlace a la página de los términos de uso.",
    "appnetos__sign_up_form__terms_info" => "URL o ID de URI. Deje en blanco si no desea utilizar un enlace a la página de términos de uso.",
    "appnetos__sign_up_form__terms_holder" => "Url o ID de URI.",
    "appnetos__sign_up_form__err_mailbox" => "El buzón no existe en el correo",
    "appnetos__sign_up_form__conf" => "La configuración ha sido editada.",
    "appnetos__sign_up_form__name" => "Asunto y nombre del email de confirmación",
    "appnetos__sign_up_form__license" => "Esta aplicación está disponible para uso privado y comercial de libre acceso. Los textos de la aplicación se traducen automáticamente. xtrose Media Studio no asume ninguna responsabilidad por el contenido de la aplicación. Los contenidos de la aplicación pueden ser ajustados por el usuario. Ayude a mejorar esta aplicación y envíenos en su idioma los archivos de traducción. Muchas gracias.",
    "appnetos__sign_up_form__save" => "Salvar",
    "appnetos__sign_up_form__select_mailbox" => "Seleccionar buzón",
];