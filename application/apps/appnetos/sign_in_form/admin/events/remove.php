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
 * @description     Simple form to sign in by email or username and password.
 */

/**
 * Remove.
 *
 * @param int $id app ID.
 * @throws \core\exception.
 */
function remove($id)
{
    // Get object "core\database".
    $database = \core\objects::get('database');

    // Delete from database table "app_extensions".
    $query = 'DELETE FROM app_extensions WHERE xt_key=? AND xt_index=?';
    $database->delete($query, [md5('appnetos/sign_in_form'), $id]);

    // Select from database table "application_apps".
    $query = 'SELECT xt_id FROM application_apps WHERE xt_namespace=?';
    $array = $database->selectArray($query, ['appnetos']);

    // If data exists.
    if ($array) {
        return;
    }

    // Delete files.
    if (file_exists('out/img/appnetos/eye_close.svg')) {
        unlink('out/img/appnetos/eye_close.svg');
    }
    if (file_exists('out/img/appnetos/eye_open.svg')) {
        unlink('out/img/appnetos/eye_open.svg');
    }
    if (file_exists('out/img/appnetos/loading.gif')) {
        unlink('out/img/appnetos/loading.gif');
    }
}