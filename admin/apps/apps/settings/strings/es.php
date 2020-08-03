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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Language strings.
$strings = [
    "admin__apps__settings__css_conf" => "CSS se ha guardado",
    "admin__apps__settings__js_conf" => "JavaScript se ha guardado",
    "admin__apps__settings__css_err" => "CSS no se pudo guardar",
    "admin__apps__settings__js_err" => "JavaScript no se pudo guardar",
    "admin__apps__settings__warning" => "Tenga cuidado al editar. Los cambios pueden cambiar el comportamiento de la aplicación de una manera sostenible. Los cambios incorrectos pueden destruir la aplicación, la salida y las características.",
    "admin__apps__settings__css_info" => "En el Editor CSS, se puede editar el archivo CSS de la aplicación. El archivo CSS de la aplicación se almacena en el directorio de la aplicación. Este archivo CSS se carga automáticamente con la aplicación. Si una aplicación no tiene un archivo CSS, se crea uno nuevo. Si la memoria caché está activa, debe vaciarse para aplicar los cambios.",
    "admin__apps__settings__js_info" => "En el Editor de JavaScript, se puede editar el archivo JavaScript de la aplicación. El archivo JavaScript de la aplicación se almacena en el directorio de la aplicación. Este archivo JavaScript se carga automáticamente con la aplicación. Si una aplicación no tiene un archivo JavaScript, se crea uno nuevo. Si la memoria caché está activa, debe vaciarse para aplicar los cambios.",
    "admin__apps__settings__data_err" => "Los datos no se pudieron guardar",
    "admin__apps__settings__data_conf" => "Los datos se han guardado",
    "admin__apps__settings__size_err" => "No se pudo guardar el tamaño y la orientación",
    "admin__apps__settings__size_conf" => "El tamaño y la orientación se han guardado",
    "admin__apps__settings__header_col_xl" => "Diseño de la aplicación para el ancho de la pantalla >1200px",
    "admin__apps__settings__header_col_lg" => "Diseño de la aplicación para el ancho de la pantalla 992-1200px",
    "admin__apps__settings__header_col_md" => "Diseño de la aplicación para el ancho de la pantalla 720-992px",
    "admin__apps__settings__header_col_sm" => "Diseño de la aplicación para el ancho de la pantalla 576-720px",
    "admin__apps__settings__header_col" => "Diseño de la aplicación para el ancho de la pantalla <576px",
    "admin__apps__settings__grid_css" => "Bootstrap Grid CSS",
    "admin__apps__settings__size_info" => "Para las aplicaciones de contenedor, se puede editar el tamaño y la orientación. Si una aplicación contenedora no ajusta el tamaño y la orientación, se mostrará en todo el ancho. EL sistema operativo APPNET utiliza Bootstrap y Bootstrap Grid System para sus contenedores. El sistema Grid utiliza 5 tamaños de dispositivo. Cada tamaño se divide en 12 partes. El tamaño y la orientación de las aplicaciones contenedoras se pueden definir mediante estas partes. Si coloca dos aplicaciones contenedoras entre sí y define el tamaño con 6 partes cada una, las aplicaciones se generan una al lado de la otra en dos partes iguales. Si define la primera aplicación en un contenedor con 4 partes y la segunda con 8 partes, la aplicación derecha se genera dos veces más grande que la aplicación izquierda. Si se definen tres aplicaciones en un contenedor de 4 partes cada una, las tres aplicaciones se generan una al lado de la otra, en el mismo tamaño. Si define 12 partes para la primera aplicación y 6 partes para las dos siguientes, la primera aplicación se generará en ancho completo y las dos siguientes, incluso con la mitad del ancho. Si las aplicaciones están correctamente definidas para cada tamaño de dispositivo, obtendrá un diseño responsivo perfecto.",
    "admin__apps__settings__data_info" => "Si una aplicación tiene un área de administración, se puede acceder a ella a través de la configuración. Las aplicaciones también se pueden cargar en contenedores junto con otras aplicaciones. Esta aplicación se denomina aplicaciones contenedoras. Las aplicaciones contenedoras pueden ajustar su tamaño y orientación. Por ejemplo, si se cargan dos aplicaciones en un contenedor y el tamaño se establece en 50% para cada aplicación, se generan una al lado de la otra. Las etiquetas CSS también se pueden agregar al contenedor. Esto permite influir en la apariencia de un contenedor con varias aplicaciones. Tenga cuidado, si se cargan varias aplicaciones en un contenedor y varias aplicaciones personalizan el contenedor CSS, todas las etiquetas CSS se agregan al contenedor. App CSS le permite agregar etiquetas CSS a cada aplicación en un contenedor. En el modo experto, incluso puede editar CSS y JavaScript de una aplicación. Este modo debe estar desbloqueado en el archivo config.inc.php. Pero ten cuidado. Si el CSS o JavaScript se cambia en modo experto, las aplicaciones o incluso toda la página se pueden mutilar o destruir permanentemente.",
    "admin__apps__settings__menu_header" => "Configuración de la aplicación",
    "admin__apps__settings__admin_area" => "Zona de administración",
    "admin__apps__settings__description" => "Descripción",
    "admin__apps__settings__size_and_align" => "Tamaño y orientación",
    "admin__apps__settings__css_container_fluid" => "CSS container-fluid",
    "admin__apps__settings__css_container" => "CSS container",
    "admin__apps__settings__css_app" => "Aplicación CSS",
    "admin__apps__settings__edit_css" => "Editar CSS",
    "admin__apps__settings__edit_js" => "Editar JavaScript",
    "admin__apps__settings__management" => "Gestión de aplicaciones",
    "admin__apps__settings__app_data" => "Datos de la aplicación",
    "admin__apps__settings__activate" => "Activar",
    "admin__apps__settings__deactivate" => "Desactivar",
    "admin__apps__settings__activated" => "Habilitado",
    "admin__apps__settings__deactivated" => "Deshabilitado",
    "admin__apps__settings__no_description" => "Sin descripción",
    "admin__apps__settings__app_id" => "ID de aplicación",
    "admin__apps__settings__properties" => "Propiedades",
    "admin__apps__settings__frontend" => "Frontend",
    "admin__apps__settings__no_content" => "Sin container",
    "admin__apps__settings__static" => "Estática",
    "admin__apps__settings__not_static" => "No estático",
    "admin__apps__settings__size" => "Tamaño y orientación",
    "admin__apps__settings__no_container_css" => "Sin container CSS",
    "admin__apps__settings__no_container_fluid_css" => "Sin de container-fluid CSS",
    "admin__apps__settings__no_app_css" => "Sin aplicación CSS",
    "admin__apps__settings__container_fluid" => "container-fluid",
    "admin__apps__settings__container" => "Container",
    "admin__apps__settings__apps" => "Aplicaciones",
    "admin__apps__settings__save" => "Salvar",
    "admin__apps__settings__cache" => "Usar caché de aplicaciones",
    "admin__apps__settings__js_cache" => "Usar caché JavaScript",
    "admin__apps__settings__css_cache" => "Usar caché CSS",
];