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
 * @description     Admin edit URI and languages URIs.
 */

// Language strings.
$strings = [
    "admin__cms__edit_uri__add_lang" => "Añadir idioma",
    "admin__cms__edit_uri__remove_header" => "Eliminar idioma",
    "admin__cms__edit_uri__remove_info" => "Tenga cuidado al eliminar los URI. Si se elimina un URI que habla, entonces no se puede acceder a esta página ingresando la dirección directamente. Los enlaces a través del ID de URI se reenvían al URI del idioma predeterminado o al URI global.",
    "admin__cms__edit_uri__info" => "La globalización combinada con URI de habla multilingüe es una herramienta poderosa en APPNETOS. Esto le permite crear una página multilingüe utilizando medios simples. Para cada página, dependiendo del idioma que establezca, el contenido, el URI parlante, el título y el Favicon se pueden cambiar. Con el uso correcto, se logra una alta calificación en los motores de búsqueda. En una vista de Smarty, el enlace está asociado con [{\ $ render-> getUrl (ID de URI)}]. En PHP con echo getUrl (URI ID). El soporte multilingüe de la codificación UTF8. Por lo tanto, con algunas excepciones, el URI también se puede producir en todos los idiomas. Si el URI en inglés my-uri y el URI en alemán meine-uri, la página se llama en inglés en http://www.appnetos.com/my-uri y en alemán en http://www.appnetos.com/meine -uri. Si los múltiples URI de una página tienen el mismo contenido, se debe colocar un código canónico en la entrada principal. Como resultado, los motores de búsqueda detectan URI multilingües con el mismo contenido y no son castigados.",
    "admin__cms__edit_uri__add_info" => "Para cada URI, se puede definir el URI que habla, el título y el Favicon, según el idioma que establezca. Para el índice de URI, el URI que habla no se puede definir. Si los múltiples URI de una página tienen el mismo contenido, se debe colocar un código canónico en la entrada principal. Como resultado, los motores de búsqueda detectan URI multilingües con el mismo contenido y no son castigados.",
    "admin__cms__edit_uri__err_load" => "No se puede cargar contenido",
    "admin__cms__edit_uri__no_lang" => "No hay otros idiomas disponibles",
    "admin__cms__edit_uri__err_add" => "No se puede agregar idioma",
    "admin__cms__edit_uri__add_exists" => "Ya existe una entrada con este URI.",
    "admin__cms__edit_uri__conf_add" => "El idioma ha sido añadido.",
    "admin__cms__edit_uri__not_exists" => "El lenguaje ya no existe.",
    "admin__cms__edit_uri__err_remove" => "No se pudo eliminar la entrada de idioma.",
    "admin__cms__edit_uri__conf_remove" => "La entrada de idioma ha sido eliminada.",
    "admin__cms__edit_uri__edit_header" => "Editar entrada",
    "admin__cms__edit_uri__edit_info" => "Tenga cuidado al cambiar una URI. Si se cambia un URI, no se puede acceder a esta página ingresando la dirección directamente. Los enlaces a la ID de URI no se ven afectados.",
    "admin__cms__edit_uri__err" => "La entrada no se puede cargar",
    "admin__cms__edit_uri__err_edit" => "La entrada no pudo ser editada",
    "admin__cms__edit_uri__conf_edit" => "La entrada ha sido editada.",
    "admin__cms__edit_uri__err_no_uri" => "No se ha ingresado URI",
    "admin__cms__edit_uri__err_add_valid" => "La URL no está permitida",
    "admin__cms__edit_uri__menu_header" => "Editar URI",
    "admin__cms__edit_uri__menu_app_management" => "Administración de aplicaciones URI",
    "admin__cms__edit_uri__menu_uri_management" => "Gestión de URI",
    "admin__cms__edit_uri__no_languages" => "No hay idiomas disponibles",
    "admin__cms__edit_uri__remove" => "Eliminar",
    "admin__cms__edit_uri__edit" => "Editar",
    "admin__cms__edit_uri__id" => "URI ID",
    "admin__cms__edit_uri__properties" => "Propiedades",
    "admin__cms__edit_uri__views" => "Vistas",
    "admin__cms__edit_uri__apps" => "Aplicaciones",
    "admin__cms__edit_uri__languages" => "Idiomas",
    "admin__cms__edit_uri__language" => "Lengua",
    "admin__cms__edit_uri__title" => "Título",
    "admin__cms__edit_uri__favicon" => "Favicon",
    "admin__cms__edit_uri__language_settings" => "Lengua",
    "admin__cms__edit_uri__global" => "Global",
    "admin__cms__edit_uri__uri" => "URI",
    "admin__cms__edit_uri__canonical" => "Id canónica",
    "admin__cms__edit_uri__no_canonical" => "Sin ID canónico",
    "admin__cms__edit_uri__save" => "Salvar",
    "admin__cms__edit_uri__close" => "Cerca",
    "admin__cms__edit_uri__add" => "Añadir",
    "admin__cms__edit_uri__home_info" => "Los idiomas no se pueden agregar a la página de inicio",
    "admin__cms__edit_uri__home" => "Casa",
    "admin__cms__edit_uri__meta_delete" => "Eliminar",
    "admin__cms__edit_uri__clear" => "Restablecer",
    "admin__cms__edit_uri__name" => "Nombre",
    "admin__cms__edit_uri__content" => "Contenido",
    "admin__cms__edit_uri__meta_title" => "Título de los motores de búsqueda. Máximo 70 caracteres.",
    "admin__cms__edit_uri__meta_description" => "Descripción para motores de búsqueda. Máximo 320 caracteres.",
    "admin__cms__edit_uri__meta_keywords" => "Palabras clave para motores de búsqueda. Hasta 5 palabras clave separadas por espacios.",
];
