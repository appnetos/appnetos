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
 * Activate.
 *
 * @param int $id app ID.
 */
function activate($id)
{
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
    if (!is_dir('out/img/appnetos/header')) {
        mkdir('out/img/appnetos/header');
    }
}