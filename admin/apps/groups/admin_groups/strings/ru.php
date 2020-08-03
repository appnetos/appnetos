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
 * @description     Admin user groups. Groups can be used to define which administrators can view which areas.
 */

// Language strings.
$strings = [
    "admin__groups__admin_groups__info" => "Группы администраторов контролируют доступ к страницам для пользователей в разделе администрирования. Вызов страницы может быть разрешен или отклонен. Если страницы не связаны с группой, то к каждой странице можно получить доступ. Если разрешенные страницы не назначены группе, то все страницы могут быть вызваны, за исключением тех, которые назначены отказано. Если не отказано страниц назначаются, то только страницы, которые разрешены присваиваются. Она также может быть разрешена и лишен доступа к страницам в то же время. Разработчики должны отметить, что URI ID не возвращается, если URIs отказано. Администраторы, не связанные с группой, не имеют ограничений.",
    "admin__groups__admin_groups__menu_header" => "Группы администраторов",
    "admin__groups__admin_groups__add_group" => "Добавление группы администратора",
    "admin__groups__admin_groups__search" => "Поиск",
    "admin__groups__admin_groups__name_up" => "Имя восходящее",
    "admin__groups__admin_groups__name_down" => "Название нисходящей",
    "admin__groups__admin_groups__id_up" => "ID восходящий",
    "admin__groups__admin_groups__id_down" => "ID нисходящий",
    "admin__groups__admin_groups__no_groups" => "Нет доступных групп",
    "admin__groups__admin_groups__add" => "Добавить",
    "admin__groups__admin_groups__name" => "Название группы",
    "admin__groups__admin_groups__close" => "Закрыть",
    "admin__groups__admin_groups__add_err_name_enter" => "Пожалуйста, введите название группы",
    "admin__groups__admin_groups__add_err_name_exists" => "Имя группы уже назначено",
    "admin__groups__admin_groups__add_conf" => "Группа была добавлена",
    "admin__groups__admin_groups__delete" => "Удалить",
    "admin__groups__admin_groups__group_id" => "Идентификатор группы",
    "admin__groups__admin_groups__denied_uris" => "Отказано URIs",
    "admin__groups__admin_groups__granted_uris" => "Предоставленные URIs",
    "admin__groups__admin_groups__all" => "Все",
    "admin__groups__admin_groups__non" => "Нет",
    "admin__groups__admin_groups__all_but_denied" => "Все, но отказано",
    "admin__groups__admin_groups__all_but_granted" => "Все, кроме предоставлено",
    "admin__groups__admin_groups__information" => "Информация",
    "admin__groups__admin_groups__no_uris" => "Нет URIs связанных",
    "admin__groups__admin_groups__edit_err" => "Группа не может быть отредактирована",
    "admin__groups__admin_groups__no_uris_err" => "Не выбраны УРИ",
    "admin__groups__admin_groups__add_uri_conf" => "Добавлены УРИ",
    "admin__groups__admin_groups__home" => "Дома",
    "admin__groups__admin_groups__remove_uri_conf" => "Ури были удалены",
    "admin__groups__admin_groups__remove" => "Удалить",
    "admin__groups__admin_groups__edit" => "Редактировать",
    "admin__groups__admin_groups__edit_conf" => "Группа была отредактирована",
    "admin__groups__admin_groups__delete_header" => "Удалить группу администратора",
    "admin__groups__admin_groups__delete_info" => "Будьте осторожны при удалении групп администраторов. Удаленные группы администраторов не могут быть восстановлены. Учетные записи администратора, связанные с группой, присваиваются группе по умолчанию. Если группа по умолчанию не определена, эти администраторы имеют полный доступ к любому содержимому.",
    "admin__groups__admin_groups__delete_conf" => "Группа была удалена",
    "admin__groups__admin_groups__as_default" => "В стандартном виде",
    "admin__groups__admin_groups__default" => "Стандартный",
    "admin__groups__admin_groups__delete_err" => "Группа не может быть удалена",
];