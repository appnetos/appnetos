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
 * @description     Admin app overview and app management.
 */

// Language strings.
$strings = [
    "admin__apps__management__conf_deactivate" => "L'application a été désactivée",
    "admin__apps__management__conf_activate" => "L'application a été activée",
    "admin__apps__management__err_activate" => "L'application n'a pas pu être activée ou désactivée",
    "admin__apps__management__conf_remove" => "L'application a été supprimée",
    "admin__apps__management__err_remove" => "L'application n'a pas pu être supprimée",
    "admin__apps__management__info" => "APPNET OS utilise des applications pour créer des pages Web à partir d’elles. La gestion des applications répertorie toutes les applications installées. Les applications peuvent être attribuées à des pages individuelles dans la gestion du référencement. Les applications statiques peuvent également être définies en haut et les applications statiques en bas. Ceux-ci sont ensuite disposés dans chaque page en haut ou en bas. Les applications peuvent également inclure une zone d'administration. La zone d'administration est accessible via les paramètres de l'application. Les événements permettent aux développeurs d'attribuer des actions spécifiques aux applications. Ces événements seront organisés sous l'événement approprié. Cela permet aux applications d'installer, de dupliquer, de réinitialiser, de supprimer et de supprimer l'application. Il peut également y avoir des événements qui se produisent lorsque vous activez ou désactivez.",
    "admin__apps__management__deactivate_header" => "Désactiver l'application",
    "admin__apps__management__deactivate_info" => "Les applications désactivées ne sont pas publiées. Cette fonctionnalité est utile lors de la modification du contenu de l'application. Aucune donnée n'est perdue lorsque les applications sont désactivées et elles peuvent être réactivées à tout moment.",
    "admin__apps__management__remove_header" => "Supprimer l'application",
    "admin__apps__management__remove_info" => "Soyez prudent lorsque vous supprimez des applications. L'application est supprimée de la base de données d'applications. Le répertoire de l'application et la table de la base de données restent en place et doivent être supprimés manuellement. Les données ne sont pas perdues. Cependant, les applications avec des tables de base de données sont difficiles à récupérer.",
    "admin__apps__management__delete_header" => "Supprimer l'application",
    "admin__apps__management__delete_info" => "Soyez prudent lorsque vous supprimez des applications. L'application est supprimée de la base de données d'application et le script d'application est exécuté pour supprimer l'application. Toutes les tables de base de données de l'application sont supprimées. Les données ne peuvent pas être récupérées et seront perdues pour toujours.",
    "admin__apps__management__conf_delete" => "L'application a été supprimée",
    "admin__apps__management__err_delete" => "L'application n'a pas pu être supprimée",
    "admin__apps__management__err_description" => "La description n'a pas pu être changée",
    "admin__apps__management__conf_description" => "La description a été changée",
    "admin__apps__management__err_duplicate" => "L'application n'a pas pu être dupliquée",
    "admin__apps__management__conf_duplicate" => "L'application a été dupliquée",
    "admin__apps__management__directory" => "Chemin vers l'application",
    "admin__apps__management__reset_header" => "Réinitialiser l'application",
    "admin__apps__management__reset_info" => "Soyez prudent lorsque vous réinitialisez des applications. Ici, le script d'application est exécuté pour être réinitialisé. Toutes les tables de base de données de l'application sont vidées. Les données ne peuvent pas être récupérées et seront perdues pour toujours.",
    "admin__apps__management__err_reset" => "L'application n'a pas pu être réinitialisée",
    "admin__apps__management__conf_reset" => "L'application a été réinitialisée",
    "admin__apps__management__description_info" => "Rendre plusieurs applications plus reconnaissables en leur ajoutant une description.",
    "admin__apps__management__edit_styles" => "Editer les styles",
    "admin__apps__management__duplicate" => "Double",
    "admin__apps__management__reset" => "Réinitialiser",
    "admin__apps__management__install" => "Installer",
    "admin__apps__management__activate" => "Déclencher",
    "admin__apps__management__deactivate" => "Estropier",
    "admin__apps__management__delete" => "Supprimer",
    "admin__apps__management__remove" => "Enlever",
    "admin__apps__management__revert" => "Réinitialiser",
    "admin__apps__management__id_up" => "ID ascendant",
    "admin__apps__management__id_down" => "ID descendant",
    "admin__apps__management__name_up" => "Nom ascendant",
    "admin__apps__management__name_down" => "Nom descendant",
    "admin__apps__management__description_up" => "Description ascendante",
    "admin__apps__management__description_down" => "Description descendant",
    "admin__apps__management__description" => "Description",
    "admin__apps__management__settings" => "Paramètres",
    "admin__apps__management__search" => "Rechercher",
    "admin__apps__management__menu_header" => "Gestion d'applications",
    "admin__apps__management__no_apps" => "Aucune application disponible",
    "admin__apps__management__events" => "Événements",
    "admin__apps__management__no_events" => "Aucun événement",
    "admin__apps__management__admin" => "Zone d'administration",
    "admin__apps__management__activated" => "Déclencher",
    "admin__apps__management__deactivated" => "Désactiver",
    "admin__apps__management__no_description" => "Aucune description",
    "admin__apps__management__app_id" => "App ID",
    "admin__apps__management__properties" => "Propriétés",
    "admin__apps__management__license" => "Accorder une licence à",
    "admin__apps__management__no_content" => "Aucun contenu",
    "admin__apps__management__frontend" => "Frontend",
    "admin__apps__management__admin_area" => "Zone d'administration",
    "admin__apps__management__static" => "Statique",
    "admin__apps__management__not_static" => "Non statique",
    "admin__apps__management__size" => "Taille et orientation",
    "admin__apps__management__container_css" => "CSS container",
    "admin__apps__management__app_css" => "CSS Application",
    "admin__apps__management__no_container_css" => "Aucun conteneur CSS",
    "admin__apps__management__no_app_css" => "Aucun application CSS",
    "admin__apps__management__no_store_license" => "Aucune information de licence disponible",
    "admin__apps__management__no_store_description" => "Aucune description disponible",
    "admin__apps__management__close" => "Fermer",
    "admin__apps__management__css_container_fluid" => "CSS container-fluid",
    "admin__apps__management__no_container_fluid_css" => "Aucun container-fluid CSS",
    "admin__apps__management__version" => "Version",
];