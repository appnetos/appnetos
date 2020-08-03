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
    "admin__cms__edit_uri__add_lang" => "Aggiungi lingua",
    "admin__cms__edit_uri__remove_header" => "Rimuovi la lingua",
    "admin__cms__edit_uri__remove_info" => "Fai attenzione quando rimuovi gli URI. Se un URI parlante viene cancellato, non è più possibile accedere a questa pagina inserendo direttamente l'indirizzo. I collegamenti tramite l'URI ID vengono quindi inoltrati all'URI della lingua predefinita o all'URI globale.",
    "admin__cms__edit_uri__info" => "La globalizzazione combinata con URI multilingue parlanti è uno strumento potente nel sistema operativo APPNET. Questo ti permette di creare una pagina multilingue usando mezzi semplici. Per ogni pagina, a seconda della lingua impostata, è possibile modificare il contenuto, l'URI parlante, il titolo e il Favicon. Con l'uso corretto, nei motori di ricerca si ottiene un punteggio elevato. In una Smarty View, il link è associato a [{\ $ render-> getUrl (URI ID)}]. In PHP con echo getUrl (URI ID). Il supporto multilingue codifica UTF8. Pertanto, con alcune eccezioni, l'URI può anche essere prodotto in tutte le lingue. Se l'inglese URI my-uri e l'URI meine-uri tedesco, la pagina viene chiamata in inglese sotto http://www.appnetos.com/my-uri e in tedesco sotto http://www.appnetos.com/meine -uri. Se più URI di una pagina hanno lo stesso contenuto, allora un canonico dovrebbe essere posto sulla voce principale. Di conseguenza, i motori di ricerca rilevano URI multilingue con lo stesso contenuto e non vengono puniti.",
    "admin__cms__edit_uri__add_info" => "Per ogni URI, l'URI di lingua, il titolo e il Favicon possono essere definiti, a seconda della lingua impostata. Per l'indice URI, l'URI parlante non può essere definito. Se più URI di una pagina hanno lo stesso contenuto, allora un canonico dovrebbe essere posto sulla voce principale. Di conseguenza, i motori di ricerca rilevano URI multilingue con lo stesso contenuto e non vengono puniti.",
    "admin__cms__edit_uri__err_load" => "Impossibile caricare il contenuto",
    "admin__cms__edit_uri__no_lang" => "Nessun'altra lingua disponibile",
    "admin__cms__edit_uri__err_add" => "La lingua non può essere aggiunta",
    "admin__cms__edit_uri__add_exists" => "Esiste già una voce con questo URI",
    "admin__cms__edit_uri__conf_add" => "La lingua è stata aggiunta",
    "admin__cms__edit_uri__not_exists" => "La lingua non esiste più",
    "admin__cms__edit_uri__err_remove" => "La voce della lingua non può essere rimossa",
    "admin__cms__edit_uri__conf_remove" => "La voce della lingua è stata rimossa",
    "admin__cms__edit_uri__edit_header" => "Modifica la voce",
    "admin__cms__edit_uri__edit_info" => "Fai attenzione quando cambi un URI. Se viene modificato un URI, non è più possibile accedere a questa pagina immettendo direttamente l'indirizzo. I collegamenti all'ID URI non sono interessati.",
    "admin__cms__edit_uri__err" => "L'entrata non può essere caricata",
    "admin__cms__edit_uri__err_edit" => "La voce non può essere modificata",
    "admin__cms__edit_uri__conf_edit" => "La voce è stata modificata",
    "admin__cms__edit_uri__err_no_uri" => "Nessun URI inserito",
    "admin__cms__edit_uri__err_add_valid" => "L'URL non è permesso",
    "admin__cms__edit_uri__menu_header" => "Modifica URI",
    "admin__cms__edit_uri__menu_app_management" => "Gestione app URI",
    "admin__cms__edit_uri__menu_uri_management" => "Gestione URI",
    "admin__cms__edit_uri__no_languages" => "Nessuna lingua disponibile",
    "admin__cms__edit_uri__remove" => "Togliere",
    "admin__cms__edit_uri__edit" => "Curare",
    "admin__cms__edit_uri__id" => "URI ID",
    "admin__cms__edit_uri__properties" => "Proprietà",
    "admin__cms__edit_uri__views" => "Visualizzazioni",
    "admin__cms__edit_uri__apps" => "Applicazioni",
    "admin__cms__edit_uri__languages" => "Lingue",
    "admin__cms__edit_uri__language" => "Lingua",
    "admin__cms__edit_uri__title" => "Titolo",
    "admin__cms__edit_uri__favicon" => "Favicon",
    "admin__cms__edit_uri__language_settings" => "Lingua",
    "admin__cms__edit_uri__global" => "Globale",
    "admin__cms__edit_uri__uri" => "URI",
    "admin__cms__edit_uri__canonical" => "ID canonico",
    "admin__cms__edit_uri__no_canonical" => "Nessun ID canonico",
    "admin__cms__edit_uri__save" => "Salvare",
    "admin__cms__edit_uri__close" => "Chiudersi",
    "admin__cms__edit_uri__add" => "Aggiungere",
    "admin__cms__edit_uri__home_info" => "Impossibile aggiungere lingue alla home page",
    "admin__cms__edit_uri__home" => "Casa",
    "admin__cms__edit_uri__meta_delete" => "Elimina",
    "admin__cms__edit_uri__clear" => "Reimpostare",
    "admin__cms__edit_uri__name" => "Nome",
    "admin__cms__edit_uri__content" => "Contenuto",
    "admin__cms__edit_uri__meta_title" => "Titolo per i motori di ricerca. Massimo 70 caratteri.",
    "admin__cms__edit_uri__meta_description" => "Descrizione per i motori di ricerca. Massimo 320 caratteri.",
    "admin__cms__edit_uri__meta_keywords" => "Parole chiave per i motori di ricerca. Fino a 5 parole chiave separate da spazi.",
];
