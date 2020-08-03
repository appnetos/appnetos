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
 * @description     install/strings/es.php ->    Spanish language strings for APPNETOS installer.
 */

// Strings.
$strings = [
    "installer__language_header" => "Idioma durante la instalación",
    "installer__language" => "Idioma",
    "installer__license" => "Licencia",
    "installer__select" => "Seleccionar",
    "installer__install" => "Instalar",
    "installer__accept_checkbox" => "Acepto los términos de la licencia",
    "installer__accept_error" => "Tienes que aceptar los términos de la licencia.",
    "installer__accept" => "Aceptar",
    "installer__back" => "Espalda",
    "installer__version_error" => "Incapable versión de PHP. APPNET OS requiere PHP versión 7.0.0 o superior.",
    "installer__pdo_error" => "La extensión de la base de datos PDO no está activa. APPNET OS requiere la extensión de base de datos PHP PDO.",
    "installer__database" => "Base de datos",
    "installer__db_type" => "Tipo de base de datos",
    "installer__db_host" => "Base de datos host",
    "installer__db_port" => "Puerto de base de datos",
    "installer__db_name" => "Nombre de la base de datos",
    "installer__db_user" => "Nombre de usuario de la base de datos",
    "installer__db_pass" => "Contraseña de la base de datos",
    "installer__next" => "Más",
    "installer__connect_error" => "Falló la conexión a la base de datos.",
    "installer__prefix" => "Prefijo del banco de datos",
    "installer__prefix_info" => "APPNET OS utiliza un prefijo para todas las tablas de base de datos. Esto ejecuta múltiples instalaciones con una sola base de datos.",
    "installer__url" => "URL (sin \"/index.php\" al final)",
    "installer__dir" => "Directorio de instalación (sin \"/index.php\" al final)",
    "installer__cache_dir" => "Directorio de caché (comenzando desde el directorio de instalación)",
    "installer__tmp_dir" => "Directorio temporal (a partir del directorio de instalación)",
    "installer__log_dir" => "Directorio de archivos de registro (a partir del directorio de instalación)",
    "installer__compile_dir" => "Directorio de compilación (comenzando desde el directorio de instalación)",
    "installer__config_dir" => "Directorio de configuración (a partir del directorio de instalación)",
    "installer__extend" => "Ajustes avanzados",
    "installer__basic_settings" => "Ajustes básicos",
    "installer__prefix_error" => "Por favor, introduzca un prefijo.",
    "installer__prefix_error_1" => "El prefijo debe tener 3 letras minúsculas (a-z).",
    "installer__prefix_error_2" => "El prefijo de la base de datos ya está en uso.",
    "installer__system_warning" => "Los cambios en estas configuraciones no se pueden verificar y pueden causar errores. Estas configuraciones se pueden ajustar más adelante en el archivo \"confic.inc.php\".",
    "installer__directory" => "Instalación y configuración de directorio",
    "installer__developer" => "Ajustes de desarrollador",
    "installer__cache" => "Configuración de caché",
    "installer__app_cache" => "Caché de aplicaciones",
    "installer__file_cache" => "Caché de archivos",
    "installer__js_cache" => "Caché de JavaScript",
    "installer__css_cache" => "Caché CSS",
    "installer__cache_expire" => "Tiempo de caducidad de la caché de la aplicación en segundos",
    "installer__error_count" => "Número de inicios de sesión incorrectos hasta que los usuarios están bloqueados",
    "installer__minify" => "Minimizar CSS y JavaScript",
    "installer__expert" => "Modo experto del área de administración",
    "installer__cookie_lock" => "Usar APPNET OS Cookie Blocker",
    "installer__user" => "Usuario (administrador)",
    "installer__pass" => "Contraseña",
    "installer__pass_2" => "Repetir contraseña",
    "installer__mail" => "Dirección de correo electrónico",
    "installer__user_name" => "Nombre de usuario",
    "installer__user_min" => "Verificación mínima del usuario (Marque solo si se ha introducido un nombre de usuario)",
    "installer__pass_min" => "Verificación mínima de la contraseña (Marque solo si se ha introducido una contraseña)",
    "installer__mail_min" => "Verificación de correo electrónico mínima (solo verifique si se ha introducido una dirección de correo electrónico)",
    "installer__err_user_enter" => "Por favor ingrese un nombre de usuario",
    "installer__err_user_valid" => "El nombre de usuario no está permitido",
    "installer__err_pass_enter" => "Por favor ingrese una contraseña",
    "installer__err_pass_compare" => "La contraseña y la repetición de la contraseña no son idénticas.",
    "installer__err_pass_valid" => "La contraseña no esta permitida",
    "installer__err_pass_usable" => "La contraseña no puede ser utilizada",
    "installer__err_mail_enter" => "Por favor ingrese una dirección de correo electrónico",
    "installer__err_mail_valid" => "El correo electrónico no está permitido.",
    "installer__install_header" => "Instalación",
    "installer__install_text" => "APPNET OS está listo para la instalación.",
    "installer__install_end" => "Instalación del sistema operativo APPNET completada. Ahora puede iniciar sesión en el área de administración.",
    "installer__directory_cache" => "Cadena de caché.",
    "installer__string_cache" => "Directorio caché",
    "installer__permissions" => "Permisos",
    "installer__permissions_info" => "APPNET OS no puede acceder al sistema de archivos. Es imperativo que el sistema operativo APPNET pueda acceder al sistema de archivos. Otorgue permisos de APPNET OS para leer, escribir y ejecutar en el directorio de APPNET OS con todos los subdirectorios e intente nuevamente.",
    "installer__err_access" => "Acceso denegado",
    "installer__try_again" => "Inténtalo de nuevo",
    "installer__languages" => "Idiomas del área de administración",
    "installer__languages_info" => "El área de administración de APPNET OS es compatible con los idiomas.",
    "installer__languages_global" => "Global (inglés) (traducido por xtrose Media Studio)",
    "installer__languages_de" => "Alemán (deutsch) (traducido por xtrose Media Studio)",
    "installer__languages_en" => "Inglés (english) (traducido por xtrose Media Studio)",
    "installer__languages_es" => "Español (español) (traducción automática)",
    "installer__languages_fr" => "Francés (français) (traducción automática)",
    "installer__languages_it" => "Italiano (italiano) (traducción automática)",
    "installer__languages_ru" => "Ruso (русский) (traducción automática)",
    "installer__additional" => "Licencia Extendida",
    "installer__security_settings" => "Configuración de seguridad",
    "installer__pass_expire" => "Tiempo hasta que el enlace para restablecer la contraseña expire en segundos",
    "installer__groups_application" => "Desactivar grupos de secciones de aplicación",
    "installer__groups_admin" => "Deshabilitar grupos de secciones de administración",
    "installer__authenticator_lifetime" => "Tiempo hasta que el usuario cierre la sesión en segundos cuando guarde las credenciales",
    "installer__session_application" => "Sección de aplicación Tiempo de sesión en segundos",
    "installer__session_admin" => "Tiempo de sesión de la sección de administración en segundos",
    "installer__compression" => "Compresión",
    "installer__html_compression" => "Comprimir código fuente HTML",
    "installer__debug" => "Modo Depurar",
];