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
 * @description     Admin app creator to build apps.
 */

// Language strings.
$strings = [
    "admin__apps__create__dev_header" => "Aplicación de desarrollador",
    "admin__apps__create__info" => "Se pueden generar nuevas aplicaciones en esta área. Se pueden generar aplicaciones HTML multilingües o aplicaciones avanzadas para desarrolladores. Las aplicaciones HTML están basadas en plantillas. Para cada conjunto de idiomas, se puede crear una plantilla HTML separada en el área de administración de la aplicación. Así que la aplicación está lista para su uso. Las aplicaciones de desarrollador están dirigidas a desarrolladores que desean crear aplicaciones avanzadas para el sistema operativo APPNET. Las aplicaciones de desarrollador incluyen un área de aplicación predefinida, así como un área de administración predefinida y un widget predefinido para el área de administración. Para aplicaciones de desarrollador, se puede elegir como plantilla. También se puede elegir el caché de la aplicación y la configuración del contenedor con el que se va a generar. Los desarrolladores pueden ofrecer sus aplicaciones, en el mercado, en <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a> para venta. Los usuarios de APPNET OS pueden comprar e instalar las aplicaciones directamente desde el área de administración.",
    "admin__apps__create__html_info" => "El HTML App Builder crea aplicaciones HTML terminadas y multilingües. Las aplicaciones HTML tienen su propia área de administración. En esta área, se puede crear y editar una plantilla separada para cada conjunto de idiomas. Gracias al editor de wysiwyg y HTML incorporado, es un código ligero para personalizar el código. Las aplicaciones HTML están basadas en Smarty Template. Aquí es donde se puede usar el código HTML ordinario o el código Smarty. Las aplicaciones HTML son aplicaciones de contenedor. Esto permite cambiar el tamaño y la orientación en cualquier momento, en la configuración de la aplicación. Un contenedor puede verse afectado en cualquier momento. En la configuración de la aplicación, las etiquetas CSS se pueden asignar al contenedor. Si el final del contenedor de la aplicación se define en un URI antes y después de la aplicación, la aplicación se emite individualmente en un contenedor. Siempre se agrega un relleno a una aplicación de contenedor a la izquierda y la derecha. Para eliminar esto, debe agregarse a px-0. Clase en la configuración de la aplicación, en el contenedor CSS. En modo experto, incluso se puede agregar un archivo CSS y JavaScript a la aplicación. Este modo debe estar desbloqueado en config.inc.php.",
    "admin__apps__create__dev_info" => "Desarrollar aplicaciones son aplicaciones preparadas para desarrolladores. Para crear una aplicación de desarrollador se requiere un nombre, un espacio de nombres y un directorio. Las aplicaciones de desarrollador se almacenan en el directorio raíz de la aplicación de aplicaciones / apps. La opción Directorio almacena la aplicación en el subdirectorio especificado en el directorio raíz. Se necesita urgentemente un espacio de nombres. El espacio de nombres es utilizado por todos los controladores y modelos. Esto evita conflictos con otras aplicaciones. Los desarrolladores pueden asegurar sus propios espacios de nombres para el sistema operativo APPNET, en <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a>. Las aplicaciones que se ofrecen y descargan en APPNET OS Store no crean conflictos. La opción de aplicación de Contenedor indica si las aplicaciones, junto con otras aplicaciones de contenedor, se emitirán en un contenedor. Las aplicaciones en el contenedor se pueden ajustar más tarde, en la configuración de la aplicación, el tamaño. Las aplicaciones que siempre utilizan el ancho completo del navegador no deben generarse como aplicaciones de contenedor. Una aplicación de desarrollador creada incluye un controlador, un modelo, dos vistas, archivos de diferentes idiomas, un controlador de administración, un modelo de administración, dos vistas de administrador y diferentes archivos de idioma de administración. Una aplicación de desarrollador también cumple con un widget preparado que consta de un controlador, un modelo y dos vistas y archivos de diferentes idiomas. Además, todos los eventos de administración están preparados.",
    "admin__apps__create__err_no_name" => "Sin nombre introducido",
    "admin__apps__create__err_name" => "El nombre no puede ser usado",
    "admin__apps__create__err_name_exists" => "Ya existe una aplicación con este nombre.",
    "admin__apps__create__conf" => "La aplicación ha sido creada.",
    "admin__apps__create__err_dir" => "No se puede utilizar la entrada de directorio",
    "admin__apps__create__err_dev_name_ex" => "Ya existe una aplicación con ese nombre, en este directorio.",
    "admin__apps__create__err_ns_wrong" => "No se puede utilizar la entrada de espacio de nombres",
    "admin__apps__create__err_ns_exists" => "Ya existe una aplicación con ese nombre, en y ese espacio de nombres.",
    "admin__apps__create__container_app" => "Aplicación de contenedor",
    "admin__apps__create__container_true" => "Aplicación de contenedor",
    "admin__apps__create__container_false" => "Aplicación sin contenedor",
    "admin__apps__create__development" => "Desarrollo",
    "admin__apps__create__smarty" => "Visualiza como plantilla Smarty",
    "admin__apps__create__php" => "Vistas como plantilla PHP",
    "admin__apps__create__cache" => "Caché de aplicaciones",
    "admin__apps__create__cache_false" => "No agregue una característica de caché",
    "admin__apps__create__cache_true" => "Añadir una función de caché",
    "admin__apps__create__html_header" => "Aplicación de plantilla HTML",
    "admin__apps__create__html_description" => "Aplicación HTML basada en plantillas y en varios idiomas. La aplicación tiene su propia área de administración. Gracias al editor wysiwyg y HTML integrado, es fácil personalizar el texto o el código. La aplicación no requiere ningún conocimiento de programación y se puede integrar fácilmente.",
    "admin__apps__create__dev_description" => "Un kit completamente prefabricado para desarrolladores. Se puede utilizar para definir con qué áreas se debe generar la aplicación. Zona de aplicación, área de administración y widget. Los archivos de cadena se crean para cada área. Además, se preparan todos los eventos. La aplicación es adecuada para que los desarrolladores programen sus propias aplicaciones para APPNETOS.",
    "admin__apps__create__name" => "Nombre de la aplicación",
    "admin__apps__create__description" => "Descripción de la aplicación",
    "admin__apps__create__namespace" => "Nombres",
    "admin__apps__create__directory" => "Directorio",
    "admin__apps__create__build" => "Crear",
    "admin__apps__create__widget" => "Widget",
    "admin__apps__create__widget_false" => "No agregue un widget",
    "admin__apps__create__widget_true" => "Añadir widget",
    "admin__apps__create__overview" => "Visión general",
    "admin__apps__create__menu_header" => "Crear una nueva aplicación",
    "admin__apps__create__install_apps" => "Instalar aplicaciones",
    "admin__apps__create__html_string_header" => "Aplicación de cadena HTML",
    "admin__apps__create__html_sting_description" => "Aplicación HTML basada en cadenas en varios idiomas. El área de administración tiene un editor HTML y wysiwyg integrado. En el archivo HTML, se pueden utilizar cadenas de archivos de lenguaje PHP. Se crea un archivo global y un archivo de idioma inglés, pero simplemente puede agregar archivos de idioma. La aplicación requiere habilidades mínimas de programación",
    "admin__apps__create__html_string_info" => "Aplicación HTML multilenguaje basada en cadenas. El área de administración tiene un editor HTML y wysiwyg integrado. Los archivos de cadena se utilizan para el texto. Los textos de los archivos de cadena se pueden transferir fácilmente a HTML. Esto tiene la ventaja de que sólo un archivo HTML tiene que ser generado para todos los idiomas. Cuando se crea la aplicación, se crea un archivo de cadena global y un inglés. Se requiere un editor externo para editar los archivos de cadena. Para otros idiomas, solo es necesario copiar y asignar un archivo de cadena existente con el identificador de país adecuado. El idioma se selecciona automáticamente. Se puede insertar entre 3 idiomas de plantilla seleccionados en las cadenas a continuación.",
    "admin__apps__create__template_language" => "Lenguaje de plantilla",
    "admin__apps__create__twig" => "Vistas como plantillas de pelucas",
];