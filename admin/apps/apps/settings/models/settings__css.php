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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 */

// Namespace.
namespace admin\apps;

// Use.
use core\objects;

// Model "admin\settings\settings__css".
class settings__css
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['update'];

    /**
     * AJAX error message.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * AJAX confirm message.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Add external scripts and styles.
        $config = objects::get('config');
        $js = objects::get('js');
        $js->add($config->getUrl() . '/out/codemirror/codemirror.js');
        $js->add($config->getUrl() . '/out/codemirror/modes/css/css.js');
        $js->add($config->getUrl() . '/out/codemirror/modes/javascript/javascript.js');
        $js->add($config->getUrl() . '/out/codemirror/modes/htmlmixed/htmlmixed.js');
        $css = objects::get('css');
        $css->add($config->getUrl() . '/out/codemirror/codemirror.css');
    }

    /**
     * Update.
     */
    public function update()
    {
        // Get object "core\uri".
        $uri = objects::get('uri');
        $index = $uri->getRequestindex();
        $uriId = $uri->getId();

        // If URI parameters wrong.
        if($uriId !== 308 || !isset($index[4])) {
            $this->render('admin__apps__settings__css_err');
        }

        // Get parameters.
        $appId = $index[4];
        $post = objects::get('post');
        $css = trim($post->get('admin__apps__settings__parameters'));

        // If parameters nor exists.
        if ($css === null) {
            $this->render('admin__apps__settings__css_err');
        }

        // Get object "admin\apps\settings__app".
        $settingsApp = objects::get('admin/apps/settings__app');
        $settingsApp->id = $appId;
        $settingsApp->init();

        // If CSS is not empty.
        if ($css !== '') {
            $tmp = trim($settingsApp->getCss());
            $dir = $settingsApp->directory . '/application/css';
            if (!is_dir($dir)) {
                mkdir($dir);
            }
            if ($css !== $tmp) {
                $file = $settingsApp->directory . '/application/css/' . $settingsApp->parsedName . '.css';
                file_put_contents($file, $css);
            }
        }

        // If CSS is empty.
        else {
            $file = $settingsApp->directory . '/application/css/' . $settingsApp->parsedName . '.css';
            if (file_exists($file)) {
                unlink($file);
            }
        }

        // Render.
        $this->render(null, 'admin__apps__settings__css_conf');
    }

    /**
     * Render template.
     * Echo rendered template.
     *
     * @param string $error.
     * @param string $confirm.
     */
    protected function render($error = null, $confirm = null)
    {
        // Get model "admin\apps\create__model".
        $createModel = objects::get('admin/apps/settings__model', true);
        $createModel->init();

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
        $render->assign('admin__apps__settings__css', $this);

        // Render template.
        $output = $render->fetch('admin/apps/apps/settings/views/settings__css.tpl');
        echo $output;
        exit();
    }
}