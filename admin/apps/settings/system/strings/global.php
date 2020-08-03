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
    "admin__settings__system__info" => "The APPNET OS System settings are stored in the file config.ing.php, in the Main Directory. For Security Reasons, most of the Settings can only be changed directly in the file. Under Cache, the caching settings can be overwritten. This makes sense for the Development of Apps. Under Admin are Settings for the Admin Area.",
    "admin__settings__system__database" => "Database settings",
    "admin__settings__system__database_type" => "Database type",
    "admin__settings__system__database_host" => "Database host",
    "admin__settings__system__database_user" => "Database user name",
    "admin__settings__system__database_port" => "Database port",
    "admin__settings__system__database_charset" => "Database charset",
    "admin__settings__system__database_pass" => "Database password",
    "admin__settings__system__database_name" => "Database name",
    "admin__settings__system__system" => "System settings",
    "admin__settings__system__prefix" => "APPNET OS prefix",
    "admin__settings__system__url" => "System URL",
    "admin__settings__system__data_path" => "System data path",
    "admin__settings__system__directories" => "Directories",
    "admin__settings__system__cache_dir" => "Cache directory",
    "admin__settings__system__temp_dir" => "Temporary data directory",
    "admin__settings__system__log_dir" => "Log-File directory",
    "admin__settings__system__compile_dir" => "Smarty compile directory",
    "admin__settings__system__config_dir" => "Smarty config directory",
    "admin__settings__system__cache" => "Cache",
    "admin__settings__system__app_cache" => "App cache",
    "admin__settings__system__cache_expire" => "App cache expire time in seconds",
    "admin__settings__system__file_cache" => "File cache",
    "admin__settings__system__directory_cache" => "Directory cache",
    "admin__settings__system__string_cache" => "String cache",
    "admin__settings__system__js_cache" => "JavaScript cache",
    "admin__settings__system__css_cache" => "CSS cache",
    "admin__settings__system__minify" => "Minify JavaScript and CSS when cache is no active",
    "admin__settings__system__cookie_lock" => "APPNET OS cookie blocker",
    "admin__settings__system__expert_mode" => "Admin section expert mode",
    "admin__settings__system__debugging" => "Debugging",
    "admin__settings__system__debug_mode" => "Debug mode",
    "admin__settings__system__debug_ajax" => "AJAX Debug Mode",
    "admin__settings__system__user" => "User settings",
    "admin__settings__system__user_regex" => "User name validation regular expression",
    "admin__settings__system__pass_regex" => "Password validation regular expression",
    "admin__settings__system__user_error_count" => "Number of wrong sign ins before users are blocked",
    "admin__settings__system__files_dir" => "Accepted directories",
    "admin__settings__system__files_types" => "Accepted file formats",
    "admin__settings__system__max_size" => "File upload limit",
    "admin__settings__system__cache_info" => "APPNET OS uses a variety of caches to speed up the System. The Cache Settings are defined in the config.inc.php file, in the main directory and can be adjusted here. In Addition to developing or editing Pages, the caches should always be active. The app cache is also managed by the apps. Not all apps have the ability to cache their Content. The file cache saves the file history and the directory cache saves the history of the directories. As a result, not all files and directories of the apps need to be traversed. The string cache stores all strings that have already been loaded. The JavaScript and CSS Cache collects all files from active apps, minimizes them, saves them and puts a link in the header. To develop, the option of minimization can be disabled.",
    "admin__settings__system__admin_info" => "In the admin settings, the expert mode can be activated. In expert mode, it is possible to edit the JavaScript and CSS files of apps and change the caching behavior of apps. There is also the possibility to disable the information in the admin area.",
    "admin__settings__system__admin_expert_mode" => "Expert mode",
    "admin__settings__system__admin_show_info" => "Show information in admin section",
    "admin__settings__system__debug_info" => "This is where debugging and AJAX debugging can be activated. The debugging issues all the PHP error messages just on bottom of the Page. AJAX debugging issues the AJAX unique ID, which is required for AJAX requests.",
    "admin__settings__system__debug_debug" => "System Debugging",
    "admin__settings__system__debug_debug_ajax" => "AJAX Debugging",
    "admin__settings__system__menu_system" => "System settings",
    "admin__settings__system__menu_cache" => "Cache Settings",
    "admin__settings__system__menu_admin" => "Admin Settings",
    "admin__settings__system__menu_debug" => "Debugging Settings",
    "admin__settings__system__files" => "Files",
    "admin__settings__system__save" => "Save",
    "admin__settings__system__conf" => "The settings have been saved",
    "admin__settings__system__compressor" => "Compress HTML source code",
    "admin__settings__system__extend_info" => "APPNET OS allows each class to expand multiple times without changing the class itself, whether it's an app class or a core class. This allows apps to make adjustments to classes without changing the class itself.  With the class extension, individual functions can be changed. It is not necessary to recreate the complete class. Multiple extensions may result in errors in the wrong order. Here you can adjust the order of the extensions. Overrides that no longer exist can be removed.",
    "admin__settings__system__class_extends" => "Class Extensions",
    "admin__settings__system__class" => "Class",
    "admin__settings__system__extends" => "Extends",
    "admin__settings__system__extends_move_confirm" => "The extension has been moved",
    "admin__settings__system__extends_move_error" => "The extension could not be moved",
    "admin__settings__system__extends_remove_confirm" => "The extension has been removed",
    "admin__settings__system__extends_remove_error" => "The extension could not be removed",
    "admin__settings__system__extends_not_exists" => "The class does not exist",
    "admin__settings__system__remove" => "Remove",
    "admin__settings__system__remove_warning" => "Be careful when removing class extensions. Removing class extensions can cause problems. Please check before removing the class if the class no longer exists and whether the extension is no longer needed.",
    "admin__settings__system__close" => "Close",
    "admin__settings__system__activated" => "Activated",
    "admin__settings__system__deactivated" => "Deactivated",
    "admin__settings__system__activate" => "Activate",
    "admin__settings__system__deactivate" => "Deactivate",
    "admin__settings__system__extends_activate_error" => "Class extension could not be activated",
    "admin__settings__system__extends_activate_error_exists" => "The class extension could not be activated. One of the required classes does not exist.",
    "admin__settings__system__extends_deactivate_error" => "Class extension could not be deactivated",
    "admin__settings__system__extends_activate_confirm" => "Class extension has been activated",
    "admin__settings__system__extends_deactivate_confirm" => "Class extension has been deactivated",
    "admin__settings__system__no_extends" => "No class extensions available",
];