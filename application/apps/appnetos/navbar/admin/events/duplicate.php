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
 * @description     Multilingual Navbar to create extended navigation menus on base of bootstrap Navbar.
 */

/**
 * Duplicate.
 *
 * @param int $id app ID.
 * @throws \core\exception.
 */
function duplicate($id)
{
    // Get objects.
    $config = \core\objects::get('config');
    $database = \core\objects::get('database');

    // Get prefix.
    $prefix = $config->getPrefix();

    // Get date and time.
    $date = new DateTime();
    $date->setTimestamp(time());

    // Get object "core\install".
    $install = \core\objects::getNew('core/install');

    // Install application.
    $install->setNamespace('appnetos');
    $install->setDirectory('appnetos');
    $install->setName('Navbar');
    $install->setDescription('APPNET OS Navbar ' . $date->format('Y.m.d H:i:s'));
    $install->setContainer(1);
    $newId = $install->install();

    // Duplicate database table "appnetos__navbar".
    $oldTable = $prefix . '_appnetos__navbar_' . $id;
    $newTable = $prefix . '_appnetos__navbar_' . $newId;
    $query = 'CREATE TABLE ' . $newTable . ' LIKE ' . $oldTable;
    $database->execute($query);

    // Clone settings.
    $extensions = \core\objects::get('extensions');
    $settings = $extensions->get('text', $id, 'appnetos/navbar');
    $extensions->set($settings, 'text', (int)$newId, 'appnetos/navbar');

    // Create directory.
    if (!is_dir('out')) {
        mkdir('out');
    }
    if (!is_dir('out/img')) {
        mkdir('out/img');
    }
    if (!is_dir('out/img/appnetos')) {
        mkdir('out/img/appnetos');
    }

    // Copy files.
    if (!file_exists('out/img/appnetos/home_dark.svg')) {
        copy('application/apps/appnetos/navbar/admin/files/home_dark.svg', 'out/img/appnetos/home_dark.svg');
    }
    if (!file_exists('out/img/appnetos/home_light.svg')) {
        copy('application/apps/appnetos/navbar/admin/files/home_light.svg','out/img/appnetos/home_light.svg');
    }
    if (!file_exists('out/img/appnetos/loading.gif')) {
        copy('application/apps/appnetos/navbar/admin/files/loading.gif', 'out/img/appnetos/loading.gif');
    }
    if (!file_exists('out/img/appnetos/eye_close.svg')) {
        copy('application/apps/appnetos/navbar/admin/files/eye_close.gif', 'out/img/appnetos/eye_close.svg');
    }
    if (!file_exists('out/img/appnetos/eye_open.svg')) {
        copy('application/apps/appnetos/navbar/admin/files/eye_open.gif', 'out/img/appnetos/eye_open.svg');
    }
}