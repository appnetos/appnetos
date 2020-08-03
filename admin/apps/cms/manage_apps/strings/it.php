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
    "admin__cms__manage_apps__conf_add" => "L'app è stata aggiunta",
    "admin__cms__manage_apps__err_add" => "L'app non può essere aggiunta",
    "admin__cms__manage_apps__err_remove" => "L'app non può essere rimossa",
    "admin__cms__manage_apps__conf_remove" => "L'app è stata rimossa",
    "admin__cms__manage_apps__err_move" => "L'app non può essere spostata",
    "admin__cms__manage_apps__conf_move" => "L'app è stata spostata",
    "admin__cms__manage_apps__add" => "Aggiungi app",
    "admin__cms__manage_apps__info" => "Nel sistema operativo APPNETOS, il contenuto degli URI viene emesso dalle app. Ogni app è parte della pagina. Le app possono anche essere disponibili più volte su una pagina. Esistono due diversi tipi di app. App standard e app contenitore. Le app standard vengono sempre emesse singolarmente tra loro. La larghezza di un'app standard è sempre al 100%. Un'app standard viene sempre emessa sotto le app precedenti. La seguente app verrà quindi rilasciata nuovamente sotto l'app standard. Le app contenitore vengono sempre rilasciate insieme ad altre app contenitore in un unico contenitore. Per ogni app contenitore, la dimensione può essere definita. Se sono definite due app contenitore adiacenti, ognuna con una larghezza del 50%, verranno emesse una accanto all'altra. Se sono definite tre app contenitore, ciascuna con una larghezza del 50%, quindi due sono affiancate e una al di sotto. Se le tre app contenitore sono definite come larghezza del 33% ciascuna, tutte e tre le app vengono emesse una accanto all'altra. Le ampie impostazioni possono essere impostate per quattro larghezze di visualizzazione. Ciò consente alle app del contenitore di essere disposte parallelamente in un grande display e tra di loro su un piccolo display. La dimensione delle app contenitore può essere definita nell'app Impostazioni.",
    "admin__cms__manage_apps__err" => "La voce URI non può essere caricata",
    "admin__cms__manage_apps__not_exists" => "Questa app non esiste più",
    "admin__cms__manage_apps__menu_header" => "Gestione delle app URI",
    "admin__cms__manage_apps__edit_uri" => "Modifica URI",
    "admin__cms__manage_apps__uri_management" => "Gestione URI",
    "admin__cms__manage_apps__home" => "casa",
    "admin__cms__manage_apps__id" => "URI ID",
    "admin__cms__manage_apps__properties" => "Proprietà",
    "admin__cms__manage_apps__views" => "Visualizzazioni",
    "admin__cms__manage_apps__apps" => "Applicazioni",
    "admin__cms__manage_apps__languages" => "Lingue",
    "admin__cms__manage_apps__title" => "Titolo",
    "admin__cms__manage_apps__favicon" => "Favicon",
    "admin__cms__manage_apps__language_settings" => "Lingua",
    "admin__cms__manage_apps__global" => "Globale",
    "admin__cms__manage_apps__uri_id" => "URI ID",
    "admin__cms__manage_apps__app_id" => "App ID",
    "admin__cms__manage_apps__activated" => "Attivato",
    "admin__cms__manage_apps__deactivated" => "Disattivato",
    "admin__cms__manage_apps__no_description" => "Nessuna descrizione",
    "admin__cms__manage_apps__close" => "Chiudersi",
    "admin__cms__manage_apps__no_content" => "Nessun contenuto",
    "admin__cms__manage_apps__frontend" => "Frontend",
    "admin__cms__manage_apps__admin_area" => "Area di amministrazione",
    "admin__cms__manage_apps__static" => "Statico",
    "admin__cms__manage_apps__not_static" => "Non statico",
    "admin__cms__manage_apps__size" => "Dimensioni e orientamento",
    "admin__cms__manage_apps__container_css" => "CSS container",
    "admin__cms__manage_apps__app_css" => "CSS App",
    "admin__cms__manage_apps__no_container_css" => "Nessun container CSS",
    "admin__cms__manage_apps__no_app_css" => "Nessun app CSS",
    "admin__cms__manage_apps__admin" => "Area di amministrazione",
    "admin__cms__manage_apps__css_container_fluid" => "CSS container-fluid",
    "admin__cms__manage_apps__no_container_fluid_css" => "Nessun container-fluid CSS",
    "admin__cms__manage_apps__settings" => "Impostazioni",
    "admin__cms__manage_apps__remove" => "Togliere",
    "admin__cms__manage_apps__no_apps" => "Nessuna app disponibile",
];