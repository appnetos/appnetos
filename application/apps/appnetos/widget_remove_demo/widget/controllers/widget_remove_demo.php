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
 * @description     Admin section dashboard widget to show cache settings and cache options.
 */

// Namespace.
namespace appnetos\widgets;

// Use.
use core\objects;

// Controller "appnetos\widgets\widget_remove_demo"
class widget_remove_demo
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;


    /**
     * widget_remove_demo constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {

        // Get app ID by object "core\objects".
        $this->appId = objects::getApp()->getId();

        // Get action.
        $post = objects::get('post');
        $action = $post->get('appnetos__widget__widget_remove_demo__remove');
        if ($action === 'on') {
            $this->remove();
        }
    }

    /**
     * Remove demo.
     */
    protected function remove()
    {
        // Get object "core\database" and object "core\config".
        $database = objects::get('database');
        $config = objects::get('config');

        // Truncate database table "app_extensions".
        $query = 'SELECT xt_index, xt_longtext FROM app_extensions WHERE xt_key=?';
        $entries = $database->selectArray($query, ['6220a1ad2650b388eb49085e93c5882f']);
        $query = 'TRUNCATE ' . $config->getPrefix() . '_app_extensions';
        $database->execute($query);
        foreach ($entries as $entry) {
            $query = 'INSERT INTO app_extensions (xt_key, xt_index, xt_longtext) VALUES (?, ?, ?)';
            $database->insert($query, ['6220a1ad2650b388eb49085e93c5882f', $entry['xt_index'], $entry['xt_longtext']]);
        }

        // Truncate database table "application_authentication".
        $query = 'TRUNCATE ' . $config->getPrefix() . '_application_authentication';
        $database->execute($query);

        // Truncate database table "application_cache".
        $query = 'TRUNCATE ' . $config->getPrefix() . '_application_cache';
        $database->execute($query);

        // Truncate database table "application_cms".
        $query = 'TRUNCATE ' . $config->getPrefix() . '_application_cms';
        $database->execute($query);
        $query = "INSERT INTO application_cms VALUES (1,0,'global','','',0,'','','','',0,0)";
        $database->insert($query);

        // Truncate database table "application_static".
        $query = 'TRUNCATE ' . $config->getPrefix() . '_application_static';
        $database->execute($query);
        $query = "INSERT INTO application_static VALUES (1,'','')";
        $database->insert($query);

        // Truncate database table "appnetos__carousel_104".
        $query = 'TRUNCATE ' . $config->getPrefix() . '_appnetos__carousel_104';
        $database->execute($query);

        // Truncate database table "appnetos__header_103".
        $query = 'TRUNCATE ' . $config->getPrefix() . '_appnetos__header_103';
        $database->execute($query);

        // Truncate database table "appnetos__navbar_102".
        $query = 'TRUNCATE ' . $config->getPrefix() . '_appnetos__navbar_102';
        $database->execute($query);

        // Delete from database table "application_apps".
        $query = 'DELETE FROM application_apps WHERE xt_id > ?';
        $database->delete($query, [1000]);
        $query = 'ALTER TABLE ' . $config->getPrefix() . '_application_apps AUTO_INCREMENT = 1001';
        $database->execute($query);

        // Delete app directories.
        $directories = [
            'application/apps/html_string',
            'application/apps/appnetos/widget_remove_demo'
        ];
        foreach ($directories as $directory) {
            $this->rrmdir($directory);
        }

        // Delete files.
        if (file_exists('out/admin/img/appnetos/widget_remove_demo.svg')) {
            unlink('out/admin/img/appnetos/widget_remove_demo.svg');
        }

        // Redirect.
        $render = objects::get('render');
        $uri = $render->getUrl(1);
        header('Location: '.$uri);
        exit;
    }

    /**
     * Recursive delete directory.
     *
     * @param $dir.
     */
    protected function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                        $this->rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                    else
                        unlink($dir. DIRECTORY_SEPARATOR .$object);
                }
            }
            rmdir($dir);
        }
    }
}