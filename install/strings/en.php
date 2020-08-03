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
 * @description     install/strings/en.php ->    English language strings for APPNETOS installer.
 */

// Strings.
$strings = [
    "installer__language_header" => "Language during installation",
    "installer__language" => "Language",
    "installer__license" => "License",
    "installer__select" => "Select",
    "installer__install" => "Install",
    "installer__accept_checkbox" => "I accept the license terms",
    "installer__accept_error" => "You have to accept the license terms",
    "installer__accept" => "Accept",
    "installer__back" => "Back",
    "installer__version_error" => "Incopatible PHP version. APPNET OS needs PHP version 7.0.0 or higher.",
    "installer__pdo_error" => "PDO Database Expansion is not active. APPNET OS needs the PHP PDO database extension.",
    "installer__database" => "Database",
    "installer__db_type" => "Database type",
    "installer__db_host" => "Database host",
    "installer__db_port" => "Database port",
    "installer__db_name" => "Database name",
    "installer__db_user" => "Database user name",
    "installer__db_pass" => "Database password",
    "installer__next" => "Next",
    "installer__connect_error" => "Connection to the database failed.",
    "installer__prefix" => "Database prefix",
    "installer__prefix_info" => "APPNET OS uses a prefix for all database tables. This means that several installations run with a single database.",
    "installer__url" => "Url (without \"/index.php\" at the end.)",
    "installer__dir" => "Installation directory (without \"/index.php\" at the end.)",
    "installer__cache_dir" => "Cache directory (based on the installation directory)",
    "installer__tmp_dir" => "Temporary directory (based on the installation directory)",
    "installer__log_dir" => "Log file directory (ausgehend vom Instalations-Verzeichnis)",
    "installer__compile_dir" => "Compile directory (ausgehend vom Instalations-Verzeichnis)",
    "installer__config_dir" => "Config directory (ausgehend vom Instalations-Verzeichnis)",
    "installer__extend" => "Extended settings",
    "installer__basic_settings" => "Basic settings",
    "installer__prefix_error" => "Please enter a prefix.",
    "installer__prefix_error_1" => "The prefix have to contain 3 lower case letters (a-z).",
    "installer__prefix_error_2" => "The database prefix is already in use.",
    "installer__system_warning" => "Changes to these settings cannot be verified and can cause errors. These settings can be adjusted later in the file \"confic.inc.php\".",
    "installer__directory" => "Installation and directory settings",
    "installer__developer" => "Developer settings",
    "installer__cache" => "Cache settings",
    "installer__app_cache" => "App cache",
    "installer__file_cache" => "File cache",
    "installer__js_cache" => "JavaScript cache",
    "installer__css_cache" => "CSS cache",
    "installer__cache_expire" => "App cache expiration time in seconds",
    "installer__error_count" => "Number of false logins until users are blocked",
    "installer__minify" => "Minify CSS ans JavaScript",
    "installer__expert" => "Admin section expert mode",
    "installer__cookie_lock" => "Use APPNET OS cookie blocker",
    "installer__user" => "User (Administrator)",
    "installer__pass" => "Password",
    "installer__pass_2" => "Repeat password",
    "installer__mail" => "Email address",
    "installer__user_name" => "User name",
    "installer__user_min" => "Minimal user verification (Check only if a username has been entered)",
    "installer__pass_min" => "Minimal password verification (Check only if a password has been entered)",
    "installer__mail_min" => "Minimal email verification (Check only if a email address has been entered)",
    "installer__err_user_enter" => "Please enter a username.",
    "installer__err_user_valid" => "The username is not allowed.",
    "installer__err_user_exists" => "The username has already been assigned.",
    "installer__err_pass_enter" => "Please enter a password.",
    "installer__err_pass_compare" => "The password and password repetition are not identical.",
    "installer__err_pass_valid" => "The password is not allowed.",
    "installer__err_pass_usable" => "The password is cannot be used.",
    "installer__err_mail_enter" => "Please enter a email address.",
    "installer__err_mail_valid" => "The email address is not allowed.",
    "installer__install_header" => "Install",
    "installer__install_text" => "APPNET OS is ready to install.",
    "installer__install_end" => "APPNET OS installation completed. You can now log in to the admin section.",
    "installer__directory_cache" => "String cache.",
    "installer__string_cache" => "Directory cache",
    "installer__permissions" => "Permissions",
    "installer__permissions_info" => "APPNET OS can not access the file system. It is imperative that the APPNET OS can access the file system. Please grant APPNET OS permissions to read, write and execute in the APPNET OS directory with all sub directories and try again.",
    "installer__err_access" => "Access Denied",
    "installer__try_again" => "Try again",
    "installer__languages" => "Admin area Languages",
    "installer__languages_info" => "The APPNET OS admin area supported languages",
    "installer__languages_global" => "Global (English) (translated by xtrose Media Studio)",
    "installer__languages_de" => "German (deutsch) (translated by xtrose Media Studio)",
    "installer__languages_en" => "English (english) (translated by xtrose Media Studio)",
    "installer__languages_es" => "Spanish (español) (machine translated)",
    "installer__languages_fr" => "French (français) (machine translated)",
    "installer__languages_it" => "Italian (italiano) (machine translated)",
    "installer__languages_ru" => "Russian (русский) (machine translated)",
    "installer__additional" => "Extended license",
    "installer__security_settings" => "Security Settings",
    "installer__pass_expire" => "Time until the link to reset the password expires in seconds",
    "installer__groups_application" => "Deactivate application section groups",
    "installer__groups_admin" => "Disable administration section groups",
    "installer__authenticator_lifetime" => "Time until the user logs off in seconds when they save the credentials",
    "installer__session_application" => "Application section Session time in seconds",
    "installer__session_admin" => "Administration section session time in seconds",
    "installer__compression" => "Compression",
    "installer__html_compression" => "Compress HTML source code",
    "installer__debug" => "Debug Mode",
];