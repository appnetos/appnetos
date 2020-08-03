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
 * @description     core/appnetos/js.php ->    JavaScript class. Contains all JavaScript files. Collects all JavaScript
 *                  files and merge to JavasScript string or generate "main.min.js" from all apps by object
 *                  "core\minifyjs".
 */

// Namespace.
namespace core;

// Class "core\js".
class js extends base
{

    /**
     * Array of JavaScript strings.
     *
     * @var array.
     */
    protected $js = [];

    /**
     * External JavaScript files as array of \stdClass.
     *
     * @var array.
     */
    protected $external = [];

    /**
     * Array of JavaScript files are loaded.
     *
     * @var array.
     */
    protected $files = [];

    /**
     * main.min.js file path.
     *
     * @var string.
     */
    protected $jsFile = 'out/js/main.min.js';

    /**
     * Array of append JavaScripts.
     *
     * @var array.
     */
    protected $appendJs = [];

    /**
     * Used object "core\config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * Used object "core\uri".
     *
     * @var object.
     */
    protected $_uri = null;

    /**
     * Used object "core\files".
     *
     * @var object.
     */
    protected $_files = null;

    /**
     * Used object "core\minifyjs".
     *
     * @var object.
     */
    protected $_minifyJs = null;

    /**
     * Used minify scripts and styles if cache is not active from object "core\config".
     *
     * @var bool.
     */
    protected $_minify = false;

    /**
     * Used if JavaScript cache is active from object "core\config".
     *
     * @var bool.
     */
    protected $_cache = false;

