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
    "admin__settings__system__info" => "La configuración del sistema APPNET OS se almacena en el archivo config.ing.php, en el Directorio principal. Por razones de seguridad, la mayoría de las configuraciones solo se pueden cambiar directamente en el archivo. En Caché, la configuración de almacenamiento en caché se puede sobrescribir. Esto tiene sentido para el desarrollo de aplicaciones. En Admin están las configuraciones para el área de administración.",
    "admin__settings__system__database" => "Configuraciones de base de datos",
    "admin__settings__system__database_type" => "Tipo de base de datos",
    "admin__settings__system__database_host" => "Base de datos host",
    "admin__settings__system__database_user" => "Nombre de usuario de la base de datos",
    "admin__settings__system__database_port" => "Puerto de base de datos",
    "admin__settings__system__database_charset" => "Conjunto de caracteres de la base de datos",
    "admin__settings__system__database_pass" => "Contraseña de la base de datos",
    "admin__settings__system__database_name" => "Nombre de la base de datos",
    "admin__settings__system__system" => "Ajustes del sistema",
    "admin__settings__system__prefix" => "Prefijo del sistema operativo APPNET",
    "admin__settings__system__url" => "URL del sistema",
    "admin__settings__system__data_path" => "Ruta de datos del sistema",
    "admin__settings__system__directories" => "Directorios",
    "admin__settings__system__cache_dir" => "Directorio de caché",
    "admin__settings__system__temp_dir" => "Directorio de datos temporales",
    "admin__settings__system__log_dir" => "Directorio de archivos de registro",
    "admin__settings__system__compile_dir" => "Smarty compilar directorio",
    "admin__settings__system__config_dir" => "Directorio de configuración inteligente",
    "admin__settings__system__cache" => "Cache",
    "admin__settings__system__app_cache" => "Caché de aplicaciones",
    "admin__settings__system__cache_expire" => "El caché de la aplicación caduca en segundos",
    "admin__settings__system__file_cache" => "Caché de archivos",
    "admin__settings__system__directory_cache" => "Directorio caché",
    "admin__settings__system__string_cache" => "Cadena de caché",
    "admin__settings__system__js_cache" => "Caché de JavaScript",
    "admin__settings__system__css_cache" => "Caché CSS",
    "admin__settings__system__minify" => "Minimizar JavaScript y CSS cuando la memoria caché no está activa",
    "admin__settings__system__cookie_lock" => "Bloqueador de cookies APPNETOS",
    "admin__settings__system__expert_mode" => "Modo experto de la sección de administración",
    "admin__settings__system__debugging" => "Depuración",
    "admin__settings__system__debug_mode" => "Modo de depuración",
    "admin__settings__system__debug_ajax" => "Modo de depuración AJAX",
    "admin__settings__system__user" => "Ajustes de usuario",
    "admin__settings__system__user_regex" => "Expresión regular de validación de nombre de usuario",
    "admin__settings__system__pass_regex" => "Expresión regular de validación de contraseña",
    "admin__settings__system__user_error_count" => "Número de entradas incorrectas antes de que los usuarios sean bloqueados",
    "admin__settings__system__files_dir" => "Directorios aceptados",
    "admin__settings__system__files_types" => "Formatos de archivo aceptados",
    "admin__settings__system__max_size" => "Limite de carga de archivos",
    "admin__settings__system__cache_info" => "APPNET OS utiliza una variedad de cachés para acelerar el sistema. La configuración de caché se define en el archivo config.inc.php, en el directorio principal y se puede ajustar aquí. Además de desarrollar o editar páginas, las cachés siempre deben estar activas. El caché de la aplicación también es administrado por las aplicaciones. No todas las aplicaciones tienen la capacidad de almacenar en caché su contenido. La caché de archivos guarda el historial de archivos y la caché de directorios guarda el historial de los directorios. Como resultado, no es necesario recorrer todos los archivos y directorios de las aplicaciones. El caché de cadenas almacena todas las cadenas que ya se han cargado. El JavaScript y CSS Cache recopila todos los archivos de las aplicaciones activas, los minimiza, los guarda y coloca un enlace en el encabezado. Para desarrollar, la opción de minimización puede ser deshabilitada.",
    "admin__settings__system__admin_info" => "En la configuración de administrador, se puede activar el modo experto. En el modo experto, es posible editar los archivos JavaScript y CSS de las aplicaciones y cambiar el comportamiento de almacenamiento en caché de las aplicaciones. También existe la posibilidad de deshabilitar la información en el área de administración.",
    "admin__settings__system__admin_expert_mode" => "Modo experto",
    "admin__settings__system__admin_show_info" => "Mostrar información en la sección de administración.",
    "admin__settings__system__debug_info" => "Aquí es donde se pueden activar la depuración y la depuración AJAX. La depuración emite todos los mensajes de error de PHP justo en la parte inferior de la página. La depuración de AJAX emite el ID exclusivo de AJAX, que se requiere para las solicitudes de AJAX.",
    "admin__settings__system__debug_debug" => "Depuración del sistema",
    "admin__settings__system__debug_debug_ajax" => "Depuración de AJAX",
    "admin__settings__system__menu_system" => "Configuración del sistema",
    "admin__settings__system__menu_cache" => "Configuración de caché",
    "admin__settings__system__menu_admin" => "Configuración de administración",
    "admin__settings__system__menu_debug" => "Configuración de depuración",
    "admin__settings__system__files" => "Archivos",
    "admin__settings__system__save" => "Salvar",
    "admin__settings__system__conf" => "Los ajustes se han guardado",
    "admin__settings__system__compressor" => "Comprimi il codice sorgente HTML",
    "admin__settings__system__extend_info" => "APPNET OS permite que cada clase se expanda varias veces sin cambiar la propia clase, ya sea una clase de aplicación o una clase principal. Esto permite a las aplicaciones realizar ajustes en las clases sin cambiar la propia clase.  Con la extensión de clase, se pueden cambiar las funciones individuales. No es necesario volver a crear la clase completa. Múltiples extensiones pueden dar lugar a errores en el orden incorrecto. Aquí puede ajustar el orden de las extensiones. Las invalidaciones que ya no existen se pueden quitar.",
    "admin__settings__system__class_extends" => "Extensiones de clase",
    "admin__settings__system__class" => "Clase",
    "admin__settings__system__extends" => "Extiende",
    "admin__settings__system__extends_move_confirm" => "La extensión se ha movido",
    "admin__settings__system__extends_move_error" => "No se pudo mover la extensión",
    "admin__settings__system__extends_remove_confirm" => "La extensión ha sido eliminada",
    "admin__settings__system__extends_remove_error" => "No se pudo quitar la extensión",
    "admin__settings__system__extends_not_exists" => "La clase no existe",
    "admin__settings__system__remove" => "eliminar",
    "admin__settings__system__remove_warning" => "Tenga cuidado al quitar extensiones de clase. La eliminación de extensiones de clase puede causar problemas. Compruebe antes de quitar la clase si la clase ya no existe y si la extensión ya no es necesaria.",
    "admin__settings__system__close" => "Cerca",
    "admin__settings__system__activated" => "Activado",
    "admin__settings__system__deactivated" => "Desactivado",
    "admin__settings__system__activate" => "Activar",
    "admin__settings__system__deactivate" => "Desactivar",
    "admin__settings__system__extends_activate_error" => "No se pudo activar la extensión de clase",
    "admin__settings__system__extends_activate_error_exists" => "No se ha podido activar la extensión de clase. Una de las clases requeridas no existe.",
    "admin__settings__system__extends_deactivate_error" => "No se pudo desactivar la extensión de la clase",
    "admin__settings__system__extends_activate_confirm" => "La extensión de la clase se ha activado",
    "admin__settings__system__extends_deactivate_confirm" => "La extensión de la clase se ha desactivado",
    "admin__settings__system__no_extends" => "No hay extensiones de clase disponibles",
];