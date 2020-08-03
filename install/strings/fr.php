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
 * @description     install/strings/fr.php ->    French language strings for APPNETOS installer.
 */

// Strings.
$strings = [
    "installer__language_header" => "Langue lors de l'installation",
    "installer__language" => "Langue",
    "installer__license" => "Licence",
    "installer__select" => "Sélectionner",
    "installer__install" => "Installer",
    "installer__accept_checkbox" => "J'accepte les termes de la licence",
    "installer__accept_error" => "Vous devez accepter les termes de la licence",
    "installer__accept" => "Accepter",
    "installer__back" => "Dos",
    "installer__version_error" => "Incopable version PHP. Le système d'exploitation APPNET nécessite PHP version 7.0.0 ou supérieure.",
    "installer__pdo_error" => "L'extension de base de données PDO n'est pas active. APPNET OS nécessite l'extension de base de données PHP PDO.",
    "installer__database" => "base de données",
    "installer__db_type" => "Type de base de données",
    "installer__db_host" => "Hôte de base de données",
    "installer__db_port" => "Port de base de données",
    "installer__db_name" => "Nom de la base de données",
    "installer__db_user" => "Nom d'utilisateur de la base de données",
    "installer__db_pass" => "Mot de passe de base de données",
    "installer__next" => "Plus",
    "installer__connect_error" => "La connexion à la base de données a échoué.",
    "installer__prefix" => "Préfixe de banque de données",
    "installer__prefix_info" => "Le système d'exploitation APPNET utilise un préfixe pour toutes les tables de base de données. Cela exécute plusieurs installations avec une seule base de données.",
    "installer__url" => "URL (sans \"/index.php\" à la fin)",
    "installer__dir" => "Répertoire d'installation (sans \"/index.php\" à la fin)",
    "installer__cache_dir" => "Répertoire de cache (à partir du répertoire d'installation)",
    "installer__tmp_dir" => "Répertoire temporaire (à partir du répertoire d'installation)",
    "installer__log_dir" => "Répertoire du fichier journal (à partir du répertoire d'installation)",
    "installer__compile_dir" => "Répertoire de compilation (à partir du répertoire d'installation)",
    "installer__config_dir" => "Répertoire de configuration (à partir du répertoire d'installation)",
    "installer__extend" => "Paramètres avancés",
    "installer__basic_settings" => "Réglages de base",
    "installer__prefix_error" => "S'il vous plaît entrer un préfixe.",
    "installer__prefix_error_1" => "Le préfixe doit avoir 3 lettres minuscules (a-z).",
    "installer__prefix_error_2" => "Le préfixe de la base de données est déjà utilisé.",
    "installer__system_warning" => "Les modifications apportées à ces paramètres ne peuvent pas être vérifiées et peuvent provoquer des erreurs. Ces paramètres peuvent être ajustés ultérieurement dans le fichier \"confic.inc.php\".",
    "installer__directory" => "Paramètres d'installation et de répertoire",
    "installer__developer" => "Paramètres de développeur",
    "installer__cache" => "Paramètres du cache",
    "installer__app_cache" => "Cache d'application",
    "installer__file_cache" => "Cache de fichiers",
    "installer__js_cache" => "Cache JavaScript",
    "installer__css_cache" => "Cache CSS",
    "installer__cache_expire" => "Délai d'expiration du cache d'applications en secondes",
    "installer__error_count" => "Nombre de connexions incorrectes jusqu'à ce que les utilisateurs soient bloqués",
    "installer__minify" => "Réduire les CSS et JavaScript",
    "installer__expert" => "Mode expert de la zone d'administration",
    "installer__cookie_lock" => "Utiliser le bloqueur de cookies APPNET OS",
    "installer__user" => "Utilisateur (administrateur)",
    "installer__pass" => "Mot de passe",
    "installer__pass_2" => "Répéter le mot de passe",
    "installer__mail" => "Adresse email",
    "installer__user_name" => "Nom d'utilisateur",
    "installer__user_min" => "Vérification minimale de l'utilisateur (Cochez uniquement si un nom d'utilisateur a été saisi)",
    "installer__pass_min" => "Vérification du mot de passe minimum (Cochez uniquement si un mot de passe a été saisi)",
    "installer__mail_min" => "Vérification minimale du courrier électronique (il suffit de vérifier si une adresse électronique a été entrée)",
    "installer__err_user_enter" => "S'il vous plaît entrer un nom d'utilisateur",
    "installer__err_user_valid" => "Le nom d'utilisateur n'est pas autorisé",
    "installer__err_pass_enter" => "S'il vous plaît entrer un mot de passe",
    "installer__err_pass_compare" => "Le mot de passe et la répétition du mot de passe ne sont pas identiques",
    "installer__err_pass_valid" => "Le mot de passe n'est pas autorisé",
    "installer__err_pass_usable" => "Le mot de passe ne peut pas être utilisé",
    "installer__err_mail_enter" => "S'il vous plaît entrer une adresse email",
    "installer__err_mail_valid" => "L'email n'est pas autorisé",
    "installer__install_header" => "Installation",
    "installer__install_text" => "Le système d'exploitation APPNET est prêt pour l'installation.",
    "installer__install_end" => "Installation de APPNET OS terminée. Vous pouvez maintenant vous connecter à la zone d'administration.",
    "installer__directory_cache" => "Cache de chaîne.",
    "installer__string_cache" => "Cache de répertoire",
    "installer__permissions" => "Les permissions",
    "installer__permissions_info" => "APPNET OS ne peut pas accéder au système de fichiers. Il est impératif que le système d’application APPNET puisse accéder au système de fichiers. Veuillez accorder aux autorisations du système d’exploitation d’APPNET le droit de lire, d’écrire et de s’exécuter dans le répertoire du système d’application APPNET avec tous les sous-répertoires, puis réessayez.",
    "installer__err_access" => "Accès refusé",
    "installer__try_again" => "Réessayer",
    "installer__languages" => "Zone administrative Langues",
    "installer__languages_info" => "Langues prises en charge par la zone d’administration d’APPNET OS",
    "installer__languages_global" => "Global (anglais) (traduit par xtrose Media Studio)",
    "installer__languages_de" => "Allemand (deutsch) (traduit par xtrose Media Studio)",
    "installer__languages_en" => "Anglais (english) (traduit par xtrose Media Studio)",
    "installer__languages_es" => "Espagnol (español) (traduction automatique)",
    "installer__languages_fr" => "Français (français) (traduction automatique)",
    "installer__languages_it" => "Italien (italiano) (traduction automatique)",
    "installer__languages_ru" => "Russe (русский) (traduction automatique)",
    "installer__additional" => "Licence étendue",
    "installer__security_settings" => "Paramètres de sécurité",
    "installer__pass_expire" => "Temps jusqu’à ce que le lien pour réinitialiser le mot de passe expire en quelques secondes",
    "installer__groups_application" => "Désactiver les groupes de sections d’application",
    "installer__groups_admin" => "Désactiver les groupes de sections d’administration",
    "installer__authenticator_lifetime" => "Temps jusqu’à ce que l’utilisateur se déconnecte en secondes lorsqu’il enregistre les informations d’identification",
    "installer__session_application" => "Heure de session de la section application en secondes",
    "installer__session_admin" => "Temps de session de section d’administration en secondes",
    "installer__compression" => "Compression",
    "installer__html_compression" => "Compresser le code source HTML",
    "installer__debug" => "Mode débogage",
];