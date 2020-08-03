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
 * @description     Admin URI apps management.
 */

// Language strings.
$strings = [
    "admin__cms__manage_apps__conf_add" => "The app has been added",
    "admin__cms__manage_apps__err_add" => "The app could not be added",
    "admin__cms__manage_apps__err_remove" => "The app could not be removed",
    "admin__cms__manage_apps__conf_remove" => "The app has been removed",
    "admin__cms__manage_apps__err_move" => "The app could not be moved",
    "admin__cms__manage_apps__conf_move" => "The app has been moved",
    "admin__cms__manage_apps__add" => "Add app",
    "admin__cms__manage_apps__info" => "In APPNETOS, the content of URIs is emitted by apps. Each app is part of the page. Apps can also be available multiple times on a page. There are two different types of app. Standard apps and container apps. Standard apps are always issued individually among themselves. The width of a standard app is always 100%. A standard app is always issued under the previous apps. The following app will then be issued again under the standard app. Container apps are always issued with other container apps together in one container. For each container app, the size can be defined. If two adjacent container apps are defined, each with a width of 50%, they will be issued side by side. If three container apps are defined, each with a width of 50%, then two are issued side by side and one underneath. If the three container apps are defined as 33% width each, all three apps are issued side by side. The wide settings can be set for four display widths. This allows container apps to be arranged side by side in a large display and among themselves in a small display. The size of container apps can be defined in the Settings app.",
    "admin__cms__manage_apps__err" => "URI entry can not be loaded",
    "admin__cms__manage_apps__not_exists" => "This app no longer exists",
    "admin__cms__manage_apps__menu_header" => "URI app management",
    "admin__cms__manage_apps__edit_uri" => "Edit URI",
    "admin__cms__manage_apps__uri_management" => "URI management",
    "admin__cms__manage_apps__home" => "Home",
    "admin__cms__manage_apps__id" => "URI ID",
    "admin__cms__manage_apps__properties" => "Properties",
    "admin__cms__manage_apps__views" => "Views",
    "admin__cms__manage_apps__apps" => "Apps",
    "admin__cms__manage_apps__languages" => "Languages",
    "admin__cms__manage_apps__title" => "Title",
    "admin__cms__manage_apps__favicon" => "Favicon",
    "admin__cms__manage_apps__language_settings" => "Language",
    "admin__cms__manage_apps__global" => "Global",
    "admin__cms__manage_apps__uri_id" => "URI ID",
    "admin__cms__manage_apps__app_id" => "App ID",
    "admin__cms__manage_apps__activated" => "Activated",
    "admin__cms__manage_apps__deactivated" => "Deactivated",
    "admin__cms__manage_apps__no_description" => "No description",
    "admin__cms__manage_apps__close" => "Close",
    "admin__cms__manage_apps__no_content" => "No content",
    "admin__cms__manage_apps__frontend" => "Frontend",
    "admin__cms__manage_apps__admin_area" => "Admin area",
    "admin__cms__manage_apps__static" => "Static",
    "admin__cms__manage_apps__not_static" => "Not static",
    "admin__cms__manage_apps__size" => "Size and orientation",
    "admin__cms__manage_apps__container_css" => "CSS container",
    "admin__cms__manage_apps__app_css" => "CSS App",
    "admin__cms__manage_apps__no_container_css" => "No container CSS",
    "admin__cms__manage_apps__no_app_css" => "No app CSS",
    "admin__cms__manage_apps__admin" => "Admin area",
    "admin__cms__manage_apps__css_container_fluid" => "CSS container-fluid",
    "admin__cms__manage_apps__no_container_fluid_css" => "No container-fluid CSS",
    "admin__cms__manage_apps__settings" => "Settings",
    "admin__cms__manage_apps__remove" => "Remove",
    "admin__cms__manage_apps__no_apps" => "No apps available",
];