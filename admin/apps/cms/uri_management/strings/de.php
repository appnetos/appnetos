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
 * @description     Admin URI management to add and delete URIs.
 */

// Language strings.
$strings = [
    "admin__cms__uri_management__add" => "URI hinzufügen",
    "admin__cms__uri_management__info" => "Eine URI ist die Adresse einer Unterseite einer Webseite. Die URI wird an das Ende der URL, welche in der config.inc.php definiert ist angefügt. Zusammen bilden sie die URL, mit welcher die Seite aufrufbar ist. APPNET OS unterstützt mehrsprachige sprechende URIs. Dies ist ein mächtiges Tool. Dadurch kann die URI einer Seite in mehreren Sprachen definiert werden. Wenn Links in den Views über die URI ID aufgerufen werden, dann wird die URI in entsprechender Sprache geöffnet. In einem Smarty View wird der Link mit [{\$render->getUrl(URI ID)}]. In PHP mit echo \$render->getUrl(URI ID). Die mehrsprachigen unterstützen die UTF8 Codierung. Somit kann die URI, mit wenigen Ausnahmen, auch in allen Sprachen erzeugt werden. Wenn mehrere URIs einer Seite den gleichen Inhalt haben dann sollte eine Canonical auf den Haupteintrag gesetzt werden. Dadurch erkennen Suchmaschinen mehrsprachige URIs mit demselben Inhalt und werden nicht abgestraft. Es gib auch die Möglichkeit für jeder Seite einen eigenen Titel und ein eigenes Favicon zu definieren. Wenn diese nicht definiert sind, dann wird das Favicon aus den Spracheinstellungen verwendet. Neu hinzugefügte URIs sind immer global. Unter URI bearbeiten können der URI Sprachen hinzugefügt werden. Unter Apps verwalten kann der Inhalt definiert werden.",
    "admin__cms__uri_management__button_apps" => "Apps verwalten",
    "admin__cms__uri_management__add_info" => "Hier kann die Webseite mit weiteren Unterseiten erweitert werden. Wenn die URI leer ist wird ein Link zur Index Seite erstellt. URIs müssen ohne die URL, welche unter der config.inc.php definiert ist erstellt werden. URIs dürfen nicht mit einem / beginnen. URIs dürfen folgende Zeichen nicht enthalten ;/?:@=&'\\\"<>#%{}|\\^~[]`. Jede URI darf nur ein mal existieren.",
    "admin__cms__uri_management__err_add" => "Der Eintrag konnte nicht erstellt werden",
    "admin__cms__uri_management__err_add_valid" => "Die URI ist nicht zulässig",
    "admin__cms__uri_management__err_add_favicon" => "Dateipfad zum Favicon ist nicht zulässig",
    "admin__cms__uri_management__err_add_exists" => "Es es besteht bereits ein Eintrag mit dieser URI",
    "admin__cms__uri_management__conf_add" => "Die URI wurde hinzugefügt",
    "admin__cms__uri_management__delete_header" => "URI löschen",
    "admin__cms__uri_management__delete_info" => "Vorsicht beim Löschen von URIs. Durch das Löschen einer URI ist die Seite nicht mehr verfügbar. Die Konfiguration der Seite geht unwiderruflich verloren.",
    "admin__cms__uri_management__err_delete" => "Der Eintrag konnte nicht gelöscht werden",
    "admin__cms__uri_management__conf_delete" => "Der Eintrag wurde gelöscht",
    "admin__cms__uri_management__edit_seo" => "URI bearbeiten",
    "admin__cms__uri_management__menu_header" => "URI-Verwaltung",
    "admin__cms__uri_management__search" => "Suche",
    "admin__cms__uri_management__no_uris" => "Keine URIs vorhanden",
    "admin__cms__uri_management__home" => "Startseite",
    "admin__cms__uri_management__delete" => "Löschen",
    "admin__cms__uri_management__uri_id" => "URI ID",
    "admin__cms__uri_management__properties" => "Eigenschaften",
    "admin__cms__uri_management__views" => "Views",
    "admin__cms__uri_management__apps" => "Apps",
    "admin__cms__uri_management__languages" => "Sprachen",
    "admin__cms__uri_management__title" => "Titel",
    "admin__cms__uri_management__language_settings" => "Spracheinstellungen",
    "admin__cms__uri_management__favicon" => "Favicon",
    "admin__cms__uri_management__uri" => "URI",
    "admin__cms__uri_management__button_add" => "Hinzufügen",
    "admin__cms__uri_management__close" => "Schließen",
    "admin__cms__uri_management__id_up" => "ID aufsteigend",
    "admin__cms__uri_management__id_down" => "ID absteigend",
    "admin__cms__uri_management__uri_up" => "URI aufsteigend",
    "admin__cms__uri_management__uri_down" => "URI absteigend",
    "admin__cms__uri_management__title_up" => "Titel aufsteigend",
    "admin__cms__uri_management__title_down" => "Titel absteigend"
];