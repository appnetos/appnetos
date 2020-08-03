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
 * @description     Admin app overview and app management.
 */

// Language strings.
$strings = [
    "admin__apps__management__conf_deactivate" => "La aplicación ha sido desactivada.",
    "admin__apps__management__conf_activate" => "La aplicación ha sido activada.",
    "admin__apps__management__err_activate" => "La aplicación no pudo ser activada o desactivada.",
    "admin__apps__management__conf_remove" => "La aplicación ha sido eliminada.",
    "admin__apps__management__err_remove" => "La aplicación no pudo ser eliminada",
    "admin__apps__management__info" => "APPNET OS usa aplicaciones para crear páginas web a partir de ellas. La gestión de aplicaciones enumera todas las aplicaciones instaladas. Las aplicaciones se pueden asignar a páginas individuales en la gestión de SEO. Las aplicaciones estáticas también se pueden configurar en la parte superior y las aplicaciones estáticas en la parte inferior. Estos se organizan en cada página en la parte superior o inferior. Las aplicaciones también pueden incluir un área de administración. Se puede acceder al área de administración a través de la configuración de la aplicación. Los eventos permiten a los desarrolladores asignar acciones específicas a las aplicaciones. Estos eventos serán ejecutados bajo el evento apropiado. Esto permite que las aplicaciones instalen, dupliquen, restauren, eliminen y eliminen la aplicación. También puede haber eventos que se ejecutan cuando se activa o desactiva.",
    "admin__apps__management__deactivate_header" => "Desactivar aplicación",
    "admin__apps__management__deactivate_info" => "Las aplicaciones deshabilitadas no se emiten. La característica es útil al editar el contenido de la aplicación. No se pierden datos cuando las aplicaciones están deshabilitadas y se pueden reactivar en cualquier momento.",
    "admin__apps__management__remove_header" => "Eliminar aplicaciones",
    "admin__apps__management__remove_info" => "Tenga cuidado al eliminar aplicaciones. La aplicación se elimina de la base de datos de la aplicación. El directorio de la aplicación y la tabla de la base de datos permanecen en su lugar y deben eliminarse manualmente. Los datos no se pierden. Sin embargo, las aplicaciones con tablas de base de datos son difíciles de recuperar.",
    "admin__apps__management__delete_header" => "Eliminar aplicación",
    "admin__apps__management__delete_info" => "Tenga cuidado al eliminar aplicaciones. La aplicación se elimina de la base de datos de la aplicación y la secuencia de comandos de la aplicación se ejecuta para eliminar la aplicación. Se eliminan todas las tablas de la base de datos de la aplicación. Los datos no se pueden recuperar y se perderán para siempre.",
    "admin__apps__management__conf_delete" => "La aplicación ha sido eliminada.",
    "admin__apps__management__err_delete" => "La aplicación no pudo ser eliminada",
    "admin__apps__management__err_description" => "La descripción no pudo ser cambiada",
    "admin__apps__management__conf_description" => "La descripción ha sido modificada.",
    "admin__apps__management__err_duplicate" => "La aplicación no pudo ser duplicada",
    "admin__apps__management__conf_duplicate" => "La aplicación ha sido duplicada.",
    "admin__apps__management__directory" => "Ruta de acceso a la aplicación",
    "admin__apps__management__reset_header" => "Restablecer aplicación",
    "admin__apps__management__reset_info" => "Tenga cuidado al reiniciar las aplicaciones. Aquí, el script de la aplicación se ejecuta para reiniciar. Todas las tablas de la base de datos de la aplicación están vacías. Los datos no se pueden recuperar y se perderán para siempre.",
    "admin__apps__management__err_reset" => "La aplicación no se pudo reiniciar",
    "admin__apps__management__conf_reset" => "La aplicación ha sido restablecida",
    "admin__apps__management__description_info" => "Haz que las aplicaciones múltiples sean más reconocibles agregándoles una descripción.",
    "admin__apps__management__edit_styles" => "Editar estilos",
    "admin__apps__management__duplicate" => "Duplicado",
    "admin__apps__management__reset" => "Restablecer",
    "admin__apps__management__install" => "Instalar",
    "admin__apps__management__activate" => "Activar",
    "admin__apps__management__deactivate" => "Desactivar",
    "admin__apps__management__delete" => "Eliminar",
    "admin__apps__management__remove" => "Eliminar",
    "admin__apps__management__revert" => "Restablecer",
    "admin__apps__management__id_up" => "ID ascendente",
    "admin__apps__management__id_down" => "ID descendente",
    "admin__apps__management__name_up" => "Nombre ascendente",
    "admin__apps__management__name_down" => "Nombre descendente",
    "admin__apps__management__description_up" => "Descripción ascendente",
    "admin__apps__management__description_down" => "Descripción descendente",
    "admin__apps__management__description" => "Descripción",
    "admin__apps__management__settings" => "Configuración",
    "admin__apps__management__search" => "Búsqueda",
    "admin__apps__management__menu_header" => "Gestión de aplicaciones",
    "admin__apps__management__no_apps" => "No hay aplicaciones disponibles",
    "admin__apps__management__events" => "Eventos",
    "admin__apps__management__no_events" => "Sin eventos",
    "admin__apps__management__admin" => "Zona de administración",
    "admin__apps__management__activated" => "Activar",
    "admin__apps__management__deactivated" => "Desactivar",
    "admin__apps__management__no_description" => "Sin descripción",
    "admin__apps__management__app_id" => "ID de aplicación",
    "admin__apps__management__properties" => "Propiedades",
    "admin__apps__management__license" => "Licencia",
    "admin__apps__management__no_content" => "Sin contenido",
    "admin__apps__management__frontend" => "Frontend",
    "admin__apps__management__admin_area" => "Zona de administración",
    "admin__apps__management__static" => "Estática",
    "admin__apps__management__not_static" => "No estático",
    "admin__apps__management__size" => "Tamaño y orientación",
    "admin__apps__management__container_css" => "CSS container",
    "admin__apps__management__app_css" => "CSS Aplicación",
    "admin__apps__management__no_container_css" => "Sin contenedor CSS",
    "admin__apps__management__no_app_css" => "Sin aplicación CSS",
    "admin__apps__management__no_store_license" => "No hay información de licencia disponible",
    "admin__apps__management__no_store_description" => "No hay descripción disponible",
    "admin__apps__management__close" => "Cerca",
    "admin__apps__management__css_container_fluid" => "CSS container-fluid",
    "admin__apps__management__no_container_fluid_css" => "Sin container-fluid CSS",
    "admin__apps__management__version" => "Versión",
];