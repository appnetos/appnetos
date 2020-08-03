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
 * @description     Extended cookie note, with list of all cookies and their use. App admin settings to set kind of used
 *                  cookies and the notifications.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\cookie_note".
class cookie_note
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['edit'];

    /**
     * App ID.
     *
     * @var int
     */
    public $appId = null;

    /**
     * Settings.
     *
     * @var \stdClass.
     */
    public $settings = null;

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
     * Used controller "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * cookie_note constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init() {
        // Get and set used objects.
        $this->_extensions = objects::get('extensions');

        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get app ID by object "core\objects".
        $id = objects::getApp('appnetos/cookie_note')->getId();

        // Get settings.
        $settings = $this->_extensions->get('text', $id, 'appnetos/cookie_note');

        // If settings exists.
        if ($settings) {
            $this->settings = json_decode($settings);
        }

        // If settings not exists.
        else {
            $this->settings->function = true;
            $this->settings->functionOn = true;
            $this->settings->functionMsg = true;
            $this->settings->statistics = true;
            $this->settings->statisticsOn = true;
            $this->settings->statisticsMsg = true;
            $this->settings->marketing = true;
            $this->settings->marketingOn = true;
            $this->settings->marketingMsg = true;
            $this->set();
        }
    }

    /**
     * Set settings.
     */
    protected function set()
    {
        // Get app ID by object "core\objects".
        $id = objects::getApp('appnetos/cookie_note')->getId();
        $this->_extensions->set(json_encode($this->settings), 'text', $id, 'appnetos/cookie_note');
    }

    /**
     * Edit settings.
     */
    public function edit()
    {
        // Get Parameters.
        $strings = objects::get('strings');
        $post = objects::get('post');
        $data = $post->get('data');

        // Set Parameters
        $this->settings->function = false;
        $this->settings->functionOn = false;
        $this->settings->functionMsg = false;
        $this->settings->statistics = false;
        $this->settings->statisticsOn = false;
        $this->settings->statisticsMsg = false;
        $this->settings->marketing = false;
        $this->settings->marketingOn = false;
        $this->settings->marketingMsg = false;
        foreach ($data as $value) {
            if ($value['name'] === 'function') {
                $this->settings->function = true;
            }
            elseif ($value['name'] === 'function_on') {
                $this->settings->functionOn = true;
            }
            elseif ($value['name'] === 'function_msg') {
                $this->settings->functionMsg = true;
            }
            elseif ($value['name'] === 'statistics') {
                $this->settings->statistics = true;
            }
            elseif ($value['name'] === 'statistics_on') {
                $this->settings->statisticsOn = true;
            }
            elseif ($value['name'] === 'statistics_msg') {
                $this->settings->statisticsMsg = true;
            }
            elseif ($value['name'] === 'marketing') {
                $this->settings->marketing = true;
            }
            elseif ($value['name'] === 'marketing_on') {
                $this->settings->marketingOn = true;
            }
            elseif ($value['name'] === 'marketing_msg') {
                $this->settings->marketingMsg = true;
            }
        }

        // Set parameters.
        $this->set();

        // Render AJAX template.
        $this->ajaxConfirm = $strings->get('appnetos__cookie_note__confirm');
        $this->renderAjax();
    }

    /**
     * Render AJAX template as JSON.
     * Echo rendered template.
     */
    protected function renderAjax() {

        // Render template
        $render = objects::get('render');
        $render->assign('appnetos__cookie_note', $this);
        $result = $render->fetch('application/apps/appnetos/cookie_note/admin/views/cookie_note__settings.tpl');

        // JSON Callback.
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Convert string to bool.
     *
     * @param string $string.
     * @return bool.
     */
    protected function stringToBool($string)
    {
        if ($string === 'true') {
            return true;
        }
        return false;
    }
}