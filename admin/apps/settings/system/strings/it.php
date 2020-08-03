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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 */

// Language strings.
$strings = [
    "admin__settings__system__info" => "Le impostazioni del sistema OS APPNET sono memorizzate nel file config.ing.php, nella directory principale. Per motivi di sicurezza, la maggior parte delle impostazioni può essere modificata solo direttamente nel file. In Cache, le impostazioni di memorizzazione nella cache possono essere sovrascritte. Questo ha senso per lo sviluppo di app. Sotto Admin sono le Impostazioni per l'Area Amministratore.",
    "admin__settings__system__database" => "Impostazioni del database",
    "admin__settings__system__database_type" => "Tipo di database",
    "admin__settings__system__database_host" => "Host del database",
    "admin__settings__system__database_user" => "Nome utente del database",
    "admin__settings__system__database_port" => "Porta del database",
    "admin__settings__system__database_charset" => "Set di caratteri del database",
    "admin__settings__system__database_pass" => "Password del database",
    "admin__settings__system__database_name" => "Nome del database",
    "admin__settings__system__system" => "Impostazioni di sistema",
    "admin__settings__system__prefix" => "Prefisso OS APP",
    "admin__settings__system__url" => "URL di sistema",
    "admin__settings__system__data_path" => "Percorso dati di sistema",
    "admin__settings__system__directories" => "Elenchi",
    "admin__settings__system__cache_dir" => "Directory della cache",
    "admin__settings__system__temp_dir" => "Directory di dati temporanei",
    "admin__settings__system__log_dir" => "Directory del file di registro",
    "admin__settings__system__compile_dir" => "Smarty compila directory",
    "admin__settings__system__config_dir" => "Directory di configurazione Smarty",
    "admin__settings__system__cache" => "nascondiglio",
    "admin__settings__system__app_cache" => "Cache dell'app",
    "admin__settings__system__cache_expire" => "La cache dell'app scade in secondi",
    "admin__settings__system__file_cache" => "Cache di file",
    "admin__settings__system__directory_cache" => "Cache di directory",
    "admin__settings__system__string_cache" => "Cache delle stringhe",
    "admin__settings__system__js_cache" => "Cache JavaScript",
    "admin__settings__system__css_cache" => "Cache CSS",
    "admin__settings__system__minify" => "Minimizza JavaScript e CSS quando la cache non è attiva",
    "admin__settings__system__cookie_lock" => "Cookie blocker APPNETOS",
    "admin__settings__system__expert_mode" => "Modalità esperto della sezione di amministrazione",
    "admin__settings__system__debugging" => "Debug",
    "admin__settings__system__debug_mode" => "Modalità di debug",
    "admin__settings__system__debug_ajax" => "Modalità debug AJAX",
    "admin__settings__system__user" => "Impostazioni utente",
    "admin__settings__system__user_regex" => "Espressione regolare di convalida del nome utente",
    "admin__settings__system__pass_regex" => "Espressione regolare di convalida della password",
    "admin__settings__system__user_error_count" => "Numero di accessi errati prima che gli utenti siano bloccati",
    "admin__settings__system__files_dir" => "Directory accettate",
    "admin__settings__system__files_types" => "Formati di file accettati",
    "admin__settings__system__max_size" => "Limite di upload del file",
    "admin__settings__system__cache_info" => "APPNET OS utilizza una varietà di cache per accelerare il sistema. Le impostazioni della cache sono definite nel file config.inc.php, nella directory principale e possono essere modificate qui. Oltre a sviluppare o modificare pagine, le cache dovrebbero sempre essere attive. Anche la cache dell'app è gestita dalle app. Non tutte le app hanno la possibilità di memorizzare nella cache il loro contenuto. La cache dei file salva la cronologia dei file e la cache delle directory salva la cronologia delle directory. Di conseguenza, non tutti i file e le directory delle app devono essere attraversati. La cache di stringhe memorizza tutte le stringhe che sono già state caricate. JavaScript e CSS Cache raccoglie tutti i file dalle app attive, li minimizza, li salva e inserisce un link nell'intestazione. Per sviluppare, l'opzione di minimizzazione può essere disabilitata.",
    "admin__settings__system__admin_info" => "Nelle impostazioni amministratore, è possibile attivare la modalità esperto. In modalità esperto, è possibile modificare i file JavaScript e CSS delle app e modificare il comportamento di memorizzazione nella cache delle app. C'è anche la possibilità di disabilitare le informazioni nell'area admin.",
    "admin__settings__system__admin_expert_mode" => "Modalità esperto",
    "admin__settings__system__admin_show_info" => "Mostra le informazioni nella sezione di amministrazione",
    "admin__settings__system__debug_info" => "È qui che è possibile attivare il debug e il debug AJAX. Il debugging emette tutti i messaggi di errore di PHP nella parte inferiore della pagina. Il debug AJAX emette l'ID univoco AJAX, richiesto per le richieste AJAX.",
    "admin__settings__system__debug_debug" => "Debug di sistema",
    "admin__settings__system__debug_debug_ajax" => "Debug AJAX",
    "admin__settings__system__menu_system" => "Impostazioni di sistema",
    "admin__settings__system__menu_cache" => "Impostazioni cache",
    "admin__settings__system__menu_admin" => "Impostazioni amministratore",
    "admin__settings__system__menu_debug" => "Impostazioni di debug",
    "admin__settings__system__files" => "File",
    "admin__settings__system__save" => "Salvare",
    "admin__settings__system__conf" => "Le impostazioni sono state salvate",
    "admin__settings__system__compressor" => "Comprimi il codice sorgente HTML",
    "admin__settings__system__extend_info" => "Il APPNET OS consente a ogni classe di espandersi più volte senza modificare la classe stessa, che si tratti di una classe app o di una classe principale. Ciò consente alle app di apportare modifiche alle classi senza modificare la classe stessa.  Con l'estensione di classe, le singole funzioni possono essere modificate. Non è necessario ricreare la classe completa. Più estensioni possono causare errori nell'ordine errato. Qui è possibile regolare l'ordine delle estensioni. Le sostituzioni che non esistono più possono essere rimosse.",
    "admin__settings__system__class_extends" => "Estensioni di classe",
    "admin__settings__system__class" => "Classe",
    "admin__settings__system__extends" => "Si estende",
    "admin__settings__system__extends_move_confirm" => "L'estensione è stata spostata",
    "admin__settings__system__extends_move_error" => "Impossibile spostare l'estensione",
    "admin__settings__system__extends_remove_confirm" => "L'estensione è stata rimossa",
    "admin__settings__system__extends_remove_error" => "Impossibile rimuovere l'estensione",
    "admin__settings__system__extends_not_exists" => "La classe non esiste",
    "admin__settings__system__remove" => "Rimuovere",
    "admin__settings__system__remove_warning" => "Prestare attenzione quando si rimuovono le estensioni di classe. La rimozione delle estensioni di classe può causare problemi. Si prega di controllare prima di rimuovere la classe se la classe non esiste più e se l'estensione non è più necessaria.",
    "admin__settings__system__close" => "Vicino",
    "admin__settings__system__activated" => "Attivato",
    "admin__settings__system__deactivated" => "Disattivato",
    "admin__settings__system__activate" => "Attivare",
    "admin__settings__system__deactivate" => "Disattivare",
    "admin__settings__system__extends_activate_error" => "Impossibile attivare l'estensione della classe",
    "admin__settings__system__extends_activate_error_exists" => "Impossibile attivare l'estensione della classe. Una delle classi richieste non esiste.",
    "admin__settings__system__extends_deactivate_error" => "Impossibile disattivare l'estensione della classe",
    "admin__settings__system__extends_activate_confirm" => "L'estensione della classe è stata attivata",
    "admin__settings__system__extends_deactivate_confirm" => "L'estensione della classe è stata disattivata",
    "admin__settings__system__no_extends" => "Nessuna estensione di classe disponibile",
];