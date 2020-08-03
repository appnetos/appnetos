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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Language strings.
$strings = [
    "admin__apps__settings__css_conf" => "CSS wurde gespeichert",
    "admin__apps__settings__js_conf" => "JavaScript wurde gespeichert",
    "admin__apps__settings__css_err" => "CSS konnte nicht gespeichert werden",
    "admin__apps__settings__js_err" => "JavaScript konnte nicht gespeichert werden",
    "admin__apps__settings__warning" => "Vorsicht bei den Bearbeitungen. Änderungen können das App Verhalten nachhaltig verändern. Falsche Änderungen können die App, die Ausgabe und Funktionen zerstören.",
    "admin__apps__settings__css_info" => "Im CSS Editor kann die CSS Datei der App bearbeitet werden. Die CSS Datei der App wird im App-Verzeichnis gespeichert. Dieses CSS Datei wird automatisch mit der App geladen. Wenn eine App keine CSS Datei besitzt, so wird eine neue erstellt. Wenn der Cache aktiv ist, dann muss dieser geleert werden dass die Änderungen übernommen werden.",
    "admin__apps__settings__js_info" => "Im JavaScript Editor kann die JavaScript Datei der App bearbeitet werden. Die JavaScript Datei der App wird im App-Verzeichnis gespeichert. Dieses JavaScript Datei wird automatisch mit der App geladen. Wenn eine App keine JavaScript Datei besitzt, so wird eine neue erstellt. Wenn der Cache aktiv ist, dann muss dieser geleert werden dass die Änderungen übernommen werden.",
    "admin__apps__settings__data_err" => "Die Daten konnten nicht gespeichert werden",
    "admin__apps__settings__data_conf" => "Die Daten wurden gespeichert",
    "admin__apps__settings__size_err" => "Die Größe und Ausrichtung kann nicht verändert werden",
    "admin__apps__settings__size_conf" => "Die Größe und Ausrichtung wurde bearbeitet",
    "admin__apps__settings__header_col_xl" => "App Layout für Bildschirmbreite >1200px",
    "admin__apps__settings__header_col_lg" => "App Layout für Bildschirmbreite 992-1200px",
    "admin__apps__settings__header_col_md" => "App Layout für Bildschirmbreite 720-992px",
    "admin__apps__settings__header_col_sm" => "App Layout für Bildschirmbreite 576-720px",
    "admin__apps__settings__header_col" => "App Layout für Bildschirmbreite <576px",
    "admin__apps__settings__grid_css" => "Bootstrap Grid CSS",
    "admin__apps__settings__size_info" => "Für Container-Apps können die Größe und die Ausrichtung bearbeitet werden. Werden bei einer Container-Apps die Größe und Ausrichtung nicht angepasst, dann werden diese in voller Breite ausgegeben. APPNET OS verwendet Bootstrap und das Bootstrap Grid System für seine Container. Das Grid System verwendet 5 Gerätegrößen. Jede Größe wird dabei in 12 Teile geteilt. Die Größe und Ausrichtung von Container-Apps kann anhand dieser Teile definiert werden. Setzt man zwei Container-Apps untereinander und definiert die Größe mit jeweils 6 Teilen, dann werden die Apps in zwei gleich großen Teilen nebeneinander ausgegeben. Definiert man die erste App in einem Container mit 4 Teilen und die Zweite mit 8 Teilen, dann wird die rechte App doppelt so groß wie die linke App ausgegeben. Sind drei Apps in einem Container mit jeweils 4 Teilen definiert, dann werden die drei Apps nebeneinander, in gleicher Größe ausgegeben. Definiert man bei der ersten App 12 Teile und bei den folgenden zwei jeweils 6 Teile, dann wird die erste App in voller Breite ausgegeben und die folgenden zwei, darunter in mit jeweils der halben breite. Werden die Apps für jeder Gerätegröße richtig definiert, dann erhält man ein perfektes Responsive Design.",
    "admin__apps__settings__data_info" => "Wenn eine App einen Admin-Bereich hat, dann kann über die Einstellungen darauf zu gegriffen werden. Apps können auch, zusammen mit anderen Apps, in Container geladen werden. Dieses Apps nennt man Container-Apps. Bei Container-Apps können die Größe und Ausrichtung angepasst werden. Wenn zum Beispiel zwei Apps in einem Container geladen werden und die Größe, bei jeder App auf 50% eingestellt wird, dann werden diese nebeneinander ausgegeben. Dem Container können auch CSS Tags hinzugefügt werden. Dadurch ist es möglich das Aussehen eines Containers mit mehreren Apps zu beeinflussen. Vorsicht, wenn mehrere Apps in einem Container geladen werden und bei mehreren Apps das Container CSS angepasst wird, dann werden all CSS Tags dem Container hinzugefügt. Mit App CSS können der einzelnen App in einem Container CSS Tags hinzugefügt werden. Im Expertenmodus kann sogar das CSS und JavaScript einer App bearbeitet werden. Dieser Modus muss in der config.inc.php freigeschaltet werden. Aber Vorsicht. Wenn das CSS oder JavaScript im Expertenmodus verändert wird können Apps oder sogar die ganze Seite verstümmelt oder nachhaltig zerstört werden.",
    "admin__apps__settings__menu_header" => "App Einstellungen",
    "admin__apps__settings__admin_area" => "Admin Bereich",
    "admin__apps__settings__description" => "Beschreibung",
    "admin__apps__settings__size_and_align" => "Größe und Ausrichtung",
    "admin__apps__settings__css_container_fluid" => "CSS container-fluid",
    "admin__apps__settings__css_container" => "CSS container",
    "admin__apps__settings__css_app" => "CSS App",
    "admin__apps__settings__edit_css" => "CSS bearbeiten",
    "admin__apps__settings__edit_js" => "JavaScript bearbeiten",
    "admin__apps__settings__management" => "App Verwaltung",
    "admin__apps__settings__app_data" => "App Daten",
    "admin__apps__settings__activate" => "Aktivieren",
    "admin__apps__settings__deactivate" => "Deaktivieren",
    "admin__apps__settings__activated" => "Aktiviert",
    "admin__apps__settings__deactivated" => "Deaktiviert",
    "admin__apps__settings__no_description" => "Keine Beschreibung",
    "admin__apps__settings__app_id" => "App ID",
    "admin__apps__settings__properties" => "Eigenschaften",
    "admin__apps__settings__frontend" => "Frontend",
    "admin__apps__settings__no_content" => "Kein Inhalt",
    "admin__apps__settings__static" => "Statisch",
    "admin__apps__settings__not_static" => "Nicht statisch",
    "admin__apps__settings__size" => "Größe und Ausrichtung",
    "admin__apps__settings__no_container_css" => "Kein container CSS",
    "admin__apps__settings__no_container_fluid_css" => "Kein container-fluid CSS",
    "admin__apps__settings__no_app_css" => "Kein App CSS",
    "admin__apps__settings__container_fluid" => "container-fluid",
    "admin__apps__settings__container" => "container",
    "admin__apps__settings__apps" => "Apps",
    "admin__apps__settings__save" => "Speichern",
    "admin__apps__settings__cache" => "App cache verwenden",
    "admin__apps__settings__js_cache" => "JavaScript Cache verwenden",
    "admin__apps__settings__css_cache" => "CSS Cache verwenden",
];