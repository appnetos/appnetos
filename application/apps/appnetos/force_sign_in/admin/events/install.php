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
 * @description     Force sign in. Use this app on first static top app to force a login.
 */

/**
 * Install.
 */
function install()
{
    // Get date and time.
    $date = new DateTime();
    $date->setTimestamp(time());

    // Get object "core\install".
    $install = \core\objects::getNew('core/install');

    // Install application.
    $install->namespace = 'appnetos';
    $install->directory = 'appnetos';
    $install->name = 'Force Sign In';
    $install->description = 'APPNET OS Force Sign In ' . $date->format('Y.m.d H:i:s');
    $install->container = 1;
    $install->install();

    // Generate directories.
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
    if (!file_exists('out/img/appnetos/eye_close.svg')) {
        copy('application/apps/appnetos/force_sign_in/admin/files/eye_close.svg', 'out/img/appnetos/eye_close.svg');
    }
    if (!file_exists('out/img/appnetos/eye_open.svg')) {
        copy('application/apps/appnetos/force_sign_in/admin/files/eye_open.svg', 'out/img/appnetos/eye_open.svg');
    }
    if (!file_exists('out/img/appnetos/loading.gif')) {
        copy('application/apps/appnetos/force_sign_in/admin/files/loading.gif', 'out/img/appnetos/loading.gif');
    }
    if (!file_exists('out/img/appnetos/secure.svg')) {
        copy('application/apps/appnetos/force_sign_in/admin/files/secure.svg', 'out/img/appnetos/secure.svg');
    }
}