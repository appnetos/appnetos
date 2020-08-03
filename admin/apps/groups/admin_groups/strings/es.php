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
 * @description     Admin user groups. Groups can be used to define which administrators can view which areas.
 */

// Language strings.
$strings = [
    "admin__groups__admin_groups__info" => "Los grupos de administradores controlan el acceso a las páginas de los usuarios de la sección de administración. Llamar a una página se puede permitir o denegar. Si no hay páginas asociadas a un grupo, se puede acceder a cada página. Si no se asigna ninguna página permitida a un grupo, se puede llamar a todas las páginas, excepto las que se asignan denegadas. Si no se asigna ninguna página denegada, solo se pueden asignar las páginas permitidas. También se puede permitir y denegar el acceso a las páginas al mismo tiempo. Los desarrolladores deben tener en cuenta que el identificador de URI no se devuelve si se deniegan los URI. Los administradores que no están asociados a un grupo no tienen restricciones.",
    "admin__groups__admin_groups__menu_header" => "Grupos de administradores",
    "admin__groups__admin_groups__add_group" => "Agregar grupo de administradores",
    "admin__groups__admin_groups__search" => "Búsqueda",
    "admin__groups__admin_groups__name_up" => "Nombre ascendente",
    "admin__groups__admin_groups__name_down" => "Nombre descendente",
    "admin__groups__admin_groups__id_up" => "ID ascendente",
    "admin__groups__admin_groups__id_down" => "ID descendente",
    "admin__groups__admin_groups__no_groups" => "No hay grupos disponibles",
    "admin__groups__admin_groups__add" => "Añadir",
    "admin__groups__admin_groups__name" => "Nombre del grupo",
    "admin__groups__admin_groups__close" => "Cerca",
    "admin__groups__admin_groups__add_err_name_enter" => "Introduzca un nombre de grupo",
    "admin__groups__admin_groups__add_err_name_exists" => "El nombre del grupo ya está asignado",
    "admin__groups__admin_groups__add_conf" => "El grupo se ha añadido",
    "admin__groups__admin_groups__delete" => "Eliminar",
    "admin__groups__admin_groups__group_id" => "ID de grupo",
    "admin__groups__admin_groups__denied_uris" => "URI denegados",
    "admin__groups__admin_groups__granted_uris" => "URI concedidos",
    "admin__groups__admin_groups__all" => "Todo",
    "admin__groups__admin_groups__non" => "Ninguno",
    "admin__groups__admin_groups__all_but_denied" => "Todo menos negado",
    "admin__groups__admin_groups__all_but_granted" => "Todo menos concedido",
    "admin__groups__admin_groups__information" => "Información",
    "admin__groups__admin_groups__no_uris" => "No hay URI asociados",
    "admin__groups__admin_groups__edit_err" => "El grupo no se pudo editar",
    "admin__groups__admin_groups__no_uris_err" => "No se han seleccionado URI",
    "admin__groups__admin_groups__add_uri_conf" => "Los URI se han añadido",
    "admin__groups__admin_groups__home" => "Casa",
    "admin__groups__admin_groups__remove_uri_conf" => "Los URI se han eliminado",
    "admin__groups__admin_groups__remove" => "Eliminar",
    "admin__groups__admin_groups__edit" => "Editar",
    "admin__groups__admin_groups__edit_conf" => "El grupo ha sido editado",
    "admin__groups__admin_groups__delete_header" => "Eliminar grupo de administradores",
    "admin__groups__admin_groups__delete_info" => "Tenga cuidado al eliminar grupos de administradores. Los grupos de administradores eliminados no se pueden recuperar. Las cuentas de administrador asociadas al grupo se asignan al grupo predeterminado. Si no se define ningún grupo predeterminado, estos administradores tienen acceso completo a cualquier contenido.",
    "admin__groups__admin_groups__delete_conf" => "El grupo ha sido eliminado",
    "admin__groups__admin_groups__as_default" => "Como estándar",
    "admin__groups__admin_groups__default" => "Estándar",
    "admin__groups__admin_groups__delete_err" => "El grupo no se pudo eliminar",

];