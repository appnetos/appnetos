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
 * @description     Admin URI management to add and delete URIs.
 */

// Language strings.
$strings = [
    "admin__cms__uri_management__add" => "Añadir URI",
    "admin__cms__uri_management__info" => "Un URI es la dirección de la página secundaria de un sitio web. El URI se adjunta al final de la URL definida en config.inc.php. Juntos, forman la URL con la que se puede acceder a la página. APPNET OS es compatible con URI de habla multilingüe. Esta es una herramienta poderosa. Esto permite definir una URI de página en varios idiomas. Si se accede a los enlaces en las vistas a través del ID de URI, entonces el URI se abrirá en el idioma apropiado. En una vista de Smarty, el enlace está asociado con [{\ $ render-> getUrl (ID de URI)}]. En PHP con echo \ $ render-> getUrl (ID de URI). El soporte multilingüe de la codificación UTF8. Por lo tanto, con algunas excepciones, el URI también se puede producir en todos los idiomas. Si los múltiples URI de una página tienen el mismo contenido, se debe colocar un código canónico en la entrada principal. Como resultado, los motores de búsqueda detectan URI multilingües con el mismo contenido y no son castigados. También le da la posibilidad de definir su propio título y favicon para cada página. Si estos no están definidos, entonces el Favicon se utiliza desde la configuración de idioma. Los URI recién agregados son siempre globales. Editar idiomas a la URI se puede agregar a la URI. La gestión de aplicaciones puede definir el contenido.",
    "admin__cms__uri_management__button_apps" => "Administrar aplicaciones",
    "admin__cms__uri_management__add_info" => "Aquí, el sitio web se puede ampliar con subpáginas adicionales. Si el URI está vacío, se crea un enlace a la página de índice. Los URI se deben crear sin la URL definida por config.inc.php. Los URI no comienzan con / un principio. Es posible que los URI no contengan los siguientes caracteres; /?:@=&'\\\"<>#%{}|\\^~[]`. Cada URI puede existir solo una vez.",
    "admin__cms__uri_management__err_add" => "No se pudo crear la entrada.",
    "admin__cms__uri_management__err_add_valid" => "La URL no está permitida",
    "admin__cms__uri_management__err_add_favicon" => "No se permite la ruta del archivo a favicon",
    "admin__cms__uri_management__err_add_exists" => "Ya hay una entrada con este URI.",
    "admin__cms__uri_management__conf_add" => "El URI ha sido añadido",
    "admin__cms__uri_management__delete_header" => "Eliminar URI",
    "admin__cms__uri_management__delete_info" => "Tenga cuidado al eliminar URIs. Al eliminar un URI, la página ya no está disponible. La configuración de la página se pierde irrevocablemente.",
    "admin__cms__uri_management__err_delete" => "La entrada no pudo ser eliminada",
    "admin__cms__uri_management__conf_delete" => "La entrada ha sido eliminada.",
    "admin__cms__uri_management__edit_seo" => "Editar URI",
    "admin__cms__uri_management__menu_header" => "Administración de URI",
    "admin__cms__uri_management__search" => "Búsqueda",
    "admin__cms__uri_management__no_uris" => "No hay URI disponibles",
    "admin__cms__uri_management__home" => "Casa",
    "admin__cms__uri_management__delete" => "Eliminar",
    "admin__cms__uri_management__uri_id" => "URI ID",
    "admin__cms__uri_management__properties" => "Propiedades",
    "admin__cms__uri_management__views" => "Vistas",
    "admin__cms__uri_management__apps" => "Aplicaciones",
    "admin__cms__uri_management__languages" => "Idiomas",
    "admin__cms__uri_management__title" => "Título",
    "admin__cms__uri_management__language_settings" => "Lengua",
    "admin__cms__uri_management__favicon" => "Favicon",
    "admin__cms__uri_management__uri" => "URI",
    "admin__cms__uri_management__button_add" => "Añadir",
    "admin__cms__uri_management__close" => "Cerca",
    "admin__cms__uri_management__id_up" => "ID ascendente",
    "admin__cms__uri_management__id_down" => "ID descendente",
    "admin__cms__uri_management__uri_up" => "URI ascendente",
    "admin__cms__uri_management__uri_down" => "URI descendente",
    "admin__cms__uri_management__title_up" => "Título ascendente",
    "admin__cms__uri_management__title_down" => "Título descendente",
];