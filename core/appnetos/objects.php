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
 * @description     core/appnetos/objects.php ->    Class for object management, register objects to get access from
 *                  all objects or templates. Register all apps to get access from all objects or templates. Register
 *                  last app to get access from objects or template.
 */

// Namespace.
namespace core;

// Class "core\objects".
class objects extends base
{

    /**
     * \stdClass with all registered objects.
     *
     * @var \stdClass.
     */
    public static $objects = null;

    /**
     * \stdClass with all registered app objects.
     *
     * @var \stdClass.
     */
    public static $apps = null;

    /**
     * Last registered app object.
     *
     * @var object.
     */
    public static $app = null;

    /**
     * Core objects.
     *
     * @var array.
     */
    protected $coreObjects = [
        'core/statistic',
        'core/config',
        'core/log',
        'core/database',
        'core/session',
        'core/cookie',
        'core/get',
        'core/post',
        'core/request',
        'core/extensions',
        'core/uri',
        'core/settings',
        'core/languages',
        'core/cache',
        'core/directories',
        'core/files',
        'core/authentication',
        'core/user',
        'core/group',
        'core/cms',
        'core/uuid',
        'core/apps',
        'core/strings',
        'core/css',
        'core/js',
        'core/users',
        'core/destruct',
    ];

    /**
     * Extended classes.
     *
     * @var array.
     */
    protected $_extended = [];

    /**
     * objects constructor.
     */
    public function __construct()
    {
        // Set objects.
        self::$objects = new \stdClass();
        self::$apps = new \stdClass();

        // Set extended classes.
        if (defined('EXTENDED__CLASSES')) {
            $array = EXTENDED__CLASSES;
            if (is_array($array)) {
                $this->_extended = $array;
            }
        }

        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Set core objects.
        foreach ($this->coreObjects as $object) {
            $class = $object;
            if (isset($this->_extended[$object])) {
                $class = $this->_extended[$object];
            }
            $class = str_replace('/', '\\', $class);
            self::set($object, new $class());
        }

        // Set core render object.
        $uri = self::get('uri');
        $class = 'core/render';
        if ($uri->getAjax()) {
            $class = 'core/ajax';
        }
        if (isset($this->_extended[$class])) {
            $class = $this->_extended[$class];
        }
        $class = str_replace('/', '\\', $class);
        self::set('core/render', new $class());
    }

    /**
     * Register object and set to object of registered objects by object key "namespace/name".
     *
     * @param string $key object key "namespace/name".
     * @param object $object app object.
     * @param bool $assign assign object to object "core\render".
     * @return bool.
     * @throws exception. Error: Class is not an object error.
     */
    public static function set($key, $object, $assign = false)
    {
        // Prepare key.
        $key = trim($key, '\\/ ');
        $key = str_replace("\\", "/", $key);

        // Set object to objects
        if (gettype($object) !== 'object') {
            throw new exception('Class is not an object error. Class "' . $key . '"');
        }
        self::$objects->{$key} = $object;

        // Assign object to object "core\render".
        if (!$assign) {
            return true;
        }
        if (!isset(self::$objects->{'core/render'})) {
            return true;
        }
        $key = str_replace("/", "__", $key);
        $render = self::get('render');
        $render->assign($key, $object);

        // Return.
        return true;
    }

    /**
     * Get object from registered objects by key "namespace/name".
     *
     * @param string $key object key "namespace/name".
     * @param bool $assign assign object to object "core\render".
     * @return object or bool.
     * @throws exception.
     */
    public static function get($key, $assign = false)
    {
        // Prepare key.
        $key = trim($key, '\\/ ');
        $key = str_replace("\\", "/", $key);

        // If object exists.
        if (isset(self::$objects->{$key})) {
            return self::$objects->{$key};
        }

        // Get object as core object.
        $array = explode ('core/', $key);
        if (count($array) === 1) {
            if (isset(self::$objects->{'core/' . $key})) {
                return self::$objects->{'core/' . $key};
            }
        }

        // Get object by filename.
        $files = self::get('files');
        $file = $files->getClass($key);
        if (!$file) {
            return false;
        }
        $key = str_replace("/", "\\", $key);
        $object = self::getNew($key);
        self::set($key, $object, $assign);

        // Return object.
        return $object;
    }

