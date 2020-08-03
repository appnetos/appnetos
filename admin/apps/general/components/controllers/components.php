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
 * @description     admin/apps/general/components/controllers/components.php ->    Controller for admin app
 *                  "admin\general\components". Set admin area components.
 */

// Namespace.
namespace admin\general;

// Use.
use \core\objects;

// Controller "admin\general\components".
class components
{

    /**
     * Used model "core\config" get on runtime.
     *
     * @var object.
     */
    private $_config = null;

    /**
     * components constructor.
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
        // Initialize font awesome.
        $this->initFontAwesome();

        // Initialize settings.
        $this->initSettings();
    }

    /**
     * Initialize font awesome.
     */
    protected function initFontAwesome()
    {
        // If font awesome CSS exists.
        if(file_exists('out/admin/css/fontawesome.min.css')) return;

        // Get model "core\config".
        if (!$this->_config) $this->_config = objects::get('config');
        $url = $this->_config->url;

        // Prepare parameters.
        $source = 'admin/apps/general/components/files/fontawesome.css';
        $target = 'out/admin/css/fontawesome.min.css';
        $strings = ["url(\"../../out/admin/fonts/fa-brands-400.eot\")", "url(\"../../out/admin/fonts/fa-brands-400.eot?#iefix\")", "url(\"../../out/admin/fonts/fa-brands-400.woff2\")", "url(\"../../out/admin/fonts/fa-brands-400.woff\")", "url(\"../../out/admin/fonts/fa-brands-400.ttf\")", "url(\"../../out/admin/fonts/fa-brands-400.svg#fontawesome\")", "url(\"../../out/admin/fonts/fa-regular-400.eot\")", "url(\"../../out/admin/fonts/fa-regular-400.eot?#iefix\")", "url(\"../../out/admin/fonts/fa-regular-400.woff2\")", "url(\"../../out/admin/fonts/fa-regular-400.woff\")", "url(\"../../out/admin/fonts/fa-regular-400.ttf\")", "url(\"../../out/admin/fonts/fa-regular-400.svg#fontawesome\")", "url(\"../../out/admin/fonts/fa-solid-900.eot\")", "url(\"../../out/admin/fonts/fa-solid-900.eot?#iefix\")", "url(\"../../out/admin/fonts/fa-solid-900.woff2\")", "url(\"../../out/admin/fonts/fa-solid-900.woff\")", "url(\"../../out/admin/fonts/fa-solid-900.ttf\")", "url(\"../../out/admin/fonts/fa-solid-900.svg#fontawesome\")"];

        // Create directory.
        if (!is_dir('out')) mkdir('out');
        if (!is_dir('out/admin')) mkdir('out/admin');
        if (!is_dir('out/admin/fonts')) mkdir('out/admin/fonts');

        // Get css file.
        $file = file_get_contents($source);
        for ($i = 0; $i < count($strings); $i++) {
            $replace = str_replace('../../', $url . '/', $strings[$i]);
            $file = str_replace($strings[$i], $replace, $file);
        }

        // Get controller "core\minifycss".
        $minifycss = objects::getNew('core/minifycss');
        $file = $minifycss->minifyCss($file);

        // Set minify CSS file.
        file_put_contents($target, $file);
    }

    /**
     * Initialize settings.
     */
    protected function initSettings()
    {
        // Get object "core\config".
        if (!$this->_config) $this->_config = objects::get('config');

        // Assign admin info to controller "core\render".
        $render = objects::get('render');
        $render->assign('admin__info', $this->_config->getInfoAdmin());
    }
}