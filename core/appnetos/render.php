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
 * @description     core/appnetos/render.php ->  Rendering class, render app templates to strings and displays main
 *                  template.
 */

// Namespace.
namespace core;

// Class "core\render" extends object "Smarty".
class render extends \Smarty
{

    /**
     * Used object "core\languages".
     *
     * @var object.
     */
    public $_languages = null;

    /**
     * Used object "core\uri".
     *
     * @var object.
     */
    public $_uri = null;

    /**
     * Used object "core\files".
     *
     * @var object.
     */
    public $_files = null;

    /**
     * Base Url.
     *
     * @var string.
     */
    protected $_url = null;

    /**
     * Used object "core\strings".
     *
     * @var object.
     */
    protected $_strings = null;

    /**
     * Used object "core\config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * Used object "core\cms".
     *
     * @var object.
     */
    protected $_cms = null;

    /**
     * Used object "core\css".
     *
     * @var object.
     */
    protected $_css = null;

    /**
     * Used object "core\js".
     *
     * @var object.
     */
    protected $_js = null;

    /**
     * Used object "core\uuid".
     *
     * @var object.
     */
    protected $_uuid = null;

    /**
     * render constructor.
     */
    public function __construct()
    {
        // Construct parent Smarty.
        parent::__construct();

        // Get and set used data.
        $this->getSet();

        // Smarty configuration.
        $this->configSmarty();
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get and set used objects.
        $this->_languages = objects::get('languages');
        $this->_strings = objects::get('strings');
        $this->_config = objects::get('config');
        $this->_cms = objects::get('cms');
        $this->_css = objects::get('css');
        $this->_js = objects::get('js');
        $this->_uuid = objects::get('uuid');
        $this->_uri = objects::get('uri');
        $this->_files = objects::get('files');

        // Get and set used variables.
        $this->_url = $this->_config->getUrl();

        // Assign to smarty.
        $this->assign('core__strings', $this->_strings);
        $this->assign('strings', $this->_strings);
        $this->assign('core__render', $this);
        $this->assign('render', $this);
    }

    /**
     * Smarty configuration.
     */
    protected function configSmarty()
    {
        // Set smarty and twig settings from objects "core\config".
        $this->compile_dir = $this->_config->getCompileDir();
        $this->config_dir = $this->_config->getConfigDir();
        $this->cache_dir = $this->_config->getCacheDir();
        $this->caching = false;

        // Set source code compressor.
        if ($this->_config->getCompressor()) {
            $this->loadFilter('output', 'trimwhitespace');
        }
    }

    /**
     * Render app to string.
     *
     * @param string $view template file.
     * @param string $cache_id Smarty cache ID.
     * @param string $compile_id Smarty compile ID.
     * @param bool $parent Smarty parent.
     * @return string.
     * @throws \SmartyException.
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function fetch($view = null, $cache_id = null, $compile_id = null, $parent = null)
    {
        // Get file types.
        $typeFour = mb_substr($view, -4);
        $typeFive = mb_substr($view, -5);

        // Render Smarty.
        if ($typeFour === '.tpl') {
            $view = $this->_files->getView(mb_substr($view, 0, -4));
            if (!$view) {
                return false;
            }
            return parent::fetch($view->file, $cache_id, $compile_id, $parent);
        }

        // Render Twig.
        else if ($typeFive === '.twig') {
            $view = $this->_files->getView(mb_substr($view, 0, -5));
            if (!$view) {
                return false;
            }
            return $this->renderTwig($view->file);
        }

        // Render PHP.
        else if ($typeFour === '.php') {
            $view = $this->_files->getView(mb_substr($view, 0, -4));
            if (!$view) {
                return false;
            }
            $this->render($view->file);
        }

        // Render HTML.
        else if ($typeFive === '.html') {
            $view = $this->_files->getView(mb_substr($view, 0, -5));
            if (!$view) {
                return false;
            }
            $this->render($view->file);
        }

        // Render raw template without extension.
        $view = $this->_files->getView($view);
        if ($view) {

            // Get file types.
            $typeFour = mb_substr($view->file, -4);
            $typeFive = mb_substr($view->file, -5);

            // Render raw Smarty.
            if ($typeFour === '.tpl') {
                return parent::fetch($view->file, $cache_id, $compile_id, $parent);
            }

            // Render raw Twig.
            else if ($typeFive === '.twig') {
                return $this->renderTwig($view->file);
            }

            // Render raw PHP or raw HTML.
            else if ($typeFour === '.php' || $typeFive === '.html') {
                return $this->render($view->file);
            }
        }

        // Return false on error.
        return false;
    }

    /**
     * Render Twig.
     *
     * @param string $view Twig template file.
     * @return string.
     * @throws \Twig\Error\LoaderError.
     * @throws \Twig\Error\RuntimeError.
     * @throws \Twig\Error\SyntaxError.
     */
    public function renderTwig($view)
    {
        // Generate Twig loader.
        $loader = new \Twig\Loader\FilesystemLoader('/');
        $twig = new \Twig\Environment($loader, [
            'cache' => $this->_config->cacheDir,
            'debug' => true
        ]);

        // Render template.
        return $twig->render($view, $this->getTemplateVars());
    }

