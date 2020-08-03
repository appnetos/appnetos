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
 * Remove.
 */
function install()
{
    // Get object "core\database".
    $database = \core\objects::get('database');

    // Delete from database table "application_apps".
    $query = 'DELETE FROM application_apps WHERE xt_namespace=? AND xt_directory=? AND xt_name=?';
    $database->delete($query, ['appnetos', 'appnetos', 'Mailer']);

    // Delete files.
    if (file_exists('out/admin/img/appnetos/widget_mailer.svg')) {
        unlink('out/admin/img/appnetos/widget_mailer.svg');
    }
}