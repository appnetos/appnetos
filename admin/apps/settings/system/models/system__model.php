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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 */

// Namespace.
namespace admin\settings;

// Use.
use core\objects;
use core\strings;

// Model "admin\settings\system__model".
class system__model
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['update'];

    /**
     * Uri ID.
     *
     * @var int.
     */
    public $uriId = null;

    /**
     * Template to render.
     *
     * @var string.
     */
    public $template = null;

    /**
     * Part.
     *
     * @var string.
     */
    public $part = 'system';

    /**
     * AJAX error.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * AJAX confirm.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Get model "admin\settings\system_settings".
        $systemSettings = objects::get('admin/settings/system__settings', true);
        $systemSettings->init();

        // Get model "core\config".
        $config = objects::get('config');

        // Assign.
        $render = objects::get('render');
        $render->assign('admin__settings__system__model', $this);
        $render->assign('core__config', $config);

        // Get URI.
        $uri = objects::get('uri');
        $this->uriId = $uri->getId();

        // System settings.
        if ($this->uriId === 400) {
            $this->template = 'admin/apps/settings/system/views/system__system.tpl';
        }

        // Cache settings.
        elseif ($this->uriId === 404) {
            $this->part = 'cache';
            $this->template = 'admin/apps/settings/system/views/system__cache.tpl';
        }

        // Class extends settings.
        elseif ($this->uriId === 407) {
            $this->part = 'extends';
            $systemExtends = objects::getNew('admin/settings/system__extends', true);
            $systemExtends->init();
            $this->template = 'admin/apps/settings/system/views/system__extends.tpl';
        }

        // Admin settings.
        elseif ($this->uriId === 405) {
            $this->part = 'admin';
            $this->template = 'admin/apps/settings/system/views/system__admin.tpl';
        }

        // Debug settings.
        elseif ($this->uriId === 406) {
            $this->part = 'debug';
            $this->template = 'admin/apps/settings/system/views/system__debug.tpl';
        }

        // If URI wrong.
        else {
            $this->redirect();
        }
    }

    // Update settings.
    public function update()
    {
        // Initialize.
        $this->init();

        // Get model "admin\settings\system__settings".
        $systemSettings = objects::get('admin/settings/system__settings');
        $systemSettings->update();

        // Render.
        $this->render(null, 'admin__settings__system__conf');
    }

    /**
     * Render template.
     * Echo rendered template.
     *
     * @param string $error.
     * @param string $confirm.
     * @throws.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Assign.
        // $render->assign('admin__apps__settings__css', $this);

        // Render template.
        $output = $render->fetch($this->template);
        echo $output;
        exit();
    }

    /**
     * Redirect.
     */
    protected function redirect()
    {
        $render = objects::get('render');
        $url = $render->getUrl(1);
        header('Location: ' . $url);
        die();
    }

    /**
     * Convert size to bytes.
     *
     * @param string $size.
     * @return int.
     */
    protected function convertSizeToBytes($size)
    {
        $suffix = strtoupper(substr($size, -1));
        if (!in_array($suffix,array('P','T','G','M','K'))){
            return (int)$size;
        }
        $value = substr($size, 0, -1);
        switch ($suffix) {
            case 'P': $value *= 1024;
            case 'T': $value *= 1024;
            case 'G': $value *= 1024;
            case 'M': $value *= 1024;
            case 'K': $value *= 1024;
                break;
        }
        return (int)$value;
    }

    /**
     * Get max file size.
     *
     * @return int.
     */
    public function getMaxUploadSize()
    {
        $postMaxSize = $this->convertSizeToBytes(ini_get('post_max_size'));
        $postUploadSize = $this->convertSizeToBytes(ini_get('upload_max_filesize'));
        if ($postMaxSize > $postUploadSize) {
            return ini_get('post_max_size');
        }
        return ini_get('upload_max_filesize');
    }

    /**
     * Get admin info.
     *
     * @return bool.
     * @throws.
     */
    public function getInfoAdmin()
    {
        $config = objects::get('config');
        $infoAdmin = $config->getInfoAdmin();
        return $infoAdmin;
    }
}