    /**
     * Get new object by key "namespace/name".
     * *
     * @param string $key object key "namespace/name".
     * @param array $parameters object parameters.
     * @param bool $assign assign object to object "core\render".
     * @return object or bool.
     * @throws exception.
     */
    public static function getNew($key, $parameters = null, $assign = false)
    {
        // Prepare parameters.
        $object = null;

        // Prepare key.
        $key = trim($key, '\\/ ');
        $key = str_replace("\\", "/", $key);
        $array = explode('/', $key);

        // If class exists.
        if (isset(self::$objects->{$key})) {
            $class = get_class(self::$objects->{$key});
            if ($parameters) {
                $object = new $class($parameters);
            } else {
                $object = new $class();
            }
            self::set($key, $object, $assign);
            return $object;
        }

        // If class exists as core class.
        elseif (count($array) === 1) {
            if (isset(self::$objects->{'core/' . $key})) {
                $class = get_class(self::$objects->{'core/' . $key});
                if ($parameters) {
                    $object = new $class($parameters);
                } else {
                    $object = new $class();
                }
                self::set($key, $object, $assign);
                return $object;
            }
        }

        if (defined('EXTENDED__CLASSES')) {
            $arrayExtended = EXTENDED__CLASSES;

            // If class exists as extended class.
            if (isset($arrayExtended[$key])) {
                $class = $arrayExtended[$key];
                if ($parameters) {
                    $object = new $class($parameters);
                } else {
                    $object = new $class();
                }
                self::set($key, $object, $assign);
                return $object;
            }

            // If class exists as core extended class.
            elseif (count($array) === 1) {
                if (isset($arrayExtended['core/' . $key])) {
                    $class = $arrayExtended['core/' . $key];
                    if ($parameters) {
                        $object = new $class($parameters);
                    } else {
                        $object = new $class();
                    }
                    self::set($key, $object, $assign);
                    return $object;
                }
            }
        }

        // New class.
        $class = str_replace("/", "\\", $key);
        if (count($array) > 1) {
            if (class_exists($class)) {
                if ($parameters) {
                    $object = new $class($parameters);
                } else {
                    $object = new $class();
                }
                self::set($key, $object, $assign);
                return $object;
            }
            else {
                return false;
            }
        }

        // New core class.
        else {
            $class = 'core\\' . $key;
            if (class_exists($class)) {
                if ($parameters) {
                    $object = new $class($parameters);
                } else {
                    $object = new $class();
                }
                self::set($key, $object, $assign);
                return $object;
            }
            else {
                return false;
            }
        }
    }

    /**
     * Register app and set to object of registered apps by app key "namespace/name".
     *
     * @param string $key app key "namespace/name".
     * @param objects $object app object.
     * @return bool.
     */
    public static function setApp($key, $object)
    {
        // Set app as last registered app.
        self::$app = $object;

        // Prepare key.
        $key = str_replace(" ", "_", strtolower($key));
        $key = str_replace("\\", "/", $key);

        // If app object already exists.
        if (isset(self::$apps->{$key})) {

            // If app objects exists more than one times.
            if (gettype(self::$apps->{$key}) === 'array') {
                array_push(self::$apps->{$key}, $object);
                return true;
            }

            // If object exists one time.
            elseif (gettype(self::$apps->{$key}) === 'object') {
                $array = [self::$apps->{$key}, $object];
                self::$apps->{$key} = $array;
                return true;
            }
        }

        // If object not exists.
        self::$apps->{$key} = $object;
        return true;
    }

    /**
     * Get app from registered objects by app key "namespace/name".
     *
     * @param string $key app key "namespace/name".
     * @param int $index app position if more as one app with key is registered.
     * @return object or bool.
     * @throws.
     */
    public static function getApp($key = null, $index = null)
    {
        // If key not is set, return last registered app.
        if (!$key) {
            $object = self::$app;
            if ($object) {
                return $object;
            }
            return false;
        }

        // Prepare key.
        $key = str_replace(" ", "_", strtolower($key));
        $key = str_replace("\\", "/", $key);

        // If app not exists.
        if (!isset(self::$apps->{$key})) {
            return false;
        }

        // If app exists one time.
        if (gettype(self::$apps->{$key}) === 'object') {
            return self::$apps->{$key};
        }

        // If app exists more than one times.
        if (gettype(self::$apps->{$key}) === 'array') {

            // If index not null.
            if ($index !== null) {
                if (isset(self::$apps->{$key}[$index])) {
                    return self::$apps[$key][$index];
                }
            }

            // If index is null.
            if (!$index) {
                return self::$apps->{$key}[(count(self::$apps->{$key}) - 1)];
            }
        }

        // Return.
        return false;
    }
}