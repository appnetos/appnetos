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
 * @description     Admin overview and management for application users.
 */

// Language strings.
$strings = [
    "admin__users__application_management__info" => "All information from registered users can be viewed in User Management. User accounts can be locked and unlocked. Passwords can be reassigned by users. If email activation of accounts is active, then accounts that have not been activated can be activated or removed. User names and email addresses can be edited. Groups can be assigned to users. User groups define areas that users are allowed to view.",
    "admin__users__application_management__registered_since" => "Registered since",
    "admin__users__application_management__last_sign_in" => "Last sign in",
    "admin__users__application_management__active" => "Active",
    "admin__users__application_management__not_activated" => "Not activated",
    "admin__users__application_management__sign_in_error" => "Sign in error",
    "admin__users__application_management__locked" => "Locked",
    "admin__users__application_management__deleted" => "Deleted",
    "admin__users__application_management__ip_first" => "IP sign up",
    "admin__users__application_management__ip_last" => "IP last sign in",
    "admin__users__application_management__admin" => "Administrator",
    "admin__users__application_management__permissions" => "Permissions",
    "admin__users__application_management__edit_header" => "Edit user account",
    "admin__users__application_management__edit_info" => "Be careful when editing user accounts. If an account's username, email address, or password is changed, then the user can no longer log in with their old data.",
    "admin__users__application_management__edit_pass" => "Leave empty to avoid changing",
    "admin__users__application_management__edit_min_user" => "Minimal user verification (Check only if username already exists)",
    "admin__users__application_management__edit_min_pass" => "Minimal password verification (Check only if a password has been entered)",
    "admin__users__application_management__edit_err_user_exists" => "The username has already been assigned",
    "admin__users__application_management__edit_err_user_valid" => "The username is not allowed",
    "admin__users__application_management__edit_err_user_usable" => "The username cannot be used",
    "admin__users__application_management__edit_err_mail_exists" => "The email address is already in use",
    "admin__users__application_management__edit_err_mail_valid" => "The email address is not allowed",
    "admin__users__application_management__edit_err_pass_valid" => "The password is not allowed",
    "admin__users__application_management__edit_err_pass_usable" => "The password cannot be used",
    "admin__users__application_management__edit_conf" => "The user account has been edited",
    "admin__users__application_management__err_activate" => "The user account could not be activated",
    "admin__users__application_management__conf_activate" => "The user account has been activated",
    "admin__users__application_management__lock_header" => "Lock user account",
    "admin__users__application_management__lock_info" => "Be careful when locking user accounts. Users with suspended accounts will no longer be able to log in.",
    "admin__users__application_management__delete_header" => "Delete user account",
    "admin__users__application_management__delete_info" => "Be careful when deleting user accounts. If a user's account is deleted, the user will no longer be able to log in, but the user account can be reactivated. If a user is deleted from the system, then all of the user's data will be removed from the database and the account will not be recovered.",
    "admin__users__application_management__permissions_header" => "Permissions",
    "admin__users__application_management__permissions_info" => "Be careful when issuing administrator permissions. Users with administrator permissions can log into the admin section and change the page with their content.",
    "admin__users__application_management__conf_lock" => "The user account has been locked",
    "admin__users__application_management__err_lock" => "The user account could not be locked",
    "admin__users__application_management__conf_delete" => "The user account has been deleted",
    "admin__users__application_management__err_delete" => "The user account could not be deleted",
    "admin__users__application_management__conf_permissions" => "The permissions have been changed",
    "admin__users__application_management__err_permissions" => "The permissions could not be changed",
    "admin__users__application_management__del_from_system" => "Delete user from the system",
    "admin__users__application_management__err_pass" => "The password is wrong",
    "admin__users__application_management__add_user" => "Add user",
    "admin__users__application_management__add_err_user_enter" => "Please enter a username.",
    "admin__users__application_management__add_err_user_valid" => "The username is not allowed.",
    "admin__users__application_management__add_err_user_exists" => "The username has already been assigned.",
    "admin__users__application_management__add_err_user_usable" => "The username is cannot be used.",
    "admin__users__application_management__add_err_pass_enter" => "Please enter a password.",
    "admin__users__application_management__add_err_pass_compare" => "The password and password repetition are not identical.",
    "admin__users__application_management__add_err_pass_valid" => "The password is not allowed.",
    "admin__users__application_management__add_err_pass_usable" => "The password is cannot be used.",
    "admin__users__application_management__add_err_mail_enter" => "Please enter a email address.",
    "admin__users__application_management__add_err_mail_valid" => "The email address is not allowed.",
    "admin__users__application_management__add_err_mail_exists" => "The email address is already in use.",
    "admin__users__application_management__add_conf" => "The user account has been added",
    "admin__users__application_management__add_err" => "The user account could not be added",
    "admin__users__application_management__search_registered" => "Registered",
    "admin__users__application_management__search_active" => "Active",
    "admin__users__application_management__search_unactive" => "Unactive",
    "admin__users__application_management__search_locked" => "Locked",
    "admin__users__application_management__search_deleted" => "Deleted",
    "admin__users__application_management__search_all" => "All",
    "admin__users__application_management__restore_conf" => "The user account has been restored",
    "admin__users__application_management__restore_err" => "The user account could not be restored",
    "admin__users__application_management__menu_header" => "User management",
    "admin__users__application_management__search" => "Search",
    "admin__users__application_management__delete" => "Delete",
    "admin__users__application_management__user_id" => "User ID",
    "admin__users__application_management__properties" => "Properties",
    "admin__users__application_management__edit" => "Edit",
    "admin__users__application_management__information" => "Information",
    "admin__users__application_management__user" => "Username",
    "admin__users__application_management__mail" => "E‑mail",
    "admin__users__application_management__pass" => "Password",
    "admin__users__application_management__save" => "Save",
    "admin__users__application_management__pass_info" => "Leave blank to not change",
    "admin__users__application_management__ip_sign_up" => "IP when registering",
    "admin__users__application_management__ip_sign_in" => "IP at last registration",
    "admin__users__application_management__activate" => "Activate",
    "admin__users__application_management__deactivate" => "Deactivate",
    "admin__users__application_management__lock" => "Lock",
    "admin__users__application_management__restore" => "Restore",
    "admin__users__application_management__account_type" => "Account Type",
    "admin__users__application_management__standard" => "Standard",
    "admin__users__application_management__sign_in_count" => "Number of Sign in",
    "admin__users__application_management__no_users" => "No users present",
    "admin__users__application_management__admin_button" => "Administrator",
    "admin__users__application_management__search_admin" => "Administrator",
    "admin__users__application_management__close" => "Close",
    "admin__users__application_management__edit_err" => "The user could not be edited",
    "admin__users__application_management__add" => "Add",
    "admin__users__application_management_username_up" => "Username ascending",
    "admin__users__application_management_username_down" => "Username descending",
    "admin__users__application_management__mail_up" => "Email address ascending",
    "admin__users__application_management__mail_down" => "Email address descending",
    "admin__users__application_management__ts_first_up" => "Sign up date ascending",
    "admin__users__application_management__ts_first_down" => "Sign up data descending",
    "admin__users__application_management__id_up" => "ID ascending",
    "admin__users__application_management__id_down" => "ID descending",
    "admin__users__application_management__user_group" => "User group",
    "admin__users__application_management__group_id" => "Group ID",
    "admin__users__application_management__none" => "None",
    "admin__users__application_management__edit_err_group_valid" => "The user group does not exist",
    "admin__users__application_management__image" => "Image",
    "admin__users__application_management__delete_image" => "Delete image",
    "admin__users__application_management__edit_err_img_type" => "Incorrect image format",
    "admin__users__application_management__edit_err_img_size" => "The image file is too large",
];