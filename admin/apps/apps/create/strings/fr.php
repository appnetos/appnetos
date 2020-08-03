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
 * @description     Admin app creator to build apps.
 */

// Language strings.
$strings = [
    "admin__apps__create__dev_header" => "Application développeur",
    "admin__apps__create__info" => "De nouvelles applications peuvent être générées dans cette zone. Des applications HTML multilingues ou des applications de développement avancées peuvent être générées. Les applications HTML sont basées sur des modèles. Pour chaque langue définie, un modèle HTML distinct peut être créé dans la zone d'administration de l'application. Donc, l'application est prête à être utilisée. Les applications pour développeurs sont destinées aux développeurs qui souhaitent créer des applications avancées pour le système d'exploitation APPNET. Les applications pour développeurs incluent une zone d'application prédéfinie, ainsi qu'une zone d'administration prédéfinie et un widget prédéfini pour la zone d'administration. Pour les applications de développement, il peut être choisi comme modèle. Vous pouvez également choisir le cache de l'application et les paramètres du conteneur avec lequel il doit être généré. Les développeurs peuvent proposer leurs applications, sur le marché, le <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a> pour vente. Les utilisateurs de APPNET OS peuvent acheter et installer les applications directement à partir de la zone d'administration.",
    "admin__apps__create__html_info" => "HTML App Builder crée des applications HTML finies et multilingues. Les applications HTML ont leur propre zone d'administration. Dans cette zone, un modèle séparé peut être créé et édité pour chaque ensemble de langues. Grâce à l'éditeur wysiwyg et HTML intégré, il est très léger de personnaliser le code. Les applications HTML reposent sur le modèle Smarty. C'est ici que le code HTML ordinaire ou le code Smarty peuvent être utilisés. Les applications HTML sont des applications conteneur. Cela permet de modifier la taille et l'orientation à tout moment, dans les paramètres de l'application. Un conteneur peut être affecté à tout moment. Dans les paramètres de l'application, des balises CSS peuvent être attribuées au conteneur. Si la fin du conteneur de l'application est définie dans un URI avant et après l'application, l'application est générée individuellement dans un conteneur. Un remplissage est toujours ajouté à une application de conteneur à gauche et à droite. Pour le supprimer, vous devez l'ajouter à la px-0. classe dans les paramètres de l'application, dans le conteneur CSS. En mode expert, un fichier CSS et JavaScript peut même être ajouté à l'application. Ce mode doit être déverrouillé dans config.inc.php.",
    "admin__apps__create__dev_info" => "Développer des applications sont des applications préparées pour les développeurs. Pour créer une application de développement, vous devez disposer d'un nom, d'un espace de nom et d'un répertoire. Les applications pour développeurs sont stockées dans le répertoire racine pour applications / applications. L'option Répertoire stocke l'application dans le sous-répertoire spécifié du répertoire racine. Un espace de noms est nécessaire de toute urgence. L'espace de noms est utilisé par tous les contrôleurs et modèles. Cela évite les conflits avec d'autres applications. Les développeurs peuvent sécuriser leurs propres espaces-noms pour APPNET OS sous <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a>. Les applications proposées et téléchargées dans APPNET OS Store ne créent pas de conflits. L'option Application conteneur indique si les applications, ainsi que les autres applications conteneur, seront publiées dans un conteneur. Dans les conteneurs, les applications peuvent être ajustées plus tard, dans les paramètres de l'application, la taille. Les applications qui utilisent toujours toute la largeur du navigateur ne doivent pas être générées en tant qu'applications conteneur. Une application de développement créée comprend un contrôleur, un modèle, deux vues, différents fichiers de langue, un contrôleur d'administrateur, un modèle d'administrateur, deux vues d'administrateur et différents fichiers de langue d'administrateur. Une application pour développeur est également compatible avec un widget préparé composé d'un contrôleur, d'un modèle, de deux vues et de fichiers de langue différents. De plus, tous les événements admin sont préparés.",
    "admin__apps__create__err_no_name" => "Aucun nom entré",
    "admin__apps__create__err_name" => "Le nom ne peut pas être utilisé",
    "admin__apps__create__err_name_exists" => "Il y a déjà une application avec ce nom",
    "admin__apps__create__conf" => "L'application a été créée",
    "admin__apps__create__err_dir" => "Impossible d'utiliser l'entrée de répertoire",
    "admin__apps__create__err_dev_name_ex" => "Il y a déjà une application avec ce nom dans ce répertoire",
    "admin__apps__create__err_ns_wrong" => "Impossible d'utiliser l'entrée d'espace de nom",
    "admin__apps__create__err_ns_exists" => "Il y a déjà une application avec ce nom, dans et cet espace de noms",
    "admin__apps__create__container_app" => "Application conteneur",
    "admin__apps__create__container_true" => "Application conteneur",
    "admin__apps__create__container_false" => "Aucune application de conteneur",
    "admin__apps__create__development" => "Développement",
    "admin__apps__create__smarty" => "Vues en tant que modèle Smarty",
    "admin__apps__create__php" => "Vues en tant que modèle PHP",
    "admin__apps__create__cache" => "Cache d'application",
    "admin__apps__create__cache_false" => "Ne pas ajouter une fonctionnalité de cache",
    "admin__apps__create__cache_true" => "Ajouter une fonctionnalité de cache",
    "admin__apps__create__html_header" => "Application de modèle HTML",
    "admin__apps__create__html_description" => "Modèle basé, application HTML multilingue. L'application a sa propre zone d'administration. Grâce à l'éditeur wysiwyg et HTML intégré, il est facile de personnaliser le texte ou le code. L'application ne nécessite aucune connaissance de programmation et peut être facilement intégrée.",
    "admin__apps__create__dev_description" => "Un kit entièrement préfabriqué pour les développeurs. Il peut être utilisé pour définir les zones avec lesquelles l'application doit être générée. Zone d'application, zone d'administration et widget. Des fichiers de chaîne sont créés pour chaque zone. De plus, tous les événements sont préparés. L'application est adaptée pour les développeurs de programmer leurs propres applications pour APPNETOS.",
    "admin__apps__create__name" => "Nom de l'application",
    "admin__apps__create__description" => "Description de l'application",
    "admin__apps__create__namespace" => "Noms",
    "admin__apps__create__directory" => "Annuaire",
    "admin__apps__create__build" => "Créer",
    "admin__apps__create__widget" => "Bitoniau",
    "admin__apps__create__widget_false" => "N'ajoutez pas de widget",
    "admin__apps__create__widget_true" => "Ajouter widget",
    "admin__apps__create__overview" => "Vue d'ensemble",
    "admin__apps__create__menu_header" => "Créer une nouvelle application",
    "admin__apps__create__install_apps" => "Installer des applications",
    "admin__apps__create__html_string_header" => "Application de chaîne HTML",
    "admin__apps__create__html_sting_description" => "Application HTML basée sur les chaînes multilingues. La zone admin dispose d'un éditeur HTML et wysiwyg intégré. Dans le fichier HTML, les chaînes des fichiers de langue PHP peuvent être utilisées. Un fichier global et un fichier de langue anglaise est créé, mais vous pouvez simplement ajouter des fichiers linguistiques. L'application nécessite un minimum de compétences en programmation",
    "admin__apps__create__html_string_info" => "Application HTML multilingue à base de chaînes. La zone admin dispose d'un éditeur HTML et wysiwyg intégré. Les fichiers de chaîne sont utilisés pour le texte. Les textes des fichiers de chaîne peuvent être facilement transférés sur HTML. Cela a l'avantage qu'un seul fichier HTML doit être généré pour toutes les langues. Lorsque l'application est créée, un fichier de chaîne global et anglais est créé. Un éditeur externe est nécessaire pour modifier les fichiers de chaîne. Pour les autres langues, seul un fichier de chaîne existant doit être copié et nommé avec l'ID de pays approprié. La langue est sélectionnée automatiquement. Il peut être inséré entre 3 langues de modèle sélectionnées dans les cordes dans les suivantes.",
    "admin__apps__create__template_language" => "Langage de modèle",
    "admin__apps__create__twig" => "Vues comme Twig Templates",
];