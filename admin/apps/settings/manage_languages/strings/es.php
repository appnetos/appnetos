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
    "admin__settings__manage_language__info" => "Lista de todos los idiomas utilizados por APPNETOS. Se utilizarán los idiomas seleccionados aquí. El idioma utilizado por el usuario está definido por el navegador, pero se puede cambiar por la cookie de idioma. El idioma se define mediante una clave y una subclave. Los archivos de idioma de las aplicaciones se seleccionan con esta tecla. Los archivos de idioma de una aplicación se almacenan en la aplicación en el directorio de cadenas. Cada aplicación tiene un archivo de idioma global llamado global.php. Esto se carga cuando no se puede cargar un archivo de idioma solicitado. Si se solicita un archivo de idioma con una subclave y no existe, se intenta cargar el archivo de idioma de la clave principal. Si no existe, se cargará el idioma estándar establecido. Si tampoco existe, se cargará el archivo de idioma global. El orden de carga de los archivos de idioma en un ejemplo. es-es -> en -> Estándar -> Global",
    "admin__settings__manage_language__remove" => "Eliminar idioma",
    "admin__settings__manage_language__remove_info" => "Tenga cuidado al eliminar los idiomas. Si se elimina un idioma, las páginas ya no se publican en ese idioma. El contenido en el predeterminado se emite navegadores de voz con este idioma. No se define ningún idioma estándar, luego se usa el idioma global.",
    "admin__settings__manage_language__err_add" => "El idioma no se pudo activar",
    "admin__settings__manage_language__err_remove" => "El idioma no se pudo desactivar",
    "admin__settings__manage_language__conf_remove" => "El idioma ha sido desactivado",
    "admin__settings__manage_language__conf_add" => "El idioma se ha activado",
    "admin__settings__manage_language__menu_header" => "Administrar idiomas",
    "admin__settings__manage_language__search" => "Búsqueda",
    "admin__settings__manage_language__language_settings" => "Lengua",
    "admin__settings__manage_language__no_languages" => "No hay idiomas disponibles",
    "admin__settings__manage_language__activate" => "Activar",
    "admin__settings__manage_language__deactivate" => "Desactivar",
    "admin__settings__manage_language__properties" => "Propiedades",
    "admin__settings__manage_language__default" => "Predeterminado",
    "admin__settings__manage_language__activated" => "Activado",
    "admin__settings__manage_language__close" => "Cerca",
];
