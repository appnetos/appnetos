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
    "admin__files__mgnt__info" => "Los archivos y directorios se pueden gestionar en esta área. Por razones de seguridad, solo se enumeran los directorios definidos en config.inc.php en \$filesDirectories. \$filesType define los formatos soportados. Se recomienda que solo se enumeren los directorios del directorio de salida. Los archivos que se eliminan en el administrador de archivos no se pueden recuperar. Todos los directorios listados en config.inc.php están protegidos y no pueden ser eliminados. Los subdirectorios también se pueden enumerar para protegerlos. Cabe señalar que los archivos de los directorios raíz no están protegidos y se pueden eliminar.",
    "admin__files__mgnt__no_files" => "No hay archivos disponibles",
    "admin__files__mgnt__drop" => "Haga clic o suelte los archivos aquí",
    "admin__files__mgnt__upload" => "Subir",
    "admin__files__mgnt__err_format" => "Formato de archivo no es aceptado",
    "admin__files__mgnt__err_path" => "No se acepta el directorio",
    "admin__files__mgnt__delete_header" => "Borrar archivos",
    "admin__files__mgnt__delete_info" => "Tenga cuidado al eliminar archivos. Los archivos borrados no se pueden recuperar.",
    "admin__files__mgnt__delete_conf" => "Los archivos han sido eliminados",
    "admin__files__mgnt__delete_err" => "Los archivos no pudieron ser eliminados",
    "admin__files__mgnt__delete_warn" => "No todos los archivos pudieron ser borrados",
    "admin__files__mgnt__delete_directory" => "Eliminar directorio",
    "admin__files__mgnt__delete_file" => "Borrar archivo",
    "admin__files__mgnt__rename_directory" => "Renombrar directorio",
    "admin__files__mgnt__rename_file" => "Renombrar archivo",
    "admin__files__mgnt__add_directory" => "Agregar directorio",
    "admin__files__mgnt__new_name" => "Nuevo nombre",
    "admin__files__mgnt__file_rename_err" => "El archivo no pudo ser renombrado",
    "admin__files__mgnt__file_rename_conf" => "El archivo ha sido renombrado",
    "admin__files__mgnt__directory_rename_err" => "El directorio no pudo ser renombrado",
    "admin__files__mgnt__directory_rename_conf" => "El directorio ha sido renombrado",
    "admin__files__mgnt__file_rename_err_ex" => "Ya existe un archivo con este nombre.",
    "admin__files__mgnt__dir_rename_err_ex" => "Ya existe un directorio con este nombre.",
    "admin__files__mgnt__dir_rename_err_root" => "El directorio es un directorio raíz o contiene un directorio raíz y no puede ser renombrado",
    "admin__files__mgnt__add_dir_err" => "No se pudo agregar el directorio",
    "admin__files__mgnt__add_dir_err_exists" => "El directorio ya existe.",
    "admin__files__mgnt__add_dir_conf" => "El directorio ha sido añadido.",
    "admin__files__mgnt__delete_dir_info" => "Tenga cuidado al eliminar directorios. Cuando se eliminan los directorios, todos los archivos y subdirectorios se eliminan de forma irrevocable.",
    "admin__files__mgnt__delete_dir_err" => "El directorio no pudo ser eliminado",
    "admin__files__mgnt__err_move" => "El archivo cargado no pudo ser movido",
    "admin__files__mgnt__delete_dir_err_exists" => "El directorio no existe.",
    "admin__files__mgnt__delete_dir_err_root" => "El directorio es un directorio raíz o contiene un directorio raíz y no se puede eliminar",
    "admin__files__mgnt__refresh" => "Sincronizar",
    "admin__files__mgnt__err_to_large" => "El archivo es demasiado grande para subir. Limitar php.ini:",
    "admin__files__mgnt__delete_selection" => "Eliminar selección",
    "admin__files__mgnt__delete" => "Eliminar",
    "admin__files__mgnt__header" => "Gestión de archivos",
    "admin__files__mgnt__cancel" => "Cancelar",
    "admin__files__mgnt__close" => "Cerca",
    "admin__files__mgnt__save" => "Salvar",
    "admin__files__mgnt__name" => "Nombre",
    "admin__files__mgnt__add" => "Añadir",
];