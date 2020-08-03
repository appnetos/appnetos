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
 * @description     Application user groups. Groups can be used to define which users can view which areas.
 */

// Language strings.
$strings = [
    "admin__groups__application_groups__info" => "User groups control access to pages for users. Calling a page can be allowed or denied. If no pages are associated with a group, then each page can be accessed. If no allowed pages are assigned to a group, then all pages can be called, except those that are assigned denied. If no denied pages are assigned, then only pages that are allowed are assignable. It can also be allowed and denied access to pages at the same time. Developers should note that the URI ID is not returned if URIs are denied. Users who are not associated with a group have no restrictions.",
    "admin__groups__application_groups__menu_header" => "User groups",
    "admin__groups__application_groups__add_group" => "Add user group",
    "admin__groups__application_groups__search" => "Search",
    "admin__groups__application_groups__name_up" => "Name ascending",
    "admin__groups__application_groups__name_down" => "Name descending",
    "admin__groups__application_groups__id_up" => "ID ascending",
    "admin__groups__application_groups__id_down" => "ID descending",
    "admin__groups__application_groups__no_groups" => "No groups available",
    "admin__groups__application_groups__add" => "Add",
    "admin__groups__application_groups__name" => "Group name",
    "admin__groups__application_groups__close" => "Close",
    "admin__groups__application_groups__add_err_name_enter" => "Please enter a group name",
    "admin__groups__application_groups__add_err_name_exists" => "The group name is already assigned",
    "admin__groups__application_groups__add_conf" => "The group has been added",
    "admin__groups__application_groups__delete" => "Delete",
    "admin__groups__application_groups__group_id" => "Group ID",
    "admin__groups__application_groups__denied_uris" => "Denied URIs",
    "admin__groups__application_groups__granted_uris" => "Granted URIs",
    "admin__groups__application_groups__all" => "All",
    "admin__groups__application_groups__non" => "None",
    "admin__groups__application_groups__all_but_denied" => "All but denied",
    "admin__groups__application_groups__all_but_granted" => "All but granted",
    "admin__groups__application_groups__information" => "Information",
    "admin__groups__application_groups__no_uris" => "No URIs defined",
    "admin__groups__application_groups__edit_err" => "The group could not be edited",
    "admin__groups__application_groups__no_uris_err" => "No URIs selected",
    "admin__groups__application_groups__add_uri_conf" => "The URIs have been added",
    "admin__groups__application_groups__home" => "Home",
    "admin__groups__application_groups__remove_uri_conf" => "The URIs have been removed",
    "admin__groups__application_groups__remove" => "Remove",
    "admin__groups__application_groups__edit" => "Edit",
    "admin__groups__application_groups__edit_conf" => "The group has been edited",
    "admin__groups__application_groups__delete_header" => "Delete user group",
    "admin__groups__application_groups__delete_info" => "Be careful when deleting user groups. Deleted user groups cannot be recovered. User accounts associated with the group are associated with the default group. If no default group is defined, then these users have full access to any content.",
    "admin__groups__application_groups__delete_conf" => "The group has been deleted",
    "admin__groups__application_groups__as_default" => "As default",
    "admin__groups__application_groups__default" => "Default",
    "admin__groups__application_groups__delete_err" => "The group could not be deleted",
];