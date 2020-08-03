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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Language strings.
$strings = [
    "admin__apps__settings__css_conf" => "CSS a été sauvé",
    "admin__apps__settings__js_conf" => "JavaScript a été enregistré",
    "admin__apps__settings__css_err" => "CSS n'a pas pu être sauvé",
    "admin__apps__settings__js_err" => "JavaScript n'a pas pu être enregistré",
    "admin__apps__settings__warning" => "Soyez prudent lors de l'édition. Les modifications peuvent modifier le comportement de l'application d'une manière durable. Des modifications incorrectes peuvent détruire l'application, la sortie et les fonctionnalités.",
    "admin__apps__settings__css_info" => "Dans l'éditeur CSS, le fichier CSS de l'application peut être modifié. Le fichier CSS de l'application est stocké dans le répertoire de l'application. Ce fichier CSS est automatiquement chargé avec l'application. Si une application n'a pas de fichier CSS, une nouvelle application est créée. Si le cache est actif, il doit être vidé pour appliquer les modifications.",
    "admin__apps__settings__js_info" => "Dans l'éditeur JavaScript, le fichier JavaScript de l'application peut être modifié. Le fichier JavaScript de l'application est stocké dans le répertoire de l'application. Ce fichier JavaScript est automatiquement chargé avec l'application. Si une application n'a pas de fichier JavaScript, une nouvelle application est créée. Si le cache est actif, il doit être vidé pour appliquer les modifications.",
    "admin__apps__settings__data_err" => "Les données n'ont pas pu être sauvegardées",
    "admin__apps__settings__data_conf" => "Les données ont été enregistrées",
    "admin__apps__settings__size_err" => "La taille et l'orientation n'auraient pas pu être sauvées",
    "admin__apps__settings__size_conf" => "La taille et l'orientation ont été sauvées",
    "admin__apps__settings__header_col_xl" => "Mise en page de l'application pour la largeur de l'écran 1200px",
    "admin__apps__settings__header_col_lg" => "Mise en page de l'application pour la largeur de l'écran 992-1200px",
    "admin__apps__settings__header_col_md" => "Mise en page de l'application pour la largeur de l'écran 720-992px",
    "admin__apps__settings__header_col_sm" => "Mise en page de l'application pour la largeur de l'écran 576-720px",
    "admin__apps__settings__header_col" => "Mise en page de l'application pour la largeur de l'écran <576px",
    "admin__apps__settings__grid_css" => "Bootstrap Grid CSS",
    "admin__apps__settings__size_info" => "Pour les applications conteneur, la taille et l'orientation peuvent être modifiées. Si une application de conteneur n'ajuste pas la taille et l'orientation, elle sera sortie en pleine largeur. APPNET OS utilise Bootstrap et le Bootstrap Grid System pour ses conteneurs. Le système de grille utilise 5 tailles d'appareils. Chaque taille est divisée en 12 parties. La taille et l'orientation des applications conteneur peuvent être définies par ces parties. Si vous placez deux applications conteneurs les unes avec les autres et définissez la taille avec 6 parties chacune, les applications sont sorties côte à côte en deux parties égales. Si vous définissez la première application dans un conteneur avec 4 parties et la seconde avec 8 parties, l'application droite est sortie deux fois plus grande que l'application de gauche. Si trois applications sont définies dans un conteneur de 4 parties chacune, les trois applications sont sorties côte à côte, dans la même taille. Si vous définissez 12 parties pour la première application et 6 parties pour les deux suivantes, la première application sera sortie en pleine largeur et les deux suivantes, y compris avec la moitié de la largeur. Si les applications sont correctement définies pour chaque taille d'appareil, vous obtenez une conception réactive parfaite.",
    "admin__apps__settings__data_info" => "Si une application dispose d'une zone d'administration, elle peut être consultée via les paramètres. Les applications peuvent également être chargées dans des conteneurs avec d'autres applications. Cette application est appelée applications conteneur. Les applications container peuvent ajuster leur taille et leur orientation. Par exemple, si deux applications sont chargées dans un conteneur et que la taille est fixée à 50 % pour chaque application, elles sont de sortie côte à côte. Des étiquettes CSS peuvent également être ajoutées au conteneur. Cela permet d'influencer l'apparence d'un conteneur avec plusieurs applications. Attention, si plusieurs applications sont chargées dans un conteneur et que plusieurs applications personnalisent le conteneur CSS, toutes les balises CSS sont ajoutées au conteneur. App CSS vous permet d'ajouter des balises CSS à chaque application dans un conteneur. En mode expert, vous pouvez même modifier le CSS et JavaScript d'une application. Ce mode doit être déverrouillé dans le config.inc.php. Mais attention. Si le CSS ou JavaScript est modifié en mode expert, les applications ou même toute la page peuvent être mutilées ou détruites de façon permanente.",
    "admin__apps__settings__menu_header" => "Paramètres de l'application",
    "admin__apps__settings__admin_area" => "Zone d'administration",
    "admin__apps__settings__description" => "description",
    "admin__apps__settings__size_and_align" => "Taille et orientation",
    "admin__apps__settings__css_container_fluid" => "CSS container-fluid",
    "admin__apps__settings__css_container" => "Container CSS",
    "admin__apps__settings__css_app" => "Application CSS",
    "admin__apps__settings__edit_css" => "Modifier le CSS",
    "admin__apps__settings__edit_js" => "Modifier JavaScript",
    "admin__apps__settings__management" => "Gestion d'applications",
    "admin__apps__settings__app_data" => "Données d'application",
    "admin__apps__settings__activate" => "déclencher",
    "admin__apps__settings__deactivate" => "désactiver",
    "admin__apps__settings__activated" => "Activé",
    "admin__apps__settings__deactivated" => "handicapé",
    "admin__apps__settings__no_description" => "Aucune description",
    "admin__apps__settings__app_id" => "ID app",
    "admin__apps__settings__properties" => "Propriétés",
    "admin__apps__settings__frontend" => "Frontend",
    "admin__apps__settings__no_content" => "Aucun contenu",
    "admin__apps__settings__static" => "Statique",
    "admin__apps__settings__not_static" => "Non statique",
    "admin__apps__settings__size" => "Taille et orientation",
    "admin__apps__settings__no_container_css" => "Aucun container CSS",
    "admin__apps__settings__no_container_fluid_css" => "Aucun container-fluid CSS",
    "admin__apps__settings__no_app_css" => "Aucun application CSS",
    "admin__apps__settings__container_fluid" => "container-fluide",
    "admin__apps__settings__container" => "container",
    "admin__apps__settings__apps" => "Apps",
    "admin__apps__settings__save" => "Sauver",
    "admin__apps__settings__cache" => "Utilisez le cache de l'application",
    "admin__apps__settings__js_cache" => "Utiliser le cache JavaScript",
    "admin__apps__settings__css_cache" => "Utiliser le cache CSS",
];