    /**
     * js constructor.
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
        // Get and set used data.
        $this->getSet();

        // If is admin section or JavaScript cache is not active.
        if ($this->_uri->getAdmin() || !$this->_cache) {
            $this->_cache = false;
            return;
        }

        // Set JavaScript cache to true.
        $this->_cache = true;

        // If main.min.js exists.
        if (file_exists($this->jsFile)) {
            return;
        }

        // Minify JavaScript by object "core\minifyjs".
        if (!$this->_minifyJs) {
            $this->_minifyJs = objects::getNew('core/minifyjs');
        }
        if ($this->_minifyJs->minify()) {
            return;
        }

        // If minify has errors.
        $this->_cache = false;
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get used objects.
        $this->_uri = objects::get('uri');
        $this->_config = objects::get('config');
        $this->_files = objects::get('files');
        $this->_minifyJs = objects::getNew('core/minifyjs');

        // Get used variables.
        $this->_cache = $this->_config->getJsCache();
        $this->_minify = $this->_config->getMinify();

        // If is application.
        if (!$this->_uri->getAdmin()) {
            $this->add($this->_config->getUrl() . '/out/js/jquery.min.js');
            $this->add($this->_config->getUrl() . '/out/js/bootstrap.bundle.min.js');
            $this->add($this->_config->getUrl() . '/out/js/appnetos.min.js');

            // Get JavaScript head includes from object "core\config".
            $includeJs = $this->_config->getIncludeJs();
            foreach ($includeJs as $value) {
                if (gettype($value) === 'string') {
                    $this->add($value);
                }
                if (gettype($value) === 'array') {
                    if (!isset($value['src'])) {
                        continue;
                    }
                    $src = $value['src'];
                    $priority = $value['priority'] ?? 0;
                    $type = $value['type'] ?? 'text/javascript';
                    $crossOrigin = $value['crossOrigin'] ?? false;
                    $this->add($src, $priority, $type, $crossOrigin);
                }
            }
        }

        // If is admin.
        else {
            $this->add($this->_config->getUrl() . '/out/admin/js/jquery.min.js');
            $this->add($this->_config->getUrl() . '/out/admin/js/bootstrap.bundle.min.js');
            $this->add($this->_config->getUrl() . '/out/admin/js/appnetos.min.js');
        }
    }

    /**
     * Add JavaScript as string to array of JavaScript strings.
     *
     * @param $file string JavaScript file path.
     * @param $cache bool use JavaScript cache.
     * @return bool.
     */
    public function addAppJs($file, $cache = true)
    {
        // If cache is active.
        if ($this->_cache && $cache) {
            return false;
        }

        // Add file path to array of file paths.
        for ($i = 0; $i < count($this->files); $i++) {
            if ($file === $this->files[$i]) {
                return false;
            }
        }
        array_push($this->files, $file);

        // Get JavaScript.
        $file = $this->_files->getJs($file);
        if ($file) {
            array_push($this->js, file_get_contents(BASEPATH . $file));
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Add external JavaScript file to side load in header.
     *
     * @param string $src JavaScript source.
     * @param int $priority JavaScript load priority.
     * @param string $type JavaScript type.
     * @param bool $crossOrigin allow cross origin.
     */
    public function add($src, $priority = 0, $type = 'text/javascript', $crossOrigin = false)
    {
        // Set external as \stdClass.
        $external = new \stdClass();
        $external->src = $src;
        $external->priority = $priority;
        $external->type = $type;
        $external->crossOrigin = $crossOrigin;
        array_push($this->external, $external);
    }

    /**
     * Add JavaScrips to append on bottom of document.
     *
     * @param string $script script to append.
     */
    public function append($script)
    {
        $script = str_replace('<script>', '', $script);
        $script = str_replace('</script>', '', $script);
        array_push($this->appendJs, $script);
    }

    /**
     * Get head link to external JavaScript files and main.min.js.
     *
     * @return string.
     */
    public function getHead()
    {
        // If Javascript cache is active.
        if ($this->_cache) {
            $this->add($this->_config->getUrl() . '/out/js/main.min.js', 10000);
        }

        // Sort external scripts by priority.
        usort($this->external, function($a, $b) {
            return strcmp($a->priority, $b->priority);
        });

        // Generate buffer.
        $buffer = '';

        // Add external JavaScript files.
        foreach ($this->external as $external) {
            $type = ' type="text/javascript"';
            if ($external->type) {
                $type = ' type="' . $external->type . '"';
            }
            $crossOrigin = '';
            if ($external->crossOrigin) {
                $crossOrigin = ' crossorigin';
            }
            $buffer .= '<script' . $crossOrigin . $type . ' src="' . $external->src . '"></script>' . "\n";
        }

        // Return external JavaScript head.
        if ($buffer !== '') {
            return $buffer;
        }
    }

    /**
     * Get string of all JavaScript files.
     *
     * @return string.
     */
    public function getFiles()
    {
        // If no JavaScript files exists.
        if (!count($this->js)) {
            return;
        }

        // Generate buffer.
        $buffer = '<script>';

        // Go trough all JavaScript files and generate JavaScript string.
        for ($i = 0; $i < count($this->js); $i++) {
            if ($this->_minify) {
                $buffer .= $this->_minifyJs->minifyJs($this->js[$i]) . "\n";
            }
            else {
                $buffer .= $this->js[$i] . "\n";
            }
        }

        // Go trough all append JavaScripts and generate JavaScript string.
        for ($i = 0; $i < count($this->appendJs); $i++) {
            if ($this->_minify) {
                $buffer .= $this->_minifyJs->minifyJs($this->appendJs[$i]) . "\n";
            }
            else {
                $buffer .= $this->appendJs[$i] . "\n";
            }
        }
        $this->appendJs = [];

        // Return JavaScript string.
        $buffer .= '</script>';
        return $buffer;
    }

    /**
     * Get string of all append JavaScripts.
     *
     * @return string.
     */
    public function getAppend()
    {
        // If no JavaScript files exists.
        if (!count($this->appendJs)) {
            return;
        }

        // Generate buffer.
        $buffer = '<script>';

        // Go trough all append JavaScripts and generate JavaScript string.
        for ($i = 0; $i < count($this->appendJs); $i++) {
            if ($this->_minify) {
                $buffer .= $this->_minifyJs->minifyJs($this->appendJs[$i]) . "\n";
            }
            else {
                $buffer .= $this->appendJs[$i] . "\n";
            }
        }

        // Return JavaScript string.
        $buffer .= '</script>';
        return $buffer;
    }

    /**
     * Clear JavaScript cache.
     *
     * @return bool.
     */
    public function clearCache()
    {
        // If is not admin.
        if (!$this->_uri->getAdmin()) {
            return false;
        }

        // If cache file not exists.
        if (!file_exists($this->jsFile)) {
            return false;
        }

        // If cache file exists.
        unlink($this->jsFile);
        return true;
    }
}