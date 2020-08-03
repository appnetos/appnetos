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
 * @description     Admin language management.
 */

// Language strings.
$strings = [
    "admin__settings__manage_language__info" => "Список всех языков, используемых ОС APPNET. Будут использоваться выбранные здесь языки. Язык, используемый пользователем, определяется браузером, но может быть изменен языковым файлом cookie. Язык определяется ключом и подразделом. Языковые файлы приложений выбираются этим ключом. Языковые файлы приложения хранятся в приложении в строковом каталоге. Каждое приложение имеет глобальный языковой файл, называемый global.php. Он загружается всякий раз, когда запрашиваемый языковой файл не может быть загружен. Если языковой файл с вложенным ключом запрошен и не существует, попытается загрузить языковой файл основного ключа. Если он не существует, будет загружен установленный стандартный язык. Если он также не существует, будет загружен глобальный языковой файл. Порядок загрузки языковых файлов в одном примере. en-US -> en -> Standard -> Global",
    "admin__settings__manage_language__remove" => "Удалить язык",
    "admin__settings__manage_language__remove_info" => "Будьте осторожны при удалении языков. Если язык удален, страницы больше не выпускаются на этом языке. Контент по умолчанию выпускается голосовыми браузерами с этим языком. Стандартный язык не определен, тогда используется глобальный язык.",
    "admin__settings__manage_language__err_add" => "Язык не может быть активирован",
    "admin__settings__manage_language__err_remove" => "Язык не может быть отключен",
    "admin__settings__manage_language__conf_remove" => "Язык был отключен",
    "admin__settings__manage_language__conf_add" => "Язык активирован",
    "admin__settings__manage_language__menu_header" => "Управление языками",
    "admin__settings__manage_language__search" => "Поиск",
    "admin__settings__manage_language__language_settings" => "Язык",
    "admin__settings__manage_language__no_languages" => "Языки недоступны",
    "admin__settings__manage_language__activate" => "Активировать",
    "admin__settings__manage_language__deactivate" => "Отключить",
    "admin__settings__manage_language__properties" => "Вариантов размещения",
    "admin__settings__manage_language__default" => "По умолчанию",
    "admin__settings__manage_language__activated" => "Активирован",
    "admin__settings__manage_language__close" => "Закрыть",
];
