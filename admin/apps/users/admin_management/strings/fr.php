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
 * @description     Admin overview and management for admin users.
 */

// Language strings.
$strings = [
    "admin__users__admin_management__info" => "La direction de l’administrateur fournit toutes les informations de l’administrateur. Les administrateurs peuvent être verrouillés et déverrouillés. Les mots de passe de l’administrateur peuvent être réaffectés. Les noms d’utilisateur et les adresses e-mail peuvent être modifiés. Les administrateurs ne peuvent être créés que manuellement. Les administrateurs peuvent être affectés à des groupes. Les groupes définissent les droits de chaque région.",
    "admin__users__admin_management__registered_since" => "Enregistré depuis",
    "admin__users__admin_management__last_sign_in" => "Dernière connexion",
    "admin__users__admin_management__active" => "Activement",
    "admin__users__admin_management__not_activated" => "Non activé",
    "admin__users__admin_management__sign_in_error" => "Erreur de connexion",
    "admin__users__admin_management__locked" => "Fermé",
    "admin__users__admin_management__deleted" => "supprimé",
    "admin__users__admin_management__ip_first" => "Enregistrement IP",
    "admin__users__admin_management__ip_last" => "IP dernière connexion",
    "admin__users__admin_management__admin" => "Administrateur",
    "admin__users__admin_management__permissions" => "Autorisations",
    "admin__users__admin_management__edit_header" => "Modifier le compte utilisateur",
    "admin__users__admin_management__edit_info" => "Soyez prudent lorsque vous modifiez des comptes d'utilisateurs. Si le nom d'utilisateur, l'adresse e-mail ou le mot de passe d'un compte est modifié, l'utilisateur ne peut plus se connecter avec ses anciennes données.",
    "admin__users__admin_management__edit_pass" => "Laissez vide pour ne pas changer",
    "admin__users__admin_management__edit_min_user" => "Vérification minimale de l'utilisateur (cochez uniquement si le nom d'utilisateur existe déjà)",
    "admin__users__admin_management__edit_min_pass" => "Vérification du mot de passe minimum (Cochez uniquement si un mot de passe a été saisi)",
    "admin__users__admin_management__edit_err_user_exists" => "Le nom d'utilisateur est déjà pris",
    "admin__users__admin_management__edit_err_user_valid" => "Le nom d'utilisateur n'est pas autorisé",
    "admin__users__admin_management__edit_err_user_usable" => "Le nom d'utilisateur ne peut pas être utilisé",
    "admin__users__admin_management__edit_err_mail_exists" => "L'adresse email est déjà utilisée",
    "admin__users__admin_management__edit_err_mail_valid" => "L'adresse email n'est pas autorisée",
    "admin__users__admin_management__edit_err_pass_valid" => "Le mot de passe n'est pas autorisé",
    "admin__users__admin_management__edit_err_pass_usable" => "Le mot de passe ne peut pas être utilisé",
    "admin__users__admin_management__edit_conf" => "Le compte administrateur a été modifié",
    "admin__users__admin_management__err_activate" => "Le compte administrateur n’a pas pu être activé",
    "admin__users__admin_management__conf_activate" => "Le compte administrateur a été activé",
    "admin__users__admin_management__lock_header" => "Verrouillage du compte administrateur",
    "admin__users__admin_management__lock_info" => "Soyez prudent lors du verrouillage des comptes de l’administrateur. Les administrateurs dont les comptes sont verrouillés ne peuvent plus se connecter.",
    "admin__users__admin_management__delete_header" => "Supprimer le compte d'utilisateur",
    "admin__users__admin_management__delete_info" => "Soyez prudent lors de la suppression des comptes d’administrateur. Les comptes de l’administrateur sont toujours supprimés du système. Ils ne peuvent pas être récupérés.",
    "admin__users__admin_management__permissions_header" => "Autorisations",
    "admin__users__admin_management__permissions_info" => "Soyez prudent lorsque vous attribuez des autorisations d'administrateur. Les utilisateurs dotés de privilèges d'administrateur peuvent se connecter à la section admin et modifier la page avec leur contenu.",
    "admin__users__admin_management__conf_lock" => "Le compte administrateur a été suspendu",
    "admin__users__admin_management__err_lock" => "Le compte administrateur n’a pas pu être verrouillé",
    "admin__users__admin_management__conf_delete" => "Le compte administrateur a été supprimé",
    "admin__users__admin_management__err_delete" => "Le compte administrateur n’a pas pu être supprimé",
    "admin__users__admin_management__conf_permissions" => "Les permissions ont été changées",
    "admin__users__admin_management__err_permissions" => "Les permissions n'ont pas pu être changées",
    "admin__users__admin_management__del_from_system" => "Supprimer l'utilisateur du système",
    "admin__users__admin_management__err_pass" => "Le mot de passe est faux",
    "admin__users__admin_management__add_user" => "Ajouter l’administrateur",
    "admin__users__admin_management__add_err_user_enter" => "S'il vous plaît entrer un nom d'utilisateur",
    "admin__users__admin_management__add_err_user_valid" => "Le nom d'utilisateur n'est pas autorisé",
    "admin__users__admin_management__add_err_user_exists" => "Le nom d'utilisateur est déjà pris",
    "admin__users__admin_management__add_err_user_usable" => "Le nom d'utilisateur ne peut pas être utilisé",
    "admin__users__admin_management__add_err_pass_enter" => "S'il vous plaît entrer un mot de passe",
    "admin__users__admin_management__add_err_pass_compare" => "Le mot de passe et la répétition du mot de passe ne sont pas identiques",
    "admin__users__admin_management__add_err_pass_valid" => "Le mot de passe n'est pas autorisé",
    "admin__users__admin_management__add_err_pass_usable" => "Le mot de passe ne peut pas être utilisé",
    "admin__users__admin_management__add_err_mail_enter" => "S'il vous plaît entrer une adresse email",
    "admin__users__admin_management__add_err_mail_valid" => "L'email n'est pas autorisé",
    "admin__users__admin_management__add_err_mail_exists" => "L'adresse email est déjà utilisée",
    "admin__users__admin_management__add_conf" => "Le compte utilisateur a été ajouté",
    "admin__users__admin_management__add_err" => "Le compte d'utilisateur n'a pas pu être ajouté",
    "admin__users__admin_management__search_registered" => "Relié",
    "admin__users__admin_management__search_active" => "Activement",
    "admin__users__admin_management__search_unactive" => "De dormance",
    "admin__users__admin_management__search_locked" => "Fermé",
    "admin__users__admin_management__search_deleted" => "Supprimé",
    "admin__users__admin_management__search_all" => "Tous",
    "admin__users__admin_management__restore_conf" => "Le compte d'utilisateur a été restauré",
    "admin__users__admin_management__restore_err" => "Le compte d'utilisateur n'a pas pu être restauré",
    "admin__users__admin_management__menu_header" => "Gestion de l’administration",
    "admin__users__admin_management__search" => "Rechercher",
    "admin__users__admin_management__delete" => "Supprimer",
    "admin__users__admin_management__user_id" => "ID administrateur",
    "admin__users__admin_management__properties" => "Propriétés",
    "admin__users__admin_management__edit" => "Réviser",
    "admin__users__admin_management__information" => "Renseignements",
    "admin__users__admin_management__user" => "Nom d'utilisateur",
    "admin__users__admin_management__mail" => "Courriel",
    "admin__users__admin_management__pass" => "Mot de passe",
    "admin__users__admin_management__save" => "Sauver",
    "admin__users__admin_management__pass_info" => "Laisser vide pour ne pas changer",
    "admin__users__admin_management__ip_sign_up" => "IP lors de l'enregistrement",
    "admin__users__admin_management__ip_sign_in" => "IP à l'enregistrement dernier",
    "admin__users__admin_management__activate" => "Déclencher",
    "admin__users__admin_management__deactivate" => "Désactiver",
    "admin__users__admin_management__lock" => "Fermer à clé",
    "admin__users__admin_management__restore" => "Redonner",
    "admin__users__admin_management__account_type" => "Type de compte",
    "admin__users__admin_management__standard" => "Standard",
    "admin__users__admin_management__sign_in_count" => "Nombre de connexions",
    "admin__users__admin_management__no_users" => "Aucun administrateur présent",
    "admin__users__admin_management__admin_button" => "Administrateur",
    "admin__users__admin_management__search_admin" => "Administrateur",
    "admin__users__admin_management__close" => "Aermer",
    "admin__users__admin_management__edit_err" => "L’administrateur n’a pas pu être modifié",
    "admin__users__admin_management__add" => "Ajouter",
    "admin__users__admin_management_username_up" => "Nom d'utilisateur croissant",
    "admin__users__admin_management_username_down" => "Nom d'utilisateur décroissant",
    "admin__users__admin_management__mail_up" => "Adresse e-mail croissante",
    "admin__users__admin_management__mail_down" => "Adresse email décroissante",
    "admin__users__admin_management__ts_first_up" => "Date d'inscription croissante",
    "admin__users__admin_management__ts_first_down" => "Inscription données décroissantes",
    "admin__users__admin_management__id_up" => "ID ascendant",
    "admin__users__admin_management__id_down" => "ID décroissant",
    "admin__users__admin_management__admin_group" => "Groupe d’administrateurs",
    "admin__users__admin_management__group_id" => "ID de groupe",
    "admin__users__admin_management__none" => "Aucun",
    "admin__users__admin_management__edit_err_group_valid" => "Le groupe d’administrateurs n’existe pas",
    "admin__users__admin_management__image" => "Image",
    "admin__users__admin_management__delete_image" => "Supprimer l’image",
    "admin__users__admin_management__edit_err_img_type" => "Format d’image incorrect",
    "admin__users__admin_management__edit_err_img_size" => "Le fichier d’image est trop grand",
];