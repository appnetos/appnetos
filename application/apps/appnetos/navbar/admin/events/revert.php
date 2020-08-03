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

    // Delete from database table "app_extensions".
    $query = 'DELETE FROM app_extensions WHERE xt_key=? AND xt_index=?';
    $database->delete($query, [md5('appnetos/navbar'), $id]);

    // Truncate database table "appnetos__navbar".
    $query = 'TRUNCATE TABLE ' . $prefix . '_appnetos__navbar_' . $id;
    $database->execute($query);
}