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
    "admin__files__mgnt__info" => "In diesem Bereich können Dateien und Verzeichnisse verwaltet werden. Aus Sicherheitsgründen werden hier nur Verzeichnisse gelistet, die in der config.inc.php, unter \$filesDirectories gelistet sind. Unter \$filesType werden unterstützte Formate definiert. Es wird empfohlen das nur Verzeichnisse aus dem out Verzeichnis gelistet werden. Dateien welche im Datei-Manager gelöscht werden können nicht wiederhergestellt werden. Alle in der config.inc.php gelisteten Verzeichnisse sind geschützt und können nicht gelöscht werden. Es können auch Unterverzeichnisse gelistet werden um diese zu schützen. Zu beachten ist, dass die Dateien der root Verzeichnisse nicht geschützt sind und gelöscht werden können.",
    "admin__files__mgnt__no_files" => "Keine Dateien vorhanden",
    "admin__files__mgnt__drop" => "Klicken oder Dateien hier ablegen",
    "admin__files__mgnt__upload" => "Hochladen",
    "admin__files__mgnt__err_format" => "Dateiformat wird nicht akzeptiert",
    "admin__files__mgnt__err_path" => "Verzeichnis wird nicht akzeptiert",
    "admin__files__mgnt__delete_header" => "Dateien löschen",
    "admin__files__mgnt__delete_info" => "Vorsicht beim löschen von Dateien. Gelöschte Dateien können nicht wiederhergestellt werden.",
    "admin__files__mgnt__delete_conf" => "Die Dateien wurden gelöscht",
    "admin__files__mgnt__delete_err" => "Die Dateien konnten nicht gelöscht werden",
    "admin__files__mgnt__delete_warn" => "Nicht alle Dateien konnten gelöscht werden",
    "admin__files__mgnt__delete_directory" => "Verzeichnis löschen",
    "admin__files__mgnt__delete_file" => "Datei löschen",
    "admin__files__mgnt__rename_directory" => "Verzeichnis umbenennen",
    "admin__files__mgnt__rename_file" => "Datei umbenennen",
    "admin__files__mgnt__add_directory" => "Verzeichnis hinzufügen",
    "admin__files__mgnt__new_name" => "Neuer name",
    "admin__files__mgnt__file_rename_err" => "Die Datei konnte nicht umbenannt werden",
    "admin__files__mgnt__file_rename_conf" => "Die Datei wurde umbenannt",
    "admin__files__mgnt__directory_rename_err" => "Das Verzeichnis konnte nicht umbenannt werden",
    "admin__files__mgnt__directory_rename_conf" => "Das Verzeichnis wurde umbenannt",
    "admin__files__mgnt__file_rename_err_ex" => "Es existiert bereits eine Datei mit diesem Namen",
    "admin__files__mgnt__dir_rename_err_ex" => "Es existiert bereits ein Verzeichnis mit diesem Namen",
    "admin__files__mgnt__dir_rename_err_root" => "Das Verzeichnis ist ein root Verzeichnis oder enthält ein root Verzeichnis und kann nicht umbenannt werden",
    "admin__files__mgnt__add_dir_err" => "Das Verzeichnis konnte nicht hinzugefügt werden",
    "admin__files__mgnt__add_dir_err_exists" => "Das Verzeichnis besteht bereits",
    "admin__files__mgnt__add_dir_conf" => "Das Verzeichnis wurde hinzugefügt",
    "admin__files__mgnt__delete_dir_info" => "Vorsicht beim löschen von Verzeichnissen. Beim löschen von Verzeichnissen werden alle Dateien und Unterverzeichnisse unwiederruflich gelöscht.",
    "admin__files__mgnt__delete_dir_err" => "Das Verzeichnis konnte nicht gelöscht werden",
    "admin__files__mgnt__err_move" => "Die hochgeladene Datei konnte nicht verschoben werden",
    "admin__files__mgnt__delete_dir_err_exists" => "Das Verzeichnis existiert nicht",
    "admin__files__mgnt__delete_dir_err_root" => "Das Verzeichnis ist ein root Verzeichnis oder enthält ein root Verzeichnis und kann nicht gelöscht werden",
    "admin__files__mgnt__refresh" => "Synchronisieren",
    "admin__files__mgnt__err_to_large" => "Die Datei ist für den Upload zu groß. Limit php.ini:",
    "admin__files__mgnt__delete_selection" => "Auswahl löschen",
    "admin__files__mgnt__delete" => "Löschen",
    "admin__files__mgnt__header" => "Dateiverwaltung",
    "admin__files__mgnt__cancel" => "Abbrechen",
    "admin__files__mgnt__close" => "Schließen",
    "admin__files__mgnt__save" => "Speichern",
    "admin__files__mgnt__name" => "Name",
    "admin__files__mgnt__add" => "Hinzufügen",
];