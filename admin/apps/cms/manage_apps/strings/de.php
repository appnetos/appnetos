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
    "admin__cms__manage_apps__conf_add" => "Die App wurde hinzugefügt",
    "admin__cms__manage_apps__err_add" => "Die App konnte nicht hinzugefügt werden",
    "admin__cms__manage_apps__err_remove" => "Die App konnte nicht entfernt werden",
    "admin__cms__manage_apps__conf_remove" => "Die App wurde entfernt",
    "admin__cms__manage_apps__err_move" => "Die App konnte nicht verschoben werden",
    "admin__cms__manage_apps__conf_move" => "Die App wurde verschoben",
    "admin__cms__manage_apps__add" => "App hinzufügen",
    "admin__cms__manage_apps__info" => "In APPNET OS wird der Inhalt von URIs durch Apps ausgegeben. Jeder App ist dabei ein Bauteil der Seite. Apps können auch mehrfach auf einer Seite vorhanden sein. Es gibt zwei unterschiedliche Arten von App. Standard Apps und Container Apps. Standard Apps werden immer einzeln untereinander ausgegeben. Die Breite einer Standard App ist immer 100%. Eine Standard App wird immer unter den vorherigen Apps ausgegeben. Die darauffolgende App wird dann wieder unter der Standard App ausgegeben. Container Apps werden immer mit anderen Container Apps zusammen in einem Container ausgegeben. Für jede Container App kann die Größe definiert werden. Werden zwei nebeneinander liegende Container Apps mit je 50% Breite definiert, dann werden diese nebeneinander ausgegeben. Werden drei Container Apps mit je 50% Breite definiert, dann werden zwei nebeneinander ausgegeben und einer darunter. Werden die drei Container Apps mit je 33% Breite definiert, dann werden alle drei Apps nebeneinander ausgegeben. Die breiten Einstellungen können für vier Display Breiten festgelegt werden. Das ermöglicht Container Apps in einem großen Display nebeneinander und in einem kleinen Display untereinander anzuordnen. Die Größe von Container Apps kann in den App Einstellungen definiert werden.",
    "admin__cms__manage_apps__err" => "URI kann nicht geladen werden",
    "admin__cms__manage_apps__not_exists" => "Diese App Existiert nicht mehr",
    "admin__cms__manage_apps__menu_header" => "URI App Verwaltung",
    "admin__cms__manage_apps__edit_uri" => "URI bearbeiten",
    "admin__cms__manage_apps__uri_management" => "URI Verwaltung",
    "admin__cms__manage_apps__home" => "Startseite",
    "admin__cms__manage_apps__id" => "URI ID",
    "admin__cms__manage_apps__properties" => "Eigenschaften",
    "admin__cms__manage_apps__views" => "Views",
    "admin__cms__manage_apps__apps" => "Apps",
    "admin__cms__manage_apps__languages" => "Sprachen",
    "admin__cms__manage_apps__title" => "Titel",
    "admin__cms__manage_apps__favicon" => "Favicon",
    "admin__cms__manage_apps__language_settings" => "Spracheinstellungen",
    "admin__cms__manage_apps__global" => "Global",
    "admin__cms__manage_apps__uri_id" => "URI ID",
    "admin__cms__manage_apps__app_id" => "App ID",
    "admin__cms__manage_apps__activated" => "Aktiviert",
    "admin__cms__manage_apps__deactivated" => "Deaktiviert",
    "admin__cms__manage_apps__no_description" => "Keine Beschreibung",
    "admin__cms__manage_apps__close" => "Schließen",
    "admin__cms__manage_apps__no_content" => "Kein Inhalt",
    "admin__cms__manage_apps__frontend" => "Frontend",
    "admin__cms__manage_apps__admin_area" => "Admin Bereich",
    "admin__cms__manage_apps__static" => "Statisch",
    "admin__cms__manage_apps__not_static" => "Nicht statisch",
    "admin__cms__manage_apps__size" => "Größe und Ausrichtung",
    "admin__cms__manage_apps__container_css" => "CSS container",
    "admin__cms__manage_apps__app_css" => "CSS App",
    "admin__cms__manage_apps__no_container_css" => "Kein Container CSS",
    "admin__cms__manage_apps__no_app_css" => "Kein App CSS",
    "admin__cms__manage_apps__admin" => "Admin Bereich",
    "admin__cms__manage_apps__css_container_fluid" => "CSS container-fluid",
    "admin__cms__manage_apps__no_container_fluid_css" => "Kein container-fluid CSS",
    "admin__cms__manage_apps__settings" => "Einstellungen",
    "admin__cms__manage_apps__remove" => "Entfernen",
    "admin__cms__manage_apps__no_apps" => "Keine Apps vorhanden",
];