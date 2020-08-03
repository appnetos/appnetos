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
 * @description     Admin overview and management for application users.
 */

// Namespace.
namespace admin\users;

// Use.
use \core\objects;

// Model "admin\users\application_management__user".
class application_management__user
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Username.
     *
     * @var string.
     */
    public $user = null;

    /**
     * Username lower characters.
     *
     * @var string.
     */
    public $userLower = null;

    /**
     * E-Mail address.
     *
     * @var string.
     */
    public $mail = null;

    /**
     * Image.
     *
     * @var string.
     */
    public $image = null;

    /**
     * If is active.
     *
     * @var bool.
     */
    public $active = false;

    /**
     * Sign in count.
     *
     * @var int.
     */
    public $signInCount = null;

    /**
     * Sign in error count.
     *
     * @var int.
     */
    public $errorCount = null;

    /**
     * IP at sign up.
     *
     * @var string.
     */
    public $ipFirst = null;

    /**
     * Timestamp at sign up.
     *
     * @var int.
     */
    public $tsFirst = null;

    /**
     * IP at last sign in.
     *
     * @var string.
     */
    public $ipLast = null;

    /**
     * Timestamp at last sign in.
     *
     * @var int.
     */
    public $tsLast = null;

    /**
     * If is locked.
     *
     * @var bool.
     */
    public $locked = false;

    /**
     * If is deleted.
     *
     * @var bool.
     */
    public $deleted = false;

    /**
     * Sign up code.
     *
     * @var string.
     */
    public $code = null;

    /**
     * User group ID.
     *
     * @var int.
     */
    public $groupId = null;

    /**
     * User group Name.
     *
     * @var string.
     */
    public $groupName = null;

    /**
     * Sign in error.
     *
     * @var bool.
     */
    public $signInError = false;

    /**
     * If is error loading.
     *
     * @var bool.
     */
    public $error = false;

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
     * Open tab.
     *
     * @var string.
     */
    public $tab = 'properties';

    /**
     * Initialize.
     */
    public function init()
    {
        // Select from database table "application_users".
        $database = objects::get('database');
        $query = null;
        $query = 'SELECT * FROM application_users WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set content.
        $this->id = (int)$row['xt_id'];
        $this->user = $row['xt_user'];
        $this->userLower = $row['xt_user_lower'];
        $this->mail = $row['xt_mail'];
        $this->image = $row['xt_image'];
        $this->active = (bool)$row['xt_active'];
        $this->signInCount = (int)$row['xt_sign_in_count'];
        $this->errorCount = (int)$row['xt_error_count'];
        $this->ipFirst = $row['xt_ip_first'];
        $this->tsFirst = (int)$row['xt_ts_first'];
        $this->ipLast = $row['xt_ip_last'];
        $this->tsLast = (int)$row['xt_ts_last'];
        $this->locked = (bool)$row['xt_locked'];
        $this->deleted = (bool)$row['xt_deleted'];
        $this->code = $row['xt_code'];
        $this->groupId = (int)$row['xt_group'];

        // Set sign in error.
        if ($this->errorCount) {
            $config = objects::get('config');
            if ($this->errorCount >= $config->signInErrorCount) {
                $this->signInError = true;
            }
        }

        // Select from database table "application_groups".
        if ($this->groupId) {
            $query = 'SELECT xt_name FROM application_groups WHERE xt_id=?';
            $row = $database->selectRow($query, [$this->groupId]);
            if ($row) {
                $this->groupName = $row['xt_name'];
            }
        }
    }

    /**
     * Edit.
     */
    public function edit()
    {
        // Set tab.
        $this->tab = 'edit';

        // Get parameters.
        $post = objects::get('post');
        $id = (int)$post->get('user_id');
        $user = trim(strip_tags($post->get('user')));
        $minUserVerify = false;
        if ($post->get('min_user_verify')) {
            $minUserVerify = true;
        }
        $mail = trim(strip_tags($post->get('mail')));
        $pass = trim(strip_tags($post->get('pass')));
        $minPassVerify = false;
        if ($post->get('min_pass_verify')) {
            $minPassVerify = true;
        }
        $groupId = (int)$post->get('group_id');
        $deleteImage = false;
        if ($post->get('delete_image')) {
            $deleteImage = true;
        }
        $image = null;
        if (!$deleteImage) {
            if (isset($_FILES['image'])) {
                if (isset($_FILES['image']['name']) && isset($_FILES['image']['tmp_name']) && isset($_FILES['image']['type'])) {
                    if ($_FILES['image']['name'] && $_FILES['image']['tmp_name'] && $_FILES['image']['type']) {
                        $image = 'image';
                    }
                }
            }
        }

        // Initialize.
        $this->id = $id;
        $this->init();

        // If user not exists.
        if ($this->error) {
            $this->render('admin__users__application_management__edit_err');
        }

        // Get object "core\account".
        $account = objects::getNew('core/account');

        // Verify image.
        if ($image) {
            if (!$account->verifyImageType($image)) {
                $this->render('admin__users__application_management__edit_err_img_type');
            }
            if (!$account->verifyImageSize($image)) {
                $this->render('admin__users__application_management__edit_err_img_size');
            }
        }

        // Verify username.
        if ($user !== $this->user) {
            if (!$account->verifyUserExists($user)) {
                $this->render('admin__users__application_management__edit_err_user_exists');
            }
            if ($minUserVerify) {
                $account->minUserVerify = true;
            } else {
                if (!$account->verifyUserValid($user)) {
                    $this->render('admin__users__application_management__edit_err_user_valid');
                }
                if (!$account->verifyUserUsable($user)) {
                    $this->render('admin__users__application_management__edit_err_user_usable');
                }
            }
        }

        // Verify mail.
        if ($mail !== $this->mail) {
            if (!$account->verifyMailExists($mail)) {
                $this->render('admin__users__application_management__edit_err_mail_exists');
            }
            if (!$account->verifyMailValid($mail)) {
                $this->render('admin__users__application_management__edit_err_mail_valid');
            }
        }

        // Verify Group.
        if ($groupId) {
            if (!$account->verifyGroup($groupId)) {
                $this->render('admin__users__application_management__edit_err_group_valid');
            }
        }

        // Verify Password.
        if ($pass) if ($pass !== '') {
            if ($minPassVerify) {
                $account->minPassVerify = true;
            } else {
                if (!$account->verifyPassValid($pass)) {
                    $this->render('admin__users__application_management__edit_err_pass_valid');
                }
                if (!$account->verifyPassUsable($pass)) {
                    $this->render('admin__users__application_management__edit_err_pass_usable');
                }
            }

            // Update password.
            $account->updatePass($id, $pass);
        }

        // Update image.
        if ($image) {
            $account->updateImage($id, $image);
        }

        // Delete image.
        if ($deleteImage) {
            $account->deleteImage($id);
        }

        // Update username.
        if ($user !== $this->user) {
            $account->updateUser($id, $user);
        }

        // Update mail.
        if ($mail !== $this->mail) {
            $account->updateMail($id, $mail);
        }

        // Update group.
        $account->updateGroup($id, $groupId);

        // Render.
        $this->init();
        $this->render(null, 'admin__users__application_management__edit_conf');
    }

    /**
     * Lock.
     */
    public function lock()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__users__application_management__parameters');
        $id = (int)$id;

        // Initialize.
        $this->id = $id;
        $this->init();

        // If user not exists.
        if ($this->error) {
            $this->render('admin__users__application_management__err_lock');
        }

        // Get object "core\account".
        $account = objects::getNew('core/account');

        // If is current account.
        $user = objects::get('user');
        if ($user->getId() === $id) {
            $this->render('admin__users__application_management__err_lock');
        }

        // Activate account.
        $result = $account->lock($id);

        // If not locked.
        if (!$result) {
            $this->render('admin__users__application_management__err_lock');
        }

        // Render.
        $this->init();
        $this->render(null, 'admin__users__application_management__conf_lock');
    }

    /**
     * Activate.
     */
    public function activate()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__users__application_management__parameters');
        $id = (int)$id;

        // Initialize.
        $this->id = $id;
        $this->init();

        // If user not exists.
        if ($this->error) {
            $this->render('admin__users__application_management__err_activate');
        }

        // Get object "core\account".
        $account = objects::getNew('core/account');

        // Activate account.
        $result = $account->activate($id);

        // If not activated.
        if (!$result) {
            $this->render('admin__users__application_management__err_activate');
        }

        // Render.
        $this->init();
        $this->render(null, 'admin__users__application_management__conf_activate');
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param string $confirm string.
     * @param string $error string.
     * @throws.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $render = objects::get('render');
        $render->assign('admin__users__application_management__user', $this);
        $strings = objects::get('strings');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $managementSearch = objects::get('admin/users/application_management__search');
        $managementSearch->init();
        $output = $render->fetch('admin/apps/users/application_management/views/application_management__user.tpl');
        echo $output;
        exit();
    }
}