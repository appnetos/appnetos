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
 * @description     Admin language management.
 */

// Language strings.
$strings = [
    "admin__settings__manage_language__info" => "Liste aller von APPNET OS verwendeter Sprachen. Die hier ausgewählten Sprachen werden verwendet. Die vom Benutzer verwendete Sprache wird durch den Browser definiert, kann aber durch das Language Cookie verändert werden.  Die Sprache wird durch einen Schlüssel und einen Unterschlüssel definiert. Sprachdateien von Apps werden durch diesen Schlüssel ausgewählt. Die Sprachdateien einer App werden im App im Verzeichnis strings gespeichert. Jede App hat eine Globale Sprachdatei mit dem Namen global.php. Diese wird immer dann geladen, wenn eine angeforderte Sprachdatei nicht geladen werden kann. Wird eine Sprachdatei mit einem Unterschlüssel angefordert und ist nicht vorhanden, so wird versucht die Sprachdatei des Hauptschlüssels zu laden. Ist diese auch nicht vorhanden, so wird die eingestellte Standard Sprache geladen. Wenn diese ebenfalls nicht vorhanden ist wird die globale Sprachdatei geladen. Die Ladereihenfolge der Sprachdateien in einem Beispiel. en-US -> en -> Standard -> Global",
    "admin__settings__manage_language__remove" => "Sprache entfernen",
    "admin__settings__manage_language__remove_info" => "Vorsicht beim Entfernen von Sprachen. Wenn eine Sprache entfernt wird, werden Seiten nicht mehr in dieser Sprache ausgegeben. Bei Browsern mit dieser eingestellten Sprache wird der Inhalt in der Standard Sprache ausgegeben. Ist keine Standard Sprache definiert, dann wird die Globale Sprache verwendet.",
    "admin__settings__manage_language__err_add" => "Die Sprache konnte nicht aktiviert werden",
    "admin__settings__manage_language__err_remove" => "Die Sprache konnte nicht deaktiviert werden",
    "admin__settings__manage_language__conf_remove" => "Die Sprache wurde deaktiviert",
    "admin__settings__manage_language__conf_add" => "Die Sprache wurde aktiviert",
    "admin__settings__manage_language__menu_header" => "Sprachen verwalten",
    "admin__settings__manage_language__search" => "Suche",
    "admin__settings__manage_language__language_settings" => "Spracheinstellungen",
    "admin__settings__manage_language__no_languages" => "Keine Sprachen vorhanden",
    "admin__settings__manage_language__activate" => "Aktivieren",
    "admin__settings__manage_language__deactivate" => "Deaktivieren",
    "admin__settings__manage_language__properties" => "Eigenschaften",
    "admin__settings__manage_language__default" => "Standard",
    "admin__settings__manage_language__activated" => "Aktiviert",
    "admin__settings__manage_language__close" => "Schließen",
];
