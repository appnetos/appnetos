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
    "admin__settings__system__info" => "Die APPNET OS Systemeinstellungen werden in der Datei config.ing.php, im Hauptverzeichnis gespeichert. Aus Sicherheitsgründen können die meisten der Einstellungen nur direkt in der Datei geändert werden. Unter Cache können die Caching Einstellungen überschrieben werden. Dies ist sinnvoll für die Entwicklung von Apps. Unter Admin sind Einstellungen für den Admin Bereich.",
    "admin__settings__system__database" => "Datenbankeinstellungen",
    "admin__settings__system__database_type" => "Datenbank Typ",
    "admin__settings__system__database_host" => "Datenbank Host",
    "admin__settings__system__database_user" => "Datenbank Benutzername",
    "admin__settings__system__database_port" => "Datenbank Port",
    "admin__settings__system__database_charset" => "Datenbank Charset",
    "admin__settings__system__database_pass" => "Datenbank Passwort",
    "admin__settings__system__database_name" => "Datenbank Name",
    "admin__settings__system__system" => "Systemeinstellungen",
    "admin__settings__system__prefix" => "APPNET OS Prefix",
    "admin__settings__system__url" => "System URL",
    "admin__settings__system__data_path" => "System Datenpfad",
    "admin__settings__system__directories" => "Verzeichnisse",
    "admin__settings__system__cache_dir" => "Cache Verzeichnis",
    "admin__settings__system__temp_dir" => "Temporäres Datenverzeichnis",
    "admin__settings__system__log_dir" => "Log-Datei Verzeichnis",
    "admin__settings__system__compile_dir" => "Smarty Compile Verzeichnis",
    "admin__settings__system__config_dir" => "Smarty Konfigurationsverzeichnis",
    "admin__settings__system__cache" => "Cache",
    "admin__settings__system__app_cache" => "App Cache",
    "admin__settings__system__cache_expire" => "App Cache Verfallszeit in Sekunden",
    "admin__settings__system__file_cache" => "Datei Cache",
    "admin__settings__system__directory_cache" => "Verzeichnis Cache",
    "admin__settings__system__string_cache" => "String Cache",
    "admin__settings__system__js_cache" => "JavaScript Cache",
    "admin__settings__system__css_cache" => "CSS Cache",
    "admin__settings__system__minify" => "JavaScript und CSS minimieren wenn Cache nicht aktiv ist",
    "admin__settings__system__cookie_lock" => "APPNET OS Cookie Blocker",
    "admin__settings__system__expert_mode" => "Admin Bereich Experten-Modus",
    "admin__settings__system__debugging" => "Debugging",
    "admin__settings__system__debug_mode" => "Debug Modus",
    "admin__settings__system__debug_ajax" => "AJAX Debug Modus",
    "admin__settings__system__user" => "Benutzereinstellungen",
    "admin__settings__system__user_regex" => "Benutzername Regular Expression Prüfungen",
    "admin__settings__system__pass_regex" => "Passwort Regular Expression Prüfungen",
    "admin__settings__system__user_error_count" => "Anzahl fehlerhafter Anmeldungen bevor Beutzer gesperrt wird",
    "admin__settings__system__files_dir" => "Akzeptierte Verzeichnisse",
    "admin__settings__system__files_types" => "Akzeptierte Dateiformate",
    "admin__settings__system__max_size" => "Datei Upload Limit",
    "admin__settings__system__cache_info" => "APPNET OS verwendet eine Vielzahl von Caches um das System zu beschleunigen. Die Cache Einstellungen werden in der config.inc.php Datei, im Hauptverzeichnis definiert und können hier angepasst werden. Außer zum entwickeln oder zum bearbeiten von Seiten sollten die Caches immer aktiv sein. Der App Cache wird zusätzlich von den Apps verwaltet. Nicht alle Apps haben die Möglichkeit ihren Inhalt zu cachen. Der Datei Cache speichert den Dateiverlauf und der Verzeichnis Cache den Verlauf der Verzeichnisse. Somit müssen nicht alle Dateien und Verzeichnisse der Apps durchlaufen werden. Der String Cache speichert alle bereits geladenen Strings. Der JavaScript und CSS Cache sammelt alle Dateien von aktiven Apps, minimiert diese, speichert sie und setzt einen Link im Header. Zum entwickeln kann die Option der Minimierung deaktiviert werden.",
    "admin__settings__system__admin_info" => "In den Admin Einstellungen kann der Experten Modus aktiviert werden. Im Experten Modus ist es möglich die JavaScript und CSS Dateien von Apps zu bearbeiten und das Caching verhalten von Anwendungen zu verändern. Es gibt auch die Möglichkeit die Informationen im Admin Bereich zu deaktivieren.",
    "admin__settings__system__admin_expert_mode" => "Experten Modus",
    "admin__settings__system__admin_show_info" => "Admin Bereich Informationen anzeigen",
    "admin__settings__system__debug_info" => "Hier kann das Debugging und das AJAX Debugging aktiviert werden. Das Debugging gibt alle PHP Fehlermeldungen direkt unterhalb der Seite aus. Beim AJAX Debugging wird die AJAX Unique ID ausgegeben, welche für AJAX anfragen erforderlich ist.",
    "admin__settings__system__debug_debug" => "System Debugging",
    "admin__settings__system__debug_debug_ajax" => "AJAX Debugging",
    "admin__settings__system__menu_system" => "Systemeinstellungen",
    "admin__settings__system__menu_cache" => "Cache Einstellungen",
    "admin__settings__system__menu_admin" => "Admin Einstellungen",
    "admin__settings__system__menu_debug" => "Debugging Einstellungen",
    "admin__settings__system__files" => "Dateien",
    "admin__settings__system__save" => "Speichern",
    "admin__settings__system__conf" => "Die Einstellungen wurden gespeichert",
    "admin__settings__system__compressor" => "HTML Quelltext komprimieren",
    "admin__settings__system__extend_info" => "APPNET OS ermöglicht jede Klasse mehrfach zu erweitern, ohne die Klasse selbst zu verändern, egal ob es sich dabei um eine App Klasse oder eine Core Klasse handelt. Somit können Apps Anpassungen an Klassen vornehmen ohne das die Klasse selbst dabei verändert wird.  Bei der Klassen-Erweiterung können einzelne Funktionen verändert werden. Es ist nicht nötig die Komplette Klasse neu zu erstellen. Bei mehrfach-Erweiterungen kann es, bei der Falschen Reihenfolge zu Fehlern kommen. Hier kann die Reihenfolge der Erweiterungen angepasst werden. Nicht mehr vorhandene Überschreibungen können entfernt werden. ",
    "admin__settings__system__class_extends" => "Klassen-Erweiterungen",
    "admin__settings__system__class" => "Klasse",
    "admin__settings__system__extends" => "Erweitert",
    "admin__settings__system__extends_move_confirm" => "Die Erweiterung wurde verschoben",
    "admin__settings__system__extends_move_error" => "Die Erweiterung konnte nicht verschoben werden",
    "admin__settings__system__extends_remove_confirm" => "Die Erweiterung wurde entfernt",
    "admin__settings__system__extends_remove_error" => "Die Erweiterung konnte nicht entfernt werden",
    "admin__settings__system__extends_not_exists" => "Die Klasse existiert nicht",
    "admin__settings__system__remove" => "Entfernen",
    "admin__settings__system__remove_warning" => "Vorsicht beim Entfernen von Klassen-Erweiterungen. Das Entfernen von Klassen-Erweiterungen kann zu Problemen führen. Bitte Prüfen Sie vor dem Entfernen ob die Klasse nicht mehr existiert und ob die Erweiterung nicht mehr benötigt wird.",
    "admin__settings__system__close" => "Schließen",
    "admin__settings__system__activated" => "Aktiviert",
    "admin__settings__system__deactivated" => "Deaktiviert",
    "admin__settings__system__activate" => "Aktivieren",
    "admin__settings__system__deactivate" => "Deaktivieren",
    "admin__settings__system__extends_activate_error" => "Die Klassen-Erweiterung konnte nicht aktiviert werden",
    "admin__settings__system__extends_activate_error_exists" => "Die Klassen-Erweiterung konnte nicht aktiviert werden. Eine der benötigten Klassen existiert nicht.",
    "admin__settings__system__extends_deactivate_error" => "Die Klassen-Erweiterung konnte nicht deaktiviert werden",
    "admin__settings__system__extends_activate_confirm" => "Die Klassen-Erweiterung wurde aktiviert",
    "admin__settings__system__extends_deactivate_confirm" => "Die Klassen-Erweiterung wurde deaktiviert",
    "admin__settings__system__no_extends" => "Keine Klassen-Erweiterungen vorhanden",
];