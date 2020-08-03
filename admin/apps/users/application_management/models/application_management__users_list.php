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

// Model "admin\users\application_management__users_list".
class application_management__users_list
{

    /**
     * Count.
     *
     * @var int.
     */
    public $count = null;

    /**
     * Areas.
     *
     * @var int.
     */
    public $areas = null;

    /**
     * Start.
     *
     * @var int.
     */
    public $start = null;

    /**
     * End.
     *
     * @var int.
     */
    public $end = null;

    /**
     * List.
     *
     * @var array.
     */
    public $usersList = [];

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
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__users__application_management__users_list', $this);

        // Get used objects.
        $database = objects::get('database');
        $managementSearch = objects::get('admin/users/application_management__search');

        // Set selection.
        $selection = '';
        if ($managementSearch->selection === 'registered') {
            $selection = ' AND xt_deleted=0 ';
        }
        elseif ($managementSearch->selection === 'active') {
            $selection = ' AND xt_active=1 ';
        }
        elseif ($managementSearch->selection === 'unactive') {
            $selection = ' AND xt_active=0 ';
        }
        elseif ($managementSearch->selection === 'locked') {
            $selection = ' AND xt_locked=1 ';
        }
        elseif ($managementSearch->selection === 'deleted') {
            $selection = ' AND xt_deleted=1 ';
        }

        // Set search parameter.
        $search = '%' . $managementSearch->search . '%';

        // Select count from database table "application_users".
        $query = 'SELECT COUNT(*) FROM application_users WHERE (xt_user LIKE ? OR xt_mail LIKE ?)' . $selection;
        $this->count = $database->count($query, [$search, $search]);

        // Prepare parameters.
        $this->areas = round($this->count / $managementSearch->number + 0.49999999999);
        if ($managementSearch->area > $this->areas || $managementSearch->area < 1) {
            $managementSearch->updateArea(1);
        }
        $this->start = $managementSearch->area - 5;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $managementSearch->area + 5;
        if ($this->end > $this->areas) {
            $this->end = $this->areas;
        }
        $offset = ($managementSearch->area - 1) * $managementSearch->number;

        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE (xt_user LIKE ? OR xt_mail LIKE ?)' . $selection . ' ORDER BY ' . $managementSearch->order .' LIMIT ' . $managementSearch->number . ' OFFSET ' . $offset;
        $array = $database->selectArray($query, [$search, $search]);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Get object "admin\users\application_management__user".
        objects::get('admin/users/application_management__user');

