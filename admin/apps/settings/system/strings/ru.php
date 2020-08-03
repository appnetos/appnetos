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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 */

// Language strings.
$strings = [
    "admin__settings__system__info" => "Системные настройки APPNET OS хранятся в файле config.ing.php в Главном каталоге. В целях безопасности большинство настроек можно изменить только непосредственно в файле. Под Cache настройки кэширования могут быть перезаписаны. Это имеет смысл для разработки приложений. Под Admin находятся Настройки для Админки.",
    "admin__settings__system__database" => "Настройки базы данных",
    "admin__settings__system__database_type" => "Тип базы данных",
    "admin__settings__system__database_host" => "Хост базы данных",
    "admin__settings__system__database_user" => "Имя пользователя базы данных",
    "admin__settings__system__database_port" => "Порт базы данных",
    "admin__settings__system__database_charset" => "База данных charset",
    "admin__settings__system__database_pass" => "Пароль базы данных",
    "admin__settings__system__database_name" => "Имя базы данных",
    "admin__settings__system__system" => "Настройки системы",
    "admin__settings__system__prefix" => "APPNET OS префикс",
    "admin__settings__system__url" => "Системный URL",
    "admin__settings__system__data_path" => "Системный путь данных",
    "admin__settings__system__directories" => "Справочники",
    "admin__settings__system__cache_dir" => "Каталог кеша",
    "admin__settings__system__temp_dir" => "Временный каталог данных",
    "admin__settings__system__log_dir" => "Каталог файлов журнала",
    "admin__settings__system__compile_dir" => "Каталог компиляции Smarty",
    "admin__settings__system__config_dir" => "Каталог конфигурации Smarty",
    "admin__settings__system__cache" => "кэш",
    "admin__settings__system__app_cache" => "Кеш приложения",
    "admin__settings__system__cache_expire" => "Срок действия кэша приложения в секундах",
    "admin__settings__system__file_cache" => "Файловый кеш",
    "admin__settings__system__directory_cache" => "Кеш каталога",
    "admin__settings__system__string_cache" => "Строковый кеш",
    "admin__settings__system__js_cache" => "Кеш JavaScript",
    "admin__settings__system__css_cache" => "CSS кеш",
    "admin__settings__system__minify" => "Сократите JavaScript и CSS, когда кеш не активен",
    "admin__settings__system__cookie_lock" => "APPNET OS блокировщик файлов cookie",
    "admin__settings__system__expert_mode" => "Экспертный режим раздела администратора",
    "admin__settings__system__debugging" => "отладка",
    "admin__settings__system__debug_mode" => "Режим отладки",
    "admin__settings__system__debug_ajax" => "Режим отладки AJAX",
    "admin__settings__system__user" => "Пользовательские настройки",
    "admin__settings__system__user_regex" => "Регулярное выражение проверки имени пользователя",
    "admin__settings__system__pass_regex" => "Регулярное выражение проверки пароля",
    "admin__settings__system__user_error_count" => "Количество неправильных входов перед блокировкой пользователей",
    "admin__settings__system__files_dir" => "Принятые каталоги",
    "admin__settings__system__files_types" => "Принятые форматы файлов",
    "admin__settings__system__max_size" => "Лимит загрузки файлов",
    "admin__settings__system__cache_info" => "APPNET OS использует различные кэши для ускорения работы системы. Настройки кэша определены в файле config.inc.php в главном каталоге и могут быть изменены здесь. В дополнение к разработке или редактированию страниц, кэши всегда должны быть активными. Кеш приложения также управляется приложениями. Не все приложения имеют возможность кэшировать свой контент. Кэш файлов сохраняет историю файлов, а кэш каталогов сохраняет историю каталогов. В результате не все файлы и каталоги приложений необходимо просматривать. Кэш строк хранит все строки, которые уже были загружены. JavaScript и CSS Cache собирает все файлы из активных приложений, минимизирует их, сохраняет их и помещает ссылку в заголовок. Для разработки, опция минимизации может быть отключена.",
    "admin__settings__system__admin_info" => "В настройках админа можно активировать экспертный режим. В экспертном режиме можно редактировать файлы JavaScript и CSS приложений, а также изменять режим кэширования приложений. Также есть возможность отключить информацию в админке.",
    "admin__settings__system__admin_expert_mode" => "Экспертный режим",
    "admin__settings__system__admin_show_info" => "Показать информацию в разделе администратора",
    "admin__settings__system__debug_info" => "Именно здесь можно активировать отладку и отладку AJAX. Отладка выдает все сообщения об ошибках PHP внизу страницы. Отладка AJAX выдает уникальный идентификатор AJAX, который требуется для запросов AJAX.",
    "admin__settings__system__debug_debug" => "Отладка системы",
    "admin__settings__system__debug_debug_ajax" => "Отладка AJAX",
    "admin__settings__system__menu_system" => "Настройки системы",
    "admin__settings__system__menu_cache" => "Настройки кэша",
    "admin__settings__system__menu_admin" => "Настройки админа",
    "admin__settings__system__menu_debug" => "Настройки отладки",
    "admin__settings__system__files" => "Файлы",
    "admin__settings__system__save" => "Сохранить",
    "admin__settings__system__conf" => "Настройки сохранены",
    "admin__settings__system__compressor" => "Сжатие исходного кода HTML",
    "admin__settings__system__extend_info" => "APPNET OS позволяет каждому классу расширяться несколько раз, не меняя сам класс, будь то класс приложений или основной класс. Это позволяет приложениям вносить коррективы в классы без изменения самого класса.  С расширением класса, отдельные функции могут быть изменены. Нет необходимости воссоздавать полный класс. Несколько расширений могут привести к ошибкам в неправильном порядке. Здесь вы можете настроить порядок расширений. Переопределения, которые больше не существуют, могут быть удалены.",
    "admin__settings__system__class_extends" => "Расширения класса",
    "admin__settings__system__class" => "Класса",
    "admin__settings__system__extends" => "Расширяет",
    "admin__settings__system__extends_move_confirm" => "Расширение было перемещено",
    "admin__settings__system__extends_move_error" => "Расширение не может быть перемещено",
    "admin__settings__system__extends_remove_confirm" => "Расширение удалено",
    "admin__settings__system__extends_remove_error" => "Расширение не может быть удалено",
    "admin__settings__system__extends_not_exists" => "Класс не существует",
    "admin__settings__system__remove" => "Удалить",
    "admin__settings__system__remove_warning" => "Будьте осторожны при удалении расширений класса. Удаление расширений класса может вызвать проблемы. Пожалуйста, проверьте перед удалением класса, если класс больше не существует и не требуется ли расширение.",
    "admin__settings__system__close" => "Закрыть",
    "admin__settings__system__activated" => "Активирован",
    "admin__settings__system__deactivated" => "Отключить",
    "admin__settings__system__activate" => "Активировать",
    "admin__settings__system__deactivate" => "Отключить",
    "admin__settings__system__extends_activate_error" => "Расширение класса не может быть активировано",
    "admin__settings__system__extends_activate_error_exists" => "Расширение класса не может быть активировано. Одного из необходимых классов не существует.",
    "admin__settings__system__extends_deactivate_error" => "Расширение класса не может быть отключено",
    "admin__settings__system__extends_activate_confirm" => "Расширение класса активировано",
    "admin__settings__system__extends_deactivate_confirm" => "Расширение класса отключено",
    "admin__settings__system__no_extends" => "Расширений класса нет",
];