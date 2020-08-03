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
    "admin__apps__management__conf_deactivate" => "L'app è stata disattivata",
    "admin__apps__management__conf_activate" => "L'app è stata attivata",
    "admin__apps__management__err_activate" => "L'app non può essere stata attivata o disattivata",
    "admin__apps__management__conf_remove" => "L'app è stata rimossa",
    "admin__apps__management__err_remove" => "L'app non può essere rimossa",
    "admin__apps__management__info" => "Il sistema operativo APPNET utilizza le app per creare pagine Web da esse. La gestione app elenca tutte le app installate. Le app possono essere assegnate a singole pagine nella gestione SEO. Le app statiche possono anche essere impostate nella parte superiore e le app statiche nella parte inferiore. Questi sono quindi disposti in ogni pagina in alto o in basso. Le app possono anche includere un'area di amministrazione. È possibile accedere all'area di amministrazione tramite le impostazioni dell'app. Gli eventi consentono agli sviluppatori di assegnare azioni specifiche alle app. Questi eventi verranno eseguiti sotto l'evento appropriato. Ciò consente alle app di installare, duplicare, ripristinare, rimuovere ed eliminare l'app. Potrebbero esserci anche eventi che si verificano quando si attiva o si disattiva.",
    "admin__apps__management__deactivate_header" => "Disattiva app",
    "admin__apps__management__deactivate_info" => "Le app disattivate non vengono emesse. La funzione è utile quando si modifica il contenuto dell'app. Nessun dato viene perso quando le app sono disabilitate e possono essere riattivate in qualsiasi momento.",
    "admin__apps__management__remove_header" => "Rimuovi app",
    "admin__apps__management__remove_info" => "Fai attenzione quando rimuovi le app. L'app viene rimossa dal database dell'app. La directory dell'app e la tabella del database rimangono al loro posto e devono essere rimossi manualmente. I dati non sono persi. Tuttavia, le app con le tabelle del database sono difficili da recuperare.",
    "admin__apps__management__delete_header" => "Elimina app",
    "admin__apps__management__delete_info" => "Fai attenzione quando elimini app. L'app viene rimossa dal database dell'app e viene eseguito lo script dell'app per eliminare l'app. Tutte le tabelle del database dell'app vengono eliminate. I dati non possono essere recuperati e saranno persi per sempre.",
    "admin__apps__management__conf_delete" => "L'app è stata cancellata",
    "admin__apps__management__err_delete" => "L'app non può essere cancellata",
    "admin__apps__management__err_description" => "La descrizione non può essere cambiata",
    "admin__apps__management__conf_description" => "La descrizione è stata cambiata",
    "admin__apps__management__err_duplicate" => "L'app non può essere duplicata",
    "admin__apps__management__conf_duplicate" => "L'app è stata duplicata",
    "admin__apps__management__directory" => "Percorso per l'app",
    "admin__apps__management__reset_header" => "Ripristina app",
    "admin__apps__management__reset_info" => "Fai attenzione quando ripristini le app. Qui, lo script app viene eseguito per reimpostare. Tutte le tabelle del database dell'app vengono svuotate. I dati non possono essere recuperati e saranno persi per sempre.",
    "admin__apps__management__err_reset" => "L'app non può essere resettata",
    "admin__apps__management__conf_reset" => "L'app è stata ripristinata",
    "admin__apps__management__description_info" => "Rendi più app più riconoscibili aggiungendo una descrizione.",
    "admin__apps__management__edit_styles" => "Modifica stili",
    "admin__apps__management__duplicate" => "Duplicato",
    "admin__apps__management__reset" => "Azzerare",
    "admin__apps__management__install" => "Installare",
    "admin__apps__management__activate" => "Attivare",
    "admin__apps__management__deactivate" => "Disattivare",
    "admin__apps__management__delete" => "Eliminare",
    "admin__apps__management__remove" => "Togliere",
    "admin__apps__management__revert" => "Azzerare",
    "admin__apps__management__id_up" => "ID crescente",
    "admin__apps__management__id_down" => "ID decrescente",
    "admin__apps__management__name_up" => "Nome crescente",
    "admin__apps__management__name_down" => "Nome discendente",
    "admin__apps__management__description_up" => "Descrizione crescente",
    "admin__apps__management__description_down" => "Descrizione discendente",
    "admin__apps__management__description" => "Descrizione",
    "admin__apps__management__settings" => "Impostazioni",
    "admin__apps__management__search" => "Cercare",
    "admin__apps__management__menu_header" => "Gestione delle app",
    "admin__apps__management__no_apps" => "Nessuna app disponibile",
    "admin__apps__management__events" => "Eventi",
    "admin__apps__management__no_events" => "Nessun evento",
    "admin__apps__management__admin" => "Area di amministrazione",
    "admin__apps__management__activated" => "Attivare",
    "admin__apps__management__deactivated" => "Disattivare",
    "admin__apps__management__no_description" => "Nessuna descrizione",
    "admin__apps__management__app_id" => "App ID",
    "admin__apps__management__properties" => "Proprietà",
    "admin__apps__management__license" => "permettere",
    "admin__apps__management__no_content" => "Nessun contenuto",
    "admin__apps__management__frontend" => "Frontend",
    "admin__apps__management__admin_area" => "Area di amministrazione",
    "admin__apps__management__static" => "Statico",
    "admin__apps__management__not_static" => "Non statico",
    "admin__apps__management__size" => "Dimensioni e orientamento",
    "admin__apps__management__container_css" => "CSS container",
    "admin__apps__management__app_css" => "CSS app",
    "admin__apps__management__no_container_css" => "Nessun container CSS",
    "admin__apps__management__no_app_css" => "Nessun app CSS",
    "admin__apps__management__no_store_license" => "Nessuna informazione sulla licenza disponibile",
    "admin__apps__management__no_store_description" => "Nessuna descrizione disponibile",
    "admin__apps__management__close" => "Chiudersi",
    "admin__apps__management__css_container_fluid" => "CSS container-fluid",
    "admin__apps__management__no_container_fluid_css" => "Nessun container-fluid CSS",
    "admin__apps__management__version" => "Versione",
];