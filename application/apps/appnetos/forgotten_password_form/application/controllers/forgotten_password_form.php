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

// Controller "appnetos\forgotten_password_form".
class forgotten_password_form
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['submitEmail', 'submitPass'];

    /**
     * Template to render.
     *
     * @var string.
     */
    public $template = null;

    /**
     * Settings.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * Code from GET parameter.
     *
     * @var string.
     */
    public $code = null;

    /**
     * Address form value.
     *
     * @var string.
     */
    public $address = null;

    /**
     * Address from error.
     *
     * @var string.
     */
    public $addressError = null;

    /**
     * Password value.
     *
     * @var string.
     */
    public $pass = null;

    /**
     * Password error.
     *
     * @var string.
     */
    public $passError = null;

    /**
     * Pass repeat value.
     *
     * @var string.
     */
    public $passRepeat = null;

    /**
     * Password repeat error.
     *
     * @var string.
     */
    public $passRepeatError = null;

    /**
     * If is error. Error message.
     *
     * @var string.
     */
    public $error = null;

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
     * Used model "core\strings".
     *
     * @var object.
     */
    protected $_strings = null;

    /**
     * Used model "core\mailer".
     *
     * @var object.
     */
    protected $_mailer = null;

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
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp()->getId('appnetos/forgotten_password_form');

        // Get and set used objects.
        $this->_strings = objects::get('strings');
        $this->_mailer = objects::get('appnetos\mailer');

        // Get if user is logged in.
        $user = objects::get('user');
        if ($user->getActive()) {
            $this->error = $this->_strings->get('appnetos__forgotten_password_form__err_signed_in');
        }

        // Initialize code.
        if (!$this->error) {
            $this->initCode();
        }

        // Initialize app.
        if (!$this->error) {
            $this->initApp();
        }
    }

    /**
     * Initialize code.
     *
     * @return bool.
     * @throws.
     */
    protected function initCode()
    {
        // Get code from by model "core\get".
        $get = objects::get('get');
        $code = $get->get('reset');

        // If code not exists.
        if (!$code) {
            return false;
        }

        // If code true.
        $account = objects::getNew('core/account');
        if ($account->checkResetPassCode($code)) {
            $this->code = $code;
            return true;
        }

        // If code wrong.
        else {
            // If settings not exists.
            $this->error = $this->_strings->get('appnetos__forgotten_password_form__err_code');
            return false;
        }
    }

    /**
     * Initialize app.
     *
     * @return bool.
     * @throws.
     */
    protected function initApp()
    {
        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get or set settings by object "core\extensions".
        $extensions = objects::get('extensions');
        $settings = $extensions->get('text', $this->appId, 'appnetos/forgotten_password_form');

        // If settings exists
        if ($settings) {
            $this->settings = json_decode($settings);
        }

        // If settings not exists.
        else {

            // If settings not exists.
            $this->error = $this->_strings->get('appnetos__forgotten_password_form__err_settings');
            return false;
        }

        // If mailer not set.
        if (!$this->_mailer) {
            $this->error = $this->_strings->get('appnetos__forgotten_password_form__err_mailer');
            return false;
        }

        // Return.
        return true;
    }

    /**
     * AJAX function submit email.
     *
     * @return bool.
     * @throws.
     */
    public function submitEmail()
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Set template to render.
        $this->template = 'application/apps/appnetos/forgotten_password_form/application/views/form_email.tpl';

        // Get object "core\account" and "core\strings".
        $account = objects::getNew('core/account');

        // Get Parameters by object "core\post".
        $post = objects::get('post');
        $mid = trim(strip_tags($post->get('mid')));
        $this->address = trim(strip_tags($post->get('address')));

        // Verify if email address is valid.
        if (!$account->verifyMailValid($this->address)) {
            $this->addressError = $this->_strings->get('appnetos__forgotten_password_form__err_address');
            $this->render();
            return false;
        }

        // Set reset code.
        $code = $account->setResetPassCode($this->address);
        if (!$code) {
            $this->ajaxConfirm = $this->_strings->get('appnetos__forgotten_password_form__address_conf');
            $this->render();
            return false;
        }

        // Try send mail.
        $this->_mailer->id = $mid;
        $this->_mailer->mailbox = $this->settings->mailbox;
        $this->_mailer->toAddress = $this->address;
        $this->_mailer->blacklist = $this->address;
        if ($this->settings->name !== '') {
            $this->_mailer->fromName = $this->settings->name;
        }
        $this->_mailer->subject = $this->settings->name . '. ' . $this->_strings->get('appnetos__forgotten_password_form__subject');
        $this->_mailer->body = $this->createBody($code);
        $this->_mailer->isHtml = true;
        if ($this->_mailer->send()) {
            $this->ajaxConfirm = $this->_strings->get('appnetos__forgotten_password_form__address_conf');
            $this->render();
            return true;
        }
        else {
            $this->ajaxConfirm = $this->_strings->get('appnetos__forgotten_password_form__address_conf');
            $this->render();
            return false;
        }
    }

    /**
     * Function create mail body.
     *
     * @param string $code verify reset password code.
     * @return string.
     * @throws.
     */
    protected function createBody($code)
    {
        // Generate link.
        $link = urldecode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        $link = trim($link, "/\\");
        $array = explode('?', $link);
        $link = $array[0] . '?reset=' . $code;

        // Get controller "core\render".
        $render = objects::get('render');

        // Get model "appnetos\forgotten_password_form__mail".
        $forgottenPasswordFormMail = objects::getNew('appnetos/forgotten_password_form__mail');
        $render->assign('appnetos__forgotten_password_form__mail', $forgottenPasswordFormMail);
        $forgottenPasswordFormMail->subject = $this->_strings->get('appnetos__forgotten_password_form__subject');
        $forgottenPasswordFormMail->name = $this->settings->name;
        $forgottenPasswordFormMail->code = $code;
        $forgottenPasswordFormMail->link = $link;

        // Create mail body.
        $buffer = $render->fetch('application/apps/appnetos/forgotten_password_form/application/views/forgotten_password_form__mail_header.tpl');
        $buffer .= '<a href="' . $link . '">' . $link . '</a>';
        $buffer .= $render->fetch('application/apps/appnetos/forgotten_password_form/application/views/forgotten_password_form__mail_footer.tpl');

        // Return buffer.
        return $buffer;
    }

    /**
     * AJAX function submit password.
     *
     * @return bool.
     * @throws \core\exception.
     */
    public function submitPass()
    {
        // If is error.
        if ($this->error) {
            return false;
        }

        // Set template to render.
        $this->template = 'application/apps/appnetos/forgotten_password_form/application/views/form_pass.tpl';

        // Get object "core\account" and "core\strings".
        $account = objects::getNew('core/account');

        // Get Parameters by object "core\post".
        $post = objects::get('post');
        $this->address = trim(strip_tags($post->get('address')));
        $this->pass = trim(strip_tags($post->get('pass')));
        $this->passRepeat = trim(strip_tags($post->get('repeat')));

        // If parameters not is set.
        if (!$this->address) {
            $this->addressError = $this->_strings->get('appnetos__forgotten_password_form__err_mail_enter');
        }

        // Verify if email address is valid.
        if (!$this->addressError) {
            if (!$account->verifyMailValid($this->address)) {
                $this->addressError = $this->_strings->get('appnetos__forgotten_password_form__err_address');
            }
        }
        if (!$this->addressError) {
            if (!$account->checkResetPassMail($this->address, $this->code)) {
                $this->addressError = $this->_strings->get('appnetos__forgotten_password_form__err_address');
            }
        }

        // Verify password.
        if (!$this->pass) {
            $this->passError = $this->_strings->get('appnetos__forgotten_password_form__err_pass_enter');
        }
        if (!$this->passRepeat) {
            $this->passRepeatError = $this->_strings->get('appnetos__forgotten_password_form__err_pass_enter');
        }

        // If password and password repeat not match.
        if (!$this->passError && !$this->passRepeatError) {
            if ($this->pass !== $this->passRepeat) {
                $this->passError = $this->_strings->get('appnetos__forgotten_password_form__err_pass_compare');
                $this->passRepeatError = $this->_strings->get('appnetos__forgotten_password_form__err_pass_compare');
            }
        }

        // Verify if password is valid.
        if (!$this->passError && !$this->passRepeatError) {
            if (!$account->verifyPass($this->pass)) {
                $this->passError = $this->_strings->get('appnetos__forgotten_password_form__err_pass_valid');
                $this->passRepeatError = $this->_strings->get('appnetos__forgotten_password_form__err_pass_valid');
            }
        }

        // Reset code.
        if (!$this->addressError && !$this->passError && !$this->passRepeatError) {
            if ($account->resetPass($this->address, $this->code, $this->pass)) {
                $this->ajaxConfirm = $this->_strings->get('appnetos__forgotten_password_form__pass_conf');
            } else {
                $this->ajaxError = $this->_strings->get('appnetos__forgotten_password_form__pass_err');
            }
        }

        // Render.
        $this->render();
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     */
    protected function render()
    {
        // Render template.
        $render = objects::get('render');
        $render->assign('appnetos__forgotten_password_form', $this);
        $result = $render->fetch($this->template);

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

    /**
     * Get link.
     *
     * @param string $link.
     * @return string.
     * @throws.
     */
    public function getUrl($link)
    {
        // If link is not numeric.
        if (!is_numeric($link)) {
            return $link;
        }

        // Get object "core\uri".
        $uri = objects::get('core/uri');

        // Get multilingual URL by int of global URI.
        $tmp = $uri->getUrl((int)$link);

        // Return URI.
        if ($tmp) {
            return $tmp;
        }
        return $link;
    }
}