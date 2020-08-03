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

// Model "appnetos\sign_up_form".
class sign_up_form
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
     * Form user.
     *
     * @var string.
     */
    public $user = '';

    /**
     * Form user error.
     *
     * @var string.
     */
    public $errorUser = null;

    /**
     * Form email address.
     *
     * @var string.
     */
    public $address = '';

    /**
     * Form email address error.
     *
     * @var string.
     */
    public $errorAddress = null;

    /**
     * Form password.
     *
     * @var string.
     */
    public $pass = '';

    /**
     * Form password error.
     *
     * @var string.
     */
    public $errorPass = null;

    /**
     * Form repeat password.
     *
     * @var string.
     */
    public $passRepeat = '';

    /**
     * Form password repeat error.
     *
     * @var string.
     */
    public $errorPassRepeat = null;

    /**
     * Form terms.
     *
     * @var bool.
     */
    public $terms = false;

    /**
     * Form terms error.
     *
     * @var bool.
     */
    public $errorTerms = null;

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
     * If is error. Error message.
     *
     * @var string.
     */
    public $error = null;

    /**
     * If is confirm.
     *
     * @var string.
     */
    public $confirm = null;

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
     * sign_up_form constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();

        // Confirm code.
        if (!$this->error) {
            $this->confirmCode();
        }
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
        $this->appId = objects::getApp('appnetos/sign_up_form')->getId();

        // Get and set used objects.
        $this->_strings = objects::get('strings');

        // Get if user is logged in.
        $user = objects::get('user');
        if ($user->getActive()) {
            $this->error = $this->_strings->get('appnetos__sign_up_form__err_signed_in');
            return false;
        }

        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get or set settings by object "core\extensions".
        $extensions = objects::get('extensions');
        $settings = $extensions->get('text', $this->appId, 'appnetos/sign_up_form');

        // If settings exists
        if ($settings) {
            $this->settings = json_decode($settings);
        }

        // If settings not exists.
        else {

            // If settings not exists.
            $this->error = $this->_strings->get('appnetos__sign_up_form__err_settings');
            return false;
        }

        // If is not force create account.
        if (!$this->settings->force) {

            // Get object "appntos/mailer".
            $this->_mailer = objects::get('appnetos/mailer');

            // If mailer not set.
            if (!$this->_mailer) {
                $this->error = $this->_strings->get('appnetos__sign_up_form__err_mailer');
                return false;
            }

            // Get mailbox.
            if (!$this->settings->mailbox) {
                $this->error = $this->_strings->get('appnetos__sign_up_form__err_mailbox');
                return false;
            }
        }

        // Return.
        return true;
    }

    /**
     * Confirm code.
     *
     * @return bool.
     * @throws.
     */
    protected function confirmCode()
    {
        // Get object "core\get" and object "core\database".
        $get = objects::get('get');
        $database = objects::get('database');

        // Get code.
        $code = $get->get('confirm');

        // If confirm code not is set.
        if (!$code) {
            return false;
        }

        // Get from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_code=?';
        $row = $database->selectRow($query, [$code]);

        // If data not exists.
        if (!$row) {

            // Return with error message.
            $this->error = $this->_strings->get('appnetos__sign_up_form__err_confirm');
            $this->renderForm = false;
            return false;
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_code=? WHERE xt_code=?';
        $database->update($query, ['', $code]);

        // Return with confirm message.
        $this->confirm = $this->_strings->get('appnetos__sign_up_form__conf_confirm');
        $this->renderForm = false;
        return true;
    }

    /**
     * AJAX function submit sign up.
     */
    public function submit()
    {
        // Initialize.
        $this->init();

        // If is error.
        if ($this->error) {
            return false;
        }

        // Get used objects.
        $account = objects::getNew('account');

        // Get Parameters by object "core\post".
        $post = objects::get('post');
        $mid = trim(strip_tags($post->get('mid')));
        $this->user = trim(strip_tags($post->get('user')));
        $this->address = trim(strip_tags($post->get('address')));
        $this->pass = trim(strip_tags($post->get('pass')));
        $this->passRepeat = trim(strip_tags($post->get('pass_repeat')));
        $tmp = strip_tags(trim($post->get('terms')));
        if ($tmp === 'on') {
            $this->terms = true;
        }
        else {
            $this->terms = false;
        }

        // If not force create account.
        if (!$this->settings->force) {

            // If mailer is not active.
            if (!$this->_mailer) {
                $this->ajaxError = $this->_strings->get('appnetos__sign_up_form__err_create');
                $this->render();
                return false;
            }

            // Compare mailer ID.
            if ($this->_mailer->getId() !== $mid) {
                $this->ajaxError = $this->_strings->get('appnetos__sign_up_form__err_create');
                $this->render();
                return false;
            }
        }

        // Verify username.
        if ($this->user === '') {
            $this->errorUser = $this->_strings->get('appnetos__sign_up_form__err_user_enter');
        }
        if (!$this->errorUser) {
            if (!$account->verifyUserValid($this->user)) {
                $this->errorUser = $this->_strings->get('appnetos__sign_up_form__err_user_valid');
            }
        }
        if (!$this->errorUser) {
            if (!$account->verifyUserExists($this->user)) {
                $this->errorUser = $this->_strings->get('appnetos__sign_up_form__err_user_exists');
            }
        }
        if (!$this->errorUser) {
            if (!$account->verifyUserUsable($this->user)) {
                $this->errorUser = $this->_strings->get('appnetos__sign_up_form__err_user_usable');
            }
        }

        // Verify mail address.
        if ($this->address === '') {
            $this->errorAddress = $this->_strings->get('appnetos__sign_up_form__err_mail_enter');
        }
        if (!$this->errorAddress) {
            if (!$account->verifyMailValid($this->address)) {
                $this->errorAddress = $this->_strings->get('appnetos__sign_up_form__err_mail_valid');
            }
        }
        if (!$this->errorAddress) {
            if (!$account->verifyMailExists($this->address)) {
                $this->errorAddress = $this->_strings->get('appnetos__sign_up_form__err_mail_exists');
            }
        }

        // Verify password.
        if ($this->pass === '') {
            $this->errorPass = $this->_strings->get('appnetos__sign_up_form__err_pass_enter');
        }
        if (!$this->errorPass) {
            if ($this->pass !== $this->passRepeat) {
                $this->errorPass = $this->_strings->get('appnetos__sign_up_form__err_pass_compare');
                $this->errorPassRepeat = $this->_strings->get('appnetos__sign_up_form__err_pass_compare');
            }
        }
        if (!$this->errorPass) {
            if (!$account->verifyPassValid($this->pass)) {
                $this->errorPass = $this->_strings->get('appnetos__sign_up_form__err_pass_valid');
            }
        }
        if (!$this->errorPass) {
            if (!$account->verifyPassUsable($this->pass)) {
                $this->errorPass = $this->_strings->get('appnetos__sign_up_form__err_pass_usable');
            }
        }

        // Verify terms.
        if ($this->settings->terms) {
            if (!$this->terms) {
                $this->errorTerms = $this->_strings->get('appnetos__sign_up_form__err_terms');
            }
        }

        // If is error.
        if ($this->errorUser || $this->errorAddress || $this->errorPass || $this->errorTerms) {
            $this->render();
            return false;
        }

        // If force create account.
        if ($this->settings->force) {
            $account->forceVerify = true;
        }

        // Create account.
        $code = $account->create($this->user, $this->pass, $this->address);

        if ($code === null) {
            $this->ajaxError = $this->_strings->get('appnetos__sign_up_form__err_create');
            $this->render();
            return false;
        }

        // If force create account.
        if ($this->settings->force) {
            $this->ajaxConfirm = $this->_strings->get('appnetos__sign_up_form__conf_create');
            $this->renderForm = false;
            $this->render();
            return true;
        }

        // Try send mail.
        $this->_mailer->id = $mid;
        $this->_mailer->mailbox = $this->settings->mailbox;
        $this->_mailer->toAddress = $this->address;
        if ($this->settings->name !== '') {
            $this->_mailer->fromName = $this->settings->name;
        }
        $this->_mailer->subject = $this->settings->name . ' ' . $this->_strings->get('appnetos__sign_up_form__subject');
        $this->_mailer->body = $this->createBody($code);
        $this->_mailer->isHtml = true;
        if ($this->_mailer->send()) {
            $this->ajaxConfirm = $this->_strings->get('appnetos__sign_up_form__conf_send_mail');
            $this->renderForm = false;
            $this->render();
            return true;
        }
        else {
            $database = objects::get('database');
            $query = "SELECT xt_id FROM application_users WHERE xt_code=?";
            $row = $database->selectRow($query, [$code]);
            if ($row) {
                $query = 'DELETE FROM application_users WHERE xt_id=?';
                $database->delete($query, [$row['xt_id']]);
            }
            $this->ajaxError = $this->_strings->get('appnetos__sign_up_form__err_create');
            $this->render();
            return false;
        }
    }

    /**
     * Function create mail body.
     *
     * @param string $code verify registration code.
     * @return string.
     * @throws.
     */
    protected function createBody($code)
    {
        // Generate link.
        $link = urldecode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        $link = trim($link, "/\\");
        $array = explode('?', $link);
        $link = $array[0] . '?confirm=' . $code;

        // Get controller "core\render".
        $render = objects::get('render');

        // Get model "appnetos\sign_up_form__mail".
        $signUpFormMail = objects::getNew('appnetos/sign_up_form__mail');
        $render->assign("appnetos__sign_up_form__mail", $signUpFormMail);
        $signUpFormMail->subject = $this->settings->name;
        $signUpFormMail->user = $this->user;
        $signUpFormMail->address = $this->address;
        $signUpFormMail->code = $code;
        $signUpFormMail->link = $link;

        // Create mail body.
        $buffer = $render->fetch('application/apps/appnetos/sign_up_form/application/views/sign_up_form__mail_header.tpl');
        $buffer .= '<a href="' . $link . '">' . $link . '</a>';
        $buffer .= $render->fetch('application/apps/appnetos/sign_up_form/application/views/sign_up_form__mail_footer.tpl');

        // Return buffer.
        return $buffer;
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     */
    protected function render()
    {
        $render = objects::get('render');
        $render->assign('appnetos__sign_up_form', $this);
        $template = $render->fetch('application/apps/appnetos/sign_up_form/application/views/sign_up_form__form.tpl');
        header('Content-Type: application/json');
        echo json_encode($template);
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