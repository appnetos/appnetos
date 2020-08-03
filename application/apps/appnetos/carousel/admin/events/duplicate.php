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
 * @description     APPNET OS Bootstrap carousel. Simply create a picture carousel via the app admin section.
 */

/**
 * Duplicate.
 *
 * @param int $id app ID.
 * @throws \core\exception.
 */
function duplicate($id)
{
    // Get objects.
    $config = \core\objects::get('config');
    $database = \core\objects::get('database');

    // Get prefix.
    $prefix = $config->getPrefix();

    // Get date and time.
    $date = new DateTime();
    $date->setTimestamp(time());

    // Get object "core\install".
    $install = \core\objects::getNew('core/install');

    // Install application.
    $install->setNamespace('appnetos');
    $install->setDirectory('appnetos');
    $install->setName('Carousel');
    $install->setDescription('APPNET OS Carousel ' . $date->format('Y.m.d H:i:s'));
    $install->setContainer(1);
    $newId = $install->install();

    // Duplicate database table "appnetos__carousel".
    $oldTable = $prefix . '_appnetos__carousel_' . $id;
    $newTable = $prefix . '_appnetos__carousel_' . $newId;
    $query = 'CREATE TABLE ' . $newTable . ' LIKE ' . $oldTable;
    $database->execute($query);

    // Clone settings.
    $extensions = \core\objects::get('extensions');
    $settings = $extensions->get('text', $id, 'appnetos/carousel');
    $extensions->set($settings, 'text', (int)$newId, 'appnetos/carousel');
}