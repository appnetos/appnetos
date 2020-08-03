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
 * @description     HTML String App.
 */

/**
 * Function delete.
 *
 * @param int $id
 */
function delete($id)
{
    // Delete admin data.
    $dir = 'application/apps/html_string/demo_sign_up/';
    if (file_exists($dir . 'admin/controllers/demo_sign_up.php')) {
        unlink($dir . 'admin/controllers/demo_sign_up.php');
    }
    if (file_exists($dir . 'admin/css/demo_sign_up.css')) {
            unlink($dir . 'admin/css/demo_sign_up.css');
        }
    if (file_exists($dir . 'admin/events/delete.php')) {
        unlink($dir . 'admin/events/delete.php');
    }
    if (file_exists($dir . 'admin/js/demo_sign_up.js')) {
        unlink($dir . 'admin/js/demo_sign_up.js');
    }
    if (file_exists($dir . 'admin/views/demo_sign_up.tpl')) {
        unlink($dir . 'admin/views/demo_sign_up.tpl');
    }
    if (file_exists($dir . 'admin/views/demo_sign_up__menu.tpl')) {
        unlink($dir . 'admin/views/demo_sign_up__menu.tpl');
    }
    if (file_exists($dir . 'admin/controllers/demo_sign_up.php')) {
        unlink($dir . 'admin/controllers/demo_sign_up.php');
    }

    // Delete admin strings.
    if (file_exists($dir . 'admin/strings/global.php')) {
        unlink($dir . 'admin/strings/global.php');
    }
    if (file_exists($dir . 'admin/strings/de.php')) {
        unlink($dir . 'admin/strings/de.php');
    }
    if (file_exists($dir . 'admin/strings/en.php')) {
        unlink($dir . 'admin/strings/en.php');
    }
    if (file_exists($dir . 'admin/strings/es.php')) {
        unlink($dir . 'admin/strings/es.php');
    }
    if (file_exists($dir . 'admin/strings/fr.php')) {
        unlink($dir . 'admin/strings/fr.php');
    }
    if (file_exists($dir . 'admin/strings/it.php')) {
        unlink($dir . 'admin/strings/it.php');
    }
    if (file_exists($dir . 'admin/strings/ru.php')) {
        unlink($dir . 'admin/strings/ru.php');
    }

    // Delete application data.
    if (file_exists($dir . 'application/models/demo_sign_up.php')) {
        unlink($dir . 'application/models/demo_sign_up.php');
    }
    if (file_exists($dir . 'application/css/demo_sign_up.css')) {
            unlink($dir . 'application/css/demo_sign_up.css');
    }
    $files = scandir($dir . 'application/views/');
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            if (file_exists($dir . 'application/views/' . $file)) {
                unlink($dir . 'application/views/' . $file);
            }
        }
    }
    $files = scandir($dir . 'application/strings/');
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            if (file_exists($dir . 'application/strings/' . $file)) {
                unlink($dir . 'application/strings/' . $file);
            }
        }
    }

    // Delete directories.
    rmdir($dir . 'admin/css');
    rmdir($dir . 'admin/js');
    rmdir($dir . 'admin/views');
    rmdir($dir . 'admin/events');
    rmdir($dir . 'admin/strings');
    rmdir($dir . 'admin/controllers');
    rmdir($dir . 'admin');
    rmdir($dir . 'application/css');
    rmdir($dir . 'application/views');
    rmdir($dir . 'application/strings');
    rmdir($dir . 'application');
    rmdir($dir);
}