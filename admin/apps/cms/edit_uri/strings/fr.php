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
 * @description     Admin edit URI and languages URIs.
 */

// Language strings.
$strings = [
    "admin__cms__edit_uri__add_lang" => "Ajouter une langue",
    "admin__cms__edit_uri__remove_header" => "Supprimer la langue",
    "admin__cms__edit_uri__remove_info" => "Soyez prudent lorsque vous supprimez des URI. Si un URI parlant est supprimé, cette page ne peut plus être atteinte en entrant l'adresse directement. Les liens via l'ID URI sont ensuite transmis à l'URI de la langue par défaut ou à l'URI global.",
    "admin__cms__edit_uri__info" => "La globalisation combinée à des URI multilingues est un outil puissant d’APPNETOS. Cela vous permet de créer une page multilingue à l'aide de moyens simples. Pour chaque page, en fonction de la langue que vous avez définie, vous pouvez modifier le contenu, l’URI parlante, le titre et l’icône Favicon. Bien utilisé, les moteurs de recherche obtiennent une note élevée. Dans une vue Smarty, le lien est associé à [{\ $ render-> getUrl (URI ID)}]. En PHP avec echo getUrl (URI ID). Le support multilingue prend en charge le codage UTF8. Ainsi, à quelques exceptions près, l'URI peut également être produit dans toutes les langues. Si l'URI anglais my-uri et l'URI allemand meine-uri, la page est appelée en anglais sous http://www.appnetos.com/my-uri et en allemand sous http://www.appnetos.com/meine. -uri. Si plusieurs URI d'une page ont le même contenu, un nom canonique doit être placé sur l'entrée principale. En conséquence, les moteurs de recherche détectent les URI multilingues avec le même contenu et ne sont pas punis.",
    "admin__cms__edit_uri__add_info" => "Pour chaque URI, il est possible de définir l'URI du locuteur, le titre et le favicon, en fonction de la langue définie. Pour l'index d'URI, l'URI parlant ne peut pas être défini. Si plusieurs URI d'une page ont le même contenu, un nom canonique doit être placé sur l'entrée principale. En conséquence, les moteurs de recherche détectent les URI multilingues avec le même contenu et ne sont pas punis.",
    "admin__cms__edit_uri__err_load" => "Impossible de charger le contenu",
    "admin__cms__edit_uri__no_lang" => "Pas d'autres langues disponibles",
    "admin__cms__edit_uri__err_add" => "La langue ne peut pas être ajoutée",
    "admin__cms__edit_uri__add_exists" => "Il existe déjà une entrée avec cet URI",
    "admin__cms__edit_uri__conf_add" => "La langue a été ajoutée",
    "admin__cms__edit_uri__not_exists" => "La langue n'existe plus",
    "admin__cms__edit_uri__err_remove" => "L'entrée de langue n'a pas pu être supprimée",
    "admin__cms__edit_uri__conf_remove" => "L'entrée de langue a été supprimée",
    "admin__cms__edit_uri__edit_header" => "Modifier l'entrée",
    "admin__cms__edit_uri__edit_info" => "Soyez prudent lorsque vous modifiez un URI. Si un URI est modifié, cette page ne peut plus être atteinte en entrant l'adresse directement. Les liens vers l'ID URI ne sont pas affectés.",
    "admin__cms__edit_uri__err" => "L'entrée ne peut pas être chargée",
    "admin__cms__edit_uri__err_edit" => "L'entrée n'a pas pu être modifiée",
    "admin__cms__edit_uri__conf_edit" => "L'entrée a été modifiée",
    "admin__cms__edit_uri__err_no_uri" => "Aucun URI entré",
    "admin__cms__edit_uri__err_add_valid" => "L'URL n'est pas autorisé",
    "admin__cms__edit_uri__menu_header" => "Modifier URI",
    "admin__cms__edit_uri__menu_app_management" => "Gestion de l'application URI",
    "admin__cms__edit_uri__menu_uri_management" => "Gestion URI",
    "admin__cms__edit_uri__no_languages" => "Aucune langue disponible",
    "admin__cms__edit_uri__remove" => "Enlever",
    "admin__cms__edit_uri__edit" => "Réviser",
    "admin__cms__edit_uri__id" => "URI ID",
    "admin__cms__edit_uri__properties" => "Propriétés",
    "admin__cms__edit_uri__views" => "Affichage",
    "admin__cms__edit_uri__apps" => "Apps",
    "admin__cms__edit_uri__languages" => "Traduction",
    "admin__cms__edit_uri__language" => "Langage",
    "admin__cms__edit_uri__title" => "Titre",
    "admin__cms__edit_uri__favicon" => "Favicon",
    "admin__cms__edit_uri__language_settings" => "Langage",
    "admin__cms__edit_uri__global" => "Universal",
    "admin__cms__edit_uri__uri" => "URI",
    "admin__cms__edit_uri__canonical" => "ID canonique",
    "admin__cms__edit_uri__no_canonical" => "Pas d'ID canonique",
    "admin__cms__edit_uri__save" => "Sauver",
    "admin__cms__edit_uri__close" => "Fermer",
    "admin__cms__edit_uri__add" => "Ajouter",
    "admin__cms__edit_uri__home_info" => "Les langues ne peuvent pas être ajoutées à la page d'accueil",
    "admin__cms__edit_uri__home" => "Maison",
    "admin__cms__edit_uri__meta_delete" => "Supprimer",
    "admin__cms__edit_uri__clear" => "Réinitialiser",
    "admin__cms__edit_uri__name" => "Nom",
    "admin__cms__edit_uri__content" => "Contenu",
    "admin__cms__edit_uri__meta_title" => "Titre pour les moteurs de recherche. Maximum 70 caractères.",
    "admin__cms__edit_uri__meta_description" => "Description des moteurs de recherche. Maximum 320 caractères.",
    "admin__cms__edit_uri__meta_keywords" => "Mots-clés pour les moteurs de recherche. Jusqu’à 5 mots clés séparés par des espaces.",
];
