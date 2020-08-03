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
 * @description     core/appnetos/files.php ->    File cache. Contains all file information for string files, CSS files,
 *                  JavaScript files, template and view files. Get file information from file cache. Collects all file
 *                  information at runtime and add it to files cache file.
 */

// Namespace.
namespace core;

// Class "core\files".
class files extends base
{

    /**
     * Cached classes as \stdClass.
     *
     * @var \stdClass.
     */
    protected $class = null;

    /**
     * Cached strings as \stdClass.
     *
     * @var \stdClass.
     */
    protected $string = null;

    /**
     * Cached css as \stdClass.
     *
     * @var \stdClass.
     */
    protected $css = null;

    /**
     * Cached JavaScript as \stdClass.
     *
     * @var \stdClass.
     */
    protected $js = null;

    /**
     * Cached views as \stdClass.
     *
     * @var \stdClass.
     */
    protected $view = null;

    /**
     * If cache file exists.
     *
     * @var bool.
     */
    protected $exists = false;

    /**
     * If content has changed.
     *
     * @var bool.
     */
    protected $changed = false;

    /**
     * Used if file cache is active from object "core\config".
     *
     * @var array.
     */
    protected $_cache = false;

    /**
     * Used path to cache file from object "core\config".
     *
     * @var string.
     */
    protected $_file = null;

    /**
     * If is admin section request from object "core/uri".
     *
     * @var bool.
     */
    protected $_admin = null;


    /**
     * Used object "core\directories" get on runtime.
     *
     * @var object.
     */
    protected $_directories = null;

    /**
     * files constructor.
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
        // Set parameters as \stdClass.
        $this->class = new \stdClass();
        $this->string = new \stdClass();
        $this->css = new \stdClass();
        $this->js = new \stdClass();
        $this->view = new \stdClass();

        // Get used variables.
        $config = objects::get('config');
        $this->_cache = $config->getFileCache();
        $this->_file = trim($config->getCacheDir(), "\\/") . '/files.json';

        // Get if is admin section request.
        $uri = objects::get('uri');
        $this->_admin = $uri->getAdmin();

        // If cache is not active.
        $uri = objects::get('uri');
        if ($uri->getAdmin()) {
            $this->_cache = false;
        }
        if (!$this->_cache) return;

        // If cache file not exists.
        if (!file_exists($this->_file)) {
            return;
        }

        // Get cache file.
        $this->exists = true;
        $cache = json_decode(file_get_contents($this->_file));
        foreach ($cache as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Get class.
     *
     * @param string $class class.
     * @return string or bool.
     * @throws.
     */
    public function getClass($class)
    {
        // Prepare parameters.
        $class = str_replace("/", "\\", $class);
        $array = explode("\\", $class);
        $name = end($array);
        $cacheName = implode('__', $array);

        // Get class by file cache.
        if (isset($this->class->{$cacheName})) {
            return $this->class->{$cacheName};
        }

        // Get custom class directories from object "core\directories".
        if ($this->_directories === null) {
            $this->_directories = objects::get('directories');
        }
        $directories = $this->_directories->getCustomClass();

        // Go through all custom class directories.
        foreach ($directories as $directory) {

            // Get file by custom directory.
            $file = $directory . $name . '.php';
            if (file_exists(BASEPATH . $file)) {
                require_once BASEPATH . $file;
                if (!class_exists($class)) {
                    continue;
                }
                $this->class->{$cacheName} = $file;
                $this->changed = true;
                return $file;
            }
        }

        // Get class directories.
        $directories = $this->_directories->getClass();

        // Go through all class directories.
        foreach ($directories as $directory) {

            // Get file by directory.
            $file = $directory . $name . '.php';
            if (file_exists(BASEPATH . $file)) {
                require_once BASEPATH . $file;
                if (!class_exists($class)) {
                    continue;
                }
                $this->class->{$cacheName} = $file;
                $this->changed = true;
                return $file;
            }
        }

        // If class not exists.
        $this->class->{$cacheName} = null;
        $this->changed = true;
        return false;
    }

    /**
     * Set class.
     *
     * @param string $name class name.
     * @param string $file class file.
     * @return bool.
     */
    public function setClass($name, $file)
    {
        // Get class by name.
        if (isset($this->class->{$name})) {
            return false;
        }

        // If class not exists.
        $this->class->{$name} = $file;
        $this->changed = true;

        // Return.
        return true;
    }

