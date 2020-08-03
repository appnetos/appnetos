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

// Controller "appnetos\contact_form"
class contact_form
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
     * Mailboxes.
     *
     * @var \stdClass.
     */
    public $mailboxes = null;

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
     * Used object "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

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
     */
    protected function init()
    {
        // Get app ID by index from object "core\uri".
        $uri = objects::get('uri');
        $index = $uri->getRequestIndex();
        if (isset($index[3])) {
            $this->appId = (int)$index[3];
        }

        // Get and set used objects.
        $this->_extensions = objects::get('extensions');

        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get mailboxes.
        $mailboxes = $this->_extensions->get('text', 2, 'appnetos/mailer');
        if ($mailboxes) {
            $this->mailboxes = json_decode($mailboxes);
        }

        // Get settings.
        $settings = $this->_extensions->get('text', $this->appId, 'appnetos/contact_form');

        // If settings exists.
        if ($settings) {
            $this->settings = json_decode($settings);
            if ($this->settings->mailbox !== null) {
                $exists = false;
                foreach ($this->mailboxes as $mailboxesMailbox) {
                    if ($mailboxesMailbox->uuid === $this->settings->mailbox) {
                        $exists = true;
                        break;
                    }
                }
                if (!$exists) {
                    $this->settings->mailbox = null;
                    $this->_extensions->set(json_encode($this->settings), 'text', $this->appId, 'appnetos/contact_form');
                }
            }
        }

        // If settings not exists.
        else {
            $this->settings->mailbox = null;
            $this->settings->subject = '';
            $this->settings->address = '';
            $this->_extensions->set(json_encode($this->settings), 'text', $this->appId, 'appnetos/contact_form');
        }
    }

    /**
     * AJAX request edit settings.
     *
     * @return bool.
     * @throws.
     */
    public function edit()
    {
        // Initialize.
//        $this->init();

        // Get Parameters by object "core\post".
        $post = objects::get('post');
        $data = $post->get('data');

        // If parameters not exists.
        if (!$data) {
            return;
        }

        // Set parameters
        $mailbox = null;
        $address = null;
        $subject = null;
        foreach ($data as $parameter) {
            if ($parameter['name'] === 'mailbox') {
                $mailbox = $parameter['value'];
            }
            if ($parameter['name'] === 'address') {
                $address = $parameter['value'];
            }
            if ($parameter['name'] === 'subject') {
                $subject = $parameter['value'];
            }
        }

        // If mailbox not exists.
        if ($mailbox === '') {
            $mailbox = null;
        }
        else {
            $exists = false;
            foreach ($this->mailboxes as $mailboxesMailbox) {
                if ($mailboxesMailbox->uuid === $mailbox) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $this->render('appnetos__contact_form__err_mailbox');
                return false;
            }
        }

        // If address not exists.
        if ($address === '') {
            $address = '';
        }

        // If address exists.
        elseif (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            $this->render('appnetos__contact_form__err_mail');
            return false;
        }

        // Set parameters.
        $this->settings->mailbox = $mailbox;
        $this->settings->address = $address;
        $this->settings->subject = $subject;
        $this->_extensions->set(json_encode($this->settings), 'text', $this->appId, 'appnetos/contact_form');

        // Render AJAX template.
        $this->render(null, 'appnetos__contact_form__conf');

        // Return.
        return true;
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     *
     * @param string $error.
     * @param string $confirm.
     * @throws.
     */
    protected function render($error = null, $confirm = null) {

        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }
        $render->assign('appnetos__contact_form', $this);

        // Render template.
        $result = $render->fetch('application/apps/appnetos/contact_form/admin/views/contact_form__settings.tpl');

        // JSON Callback.
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Get mailboxes as array.
     *
     * @return array.
     */
    public function getMailboxes()
    {
        $array = (array)$this->mailboxes;
        asort($array);
        return $array;
    }
}