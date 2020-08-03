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
    "admin__files__mgnt__info" => "File e directory possono essere gestiti in quest'area. Per motivi di sicurezza, sono elencate solo le directory definite in config.inc.php in \$filesDirectories. \$filesType definisce i formati supportati. Si consiglia di elencare solo le directory dalla directory esterna. I file eliminati nel file manager non possono essere ripristinati. Tutte le directory elencate in config.inc.php sono protette e non possono essere cancellate. Le sottodirectory possono anche essere elencate per proteggerle. Va notato che i file delle directory radice non sono protetti e possono essere cancellati.",
    "admin__files__mgnt__no_files" => "Nessun file disponibile",
    "admin__files__mgnt__drop" => "Fare clic o rilasciare i file qui",
    "admin__files__mgnt__upload" => "Caricare",
    "admin__files__mgnt__err_format" => "Il formato del file non è accettato",
    "admin__files__mgnt__err_path" => "La directory non è accettata",
    "admin__files__mgnt__delete_header" => "Cancella file",
    "admin__files__mgnt__delete_info" => "Fai attenzione quando elimini i file. I file eliminati non possono essere recuperati.",
    "admin__files__mgnt__delete_conf" => "I file sono stati cancellati",
    "admin__files__mgnt__delete_err" => "I file non possono essere cancellati",
    "admin__files__mgnt__delete_warn" => "Non tutti i file possono essere cancellati",
    "admin__files__mgnt__delete_directory" => "Elimina la directory",
    "admin__files__mgnt__delete_file" => "Cancella il file",
    "admin__files__mgnt__rename_directory" => "Rinomina directory",
    "admin__files__mgnt__rename_file" => "Rinomina il file",
    "admin__files__mgnt__add_directory" => "Aggiungi directory",
    "admin__files__mgnt__new_name" => "Nuovo nome",
    "admin__files__mgnt__file_rename_err" => "Il file non può essere rinominato",
    "admin__files__mgnt__file_rename_conf" => "Il file è stato rinominato",
    "admin__files__mgnt__directory_rename_err" => "La directory non può essere rinominata",
    "admin__files__mgnt__directory_rename_conf" => "La directory è stata rinominata",
    "admin__files__mgnt__file_rename_err_ex" => "C'è già un file con questo nome",
    "admin__files__mgnt__dir_rename_err_ex" => "C'è già una directory con questo nome",
    "admin__files__mgnt__dir_rename_err_root" => "La directory è una directory root o contiene una directory root e non può essere rinominata",
    "admin__files__mgnt__add_dir_err" => "La directory non può essere aggiunta",
    "admin__files__mgnt__add_dir_err_exists" => "La directory esiste già",
    "admin__files__mgnt__add_dir_conf" => "La directory è stata aggiunta",
    "admin__files__mgnt__delete_dir_info" => "Fai attenzione quando elimini le directory. Quando le directory vengono cancellate, tutti i file e le sottodirectory vengono cancellati in modo irreversibile.",
    "admin__files__mgnt__delete_dir_err" => "La directory non può essere cancellata",
    "admin__files__mgnt__err_move" => "Il file caricato non può essere spostato",
    "admin__files__mgnt__delete_dir_err_exists" => "La directory non esiste",
    "admin__files__mgnt__delete_dir_err_root" => "La directory è una directory root o contiene una directory root e non può essere cancellata",
    "admin__files__mgnt__refresh" => "Sincronizzare",
    "admin__files__mgnt__err_to_large" => "Il file è troppo grande per il caricamento. Limita php.ini:",
    "admin__files__mgnt__delete_selection" => "Elimina selezione",
    "admin__files__mgnt__delete" => "Elimina",
    "admin__files__mgnt__header" => "Gestione dei file",
    "admin__files__mgnt__cancel" => "Annulla",
    "admin__files__mgnt__close" => "Vicino",
    "admin__files__mgnt__save" => "Salvare",
    "admin__files__mgnt__name" => "Nome",
    "admin__files__mgnt__add" => "Aggiungere",
];