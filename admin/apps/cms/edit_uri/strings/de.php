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
 * @description     Admin edit URI and languages URIs.
 */

// Language strings.
$strings = [
    "admin__cms__edit_uri__add_lang" => "Sprache hinzufügen",
    "admin__cms__edit_uri__remove_header" => "Sprache entfernen",
    "admin__cms__edit_uri__remove_info" => "Vorsicht beim entfernen von URIs. Wenn eine sprechende URI gelöscht wird, dann kann diese Seite über die direkte Eingabe der Adresse nicht mehr erreicht werden. Verlinkungen über die URI ID werden dann auf die URI der Standardsprache oder auf die globale URI weitergeleitet.",
    "admin__cms__edit_uri__info" => "Die Globalisierung in Verbindung mit mehrsprachigen sprechenden URIs ist ein mächtiges Tool in APPNETOS. Dies ermöglicht mit einfachen Mitteln eine mehrsprachige Seite zu erstellen. Für jede Seite kann, je nach eingestellter Sprache, der Inhalt, die sprechende URI, der Titel und das Favicon verändert werden. Mit der richtigen Verwendung wird eine hohe Bewertung bei Suchmaschinen erreicht. In einem Smarty View wird der Link mit [{\$render->getUrl(URI ID)}]. In PHP mit echo getUrl(URI ID). Die mehrsprachigen unterstützen die UTF8 Codierung. Somit kann die URI, mit wenigen Ausnahmen, auch in allen Sprachen erzeugt werden. Ist die englische URI my-uri und die deutsche URI meine-uri so wird die Seite in Englisch unter http://www.appnetos.com/my-uri und in Deutsch unter http://www.appnetos.com/meine-uri aufgerufen. Wenn mehrere URIs einer Seite den gleichen Inhalt haben dann sollte eine Canonical auf den Haupteintrag gesetzt werden. Dadurch erkennen Suchmaschinen mehrsprachige URIs mit demselben Inhalt und werden nicht abgestraft.",
    "admin__cms__edit_uri__add_info" => "Für jede URI kann, je nach eingestellter Sprache, die sprechende URI, der Titel, und das Favicon festgelegt werden. Für die Index URI kann die sprechende URI nicht definiert werden.  Wenn mehrere URIs einer Seite den gleichen Inhalt haben dann sollte eine Canonical auf den Haupteintrag gesetzt werden. Dadurch erkennen Suchmaschinen mehrsprachige URIs mit demselben Inhalt und werden nicht abgestraft.",
    "admin__cms__edit_uri__err_load" => "Inhalt kann nicht geladen werden",
    "admin__cms__edit_uri__no_lang" => "Keine weiteren Sprachen verfügbar",
    "admin__cms__edit_uri__err_add" => "Sprache kann nicht hinzugefügt werden",
    "admin__cms__edit_uri__add_exists" => "Es existiert bereits ein Eintrag mit dieser URI",
    "admin__cms__edit_uri__conf_add" => "Die Sprache wurde hinzugefügt",
    "admin__cms__edit_uri__not_exists" => "Die Sprache existiert nicht mehr",
    "admin__cms__edit_uri__err_remove" => "Der Spracheintrag konnte nicht entfernt werden",
    "admin__cms__edit_uri__conf_remove" => "Der Sprache wurde entfernt",
    "admin__cms__edit_uri__edit_header" => "Eintrag bearbeiten",
    "admin__cms__edit_uri__edit_info" => "Vorsicht beim Ändern einer URI. Wenn eine URI geändert wird, dann kann diese Seite über die direkte Eingabe der Adresse nicht mehr erreicht werden. Verlinkungen über die URI ID sind dadurch nicht beeinträchtigt.",
    "admin__cms__edit_uri__err_edit" => "Der Eintrag konnte nicht bearbeitet werden",
    "admin__cms__edit_uri__conf_edit" => "Der Eintrag wurde bearbeitet",
    "admin__cms__edit_uri__err" => "Der Eintrag kann nicht geladen werden",
    "admin__cms__edit_uri__err_no_uri" => "Keine URI eingegeben",
    "admin__cms__edit_uri__err_add_valid" => "Die URI ist nicht zulässig",
    "admin__cms__edit_uri__menu_header" => "URI bearbeiten",
    "admin__cms__edit_uri__menu_app_management" => "URI App Verwaltung",
    "admin__cms__edit_uri__menu_uri_management" => "URI Verwaltung",
    "admin__cms__edit_uri__no_languages" => "Keine Sprachen verfügbar",
    "admin__cms__edit_uri__remove" => "Entfernen",
    "admin__cms__edit_uri__edit" => "Bearbeiten",
    "admin__cms__edit_uri__id" => "URI ID",
    "admin__cms__edit_uri__properties" => "Eigenschaften",
    "admin__cms__edit_uri__views" => "Views",
    "admin__cms__edit_uri__apps" => "Apps",
    "admin__cms__edit_uri__languages" => "Sprachen",
    "admin__cms__edit_uri__language" => "Sprache",
    "admin__cms__edit_uri__title" => "Titel",
    "admin__cms__edit_uri__favicon" => "Favicon",
    "admin__cms__edit_uri__language_settings" => "Spracheinstellungen",
    "admin__cms__edit_uri__global" => "Global",
    "admin__cms__edit_uri__uri" => "URI",
    "admin__cms__edit_uri__canonical" => "Canonical ID",
    "admin__cms__edit_uri__no_canonical" => "Keine Canonical ID",
    "admin__cms__edit_uri__save" => "Speichern",
    "admin__cms__edit_uri__close" => "Schließen",
    "admin__cms__edit_uri__add" => "Hinzufügen",
    "admin__cms__edit_uri__home_info" => "Zur Startseite können keine Sprachen hinzugefügt werden",
    "admin__cms__edit_uri__home" => "Startseite",
    "admin__cms__edit_uri__meta_delete" => "Löschen",
    "admin__cms__edit_uri__clear" => "Zurücksetzen",
    "admin__cms__edit_uri__name" => "Namen",
    "admin__cms__edit_uri__content" => "Inhalt",
    "admin__cms__edit_uri__meta_title" => "Titel für Suchmaschinen. Maximal 70 Zeichen.",
    "admin__cms__edit_uri__meta_description" => "Beschreibung für Suchmaschinen. Maximal 320 Zeichen.",
    "admin__cms__edit_uri__meta_keywords" => "Schlüsselwörter für Suchmaschinen. Bis zu 5 Schlüsselwörter, die durch Leerzeichen getrennt sind.",
];
