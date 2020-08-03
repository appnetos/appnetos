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
 * @description     Multilingual Navbar to create extended navigation menus on base of bootstrap Navbar.
 */

// Strings.
$strings = [
    "appnetos__navbar__header" => "Navbar",
    "appnetos__navbar__add_menu" => "Ajouter un menu",
    "appnetos__navbar__settings" => "Réglages",
    "appnetos__navbar__confirm" => "Confirmer",
    "appnetos__navbar__close" => "Fermer",
    "appnetos__navbar__sign_up" => "Lien vers la page d'inscription. URL ou ID URI. Laissez ce champ vide si aucun lien vers la page d'inscription ne doit être utilisé.",
    "appnetos__navbar__forget_pass" => "Lien vers la page de mot de passe oublié. URL ou ID URI. Laissez ce champ vide si aucun lien vers la page de mot de passe oublié ne doit être utilisé.",
    "appnetos__navbar__sign_up_link" => "Lien vers la page d'inscription",
    "appnetos__navbar__forget_pass_link" => "Lien vers la page de passe oublié",
    "appnetos__navbar__info" => "La barre de navigation de APPNET OS facilite la création d'un menu multilingue et la connexion d'un utilisateur. Dans les paramètres, vous pouvez spécifier si l'application est émise et si l'utilisation des conditions d'utilisation doit être utilisée dans l'application. Vous pouvez créer des menus et sous-menus générés sous forme de menus déroulants. La zone fournit toujours un champ de saisie pour toutes les langues actives. Le champ global est toujours émis s'il n'y a pas de traduction pour la langue. Utilisez une URL ou un ID URI pour le lien. Laissez le champ vide si vous ne souhaitez pas utiliser de lien.",
    "appnetos__navbar__menus" => "Menus de la barre de navigation",
    "appnetos__navbar__logon_header" => "se connecter",
    "appnetos__navbar__logon_sign_in" => "Utiliser la connexion",
    "appnetos__navbar__sign_up_header" => "S'inscrire",
    "appnetos__navbar__settings_conf" => "Les paramètres ont été appliqués",
    "appnetos__navbar__settings_err_seo" => "Mauvais ID URI",
    "appnetos__navbar__settings_err" => "Les paramètres n'ont pas pu être appliqués",
    "appnetos__navbar__add_name" => "prénom",
    "appnetos__navbar__add_link" => "Lien",
    "appnetos__navbar__add" => "Ajouter",
    "appnetos__navbar__add_info" => "Créez un nouvel élément de menu global. Utilisez une URL ou un ID URI pour le lien. Laissez le champ vide si vous ne souhaitez pas utiliser de lien.",
    "appnetos__navbar__add_err_name" => "S'il vous plaît entrer un nom",
    "appnetos__navbar__add_conf" => "L'élément de menu a été ajouté",
    "appnetos__navbar__main_menu" => "Menu principal",
    "appnetos__navbar__sub_menu" => "Sous menu",
    "appnetos__navbar__global" => "Global",
    "appnetos__navbar__delete" => "Effacer",
    "appnetos__navbar__add_sub" => "Ajouter un sous-menu",
    "appnetos__navbar___no_name" => "{sans nom}",
    "appnetos__navbar___no_link" => "{pas de lien}",
    "appnetos__navbar___global" => "{global}",
    "appnetos__navbar__apply" => "Appliquer les modifications",
    "appnetos__navbar__delete_info" => "Voulez-vous supprimer définitivement le menu avec tous les sous-menus?",
    "appnetos__navbar__delete_conf" => "Les éléments de menu ont été supprimés",
    "appnetos__navbar__delete_err" => "Les éléments de menu ne peuvent pas être supprimés",
    "appnetos__navbar__apply_conf" => "Les changements ont été appliqués",
    "appnetos__navbar__move_conf" => "Les éléments de menu ont été déplacés",
    "appnetos__navbar__move_err" => "Les éléments de menu ne peuvent pas être déplacés",
    "appnetos__navbar__design_header" => "Conception",
    "appnetos__navbar__design_dark" => "Foncé",
    "appnetos__navbar__design_light" => "Lumière",
    "appnetos__navbar__design_home" => "Utiliser le bouton d'accueil",
    "appnetos__navbar__no_entries" => "Pas encore de logo disponible",
    "appnetos__navbar__license" => "Cette application est disponible pour l'utilisation privée et commerciale librement disponible. Les textes de l'application sont traduits automatiquement. xtrose Media Studio n'assume aucune responsabilité pour le contenu de l'application. Le contenu de l'application peut être par l'utilisateur à sera ajusté. Aidez à améliorer cette application et envoyez-nous vos fichiers de traduction dans votre langue. Merci beaucoup.",
];