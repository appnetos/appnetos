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
 * @description     Sign up form form to provide user information. Can be used with and without email confirmation.
 *                  Creates a user and sends a confirmation by the APPNET OS mailer with confirmation link.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\sign_up_form"
class sign_up_form
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
     * sign_up_form constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    public function init()
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
                    $this->_extensions->set(json_encode($this->settings), 'text', $this->appId, 'appnetos/sign_up_form');
                }
            }
        }

        // If settings not exists.
        else {
            $this->settings->mailbox = null;
            $this->settings->force = false;
            $this->settings->terms = null;
            $this->settings->name = 'APPNET OS';
            $this->_extensions->set(json_encode($this->settings), 'text', $this->appId,  'appnetos/sign_up_form');
        }
    }

    /**
     * AJAX request edit settings.
     *
     * @return bool.
     * @throws \core\exception.
     */
    public function edit()
    {
        // Initialize.
        $this->init();

        // Get post parameters.
        $post = objects::get('post');
        $strings = objects::get('strings');
        $mailbox = strip_tags(trim($post->get('mailbox')));
        $terms = trim($post->get('terms'));
        str_replace("\\", "/", $terms);
        $name = trim($post->get('name'));
        $tmp = strip_tags(trim($post->get('force')));
        if ($tmp === 'on') {
            $force = true;
        }
        else {
            $force = false;
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
                $this->ajaxError = $strings->get('appnetos__sign_up_form__err_mailbox');
                $this->render();
                return;
            }
        }

        // If terms not exists.
        if ($terms === '') {
            $terms = null;
        } elseif (is_numeric($terms)) {
            $terms = (int)$terms;
        }

        // Set parameters.
        $this->settings->mailbox = $mailbox;
        $this->settings->force = $force;
        $this->settings->terms = $terms;
        $this->settings->name = $name;
        $this->_extensions->set(json_encode($this->settings), 'text', $this->appId, 'appnetos/sign_up_form');

        // Render AJAX template.
        $this->ajaxConfirm = $strings->get('appnetos__sign_up_form__conf');
        $this->render();
        return;
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     */
    protected function render() {

        // Render template.
        $render = objects::get('render');
        $render->assign('appnetos__sign_up_form', $this);
        $template = $render->fetch('application/apps/appnetos/sign_up_form/admin/views/sign_up_form__settings.tpl');
        header('Content-Type: application/json');
        echo json_encode($template);
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