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
 * @description     Admin edit URI and languages URIs.
 */

// Language strings.
$strings = [
    "admin__cms__edit_uri__add_lang" => "Добавить язык",
    "admin__cms__edit_uri__remove_header" => "Удалить язык",
    "admin__cms__edit_uri__remove_info" => "Будьте осторожны при удалении URI. Если говорящий URI удален, доступ к этой странице больше невозможен путем непосредственного ввода адреса. Ссылки через идентификатор URI затем направляются на URI языка по умолчанию или на глобальный URI.",
    "admin__cms__edit_uri__info" => "Глобализация в сочетании с многоязычными говорящими URI - это мощный инструмент в APPNETOS. Это позволяет создавать многоязычную страницу, используя простые средства. Для каждой страницы, в зависимости от установленного языка, содержимое, говорящий URI, заголовок и Favicon могут быть изменены. При правильном использовании высокий рейтинг достигается в поисковых системах. В Smarty View ссылка связана с [{\ $ render-> getUrl (URI ID)}]]. В PHP с echo getUrl (URI ID). Многоязычная поддержка кодировки UTF8. Таким образом, за некоторыми исключениями, URI также может создаваться на всех языках. Если английский URI my-uri и немецкий URI meine-uri, страница называется на английском языке по адресу http://www.appnetos.com/my-uri и на немецком языке по адресу http://www.appnetos.com/meine. -uri. Если несколько URI страницы имеют одинаковое содержимое, то канонический должен быть помещен в основную запись. В результате поисковые системы обнаруживают многоязычные URI с одинаковым содержимым и не наказываются.",
    "admin__cms__edit_uri__add_info" => "Для каждого URI могут быть определены говорящий URI, заголовок и Favicon, в зависимости от установленного вами языка. Для индекса URI говорящий URI не может быть определен. Если несколько URI страницы имеют одинаковое содержимое, то канонический должен быть помещен в основную запись. В результате поисковые системы обнаруживают многоязычные URI с одинаковым содержимым и не наказываются.",
    "admin__cms__edit_uri__err_load" => "Невозможно загрузить контент",
    "admin__cms__edit_uri__no_lang" => "Нет других доступных языков",
    "admin__cms__edit_uri__err_add" => "Язык не может быть добавлен",
    "admin__cms__edit_uri__add_exists" => "Уже существует запись с этим URI",
    "admin__cms__edit_uri__conf_add" => "Язык был добавлен",
    "admin__cms__edit_uri__not_exists" => "Язык больше не существует",
    "admin__cms__edit_uri__err_remove" => "Запись языка не может быть удалена",
    "admin__cms__edit_uri__conf_remove" => "Запись языка была удалена",
    "admin__cms__edit_uri__edit_header" => "Изменить запись",
    "admin__cms__edit_uri__edit_info" => "Будьте осторожны при изменении URI. Если URI изменяется, то эта страница больше не может быть достигнута путем непосредственного ввода адреса. Ссылки на URI ID не затрагиваются.",
    "admin__cms__edit_uri__err" => "Запись не может быть загружена",
    "admin__cms__edit_uri__err_edit" => "Запись не может быть отредактирована",
    "admin__cms__edit_uri__conf_edit" => "Запись была отредактирована",
    "admin__cms__edit_uri__err_no_uri" => "URI не введен",
    "admin__cms__edit_uri__err_add_valid" => "URL не разрешен",
    "admin__cms__edit_uri__menu_header" => "Работать URI",
    "admin__cms__edit_uri__menu_app_management" => "URI Управление приложениями",
    "admin__cms__edit_uri__menu_uri_management" => "URI Менеджмент",
    "admin__cms__edit_uri__no_languages" => "Языки недоступны",
    "admin__cms__edit_uri__remove" => "Удалить",
    "admin__cms__edit_uri__edit" => "Редактировать",
    "admin__cms__edit_uri__id" => "URI ID",
    "admin__cms__edit_uri__properties" => "Вариантов размещения",
    "admin__cms__edit_uri__views" => "Представления",
    "admin__cms__edit_uri__apps" => "Приложения",
    "admin__cms__edit_uri__languages" => "Языки",
    "admin__cms__edit_uri__language" => "Язык",
    "admin__cms__edit_uri__title" => "Название",
    "admin__cms__edit_uri__favicon" => "Значок",
    "admin__cms__edit_uri__language_settings" => "Язык",
    "admin__cms__edit_uri__global" => "Глобального",
    "admin__cms__edit_uri__uri" => "URI",
    "admin__cms__edit_uri__canonical" => "Каноническое идентификатор",
    "admin__cms__edit_uri__no_canonical" => "Канонического идентификатора нет",
    "admin__cms__edit_uri__save" => "Сохранить",
    "admin__cms__edit_uri__close" => "Закрыть",
    "admin__cms__edit_uri__add" => "Добавить",
    "admin__cms__edit_uri__home_info" => "Языки не могут быть добавлены на главную страницу",
    "admin__cms__edit_uri__home" => "Дома",
    "admin__cms__edit_uri__meta_delete" => "Удалить",
    "admin__cms__edit_uri__clear" => "Сброс",
    "admin__cms__edit_uri__name" => "Имя",
    "admin__cms__edit_uri__content" => "Содержимого",
    "admin__cms__edit_uri__meta_title" => "Название для поисковых систем. Максимум 70 символов.",
    "admin__cms__edit_uri__meta_description" => "Описание для поисковых систем. Максимум 320 символов.",
    "admin__cms__edit_uri__meta_keywords" => "Ключевые слова для поисковых систем. До 5 ключевых слов, разделенных пробелами.",
];
