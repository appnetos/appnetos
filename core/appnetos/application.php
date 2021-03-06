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
 * @description     core/appnetos/application.php ->    Application class, set all single app as object "core\app" to
 *                  object "core\apps" and run render application or execute ajax request.
 */

// Namespace.
namespace core;

// Class "core\application".
class application extends base
{

    /**
     * Used object "core\group".
     *
     * @var object.
     */
    protected $_group = null;

    /**
     * Used object "core\apps".
     *
     * @var object.
     */
    protected $_apps = null;

    /**
     * Used object "core\cms".
     *
     * @var object.
     */
    protected $_cms = null;

    /**
     * Used object "core\uri".
     *
     * @var object.
     */
    protected $_uri = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Get and set used data.
        $this->getSet();

        // Initialize application.
        $this->initApplication();

        // If is AJAX request.
        if ($this->_uri->getAjax()) {
            $this->initAjax();
        }

        // If is not AJAX request.
        else {
            $this->_apps->renderApplication();
        }
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get and set used objects.
        $this->_group = objects::get('group');
        $this->_apps = objects::get('apps');
        $this->_cms = objects::get('cms');
        $this->_uri = objects::get('uri');
    }

    /**
     * Initialize application.
     */
    protected function initApplication()
    {
        // If access denied.
        if (!$this->_group->getGranted()) {
            $this->forbidden();
        }

        // Get app IDs from object "core\cms".
        $apps = $this->_cms->getApps();

        // Add apps to object "core\apps".
        $this->_apps->addApplication($apps);
    }

    /**
     * Initialize AJAX.
     */
    protected function initAjax()
    {
        // Add included apps from object "core\cms" to object "core\apps".
        $include = $this->_cms->getInclude();
        $this->_apps->addApplication($include);

        // Initialize object "core\ajax".
        $ajax = objects::getNew('core/render');
        $ajax->initApplication();
    }

    /**
     * Set 403 forbidden.
     */
    protected function forbidden()
    {
        // If root page is denied.
        header('HTTP/1.0 403 Forbidden');
        $render = objects::get('render');
        echo $render->fetch('core/views/403.tpl');
        exit;
    }
}