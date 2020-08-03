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
 * @description     Password recovery form. Resets the password and sends an email with a link to recover the password
 *                  by using APPNET OS Mailer.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\forgotten_password_form"
class forgotten_password_form
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
     * Used controller "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * forgotten_password_form constructor.
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
        $settings = $this->_extensions->get('text', $this->appId);

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
                    $this->_extensions->set(json_encode($this->settings), 'text', $this->appId, 'appnetos/forgotten_password_form');
                }
            }
        }

        // If settings not exists.
        else {
            $this->settings->mailbox = null;
            $this->settings->name = 'APPNET OS';
            $this->_extensions->set(json_encode($this->settings), 'text', $this->appId, 'appnetos/forgotten_password_form');
        }
    }

    /**
     * AJAX request edit settings.
     */
    public function edit()
    {
        // Initialize.
        $this->init();

        // Get used objects.
        $strings = objects::get('strings');

        // Get post parameters.
        $post = objects::get('post');
        $mailbox = strip_tags(trim($post->get('mailbox')));
        $name = trim($post->get('name'));

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
                $this->ajaxError = $strings->get('appnetos__forgotten_password_form__err_mailbox');
                $this->render();
                return;
            }
        }

        // Set parameters.
        $this->settings->mailbox = $mailbox;
        $this->settings->name = $name;
        $this->_extensions->set(json_encode($this->settings), 'text', $this->appId, 'appnetos/forgotten_password_form');

        // Render AJAX template.
        $this->ajaxConfirm = $strings->get('appnetos__forgotten_password_form__conf');
        $this->render();
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     */
    protected function render() {

        // Prepare parameters.
        $render = objects::get('render');
        $render->assign('appnetos__forgotten_password_form', $this);

        // Render template.
        $result = $render->fetch('application/apps/appnetos/forgotten_password_form/admin/views/settings.tpl');

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