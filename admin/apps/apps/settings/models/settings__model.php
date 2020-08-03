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
use \core\objects;

// Model "admin\apps\settings__model".
class settings__model
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['activate', 'deactivate'];

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
    public $part = 'overview';

    /**
     * Initialize.
     */
    public function init()
    {
        // Get object "core\uri".
        $uri = objects::get('uri');
        $index = $uri->getRequestindex();
        $this->uriId = $uri->getId();

        // Get model "admin\apps\settings__static".
        $settingsApp = objects::get('admin/apps/settings__static', true);
        $settingsApp->init();

        // If app data.
        if ($this->uriId === 306) {

            // If app ID not in URI.
            if (!isset($index[3])) {
                $this->redirect();
            }

            // Get model "admin\apps\settings__app".
            $settingsApp = objects::get('admin/apps/settings__app', true);
            $settingsApp->id = (int)$index[3];
            $settingsApp->init();

            // If error loading app.
            if ($settingsApp->error) {
                $this->redirect();
            }

            // Set data.
            objects::get('admin/apps/settings__data', true);
            $this->template = 'admin/apps/apps/settings/views/settings__data.tpl';
        }

        // If size and alignment.
        elseif ($this->uriId === 307) {

            // If app ID not in URI.
            if (!isset($index[4])) {
                $this->redirect();
            }

            // Get model "admin\apps\settings__app".
            $settingsApp = objects::get('admin/apps/settings__app', true);
            $settingsApp->id = (int)$index[4];
            $settingsApp->init();

            // If error loading app.
            if ($settingsApp->error) {
                $this->redirect();
            }

            // Set data.
            $model = objects::get('admin/apps/settings__size', true);
            $model->init();
            $this->template = 'admin/apps/apps/settings/views/settings__size.tpl';
        }

        // If CSS.
        elseif ($this->uriId === 308) {

            // If app ID not in URI.
            if (!isset($index[4])) {
                $this->redirect();
            }

            // Get model "admin\apps\settings__app".
            $settingsApp = objects::get('admin/apps/settings__app', true);
            $settingsApp->id = (int)$index[4];
            $settingsApp->init();

            // Get model "admin\apps\settings__css".
            $settingsCss = objects::get('admin/apps/settings__css', true);
            $settingsCss->init();

            // If error loading app.
            if ($settingsApp->error) {
                $this->redirect();
            }

            // Set data.
            objects::get('admin/apps/settings__css', true);
            $this->template = 'admin/apps/apps/settings/views/settings__css.tpl';
        }

        // If JavaScript.
        elseif ($this->uriId === 309) {

            // If app ID not in URI.
            if (!isset($index[4])) {
                $this->redirect();
            }

            // Get model "admin\apps\settings__app".
            $settingsApp = objects::get('admin/apps/settings__app', true);
            $settingsApp->id = (int)$index[4];
            $settingsApp->init();

            // Get model "admin\apps\settings__css".
            $settingsJs = objects::get('admin/apps/settings__js', true);
            $settingsJs->init();

            // If error loading app.
            if ($settingsApp->error) {
                $this->redirect();
            }

            // Set data.
            objects::get('admin/apps/settings__js', true);
            $this->template = 'admin/apps/apps/settings/views/settings__js.tpl';
        }

        // If wrong URI.
        else {
            $this->redirect();
        }
    }

    /**
     * Activate AJAX request.
     */
    public function activate()
    {
        // Initialize.
        $this->init();

        // Get model "admin\apps\settings__static".
        $settingsApp = objects::get('admin/apps/settings__static', true);
        $settingsApp->init();

        // Install application.
        $settingsApp = objects::get('admin/apps/settings__app');
        $settingsApp->activate();

        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__settings__model', $this);
        $render->assign('admin__apps__settings__app', $settingsApp);

        // Render.
        $this->render();
    }

    /**
     * Deactivate AJAX request.
     */
    public function deactivate()
    {
        // Initialize.
        $this->init();

        // Get model "admin\apps\settings__static".
        $settingsApp = objects::get('admin/apps/settings__static', true);
        $settingsApp->init();

        // Install application.
        $settingsApp = objects::get('admin/apps/settings__app');
        $settingsApp->deactivate();

        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__settings__model', $this);
        $render->assign('admin__apps__settings__app', $settingsApp);

        // Render.
        $this->render();
    }

    /**
     * Render template.
     * Echo rendered template.
     */
    protected function render()
    {
        // Prepare parameters.
        $render = objects::get('render');

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
     * Assign object.
     *
     * @param string $name.
     * @param object $object.
     */
    public function assign($name, $object)
    {
        $render = objects::get('render');
        $render->assign($name, $object);
    }

    /**
     * Get exert mode.
     *
     * @return bool.
     */
    public function getExpertModeAdmin()
    {
        $config = objects::get('config');
        return $config->getExpertModeAdmin();
    }

    /**
     * Get admin info.
     *
     * @return bool.
     */
    public function getInfoAdmin()
    {
        $config = objects::get('config');
        $infoAdmin = $config->getInfoAdmin();
        return $infoAdmin;
    }
}