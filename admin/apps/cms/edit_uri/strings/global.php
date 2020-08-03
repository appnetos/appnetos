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
 * @description     Admin edit URI and languages URIs.
 */

// Language strings.
$strings = [
    "admin__cms__edit_uri__add_lang" => "Add language",
    "admin__cms__edit_uri__remove_header" => "Remove language",
    "admin__cms__edit_uri__remove_info" => "Be careful when removing URIs. If a talking URI is deleted, then this page can no longer be reached by entering the address directly. Links via the URI ID are then forwarded to the URI of the default language or to the global URI.",
    "admin__cms__edit_uri__info" => "Globalization combined with multilingual speaking URIs is a powerful tool in APPNETOS. This allows you to create a multilingual page using simple means. For each page, depending on the language you set, the content, the talking URI, the title and the Favicon can be changed. With the right use, a high rating is achieved in search engines. In a Smarty View, the link is associated with [{\$render-> getUrl (URI ID)}]. In PHP with echo getUrl(URI ID). The multilingual support UTF8 coding. Thus, with a few exceptions, the URI can also be produced in all languages. If the English URI my-uri and the German URI meine-uri, the page is called in English under http://www.appnetos.com/my-uri and in German under http://www.appnetos.com/meine-uri. If multiple URIs of a page have the same content then a canonical should be placed on the main entry. As a result, search engines detect multilingual URIs with the same content and are not punished.",
    "admin__cms__edit_uri__add_info" => "For each URI, the speaking URI, the title, and the Favicon can be defined, depending on the language you set. For the URI index, the talking URI cannot be defined. If multiple URIs of a page have the same content then a canonical should be placed on the main entry. As a result, search engines detect multilingual URIs with the same content and are not punished.",
    "admin__cms__edit_uri__err_load" => "Unable to load content",
    "admin__cms__edit_uri__no_lang" => "No other languages available",
    "admin__cms__edit_uri__err_add" => "Language cannot be added",
    "admin__cms__edit_uri__add_exists" => "There already exists an entry with this URI",
    "admin__cms__edit_uri__conf_add" => "The language has been added",
    "admin__cms__edit_uri__not_exists" => "The language no longer exists",
    "admin__cms__edit_uri__err_remove" => "The language entry could not be removed",
    "admin__cms__edit_uri__conf_remove" => "The language entry has been removed",
    "admin__cms__edit_uri__edit_header" => "Edit entry",
    "admin__cms__edit_uri__edit_info" => "Be careful when changing an URI. If an URI is changed, then this page can no longer be reached by entering the address directly. Links to the URI ID are not affected.",
    "admin__cms__edit_uri__err" => "Entry can not be loaded",
    "admin__cms__edit_uri__err_edit" => "The entry could not be edited",
    "admin__cms__edit_uri__conf_edit" => "The entry has been edited",
    "admin__cms__edit_uri__err_no_uri" => "No URI entered",
    "admin__cms__edit_uri__err_add_valid" => "The URL is not allowed",
    "admin__cms__edit_uri__menu_header" => "Edit URI",
    "admin__cms__edit_uri__menu_app_management" => "URI app vanagement",
    "admin__cms__edit_uri__menu_uri_management" => "URI management",
    "admin__cms__edit_uri__no_languages" => "No languages available",
    "admin__cms__edit_uri__remove" => "Remove",
    "admin__cms__edit_uri__edit" => "Edit",
    "admin__cms__edit_uri__id" => "URI ID",
    "admin__cms__edit_uri__properties" => "Properties",
    "admin__cms__edit_uri__views" => "Views",
    "admin__cms__edit_uri__apps" => "Apps",
    "admin__cms__edit_uri__languages" => "Languages",
    "admin__cms__edit_uri__language" => "Language",
    "admin__cms__edit_uri__title" => "Title",
    "admin__cms__edit_uri__favicon" => "Favicon",
    "admin__cms__edit_uri__language_settings" => "Language",
    "admin__cms__edit_uri__global" => "Global",
    "admin__cms__edit_uri__uri" => "Uri",
    "admin__cms__edit_uri__canonical" => "Canonical ID",
    "admin__cms__edit_uri__no_canonical" => "No Canonical ID",
    "admin__cms__edit_uri__save" => "Save",
    "admin__cms__edit_uri__close" => "Close",
    "admin__cms__edit_uri__add" => "Add",
    "admin__cms__edit_uri__home_info" => "Languages cannot be added to the home page",
    "admin__cms__edit_uri__home" => "Home",
    "admin__cms__edit_uri__meta_delete" => "Delete",
    "admin__cms__edit_uri__clear" => "Clear",
    "admin__cms__edit_uri__name" => "Name",
    "admin__cms__edit_uri__content" => "Content",
    "admin__cms__edit_uri__meta_title" => "Title for search engines. Maximum 70 characters.",
    "admin__cms__edit_uri__meta_description" => "Description for search engines. Maximum 320 characters.",
    "admin__cms__edit_uri__meta_keywords" => "Keywords for search engines. Up to 5 keywords separated by space.",
];