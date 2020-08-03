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
 * @description     Automatic breadcrumbs. Loads and shows breadcrumbs by URI index.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\breadcrumbs".
class breadcrumbs
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
    protected function init()
    {
        // Get and set used objects.
        $this->_extensions = objects::get('extensions');

        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get app ID by object "core\objects".
        $id = objects::getApp('appnetos/breadcrumbs')->getId();

        // Get settings.
        $settings = $this->_extensions->get('text', $id, 'appnetos/breadcrumbs');

        // If settings exists.
        if ($settings) {
            $this->settings = json_decode($settings);
        }

        // If settings not exists.
        else {
            $this->settings->background = '#f8f9fa';
            $this->settings->color = '#6c757d';
            $this->settings->border = '#eeeeee';
            $this->settings->link = '#222222';
            $this->set();
        }
    }

    /**
     * Set settings.
     */
    protected function set()
    {
        // Get app ID by object "core\objects".
        $id = objects::getApp('appnetos/breadcrumbs')->getId();
        $this->_extensions->set(json_encode($this->settings), 'text', $id, 'appnetos/breadcrumbs');
    }

    /**
     * Edit settings.
     */
    public function edit()
    {
        // Initialize.
        $this->init();

        // Get post parameters.
        $post = objects::get('post');
        $data = $post->get('data');
        $background = null;
        $border = null;
        $color = null;
        $link = null;
        foreach ($data as $parameter) {
            if ($parameter['name'] === 'background') {
                $background = $parameter['value'];
            }
            if ($parameter['name'] === 'color') {
                $color = $parameter['value'];
            }
            if ($parameter['name'] === 'border') {
                $border = $parameter['value'];
            }
            if ($parameter['name'] === 'link') {
                $link = $parameter['value'];
            }
        }

        // Check parameters.
        if (!$this->isHexColor($background)) {
            $this->renderAjax('appnetos__breadcrumbs__err', null);
            return;
        }
        if (!$this->isHexColor($border)) {
            $this->renderAjax('appnetos__breadcrumbs__err', null);
            return;
        }
        if (!$this->isHexColor($color)) {
            $this->renderAjax('appnetos__breadcrumbs__err', null);
            return;
        }
        if (!$this->isHexColor($link)) {
            $this->renderAjax('appnetos__breadcrumbs__err', null);
            return;
        }

        // Set parameters.
        $this->settings->background = $background;
        $this->settings->border = $border;
        $this->settings->color = $color;
        $this->settings->link = $link;
        $this->set();

        // Render AJAX template.
        $this->renderAjax(null, 'appnetos__breadcrumbs__conf');
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     *
     * @param string $error.
     * @param string $confirm.
     * @throws exception.
     */
    protected function renderAjax($error = null, $confirm = null) {

        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }
        $render->assign('appnetos__breadcrumbs', $this);

        // Initialize.
        $this->init();

        // Render template.
        $template = $render->fetch('application/apps/appnetos/breadcrumbs/admin/views/breadcrumbs__settings.tpl');

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($template);
    }

    /**
     * If is hex color.
     *
     * @param string $color.
     * @return bool.
     */
    protected function isHexColor($color)
    {
        if (preg_match('/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $color)) {
            return true;
        }
        return false;
    }
}