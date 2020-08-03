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
 * @description     Admin files management. Create and delete folders. Upload and delete files. The folders to manage
 *                  files in the files manager must be defined in the config.inc.php.
*/

// Strings.
$strings = [
    "admin__files__mgnt__info" => "В этой области можно управлять файлами и каталогами. По соображениям безопасности перечислены только каталоги, определенные в config.inc.php в \$filesDirectories. \$filesType определяет поддерживаемые форматы. Рекомендуется перечислять только каталоги из внешнего каталога. Файлы, удаленные в файловом менеджере, восстановить невозможно. Все каталоги, перечисленные в config.inc.php, защищены и не могут быть удалены. Подкаталоги также могут быть перечислены для их защиты. Следует отметить, что файлы корневых каталогов не защищены и могут быть удалены.",
    "admin__files__mgnt__no_files" => "Нет доступных файлов",
    "admin__files__mgnt__drop" => "Нажмите или бросьте файлы здесь",
    "admin__files__mgnt__upload" => "Загрузить",
    "admin__files__mgnt__err_format" => "Формат файла не принят",
    "admin__files__mgnt__err_path" => "Каталог не принят",
    "admin__files__mgnt__delete_header" => "Удалить файлы",
    "admin__files__mgnt__delete_info" => "Будьте осторожны при удалении файлов. Удаленные файлы не могут быть восстановлены.",
    "admin__files__mgnt__delete_conf" => "Файлы были удалены",
    "admin__files__mgnt__delete_err" => "Файлы не могут быть удалены",
    "admin__files__mgnt__delete_warn" => "Не все файлы могут быть удалены",
    "admin__files__mgnt__delete_directory" => "Удалить каталог",
    "admin__files__mgnt__delete_file" => "Удалить файл",
    "admin__files__mgnt__rename_directory" => "Переименовать каталог",
    "admin__files__mgnt__rename_file" => "Переименуйте файл",
    "admin__files__mgnt__add_directory" => "Добавить каталог",
    "admin__files__mgnt__new_name" => "Новое имя",
    "admin__files__mgnt__file_rename_err" => "Файл не может быть переименован",
    "admin__files__mgnt__file_rename_conf" => "Файл был переименован",
    "admin__files__mgnt__directory_rename_err" => "Каталог не может быть переименован",
    "admin__files__mgnt__directory_rename_conf" => "Каталог был переименован",
    "admin__files__mgnt__file_rename_err_ex" => "Уже есть файл с таким именем",
    "admin__files__mgnt__dir_rename_err_ex" => "Уже есть каталог с таким именем",
    "admin__files__mgnt__dir_rename_err_root" => "Каталог является корневым каталогом или содержит корневой каталог и не может быть переименован",
    "admin__files__mgnt__add_dir_err" => "Каталог не может быть добавлен",
    "admin__files__mgnt__add_dir_err_exists" => "Каталог уже существует",
    "admin__files__mgnt__add_dir_conf" => "Каталог был добавлен",
    "admin__files__mgnt__delete_dir_info" => "Будьте осторожны при удалении каталогов. При удалении каталогов все файлы и подкаталоги удаляются безвозвратно.",
    "admin__files__mgnt__delete_dir_err" => "Каталог не может быть удален",
    "admin__files__mgnt__err_move" => "Загруженный файл не может быть перемещен",
    "admin__files__mgnt__delete_dir_err_exists" => "Каталог не существует",
    "admin__files__mgnt__delete_dir_err_root" => "Каталог является корневым каталогом или содержит корневой каталог и не может быть удален",
    "admin__files__mgnt__refresh" => "синхронизировать",
    "admin__files__mgnt__err_to_large" => "Файл слишком велик для загрузки. Ограничить php.ini:",
    "admin__files__mgnt__delete_selection" => "Удаление выбора",
    "admin__files__mgnt__delete" => "Удалить",
    "admin__files__mgnt__header" => "Управление файлами",
    "admin__files__mgnt__cancel" => "Отмена",
    "admin__files__mgnt__close" => "Закрыть",
    "admin__files__mgnt__save" => "Сохранить",
    "admin__files__mgnt__name" => "Имя",
    "admin__files__mgnt__add" => "Добавить",
];