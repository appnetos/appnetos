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
 * @description     Admin URI management to add and delete URIs.
 */

// Language strings.
$strings = [
    "admin__cms__uri_management__add" => "Добавить URI",
    "admin__cms__uri_management__info" => "URI - это адрес подстраницы веб-сайта. URI присоединяется к концу URL-адреса, определенного в config.inc.php. Вместе они образуют URL-адрес, по которому можно получить доступ к странице. APPNET OS поддерживает многоязычные говорящие URI. Это мощный инструмент. Это позволяет определять URI страницы на нескольких языках. Если ссылки в представлениях доступны через URI ID, то URI будет открыт на соответствующем языке. В Smarty View ссылка связана с [{\ $ render-> getUrl (URI ID)}]]. В PHP с echo \ $ render-> getUrl (URI ID). Многоязычная поддержка кодировки UTF8. Таким образом, за некоторыми исключениями, URI также может создаваться на всех языках. Если несколько URI страницы имеют одинаковое содержимое, то канонический должен быть помещен в основную запись. В результате поисковые системы обнаруживают многоязычные URI с одинаковым содержимым и не наказываются. Это также дает вам возможность определить свой собственный заголовок и значок для каждой страницы. Если они не определены, то Favicon используется в настройках языка. Недавно добавленные URI всегда глобальны. Редактировать языки в URI можно добавить в URI. Управляющие приложения могут определять контент.",
    "admin__cms__uri_management__button_apps" => "Управление приложениями",
    "admin__cms__uri_management__add_info" => "Здесь веб-сайт может быть расширен дополнительными подстраницами. Если URI пуст, создается ссылка на страницу индекса. URI должны быть созданы без URL, определенного в config.inc.php. URI не начинаются с / одного начала. URI могут не содержать следующие символы: /?:@=&'\\\"<>#%{}|\\^~[]`. Каждый URI может существовать только один раз.",
    "admin__cms__uri_management__err_add" => "Запись не может быть создана",
    "admin__cms__uri_management__err_add_valid" => "URL не разрешен",
    "admin__cms__uri_management__err_add_favicon" => "Не разрешен путь к файвику",
    "admin__cms__uri_management__err_add_exists" => "Уже есть запись с этим URI",
    "admin__cms__uri_management__conf_add" => "URI был добавлен",
    "admin__cms__uri_management__delete_header" => "Удалить URI",
    "admin__cms__uri_management__delete_info" => "Будьте осторожны при удалении URI. При удалении URI страница больше не доступна. Конфигурация страницы безвозвратно утеряна.",
    "admin__cms__uri_management__err_delete" => "Запись не может быть удалена",
    "admin__cms__uri_management__conf_delete" => "Запись была удалена",
    "admin__cms__uri_management__edit_seo" => "Изменить URI",
    "admin__cms__uri_management__menu_header" => "Управление URI",
    "admin__cms__uri_management__search" => "Поиск",
    "admin__cms__uri_management__no_uris" => "Нет URIs доступны",
    "admin__cms__uri_management__home" => "Дома",
    "admin__cms__uri_management__delete" => "Удалить",
    "admin__cms__uri_management__uri_id" => "URI ID",
    "admin__cms__uri_management__properties" => "Вариантов размещения",
    "admin__cms__uri_management__views" => "Представления",
    "admin__cms__uri_management__apps" => "Приложения",
    "admin__cms__uri_management__languages" => "Языки",
    "admin__cms__uri_management__title" => "Название",
    "admin__cms__uri_management__language_settings" => "Язык",
    "admin__cms__uri_management__favicon" => "Значок",
    "admin__cms__uri_management__uri" => "URI",
    "admin__cms__uri_management__button_add" => "Добавить",
    "admin__cms__uri_management__close" => "Закрыть",
    "admin__cms__uri_management__id_up" => "ID по возрастанию",
    "admin__cms__uri_management__id_down" => "ID по убыванию",
    "admin__cms__uri_management__uri_up" => "URI по возрастанию",
    "admin__cms__uri_management__uri_down" => "URI по убыванию",
    "admin__cms__uri_management__title_up" => "Название по возрастанию",
    "admin__cms__uri_management__title_down" => "Заголовок по убыванию",
];