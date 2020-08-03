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
 * @description     Admin URI apps management.
 */

// Language strings.
$strings = [
    "admin__cms__manage_apps__conf_add" => "La aplicación ha sido añadida.",
    "admin__cms__manage_apps__err_add" => "La aplicación no se pudo agregar",
    "admin__cms__manage_apps__err_remove" => "La aplicación no pudo ser eliminada",
    "admin__cms__manage_apps__conf_remove" => "La aplicación ha sido eliminada.",
    "admin__cms__manage_apps__err_move" => "La aplicación no pudo ser movida",
    "admin__cms__manage_apps__conf_move" => "La aplicación ha sido movida.",
    "admin__cms__manage_apps__add" => "Añadir aplicación",
    "admin__cms__manage_apps__info" => "En APPNETOS, el contenido de los URI es emitido por las aplicaciones. Cada aplicación es parte de la página. Las aplicaciones también pueden estar disponibles varias veces en una página. Hay dos tipos diferentes de aplicaciones. Aplicaciones estándar y aplicaciones de contenedor. Las aplicaciones estándar siempre se emiten individualmente entre sí. El ancho de una aplicación estándar es siempre del 100%. Una aplicación estándar siempre se emite bajo las aplicaciones anteriores. La siguiente aplicación se emitirá nuevamente bajo la aplicación estándar. Las aplicaciones de contenedor siempre se emiten con otras aplicaciones de contenedor juntas en un contenedor. Para cada aplicación contenedora, se puede definir el tamaño. Si se definen dos aplicaciones de contenedores adyacentes, cada una con un ancho del 50%, se emitirán en paralelo. Si se definen tres aplicaciones de contenedor, cada una con un ancho del 50%, se emiten dos lado a lado y una debajo. Si las tres aplicaciones de contenedor se definen como 33% de ancho cada una, las tres aplicaciones se emiten una al lado de la otra. La configuración de ancho se puede establecer para cuatro anchos de pantalla. Esto permite que las aplicaciones de contenedor se organicen una al lado de la otra en una pantalla grande y entre ellas en una pantalla pequeña. El tamaño de las aplicaciones de contenedor se puede definir en la aplicación Configuración.",
    "admin__cms__manage_apps__err" => "La entrada de URI no se puede cargar",
    "admin__cms__manage_apps__not_exists" => "Esta aplicación ya no existe",
    "admin__cms__manage_apps__menu_header" => "Administración de aplicaciones URI",
    "admin__cms__manage_apps__edit_uri" => "Editar URI",
    "admin__cms__manage_apps__uri_management" => "Administración de URI",
    "admin__cms__manage_apps__home" => "Casa",
    "admin__cms__manage_apps__id" => "URI ID",
    "admin__cms__manage_apps__properties" => "Propiedades",
    "admin__cms__manage_apps__views" => "Vistas",
    "admin__cms__manage_apps__apps" => "Aplicaciones",
    "admin__cms__manage_apps__languages" => "Idiomas",
    "admin__cms__manage_apps__title" => "Título",
    "admin__cms__manage_apps__favicon" => "Favicon",
    "admin__cms__manage_apps__language_settings" => "Lengua",
    "admin__cms__manage_apps__global" => "Global",
    "admin__cms__manage_apps__uri_id" => "URI ID",
    "admin__cms__manage_apps__app_id" => "ID de aplicación",
    "admin__cms__manage_apps__activated" => "Activado",
    "admin__cms__manage_apps__deactivated" => "Desactivado",
    "admin__cms__manage_apps__no_description" => "Sin descripción",
    "admin__cms__manage_apps__close" => "Cerca",
    "admin__cms__manage_apps__no_content" => "Sin contenido",
    "admin__cms__manage_apps__frontend" => "Frontend",
    "admin__cms__manage_apps__admin_area" => "Zona de administración",
    "admin__cms__manage_apps__static" => "Estática",
    "admin__cms__manage_apps__not_static" => "No estático",
    "admin__cms__manage_apps__size" => "Tamaño y orientación",
    "admin__cms__manage_apps__container_css" => "CSS container",
    "admin__cms__manage_apps__app_css" => "CSS Aplicación",
    "admin__cms__manage_apps__no_container_css" => "Sin container CSS",
    "admin__cms__manage_apps__no_app_css" => "Sin aplicación CSS",
    "admin__cms__manage_apps__admin" => "Zona de administración",
    "admin__cms__manage_apps__css_container_fluid" => "CSS container-fluid",
    "admin__cms__manage_apps__no_container_fluid_css" => "Sin container-fluid CSS",
    "admin__cms__manage_apps__settings" => "Configuración",
    "admin__cms__manage_apps__remove" => "Eliminar",
    "admin__cms__manage_apps__no_apps" => "No hay aplicaciones disponibles",
];