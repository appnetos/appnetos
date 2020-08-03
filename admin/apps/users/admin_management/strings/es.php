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
 * @description     Admin overview and management for admin users.
 */

// Language strings.
$strings = [
    "admin__users__admin_management__info" => "La administración de administradores proporciona toda la información del administrador. Los administradores se pueden bloquear y desbloquear. Las contraseñas de administrador se pueden reasignar. Los nombres de usuario y las direcciones de correo electrónico se pueden editar. Los administradores solo se pueden crear manualmente. Los administradores se pueden asignar a grupos. Los grupos definen los derechos de cada área.",
    "admin__users__admin_management__registered_since" => "Registrado desde",
    "admin__users__admin_management__last_sign_in" => "Último inicio de sesión en",
    "admin__users__admin_management__active" => "Activamente",
    "admin__users__admin_management__not_activated" => "No activado",
    "admin__users__admin_management__sign_in_error" => "Error de inicio de sesión",
    "admin__users__admin_management__locked" => "Cerrado",
    "admin__users__admin_management__deleted" => "Suprimido",
    "admin__users__admin_management__ip_first" => "Registro de IP",
    "admin__users__admin_management__ip_last" => "IP último inicio de sesión",
    "admin__users__admin_management__admin" => "Administrador",
    "admin__users__admin_management__permissions" => "Permisos",
    "admin__users__admin_management__edit_header" => "Editar cuenta de usuario",
    "admin__users__admin_management__edit_info" => "Tenga cuidado al editar cuentas de usuario. Si se cambia el nombre de usuario, la dirección de correo electrónico o la contraseña de una cuenta, el usuario ya no podrá iniciar sesión con sus datos antiguos.",
    "admin__users__admin_management__edit_pass" => "Dejar vacío para no cambiar.",
    "admin__users__admin_management__edit_min_user" => "Verificación mínima del usuario (marque solo si el nombre de usuario ya existe)",
    "admin__users__admin_management__edit_min_pass" => "Verificación mínima de la contraseña (Marque solo si se ha introducido una contraseña)",
    "admin__users__admin_management__edit_err_user_exists" => "El nombre de usuario ya está tomado",
    "admin__users__admin_management__edit_err_user_valid" => "El nombre de usuario no está permitido",
    "admin__users__admin_management__edit_err_user_usable" => "El nombre de usuario no puede ser usado",
    "admin__users__admin_management__edit_err_mail_exists" => "La dirección de correo electrónico ya está en uso",
    "admin__users__admin_management__edit_err_mail_valid" => "La dirección de correo electrónico no está permitida.",
    "admin__users__admin_management__edit_err_pass_valid" => "La contraseña no esta permitida",
    "admin__users__admin_management__edit_err_pass_usable" => "La contraseña no puede ser utilizada",
    "admin__users__admin_management__edit_conf" => "La cuenta de administrador se ha editado",
    "admin__users__admin_management__err_activate" => "No se pudo activar la cuenta de administrador",
    "admin__users__admin_management__conf_activate" => "La cuenta de administrador se ha activado",
    "admin__users__admin_management__lock_header" => "Bloquear cuenta de administrador",
    "admin__users__admin_management__lock_info" => "Tenga cuidado al bloquear cuentas de administrador. Los administradores con cuentas bloqueadas ya no pueden iniciar sesión.",
    "admin__users__admin_management__delete_header" => "Eliminar cuenta de usuario",
    "admin__users__admin_management__delete_info" => "Tenga cuidado al eliminar cuentas de administrador. Las cuentas de administrador siempre se eliminan del sistema. No se pueden recuperar.",
    "admin__users__admin_management__permissions_header" => "Permisos",
    "admin__users__admin_management__permissions_info" => "Tenga cuidado al asignar permisos de administrador. Los usuarios con privilegios de administrador pueden iniciar sesión en la sección de administración y modificar la página con su contenido.",
    "admin__users__admin_management__conf_lock" => "La cuenta de administrador ha sido suspendida",
    "admin__users__admin_management__err_lock" => "No se pudo bloquear la cuenta de administrador",
    "admin__users__admin_management__conf_delete" => "La cuenta de administrador se ha eliminado",
    "admin__users__admin_management__err_delete" => "No se ha podido eliminar la cuenta de administrador",
    "admin__users__admin_management__conf_permissions" => "Los permisos han sido cambiados.",
    "admin__users__admin_management__err_permissions" => "Los permisos no pudieron ser cambiados",
    "admin__users__admin_management__del_from_system" => "Eliminar usuario del sistema",
    "admin__users__admin_management__err_pass" => "La contraseña es incorrecta",
    "admin__users__admin_management__add_user" => "Añadir administrador",
    "admin__users__admin_management__add_err_user_enter" => "Por favor ingrese un nombre de usuario",
    "admin__users__admin_management__add_err_user_valid" => "El nombre de usuario no está permitido",
    "admin__users__admin_management__add_err_user_exists" => "El nombre de usuario ya está tomado",
    "admin__users__admin_management__add_err_user_usable" => "El nombre de usuario no puede ser usado",
    "admin__users__admin_management__add_err_pass_enter" => "Por favor ingrese una contraseña",
    "admin__users__admin_management__add_err_pass_compare" => "La contraseña y la repetición de la contraseña no son idénticas.",
    "admin__users__admin_management__add_err_pass_valid" => "La contraseña no esta permitida",
    "admin__users__admin_management__add_err_pass_usable" => "La contraseña no puede ser utilizada",
    "admin__users__admin_management__add_err_mail_enter" => "Por favor ingrese una dirección de correo electrónico",
    "admin__users__admin_management__add_err_mail_valid" => "El correo electrónico no está permitido.",
    "admin__users__admin_management__add_err_mail_exists" => "La dirección de correo electrónico ya está en uso",
    "admin__users__admin_management__add_conf" => "La cuenta de usuario ha sido añadida.",
    "admin__users__admin_management__add_err" => "La cuenta de usuario no se pudo agregar",
    "admin__users__admin_management__search_registered" => "Unido",
    "admin__users__admin_management__search_active" => "Activamente",
    "admin__users__admin_management__search_unactive" => "De latencia",
    "admin__users__admin_management__search_locked" => "Cerrado",
    "admin__users__admin_management__search_deleted" => "Suprimido",
    "admin__users__admin_management__search_all" => "Todos",
    "admin__users__admin_management__restore_conf" => "La cuenta de usuario ha sido restaurada.",
    "admin__users__admin_management__restore_err" => "La cuenta de usuario no pudo ser restaurada",
    "admin__users__admin_management__menu_header" => "Gestión de administradores",
    "admin__users__admin_management__search" => "Búsqueda",
    "admin__users__admin_management__delete" => "Eliminar",
    "admin__users__admin_management__user_id" => "ID de administrador",
    "admin__users__admin_management__properties" => "Propiedades",
    "admin__users__admin_management__edit" => "Editar",
    "admin__users__admin_management__information" => "Información",
    "admin__users__admin_management__user" => "Nombre de usuario",
    "admin__users__admin_management__mail" => "Correo electrónico",
    "admin__users__admin_management__pass" => "Contraseña",
    "admin__users__admin_management__save" => "Salvar",
    "admin__users__admin_management__pass_info" => "Deje en blanco para no cambiar",
    "admin__users__admin_management__ip_sign_up" => "IP al registrarse",
    "admin__users__admin_management__ip_sign_in" => "IP en último registro",
    "admin__users__admin_management__activate" => "Activar",
    "admin__users__admin_management__deactivate" => "Desactivar",
    "admin__users__admin_management__lock" => "Cerradura",
    "admin__users__admin_management__restore" => "Restaurar",
    "admin__users__admin_management__account_type" => "Tipo de cuenta",
    "admin__users__admin_management__standard" => "Estándar",
    "admin__users__admin_management__sign_in_count" => "Número de inicio de sesión",
    "admin__users__admin_management__no_users" => "No hay administradores presentes",
    "admin__users__admin_management__admin_button" => "Administrador",
    "admin__users__admin_management__search_admin" => "Administrador",
    "admin__users__admin_management__close" => "Cerca",
    "admin__users__admin_management__edit_err" => "El administrador no se pudo editar",
    "admin__users__admin_management__add" => "Añadir",
    "admin__users__admin_management_username_up" => "Nombre de usuario ascendente",
    "admin__users__admin_management_username_down" => "Nombre de usuario descendente",
    "admin__users__admin_management__mail_up" => "Dirección de correo electrónico ascendente",
    "admin__users__admin_management__mail_down" => "Dirección de correo electrónico descendente",
    "admin__users__admin_management__ts_first_up" => "Fecha de registro ascendente",
    "admin__users__admin_management__ts_first_down" => "Registre datos descendiendo",
    "admin__users__admin_management__id_up" => "ID ascendente",
    "admin__users__admin_management__id_down" => "ID descendente",
    "admin__users__admin_management__admin_group" => "Grupo de administradores",
    "admin__users__admin_management__group_id" => "ID de grupo",
    "admin__users__admin_management__none" => "Ninguno",
    "admin__users__admin_management__edit_err_group_valid" => "El grupo de administradores no existe",
    "admin__users__admin_management__image" => "Imagen",
    "admin__users__admin_management__delete_image" => "Eliminar imagen",
    "admin__users__admin_management__edit_err_img_type" => "Formato de imagen incorrecto",
    "admin__users__admin_management__edit_err_img_size" => "El archivo de imagen es demasiado grande",
];