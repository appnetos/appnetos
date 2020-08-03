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
 * @description     core/appnetos/cache.php ->    Cache class. Get and set cached apps from database table
 *                  "application_cache".
 */

// Namespace.
namespace core;

// Class "core\cache".
class cache extends base
{

    /**
     * Used use app cache from object "core\config".
     *
     * @var bool.
     */
    protected $_appCache = false;

    /**
     * Used global app cache expire time in seconds from object "core\config".
     *
     * @var int.
     */
    protected $_cacheExpire = 3600;

    /**
     * Used active language from object "core\languages".
     *
     * @var string.
     */
    protected $_languages = null;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * cache constructor.
     */
    public function __construct()
    {
        // Get and set used data.
        $this->getSet();
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Set used objects.
        $this->_database = objects::get('database');

        // Set used variables.
        $config = objects::get('core\config');
        $this->_appCache = $config->getAppCache();
        $this->_cacheExpire = $config->getCacheExpire();
        $language = objects::get('languages');
        $this->_languages = $language->getActive();
    }

    /**
     * Get app from cache.
     *
     * @param $id int.
     * @param $namespace string.
     * @param $name string.
     * @return mixed.
     */
    public function getApp($id, $namespace, $name)
    {
        // If app cache not active.
        if (!$this->_appCache) {
            return false;
        }

        // Generate md5 hash.
        $hash = md5($id . $namespace . $name . $this->_languages);

        // Get data from database table "cache".
        $query = 'SELECT xt_expire, xt_content FROM application_cache WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$hash]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // If cache not expired.
        if ((int)$row['xt_expire'] > time()) {
            return $row['xt_content'];
        }

        // Clear cache.
        $query = 'DELETE FROM application_cache WHERE xt_id=?';
        $this->_database->delete($query, [$hash]);

        // Return.
        return false;
    }

    /**
     * Set app to cache.
     *
     * @param $content.
     * @param $id int.
     * @param $namespace string.
     * @param $name string.
     * @param $cacheExpire int.
     * @return bool.
     */
    public function setApp($content, $id, $namespace, $name, $cacheExpire = null)
    {
        // Prepare parameters.
        if (!$cacheExpire) {
            $cacheExpire = $this->_cacheExpire;
        }

        // If app cache not active.
        if (!$this->_appCache) {
            return false;
        }

        // Generate md5 hash.
        $hash = md5($id . $namespace . $name . $this->_languages);

        // Get data from database table "cache".
        $query = 'SELECT xt_id FROM application_cache WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$hash]);

        // Id data not exists.
        if (!$row) {

            // Insert data to database table "cache".
            $query = 'INSERT INTO application_cache (xt_id, xt_expire, xt_content) VALUES (?,?,?)';
            return $this->_database->insert($query, [$hash, (time() + $cacheExpire), trim($content)]);

        }

        // If data exists, update data in database table "cache".
        $query = 'UPDATE application_cache SET xt_expire=?, xt_content=? WHERE xt_id=?';
        return $this->_database->update($query, [(time() + $cacheExpire), trim($content), $hash]);
    }

    /**
     * Clear app cache.
     *
     * @return bool.
     * @throws exception.
     */
    public function clearCache()
    {
        // Get used objects.
        $uri = objects::get('uri');

        // If is not admin.
        if (!$uri->getAdmin()) {
            return false;
        }

        // Clear app cache.
        $query = 'DELETE FROM application_cache WHERE xt_id > ?';
        $this->_database->delete($query, [0]);
        return true;
    }
}