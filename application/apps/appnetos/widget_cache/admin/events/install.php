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
 * @description     Admin section dashboard widget to show cache settings and cache options.
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
    $array = $database->selectArray($query, ['appnetos\widgets', 'appnetos', 'Widget Cache']);

    // If app already installed.
    if ($array) {
        return;
    }

    // Get date and time.
    $date = new DateTime();
    $date->setTimestamp(time());

    // Get object "core\install".
    $install = \core\objects::getNew('core/install');

    // Install application.
    $install->namespace = 'appnetos\widgets';
    $install->directory = 'appnetos';
    $install->name = 'Widget Cache';
    $install->description = 'APPNET OS Widget Cache ' . $date->format('Y.m.d H:i:s');
    $install->widget = 1;
    $install->install();

    // Generate directories.
    if (!is_dir('out')) {
        mkdir('out');
    }
    if (!is_dir('out/admin')) {
        mkdir('out/admin');
    }
    if (!is_dir('out/admin/img')) {
        mkdir('out/admin/img');
    }
    if (!is_dir('out/admin/img/appnetos')) {
        mkdir('out/admin/img/appnetos');
    }

    // Copy files.
    if (!file_exists('out/admin/img/appnetos/widget_cache.svg')) {
        copy('application/apps/appnetos/widget_cache/admin/files/widget_cache.svg', 'out/admin/img/appnetos/widget_cache.svg');
    }
}