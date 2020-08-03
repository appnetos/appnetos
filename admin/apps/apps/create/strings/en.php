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
    "admin__apps__create__dev_header" => "Developer app",
    "admin__apps__create__info" => "New apps can be generated in this area. Multilingual HTML apps or advanced developer apps can be generated. HTML apps are template based. For each language set, a separate HTML template can be created in the app admin area. So the app is ready for use. Developer apps are aimed at developers who want to create advanced apps for the APPNETOS. Developer apps include a predefined application area, as well as a predefined admin area and a predefined widget for the admin area. For developer apps, it can be chosen as a template. It can also be chosen the app cache and the container settings with which it is to be generated. Developers can offer their apps, in the marketplace, on <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a> for sale. APPNET OS users can buy and install the apps directly from the admin area.",
    "admin__apps__create__html_info" => "The HTML App Builder creates finished, multilingual, HTML apps. HTML apps have their own admin area. In this area, a separate template can be created and edited for each language set. Thanks to the built-in wysiwyg and HTML editor, it is a lightweight to customize the code. HTML apps are Smarty Template based. This is where ordinary HTML code or Smarty Code can be used. HTML apps are container apps. This allows size and orientation to be changed at any time, in the app settings. A container can be affected at any time. In the app settings, CSS tags can be assigned to the container. If the app container end is defined in an URI before and after the app, then the app is issued individually in a container. A padding is always added to a container app on the left and right. To remove this must be added to the px-0. class in the app settings, in the container CSS. In expert mode, a CSS and JavaScript file can even be added to the app. This mode must be unlocked in the config.inc.php.",
    "admin__apps__create__dev_info" => "Develop apps are prepared apps for developers. To create a developer app requires a name, a namespace and a directory. Developer apps are stored in the root directory for apps application/apps. The Directory option stores the app in the specified subdirectory in the root directory. A namespace is urgently needed. The Namespace is used by all controllers and models. This prevents conflicts with other apps. Developers can secure their own namespaces for APPNETOS, under <a href=\"https://www.appnetos.com\">http://www.appnetos.com</a>. Apps that are offered and downloaded in the APPNET OS Store do not create conflicts. The Container app option indicates whether apps, along with other container apps, will be issued in a container. In container apps can be adjusted later, in the app settings the size. Apps that always use the complete width of the browser should not be generated as container apps. A created developer app includes a controller, a model, two views, different language files, an admin controller, an admin model, two admin views and different admin language files. A developer app also complies with a prepared widget consisting of a controller, a model and two views and different language files. In addition, all admin events are prepared.",
    "admin__apps__create__err_no_name" => "No name entered",
    "admin__apps__create__err_name" => "The name cannot be used",
    "admin__apps__create__err_name_exists" => "There is already a app with this name",
    "admin__apps__create__conf" => "The app has been created",
    "admin__apps__create__err_dir" => "Unable to use directory input",
    "admin__apps__create__err_dev_name_ex" => "There is already a app with that name, in this directory",
    "admin__apps__create__err_ns_wrong" => "Unable to use namespace input",
    "admin__apps__create__err_ns_exists" => "There is already a app with that name, in and that namespace",
    "admin__apps__create__container_app" => "Container app",
    "admin__apps__create__container_true" => "Container app",
    "admin__apps__create__container_false" => "No Container app",
    "admin__apps__create__development" => "Development",
    "admin__apps__create__smarty" => "Views as Smarty templates",
    "admin__apps__create__php" => "Views as PHP templates",
    "admin__apps__create__cache" => "App Cache",
    "admin__apps__create__cache_false" => "Don't add a cache feature",
    "admin__apps__create__cache_true" => "Add a cache feature",
    "admin__apps__create__html_header" => "HTML Template App",
    "admin__apps__create__html_description" => "Template based, multilingual HTML app. The app has its own admin area. Thanks to the built-in wysiwyg and HTML editor, it is easy to customize the text or code. The app does not require any programming knowledge and can be easily integrated.",
    "admin__apps__create__dev_description" => "A completely prefabricated kit for developers. It can be used to define which areas the app should be generated with. Application area, admin area and widget. String files are created for each area. In addition, all events are prepared. The app is suitable for developers to program their own applications for APPNETOS.",
    "admin__apps__create__name" => "Name of the app",
    "admin__apps__create__description" => "Description of the app",
    "admin__apps__create__namespace" => "Namespace",
    "admin__apps__create__directory" => "Directory",
    "admin__apps__create__build" => "Create",
    "admin__apps__create__widget" => "Widget",
    "admin__apps__create__widget_false" => "Don't add a widget",
    "admin__apps__create__widget_true" => "Add widget",
    "admin__apps__create__overview" => "Overview",
    "admin__apps__create__menu_header" => "Create a new app",
    "admin__apps__create__install_apps" => "Install apps",
    "admin__apps__create__html_string_header" => "HTML String App",
    "admin__apps__create__html_sting_description" => "Multilingual string based HTML app. The admin area has a built-in HTML and wysiwyg editor. In the HTML file, strings from PHP language files can be used. A global and an English language file is created, but you can simply adding language files. The app requires minimal programming skills",
    "admin__apps__create__html_string_info" => "String based multilingual HTML app. The admin area has a built-in HTML and wysiwyg editor. String files are used for text. The texts of the string files can be easily transferred to HTML. This has the advantage that only one HTML file has to be generated for all languages. When the app is created, a global and an English string file is created. An external editor is required to edit the string files. For other languages, only an existing string file needs to be copied and named with the appropriate country ID. The language is selected automatically. It can be inserted between 3 template languages selected in the strings in the following.",
    "admin__apps__create__template_language" => "Template Language",
    "admin__apps__create__twig" => "Views as Twig Templates",
];