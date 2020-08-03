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
 * @description     Admin app overview and app management.
 */

// Language strings.
$strings = [
    "admin__apps__management__conf_deactivate" => "The app has been deactivated",
    "admin__apps__management__conf_activate" => "The app has been activated",
    "admin__apps__management__err_activate" => "The app could not been activated or deactivated",
    "admin__apps__management__conf_remove" => "The app has been removed",
    "admin__apps__management__err_remove" => "The app could not be removed",
    "admin__apps__management__info" => "APPNET OS uses apps to create web pages from them. App management lists all installed apps. The apps can be assigned to individual pages in SEO management. Static apps can also be set at the top and static apps at the bottom. These are then arranged in each page at the top or bottom. Apps can also include an admin area. The admin area can be accessed via the app settings. Events allow developers to assign specific actions to the apps. These events will be run under the appropriate event. This allows apps to install, duplicate, reset, remove and delete the app. There may also be events that run when you activate or deactivate.",
    "admin__apps__management__deactivate_header" => "Deactivate app",
    "admin__apps__management__deactivate_info" => "Disabled apps are not issued. The feature is useful when editing app content. No data is lost when apps are disabled and they can be reactivated at any time.",
    "admin__apps__management__remove_header" => "Remove app",
    "admin__apps__management__remove_info" => "Be careful when removing apps. The app is removed from the app database. The app directory and database table remain in place and must be removed manually. The data is not lost. However, apps with database tables are difficult to recover.",
    "admin__apps__management__delete_header" => "Delete app",
    "admin__apps__management__delete_info" => "Be careful when deleting apps. The app is removed from the app database and the app script is run to delete the app. All database tables of the app are deleted. The data cannot be recovered and will be lost forever.",
    "admin__apps__management__conf_delete" => "The app has been deleted",
    "admin__apps__management__err_delete" => "The app could not be deleted",
    "admin__apps__management__err_description" => "The description could not be changed",
    "admin__apps__management__conf_description" => "The description has been changed",
    "admin__apps__management__err_duplicate" => "The app could not be duplicated",
    "admin__apps__management__conf_duplicate" => "The app has been duplicated",
    "admin__apps__management__directory" => "Path to the app",
    "admin__apps__management__reset_header" => "Reset app",
    "admin__apps__management__reset_info" => "Be careful when resetting apps. Here, the app script is executed to reset. All database tables of the app are emptied. The data cannot be recovered and will be lost forever.",
    "admin__apps__management__err_reset" => "The app could not be reset",
    "admin__apps__management__conf_reset" => "The app has been reset",
    "admin__apps__management__description_info" => "Make multiple apps more recognizable by adding a description to them.",
    "admin__apps__management__edit_styles" => "Edit styles",
    "admin__apps__management__duplicate" => "Duplicate",
    "admin__apps__management__reset" => "Reset",
    "admin__apps__management__install" => "Install",
    "admin__apps__management__activate" => "Activate",
    "admin__apps__management__deactivate" => "Disable",
    "admin__apps__management__delete" => "Delete",
    "admin__apps__management__remove" => "Remove",
    "admin__apps__management__revert" => "Reset",
    "admin__apps__management__id_up" => "ID ascending",
    "admin__apps__management__id_down" => "ID descending",
    "admin__apps__management__name_up" => "Name ascending",
    "admin__apps__management__name_down" => "Name descending",
    "admin__apps__management__description_up" => "Description ascending",
    "admin__apps__management__description_down" => "Description descending",
    "admin__apps__management__description" => "Description",
    "admin__apps__management__settings" => "Settings",
    "admin__apps__management__search" => "Search",
    "admin__apps__management__menu_header" => "App management",
    "admin__apps__management__no_apps" => "No apps available",
    "admin__apps__management__events" => "Events",
    "admin__apps__management__no_events" => "No events",
    "admin__apps__management__admin" => "Admin area",
    "admin__apps__management__activated" => "Activate",
    "admin__apps__management__deactivated" => "Deactivate",
    "admin__apps__management__no_description" => "No description",
    "admin__apps__management__app_id" => "App ID",
    "admin__apps__management__properties" => "Properties",
    "admin__apps__management__license" => "License",
    "admin__apps__management__no_content" => "No content",
    "admin__apps__management__frontend" => "Frontend",
    "admin__apps__management__admin_area" => "Admin area",
    "admin__apps__management__static" => "Static",
    "admin__apps__management__not_static" => "Not static",
    "admin__apps__management__size" => "Size and orientation",
    "admin__apps__management__container_css" => "CSS Container",
    "admin__apps__management__app_css" => "CSS App",
    "admin__apps__management__no_container_css" => "No container CSS",
    "admin__apps__management__no_app_css" => "No app CSS",
    "admin__apps__management__no_store_license" => "No license information available",
    "admin__apps__management__no_store_description" => "No description available",
    "admin__apps__management__close" => "Close",
    "admin__apps__management__css_container_fluid" => "CSS container-fluid",
    "admin__apps__management__no_container_fluid_css" => "No container-fluid CSS",
    "admin__apps__management__version" => "Version",
];