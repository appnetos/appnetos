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
 * @description     Simple contact form to sending contact request by using APPNET OS mailer.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\contact_form".
class contact_form
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['submit'];

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Settings.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * Form name.
     *
     * @var string.
     */
    public $name = '';

    /**
     * Error name.
     *
     * @var string.
     */
    public $errorName = null;

    /**
     * Form email address.
     *
     * @var string.
     */
    public $address = '';

    /**
     * Error address.
     *
     * @var string.
     */
    public $errorAddress = null;

    /**
     * Form message.
     *
     * @var string.
     */
    public $message = '';

    /**
     * Error message.
     *
     * @var string.
     */
    public $errorMessage = null;

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
     * If form render form.
     *
     * @var bool.
     */
    public $renderForm = true;

    /**
     * If is error.
     *
     * @var string.
     */
    public $error = false;

    /**
     * Used object "core\mailer".
     *
     * @var object.
     */
    protected $_mailer = null;

    /**
     * Used object "core\strings".
     *
     * @var object.
     */
    protected $_strings = null;

    /**
     * contact_form constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     *
     * @return bool.
     * @throws.
     */
    protected function init()
    {
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp('appnetos/contact_form')->getId();

        // Get and set used objects.
        $this->_strings = objects::get('strings');
        $this->_mailer = objects::get('appnetos/mailer');

        // If mailer not set.
        if (!$this->_mailer) {
            $this->error = $this->_strings->get('appnetos__contact_form__err_mailer');
            return false;
        }

        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get or set settings by object "core\extensions".
        $extensions = objects::get('extensions');
        $settings = $extensions->get('text', $this->appId, 'appnetos/contact_form');

        // If settings exists.
        if ($settings) {
            $this->settings = json_decode($settings);
            return true;
        }

        // If settings not exists.
        $this->error = $this->_strings->get('appnetos__contact_form__err_settings');

        // Return.
        return false;
    }

    /**
     * AJAX function submit mail by using mailer.
     *
     * @return bool.
     * @throws.
     */
    public function submit()
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Get Parameters by object "core\post".
        $post = objects::get('post');
        $data = $post->get('data');

        // If parameters not exists.
        if (!$data) {
            return false;
        }

        // Set parameters
        $mid = null;
        foreach ($data as $parameter) {
            if ($parameter['name'] === 'mid') {
                $mid = trim($parameter['value']);
            }
            if ($parameter['name'] === 'name') {
                $this->name = trim(strip_tags($parameter['value']));
            }
            if ($parameter['name'] === 'address') {
                $this->address = trim(strip_tags($parameter['value']));
            }
            if ($parameter['name'] === 'message') {
                $this->message = trim(strip_tags($parameter['value']));
            }
        }

        // Check parameters.
        if ($this->name === '') {
            $this->errorName = $this->_strings->get('appnetos__contact_form__enter_name');
        }
        if ($this->address === '') {
            $this->errorAddress = $this->_strings->get('appnetos__contact_form__enter_address');
        }
        elseif (!filter_var($this->address, FILTER_VALIDATE_EMAIL)) {
            $this->errorAddress = $this->_strings->get('appnetos__contact_form__err_address');
        }
        if ($this->message === '') {
            $this->errorMessage = $this->_strings->get('appnetos__contact_form__enter_message');
        }

        // On error.
        if (
            $this->errorName ||
            $this->errorAddress ||
            $this->errorMessage
        ) {
            $this->render();
            return;
        }

        // Create body.
        $body = '<strong>' . $this->_strings->get('appnetos__contact_form__name') . '</strong>: ' . $this->name . '<br><br>';
        $body .= '<strong>' . $this->_strings->get('appnetos__contact_form__address') . '</strong>: ' . $this->address . '<br><br>';
        $body .= '<strong>' . $this->_strings->get('appnetos__contact_form__message') . '</strong>:<br>' . nl2br(strip_tags($this->message, '<br><a>'));

        // Try send mail.
        $this->_mailer->id = $mid;
        $this->_mailer->mailbox = $this->settings->mailbox;
        $this->_mailer->toAddress = $this->settings->address;
        $this->_mailer->subject = $this->settings->subject;
        $this->_mailer->fromName = $this->name;
        $this->_mailer->body = $body;
        $this->_mailer->isHtml = true;
        if ($this->_mailer->send()) {
            $this->ajaxConfirm = $this->_strings->get('appnetos__contact_form__confirm');
        }
        else {
            $this->ajaxError = $this->_strings->get('appnetos__contact_form__error');
        }

        // Render.
        $this->renderForm = false;
        $this->render();
    }

    /**
     * Render AJAX template.
     * Echo rendered template as send JSON.
     */
    protected function render()
    {
        // Render template.
        $render = objects::get('render');
        $render->assign('appnetos__contact_form', $this);
        $result = $render->fetch('application/apps/appnetos/contact_form/application/views/contact_form__form.tpl');

        // JSON Callback.
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Get Mailer id.
     *
     * @return bool.
     */
    public function getMailerId()
    {
        return $this->_mailer->getId();
    }
}