    /**
     * Render ".php" or ".html" view.
     *
     * @param string $view template file.
     * @return string.
     */
    public function render($view)
    {
        // Activate output puffer.
        ob_start();

        // Set objects in puffer.
        foreach ($this->getTemplateVars() as $key => $value) {
            ${$key} = $value;
        }

        // Including view.
        include($view);

        // Render view to string.
        $string = ob_get_contents() . "\n";

        // Deactivate puffer.
        ob_end_clean();

        // Return rendered string.
        return $string;
    }

    /**
     * Include app or view.
     *
     * @param $mixed int or string app id or template file.
     * @param $id app ID.
     * @throws \SmartyException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function include($mixed, $id = null)
    {
        // If is app.
        if (gettype($mixed) === 'integer' || is_numeric($mixed)) {
            ($this->includeApp($mixed));
        }

        // If is view.
        else {
            ($this->includeView($mixed, $id));
        }
    }

    /**
     * Include view.
     *
     * @param string $view template file.
     * @param int $id app ID.
     * @throws \SmartyException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @echo string rendered app.
     */
    protected function includeView($view, $id = null)
    {
        // Get file types.
        $typeFour = mb_substr($view, -4);
        $typeFive = mb_substr($view, -5);

        // Render Smarty.
        if ($typeFour === '.tpl') {
            $view = $this->_files->getView(mb_substr($view, 0, -4), $id);
            if (!$view) {
                return false;
            }
            echo parent::fetch($view->file);
            return;
        }

        // Render Twig.
        else if ($typeFive === '.twig') {
            $view = $this->_files->getView(mb_substr($view, 0, -5), $id);
            if (!$view) {
                return false;
            }
            echo $this->renderTwig($view->file);
            return;
        }

        // Render PHP.
        else if ($typeFour === '.php') {
            $view = $this->_files->getView(mb_substr($view, 0, -4), $id);
            if (!$view) {
                return false;
            }
            echo $this->render($view->file);
            return;
        }

        // Render HTML.
        else if ($typeFive === '.html') {
            $view = $this->_files->getView(mb_substr($view, 0, -5), $id);
            if (!$view) {
                return false;
            }
            echo $this->render($view->file);
            return;
        }

        // Render raw template without extension.
        $view = $this->_files->getView($view, $id);
        if ($view) {

            // Get file types.
            $typeFour = mb_substr($view->file, -4);
            $typeFive = mb_substr($view->file, -5);

            // Render raw Smarty.
            if ($typeFour === '.tpl') {
                echo parent::fetch($view->file);
                return;
            }

            // Render raw Twig.
            else if ($typeFive === '.twig') {
                echo $this->renderTwig($view->file);
                return;
            }

            // Render raw PHP or raw HTML.
            else if ($typeFour === '.php' || $typeFive === '.html') {
                echo $this->render($view->file);
                return;
            }
        }

        // Return false on error.
        return false;
    }

    /**
     * Include app.
     *
     * @param int $id app ID.
     * @echo string rendered app.
     * @throws exception.
     */
    protected function includeApp($id)
    {
        // Cache last registered app object.
        $last = objects::$app;

        // Generate object "core/app".
        $app = objects::getNew('core/app');

        // If is application.
        if (!$this->_uri->getAdmin()) {

            // If is not ajax.
            if (!$this->_uri->getAjax()) {

                // Init application.
                $app->initApplication($id);

                // Echo rendered view.
                if (!$app->getError()) {
                    echo $app->getView();
                }

                // Add included app to object "core\cms".
                $this->_cms->addIncluded($id);
            }

            // If is ajax.
            else {
                $app->initApplicationAjax($id);
            }
        }

        // If is admin section.
        else {

            // If is not ajax.
            if (!$this->_uri->getAjax()) {

                // Init application.
                $app->initAdmin($id);

                // Echo rendered View.
                if (!$app->getError()) {
                    echo $app->getView();
                }

                // Add included app to object "core\cms".
                $this->_cms->addIncluded($id);
            }

            // If is ajax.
            else {
                $app->initAdminAjax($id);
            }
        }

        // Set last registered app object.
        objects::$app = $last;
    }

