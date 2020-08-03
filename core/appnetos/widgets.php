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
 * @description     core/appnetos/widgets.php ->    Widgets class. Contains widgets in array as object "core\app".
 *                  Render widget in view "core/views/widgets.tpl".
 */

// Namespace.
namespace core;

// Class "core\widgets".
class widgets extends base
{

    /**
     * Array of widgets as objects "core\app".
     *
     * @var array.
     */
    protected $widgets = [];

    /**
     * If is AJAX request from object "core\uri".
     *
     * @var bool.
     */
    protected $_ajax = null;

    /**
     * Used object "core\render".
     *
     * @var object.
     */
    protected $_render = null;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * widgets constructor.
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
        // Register object.
        $this->_render = objects::get('render');
        $this->_render->assign('core__widgets', $this);

        // Get and set used objects.
        $this->_database = objects::get('database');
    }

    /**
     * Add widget apps as object "core\app".
     *
     * @param mixed $apps array with app IDs or app name, int with app ID, string with app name.
     * @throws exception.
     */
    public function add($apps)
    {
        // Get if is AJAX request from object "core\uri".
        if ($this->_ajax === null) {
            $uri = objects::get('uri');
            $this->_ajax = $uri->getAjax();
        }

        // Add apps array of IDs or names.
        if (gettype($apps) === 'array') {
            foreach ($apps as $app) {
                $this->addWidgetApp($app);
            }
        }

        // Add app as int ID or string name.
        else {
            $this->addWidgetApp($apps);
        }
    }

    /**
     * Add widget app as object "core\app" by string or int.
     *
     * @param mixed $apps string or int app ID or name.
     * @throws exception.
     */
    protected function addWidgetApp($apps)
    {
        // Add app by int.
        if (gettype($apps) === 'integer') {

            // Set object "core\app".
            $app = objects::getNew('core/app');

            // If is AJAX request.
            if ($this->_ajax) {
                $app->initWidgetAjax($apps);
            }

            // If is not AJAX request.
            else {
                $app->initWidget($apps);
            }

            // If app is not active.
            if (!$app->active) {
                return;
            }

            // Add app to array of apps.
            array_push($this->widgets, $app);
        }

        // Add app by string.
        elseif (gettype($apps) === 'string') {

            // Get data of all apps by directory from database table "application_apps".
            $query = 'SELECT xt_id FROM application_apps WHERE xt_directory=? ORDER BY xt_id';
            $array = $this->_database->selectArray($query, [$apps]);

            // If app not exists.
            if (!$array) {
                return;
            }

            // Recursive add apps by int.
            for ($i = 0; $i < count($array); $i++) {
                $this->add((int)$array[$i]['xt_id']);
            }
        }
    }

    /**
     * Render widgets.
     *
     * @return string.
     */
    public function render()
    {
        // If no widgets exists.
        if (!count($this->widgets)) {
            return;
        }

        // Render template.
        $template = 'core/views/widgets.tpl';
        return $this->_render->fetch($template);
    }

    /**
     * Get array of widgets.
     *
     * @return array.
     */
    public function getWidgets()
    {
        return $this->widgets;
    }
}