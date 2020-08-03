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
    "appnetos__forgotten_password_form__header" => "Formulario de<br>contraseña olvidada",
    "appnetos__forgotten_password_form__info" => "Integrar fácilmente el formulario para restablecer la contraseña. El formulario de contraseña olvidada utiliza el programa de correo APPNET OS. El APPNET OS Mailer debe estar integrado en el mismo URI antes del formulario de contraseña olvidada de la aplicación. Después de ingresar la dirección de correo electrónico, el remitente envía un enlace. Este enlace se puede utilizar para crear una nueva contraseña.",
    "appnetos__forgotten_password_form__settings" => "Ajustes",
    "appnetos__forgotten_password_form__mailbox" => "Buzón",
    "appnetos__forgotten_password_form__err_mailbox" => "El buzón no existe en el correo",
    "appnetos__forgotten_password_form__conf" => "La configuración ha sido editada.",
    "appnetos__forgotten_password_form__name" => "Asunto y nombre del email de confirmación",
    "appnetos__forgotten_password_form__license" => "Esta aplicación está disponible para uso privado y comercial de libre acceso. Los textos de la aplicación se traducen automáticamente. xtrose Media Studio no asume ninguna responsabilidad por el contenido de la aplicación. Los contenidos de la aplicación pueden ser ajustados por el usuario. Ayude a mejorar esta aplicación y envíenos en su idioma los archivos de traducción. Muchas gracias.",
    "appnetos__forgotten_password_form__save" => "Salvar",
    "appnetos__forgotten_password_form__select_mailbox" => "Seleccionar buzón",
];