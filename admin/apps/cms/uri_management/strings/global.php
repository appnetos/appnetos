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
 * @description     Admin URI management to add and delete URIs.
 */

// Language strings.
$strings = [
    "admin__cms__uri_management__add" => "Add URI",
    "admin__cms__uri_management__info" => "An URI is the sub page address of a website. The URI is attached to the end of the URL defined in the config.inc.php. Together, they form the URL with which the page can be accessed. APPNET OS supports multilingual speaking URIs. This is a powerful tool. This allows a page URI to be defined in multiple languages. If links in the views are accessed via the URI ID, then the URI will be opened in appropriate language. In a Smarty View, the link is associated with [{\$render-> getUrl (URI ID)}]. In PHP with echo \$render->getUrl(URI ID). The multilingual support UTF8 coding. Thus, with a few exceptions, the URI can also be produced in all languages. If multiple URIs of a page have the same content then a canonical should be placed on the main entry. As a result, search engines detect multilingual URIs with the same content and are not punished. It also gives you the ability to define your own title and favicon for each page. If these are not defined, then the Favicon is used from the language settings. Newly added URIs are always global. Edit languages to the URI can be added to the URI. Managing apps can define the content.",
    "admin__cms__uri_management__button_apps" => "Manage apps",
    "admin__cms__uri_management__add_info" => "Here, the website can be expanded with additional sub pages. If the URI is empty, a link to the index page is created. URIs must be created without the URL defined by the config.inc.php. URIs do not start with / one beginning. URIs may not contain the following characters ;/?:@=&'\\\"<>#%{}|\\^~[]`. Each URI may exist only once.",
    "admin__cms__uri_management__err_add" => "The entry could not be created",
    "admin__cms__uri_management__err_add_valid" => "The URL is not allowed",
    "admin__cms__uri_management__err_add_favicon" => "File path to favicon is not allowed",
    "admin__cms__uri_management__err_add_exists" => "There is already an entry with this URI",
    "admin__cms__uri_management__conf_add" => "The URI has been added",
    "admin__cms__uri_management__delete_header" => "Delete URI",
    "admin__cms__uri_management__delete_info" => "Be careful when deleting URIs. By deleting an URI, the page is no longer available. The configuration of the page is irrevocably lost.",
    "admin__cms__uri_management__err_delete" => "The entry could not be deleted",
    "admin__cms__uri_management__conf_delete" => "The entry has been deleted",
    "admin__cms__uri_management__edit_seo" => "Edit URI",
    "admin__cms__uri_management__menu_header" => "URI management",
    "admin__cms__uri_management__search" => "Search",
    "admin__cms__uri_management__no_uris" => "No URIs available",
    "admin__cms__uri_management__home" => "Home",
    "admin__cms__uri_management__delete" => "Delete",
    "admin__cms__uri_management__uri_id" => "URI ID",
    "admin__cms__uri_management__properties" => "Properties",
    "admin__cms__uri_management__views" => "Views",
    "admin__cms__uri_management__apps" => "Apps",
    "admin__cms__uri_management__languages" => "Languages",
    "admin__cms__uri_management__title" => "Title",
    "admin__cms__uri_management__language_settings" => "Language",
    "admin__cms__uri_management__favicon" => "Favicon",
    "admin__cms__uri_management__uri" => "URI",
    "admin__cms__uri_management__button_add" => "Add",
    "admin__cms__uri_management__close" => "Close",
    "admin__cms__uri_management__id_up" => "ID ascending",
    "admin__cms__uri_management__id_down" => "ID descending",
    "admin__cms__uri_management__uri_up" => "URI ascending",
    "admin__cms__uri_management__uri_down" => "URI descending",
    "admin__cms__uri_management__title_up" => "Title ascending",
    "admin__cms__uri_management__title_down" => "Title descending",
];