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
 * @description     Application user groups. Groups can be used to define which users can view which areas.
 */

// Language strings.
$strings = [
    "admin__groups__application_groups__info" => "I gruppi di utenti controllano l'accesso alle pagine per gli utenti. La chiamata a una pagina può essere consentita o negata. Se a un gruppo non è associata alcuna pagina, è possibile accedere a ogni pagina. Se a un gruppo non sono assegnate pagine consentite, è possibile chiamare tutte le pagine, ad eccezione di quelle assegnate negate. Se non vengono assegnate pagine negate, vengono assegnate solo le pagine consentite. Può anche essere consentito e negato l'accesso alle pagine allo stesso tempo. Gli sviluppatori devono tenere presente che l'ID URI non viene restituito se gli URI vengono negati. Gli utenti che non sono associati a un gruppo non hanno restrizioni.",
    "admin__groups__application_groups__menu_header" => "Gruppi di utenti",
    "admin__groups__application_groups__add_group" => "Aggiungi gruppo di utenti",
    "admin__groups__application_groups__search" => "Ricerca",
    "admin__groups__application_groups__name_up" => "Nome crescente",
    "admin__groups__application_groups__name_down" => "Nome discendente",
    "admin__groups__application_groups__id_up" => "ID crescente",
    "admin__groups__application_groups__id_down" => "ID decrescente",
    "admin__groups__application_groups__no_groups" => "Nessun gruppo disponibile",
    "admin__groups__application_groups__add" => "Aggiungere",
    "admin__groups__application_groups__name" => "Nome del gruppo",
    "admin__groups__application_groups__close" => "Vicino",
    "admin__groups__application_groups__add_err_name_enter" => "Inserisci un nome per il gruppo",
    "admin__groups__application_groups__add_err_name_exists" => "Il nome del gruppo è già assegnato",
    "admin__groups__application_groups__add_conf" => "Il gruppo è stato aggiunto",
    "admin__groups__application_groups__delete" => "Elimina",
    "admin__groups__application_groups__group_id" => "ID gruppo",
    "admin__groups__application_groups__denied_uris" => "URI negati",
    "admin__groups__application_groups__granted_uris" => "URI di concessi",
    "admin__groups__application_groups__all" => "Tutti",
    "admin__groups__application_groups__non" => "Nessuno",
    "admin__groups__application_groups__all_but_denied" => "Tutto tranne che negato",
    "admin__groups__application_groups__all_but_granted" => "Tutto, ma concesso",
    "admin__groups__application_groups__information" => "Informazioni",
    "admin__groups__application_groups__no_uris" => "Nessun URI definito",
    "admin__groups__application_groups__edit_err" => "Impossibile modificare il gruppo",
    "admin__groups__application_groups__no_uris_err" => "Nessun URI selezionato",
    "admin__groups__application_groups__add_uri_conf" => "Gli URI sono stati aggiunti",
    "admin__groups__application_groups__home" => "Casa",
    "admin__groups__application_groups__remove_uri_conf" => "Gli URI sono stati rimossi",
    "admin__groups__application_groups__remove" => "Rimuovere",
    "admin__groups__application_groups__edit" => "Modifica",
    "admin__groups__application_groups__edit_conf" => "Il gruppo è stato modificato",
    "admin__groups__application_groups__delete_header" => "Elimina gruppo di utenti",
    "admin__groups__application_groups__delete_info" => "Prestare attenzione quando si eliminano i gruppi di utenti. I gruppi di utenti eliminati non possono essere recuperati. Gli account utente associati al gruppo sono associati al gruppo predefinito. Se non è definito alcun gruppo predefinito, questi utenti hanno accesso completo a qualsiasi contenuto.",
    "admin__groups__application_groups__delete_conf" => "Il gruppo è stato eliminato",
    "admin__groups__application_groups__as_default" => "Come impostazione predefinita",
    "admin__groups__application_groups__default" => "Predefinito",
    "admin__groups__application_groups__delete_err" => "Impossibile eliminare il gruppo",
];