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
 * @description     Admin app overview and app management.
 */

// Language strings.
$strings = [
    "admin__apps__management__conf_deactivate" => "Приложение было деактивировано",
    "admin__apps__management__conf_activate" => "Приложение было активировано",
    "admin__apps__management__err_activate" => "Приложение не может быть активировано или деактивировано",
    "admin__apps__management__conf_remove" => "Приложение было удалено",
    "admin__apps__management__err_remove" => "Приложение не может быть удалено",
    "admin__apps__management__info" => "APPNET OS использует приложения для создания из них веб-страниц. Управление приложениями перечисляет все установленные приложения. Приложения могут быть назначены отдельным страницам в управлении SEO. Статические приложения также можно установить вверху, а статические приложения внизу. Затем они располагаются на каждой странице сверху или снизу. Приложения также могут включать в себя область администратора. Доступ к области администратора можно получить через настройки приложения. События позволяют разработчикам назначать приложениям определенные действия. Эти события будут выполняться под соответствующим событием. Это позволяет приложениям устанавливать, дублировать, сбрасывать, удалять и удалять приложение. Также могут быть события, которые запускаются при активации или деактивации.",
    "admin__apps__management__deactivate_header" => "Деактивировать приложение",
    "admin__apps__management__deactivate_info" => "Отключенные приложения не выдаются. Эта функция полезна при редактировании содержимого приложения. Данные не теряются, когда приложения отключены, и они могут быть повторно активированы в любое время.",
    "admin__apps__management__remove_header" => "Удалить приложение",
    "admin__apps__management__remove_info" => "Будьте осторожны при удалении приложений. Приложение удалено из базы данных приложения. Каталог приложения и таблица базы данных остаются на месте и должны быть удалены вручную. Данные не потеряны. Однако приложения с таблицами базы данных трудно восстановить.",
    "admin__apps__management__delete_header" => "Удалить приложение",
    "admin__apps__management__delete_info" => "Будьте осторожны при удалении приложений. Приложение удаляется из базы данных приложения, и запускается скрипт приложения для его удаления. Все таблицы базы данных приложения удалены. Данные не могут быть восстановлены и будут потеряны навсегда.",
    "admin__apps__management__conf_delete" => "Приложение было удалено",
    "admin__apps__management__err_delete" => "Приложение не может быть удалено",
    "admin__apps__management__err_description" => "Описание не может быть изменено",
    "admin__apps__management__conf_description" => "Описание было изменено",
    "admin__apps__management__err_duplicate" => "Приложение не может быть продублировано",
    "admin__apps__management__conf_duplicate" => "Приложение было продублировано",
    "admin__apps__management__directory" => "Путь к приложению",
    "admin__apps__management__reset_header" => "Сбросить приложение",
    "admin__apps__management__reset_info" => "Будьте осторожны при сбросе приложений. Здесь скрипт приложения выполняется для сброса. Все таблицы базы данных приложения очищены. Данные не могут быть восстановлены и будут потеряны навсегда.",
    "admin__apps__management__err_reset" => "Приложение не может быть сброшено",
    "admin__apps__management__conf_reset" => "Приложение было сброшено",
    "admin__apps__management__description_info" => "Сделайте несколько приложений более узнаваемыми, добавив к ним описание.",
    "admin__apps__management__edit_styles" => "Редактировать стили",
    "admin__apps__management__duplicate" => "Дублировать",
    "admin__apps__management__reset" => "Сброс",
    "admin__apps__management__install" => "Установить",
    "admin__apps__management__activate" => "Активировать",
    "admin__apps__management__deactivate" => "Отключить",
    "admin__apps__management__delete" => "Удалить",
    "admin__apps__management__remove" => "Удалить",
    "admin__apps__management__revert" => "Сброс",
    "admin__apps__management__id_up" => "ID восходящий",
    "admin__apps__management__id_down" => "ID нисходящий",
    "admin__apps__management__name_up" => "Имя восходящее",
    "admin__apps__management__name_down" => "Название нисходящей",
    "admin__apps__management__description_up" => "Описание восходящее",
    "admin__apps__management__description_down" => "Описание нисходящей",
    "admin__apps__management__description" => "Описание",
    "admin__apps__management__settings" => "Параметры",
    "admin__apps__management__search" => "Поиск",
    "admin__apps__management__menu_header" => "Управление приложениями",
    "admin__apps__management__no_apps" => "Нет доступных приложений",
    "admin__apps__management__events" => "События",
    "admin__apps__management__no_events" => "Нет событий",
    "admin__apps__management__admin" => "Админ области",
    "admin__apps__management__activated" => "Активировать",
    "admin__apps__management__deactivated" => "Отключить",
    "admin__apps__management__no_description" => "Нет описания",
    "admin__apps__management__app_id" => "Идентификатор приложения",
    "admin__apps__management__properties" => "Вариантов размещения",
    "admin__apps__management__license" => "Лицензии",
    "admin__apps__management__no_content" => "Нет контента",
    "admin__apps__management__frontend" => "Frontend",
    "admin__apps__management__admin_area" => "Админ области",
    "admin__apps__management__static" => "Статический",
    "admin__apps__management__not_static" => "Не статичны",
    "admin__apps__management__size" => "Размер и ориентация",
    "admin__apps__management__container_css" => "Контейнер CSS",
    "admin__apps__management__app_css" => "ПРИЛОЖЕНИЕ CSS",
    "admin__apps__management__no_container_css" => "Нет контейнера CSS",
    "admin__apps__management__no_app_css" => "Нет приложения CSS",
    "admin__apps__management__no_store_license" => "Нет информации о лицензии",
    "admin__apps__management__no_store_description" => "Описание недоступно",
    "admin__apps__management__close" => "Закрыть",
    "admin__apps__management__css_container_fluid" => "Контейнерная жидкость CSS",
    "admin__apps__management__no_container_fluid_css" => "Нет контейнера жидкости CSS",
    "admin__apps__management__version" => "Версия",
];