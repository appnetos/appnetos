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
 * @description     core/appnetos/css.php ->    CSS class. Contains all CSS files. Collects all css files and merge to
 *                  css string or generate "main.min.css" from all apps by object "core\minifycss".
 */

// Namespace.
namespace core;

// Class "core\css".
class css extends base
{

    /**
     * Array of CSS strings.
     *
     * @var array.
     */
    protected $css = [];

    /**
     * Array of external CSS files as array of \stdClass.
     *
     * @var array.
     */
    protected $external = [];

    /**
     * Array of CSS files are loaded.
     *
     * @var array.
     */
    protected $files = [];

    /**
     * main.min.css file path.
     *
     * @var string.
     */
    protected $cssFile = 'out/css/main.min.css';

    /**
     * Array of append CSS styles.
     *
     * @var array.
     */
    protected $appendCss = [];

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
     * Used object "core\minifycss".
     *
     * @var object.
     */
    protected $_minifyCss = null;

    /**
     * Used if CSS cache is active from object "core\config".
     *
     * @var bool.
     */
    protected $_cache = true;

    /**
     * Used minify scripts and styles if cache is not active from object "core/config".
     *
     * @var bool.
     */
    protected $_minify = false;

    /**
     * css constructor.
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

        // Get object "core\uri".
        $uri = objects::get("uri");

        // If is admin section or CSS cache is not active.
        if ($uri->getAdmin() || !$this->_cache) {
            return $this->_cache = false;
        }

        // Set CSS cache to true.
        $this->_cache = true;

        // If main.min.css exists.
        if (file_exists($this->cssFile)) {
            return;
        }

        // Minify CSS by object "core\minifycss".
        if (!$this->_minifyCss) {
            $this->_minifyCss = objects::getNew('core/minifycss');
        }
        if ($this->_minifyCss->minify()) {
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
        $this->_minifyCss = objects::getNew('core/minifycss');

        // Get used variables.
        $CONFIG = objects::get('config');
        $this->_cache = $CONFIG->getCssCache();
        $this->_minify = $CONFIG->getMinify();

        // If is application.
        if (!$this->_uri->getAdmin()) {
            $this->add($this->_config->getUrl() . '/out/css/bootstrap.min.css');

            // Get CSS head includes from object "core\config".
            $includeCss = $this->_config->getIncludeCss();
            foreach ($includeCss as $file) {
                $this->add($file);
            }
        }

        // If is admin section.
        else {
            $this->add($this->_config->getUrl() . '/out/admin/css/bootstrap.min.css');
            $this->add($this->_config->getUrl() . '/out/admin/css/fontawesome.min.css');
        }
    }

    /**
     * Add CSS as string to array of CSS strings.
     *
     * @param string $file path to CSS file.
     * @param $cache bool use CSS cache.
     * @return bool.
     */
    public function addAppCss($file, $cache = true)
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

        // Get CSS file.
        $file = $this->_files->getCss($file);
        if ($file) {
            array_push($this->css, file_get_contents(BASEPATH . $file));
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Add external CSS file to side load in header.
     *
     * @param string $file path to CSS file.
     * @param int $priority CSS to load.
     */
    public function add($file, $priority = 0)
    {
        // Set external as \stdClass.
        $external = new \stdClass();
        $external->priority = $priority;
        $external->file = $file;
        array_push($this->external, $external);
    }

    /**
     * Add Css styles to append on bottom of document.
     *
     * @param string $style CSS styles to append.
     */
    public function append($style)
    {
        $style = str_replace('<style>', '', $style);
        $style = str_replace('</style>', '', $style);
        array_push($this->appendCss, $style);
    }

    /**
     * Get head link to external CSS files and main.min.css.
     *
     * @return string.
     */
    public function getHead()
    {
        // If CSS cache is active.
        if ($this->_cache) {
            $this->add($this->_config->getUrl() . '/out/css/main.min.css', -10000);
        }

        // Sort external scripts by priority.
        usort($this->external, function($a, $b) {
            return strcmp($a->priority, $b->priority);
        });

        // Generate buffer.
        $buffer = '';

        // Add external CSS files.
        foreach ($this->external as $external) {
            $buffer .= '<link rel="stylesheet" type="text/css" href="' . $external->file . '" />' . "\n";
        }

        // Return external CSS head.
        if ($buffer !== '') {
            return $buffer;
        }
    }

    /**
     * Get string of all CSS files.
     *
     * @return string.
     */
    public function getFiles()
    {
        // If no CSS files exists.
        if (!count($this->css)) {
            return;
        }

        // Generate buffer.
        $buffer = '<style>';

        // Go trough all CSS files and generate CSS string.
        for ($i = 0; $i < count($this->css); $i++) {
            if ($this->_minify) {
                $buffer .= $this->_minifyCss->minifyCss($this->css[$i]) . "\n";
            }
            else {
                $buffer .= $this->css[$i] . "\n";
            }
        }

        // Return CSS string.
        $buffer .= '</style>';
        return $buffer;
    }

    /**
     * Get string of all append CSS styles.
     *
     * @return string.
     */
    public function getAppend()
    {
        // If no JavaScript files exists.
        if (!count($this->appendCss)) {
            return;
        }

        // Generate buffer.
        $buffer = '<style>';

        // Go trough all append CSS styles and generate CSS string.
        for ($i = 0; $i < count($this->appendCss); $i++) {
            if ($this->_minify) {
                $buffer .= $this->_minifyCss->minifyCss($this->appendCss[$i]) . "\n";
            }
            else {
                $buffer .= $this->appendCss[$i] . "\n";
            }
        }

        // Return JavaScript string.
        $buffer .= '</style>';
        return $buffer;
    }

    /**
     * Clear CSS cache.
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
        if (!file_exists($this->cssFile)) {
            return false;
        }

        // If cache file exists.
        unlink($this->cssFile);
        return true;
    }
}