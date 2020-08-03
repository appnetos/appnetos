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
 * @description     install/strings/de.php ->    German language strings for APPNETOS installer.
 */

// Strings.
$strings = [
    "installer__language_header" => "Sprache während der Installation",
    "installer__language" => "Sprache",
    "installer__license" => "Lizenz",
    "installer__select" => "Auswählen",
    "installer__install" => "Installieren",
    "installer__accept_checkbox" => "Ich akzeptiere ich die Lizenzbedingungen",
    "installer__accept_error" => "Sie müssen die Lizenzbedingungen akzeptieren",
    "installer__accept" => "Akzeptieren",
    "installer__back" => "Zurück",
    "installer__version_error" => "Inkopatible PHP Version. APPNET OS benötigt PHP Version 7.0.0 oder höher.",
    "installer__pdo_error" => "PDO Datenbank Erweiterung ist nicht aktiv. APPNET OS benötigt die PHP PDO Datenbank Erweiterung.",
    "installer__database" => "Datenbank",
    "installer__db_type" => "Datenbank Typ",
    "installer__db_host" => "Datenbank Host",
    "installer__db_port" => "Datenbank Port",
    "installer__db_name" => "Datenbank Name",
    "installer__db_user" => "Datenbank Benutzername",
    "installer__db_pass" => "Datenbank Passwort",
    "installer__next" => "Weiter",
    "installer__connect_error" => "Verbindung zur Datenbank fehlgeschlagen.",
    "installer__prefix" => "Datanbank Prefix",
    "installer__prefix_info" => "APPNET OS verwendet ein Prefix für alle Datenbank-Tabellen. Damit laufen mehrere Installationen mit einer einzelnen Datenbank.",
    "installer__url" => "Url (ohne \"/index.php\" am Ende)",
    "installer__dir" => "Installations-Verzeichnis (ohne \"/index.php\" am Ende)",
    "installer__cache_dir" => "Cache-Verzeichnis (ausgehend vom Installations-Verzeichnis)",
    "installer__tmp_dir" => "Temporäres-Verzeichnis (ausgehend vom Installations-Verzeichnis)",
    "installer__log_dir" => "Log-Datei-Verzeichnis (ausgehend vom Installations-Verzeichnis)",
    "installer__compile_dir" => "Compile-Verzeichnis (ausgehend vom Installations-Verzeichnis)",
    "installer__config_dir" => "Config-Verzeichnis (ausgehend vom Installations-Verzeichnis)",
    "installer__extend" => "Erweiterte Einstellungen",
    "installer__basic_settings" => "Grundeinstellungen",
    "installer__prefix_error" => "Bitte geben Sie ein Prefix ein.",
    "installer__prefix_error_1" => "Das Prefix muss 3 Kleinbuchstaben haben (a-z).",
    "installer__prefix_error_2" => "Das Datenbank-Prefix wird bereits verwendet.",
    "installer__system_warning" => "Änderungen an diesen Einstellungen könnne nich geprüft werden und können fehler verursachen. Diese Einstellnungen können später in der Datei \"confic.inc.php\" angepasst werden.",
    "installer__directory" => "Installations- und Verzeichnis-Einstellungen",
    "installer__developer" => "Entwickler-Einstellungen",
    "installer__cache" => "Cache-Einstellungen",
    "installer__app_cache" => "App Cache",
    "installer__file_cache" => "Datei Cache",
    "installer__js_cache" => "JavaScript Cache",
    "installer__css_cache" => "CSS Cache",
    "installer__cache_expire" => "App Cache Verfallszeit in Sekunden",
    "installer__error_count" => "Anzahl Falschanmeldungen bis Benutzer blockiert werden",
    "installer__minify" => "CSS und JavaScript minimieren",
    "installer__expert" => "Admin-Bereich Experten Modus",
    "installer__cookie_lock" => "APPNET OS Cookie-Blocker verwenden",
    "installer__user" => "Benutzer (Administrator)",
    "installer__pass" => "Passwort",
    "installer__pass_2" => "Passwort wiederholen",
    "installer__mail" => "Email Adresse",
    "installer__user_name" => "Benutzername",
    "installer__user_min" => "Minimale Benutzer Prüfung (Prüfe nur ob ein Benutzername eingegeben wurde)",
    "installer__pass_min" => "Minimale Passwort Prüfung (Prüfe nur ob ein Passwort eingegeben wurde)",
    "installer__mail_min" => "Minimale Email Prüfung (Prüfe nur ob eine Email Adresse eingegeben wurde)",
    "installer__err_user_enter" => "Bitte geben Sie einen Benutzername ein",
    "installer__err_user_valid" => "Der Benutzername ist nicht zulässig",
    "installer__err_pass_enter" => "Bitte geben Sie eine Passwort ein",
    "installer__err_pass_compare" => "Das Passwort und die Passwort Wiederholung sind nicht identisch",
    "installer__err_pass_valid" => "Das Passwort ist nicht zulässig",
    "installer__err_pass_usable" => "Das Passwort ist kann nicht verwendet werden",
    "installer__err_mail_enter" => "Bitte geben Sie eine Email Adresse ein",
    "installer__err_mail_valid" => "Die Email ist nicht zulässig",
    "installer__install_header" => "Installation",
    "installer__install_text" => "APPNET OS ist bereit zur installation.",
    "installer__install_end" => "APPNET OS Installation abgeschlossen. Sie können sich nun im Admin-Bereich anmelden.",
    "installer__directory_cache" => "String Cache.",
    "installer__string_cache" => "Verzeichnis Cache",
    "installer__permissions" => "Berechtigungen",
    "installer__permissions_info" => "APPNET OS kann nicht auf das Dateiensystem zugreifen. Es ist zwingend erforderlich das APPNET OS auf das Dateien System zugreifen kann. Bitte erteilen Sie APPNET OS die Berechtigungen für lesen, schreiben und ausführen im APPNET OS Hautpverzeichnis mit allen unterverzeichnissen und versuchen sie es erneut.",
    "installer__err_access" => "Zugriff verweigert",
    "installer__try_again" => "Erneut versuchen",
    "installer__languages" => "Admin-Bereich Sprachen",
    "installer__languages_info" => "Der APPNET OS Admin Bereich unterstützte Sprachen",
    "installer__languages_global" => "Global (Englisch) (übersetzt durch xtrose Media Studio)",
    "installer__languages_de" => "Deutsch (deutsch) (übersetzt durch xtrose Media Studio)",
    "installer__languages_en" => "Englisch (english) (übersetzt durch xtrose Media Studio)",
    "installer__languages_es" => "Spanisch (español) (maschinell übersetzt)",
    "installer__languages_fr" => "Französich (français) (maschinell übersetzt)",
    "installer__languages_it" => "Italienisch (italiano) (maschinell übersetzt)",
    "installer__languages_ru" => "Russisch (русский) (maschinell übersetzt)",
    "installer__additional" => "Erweiterte Lizenz",
    "installer__security_settings" => "Sicherheits-Einstellungen",
    "installer__pass_expire" => "Zeit bis der Link zum zurücksetzten des Passworts abläuft in Sekunden",
    "installer__groups_application" => "Applikations-Bereich Gruppen deaktivieren",
    "installer__groups_admin" => "Administrations-Bereich Gruppen deaktivieren",
    "installer__authenticator_lifetime" => "Zeit bis der Benutzer abgemeldet wird in Sekunden, wenn er die Anmeldedaten speichert",
    "installer__session_application" => "Applikations-Bereich Session Zeit in Sekunden",
    "installer__session_admin" => "Administrations-Bereich Session Zeit in Sekunden",
    "installer__compression" => "Komprimierung",
    "installer__html_compression" => "HTML Quelltext komprimieren",
    "installer__debug" => "Debug Modus",
];