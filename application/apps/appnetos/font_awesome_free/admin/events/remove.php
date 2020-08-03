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
 * @description     Installs Font Awesome Free for APPNET OS.
 */

/**
 * Remove.
 *
 * @param int $id app ID.
 */
function remove($id)
{
    // Prepare parameters.
    $source = 'out/fonts/';
    $files = ['fa-brands-400.eot', 'fa-brands-400.svg', 'fa-brands-400.ttf', 'fa-brands-400.woff', 'fa-brands-400.woff2', 'fa-regular-400.eot', 'fa-regular-400.svg', 'fa-regular-400.ttf', 'fa-regular-400.woff', 'fa-regular-400.woff2', 'fa-solid-900.eot', 'fa-solid-900.svg', 'fa-solid-900.ttf', 'fa-solid-900.woff', 'fa-solid-900.woff2'];

    // Delete files.
    for ($i = 0; $i < count($files); $i++) {
        if (file_exists($source . $files[$i])) {
            unlink($source . $files[$i]);
        }
    }
    if (file_exists('application/apps/appnetos/font_awesome_free/application/css/font_awesome_free.css')) {
        unlink('application/apps/appnetos/font_awesome_free/application/css/font_awesome_free.css');
    }
}