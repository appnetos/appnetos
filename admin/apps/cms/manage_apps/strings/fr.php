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
 * @description     Admin URI apps management.
 */

// Language strings.
$strings = [
    "admin__cms__manage_apps__conf_add" => "L'application a été ajoutée",
    "admin__cms__manage_apps__err_add" => "L'application n'a pas pu être ajoutée",
    "admin__cms__manage_apps__err_remove" => "L'application n'a pas pu être supprimée",
    "admin__cms__manage_apps__conf_remove" => "L'application a été supprimée",
    "admin__cms__manage_apps__err_move" => "L'application n'a pas pu être déplacée",
    "admin__cms__manage_apps__conf_move" => "L'application a été déplacée",
    "admin__cms__manage_apps__add" => "Ajouter une application",
    "admin__cms__manage_apps__info" => "Dans APPNETOS, le contenu des URI est émis par les applications. Chaque application fait partie de la page. Les applications peuvent également être disponibles plusieurs fois sur une page. Il existe deux types d'application différents. Applications standard et applications conteneur. Les applications standard sont toujours publiées individuellement entre elles. La largeur d'une application standard est toujours de 100%. Une application standard est toujours publiée avec les applications précédentes. L'application suivante sera alors publiée à nouveau sous l'application standard. Les applications de conteneur sont toujours émises avec d'autres applications de conteneur dans un même conteneur. Pour chaque application de conteneur, la taille peut être définie. Si deux applications de conteneur adjacentes sont définies, chacune avec une largeur de 50%, elles seront émises côte à côte. Si trois applications de conteneur sont définies, chacune avec une largeur de 50%, deux applications sont publiées côte à côte et une en dessous. Si les trois applications de conteneur sont définies avec une largeur de 33% chacune, les trois applications sont publiées côte à côte. Les réglages larges peuvent être définis pour quatre largeurs d'affichage. Cela permet aux applications de conteneur d'être disposées côte à côte dans un grand écran et entre elles dans un petit écran. La taille des applications de conteneur peut être définie dans l'application Paramètres.",
    "admin__cms__manage_apps__err" => "L'entrée URI ne peut pas être chargée",
    "admin__cms__manage_apps__not_exists" => "Cette application n'existe plus",
    "admin__cms__manage_apps__menu_header" => "Gestion de l'application URI",
    "admin__cms__manage_apps__edit_uri" => "Modifier URI",
    "admin__cms__manage_apps__uri_management" => "Gestion de l'URI",
    "admin__cms__manage_apps__home" => "Maison",
    "admin__cms__manage_apps__id" => "URI ID",
    "admin__cms__manage_apps__properties" => "Propriétés",
    "admin__cms__manage_apps__views" => "Affichage",
    "admin__cms__manage_apps__apps" => "Apps",
    "admin__cms__manage_apps__languages" => "Traduction",
    "admin__cms__manage_apps__title" => "Titre",
    "admin__cms__manage_apps__favicon" => "Favicon",
    "admin__cms__manage_apps__language_settings" => "Langage",
    "admin__cms__manage_apps__global" => "Iniversal",
    "admin__cms__manage_apps__uri_id" => "URI ID",
    "admin__cms__manage_apps__app_id" => "App ID",
    "admin__cms__manage_apps__activated" => "Activé",
    "admin__cms__manage_apps__deactivated" => "Désactivé",
    "admin__cms__manage_apps__no_description" => "Aucune description",
    "admin__cms__manage_apps__close" => "Fermer",
    "admin__cms__manage_apps__no_content" => "Aucun contenu",
    "admin__cms__manage_apps__frontend" => "Frontend",
    "admin__cms__manage_apps__admin_area" => "Zone d'administration",
    "admin__cms__manage_apps__static" => "Statique",
    "admin__cms__manage_apps__not_static" => "Non statique",
    "admin__cms__manage_apps__size" => "Taille et orientation",
    "admin__cms__manage_apps__container_css" => "CSS container",
    "admin__cms__manage_apps__app_css" => "CSS Application",
    "admin__cms__manage_apps__no_container_css" => "Aucun container CSS",
    "admin__cms__manage_apps__no_app_css" =>  "Aucun application CSS",
    "admin__cms__manage_apps__admin" => "Zone d'administration",
    "admin__cms__manage_apps__css_container_fluid" => "CSS container-fluid",
    "admin__cms__manage_apps__no_container_fluid_css" => "Aucun container-fluid",
    "admin__cms__manage_apps__settings" => "Paramètres",
    "admin__cms__manage_apps__remove" => "Enlever",
    "admin__cms__manage_apps__no_apps" => "Aucune application disponible",
];