    /**
     * Get view.
     *
     * @param string $file file path and name without extension.
     * @param int $id app ID.
     * @return string or bool.
     */
    public function getView($file, $id = null)
    {
        // Prepare parameters.
        $file = str_replace("\\", "/", $file);
        $file = str_replace(BASEPATH, "", $file);
        $array = explode('/', $file);
        $name = end($array);
        if (!$id) {
            if (objects::$app) {
                $id = objects::$app->getId();
            }
            else {
                $id = 0;
            }
        }

        // If view exists.
        if (isset($this->view->{$id})) {
            if (isset($this->view->{$id}->{$file})) {
                return $this->view->{$id}->{$file};
            }
        }

        // If is application.
        if (!$this->_admin) {

            // Try get custom view by app ID as ".tpl".
            if (file_exists(BASEPATH . 'custom/' . $id . '/application/views/' . $name . '.tpl')) {
                $view = new \stdClass();
                $view->file = 'custom/' . $id . '/application/views/' . $name . '.tpl';
                $view->extension = '.tpl';
                if (!isset($this->view->{$id})) {
                    $this->view->{$id} = new \stdClass();
                }
                $this->view->{$id}->{$file} = $view;
                $this->changed = true;
                return $this->view->{$id}->{$file};
            }

            // Try get custom view by app ID as ".twig".
            else if (file_exists(BASEPATH . 'custom/' . $id . '/application/views/' . $name . '.twig')) {
                $view = new \stdClass();
                $view->file = 'custom/' . $id . '/application/views/' . $name . '.twig';
                $view->extension = '.twig';
                if (!isset($this->view->{$id})) {
                    $this->view->{$id} = new \stdClass();
                }
                $this->view->{$id}->{$file} = $view;
                $this->changed = true;
                return $this->view->{$id}->{$file};
            }

            // Try get custom view by app ID as ".php".
            else if (file_exists(BASEPATH . 'custom/' . $id . '/application/views/' . $name . '.php')) {
                $view = new \stdClass();
                $view->file = 'custom/' . $id . '/application/views/' . $name . '.php';
                $view->extension = '.php';
                if (!isset($this->view->{$id})) {
                    $this->view->{$id} = new \stdClass();
                }
                $this->view->{$id}->{$file} = $view;
                $this->changed = true;
                return $this->view->{$id}->{$file};
            }

            // Try get custom view by app ID as ".html".
            else if (file_exists(BASEPATH . 'custom/' . $id . '/application/views/' . $name . '.html')) {
                $view = new \stdClass();
                $view->file = 'custom/' . $id . '/application/views/' . $name . '.html';
                $view->extension = '.html';
                if (!isset($this->view->{$id})) {
                    $this->view->{$id} = new \stdClass();
                }
                $this->view->{$id}->{$file} = $view;
                $this->changed = true;
                return $this->view->{$id}->{$file};
            }
        }

        // Try get custom view by app file as ".tpl".
        if (file_exists(BASEPATH . 'custom/' . $file . '.tpl')) {
            $view = new \stdClass();
            $view->file = 'custom/' . $file . '.tpl';
            $view->extension = '.tpl';
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = $view;
            $this->changed = true;
            return $this->view->{$id}->{$file};
        }

        // Try get custom view by app file as ".twig".
        elseif (file_exists(BASEPATH . 'custom/' . $file . '.twig')) {
            $view = new \stdClass();
            $view->file = 'custom/' . $file . '.twig';
            $view->extension = '.twig';
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = $view;
            $this->changed = true;
            return $this->view->{$id}->{$file};
        }

        // Try get custom view by app file as ".php".
        elseif (file_exists(BASEPATH . 'custom/' . $file . '.php')) {
            $view = new \stdClass();
            $view->file = 'custom/' . $file . '.php';
            $view->extension = '.php';
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = $view;
            $this->changed = true;
            return $this->view->{$id}->{$file};
        }

        // Try get custom view by app file as ".html".
        elseif (file_exists(BASEPATH . 'custom/' . $file . '.html')) {
            $view = new \stdClass();
            $view->file = 'custom/' . $file . '.html';
            $view->extension = '.html';
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = $view;
            $this->changed = true;
            return $this->view->{$id}->{$file};
        }

        // Try get view as ".tpl".
        elseif (file_exists(BASEPATH . $file . '.tpl')) {
            $view = new \stdClass();
            $view->file = $file . '.tpl';
            $view->extension = '.tpl';
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = $view;
            $this->changed = true;
            return $this->view->{$id}->{$file};
        }

        // Try get view as ".twig".
        elseif (file_exists(BASEPATH . $file . '.twig')) {
            $view = new \stdClass();
            $view->file = $file . '.twig';
            $view->extension = '.twig';
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = $view;
            $this->changed = true;
            return $this->view->{$id}->{$file};
        }

        // Try get view as ".php".
        elseif (file_exists(BASEPATH . $file . '.php')) {
            $view = new \stdClass();
            $view->file = $file . '.php';
            $view->extension = '.php';
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = $view;
            $this->changed = true;
            return $this->view->{$id}->{$file};
        }

        // Try get view as ".html".
        elseif (file_exists(BASEPATH . $file . '.html')) {
            $view = new \stdClass();
            $view->file = $file . '.html';
            $view->extension = '.html';
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = $view;
            $this->changed = true;
            return $this->view->{$id}->{$file};
        }

        // If view not exists.
        else {
            if (!isset($this->view->{$id})) {
                $this->view->{$id} = new \stdClass();
            }
            $this->view->{$id}->{$file} = null;
            $this->changed = true;
            return false;
        }
    }

