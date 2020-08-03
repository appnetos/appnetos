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
    "appnetos__forgotten_password_form__header" => "Форма забытого пароля",
    "appnetos__forgotten_password_form__info" => "Легко интегрировать форму для сброса пароля. Форма забытого пароля использует почтовую программу APPNET OS. Приложение APPNET OS Mailer должно быть интегрировано в тот же URI перед формой забытого пароля приложения. После ввода адреса электронной почты, отправитель отправляет ссылку. Эта ссылка может быть использована для создания нового пароля.",
    "appnetos__forgotten_password_form__settings" => "настройки",
    "appnetos__forgotten_password_form__mailbox" => "почтовый ящик",
    "appnetos__forgotten_password_form__err_mailbox" => "Почтовый ящик не существует в почтовой программе",
    "appnetos__forgotten_password_form__conf" => "Настройки были отредактированы",
    "appnetos__forgotten_password_form__name" => "Подтверждение темы и имени электронной почты",
    "appnetos__forgotten_password_form__license" => "Это приложение доступно для частного и коммерческого использования в свободном доступе. Тексты приложения переводятся автоматически. xtrose Media Studio не несет ответственности за содержание приложения. Содержание приложения может быть изменено пользователем. Помогите улучшить это приложение и отправьте нам свои переводческие файлы. Большое спасибо.",
    "appnetos__forgotten_password_form__save" => "Сохранить",
    "appnetos__forgotten_password_form__select_mailbox" => "Выберите почтовый ящик",
];