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
    "appnetos__sign_up_form__header" => "Форма регистрации",
    "appnetos__sign_up_form__info" => "Это приложение является простой в использовании контактной формой. Контактная форма использует APPNET OS Mailer. Почтовый агент APPNET OS должен быть интегрирован в тот же URI перед контактной формой приложения. Контактная форма использует уникальный идентификатор Mailer и черный список Mailer и защищает его от спам-атак. Чтобы иметь возможность использовать контактную форму, почтовый ящик должен быть настроен для отправки в почтовую программу.",
    "appnetos__sign_up_form__settings" => "настройки",
    "appnetos__sign_up_form__directly" => "Регистрация новых пользователей без подтверждения по электронной почте",
    "appnetos__sign_up_form__mailbox" => "почтовый ящик",
    "appnetos__sign_up_form__terms" => "Ссылка на страницу с условиями использования",
    "appnetos__sign_up_form__terms_info" => "URL или URI ID. Оставьте пустым, если вы не хотите использовать ссылку на страницу условий использования.",
    "appnetos__sign_up_form__terms_holder" => "URL или URI ID.",
    "appnetos__sign_up_form__err_mailbox" => "Почтовый ящик не существует в почтовой программе",
    "appnetos__sign_up_form__conf" => "Настройки были отредактированы",
    "appnetos__sign_up_form__name" => "Подтверждение темы и имени электронной почты",
    "appnetos__sign_up_form__license" => "Это приложение доступно для частного и коммерческого использования в свободном доступе. Тексты приложения переводятся автоматически. xtrose Media Studio не несет ответственности за содержание приложения. Содержание приложения может быть изменено пользователем. Помогите улучшить это приложение и отправьте нам свои переводческие файлы. Большое спасибо.",
    "appnetos__sign_up_form__save" => "Сохранить",
    "appnetos__sign_up_form__select_mailbox" => "Выберите почтовый ящик",
];