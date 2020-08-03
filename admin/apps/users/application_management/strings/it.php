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
 * @description     Admin overview and management for application users.
 */

// Language strings.
$strings = [
    "admin__users__application_management__info" => "Tutte le informazioni degli utenti registrati possono essere visualizzate in Gestione utenti. Gli account utente possono essere bloccati e sbloccati. Le password possono essere riassegnate dagli utenti. Se l'attivazione e-mail degli account è attiva, gli account che non sono stati attivati possono essere attivati o rimossi. I nomi utente e gli indirizzi e-mail possono essere modificati. I gruppi possono essere assegnati agli utenti. I gruppi di utenti definiscono le aree che gli utenti sono autorizzati a visualizzare.",
    "admin__users__application_management__registered_since" => "Registrato da",
    "admin__users__application_management__last_sign_in" => "Ultimo accesso",
    "admin__users__application_management__active" => "Attivamente",
    "admin__users__application_management__not_activated" => "Non attivato",
    "admin__users__application_management__sign_in_error" => "Errore di accesso",
    "admin__users__application_management__locked" => "Chiuso",
    "admin__users__application_management__deleted" => "Cancellato",
    "admin__users__application_management__ip_first" => "Registrazione IP",
    "admin__users__application_management__ip_last" => "Ultimo accesso IP",
    "admin__users__application_management__admin" => "Amministratore",
    "admin__users__application_management__permissions" => "Permessi",
    "admin__users__application_management__edit_header" => "Modifica l'account utente",
    "admin__users__application_management__edit_info" => "Fai attenzione quando modifichi gli account utente. Se il nome utente, l'indirizzo e-mail o la password di un account sono cambiati, l'utente non può più accedere con i suoi vecchi dati.",
    "admin__users__application_management__edit_pass" => "Lascia vuoto per non cambiare",
    "admin__users__application_management__edit_min_user" => "Controllo utente minimo (controlla solo se il nome utente esiste già)",
    "admin__users__application_management__edit_min_pass" => "Verifica password minima (controllare solo se è stata inserita una password)",
    "admin__users__application_management__edit_err_user_exists" => "Il nome utente è già occupato",
    "admin__users__application_management__edit_err_user_valid" => "Il nome utente non è permesso",
    "admin__users__application_management__edit_err_user_usable" => "Il nome utente non può essere utilizzato",
    "admin__users__application_management__edit_err_mail_exists" => "L'indirizzo email è già in uso",
    "admin__users__application_management__edit_err_mail_valid" => "L'indirizzo email non è permesso",
    "admin__users__application_management__edit_err_pass_valid" => "La password non è consentita",
    "admin__users__application_management__edit_err_pass_usable" => "La password non può essere utilizzata",
    "admin__users__application_management__edit_conf" => "L'account utente è stato modificato",
    "admin__users__application_management__err_activate" => "L'account utente non può essere attivato",
    "admin__users__application_management__conf_activate" => "L'account utente è stato attivato",
    "admin__users__application_management__lock_header" => "Blocca account utente",
    "admin__users__application_management__lock_info" => "Fai attenzione quando blocchi gli account utente. Gli utenti con account bloccati non possono più accedere.",
    "admin__users__application_management__delete_header" => "Elimina l'account utente",
    "admin__users__application_management__delete_info" => "Fai attenzione quando elimini gli account utente. Se un account utente viene eliminato, l'utente non può più accedere, ma l'account utente può essere riattivato. Se un utente viene eliminato dal sistema, tutti i dati dell'utente vengono rimossi dal database e l'account non può essere ripristinato.",
    "admin__users__application_management__permissions_header" => "Permessi",
    "admin__users__application_management__permissions_info" => "Fai attenzione quando assegni le autorizzazioni dell'amministratore. Gli utenti con privilegi di amministratore possono accedere alla sezione di amministrazione e modificare la pagina con il loro contenuto.",
    "admin__users__application_management__conf_lock" => "L'account utente è stato bloccato",
    "admin__users__application_management__err_lock" => "L'account utente non può essere bloccato",
    "admin__users__application_management__conf_delete" => "L'account utente è stato cancellato",
    "admin__users__application_management__err_delete" => "L'account utente non può essere cancellato",
    "admin__users__application_management__conf_permissions" => "Le autorizzazioni sono state cambiate",
    "admin__users__application_management__err_permissions" => "Le autorizzazioni non possono essere modificate",
    "admin__users__application_management__del_from_system" => "Elimina utente dal sistema",
    "admin__users__application_management__err_pass" => "La password è sbagliata",
    "admin__users__application_management__add_user" => "Aggiungi utenti",
    "admin__users__application_management__add_err_user_enter" => "Si prega di inserire un nome utente",
    "admin__users__application_management__add_err_user_valid" => "Il nome utente non è permesso",
    "admin__users__application_management__add_err_user_exists" => "Il nome utente è già occupato",
    "admin__users__application_management__add_err_user_usable" => "Il nome utente non può essere utilizzato",
    "admin__users__application_management__add_err_pass_enter" => "Si prega di inserire una password",
    "admin__users__application_management__add_err_pass_compare" => "La password e la ripetizione della password non sono identiche",
    "admin__users__application_management__add_err_pass_valid" => "La password non è consentita",
    "admin__users__application_management__add_err_pass_usable" => "La password non può essere utilizzata",
    "admin__users__application_management__add_err_mail_enter" => "Per favore inserisci un indirizzo email",
    "admin__users__application_management__add_err_mail_valid" => "L'email non è consentita",
    "admin__users__application_management__add_err_mail_exists" => "L'indirizzo email è già in uso",
    "admin__users__application_management__add_conf" => "L'account utente è stato aggiunto",
    "admin__users__application_management__add_err" => "L'account utente non può essere aggiunto",
    "admin__users__application_management__search_registered" => "Congiunto",
    "admin__users__application_management__search_active" => "Attivamente",
    "admin__users__application_management__search_unactive" => "Di dormienza",
    "admin__users__application_management__search_locked" => "Chiuso",
    "admin__users__application_management__search_deleted" => "Cancellato",
    "admin__users__application_management__search_all" => "Tutto",
    "admin__users__application_management__restore_conf" => "L'account utente è stato ripristinato",
    "admin__users__application_management__restore_err" => "L'account utente non può essere ripristinato",
    "admin__users__application_management__menu_header" => "Gestione utenti",
    "admin__users__application_management__search" => "Cercare",
    "admin__users__application_management__delete" => "Eliminare",
    "admin__users__application_management__user_id" => "ID utente",
    "admin__users__application_management__properties" => "Proprietà",
    "admin__users__application_management__edit" => "Curare",
    "admin__users__application_management__information" => "Informazioni",
    "admin__users__application_management__user" => "Nome m utente inv",
    "admin__users__application_management__mail" => "Posta elettronica",
    "admin__users__application_management__pass" => "Parola f d'ordine",
    "admin__users__application_management__save" => "Salvare",
    "admin__users__application_management__pass_info" => "Lasciare vuoto per non modificare",
    "admin__users__application_management__ip_sign_up" => "IP al momento della registrazione",
    "admin__users__application_management__ip_sign_in" => "IP all'ultima registrazione",
    "admin__users__application_management__activate" => "Attivare",
    "admin__users__application_management__deactivate" => "Disattivare",
    "admin__users__application_management__lock" => "Chiudere a chiave",
    "admin__users__application_management__restore" => "Restaurare",
    "admin__users__application_management__account_type" => "Tipo di account",
    "admin__users__application_management__standard" => "Scala di valori",
    "admin__users__application_management__sign_in_count" => "Numero di accesso",
    "admin__users__application_management__no_users" => "Nessun utente presente",
    "admin__users__application_management__admin_button" => "Amministratore",
    "admin__users__application_management__search_admin" => "Amministratore",
    "admin__users__application_management__close" => "Chiudersi",
    "admin__users__application_management__edit_err" => "Impossibile modificare l'utente",
    "admin__users__application_management__add" => "Aggiungere",
    "admin__users__application_management_username_up" => "Nome utente crescente",
    "admin__users__application_management_username_down" => "Nome utente discendente",
    "admin__users__application_management__mail_up" => "Indirizzo email crescente",
    "admin__users__application_management__mail_down" => "Indirizzo email discendente",
    "admin__users__application_management__ts_first_up" => "Iscriviti data crescente",
    "admin__users__application_management__ts_first_down" => "Registrati dati discendenti",
    "admin__users__application_management__id_up" => "ID crescente",
    "admin__users__application_management__id_down" => "ID discendente",
    "admin__users__application_management__user_group" => "Gruppo di utenti",
    "admin__users__application_management__group_id" => "ID gruppo",
    "admin__users__application_management__none" => "Nessuno",
    "admin__users__application_management__edit_err_group_valid" => "Il gruppo di utenti non esiste",
    "admin__users__application_management__image" => "Immagine",
    "admin__users__application_management__delete_image" => "Elimina immagine",
    "admin__users__application_management__edit_err_img_type" => "Formato immagine non corretto",
    "admin__users__application_management__edit_err_img_size" => "Il file di immagine è troppo grande",
];