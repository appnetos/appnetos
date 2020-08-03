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
 * @description     Form in which users can change their password when they are signed in.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\change_password_form".
class change_password_form
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
     * Old password.
     *
     * @var string.
     */
    public $passOld = null;

    /**
     * Error old password.
     *
     * @var string.
     */
    public $errorPassOld = null;

    /**
     * New password.
     *
     * @var string.
     */
    public $pass = null;

    /**
     * Error new password.
     *
     * @var string.
     */
    public $errorPass = null;

    /**
     * Password repetition.
     *
     * @var string.
     */
    public $repeat = null;

    /**
     * Error password repetition.
     *
     * @var string.
     */
    public $errorRepeat = null;

    /**
     * If is error. Error message.
     *
     * @var string.
     */
    public $error = null;

    /**
     * If is confirm. Confirm message.
     *
     * @var string.
     */
    public $confirm = null;

    /**
     * If is render form.
     *
     * @var bool.
     */
    public $renderForm = true;

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
     * Used model "core\user".
     */
    protected $_user = null;

    /**
     * Used model "core\strings".
     *
     * @var object.
     */
    protected $_strings = null;

    /**
     * change_password_form constructor.
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
        $this->appId = objects::getApp()->getId();

        // Get and set used objects.
        $this->_user = objects::get('user');
        $this->_strings = objects::get('strings');

        // If user not is active.
        if (!$this->_user->getActive()) {
            $this->error = $this->_strings->get('appnetos__change_password_form__not_singed_in');
        }
    }

    /**
     * AJAX function submit sign up.
     *
     * @return bool.
     * @throws.
     */
    public function submit()
    {
        // If is error.
        if ($this->error) {
            return;
        }

        // Get Parameters by object "core\post".
        $post = objects::get('post');
        $data = $post->get('data');

        // If parameters not exists.
        if (!$data) {
            return false;
        }

        // Set parameters
        foreach ($data as $parameter) {
            if ($parameter['name'] === 'passOld') {
                $this->passOld = trim($parameter['value']);
            }
            if ($parameter['name'] === 'pass') {
                $this->pass = trim($parameter['value']);
            }
            if ($parameter['name'] === 'repeat') {
                $this->repeat = trim($parameter['value']);
            }
        }

        // Prepare parameters.
        $account = objects::getNew('core/account');

        // Check parameters.
        if (!$this->passOld) {
            $this->errorPassOld = $this->_strings->get('appnetos__change_password_form__err_enter');
        }
        elseif (!$this->_user->checkPass($this->passOld)) {
            $this->errorPassOld = $this->_strings->get('appnetos__change_password_form__err_pass_old');
        }
        if (!$this->pass) {
            $this->errorPass = $this->_strings->get('appnetos__change_password_form__err_enter');
        }
        if (!$this->repeat) {
            $this->errorRepeat = $this->_strings->get('appnetos__change_password_form__err_enter');
        }
        if (!$this->errorPass && !$this->errorRepeat) {
            if ($this->pass !== $this->repeat) {
                $this->errorPass = $this->_strings->get('appnetos__change_password_form__err_pass_rep');
                $this->errorRepeat = $this->_strings->get('appnetos__change_password_form__err_pass_rep');
            }
            elseif (!$account->verifyPass($this->pass)) {
                $this->errorPass = $this->_strings->get('appnetos__change_password_form__err_pass');
                $this->errorRepeat = $this->_strings->get('appnetos__change_password_form__err_pass');
            }
        }

        // On error.
        if (
            $this->errorPassOld ||
            $this->errorPass ||
            $this->errorRepeat
        ) {
            $this->render();
            return;
        }

        // Change password.
        $id = $this->_user->getId();
        if ($account->updatePass($id, $this->pass)) {
            $this->ajaxConfirm = $this->_strings->get('appnetos__change_password_form__conf');
        }
        else {
            $this->ajaxError = $this->_strings->get('appnetos__change_password_form__err');
        }

        // Render.
        $this->renderForm = false;
        $this->render();
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     *
     * @throws.
     */
    protected function render()
    {
        // Render template.
        $render = objects::get('render');
        $render->assign('appnetos__change_password_form', $this);
        $result = $render->fetch('application/apps/appnetos/change_password_form/application/views/change_password_form__form.tpl');

        // JSON Callback.
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}