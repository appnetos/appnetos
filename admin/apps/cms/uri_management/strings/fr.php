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
 * @description     Admin URI management to add and delete URIs.
 */

// Language strings.
$strings = [
    "admin__cms__uri_management__add" => "Ajouter un URI",
    "admin__cms__uri_management__info" => "Un URI est l'adresse de sous-page d'un site Web. L'URI est attaché à la fin de l'URL définie dans le fichier config.inc.php. Ensemble, ils forment l'URL avec laquelle la page peut être consultée. APPNET OS prend en charge les URI multilingues. C'est un outil puissant. Cela permet de définir un URI de page dans plusieurs langues. Si les liens dans les vues sont accessibles via l'ID URI, l'URI sera ouvert dans la langue appropriée. Dans une vue Smarty, le lien est associé à [{\ $ render-> getUrl (URI ID)}]. En PHP avec echo \ $ render-> getUrl (ID URI). Le support multilingue prend en charge le codage UTF8. Ainsi, à quelques exceptions près, l'URI peut également être produit dans toutes les langues. Si plusieurs URI d'une page ont le même contenu, un nom canonique doit être placé sur l'entrée principale. En conséquence, les moteurs de recherche détectent les URI multilingues avec le même contenu et ne sont pas punis. Il vous donne également la possibilité de définir votre propre titre et favicon pour chaque page. S'ils ne sont pas définis, le favicon est utilisé à partir des paramètres de langue. Les URI nouvellement ajoutés sont toujours globaux. Les langues d'édition de l'URI peuvent être ajoutées à l'URI. La gestion des applications peut définir le contenu.",
    "admin__cms__uri_management__button_apps" => "Gérer les applications",
    "admin__cms__uri_management__add_info" => "Ici, le site Web peut être étendu avec des sous-pages supplémentaires. Si l'URI est vide, un lien vers la page d'index est créé. Les URI doivent être créés sans l'URL définie par le fichier config.inc.php. Les URI ne commencent pas par / un début. Les URI ne peuvent pas contenir les caractères suivants: /?:@=&'\\\"<>#%{}|\\^~[]`. Chaque URI ne peut exister qu'une seule fois.",
    "admin__cms__uri_management__err_add" => "L'entrée n'a pas pu être créée",
    "admin__cms__uri_management__err_add_valid" => "L'URL n'est pas autorisé",
    "admin__cms__uri_management__err_add_favicon" => "Le chemin du fichier vers le favicon n'est pas autorisé",
    "admin__cms__uri_management__err_add_exists" => "Il y a déjà une entrée avec cet URI",
    "admin__cms__uri_management__conf_add" => "L'URI a été ajouté",
    "admin__cms__uri_management__delete_header" => "Supprimer l'URI",
    "admin__cms__uri_management__delete_info" => "Faites attention lorsque vous supprimez des URI. En supprimant un URI, la page n'est plus disponible. La configuration de la page est irrévocablement perdue.",
    "admin__cms__uri_management__err_delete" => "L'entrée n'a pas pu être supprimée",
    "admin__cms__uri_management__conf_delete" => "L'entrée a été supprimée",
    "admin__cms__uri_management__edit_seo" => "Editer l'URI",
    "admin__cms__uri_management__menu_header" => "Gestion de l'URI",
    "admin__cms__uri_management__search" => "Rechercher",
    "admin__cms__uri_management__no_uris" => "Aucune URI disponible",
    "admin__cms__uri_management__home" => "Maison",
    "admin__cms__uri_management__delete" => "Supprimer",
    "admin__cms__uri_management__uri_id" => "URI ID",
    "admin__cms__uri_management__properties" => "Propriétés",
    "admin__cms__uri_management__views" => "Affichage",
    "admin__cms__uri_management__apps" => "Apps",
    "admin__cms__uri_management__languages" => "Traduction",
    "admin__cms__uri_management__title" => "Titre",
    "admin__cms__uri_management__language_settings" => "Langage",
    "admin__cms__uri_management__favicon" => "Favicon",
    "admin__cms__uri_management__uri" => "URI",
    "admin__cms__uri_management__button_add" => "Ajouter",
    "admin__cms__uri_management__close" => "Fermer",
    "admin__cms__uri_management__id_up" => "ID ascendant",
    "admin__cms__uri_management__id_down" => "ID décroissant",
    "admin__cms__uri_management__uri_up" => "URI croissant",
    "admin__cms__uri_management__uri_down" => "URI décroissant",
    "admin__cms__uri_management__title_up" => "Titre croissant",
    "admin__cms__uri_management__title_down" => "Titre décroissant",
];