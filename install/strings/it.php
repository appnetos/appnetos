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
 * @description     install/strings/it.php ->    Italian language strings for APPNETOS installer.
 */

// Strings.
$strings = [
    "installer__language_header" => "Lingua durante l'installazione",
    "installer__language" => "Lingua",
    "installer__license" => "Licenza",
    "installer__select" => "Selezionare",
    "installer__install" => "Installare",
    "installer__accept_checkbox" => "Accetto i termini della licenza",
    "installer__accept_error" => "Devi accettare i termini della licenza",
    "installer__accept" => "Accettare",
    "installer__back" => "Indietro",
    "installer__version_error" => "Versione PHP incopicabile. Il sistema operativo APPNET richiede la versione 7.0.0 o successiva di PHP.",
    "installer__pdo_error" => "L'estensione del database PDO non è attiva. Il sistema operativo APPNET richiede l'estensione del database PDO PHP.",
    "installer__database" => "Banca dati",
    "installer__db_type" => "Tipo di database",
    "installer__db_host" => "Host del database",
    "installer__db_port" => "Porta del database",
    "installer__db_name" => "Nome del database",
    "installer__db_user" => "Nome utente del database",
    "installer__db_pass" => "Password del database",
    "installer__next" => "Più",
    "installer__connect_error" => "Connessione al database fallita.",
    "installer__prefix" => "Datanbank Prefix",
    "installer__prefix_info" => "APPNET OS utilizza un prefisso per tutte le tabelle del database. Questo esegue più installazioni con un singolo database.",
    "installer__url" => "Url (senza \"/index.php\" alla fine)",
    "installer__dir" => "Directory di installazione (senza \"/index.php\" alla fine)",
    "installer__cache_dir" => "Directory cache (a partire dalla directory di installazione)",
    "installer__tmp_dir" => "Directory temporanea (a partire dalla directory di installazione)",
    "installer__log_dir" => "Directory del file di log (a partire dalla directory di installazione)",
    "installer__compile_dir" => "Compilazione directory (a partire dalla directory di installazione)",
    "installer__config_dir" => "Directory di configurazione (a partire dalla directory di installazione)",
    "installer__extend" => "Impostazioni avanzate",
    "installer__basic_settings" => "Impostazioni di base",
    "installer__prefix_error" => "Si prega di inserire un prefisso.",
    "installer__prefix_error_1" => "Il prefisso deve avere 3 lettere minuscole (a-z).",
    "installer__prefix_error_2" => "Il prefisso del database è già in uso.",
    "installer__system_warning" => "Le modifiche a queste impostazioni non possono essere controllate e possono causare errori. Queste impostazioni possono essere modificate successivamente nel file \"confic.inc.php\".",
    "installer__directory" => "Impostazioni di installazione e directory",
    "installer__developer" => "Impostazioni sviluppatori",
    "installer__cache" => "Impostazioni cache",
    "installer__app_cache" => "Cache dell'app",
    "installer__file_cache" => "Cache di file",
    "installer__js_cache" => "Cache JavaScript",
    "installer__css_cache" => "Cache CSS",
    "installer__cache_expire" => "Tempo di scadenza della cache dell'app in secondi",
    "installer__error_count" => "Numero di accessi errati fino a quando gli utenti non sono bloccati",
    "installer__minify" => "Riduci a icona CSS e JavaScript",
    "installer__expert" => "Modalità esperto area di amministrazione",
    "installer__cookie_lock" => "Utilizza il blocco cookie di OSNET OS",
    "installer__user" => "Utente (amministratore)",
    "installer__pass" => "Password",
    "installer__pass_2" => "Ripeti la password",
    "installer__mail" => "Indirizzo email",
    "installer__user_name" => "Nome utente",
    "installer__user_min" => "Verifica utente minima (controllare solo se è stato inserito un nome utente)",
    "installer__pass_min" => "Verifica password minima (controllare solo se è stata inserita una password)",
    "installer__mail_min" => "Controllo e-mail minimo (basta controllare se è stato inserito un indirizzo e-mail)",
    "installer__err_user_enter" => "Si prega di inserire un nome utente",
    "installer__err_user_valid" => "Il nome utente non è permesso",
    "installer__err_pass_enter" => "Si prega di inserire una password",
    "installer__err_pass_compare" => "La password e la ripetizione della password non sono identiche",
    "installer__err_pass_valid" => "La password non è consentita",
    "installer__err_pass_usable" => "La password non può essere utilizzata",
    "installer__err_mail_enter" => "Per favore inserisci un indirizzo email",
    "installer__err_mail_valid" => "L'email non è consentita",
    "installer__install_header" => "Installazione",
    "installer__install_text" => "APPNET OS è pronto per l'installazione.",
    "installer__install_end" => "Installazione del sistema operativo APPNET completata. Ora puoi accedere all'area di amministrazione.",
    "installer__directory_cache" => "Cache delle stringhe.",
    "installer__string_cache" => "Cache di directory",
    "installer__permissions" => "Permessi",
    "installer__permissions_info" => "Il sistema operativo APPNET non può accedere al file system. È fondamentale che il sistema operativo APPNET possa accedere al file system. Concedere le autorizzazioni del sistema operativo APPNET per leggere, scrivere ed eseguire nella directory del sistema operativo APPNET con tutte le sottodirectory e riprovare.",
    "installer__err_access" => "Accesso negato",
    "installer__try_again" => "Riprova",
    "installer__languages" => "Area amministrativa Lingue",
    "installer__languages_info" => "Le lingue supportate dall'area di amministrazione del sistema operativo APPNET",
    "installer__languages_global" => "Globale (inglese) (tradotto da xtrose Media Studio)",
    "installer__languages_de" => "Tedesco (deutsch) (tradotto da xtrose Media Studio)",
    "installer__languages_en" => "Inglese (english) (tradotto da xtrose Media Studio)",
    "installer__languages_es" => "Spagnolo (español) (traduzione automatica)",
    "installer__languages_fr" => "Francese (français) (traduzione automatica)",
    "installer__languages_it" => "Italiano (italiano) (traduzione automatica)",
    "installer__languages_ru" => "Russo (русский) (traduzione automatica)",
    "installer__additional" => "Licenza estesa",
    "installer__security_settings" => "Impostazioni di sicurezza",
    "installer__pass_expire" => "Tempo prima che il collegamento per reimpostare la password scada in secondi",
    "installer__groups_application" => "Disattivare i gruppi di sezioni dell'applicazione",
    "installer__groups_admin" => "Disabilitare i gruppi di sezioni di amministrazione",
    "installer__authenticator_lifetime" => "Tempo prima che l'utente si disconnette in pochi secondi quando salva le credenziali",
    "installer__session_application" => "Sezione Applicazione Tempo sessione in secondi",
    "installer__session_admin" => "Tempo di sessione della sezione Amministrazione in secondi",
    "installer__compression" => "Compressione",
    "installer__html_compression" => "Comprimi codice sorgente HTML",
    "installer__debug" => "Modalità di debug",
];