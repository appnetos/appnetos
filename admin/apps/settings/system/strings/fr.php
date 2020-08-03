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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 */

// Language strings.
$strings = [
    "admin__settings__system__info" => "Les paramètres système d’APPNET OS sont stockés dans le fichier config.ing.php, dans le répertoire principal. Pour des raisons de sécurité, la plupart des paramètres ne peuvent être modifiés que directement dans le fichier. Sous Cache, les paramètres de mise en cache peuvent être remplacés. Cela a du sens pour le développement d'applications. Sous Admin se trouvent Paramètres pour le secteur Admin.",
    "admin__settings__system__database" => "Paramètres de base de données",
    "admin__settings__system__database_type" => "Type de base de données",
    "admin__settings__system__database_host" => "Hôte de base de données",
    "admin__settings__system__database_user" => "Nom d'utilisateur de la base de données",
    "admin__settings__system__database_port" => "Port de base de données",
    "admin__settings__system__database_charset" => "Base de données",
    "admin__settings__system__database_pass" => "Mot de passe de base de données",
    "admin__settings__system__database_name" => "Nom de la base de données",
    "admin__settings__system__system" => "Les paramètres du système",
    "admin__settings__system__prefix" => "Préfixe APPNETOS",
    "admin__settings__system__url" => "URL système",
    "admin__settings__system__data_path" => "Chemin de données système",
    "admin__settings__system__directories" => "Répertoires",
    "admin__settings__system__cache_dir" => "Répertoire cache",
    "admin__settings__system__temp_dir" => "Répertoire de données temporaire",
    "admin__settings__system__log_dir" => "Répertoire du fichier journal",
    "admin__settings__system__compile_dir" => "Répertoire de compilation Smarty",
    "admin__settings__system__config_dir" => "Répertoire de configuration Smarty",
    "admin__settings__system__cache" => "Cache",
    "admin__settings__system__app_cache" => "Cache d'application",
    "admin__settings__system__cache_expire" => "Délai d'expiration du cache d'applications en secondes",
    "admin__settings__system__file_cache" => "Cache de fichiers",
    "admin__settings__system__directory_cache" => "Cache de répertoire",
    "admin__settings__system__string_cache" => "Cache de chaîne",
    "admin__settings__system__js_cache" => "Cache JavaScript",
    "admin__settings__system__css_cache" => "Cache CSS",
    "admin__settings__system__minify" => "Minify JavaScript and CSS lorsque le cache n'est pas actif",
    "admin__settings__system__cookie_lock" => "Bloqueur de cookies APPNETOS",
    "admin__settings__system__expert_mode" => "Mode expert de la section Admin",
    "admin__settings__system__debugging" => "Débogage",
    "admin__settings__system__debug_mode" => "Mode débogage",
    "admin__settings__system__debug_ajax" => "Mode de débogage AJAX",
    "admin__settings__system__user" => "Paramètres utilisateur",
    "admin__settings__system__user_regex" => "Expression régulière de validation de nom d'utilisateur",
    "admin__settings__system__pass_regex" => "Expression régulière de validation de mot de passe",
    "admin__settings__system__user_error_count" => "Nombre d'inscriptions erronées avant le blocage des utilisateurs",
    "admin__settings__system__files_dir" => "Répertoires acceptés",
    "admin__settings__system__files_types" => "Formats de fichiers acceptés",
    "admin__settings__system__max_size" => "Limite de téléchargement de fichier",
    "admin__settings__system__cache_info" => "APPNET OS utilise divers caches pour accélérer le système. Les paramètres de cache sont définis dans le fichier config.inc.php, dans le répertoire principal et peuvent être ajustés ici. En plus de développer ou d’éditer des pages, les caches doivent toujours être actifs. Le cache de l'application est également géré par les applications. Toutes les applications ne sont pas en mesure de mettre en cache leur contenu. Le cache de fichiers enregistre l'historique des fichiers et le cache de répertoires enregistre l'historique des répertoires. Par conséquent, tous les fichiers et répertoires des applications ne doivent pas nécessairement être parcourus. Le cache de chaînes stocke toutes les chaînes déjà chargées. Le cache JavaScript et CSS collecte tous les fichiers des applications actives, les réduit au minimum, les enregistre et place un lien dans l'en-tête. Pour développer, l'option de minimisation peut être désactivée.",
    "admin__settings__system__admin_info" => "Dans les paramètres administrateur, le mode expert peut être activé. En mode expert, il est possible de modifier les fichiers JavaScript et CSS des applications et de modifier le comportement de mise en cache des applications. Il est également possible de désactiver les informations dans la zone d'administration.",
    "admin__settings__system__admin_expert_mode" => "Mode expert",
    "admin__settings__system__admin_show_info" => "Afficher les informations dans la section admin",
    "admin__settings__system__debug_info" => "C'est ici que le débogage et le débogage AJAX peuvent être activés. Le débogage génère tous les messages d'erreur PHP au bas de la page. Le débogage AJAX émet l'ID unique AJAX, qui est requis pour les demandes AJAX.",
    "admin__settings__system__debug_debug" => "Débogage du système",
    "admin__settings__system__debug_debug_ajax" => "Débogage AJAX",
    "admin__settings__system__menu_system" => "Paramètres du système",
    "admin__settings__system__menu_cache" => "Paramètres cache",
    "admin__settings__system__menu_admin" => "Paramètres d'administration",
    "admin__settings__system__menu_debug" => "Paramètres de débogage",
    "admin__settings__system__files" => "Fichiers",
    "admin__settings__system__save" => "Sauver",
    "admin__settings__system__conf" => "Les paramètres ont été sauvegardés",
    "admin__settings__system__compressor" => "Compresser le code source HTML",
    "admin__settings__system__extend_info" => "APPNET OS permet à chaque classe d’étendre plusieurs fois sans changer la classe elle-même, qu’il s’agisse d’une classe d’application ou d’une classe de base. Cela permet aux applications d’apporter des ajustements aux classes sans changer la classe elle-même.  Avec l’extension de classe, les fonctions individuelles peuvent être modifiées. Il n’est pas nécessaire de recréer la classe complète. Plusieurs extensions peuvent entraîner des erreurs dans le mauvais ordre. Ici, vous pouvez ajuster l’ordre des extensions. Les dérogations qui n’existent plus peuvent être supprimées.",
    "admin__settings__system__class_extends" => "Extensions de classe",
    "admin__settings__system__class" => "Classe",
    "admin__settings__system__extends" => "S' étend",
    "admin__settings__system__extends_move_confirm" => "L’extension a été déplacée",
    "admin__settings__system__extends_move_error" => "L’extension n’a pas pu être déplacée",
    "admin__settings__system__extends_remove_confirm" => "L’extension a été supprimée",
    "admin__settings__system__extends_remove_error" => "L’extension n’a pas pu être supprimée",
    "admin__settings__system__extends_not_exists" => "La classe n’existe pas",
    "admin__settings__system__remove" => "Retirer",
    "admin__settings__system__remove_warning" => "Soyez prudent lorsque vous supprimez les extensions de classe. La suppression des extensions de classe peut causer des problèmes. Vérifiez avant de supprimer la classe si la classe n’existe plus et si l’extension n’est plus nécessaire.",
    "admin__settings__system__close" => "Proche",
    "admin__settings__system__activated" => "Activé",
    "admin__settings__system__deactivated" => "Désactivé",
    "admin__settings__system__activate" => "Activer",
    "admin__settings__system__deactivate" => "Désactiver",
    "admin__settings__system__extends_activate_error" => "Impossible d’activer l’extension de classe",
    "admin__settings__system__extends_activate_error_exists" => "L’extension de classe n’a pas pu être activée. L’une des classes requises n’existe pas.",
    "admin__settings__system__extends_deactivate_error" => "Impossible de désactiver l’extension de classe",
    "admin__settings__system__extends_activate_confirm" => "L’extension de classe a été activée",
    "admin__settings__system__extends_deactivate_confirm" => "L’extension de classe a été désactivée",
    "admin__settings__system__no_extends" => "Aucune extension de classe disponible",
];