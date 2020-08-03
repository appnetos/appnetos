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
    "appnetos__forgotten_password_form__err_mailer" => "Почтовик не включен. Для правильной работы формы забытого пароля приложение Mailer должно быть интегрировано в URI перед формой забытого пароля приложения.",
    "appnetos__forgotten_password_form__err_settings" => "Настройки не найдены. Форма забытого пароля должна быть настроена в админке.",
    "appnetos__forgotten_password_form__err_code" => "Запрошенная ссылка недействительна или срок ее действия истек.",
    "appnetos__forgotten_password_form__err_signed_in" => "Вы уже вошли в",
    "appnetos__forgotten_password_form__submit" => "Отправить",
    "appnetos__forgotten_password_form__address" => "Адрес электронной почты",
    "appnetos__forgotten_password_form__address_conf" => "Когда вы ввели правильный адрес электронной почты, сообщение было отправлено. Это сообщение содержит ссылку для сброса пароля.<br>Если вы не можете найти адрес электронной почты для сброса пароля в своей папке входящих сообщений, проверьте папку «Спам / спам».",
    "appnetos__forgotten_password_form__subject" => "Запрос на сброс пароля.",
    "appnetos__forgotten_password_form__mail" => "Нажмите на ссылку ниже, чтобы сбросить пароль.",
    "appnetos__forgotten_password_form__err_address" => "Адрес электронной почты введен неверно.",
    "appnetos__forgotten_password_form__pass" => "пароль",
    "appnetos__forgotten_password_form__pass_repeat" => "Повторите пароль",
    "appnetos__forgotten_password_form__err_pass_compare" => "Пароль и повтор пароля не идентичны.",
    "appnetos__forgotten_password_form__err_mail_enter" => "Пожалуйста, введите адрес электронной почты.",
    "appnetos__forgotten_password_form__err_pass_enter" => "Пожалуйста, введите пароль.",
    "appnetos__forgotten_password_form__err_pass_valid" => "Пароль не допускается.",
    "appnetos__forgotten_password_form__pass_conf" => "Пароль был сброшен.",
    "appnetos__forgotten_password_form__pass_err" => "Пароль не может быть сброшен.",
];