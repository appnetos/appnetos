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
 * @description     Admin user groups. Groups can be used to define which administrators can view which areas.
 */

// Language strings.
$strings = [
    "admin__groups__admin_groups__info" => "Les groupes d’administrateurs contrôlent l’accès aux pages pour les utilisateurs de la section administrante. Appeler une page peut être autorisé ou refusé. Si aucune page n’est associée à un groupe, chaque page peut être consultée. Si aucune page autorisée n’est attribuée à un groupe, alors toutes les pages peuvent être appelées, sauf celles qui sont attribuées refusées. Si aucune page refusée n’est attribuée, seules les pages autorisées sont assignables. Il peut également être autorisé et refusé l’accès aux pages en même temps. Les développeurs doivent noter que l’ID URI n’est pas retourné si les URL sont refusées. Les administrateurs qui ne sont pas associés à un groupe n’ont aucune restriction.",
    "admin__groups__admin_groups__menu_header" => "Groupes d’administrateurs",
    "admin__groups__admin_groups__add_group" => "Ajouter le groupe d’administrateurs",
    "admin__groups__admin_groups__search" => "Rechercher",
    "admin__groups__admin_groups__name_up" => "Nom ascendant",
    "admin__groups__admin_groups__name_down" => "Nom descendant",
    "admin__groups__admin_groups__id_up" => "ID ascendant",
    "admin__groups__admin_groups__id_down" => "ID descendant",
    "admin__groups__admin_groups__no_groups" => "Aucun groupe disponible",
    "admin__groups__admin_groups__add" => "Ajouter",
    "admin__groups__admin_groups__name" => "Nom du groupe",
    "admin__groups__admin_groups__close" => "Proche",
    "admin__groups__admin_groups__add_err_name_enter" => "S’il vous plaît entrer un nom de groupe",
    "admin__groups__admin_groups__add_err_name_exists" => "Le nom du groupe est déjà attribué",
    "admin__groups__admin_groups__add_conf" => "Le groupe a été ajouté",
    "admin__groups__admin_groups__delete" => "Supprimer",
    "admin__groups__admin_groups__group_id" => "ID de groupe",
    "admin__groups__admin_groups__denied_uris" => "ITI refusées",
    "admin__groups__admin_groups__granted_uris" => "URIs accordé",
    "admin__groups__admin_groups__all" => "Tous",
    "admin__groups__admin_groups__non" => "Aucun",
    "admin__groups__admin_groups__all_but_denied" => "Tous sauf niés",
    "admin__groups__admin_groups__all_but_granted" => "Tous sauf accordés",
    "admin__groups__admin_groups__information" => "Informations",
    "admin__groups__admin_groups__no_uris" => "Pas d’ITI associées",
    "admin__groups__admin_groups__edit_err" => "Le groupe n’a pas pu être édité",
    "admin__groups__admin_groups__no_uris_err" => "Aucune ITI sélectionnée",
    "admin__groups__admin_groups__add_uri_conf" => "Les ITI ont été ajoutées",
    "admin__groups__admin_groups__home" => "Accueil",
    "admin__groups__admin_groups__remove_uri_conf" => "Les ITI ont été supprimées",
    "admin__groups__admin_groups__remove" => "Retirer",
    "admin__groups__admin_groups__edit" => "Modifier",
    "admin__groups__admin_groups__edit_conf" => "Le groupe a été édité",
    "admin__groups__admin_groups__delete_header" => "Supprimer le groupe d’administrateurs",
    "admin__groups__admin_groups__delete_info" => "Soyez prudent lors de la suppression des groupes d’administrateurs. Les groupes d’administrateurs supprimés ne peuvent pas être récupérés. Les comptes d’administrateur associés au groupe sont attribués au groupe par défaut. Si aucun groupe par défaut n’est défini, ces administrateurs ont un accès complet à n’importe quel contenu.",
    "admin__groups__admin_groups__delete_conf" => "Le groupe a été supprimé",
    "admin__groups__admin_groups__as_default" => "En standard",
    "admin__groups__admin_groups__default" => "Standard",
    "admin__groups__admin_groups__delete_err" => "Le groupe n’a pas pu être supprimé",
];