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
 * @description     Admin URI apps management.
 */

// Language strings.
$strings = [
    "admin__cms__manage_apps__conf_add" => "Приложение было добавлено",
    "admin__cms__manage_apps__err_add" => "Приложение не может быть добавлено",
    "admin__cms__manage_apps__err_remove" => "Приложение не может быть удалено",
    "admin__cms__manage_apps__conf_remove" => "Приложение было удалено",
    "admin__cms__manage_apps__err_move" => "Приложение не может быть перемещено",
    "admin__cms__manage_apps__conf_move" => "Приложение было перемещено",
    "admin__cms__manage_apps__add" => "Добавить приложение",
    "admin__cms__manage_apps__info" => "В APPNET OS содержимое URI передается приложениями. Каждое приложение является частью страницы. Приложения также могут быть доступны несколько раз на странице. Есть два разных типа приложений. Стандартные приложения и контейнерные приложения. Стандартные приложения всегда выдаются индивидуально между собой. Ширина стандартного приложения всегда составляет 100%. Стандартное приложение всегда выпускается под предыдущими приложениями. Следующее приложение будет выпущено снова под стандартным приложением. Контейнерные приложения всегда выпускаются вместе с другими контейнерными приложениями в одном контейнере. Для каждого приложения контейнера можно определить размер. Если определены два соседних приложения-контейнера, каждое шириной 50%, они будут выпущены рядом. Если определены три контейнерных приложения, каждое шириной 50%, то два выпускаются рядом и одно снизу. Если каждое из трех контейнерных приложений имеет ширину 33%, все три приложения создаются рядом. Широкие настройки могут быть установлены для четырех значений ширины дисплея. Это позволяет размещать приложения-контейнеры рядом на большом дисплее и между собой на маленьком дисплее. Размер контейнерных приложений можно определить в приложении «Настройки».",
    "admin__cms__manage_apps__err" => "URI запись не может быть загружена",
    "admin__cms__manage_apps__not_exists" => "Это приложение больше не существует",
    "admin__cms__manage_apps__menu_header" => "Управление приложениями URI",
    "admin__cms__manage_apps__edit_uri" => "Edit URI",
    "admin__cms__manage_apps__uri_management" => "Управление URI",
    "admin__cms__manage_apps__home" => "Дома",
    "admin__cms__manage_apps__id" => "URI ID",
    "admin__cms__manage_apps__properties" => "Вариантов размещения",
    "admin__cms__manage_apps__views" => "Представления",
    "admin__cms__manage_apps__apps" => "Приложения",
    "admin__cms__manage_apps__languages" => "Языки",
    "admin__cms__manage_apps__title" => "Название",
    "admin__cms__manage_apps__favicon" => "Значок",
    "admin__cms__manage_apps__language_settings" => "Язык",
    "admin__cms__manage_apps__global" => "Глобального",
    "admin__cms__manage_apps__uri_id" => "URI ID",
    "admin__cms__manage_apps__app_id" => "Идентификатор приложения",
    "admin__cms__manage_apps__activated" => "Активирован",
    "admin__cms__manage_apps__deactivated" => "Отключить",
    "admin__cms__manage_apps__no_description" => "Нет описания",
    "admin__cms__manage_apps__close" => "Закрыть",
    "admin__cms__manage_apps__no_content" => "Нет контента",
    "admin__cms__manage_apps__frontend" => "Frontend",
    "admin__cms__manage_apps__admin_area" => "Админ области",
    "admin__cms__manage_apps__static" => "Статический",
    "admin__cms__manage_apps__not_static" => "Не статичны",
    "admin__cms__manage_apps__size" => "Размер и ориентация",
    "admin__cms__manage_apps__container_css" => "Контейнер CSS",
    "admin__cms__manage_apps__app_css" => "ПРИЛОЖЕНИЕ CSS",
    "admin__cms__manage_apps__no_container_css" => "Нет контейнера CSS",
    "admin__cms__manage_apps__no_app_css" => "Нет приложения CSS",
    "admin__cms__manage_apps__admin" => "Админ области",
    "admin__cms__manage_apps__css_container_fluid" => "Контейнерная жидкость CSS",
    "admin__cms__manage_apps__no_container_fluid_css" => "Нет контейнера жидкости CSS",
    "admin__cms__manage_apps__settings" => "Параметры",
    "admin__cms__manage_apps__remove" => "Удалить",
    "admin__cms__manage_apps__no_apps" => "Нет доступных приложений",
];