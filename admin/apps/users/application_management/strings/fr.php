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
    "admin__users__application_management__info" => "Toutes les informations provenant d’utilisateurs enregistrés peuvent être consultées dans la gestion des utilisateurs. Les comptes d’utilisateurs peuvent être verrouillés et déverrouillés. Les mots de passe peuvent être réaffectés par les utilisateurs. Si l’activation par e-mail des comptes est active, les comptes qui n’ont pas été activés peuvent être activés ou supprimés. Les noms d’utilisateur et les adresses e-mail peuvent être modifiés. Les groupes peuvent être affectés aux utilisateurs. Les groupes d’utilisateurs définissent les zones que les utilisateurs sont autorisés à afficher.",
    "admin__users__application_management__registered_since" => "Enregistré depuis",
    "admin__users__application_management__last_sign_in" => "Dernière connexion",
    "admin__users__application_management__active" => "Activement",
    "admin__users__application_management__not_activated" => "Non activé",
    "admin__users__application_management__sign_in_error" => "Erreur de connexion",
    "admin__users__application_management__locked" => "Fermé",
    "admin__users__application_management__deleted" => "supprimé",
    "admin__users__application_management__ip_first" => "Enregistrement IP",
    "admin__users__application_management__ip_last" => "IP dernière connexion",
    "admin__users__application_management__admin" => "Administrateur",
    "admin__users__application_management__permissions" => "Autorisations",
    "admin__users__application_management__edit_header" => "Modifier le compte utilisateur",
    "admin__users__application_management__edit_info" => "Soyez prudent lorsque vous modifiez des comptes d'utilisateurs. Si le nom d'utilisateur, l'adresse e-mail ou le mot de passe d'un compte est modifié, l'utilisateur ne peut plus se connecter avec ses anciennes données.",
    "admin__users__application_management__edit_pass" => "Laissez vide pour ne pas changer",
    "admin__users__application_management__edit_min_user" => "Vérification minimale de l'utilisateur (cochez uniquement si le nom d'utilisateur existe déjà)",
    "admin__users__application_management__edit_min_pass" => "Vérification du mot de passe minimum (Cochez uniquement si un mot de passe a été saisi)",
    "admin__users__application_management__edit_err_user_exists" => "Le nom d'utilisateur est déjà pris",
    "admin__users__application_management__edit_err_user_valid" => "Le nom d'utilisateur n'est pas autorisé",
    "admin__users__application_management__edit_err_user_usable" => "Le nom d'utilisateur ne peut pas être utilisé",
    "admin__users__application_management__edit_err_mail_exists" => "L'adresse email est déjà utilisée",
    "admin__users__application_management__edit_err_mail_valid" => "L'adresse email n'est pas autorisée",
    "admin__users__application_management__edit_err_pass_valid" => "Le mot de passe n'est pas autorisé",
    "admin__users__application_management__edit_err_pass_usable" => "Le mot de passe ne peut pas être utilisé",
    "admin__users__application_management__edit_conf" => "Le compte utilisateur a été modifié",
    "admin__users__application_management__err_activate" => "Le compte d'utilisateur n'a pas pu être activé",
    "admin__users__application_management__conf_activate" => "Le compte utilisateur a été activé",
    "admin__users__application_management__lock_header" => "Verrouiller le compte utilisateur",
    "admin__users__application_management__lock_info" => "Faites attention lorsque vous verrouillez des comptes d'utilisateurs. Les utilisateurs avec des comptes verrouillés ne peuvent plus se connecter.",
    "admin__users__application_management__delete_header" => "Supprimer le compte d'utilisateur",
    "admin__users__application_management__delete_info" => "Faites attention lorsque vous supprimez des comptes d'utilisateurs. Si un compte d'utilisateur est supprimé, l'utilisateur ne peut plus se connecter, mais il peut être réactivé. Si un utilisateur est supprimé du système, toutes ses données sont supprimées de la base de données et le compte ne peut pas être récupéré.",
    "admin__users__application_management__permissions_header" => "Autorisations",
    "admin__users__application_management__permissions_info" => "Soyez prudent lorsque vous attribuez des autorisations d'administrateur. Les utilisateurs dotés de privilèges d'administrateur peuvent se connecter à la section admin et modifier la page avec leur contenu.",
    "admin__users__application_management__conf_lock" => "Le compte d'utilisateur a été verrouillé",
    "admin__users__application_management__err_lock" => "Le compte d'utilisateur n'a pas pu être verrouillé",
    "admin__users__application_management__conf_delete" => "Le compte utilisateur a été supprimé",
    "admin__users__application_management__err_delete" => "Le compte d'utilisateur n'a pas pu être supprimé",
    "admin__users__application_management__conf_permissions" => "Les permissions ont été changées",
    "admin__users__application_management__err_permissions" => "Les permissions n'ont pas pu être changées",
    "admin__users__application_management__del_from_system" => "Supprimer l'utilisateur du système",
    "admin__users__application_management__err_pass" => "Le mot de passe est faux",
    "admin__users__application_management__add_user" => "Ajouter des utilisateurs",
    "admin__users__application_management__add_err_user_enter" => "S'il vous plaît entrer un nom d'utilisateur",
    "admin__users__application_management__add_err_user_valid" => "Le nom d'utilisateur n'est pas autorisé",
    "admin__users__application_management__add_err_user_exists" => "Le nom d'utilisateur est déjà pris",
    "admin__users__application_management__add_err_user_usable" => "Le nom d'utilisateur ne peut pas être utilisé",
    "admin__users__application_management__add_err_pass_enter" => "S'il vous plaît entrer un mot de passe",
    "admin__users__application_management__add_err_pass_compare" => "Le mot de passe et la répétition du mot de passe ne sont pas identiques",
    "admin__users__application_management__add_err_pass_valid" => "Le mot de passe n'est pas autorisé",
    "admin__users__application_management__add_err_pass_usable" => "Le mot de passe ne peut pas être utilisé",
    "admin__users__application_management__add_err_mail_enter" => "S'il vous plaît entrer une adresse email",
    "admin__users__application_management__add_err_mail_valid" => "L'email n'est pas autorisé",
    "admin__users__application_management__add_err_mail_exists" => "L'adresse email est déjà utilisée",
    "admin__users__application_management__add_conf" => "Le compte utilisateur a été ajouté",
    "admin__users__application_management__add_err" => "Le compte d'utilisateur n'a pas pu être ajouté",
    "admin__users__application_management__search_registered" => "Relié",
    "admin__users__application_management__search_active" => "Activement",
    "admin__users__application_management__search_unactive" => "De dormance",
    "admin__users__application_management__search_locked" => "Fermé",
    "admin__users__application_management__search_deleted" => "Supprimé",
    "admin__users__application_management__search_all" => "Tous",
    "admin__users__application_management__restore_conf" => "Le compte d'utilisateur a été restauré",
    "admin__users__application_management__restore_err" => "Le compte d'utilisateur n'a pas pu être restauré",
    "admin__users__application_management__menu_header" => "Gestion des utilisateurs",
    "admin__users__application_management__search" => "Rechercher",
    "admin__users__application_management__delete" => "Supprimer",
    "admin__users__application_management__user_id" => "ID utilisateur",
    "admin__users__application_management__properties" => "Propriétés",
    "admin__users__application_management__edit" => "Réviser",
    "admin__users__application_management__information" => "Renseignements",
    "admin__users__application_management__user" => "Nom d'utilisateur",
    "admin__users__application_management__mail" => "Courriel",
    "admin__users__application_management__pass" => "Mot de passe",
    "admin__users__application_management__save" => "Sauver",
    "admin__users__application_management__pass_info" => "Laisser vide pour ne pas changer",
    "admin__users__application_management__ip_sign_up" => "IP lors de l'enregistrement",
    "admin__users__application_management__ip_sign_in" => "IP à l'enregistrement dernier",
    "admin__users__application_management__activate" => "Déclencher",
    "admin__users__application_management__deactivate" => "Désactiver",
    "admin__users__application_management__lock" => "Fermer à clé",
    "admin__users__application_management__restore" => "Redonner",
    "admin__users__application_management__account_type" => "Type de compte",
    "admin__users__application_management__standard" => "Standard",
    "admin__users__application_management__sign_in_count" => "Nombre de connexions",
    "admin__users__application_management__no_users" => "Aucun utilisateur présent",
    "admin__users__application_management__admin_button" => "Administrateur",
    "admin__users__application_management__search_admin" => "Administrateur",
    "admin__users__application_management__close" => "Aermer",
    "admin__users__application_management__edit_err" => "L'utilisateur n'a pas pu être édité",
    "admin__users__application_management__add" => "Ajouter",
    "admin__users__application_management_username_up" => "Nom d'utilisateur croissant",
    "admin__users__application_management_username_down" => "Nom d'utilisateur décroissant",
    "admin__users__application_management__mail_up" => "Adresse e-mail croissante",
    "admin__users__application_management__mail_down" => "Adresse email décroissante",
    "admin__users__application_management__ts_first_up" => "Date d'inscription croissante",
    "admin__users__application_management__ts_first_down" => "Inscription données décroissantes",
    "admin__users__application_management__id_up" => "ID ascendant",
    "admin__users__application_management__id_down" => "ID décroissant",
    "admin__users__application_management__user_group" => "Groupe d’utilisateurs",
    "admin__users__application_management__group_id" => "ID de groupe",
    "admin__users__application_management__none" => "Aucun",
    "admin__users__application_management__edit_err_group_valid" => "Le groupe d’utilisateurs n’existe pas",
    "admin__users__application_management__image" => "Image",
    "admin__users__application_management__delete_image" => "Supprimer l’image",
    "admin__users__application_management__edit_err_img_type" => "Format d’image incorrect",
    "admin__users__application_management__edit_err_img_size" => "Le fichier d’image est trop grand",
];