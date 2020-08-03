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
 * Install.
 */
function install()
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
    $install->setName('Header');
    $install->setDescription('APPNET OS Header ' . $date->format('Y.m.d H:i:s'));
    $install->setContainer(1);
    $install->setCacheable(1);
    $id = $install->install();

    // Create database table "appnetos__header".
    $query = 'CREATE TABLE ' . $prefix . '_appnetos__header_' . $id . ' (xt_id INT(10) NOT NULL AUTO_INCREMENT, xt_parent_id INT(10) NOT NULL DEFAULT 0, xt_active TINYINT NOT NULL DEFAULT 1, xt_language_key VARCHAR(20) NOT NULL, xt_logo TINYINT NOT NULL DEFAULT 0, xt_sort INT(10) NOT NULL DEFAULT 0, xt_img VARCHAR(10) NOT NULL, xt_link VARCHAR(255) NOT NULL, xt_width INT(10) NOT NULL DEFAULT 0, PRIMARY KEY (xt_id)) ENGINE=InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci';
    $database->execute($query);
}