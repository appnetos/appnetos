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
    "admin__settings__manage_language__info" => "Elenco di tutte le lingue utilizzate dal sistema operativo APPNET. Verranno utilizzate le lingue selezionate qui. La lingua utilizzata dall'utente è definita dal browser, ma può essere modificata dal cookie della lingua. La lingua è definita da una chiave e una sottochiave. I file di lingua delle app sono selezionati da questa chiave. I file di lingua di un'app sono memorizzati nell'app nella directory della stringa. Ogni app ha un file di linguaggio globale chiamato global.php. Questo viene caricato ogni volta che non è possibile caricare un file di lingua richiesto. Se viene richiesto un file di lingua con una sottochiave e non esiste, si tenta di caricare il file della lingua della chiave principale. Se non esiste, verrà caricata la lingua standard impostata. Se anche questo non esiste, verrà caricato il file della lingua globale. L'ordine di caricamento dei file di lingua in un esempio. en-US -> en -> Standard -> Globale",
    "admin__settings__manage_language__remove" => "Rimuovi la lingua",
    "admin__settings__manage_language__remove_info" => "Fai attenzione quando rimuovi le lingue. Se una lingua viene rimossa, le pagine non vengono più pubblicate in quella lingua. Il contenuto nell'impostazione predefinita viene emesso dai browser vocali con questa lingua. Non viene definita una lingua standard, quindi viene utilizzata la lingua globale.",
    "admin__settings__manage_language__err_add" => "Impossibile attivare la lingua",
    "admin__settings__manage_language__err_remove" => "Impossibile disattivare la lingua",
    "admin__settings__manage_language__conf_remove" => "La lingua è stata disattivata",
    "admin__settings__manage_language__conf_add" => "La lingua è stata attivata",
    "admin__settings__manage_language__menu_header" => "Gestire le lingue",
    "admin__settings__manage_language__search" => "Cercare",
    "admin__settings__manage_language__language_settings" => "Lingua",
    "admin__settings__manage_language__no_languages" => "Nessuna lingua disponibile",
    "admin__settings__manage_language__activate" => "Attivare",
    "admin__settings__manage_language__deactivate" => "Disattivare",
    "admin__settings__manage_language__properties" => "Proprietà",
    "admin__settings__manage_language__default" => "Default",
    "admin__settings__manage_language__activated" => "Attivato",
    "admin__settings__manage_language__close" => "Chiudersi",
];
