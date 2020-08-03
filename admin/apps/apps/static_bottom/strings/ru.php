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
 * @description     Admin application to manage static bottom apps.
 */

// Language strings.
$strings = [
    "admin__apps__static_bottom__conf_add" => "Приложение было добавлено",
    "admin__apps__static_bottom__err_add" => "Приложение не может быть добавлено",
    "admin__apps__static_bottom__conf_move" => "Приложение было перемещено",
    "admin__apps__static_bottom__err_move" => "Приложение не может быть перемещено",
    "admin__apps__static_bottom__conf_remove" => "Приложение было удалено",
    "admin__apps__static_bottom__err_remove" => "Приложение не может быть удалено",
    "admin__apps__static_bottom__add" => "Добавить приложение",
    "admin__apps__static_bottom__info" => "Статические приложения запускаются вверху или внизу каждой страницы. Это не только позволяет постоянно отображать такие компоненты, как колонтитулы, но также позволяет загружать несколько используемых контроллеров или моделей, используемых другими приложениями. Этот метод дает разработчикам возможность перегружать классы или включать глобальные файлы CSS и JavaScript. При удалении статических приложений вы должны быть осторожны. Если другие приложения имеют зависимости от этих статических приложений, могут возникнуть проблемы. Удаленные приложения не будут удалены и могут быть добавлены обратно в любое время.",
    "admin__apps__static_bottom__remove_header" => "Удалить статическое приложение",
    "admin__apps__static_bottom__remove_info" => "Будьте осторожны при удалении статических приложений. Удаление статических приложений, которые используются другими приложениями, может вызвать ошибки. Удаленные статические приложения не будут удалены и могут быть восстановлены в любое время.",
    "admin__apps__static_bottom__search" => "Поиск",
    "admin__apps__static_bottom__static_apps_bottom" => "Статические приложения сверху",
    "admin__apps__static_bottom__static_apps_top" => "Статические приложения снизу",
    "admin__apps__static_bottom__no_apps" => "Нет доступных приложений",
    "admin__apps__static_bottom__settings" => "Параметры",
    "admin__apps__static_bottom__remove" => "Удалить",
    "admin__apps__static_bottom__app_id" => "Идентификатор приложения",
    "admin__apps__static_bottom__properties" => "Вариантов размещения",
    "admin__apps__static_bottom__activated" => "Включен",
    "admin__apps__static_bottom__deactivated" => "Отключен",
    "admin__apps__static_bottom__no_description" => "Нет описания",
    "admin__apps__static_bottom__close" => "Закрыть",
    "admin__apps__static_bottom__no_content" => "Нет контента",
    "admin__apps__static_bottom__frontend" => "Frontend",
    "admin__apps__static_bottom__admin_area" => "Админ области",
    "admin__apps__static_bottom__static" => "Статический",
    "admin__apps__static_bottom__not_static" => "Не статичны",
    "admin__apps__static_bottom__size" => "Размер и ориентация",
    "admin__apps__static_bottom__container_css" => "Контейнер CSS",
    "admin__apps__static_bottom__app_css" => "ПРИЛОЖЕНИЕ CSS",
    "admin__apps__static_bottom__no_container_css" => "Нет контейнера CSS",
    "admin__apps__static_bottom__no_app_css" => "Нет приложения CSS",
    "admin__apps__static_bottom__admin" => "Админ области",
    "admin__apps__static_bottom__css_container_fluid" => "Контейнерная жидкость CSS",
    "admin__apps__static_bottom__no_container_fluid_css" => "Нет контейнера жидкости CSS",
];