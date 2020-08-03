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
    "admin__apps__management__conf_deactivate" => "Die App wurde deaktiviert",
    "admin__apps__management__conf_activate" => "Die App wurde aktiviert",
    "admin__apps__management__err_activate" => "Die App konnte nicht aktiviert oder deaktiviert werden",
    "admin__apps__management__conf_remove" => "Die App wurde entfernt",
    "admin__apps__management__err_remove" => "Die App konnte nicht entfernt werden",
    "admin__apps__management__info" => "APPNET OS verwendet Apps um Webseiten daraus zu erstellen. In der App-Verwaltung sind alle installierten Apps aufgelistet. Die Apps können in der SEO Verwaltung einzelnen Seiten zugeordnet werden können. Es können auch statische Apps oben und statische Apps unten festgelegt werden. Diese werden dann in jeder Seite oben oder unten angeordnet. Apps können auch einen Admin Bereich enthalten. Der Admin Bereich kann über die Einstellungen aufgerufen werden kann. Durch Events können Entwickler den Apps bestimmte Aktionen zuweisen. Diese Events werden unter dem entsprechenden Ereignis ausgeführt wird. Das ermöglicht Apps zu installieren, duplizieren, zurückzusetzten, entfernen und zu löschen. Es kann auch Events geben die beim Aktivieren oder Deaktivieren ausgeführt werden.",
    "admin__apps__management__deactivate_header" => "App deaktivieren",
    "admin__apps__management__deactivate_info" => "Deaktivierte Apps werden nicht ausgegeben. Die Funktion ist nützlich beim Bearbeiten von App Inhalten. Beim Deaktivieren von Apps gehen keine Daten verloren und sie können jederzeit wieder aktiviert werden.",
    "admin__apps__management__remove_header" => "App entfernen",
    "admin__apps__management__remove_info" => "Vorsicht beim Entfernen von Apps. Hierbei wird die App aus dem aus der App-Datenbank entfernt. Das App-Verzeichnis und die Datenbanktabelle bleiben bestehen und müssen manuell entfernt werden. Die Daten gehen nicht verloren. Dennoch können Apps mit Datenbank Tabellen nur schwer wiederhergestellt werden.",
    "admin__apps__management__delete_header" => "App löschen",
    "admin__apps__management__delete_info" => "Vorsicht beim Löschen von Apps. Hierbei wird die App aus der App-Datenbank entfernt und das App-Script zum Löschen der App ausgeführt. Hierbei werden alle Datenbanktabellen der App gelöscht. Die Daten lassen sich nicht wiederherstellen und gehen für immer verloren.",
    "admin__apps__management__conf_delete" => "Die App wurde gelöscht",
    "admin__apps__management__err_delete" => "Die App konnte nicht gelöscht werden",
    "admin__apps__management__err_description" => "Die Beschreibung konnte nicht geändert werden",
    "admin__apps__management__conf_description" => "Die Beschreibung wurde geändert",
    "admin__apps__management__err_duplicate" => "Die App konnte nicht dupliziert werden",
    "admin__apps__management__conf_duplicate" => "Die wurde dupliziert",
    "admin__apps__management__directory" => "Pfad zum App",
    "admin__apps__management__reset_header" => "App zurücksetzten",
    "admin__apps__management__reset_info" => "Vorsicht beim Zurücksetzten von Apps. Hierbei wird das App-Script zum zurücksetzen ausgeführt. Es werden alle Datenbanktabellen der App geleert. Die Daten lassen sich nicht wiederherstellen und gehen für immer verloren.",
    "admin__apps__management__err_reset" => "Die App konnte nicht zurückgesetzt werden",
    "admin__apps__management__conf_reset" => "Die wurde zurückgesetzt",
    "admin__apps__management__description_info" => "Machen Sie mehrfach verwendete Apps besser erkenntlich, in dem Sie Ihnen eine Beschreibung hinzufügen.",
    "admin__apps__management__edit_styles" => "Styles bearbeiten",
    "admin__apps__management__duplicate" => "Duplizieren",
    "admin__apps__management__reset" => "Zurücksetzen",
    "admin__apps__management__install" => "Installieren",
    "admin__apps__management__activate" => "Aktivieren",
    "admin__apps__management__deactivate" => "Deaktivieren",
    "admin__apps__management__delete" => "Löschen",
    "admin__apps__management__remove" => "Entfernen",
    "admin__apps__management__revert" => "Zurücksetzen",
    "admin__apps__management__id_up" => "ID aufsteigend",
    "admin__apps__management__id_down" => "ID absteigend",
    "admin__apps__management__name_up" => "Name aufsteigend",
    "admin__apps__management__name_down" => "Name absteigend",
    "admin__apps__management__description_up" => "Beschreibung aufsteigend",
    "admin__apps__management__description_down" => "Beschreibung absteigend",
    "admin__apps__management__description" => "Beschreibung",
    "admin__apps__management__settings" => "Einstellungen",
    "admin__apps__management__search" => "Suche",
    "admin__apps__management__menu_header" => "App-Verwaltung",
    "admin__apps__management__no_apps" => "Keine Apps vorhanden",
    "admin__apps__management__events" => "Events",
    "admin__apps__management__no_events" => "Keine Events",
    "admin__apps__management__admin" => "Admin Bereich",
    "admin__apps__management__activated" => "Aktiviert",
    "admin__apps__management__deactivated" => "Deaktiviert",
    "admin__apps__management__no_description" => "Keine Beschreibung",
    "admin__apps__management__app_id" => "App ID",
    "admin__apps__management__properties" => "Eigenschaften",
    "admin__apps__management__license" => "Lizenz",
    "admin__apps__management__no_content" => "Kein Inhalt",
    "admin__apps__management__frontend" => "Frontend",
    "admin__apps__management__admin_area" => "Admin Bereich",
    "admin__apps__management__static" => "Statisch",
    "admin__apps__management__not_static" => "Nicht statisch",
    "admin__apps__management__size" => "Größe und Ausrichtung",
    "admin__apps__management__container_css" => "CSS container",
    "admin__apps__management__app_css" => "CSS App",
    "admin__apps__management__no_container_css" => "Kein Container CSS",
    "admin__apps__management__no_app_css" => "Kein App CSS",
    "admin__apps__management__no_store_license" => "Keine Lizenzinformationen vorhanden",
    "admin__apps__management__no_store_description" => "Keine Beschreibung vorhanden",
    "admin__apps__management__close" => "Schließen",
    "admin__apps__management__css_container_fluid" => "CSS container-fluid",
    "admin__apps__management__no_container_fluid_css" => "Kein container-fluid CSS",
    "admin__apps__management__version" => "Version",
];