    /**
     * Get strings.
     *
     * @param string $file file name.
     * @return string or bool.
     */
    public function getString($file)
    {
        // Prepare parameters.
        $file = str_replace("\\", "/", $file);
        $file = str_replace(BASEPATH, "", $file);

        // If string file exists.
        if (isset($this->string->{$file})) {
            return $this->string->{$file};
        }

        // Get custom string file.
        if (file_exists(BASEPATH . 'custom/' . $file)) {
            $this->string->{$file} = 'custom/' . $file;
            $this->changed = true;
            return $file;
        }

        // Get string file.
        if (file_exists(BASEPATH . $file)) {
            $this->string->{$file} = $file;
            $this->changed = true;
            return $file;
        }

        // If string file not exists.
        else {
            $this->string->{$file} = null;
            $this->changed = true;
            return false;
        }
    }

    /**
     * Get CSS.
     *
     * @param string $file file name.
     * @return string or bool.
     */
    public function getCss($file)
    {
        // Prepare parameters.
        $file = str_replace("\\", "/", $file);
        $file = str_replace(BASEPATH, "", $file);

        // If CSS file exists.
        if (isset($this->css->{$file})) {
            return $this->css->{$file};
        }

        // Get custom CSS file.
        if (file_exists(BASEPATH . 'custom/' . $file)) {
            $this->css->{$file} = 'custom/' . $file;
            $this->changed = true;
            return 'custom/' . $file;
        }

        // Get CSS file.
        if (file_exists(BASEPATH . $file)) {
            $this->css->{$file} = $file;
            $this->changed = true;
            return $file;
        }

        // If CSS file not exists.
        else {
            $this->css->{$file} = null;
            $this->changed = true;
            return false;
        }
    }

    /**
     * Get JavaScript.
     *
     * @param string $file file name.
     * @return string or bool.
     */
    public function getJs($file)
    {
        // Prepare parameters.
        $file = str_replace("\\", "/", $file);
        $file = str_replace(BASEPATH, "", $file);

        // If JavaScript file exists in cache.
        if (isset($this->js->{$file})) {
            return $this->js->{$file};
        }

        // Get custom JavaScript file.
        if (file_exists(BASEPATH . 'custom/' . $file)) {
            $this->js->{$file} = 'custom/' . $file;
            $this->changed = true;
            return 'custom/' . $file;
        }

        // Get JavaScript file.
        if (file_exists(BASEPATH . $file)) {
            $this->js->{$file} = $file;
            $this->changed = true;
            return $file;
        }

        // If JavaScript file not exists.
        else {
            $this->js->{$file} = null;
            $this->changed = true;
            return false;
        }
    }

    /**
     * Clear files cache.
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

        // If cache file not exists.
        if (!file_exists($this->_file)) {
            return false;
        }

        // If cache file exists.
        unlink($this->_file);
        return true;
    }

    /**
     * Destruct by object "core\destruct".
     *
     * @return bool.
     */
    public function destruct()
    {
        // If cache not active or no changes.
        if (!$this->_cache || !$this->changed) {
            return false;
        }

        // Save cache file.
        file_put_contents(BASEPATH . $this->_file, json_encode($this));

        // Return.
        return true;
    }
}