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
 * @description     Background Changer. Define background to set as container-fluid CSS, container CSS or app CSS.
 *                  Defined background can set as random background.
 */

/**
 * Revert.
 *
 * @param int $id app ID.
 */
function revert($id)
{
    // Get objects.
    $database = \core\objects::get('database');

    // Delete files.
    $dir = 'out/img/appnetos/background_changer/';
    $files = scandir($dir);
    foreach ($files as $file) {
        if (strpos($file, $id . '_') !== false) {
            if (file_exists($dir . $file)) {
                unlink($dir . $file);
            }
        }
    }

    // Delete from database table "app_extensions".
    $query = 'DELETE FROM app_extensions WHERE xt_key=? AND xt_index=?';
    $database->delete($query, [md5('appnetos/background_changer'), $id]);
}