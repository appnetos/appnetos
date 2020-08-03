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
 * @description     Admin language management.
 */

// Language strings.
$strings = [
    "admin__settings__manage_language__info" => "List of all languages used by APPNETOS. The languages selected here will be used. The language used by the user is defined by the browser, but can be changed by the language cookie.  The language is defined by a key and a sub-key. Apps language files are selected by this key. The language files of a app are stored in the app in the string directory. Each app has a global language file called the global.php. This is loaded whenever a requested language file cannot be loaded. If a language file with a sub-key is requested and does not exist, the language file of the main key is tried to load. If it does not exist, the set standard language will be loaded. If it also does not exist, the global language file will be loaded. The loading order of the language files in one example. en-US -> en -> Standard -> Global",
    "admin__settings__manage_language__remove" => "Remove language",
    "admin__settings__manage_language__remove_info" => "Be careful when removing the languages. If a language is removed, pages are no longer issued in that language. The content in the default is issued voice browsers with this language. No standard language is defined, then the global language is used.",
    "admin__settings__manage_language__err_add" => "The language could not be activated",
    "admin__settings__manage_language__err_remove" => "The language could not be disabled",
    "admin__settings__manage_language__conf_remove" => "The language has been deactivated",
    "admin__settings__manage_language__conf_add" => "The language has been activated",
    "admin__settings__manage_language__menu_header" => "Manage languages",
    "admin__settings__manage_language__search" => "Search",
    "admin__settings__manage_language__language_settings" => "Language",
    "admin__settings__manage_language__no_languages" => "No languages available",
    "admin__settings__manage_language__activate" => "Activate",
    "admin__settings__manage_language__deactivate" => "Deactivate",
    "admin__settings__manage_language__properties" => "Properties",
    "admin__settings__manage_language__default" => "Default",
    "admin__settings__manage_language__activated" => "Activated",
    "admin__settings__manage_language__close" => "Close",
];
