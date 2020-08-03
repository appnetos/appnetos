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
 * @description     core/appnetos/destruct.php ->    Destruction class. Manage final functions.
 */

// Namespace.
namespace core;

// Class "core\destruct".
class destruct extends base
{
    /**
     * Classes keys with destruct functions.
     *
     * @var array.
     */
    protected $keys = [
        'user',
        'directories',
        'files',
        'cms',
        'strings',
        'log',
        'statistic'
    ];

    /**
     * Add class with destruct function.
     *
     * @var string $key class key.
     * @return bool.
     * @throws exception. Errors: Destruct object not exists error,
     *                            Destruct method not exists error.
     */
    public function add($key)
    {
        // Get object..
        $key = trim($key, '\\/ ');
        $key = str_replace('\\', '/', $key);
        $object = objects::get($key);

        // If not is an object.
        if (!is_object($object)) {
            throw new exception('Destruct object not exists error. Key: "' . $key . '"');
        }

        // If destruct method not exists.
        if (!method_exists($object, 'destruct')) {
            throw new exception('Destruct method not exists error. Key: "' . $key . '"');
        }

        // Add key to keys.
        array_push($this->keys, $key);

        // Return.
        return true;
    }

    /**
     * Run all final destruct functions.
     */
    public function run()
    {
        // Generate directories.
        $this->generateDirectories();

        // Destruct.
        $this->destruct();
    }

    /**
     * Generate directories.
     *
     * @return bool.
     * @throws.
     */
    protected function generateDirectories()
    {
        // Get object "core/config".
        $config = objects::get('config');

        // If caches not active.
        if (!$config->getFileCache() && !$config->getDirectoryCache() && !$config->getStringCache()) {
            return false;
        }

        // Generate directories.
        $array = explode('/', $config->getCacheDir());
        $directory = '';
        foreach ($array as $value) {
            $directory .= $value . '/';
            if (!is_dir(BASEPATH . $directory)) {
                mkdir(BASEPATH . $directory);
            }
        }

        // Return.
        return false;
    }

    /**
     * Destruct all classes destruct functions.
     *
     * @throws exception. Errors: Destruct object not exists error,
     *                            Destruct method not exists error.
     */
    protected function destruct()
    {
        // Destruct all classes destruct functions.
        foreach ($this->keys as $key) {
            $object = objects::get($key);

            // If not is an object.
            if (!is_object($object)) {
                throw new exception('Destruct object not exists error. Key: "' . $key . '"');
            }

            // If destruct method not exists.
            if (!method_exists($object, 'destruct')) {
                throw new exception('Destruct method not exists error. Key: "' . $key . '"');
            }

            // Destruct function.
            $object->destruct();
        }
    }
}