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
 * @description     Allows other apps to send messages through the set-up mailmail mailboxes. Creates logs for advanced
 *                  information and a widget for the dashboard.
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
    $row = $database->selectRow($query, ['appnetos', 'appnetos', 'Mailer']);

    // If app already installed.
    if ($row) {
        return;
    }

    // Get date and time.
    $date = new DateTime();
    $date->setTimestamp(time());

    // Get object "core\install".
    $install = \core\objects::getNew('core/install');

    // Install application.
    $install->namespace = 'appnetos';
    $install->directory = 'appnetos';
    $install->name = 'Mailer';
    $install->description = 'APPNET OS Mailer ' . $date->format('Y.m.d H:i:s');
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
    copy('application/apps/appnetos/mailer/admin/files/widget_mailer.svg', 'out/admin/img/appnetos/widget_mailer.svg');
}