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
 * @description     Admin app creator to build apps.
 */

// Language strings.
$strings = [
    "admin__apps__create__dev_header" => "Entwickler App",
    "admin__apps__create__info" => "In diesem Bereich können neue Apps generiert werden. Es können mehrsprachige HTML Apps oder erweiterte Entwickler Apps generiert werden. HTML Apps sind Template basierend. Für jede eingestellte Sprache kann, im App Admin Bereich, ein eigenes HTML Template erstellt werden. Die App ist also sofort einsatzbereit. Entwickler Apps richten sich an Entwickler die erweiterte Apps für APPNET OS erstellen wollen. Entwickler Apps enthalten einen vordefinierten Application Bereich, sowie einen vordefinierten Admin Bereich und ein vordefiniertes Widget für den Admin Bereich. Für Entwickler Apps kann PHP oder Smarty als Template gewählt werden. Es können auch der App Cache und die Container Einstellungen, mit welchen er generiert werden soll gewählt werden. Entwickler können ihre Apps, im Marktplatz, auf <a href=\"https.www.appnetos.com\">www.appnetos.com</a> zum Verkauf anbieten. APPNET OS Nutzer können die Apps direkt vom Admin Bereich aus kaufen und installieren. ",
    "admin__apps__create__html_info" => "Der HTML App Builder erzeugt fertige, mehrsprachige, HTML Apps. HTML Apps verfügen über einen eigenen Admin Bereich. In diesem Bereich kann für jeder eingestellte Sprache ein eigenes Template erzeugt und bearbeitet werden. Durch den eingebauten wysiwyg und HTML Editor ist es ein leichtes den Code anzupassen. HTML Apps sind Smarty Template basierend. Hier kann gewöhnlicher HTML Code oder Smarty Code verwendet werden. HTML Apps sind Container Apps. Dadurch können Größe und Ausrichtung jederzeit, in den App Einstellungen verändert werden. Ein Container kann jederzeit beeinflusst werden. In den App Einstellungen können dem Container CSS Tags zugewiesen werden. Wenn in einer URI vor und nach der App die App Container End definiert wird, dann wird die App einzeln in einem Container ausgegeben. Einer Container App wird immer links und rechtes ein Padding hinzugefügt. Um dieses zu entfernen muss in den App Einstellungen, im Container CSS, die Klasse px-0 hinzugefügt werden. Im Expertenmodus kann sogar eine CSS und JavaScript Datei der App hinzugefügt werden. Dieser Modus muss in der config.inc.php freigeschaltet werden.",
    "admin__apps__create__dev_info" => "Entwickle Apps sind vorgefertigte Apps für Entwickler. Um eine Entwickler App zu erstellen wird ein Name, ein Namespace und ein Verzeichnis benötigt. Entwickler Apps werden im Stammverzeichnis für Apps gespeichert application/apps. Mit der Option Verzeichnis wird die App, in dem angegebenen Unterverzeichnis, im Stammverzeichnis gespeichert. Ein Namespace ist dringend erforderlich. Der Namespace wird von allen Controllern und Models verwendet. Dadurch wird verhindert das es zu Konflikten mit anderen Apps kommt. Entwickler können sich ihre eigenen Namespaces für APPNETOS, unter <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a>, sichern. Apps welche im APPNET OS Store angeboten und heruntergeladen werden erzeugen dadurch keine Konflikte. Die Option Container App gibt an ob Apps, zusammen mit weiteren Container Apps, in einem Container ausgegeben werden. Bei Container Apps kann später, in den App Einstellungen die Größe angepasst werden. Apps die immer die komplette Breite des Browsers verwenden sollten nicht als Container Apps erzeugt werden. Eine erstellter Entwickler App enthält einen Controller, ein Model, zwei Views, verschiedene Sprachdateien, einen Admin Controller, ein Admin Model, zwei Admin Views und verschiedene Admin Sprachdateien. Eine Entwickler App  einhält auch ein vorbereitetes Widget, welches aus einem Controller, einem Model und zwei Views und verschiedenen Sprachdateien besteht. Zusätzlich werden alle Admin Events vorbereitet.",
    "admin__apps__create__err_no_name" => "Kein Namen eingegeben",
    "admin__apps__create__err_name" => "Der Name kann nicht verwendet werden",
    "admin__apps__create__err_name_exists" => "Es ist bereits eine App mit diesem Namen vorhanden",
    "admin__apps__create__conf" => "Der App wurde erstellt",
    "admin__apps__create__err_dir" => "Die Eingabe das Verzeichnis kann nicht verwendet werden",
    "admin__apps__create__err_dev_name_ex" => "Es ist bereits eine App mit diesem Namen, in diesem Verzeichnis, vorhanden",
    "admin__apps__create__err_ns_wrong" => "Die Eingabe der Namespace kann nicht verwendet werden",
    "admin__apps__create__err_ns_exists" => "Es ist bereits eine App mit diesem Namen, in diesem Namespace, vorhanden",
    "admin__apps__create__container_app" => "Container App",
    "admin__apps__create__container_true" => "Container App",
    "admin__apps__create__container_false" => "Keine Container App",
    "admin__apps__create__development" => "Entwicklung",
    "admin__apps__create__smarty" => "Views als Smarty Templates",
    "admin__apps__create__php" => "Views als PHP Templates",
    "admin__apps__create__cache" => "App Cache",
    "admin__apps__create__cache_false" => "Keine Cache Funktion hinzufügen",
    "admin__apps__create__cache_true" => "Cache Funktion hinzufügen",
    "admin__apps__create__html_header" => "HTML Template App",
    "admin__apps__create__html_description" => "Template basierende, mehrsprachige HTML App. Die App verfügt über einen eigenen Admin Bereich. Durch den eingebauten wysiwyg und HTML Editor ist es ein leichtes den den Text oder den Code anzupassen. Die App setzt keine Programmierkenntnisse voraus und kann einfach eingebunden werden. ",
    "admin__apps__create__dev_description" => "Eine komplett vorgefertigter Baukasten für Entwickler. Es kann festgelegt werden mit welchen Bereichen die App erzeugt werden soll. Applikationsbereich, Admin Bereich und Widget. Für jeden Bereich werden String Dateien angelegt. Zudem sind alle Events vorbereitet. Die App ist für Entwickler geeignet die eigene Anwendungen für APPNET OS programmieren.",
    "admin__apps__create__name" => "Name der App",
    "admin__apps__create__description" => "Beschreibung der App",
    "admin__apps__create__namespace" => "Namespace",
    "admin__apps__create__directory" => "Verzeichnis",
    "admin__apps__create__build" => "Erstellen",
    "admin__apps__create__widget" => "Widget",
    "admin__apps__create__widget_false" => "Kein Widget hinzufügen",
    "admin__apps__create__widget_true" => "Widget hinzufügen",
    "admin__apps__create__overview" => "Übersicht",
    "admin__apps__create__menu_header" => "Neue App erstellen",
    "admin__apps__create__install_apps" => "Apps installieren",
    "admin__apps__create__html_string_header" => "HTML String App",
    "admin__apps__create__html_sting_description" => "Mehrsprachige String basierende HTML App. Der Admin Bereich verfügt über einen eingebauten HTML und wysiwyg  Editor. In der HTML Datei können Strings aus PHP Sprachdateien verwendet werden. Es wird eine globale und eine englische Sprachdatei erzeugt, es können aber einfach weiter Sprachdateien hinzugefügt werden. Die App erfordert minimale Programmierkenntnisse",
    "admin__apps__create__html_string_info" => "String basierende mehrsprachige HTML App. Der Admin Bereich verfügt über einen eingebauten  HTML und wysiwyg  Editor. Für Texte werden String Dateien verwendet. Die Texte der String Dateien können einfach in die HTML übernommen werden. Dies hat den Vorteil das nur eine HTML Datei für alle Sprachen erzeugt werden muss. Beim erstellen der App wird eine globale und eine englische String Datei erzeugt. Zum bearbeiten der String Dateien wird ein externer Editor benötigt. Für weitere Sprachen muss nur eine vorhandene String Datei kopiert werden und mit entsprechendem Länderkennung benannt werden. Die Auswahl der Sprache erfolgt automatisch. Es kann zwischen 3 Template Sprachen gewählt werden in den Strings in folgend eingefügt werden.",
    "admin__apps__create__template_language" => "Template Sprache",
    "admin__apps__create__twig" => "Views als Twig Templates",
];