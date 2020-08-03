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
 * @description     App for displaying app admin area.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\admin".
class admin
{

    /**
     * App ID from URI index.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Object "core\apps" for app admin area apps.
     *
     * @var object.
     */
    public $apps = null;

    /**
     * admin constructor.
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
        // Get app ID by SEO index.
        $uri = objects::get('uri');
        $index = $uri->getRequestindex();

        // If app ID in index not exists.
        if (!isset($index[3])) {
            $this->redirect();
        }

        // Set app ID.
        $this->appId = (int)$index[3];

        // Select data from database table "application_apps".
        $database = objects::get('database');
        $query = 'SELECT xt_name FROM application_apps WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->appId]);

        // If app data not exists.
        if (!$row) {
            $this->redirect();
        }

        // Initialize object "core\apps" and add app admin area.
        $this->apps = objects::getNew('core/apps');
        $this->apps->addAppAdmin($this->appId);
    }

    /**
     * Redirect on error.
     */
    public function redirect()
    {
        // Get url.
        $render = objects::get('render');
        $url = $render->getUrl(300);
        header('Location: ' . $url);
        exit;
    }

    /**
     * Get rendered app views.
     *
     * @return string.
     */
    public function renderViews()
    {
        return $this->apps->renderViews();
    }
}