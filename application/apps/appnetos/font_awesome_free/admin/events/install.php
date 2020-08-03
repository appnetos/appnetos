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
 * @description     Installs Font Awesome Free for APPNET OS.
 */

/**
 * Install.
 */
function install()
{
    // Get object "core\database".
    $database = \core\objects::get('database');

    // Select from database table "application_apps".
    $query = 'SELECT xt_id FROM application_apps WHERE xt_namespace=? AND xt_directory=? AND xt_name=?';
    $array = $database->selectArray($query, ['appnetos', 'appnetos', 'Font Awesome Free']);

    // If app already installed.
    if ($array) return;

    // Get date and time.
    $date = new DateTime();
    $date->setTimestamp(time());

    // Get object "core\install".
    $install = \core\objects::getNew('core/install');

    // Install application.
    $install->namespace = 'appnetos';
    $install->directory = 'appnetos';
    $install->name = 'Font Awesome Free';
    $install->description = 'Font Awesome Free ' . $date->format('Y.m.d H:i:s');
    $install->install();

    // Prepare parameters.
    $source = 'application/apps/appnetos/font_awesome_free/admin/files/';
    $css = 'application/apps/appnetos/font_awesome_free/application/css/font_awesome_free.css';
    $target = 'out/fonts/';
    $files = ['fa-brands-400.eot', 'fa-brands-400.svg', 'fa-brands-400.ttf', 'fa-brands-400.woff', 'fa-brands-400.woff2', 'fa-regular-400.eot', 'fa-regular-400.svg', 'fa-regular-400.ttf', 'fa-regular-400.woff', 'fa-regular-400.woff2', 'fa-solid-900.eot', 'fa-solid-900.svg', 'fa-solid-900.ttf', 'fa-solid-900.woff', 'fa-solid-900.woff2'];
    $strings = ['url(\'../../out/fonts/fa-brands-400.eot\')', 'url(\'../../out/fonts/fa-brands-400.eot?#iefix\')', 'url(\'../../out/fonts/fa-brands-400.woff2\')', 'url(\'../../out/fonts/fa-brands-400.woff\')', 'url(\'../../out/fonts/fa-brands-400.ttf\')', 'url(\'../../out/fonts/fa-brands-400.svg#fontawesome\')', 'url(\'../../out/fonts/fa-regular-400.eot\')', 'url(\'../../out/fonts/fa-regular-400.eot?#iefix\')', 'url(\'../../out/fonts/fa-regular-400.woff2\')', 'url(\'../../out/fonts/fa-regular-400.woff\')', 'url(\'../../out/fonts/fa-regular-400.ttf\')', 'url(\'../../out/fonts/fa-regular-400.svg#fontawesome\')', 'url(\'../../out/fonts/fa-solid-900.eot\')', 'url(\'../../out/fonts/fa-solid-900.eot?#iefix\')', 'url(\'../../out/fonts/fa-solid-900.woff2\')', 'url(\'../../out/fonts/fa-solid-900.woff\')', 'url(\'../../out/fonts/fa-solid-900.ttf\')', 'url(\'../../out/fonts/fa-solid-900.svg#fontawesome\')'];

    // Create directory.
    if (!is_dir('out')) {
        mkdir('out');
    }
    if (!is_dir('out/fonts')) {
        mkdir('out/fonts');
    }

    // Copy files.
    for ($i = 0; $i < count($files); $i++) {
        if (file_exists($source . $files[$i])) {
            copy($source . $files[$i], $target . $files[$i]);
        }
    }

    // Get URL from object "core\config".
    $config = \core\objects::get('config');
    $url = $config->getUrl();

    // Generate CSS file.
    $file = file_get_contents($source . 'font_awesome_free.css');
    for ($i = 0; $i < count($strings); $i++) {
        $replace = str_replace('../../', $url . '/', $strings[$i]);
        $file = str_replace($strings[$i], $replace, $file);
    }
    if (!is_dir('application/apps/appnetos/font_awesome_free/application')) {
        (mkdir('application/apps/appnetos/font_awesome_free/application'));
    }
    if (!is_dir('application/apps/appnetos/font_awesome_free/application/css')) {
        (mkdir('application/apps/appnetos/font_awesome_free/application/css'));
    }
    file_put_contents($css, $file);
}