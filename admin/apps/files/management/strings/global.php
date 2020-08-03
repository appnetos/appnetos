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
    "admin__files__mgnt__info" => "Files and directories can be managed in this area. For security reasons, only directories defined in config.inc.php at \$filesDirectories are listed. \$FilesType define supported formats. It is recommended that only directories from the out directory are listed. Files that are deleted in the file manager cannot be recovered. All directories listed in the config.inc.php are protected and cannot be deleted. Subdirectories can also be listed to protect them. It should be noted that the root directories ' files are not protected and can be deleted.",
    "admin__files__mgnt__no_files" => "No Files available",
    "admin__files__mgnt__drop" => "Click or drop files here",
    "admin__files__mgnt__upload" => "Upload",
    "admin__files__mgnt__err_format" => "File Format is not accepted",
    "admin__files__mgnt__err_path" => "Directory is not accepted",
    "admin__files__mgnt__delete_header" => "Delete files",
    "admin__files__mgnt__delete_info" => "Be careful when deleting Files. Deleted Files cannot be recovered.",
    "admin__files__mgnt__delete_conf" => "The Files have been deleted",
    "admin__files__mgnt__delete_err" => "The Files could not be deleted",
    "admin__files__mgnt__delete_warn" => "Not all Files could be deleted",
    "admin__files__mgnt__delete_directory" => "Delete directory",
    "admin__files__mgnt__delete_file" => "Delete file",
    "admin__files__mgnt__rename_directory" => "Rename directory",
    "admin__files__mgnt__rename_file" => "Rename file",
    "admin__files__mgnt__add_directory" => "Add directory",
    "admin__files__mgnt__new_name" => "New name",
    "admin__files__mgnt__file_rename_err" => "The file could not be renamed",
    "admin__files__mgnt__file_rename_conf" => "The file have been renamed",
    "admin__files__mgnt__directory_rename_err" => "The directory could not be renamed",
    "admin__files__mgnt__directory_rename_conf" => "The directory have been renamed",
    "admin__files__mgnt__file_rename_err_ex" => "There is already a file with this name",
    "admin__files__mgnt__dir_rename_err_ex" => "There is already a directory with this name",
    "admin__files__mgnt__dir_rename_err_root" => "The directory is a root directory or contains a root directory and cannot be renamed",
    "admin__files__mgnt__add_dir_err" => "The directory could not be added",
    "admin__files__mgnt__add_dir_err_exists" => "The directory already exists",
    "admin__files__mgnt__add_dir_conf" => "The directory has been added",
    "admin__files__mgnt__delete_dir_info" => "Be careful when deleting directories. When directories are deleted, all files and sub directories are irrevocably deleted.",
    "admin__files__mgnt__delete_dir_err" => "The directory could not be deleted",
    "admin__files__mgnt__err_move" => "The uploaded file could not be moved",
    "admin__files__mgnt__delete_dir_err_exists" => "The directory does not exist",
    "admin__files__mgnt__delete_dir_err_root" => "The directory is a root directory or contains a root directory and cannot be deleted",
    "admin__files__mgnt__refresh" => "Synchronize",
    "admin__files__mgnt__err_to_large" => "The file is too large for upload. Limit php.ini:",
    "admin__files__mgnt__delete_selection" => "Delete selection",
    "admin__files__mgnt__delete" => "Delete",
    "admin__files__mgnt__header" => "File management",
    "admin__files__mgnt__cancel" => "Cancel",
    "admin__files__mgnt__close" => "Close",
    "admin__files__mgnt__save" => "Save",
    "admin__files__mgnt__name" => "Name",
    "admin__files__mgnt__add" => "Add",
];