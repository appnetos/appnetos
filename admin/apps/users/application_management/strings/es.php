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
 * @description     Admin overview and management for application users.
 */

// Language strings.
$strings = [
    "admin__users__application_management__info" => "Toda la información de los usuarios registrados se puede ver en Administración de usuarios. Las cuentas de usuario se pueden bloquear y desbloquear. Las contraseñas pueden ser reasignadas por los usuarios. Si la activación por correo electrónico de las cuentas está activa, las cuentas que no se han activado se pueden activar o eliminar. Los nombres de usuario y las direcciones de correo electrónico se pueden editar. Los grupos se pueden asignar a los usuarios. Los grupos de usuarios definen las áreas que los usuarios pueden ver.",
    "admin__users__application_management__registered_since" => "Registrado desde",
    "admin__users__application_management__last_sign_in" => "Último inicio de sesión en",
    "admin__users__application_management__active" => "Activamente",
    "admin__users__application_management__not_activated" => "No activado",
    "admin__users__application_management__sign_in_error" => "Error de inicio de sesión",
    "admin__users__application_management__locked" => "Cerrado",
    "admin__users__application_management__deleted" => "Suprimido",
    "admin__users__application_management__ip_first" => "Registro de IP",
    "admin__users__application_management__ip_last" => "IP último inicio de sesión",
    "admin__users__application_management__admin" => "Administrador",
    "admin__users__application_management__permissions" => "Permisos",
    "admin__users__application_management__edit_header" => "Editar cuenta de usuario",
    "admin__users__application_management__edit_info" => "Tenga cuidado al editar cuentas de usuario. Si se cambia el nombre de usuario, la dirección de correo electrónico o la contraseña de una cuenta, el usuario ya no podrá iniciar sesión con sus datos antiguos.",
    "admin__users__application_management__edit_pass" => "Dejar vacío para no cambiar.",
    "admin__users__application_management__edit_min_user" => "Verificación mínima del usuario (marque solo si el nombre de usuario ya existe)",
    "admin__users__application_management__edit_min_pass" => "Verificación mínima de la contraseña (Marque solo si se ha introducido una contraseña)",
    "admin__users__application_management__edit_err_user_exists" => "El nombre de usuario ya está tomado",
    "admin__users__application_management__edit_err_user_valid" => "El nombre de usuario no está permitido",
    "admin__users__application_management__edit_err_user_usable" => "El nombre de usuario no puede ser usado",
    "admin__users__application_management__edit_err_mail_exists" => "La dirección de correo electrónico ya está en uso",
    "admin__users__application_management__edit_err_mail_valid" => "La dirección de correo electrónico no está permitida.",
    "admin__users__application_management__edit_err_pass_valid" => "La contraseña no esta permitida",
    "admin__users__application_management__edit_err_pass_usable" => "La contraseña no puede ser utilizada",
    "admin__users__application_management__edit_conf" => "La cuenta de usuario ha sido editada.",
    "admin__users__application_management__err_activate" => "La cuenta de usuario no pudo ser activada",
    "admin__users__application_management__conf_activate" => "La cuenta de usuario ha sido activada.",
    "admin__users__application_management__lock_header" => "Bloquear cuenta de usuario",
    "admin__users__application_management__lock_info" => "Tenga cuidado al bloquear las cuentas de usuario. Los usuarios con cuentas bloqueadas ya no pueden iniciar sesión.",
    "admin__users__application_management__delete_header" => "Eliminar cuenta de usuario",
    "admin__users__application_management__delete_info" => "Tenga cuidado al eliminar las cuentas de usuario. Si se elimina una cuenta de usuario, el usuario ya no puede iniciar sesión, pero la cuenta de usuario se puede reactivar. Si se elimina un usuario del sistema, todos los datos del usuario se eliminan de la base de datos y la cuenta no se puede recuperar.",
    "admin__users__application_management__permissions_header" => "Permisos",
    "admin__users__application_management__permissions_info" => "Tenga cuidado al asignar permisos de administrador. Los usuarios con privilegios de administrador pueden iniciar sesión en la sección de administración y modificar la página con su contenido.",
    "admin__users__application_management__conf_lock" => "La cuenta de usuario ha sido bloqueada",
    "admin__users__application_management__err_lock" => "La cuenta de usuario no pudo ser bloqueada",
    "admin__users__application_management__conf_delete" => "La cuenta de usuario ha sido eliminada",
    "admin__users__application_management__err_delete" => "La cuenta de usuario no pudo ser eliminada",
    "admin__users__application_management__conf_permissions" => "Los permisos han sido cambiados.",
    "admin__users__application_management__err_permissions" => "Los permisos no pudieron ser cambiados",
    "admin__users__application_management__del_from_system" => "Eliminar usuario del sistema",
    "admin__users__application_management__err_pass" => "La contraseña es incorrecta",
    "admin__users__application_management__add_user" => "Añadir usuarios",
    "admin__users__application_management__add_err_user_enter" => "Por favor ingrese un nombre de usuario",
    "admin__users__application_management__add_err_user_valid" => "El nombre de usuario no está permitido",
    "admin__users__application_management__add_err_user_exists" => "El nombre de usuario ya está tomado",
    "admin__users__application_management__add_err_user_usable" => "El nombre de usuario no puede ser usado",
    "admin__users__application_management__add_err_pass_enter" => "Por favor ingrese una contraseña",
    "admin__users__application_management__add_err_pass_compare" => "La contraseña y la repetición de la contraseña no son idénticas.",
    "admin__users__application_management__add_err_pass_valid" => "La contraseña no esta permitida",
    "admin__users__application_management__add_err_pass_usable" => "La contraseña no puede ser utilizada",
    "admin__users__application_management__add_err_mail_enter" => "Por favor ingrese una dirección de correo electrónico",
    "admin__users__application_management__add_err_mail_valid" => "El correo electrónico no está permitido.",
    "admin__users__application_management__add_err_mail_exists" => "La dirección de correo electrónico ya está en uso",
    "admin__users__application_management__add_conf" => "La cuenta de usuario ha sido añadida.",
    "admin__users__application_management__add_err" => "La cuenta de usuario no se pudo agregar",
    "admin__users__application_management__search_registered" => "Unido",
    "admin__users__application_management__search_active" => "Activamente",
    "admin__users__application_management__search_unactive" => "De latencia",
    "admin__users__application_management__search_locked" => "Cerrado",
    "admin__users__application_management__search_deleted" => "Suprimido",
    "admin__users__application_management__search_all" => "Todos",
    "admin__users__application_management__restore_conf" => "La cuenta de usuario ha sido restaurada.",
    "admin__users__application_management__restore_err" => "La cuenta de usuario no pudo ser restaurada",
    "admin__users__application_management__menu_header" => "Gestión de usuarios",
    "admin__users__application_management__search" => "Búsqueda",
    "admin__users__application_management__delete" => "Eliminar",
    "admin__users__application_management__user_id" => "ID de usuario",
    "admin__users__application_management__properties" => "Propiedades",
    "admin__users__application_management__edit" => "Editar",
    "admin__users__application_management__information" => "Información",
    "admin__users__application_management__user" => "Nombre de usuario",
    "admin__users__application_management__mail" => "Correo electrónico",
    "admin__users__application_management__pass" => "Contraseña",
    "admin__users__application_management__save" => "Salvar",
    "admin__users__application_management__pass_info" => "Deje en blanco para no cambiar",
    "admin__users__application_management__ip_sign_up" => "IP al registrarse",
    "admin__users__application_management__ip_sign_in" => "IP en último registro",
    "admin__users__application_management__activate" => "Activar",
    "admin__users__application_management__deactivate" => "Desactivar",
    "admin__users__application_management__lock" => "Cerradura",
    "admin__users__application_management__restore" => "Restaurar",
    "admin__users__application_management__account_type" => "Tipo de cuenta",
    "admin__users__application_management__standard" => "Estándar",
    "admin__users__application_management__sign_in_count" => "Número de inicio de sesión",
    "admin__users__application_management__no_users" => "No hay usuarios presentes",
    "admin__users__application_management__admin_button" => "Administrador",
    "admin__users__application_management__search_admin" => "Administrador",
    "admin__users__application_management__close" => "Cerca",
    "admin__users__application_management__edit_err" => "El usuario no pudo ser editado",
    "admin__users__application_management__add" => "Añadir",
    "admin__users__application_management_username_up" => "Nombre de usuario ascendente",
    "admin__users__application_management_username_down" => "Nombre de usuario descendente",
    "admin__users__application_management__mail_up" => "Dirección de correo electrónico ascendente",
    "admin__users__application_management__mail_down" => "Dirección de correo electrónico descendente",
    "admin__users__application_management__ts_first_up" => "Fecha de registro ascendente",
    "admin__users__application_management__ts_first_down" => "Registre datos descendiendo",
    "admin__users__application_management__id_up" => "ID ascendente",
    "admin__users__application_management__id_down" => "ID descendente",
    "admin__users__application_management__user_group" => "Grupo de usuarios",
    "admin__users__application_management__group_id" => "ID de grupo",
    "admin__users__application_management__none" => "Ninguno",
    "admin__users__application_management__edit_err_group_valid" => "El grupo de usuarios no existe",
    "admin__users__application_management__image" => "Imagen",
    "admin__users__application_management__delete_image" => "Eliminar imagen",
    "admin__users__application_management__edit_err_img_type" => "Formato de imagen incorrecto",
    "admin__users__application_management__edit_err_img_size" => "El archivo de imagen es demasiado grande",
];