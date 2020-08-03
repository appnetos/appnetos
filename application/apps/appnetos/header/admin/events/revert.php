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
 * @description     Header application with selectable logo and selectable, animated social media icons.
 */

/**
 * Revert.
 *
 * @param int $id app ID.
 * @throws \core\exception.
 */
function revert($id)
{
    // Get objects.
    $config = \core\objects::get('config');
    $database = \core\objects::get('database');

    // Get prefix.
    $prefix = $config->getPrefix();

    // Delete files.
    $dir = 'out/img/appnetos/header/';
    $files = scandir($dir);
    foreach ($files as $file) {
        if (strpos($file, $id . '_') !== false) {
            if (file_exists($dir . $file)) {
                unlink($dir . $file);
            }
        }
    }

    // Truncate database table "appnetos__header".
    $query = 'TRUNCATE TABLE ' . $prefix . '_appnetos__header_' . $id;
    $database->execute($query);
}