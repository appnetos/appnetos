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
    "admin__cms__uri_management__add" => "Aggiungi URI",
    "admin__cms__uri_management__info" => "Un URI è l'indirizzo della pagina secondaria di un sito web. L'URI è allegato alla fine dell'URL definito in config.inc.php. Insieme formano l'URL con cui è possibile accedere alla pagina. Il sistema operativo APPNET supporta URI multilingue parlanti. Questo è uno strumento potente. Ciò consente di definire un URI di pagina in più lingue. Se si accede ai collegamenti nelle viste tramite l'ID URI, l'URI verrà aperto nella lingua appropriata. In una Smarty View, il link è associato a [{\ $ render-> getUrl (URI ID)}]. In PHP con echo \ $ render-> getUrl (URI ID). Il supporto multilingue codifica UTF8. Pertanto, con alcune eccezioni, l'URI può anche essere prodotto in tutte le lingue. Se più URI di una pagina hanno lo stesso contenuto, allora un canonico dovrebbe essere posto sulla voce principale. Di conseguenza, i motori di ricerca rilevano URI multilingue con lo stesso contenuto e non vengono puniti. Ti dà anche la possibilità di definire il tuo titolo e favicon per ogni pagina. Se questi non sono definiti, allora il Favicon viene utilizzato dalle impostazioni della lingua. Gli URI appena aggiunti sono sempre globali. Modificare le lingue per l'URI può essere aggiunto all'URI. La gestione delle app può definire il contenuto.",
    "admin__cms__uri_management__button_apps" => "Gestisci le app",
    "admin__cms__uri_management__add_info" => "Qui, il sito Web può essere espanso con pagine secondarie aggiuntive. Se l'URI è vuoto, viene creato un collegamento alla pagina dell'indice. Gli URI devono essere creati senza l'URL definito da config.inc.php. Gli URI non iniziano con / un inizio. Gli URI non possono contenere i seguenti caratteri; /?:@=&'\\\"<>#%{}|\\^~[]`. Ogni URI può esistere solo una volta.",
    "admin__cms__uri_management__err_add" => "La voce non può essere creata",
    "admin__cms__uri_management__err_add_valid" => "L'URL non è permesso",
    "admin__cms__uri_management__err_add_favicon" => "Il percorso del file per favicon non è consentito",
    "admin__cms__uri_management__err_add_exists" => "C'è già una voce con questo URI",
    "admin__cms__uri_management__conf_add" => "L'URI è stato aggiunto",
    "admin__cms__uri_management__delete_header" => "Elimina URI",
    "admin__cms__uri_management__delete_info" => "Fai attenzione quando elimini gli URI. Eliminando un URI, la pagina non è più disponibile. La configurazione della pagina è irrevocabilmente persa.",
    "admin__cms__uri_management__err_delete" => "La voce non può essere cancellata",
    "admin__cms__uri_management__conf_delete" => "La voce è stata cancellata",
    "admin__cms__uri_management__edit_seo" => "Modifica URI",
    "admin__cms__uri_management__menu_header" => "Gestione URI",
    "admin__cms__uri_management__search" => "Cercare",
    "admin__cms__uri_management__no_uris" => "Nessun URI disponibile",
    "admin__cms__uri_management__home" => "Casa",
    "admin__cms__uri_management__delete" => "Eliminare",
    "admin__cms__uri_management__uri_id" => "ID URI",
    "admin__cms__uri_management__properties" => "Proprietà",
    "admin__cms__uri_management__views" => "Visualizzazioni",
    "admin__cms__uri_management__apps" => "Applicazioni",
    "admin__cms__uri_management__languages" => "Lingue",
    "admin__cms__uri_management__title" => "Titolo",
    "admin__cms__uri_management__language_settings" => "Lingua",
    "admin__cms__uri_management__favicon" => "Favicon",
    "admin__cms__uri_management__uri" => "URI",
    "admin__cms__uri_management__button_add" => "Aggiungere",
    "admin__cms__uri_management__close" => "Chiudersi",
    "admin__cms__uri_management__id_up" => "ID crescente",
    "admin__cms__uri_management__id_down" => "ID discendente",
    "admin__cms__uri_management__uri_up" => "URI ascendente",
    "admin__cms__uri_management__uri_down" => "URI discendente",
    "admin__cms__uri_management__title_up" => "Titolo in ordine crescente",
    "admin__cms__uri_management__title_down" => "Titolo discendente",

];