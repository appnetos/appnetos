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
 * @description     Allows other apps to send messages through the set-up mailmail mailboxes. Creates logs for advanced
 *                  information and a widget for the dashboard.
 */

// Strings.
$strings = [
    "appnetos__mailer__widget_header" => "Mailer",
    "appnetos__mailer__widget_sent" => "Отправлено",
    "appnetos__mailer__widget_failed" => "Не удалось",
    "appnetos__mailer__widget_last_sent" => "Последнее подтверждение журнала",
    "appnetos__mailer__widget_last_failed" => "Последний журнал ошибок",
    "appnetos__mailer__widget_datetime" => "Дата-время",
    "appnetos__mailer__widget_address" => "Адрес электронной почты",
    "appnetos__mailer__widget_message" => "Сообщение",
    "appnetos__mailer__widget_word_info" => "Информация",
    "appnetos__mailer__widget_blacklist" => "Черный список соответствия",
    "appnetos__mailer__widget_mailbox" => "Почтовых ящиков",
    "appnetos__mailer__widget_ip" => "Ip",
    "appnetos__mailer__widget_not_defined" => "Неопределенный",
    "appnetos__mailer__widget_logs" => "Мейлер журналы",
    "appnetos__mailer__widget_reset_counter" => "Счетчик сбросить",
    "appnetos__mailer__widget_conf_counter_reset" => "Счетчик был сзатна",
    "appnetos__mailer__error_id_set" => "Идентификатор почтовой программы не установлен",
    "appnetos__mailer__error_mailbox_set" => "Почтовый ящик не установлен",
    "appnetos__mailer__error_to_addr_set" => "Адрес электронной почты получателя не установлен",
    "appnetos__mailer__error_body_set" => "Контент не установлен",
    "appnetos__mailer__error_id_match" => "ID отправителя не совпадает",
    "appnetos__mailer__error_to_addr" => "Адрес электронной почты получателя неверен",
    "appnetos__mailer__error_mailbox_ex" => "Почтовый ящик не существует",
    "appnetos__mailer__error_phpmailer" => "Ошибка PHP Mailer",
    "appnetos__mailer__error_email_in_blacklist" => "Адрес электронной почты находится в черном списке",
    "appnetos__mailer__error_email_to_blacklist" => "Слишком много запросов по электронной почте. Адрес электронной почты был установлен в черном списке",
    "appnetos__mailer__error_email" => "Адрес электронной почты",
    "appnetos__mailer__error_limit" => "Предел",
    "appnetos__mailer__error_no_settings" => "Настройки почтового рассылки недоступны.",
    "appnetos__mailer__error_no_mailboxes" => "Почтовых ящиков нет.",
    "appnetos__mailer__error_ip_in_blacklist" => "IP-адрес в черном списке",
    "appnetos__mailer__error_ip_to_blacklist" => "Слишком много запросов по электронной почте. IP-адрес внесен в черный список",
];