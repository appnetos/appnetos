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
    "admin__groups__application_groups__info" => "Benutzergruppen steuern den Zugriff auf Seiten für Benutzer. Das Aufrufen einer Seite kann erlaubt oder verweigert werden. Sind keine Seiten einer Gruppe zugeordnet, dann kann jede Seite aufgerufen werden. Sind einer Gruppe keine erlaubten Seiten zugeordnet, dann können alle Seiten aufgerufen werden, bis auf die welche verweigert zugeordnet sind. Sind keine verweigerten Seiten zugeordnet, dann sind nur Seiten aufrufbar welche erlaubt zugeordnet sind. Es kann auch gleichzeitig Zugriff auf Seiten erlaubt und verweigert werden. Entwickler sollten beachten, dass die URI ID bei verweigerten URIs nicht zurückgegeben wird. Benutzer die keiner Gruppe zugeordnet sind haben keine Einschränkungen.",
    "admin__groups__application_groups__menu_header" => "Benutzergruppen",
    "admin__groups__application_groups__add_group" => "Hinzufügen",
    "admin__groups__application_groups__search" => "Suche",
    "admin__groups__application_groups__name_up" => "Name aufsteigend",
    "admin__groups__application_groups__name_down" => "Name absteigend",
    "admin__groups__application_groups__id_up" => "ID aufsteigend",
    "admin__groups__application_groups__id_down" => "ID absteigend",
    "admin__groups__application_groups__no_groups" => "Keine Gruppen vorhanden",
    "admin__groups__application_groups__add" => "Hinzufügen",
    "admin__groups__application_groups__name" => "Gruppenname",
    "admin__groups__application_groups__close" => "Schließen",
    "admin__groups__application_groups__add_err_name_enter" => "Bitte geben Sie einen Gruppenname ein",
    "admin__groups__application_groups__add_err_name_exists" => "Der Gruppenname ist bereits vergeben",
    "admin__groups__application_groups__add_conf" => "Die Gruppe wurde hinzugefügt",
    "admin__groups__application_groups__delete" => "Löschen",
    "admin__groups__application_groups__group_id" => "Gruppen ID",
    "admin__groups__application_groups__denied_uris" => "Verweigerte URIs",
    "admin__groups__application_groups__granted_uris" => "Gewährte URIs",
    "admin__groups__application_groups__all" => "Alle",
    "admin__groups__application_groups__non" => "Keine",
    "admin__groups__application_groups__all_but_denied" => "Alle bis auf verweigerte",
    "admin__groups__application_groups__all_but_granted" => "Alle bis auf gewährte",
    "admin__groups__application_groups__information" => "Informationen",
    "admin__groups__application_groups__no_uris" => "Keine URIs zugeordnet",
    "admin__groups__application_groups__edit_err" => "Die Gruppe konnte nicht bearbeitet werden",
    "admin__groups__application_groups__no_uris_err" => "Keine URIs ausgewählt",
    "admin__groups__application_groups__add_uri_conf" => "Die URIs wurden hinzugefügt",
    "admin__groups__application_groups__home" => "Startseite",
    "admin__groups__application_groups__remove_uri_conf" => "Die URIs wurden entfernt",
    "admin__groups__application_groups__remove" => "Entfernen",
    "admin__groups__application_groups__edit" => "Bearbeiten",
    "admin__groups__application_groups__edit_conf" => "Die Gruppe wurde bearbeitet",
    "admin__groups__application_groups__delete_header" => "Benutzergruppe löschen",
    "admin__groups__application_groups__delete_info" => "Vorsicht beim löschen von Benutzergruppen. Gelöschte Benutzergruppen können nicht wiederhergestellt werden. Benutzerkonten die der Gruppe zugeordnet sind werden der Standardgruppe zugeordnet. Ist keine Standardgruppe definiert, dann haben diese Benuter vollen Zugriff auf jeden Inhalt.",
    "admin__groups__application_groups__delete_conf" => "Die Gruppe wurde gelöscht",
    "admin__groups__application_groups__as_default" => "Als Standard",
    "admin__groups__application_groups__default" => "Standard",
    "admin__groups__application_groups__delete_err" => "Die Gruppe konnte nicht gelöscht werden",
];