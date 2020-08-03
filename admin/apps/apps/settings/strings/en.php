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
    "admin__apps__settings__css_conf" => "CSS has been saved",
    "admin__apps__settings__js_conf" => "JavaScript has been saved",
    "admin__apps__settings__css_err" => "CSS could not be saved",
    "admin__apps__settings__js_err" => "JavaScript could not be saved",
    "admin__apps__settings__warning" => "Be careful when editing. Changes can change the app's behavior in a sustainable way. Incorrect changes can destroy the app, output, and features.",
    "admin__apps__settings__css_info" => "In the CSS Editor, the CSS file of the app can be edited. The app's CSS file is stored in the app directory. This CSS file is automatically loaded with the app. If an app does not have a CSS file, a new one is created. If the cache is active, it must be emptied to apply the changes.",
    "admin__apps__settings__js_info" => "In the JavaScript Editor, the JavaScript file of the app can be edited. The app's JavaScript file is stored in the app directory. This JavaScript file is automatically loaded with the app. If an app does not have a JavaScript file, a new one is created. If the cache is active, it must be emptied to apply the changes.",
    "admin__apps__settings__data_err" => "The data could not be saved",
    "admin__apps__settings__data_conf" => "The data has been saved",
    "admin__apps__settings__size_err" => "The size and orientation could not been saved",
    "admin__apps__settings__size_conf" => "The size and orientation has been saved",
    "admin__apps__settings__header_col_xl" => "App layout for screen width >1200px",
    "admin__apps__settings__header_col_lg" => "App layout for screen width 992-1200px",
    "admin__apps__settings__header_col_md" => "App layout for screen width 720-992px",
    "admin__apps__settings__header_col_sm" => "App layout for screen width 576-720px",
    "admin__apps__settings__header_col" => "App Layout for Screen Width <576px",
    "admin__apps__settings__grid_css" => "Bootstrap Grid CSS",
    "admin__apps__settings__size_info" => "For container apps, the size and orientation can be edited. If a container app does not adjust the size and orientation, it will be output in full width. APPNET OS uses Bootstrap and the Bootstrap Grid System for its containers. The Grid System uses 5 device sizes. Each size is divided into 12 parts. The size and orientation of container apps can be defined by these parts. If you place two container apps with each other and define the size with 6 parts each, the apps are output side by side in two equal parts. If you define the first app in a container with 4 parts and the second with 8 parts, the right app is output twice as big as the left app. If three apps are defined in a container of 4 parts each, then the three apps are output side by side, in the same size. If you define 12 parts for the first app and 6 parts for the following two, the first app will be output in full width and the next two, including in with half the width. If the apps are correctly defined for each device size, you get a perfect responsive design.",
    "admin__apps__settings__data_info" => "If an app has an admin area, then it can be accessed via the settings. Apps can also be loaded into containers along with other apps. This app is called container apps. Container apps can adjust their size and orientation. For example, if two apps are loaded in a container and the size is set to 50% for each app, then they are output side by side. CSS tags can also be added to the container. This makes it possible to influence the appearance of a container with multiple apps. Beware, if multiple apps are loaded in one container and multiple apps customize the CSS container, all CSS tags are added to the container. App CSS allows you to add CSS tags to each app in a container. In expert mode, you can even edit an app's CSS and JavaScript. This mode must be unlocked in the config.inc.php. But beware. If the CSS or JavaScript is changed in expert mode, apps or even the entire page can be mutilated or permanently destroyed.",
    "admin__apps__settings__menu_header" => "App Settings",
    "admin__apps__settings__admin_area" => "Admin area",
    "admin__apps__settings__description" => "Description",
    "admin__apps__settings__size_and_align" => "Size and orientation",
    "admin__apps__settings__css_container_fluid" => "CSS container-fluid",
    "admin__apps__settings__css_container" => "CSS container",
    "admin__apps__settings__css_app" => "CSS App",
    "admin__apps__settings__edit_css" => "Edit CSS",
    "admin__apps__settings__edit_js" => "Edit JavaScript",
    "admin__apps__settings__management" => "App management",
    "admin__apps__settings__app_data" => "App data",
    "admin__apps__settings__activate" => "Activate",
    "admin__apps__settings__deactivate" => "Deactivate",
    "admin__apps__settings__activated" => "Enabled",
    "admin__apps__settings__deactivated" => "Disabled",
    "admin__apps__settings__no_description" => "No description",
    "admin__apps__settings__app_id" => "App ID",
    "admin__apps__settings__properties" => "Properties",
    "admin__apps__settings__frontend" => "Frontend",
    "admin__apps__settings__no_content" => "No content",
    "admin__apps__settings__static" => "Static",
    "admin__apps__settings__not_static" => "Not static",
    "admin__apps__settings__size" => "Size and orientation",
    "admin__apps__settings__no_container_css" => "No container CSS",
    "admin__apps__settings__no_container_fluid_css" => "No container-fluid CSS",
    "admin__apps__settings__no_app_css" => "No app CSS",
    "admin__apps__settings__container_fluid" => "container-fluid",
    "admin__apps__settings__container" => "Container",
    "admin__apps__settings__apps" => "Apps",
    "admin__apps__settings__save" => "Save",
    "admin__apps__settings__cache" => "Use app cache",
    "admin__apps__settings__js_cache" => "Use JavaScript cache",
    "admin__apps__settings__css_cache" => "Use CSS cache",
];