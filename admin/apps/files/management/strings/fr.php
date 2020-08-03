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
 * @description     Admin files management. Create and delete folders. Upload and delete files. The folders to manage
 *                  files in the files manager must be defined in the config.inc.php.
*/

// Strings.
$strings = [
    "admin__files__mgnt__info" => "Les fichiers et les répertoires peuvent être gérés dans cette zone. Pour des raisons de sécurité, seuls les répertoires définis dans le fichier config.inc.php sous \$filesDirectories sont répertoriés. \$filesType définit les formats pris en charge. Il est recommandé de ne répertorier que les répertoires du répertoire out. Les fichiers supprimés dans le gestionnaire de fichiers ne peuvent pas être récupérés. Tous les répertoires répertoriés dans le fichier config.inc.php sont protégés et ne peuvent pas être supprimés. Des sous-répertoires peuvent également être listés pour les protéger. Il est à noter que les fichiers des répertoires racine ne sont pas protégés et peuvent être supprimés.",
    "admin__files__mgnt__no_files" => "Aucun fichier disponible",
    "admin__files__mgnt__drop" => "Cliquez ou déposez des fichiers ici",
    "admin__files__mgnt__upload" => "Télécharger",
    "admin__files__mgnt__err_format" => "Le format de fichier n'est pas accepté",
    "admin__files__mgnt__err_path" => "L'annuaire n'est pas accepté",
    "admin__files__mgnt__delete_header" => "Supprimer les fichiers",
    "admin__files__mgnt__delete_info" => "Soyez prudent lorsque vous supprimez des fichiers. Les fichiers supprimés ne peuvent pas être récupérés.",
    "admin__files__mgnt__delete_conf" => "Les fichiers ont été supprimés",
    "admin__files__mgnt__delete_err" => "Les fichiers n'ont pas pu être supprimés",
    "admin__files__mgnt__delete_warn" => "Tous les fichiers ne peuvent pas être supprimés",
    "admin__files__mgnt__delete_directory" => "Supprimer le répertoire",
    "admin__files__mgnt__delete_file" => "Supprimer le fichier",
    "admin__files__mgnt__rename_directory" => "Renommer le répertoire",
    "admin__files__mgnt__rename_file" => "Renommer le fichier",
    "admin__files__mgnt__add_directory" => "Ajouter un répertoire",
    "admin__files__mgnt__new_name" => "Nouveau nom",
    "admin__files__mgnt__file_rename_err" => "Le fichier n'a pas pu être renommé",
    "admin__files__mgnt__file_rename_conf" => "Le fichier a été renommé",
    "admin__files__mgnt__directory_rename_err" => "Le répertoire n'a pas pu être renommé",
    "admin__files__mgnt__directory_rename_conf" => "Le répertoire a été renommé",
    "admin__files__mgnt__file_rename_err_ex" => "Il y a déjà un fichier avec ce nom",
    "admin__files__mgnt__dir_rename_err_ex" => "Il y a déjà un répertoire avec ce nom",
    "admin__files__mgnt__dir_rename_err_root" => "Le répertoire est un répertoire racine ou contient un répertoire racine et ne peut pas être renommé.",
    "admin__files__mgnt__add_dir_err" => "Le répertoire n'a pas pu être ajouté",
    "admin__files__mgnt__add_dir_err_exists" => "Le répertoire existe déjà",
    "admin__files__mgnt__add_dir_conf" => "Le répertoire a été ajouté",
    "admin__files__mgnt__delete_dir_info" => "Faites attention lorsque vous supprimez des répertoires. Lorsque des répertoires sont supprimés, tous les fichiers et sous-répertoires sont définitivement supprimés.",
    "admin__files__mgnt__delete_dir_err" => "Le répertoire n'a pas pu être supprimé",
    "admin__files__mgnt__err_move" => "Le fichier téléchargé n'a pas pu être déplacé",
    "admin__files__mgnt__delete_dir_err_exists" => "Le répertoire n'existe pas",
    "admin__files__mgnt__delete_dir_err_root" => "Le répertoire est un répertoire racine ou contient un répertoire racine et ne peut pas être supprimé.",
    "admin__files__mgnt__refresh" => "Synchroniser",
    "admin__files__mgnt__err_to_large" => "Le fichier est trop volumineux pour le téléchargement. Limiter php.ini:",
    "admin__files__mgnt__delete_selection" => "Supprimer la sélection",
    "admin__files__mgnt__delete" => "Supprimer",
    "admin__files__mgnt__header" => "Gestion des fichiers",
    "admin__files__mgnt__cancel" => "Annuler",
    "admin__files__mgnt__close" => "Proche",
    "admin__files__mgnt__save" => "sauvegarder",
    "admin__files__mgnt__name" => "Nom",
    "admin__files__mgnt__add" => "Ajouter",
];