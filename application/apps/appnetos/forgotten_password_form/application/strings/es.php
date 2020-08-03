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
    "appnetos__forgotten_password_form__err_mailer" => "Mailer no incluido. Para que el Formulario de contraseña olvidada funcione correctamente, la aplicación Mailer debe integrarse en el URI antes del Formulario de contraseña olvidada de la aplicación.",
    "appnetos__forgotten_password_form__err_settings" => "Ajustes no encontrados. El formulario de contraseña olvidada debe configurarse en el área de administración.",
    "appnetos__forgotten_password_form__err_code" => "El enlace solicitado no es válido o ha caducado.",
    "appnetos__forgotten_password_form__err_signed_in" => "Ya has iniciado sesión",
    "appnetos__forgotten_password_form__submit" => "Enviar",
    "appnetos__forgotten_password_form__address" => "Dirección de correo electrónico",
    "appnetos__forgotten_password_form__address_conf" => "Cuando ingresó la dirección de correo electrónico correcta, se envió un mensaje. Este mensaje contiene un enlace para restablecer la contraseña.<br>En caso de que no encuentre nuestro correo electrónico de restablecimiento de contraseña en su bandeja de entrada, verifique su carpeta de correo no deseado / spam.",
    "appnetos__forgotten_password_form__subject" => "Solicitud para restablecer la contraseña.",
    "appnetos__forgotten_password_form__mail" => "Haga clic en el enlace de abajo para restablecer su contraseña.",
    "appnetos__forgotten_password_form__err_address" => "La dirección de correo electrónico introducida es incorrecta.",
    "appnetos__forgotten_password_form__pass" => "Contraseña",
    "appnetos__forgotten_password_form__pass_repeat" => "repite la contraseña",
    "appnetos__forgotten_password_form__err_pass_compare" => "La contraseña y la repetición de la contraseña no son idénticas.",
    "appnetos__forgotten_password_form__err_mail_enter" => "Por favor, introduzca una dirección de correo electrónico.",
    "appnetos__forgotten_password_form__err_pass_enter" => "Porfavor ingrese una contraseña.",
    "appnetos__forgotten_password_form__err_pass_valid" => "La contraseña no está permitida.",
    "appnetos__forgotten_password_form__pass_conf" => "La contraseña ha sido restablecida.",
    "appnetos__forgotten_password_form__pass_err" => "La contraseña no se pudo restablecer.",
];