        // Initialize apps.
        for ($i = 0; $i < count($array); $i++) {
            $managementUser = objects::getNew('admin/users/application_management__user');
            $managementUser->id = (int)$array[$i]['xt_id'];
            $managementUser->init();
            array_push($this->usersList, $managementUser);
        }
    }

    /**
     * Add.
     */
    public function add()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__users__application_management__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__users__application_management__add_err');
        }

        // Prepare parameters.
        $user = null;
        $minUserVerify = false;
        $mail = null;
        $pass = null;
        $minPassVerify = false;
        foreach ($parameters as $parameter) {
            if ($parameter['name'] === 'user') {
                $user = trim($parameter['value']);
            }
            elseif ($parameter['name'] === 'min_user_verify') {
                $minUserVerify = true;
            }
            elseif ($parameter['name'] === 'mail') {
                $mail = trim($parameter['value']);
            }
            elseif ($parameter['name'] === 'pass') {
                $pass = trim($parameter['value']);
            }
            elseif ($parameter['name'] === 'min_pass_verify') {
                $minPassVerify = true;
            }
        }

        // If parameters not exists.
        if ($user === '') {
            $this->render('admin__users__application_management__add_err_user_enter');
        }
        if ($pass === '') {
            $this->render('admin__users__application_management__add_err_pass_enter');
        }
        if ($mail === '') {
            $this->render('admin__users__application_management__add_err_mail_enter');
        }

        // Get object "core\account".
        $account = objects::getNew('core/account');

        // Force verify user.
        $account->forceVerify = true;

        // Verify username.
        if (!$account->verifyUserExists($user)) {
            $this->render('admin__users__application_management__add_err_user_exists');
        }
        if ($minUserVerify) {
            $account->minUserVerify = true;
        } else {
            if (!$account->verifyUserValid($user)) {
                $this->render('admin__users__application_management__add_err_user_valid');
            }
            if (!$account->verifyUserUsable($user)) {
                $this->render('admin__users__application_management__add_err_user_usable');
            }
        }

        // Verify mail address.
        if (!$account->verifyMailExists($mail)) {
            $this->render('admin__users__application_management__add_err_mail_exists');
        }
        if (!$account->verifyMailValid($mail)) {
            $this->render('admin__users__application_management__add_err_mail_valid');
        }

        // Verify password.
        if ($minPassVerify) {
            $account->minPassVerify = true;
        } else {
            if (!$account->verifyPassValid($pass)) {
                $this->render('admin__users__application_management__add_err_pass_valid');
            }
            if (!$account->verifyPassUsable($pass)) {
                $this->render('admin__users__application_management__add_err_pass_usable');
            }
        }

        // Create account.
        $code = $account->create($user, $pass, $mail);
        if ($code === null) {
            $this->render('admin__users__application_management__add_err');
        }

        // Render.
        $this->render(null, 'admin__users__application_management__add_conf');
    }

    /**
     * Delete.
     */
    public function delete()
    {
        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__users__application_management__parameters');
        $parameters = json_decode($parameters);

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render('admin__users__application_management__err_delete');
        }
        if (count($parameters) !== 2) {
            $this->render('admin__users__application_management__err_delete');
        }

        // Prepare parameters.
        $id = trim($parameters[0]);
        $id = (int)$id;
        $system = trim($parameters[1]);
        $system = (int)$system;

        // If is current account.
        $user = objects::get('user');
        if ($user->getId() === $id) {
            $this->render('admin__users__application_management__err_delete');
        }

        // If is delete user from system.
        if ($system) {

            // Get object "core\database".
            $database = objects::get('database');

            // Select from database table "application_users".
            $query = 'SELECT xt_id FROM application_users WHERE xt_id=?';
            $row = $database->selectRow($query, [$id]);

            // If data not exists.
            if (!$row) {
                $this->render('admin__users__application_management__err_delete');
            }

            // Delete from database table "application_users".
            $query = 'DELETE FROM application_users WHERE xt_id=?';

            // If not deleted.
            if (!$database->delete($query, [$id])) {
                $this->render('admin__users__application_management__err_delete');
            }

            // Render.
            $this->render(null, 'admin__users__application_management__conf_delete');
        }

        // If is delete user not from system.
        else {

            // Get object "core\account".
            $account = objects::getNew('core/account');

            // Activate account.
            $result = $account->delete($id);

            // If not deleted.
            if (!$result) {
                $this->render('admin__users__application_management__err_delete');
            }

            // Render.
            $this->render(null, 'admin__users__application_management__conf_delete');
        }
    }

    /**
     * Restore.
     */
    public function restore()
    {
        // Get parameters.
        $post = objects::get('post');
        $id = $post->get('admin__users__application_management__parameters');
        $id = (int)$id;

        // Get object "core\account".
        $account = objects::getNew('core/account');

        // Restore account.
        $result = $account->restore($id);

        // If not restored.
        if (!$result) {
            $this->render('admin__users__application_management__restore_err');
            $this->render(null, 'admin__users__application_management__restore_conf');
        }

        // Render.
        $this->render(null, 'admin__users__application_management__restore_conf');
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
        $strings = objects::get('strings');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Get object "admin\users\application_management__model".
        $managementModel = objects::get('admin\users\application_management__model');
        $managementModel->init();

        // Render template.
        $output = $render->fetch('admin/apps/users/application_management/views/application_management__users_list.tpl');
        echo $output;
        exit();
    }
}