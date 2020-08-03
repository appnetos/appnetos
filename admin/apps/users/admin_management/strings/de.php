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
 * @description     Admin overview and management for admin users.
 */

// Language strings.
$strings = [
    "admin__users__admin_management__info" => "In der Administratorverwaltung können alle Informationen von Administratoren eingesehen werden. Administratoren können gesperrt und freigeschaltet werden. Es können Passwörter von Administratoren neu vergeben werden. Benutzernamen und Email Adressen können bei bedarf bearbeitet werden. Administratoren können nur manuell erstellt werden. Administratoren können Gruppen zugeordnet werden. Mit Gruppen werden rechte der einzelnen Bereiche definiert.",
    "admin__users__admin_management__registered_since" => "Registriert seit",
    "admin__users__admin_management__last_sign_in" => "Zuletzt angemeldet",
    "admin__users__admin_management__active" => "Aktiv",
    "admin__users__admin_management__not_activated" => "Nicht aktiviert",
    "admin__users__admin_management__sign_in_error" => "Anmelde Fehler",
    "admin__users__admin_management__locked" => "Gesperrt",
    "admin__users__admin_management__deleted" => "Gelöscht",
    "admin__users__admin_management__ip_first" => "IP Registrierung",
    "admin__users__admin_management__ip_last" => "IP letzter Anmeldung",
    "admin__users__admin_management__admin" => "Administrator",
    "admin__users__admin_management__permissions" => "Berechtigungen",
    "admin__users__admin_management__edit_header" => "Benutzerkonto bearbeiten",
    "admin__users__admin_management__edit_info" => "Vorsicht beim Bearbeiten von Benutzerkonten. Wenn Benutzername, Email Adresse oder Passwort eines Kontos verändert wird, dann kann der Benutzer sich nicht mehr mit seinen alten Daten anmelden.",
    "admin__users__admin_management__edit_pass" => "Leer lassen um nicht zu ändern",
    "admin__users__admin_management__edit_min_user" => "Minimale Benutzer Prüfung (Prüfe nur ob Benutzername bereits existiert)",
    "admin__users__admin_management__edit_min_pass" => "Minimale Passwort Prüfung (Prüfe nur ob ein Passwort eingegeben wurde)",
    "admin__users__admin_management__edit_err_user_exists" => "Der Benutzername ist bereits vergeben",
    "admin__users__admin_management__edit_err_user_valid" => "Der Benutzername ist nicht zulässig",
    "admin__users__admin_management__edit_err_user_usable" => "Der Benutzername kann nicht verwendet werden",
    "admin__users__admin_management__edit_err_mail_exists" => "Die Email Adresse wird bereits verwendet",
    "admin__users__admin_management__edit_err_mail_valid" => "Die Email Adresse ist nicht zulässig",
    "admin__users__admin_management__edit_err_pass_valid" => "Das Passwort ist nicht zulässig",
    "admin__users__admin_management__edit_err_pass_usable" => "Das Passwort kann nicht verwendet werden",
    "admin__users__admin_management__edit_conf" => "Das Administratorkonto wurde bearbeitet",
    "admin__users__admin_management__err_activate" => "Das Administratorkonto konnte nicht aktiviert werden",
    "admin__users__admin_management__conf_activate" => "Das Administratorkonto wurde aktiviert",
    "admin__users__admin_management__lock_header" => "Administratorkonto sperren",
    "admin__users__admin_management__lock_info" => "Vorsicht beim Sperren von Administratorkonten. Administratoren mit gesperrten Konten können sich nicht mehr anmelden.",
    "admin__users__admin_management__delete_header" => "Benutzerkonto löschen",
    "admin__users__admin_management__delete_info" => "Vorsicht beim Löschen von Administratorkonten. Administratorkonten werden immer vom System gelöscht. Sie können nicht wiederhergestellt werden.",
    "admin__users__admin_management__permissions_header" => "Berechtigungen",
    "admin__users__admin_management__permissions_info" => "Vorsicht beim vergeben von Administrator-Berechtigungen. Benutzer mit Administrator-Berechtigungen können sich im Admin-Bereich anmelden und die Seite mit ihren Inhalten verändern.",
    "admin__users__admin_management__conf_lock" => "Das Administratorkonto wurde gesperrt",
    "admin__users__admin_management__err_lock" => "Das Administratorkonto konnte nicht gesperrt werden",
    "admin__users__admin_management__conf_delete" => "Das Administratorkonto wurde gelöscht",
    "admin__users__admin_management__err_delete" => "Das Administratorkonto konnte nicht gelöscht werden",
    "admin__users__admin_management__conf_permissions" => "Die Berechtigungen wurden geändert",
    "admin__users__admin_management__err_permissions" => "Die Berechtigungen konnten nicht geändert werden",
    "admin__users__admin_management__del_from_system" => "Benutzer vom System löschen",
    "admin__users__admin_management__err_pass" => "Das Passwort ist falsch",
    "admin__users__admin_management__add_user" => "Administrator hinzufügen",
    "admin__users__admin_management__add_err_user_enter" => "Bitte geben Sie einen Benutzername ein",
    "admin__users__admin_management__add_err_user_valid" => "Der Benutzername ist nicht zulässig",
    "admin__users__admin_management__add_err_user_exists" => "Der Benutzername ist bereits vergeben",
    "admin__users__admin_management__add_err_user_usable" => "Der Benutzername ist kann nicht verwendet werden",
    "admin__users__admin_management__add_err_pass_enter" => "Bitte geben Sie eine Passwort ein",
    "admin__users__admin_management__add_err_pass_compare" => "Das Passwort und die Passwort Wiederholung sind nicht identisch",
    "admin__users__admin_management__add_err_pass_valid" => "Das Passwort ist nicht zulässig",
    "admin__users__admin_management__add_err_pass_usable" => "Das Passwort ist kann nicht verwendet werden",
    "admin__users__admin_management__add_err_mail_enter" => "Bitte geben Sie eine Email Adresse ein",
    "admin__users__admin_management__add_err_mail_valid" => "Die Email ist nicht zulässig",
    "admin__users__admin_management__add_err_mail_exists" => "Die Email Adresse wird bereits verwendet",
    "admin__users__admin_management__add_conf" => "Das Benutzerkonto wurde hinzugefügt",
    "admin__users__admin_management__add_err" => "Das Benutzerkonto konnte nicht hinzugefügt werden",
    "admin__users__admin_management__search_registered" => "Registriert",
    "admin__users__admin_management__search_active" => "Aktiv",
    "admin__users__admin_management__search_unactive" => "Unaktiv",
    "admin__users__admin_management__search_locked" => "Gesperrt",
    "admin__users__admin_management__search_deleted" => "Gelöscht",
    "admin__users__admin_management__search_all" => "Alle",
    "admin__users__admin_management__restore_conf" => "Das Benutzerkonto wurde wiederhergestellt",
    "admin__users__admin_management__restore_err" => "Das Benutzerkonto konnte nicht wiederhergestellt werden",
    "admin__users__admin_management__menu_header" => "Admin-Verwaltung",
    "admin__users__admin_management__search" => "Suche",
    "admin__users__admin_management__delete" => "Löschen",
    "admin__users__admin_management__user_id" => "Administrator ID",
    "admin__users__admin_management__properties" => "Eigenschaften",
    "admin__users__admin_management__edit" => "Bearbeiten",
    "admin__users__admin_management__information" => "Informationen",
    "admin__users__admin_management__user" => "Benutzername",
    "admin__users__admin_management__mail" => "E-Mail",
    "admin__users__admin_management__pass" => "Passwort",
    "admin__users__admin_management__save" => "Speichern",
    "admin__users__admin_management__pass_info" => "Leer lassen um nicht zu ändern",
    "admin__users__admin_management__ip_sign_up" => "IP bei Registierung",
    "admin__users__admin_management__ip_sign_in" => "IP bei letzer Anmeldung",
    "admin__users__admin_management__activate" => "Aktivieren",
    "admin__users__admin_management__deactivate" => "Deaktivieren",
    "admin__users__admin_management__lock" => "Sperren",
    "admin__users__admin_management__restore" => "Wiederherstellen",
    "admin__users__admin_management__account_type" => "Konto Typ",
    "admin__users__admin_management__standard" => "Standard",
    "admin__users__admin_management__sign_in_count" => "Anmeldungen",
    "admin__users__admin_management__no_users" => "Keine Administratoren vorhanden",
    "admin__users__admin_management__admin_button" => "Administrator",
    "admin__users__admin_management__search_admin" => "Administrator",
    "admin__users__admin_management__close" => "Schließen",
    "admin__users__admin_management__edit_err" => "Der Administrator konnte nicht bearbeitet werden",
    "admin__users__admin_management__add" => "Hinzufügen",
    "admin__users__admin_management_username_up" => "Benutzername aufsteigend",
    "admin__users__admin_management_username_down" => "Benutzername absteigend",
    "admin__users__admin_management__mail_up" => "Email Adresse aufsteigend",
    "admin__users__admin_management__mail_down" => "Email Adresse absteigend",
    "admin__users__admin_management__ts_first_up" => "Anmeldedatum aufsteigend",
    "admin__users__admin_management__ts_first_down" => "Anmeldedatum absteigend",
    "admin__users__admin_management__id_up" => "ID aufsteigend",
    "admin__users__admin_management__id_down" => "ID absteigend",
    "admin__users__admin_management__admin_group" => "Administratorgruppe",
    "admin__users__admin_management__group_id" => "Gruppen ID",
    "admin__users__admin_management__none" => "Keine",
    "admin__users__admin_management__edit_err_group_valid" => "Die Administratorgruppe existiert nicht",
    "admin__users__admin_management__image" => "Bild",
    "admin__users__admin_management__delete_image" => "Bild löschen",
    "admin__users__admin_management__edit_err_img_type" => "Falsches Bildformat",
    "admin__users__admin_management__edit_err_img_size" => "Die Bilddatei ist zu groß",
];