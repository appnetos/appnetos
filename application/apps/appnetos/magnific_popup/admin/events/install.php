<?php
/**
 * START LICENSE HEADER
 *
 * The license header may not be removed.
 *
 * About this app.
 * This file is a part of APPNET OS (Application Internet Operating System).
 * @link            http://www.appnetos.com
 * @mail            info@appnetos.com
 *
 * Licensed under the MIT License.
 * https://opensource.org/licenses/MIT
 *
 * @copyright       (C) xtrose Media Studio 2019
 * @author          Moses Rivera
 *                  Im Wiesengrund 24
 *                  73540 Heubach
 * @mail            media.studio@xtrose.de
 *
 * About Magnific Popup.
 * @link            https://dimsemenov.com/plugins/magnific-popup
 * @GitHub          https://github.com/dimsemenov/Magnific-Popup
 *
 * END LICENSE HEADER
 *
 * @description     Add jQuery lightbox plugin Magnific Popup to our page.
 */

/**
 * Install.
 */
function install()
{
    // Get objects.
    $database = \core\objects::get('database');

    // Check if already installed.
    $query = 'SELECT xt_id FROM application_apps WHERE xt_name=? AND xt_namespace=?';
    $row = $database->selectRow($query, ['Magnific Popup', 'appnetos']);
    if ($row) {
        return false;
    }

    // Get date and time.
    $date = new DateTime();
    $date->setTimestamp(time());

    // Get object "core\install".
    $install = \core\objects::getNew('core/install');

    // Install application.
    $install->setNamespace('appnetos');
    $install->setDirectory('appnetos');
    $install->setName('Magnific Popup');
    $install->setDescription('Magnific Popup jQuery lightbox plugin ' . $date->format('Y.m.d H:i:s'));
    $install->setContainer(0);
    $install->setCacheable(0);
    $install->install();
}