    /**
     * Add CSS styles to append on bottom of document.
     *
     * @param string $styles CSS styles to append.
     */
    public function appendCss($styles)
    {
        $this->_css->append($styles);
    }

    /**
     * Add JavaScrips to append on bottom of document.
     *
     * @param string $script script to append.
     */
    public function appendJs($script)
    {
        $this->_js->append($script);
    }

    /**
     * Get application language key.
     *
     * @return string.
     */
    public function getLanguage()
    {
        return $this->_languages->getActiveMain();
    }

    /**
     * Get admin section language key.
     *
     * @return string.
     */
    public function getAdminLanguage()
    {
        return $this->_languages->getAdminActiveMain();
    }

    /**
     * Get head link to cached _css file from object "core\js".
     *
     * @return string.
     */
    public function getCssHead()
    {
        return $this->_css->getHead();
    }

    /**
     * Get all CSS files as string from object "core\css".
     *
     * @return string.
     */
    public function getCssFiles()
    {
        return $this->_css->getFiles();
    }

    /**
     * Get all append CSS styles as string from object "core\css".
     *
     * @return string.
     */
    public function getCssAppend()
    {
        return $this->_css->getAppend();
    }

    /**
     * Get head link to cached JavaScript file from object "core\js".
     *
     * @return string.
     */
    public function getJsHead()
    {
        return $this->_js->getHead();
    }

    /**
     * Get all JavaScript files as string from object "core\js".
     *
     * @return string.
     */
    public function getJsFiles()
    {
        return $this->_js->getFiles();
    }

    /**
     * Get all append JavaScript as string from object "core\js".
     *
     * @return string.
     */
    public function getJsAppend()
    {
        return $this->_js->getAppend();
    }

    /**
     * Get application title from object "core\cms".
     *
     * @return string.
     */
    public function getTitle()
    {
        return $this->_cms->getTitle();
    }

    /**
     * Get application favicon from object "core\config" and object "core\cms".
     *
     * @return mixed string.
     */
    public function getFavicon()
    {
        return $this->_config->getUrl() . '/' . $this->_cms->getFavicon();
    }

    /**
     * Get page canonical from object "core\cms".
     *
     * @return string.
     */
    public function getCanonical()
    {
        return $this->_cms->getCanonical();
    }

    /**
     * Get application meta tags from object "core\cms".
     *
     * @return array.
     */
    public function getMeta()
    {
        return $this->_cms->getMeta();
    }

    /**
     * Get debug AJAX from object "core\config".
     *
     * @return string.
     */
    public function getDebugAjax()
    {
        return $this->_config->getDebugAjax();
    }

    /**
     * Get AJAX UUID from object "core\uuid".
     *
     * @return string.
     */
    public function getAjaxId()
    {
        return $this->_uuid->getAjax();
    }

    /*
     * Get multilingual speaking _url.
     *
     * @param mixed int as id, string as global _uri or null for base _url.
     * @return string.
     */
    public function getUrl($m = null)
    {
        // If parameter not set.
        if ($m === null) {
            return $this->getBaseUrl();
        }

        // If parameter is set.
        return $this->getLink($m);
    }

    /**
     * Get base _url from object "core\config".
     *
     * @return string.
     */
    protected function getBaseUrl()
    {
       return $this->_url;
    }

    /*
     * Get multilingual speaking _url from object "core\uri".
     *
     * @param mixed.
     * @return string.
     */
    protected function getLink($m)
    {
        return $this->_uri->getUrl($m);
    }

    /**
     * Get ID of last registered app.
     *
     * @return int app ID.
     */
    public function getId()
    {
        if (objects::$app !== null) {
            return objects::$app->getId();
        }
    }

    /**
     * Get object of last registered app.
     *
     * @return object.
     */
    public function getApp()
    {
        if (objects::$app !== null) {
            return objects::$app;
        }
    }

    /**
     * Get object from object "core\objects".
     *
     * @param $key string object key.
     * @return object.
     * @throws exception.
     */
    public function getObject($key)
    {
        return objects::get($key);
    }

    /**
     * Get template variables.
     *
     * @return array.
     */
    public function getTemplateVariables()
    {
        return $this->tpl_vars;
    }
}