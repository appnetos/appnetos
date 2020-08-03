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
 * @description     Admin language management.
 */

// Language strings.
$strings = [
    "admin__settings__manage_language__info" => "Liste de toutes les langues utilisées par APPNETOS. Les langues sélectionnées ici seront utilisées. La langue utilisée par l'utilisateur est définie par le navigateur, mais peut être modifiée par le cookie de langue. La langue est définie par une clé et une sous-clé. Les fichiers de langue des applications sont sélectionnés par cette clé. Les fichiers de langue d'une application sont stockés dans l'application dans le répertoire des chaînes. Chaque application possède un fichier de langue global appelé global.php. Ceci est chargé chaque fois qu'un fichier de langue demandé ne peut pas être chargé. Si un fichier de langue avec une sous-clé est demandé et n'existe pas, le fichier de langue de la clé principale est tenté de se charger. S'il n'existe pas, la langue standard définie sera chargée. S'il n'existe pas non plus, le fichier de langue global sera chargé. L'ordre de chargement des fichiers de langue dans un exemple. en-US -> fr -> Standard -> Global",
    "admin__settings__manage_language__remove" => "Supprimer la langue",
    "admin__settings__manage_language__remove_info" => "Soyez prudent lorsque vous supprimez les langues. Si une langue est supprimée, les pages ne sont plus publiées dans cette langue. Le contenu par défaut est fourni aux navigateurs vocaux avec cette langue. Aucun langage standard n'est défini, le langage global est utilisé.",
    "admin__settings__manage_language__err_add" => "La langue n'a pas pu être activée",
    "admin__settings__manage_language__err_remove" => "La langue ne peut pas être désactivée",
    "admin__settings__manage_language__conf_remove" => "La langue a été désactivée",
    "admin__settings__manage_language__conf_add" => "La langue a été activée",
    "admin__settings__manage_language__menu_header" => "Gérer les langues",
    "admin__settings__manage_language__search" => "Rechercher",
    "admin__settings__manage_language__language_settings" => "Langage",
    "admin__settings__manage_language__no_languages" => "Aucune langue disponible",
    "admin__settings__manage_language__activate" => "Déclencher",
    "admin__settings__manage_language__deactivate" => "Désactiver",
    "admin__settings__manage_language__properties" => "Propriétés",
    "admin__settings__manage_language__default" => "Manquer à ses engagements",
    "admin__settings__manage_language__activated" => "Activé",
    "admin__settings__manage_language__close" => "Fermer",
];
