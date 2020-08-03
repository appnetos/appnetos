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
 * @description     core/appnetos/account.php ->    Class to manage accounts. Create account, change account
 *                  password and delete account.
 */

// Namespace.
namespace core;

// Class "core\account".
class account extends base
{

    /**
     * Create, edit account minimal username verify. Only check if username entered and not exists.
     *
     * @var bool.
     */
    protected $minUserVerify = false;

    /**
     * Create, edit account minimal password verify. Only check if password is entered.
     *
     * @var bool.
     */
    protected $minPassVerify = false;

    /**
     * Force verify account after create. For creating account without verify mail.
     *
     * @var bool.
     */
    protected $forceVerify = false;

    /**
     * Create, change account minimal mail address verify. Only check if mail address is entered and not exists.
     *
     * @var bool.
     */
    protected $minMailVerify = false;

    /**
     * List of no usable user names from "application/components/nousableuser.php" for application user.
     *
     * @var array.
     */
    protected $noUsableUserApplication = [];

    /**
     * List of no usable passwords from "application/components/nousablepass.php" for application user.
     *
     * @var array.
     */
    protected $noUsablePassApplication = [];

    /**
     * List of no usable passwords from "admin/components/nousablepass.php" for admin user.
     *
     * @var array.
     */
    protected $noUsablePassAdmin = [];

    /**
     * If is admin account.
     *
     * @var bool.
     */
    protected $admin = false;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * Used object "core\config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * Used verify username regular expression pattern from object "core\config" for application user.
     *
     * @var string.
     */
    protected $_userRegexApplication = ['/^(?=.{5,32}$).*/', '/^(?!.*  )/'];

    /**
     * Used verify password regular expression pattern from object "core\config" for application user.
     *
     * @var string.
     */
    protected $_passRegexApplication = ['/\d/', '/[^a-zA-Z\d]/', '/^(?=.{8,32}$).*/'];

    /**
     * Used verify username regular expression pattern from object "core\config" for admin user.
     *
     * @var string.
     */
    protected $_userRegexAdmin = ['/^(?=.{5,32}$).*/', '/^(?!.*  )/'];

    /**
     * Used verify password regular expression pattern from object "core\config" for admin user.
     *
     * @var string.
     */
    protected $_passRegexAdmin = ['/\d/', '/[^a-zA-Z\d]/', '/^(?=.{8,32}$).*/'];

    /**
     * account constructor.
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
        // Get and set used data.
        $this->getSet();

        // Set verify username string as array application users.
        if (gettype($this->_userRegexApplication) === 'string') {
            $this->_userRegexApplication = [$this->_userRegexApplication];
        }

        // Set verify password string as array for application users.
        if (gettype($this->_passRegexApplication) === 'string') {
            $this->_passRegexApplication = [$this->_passRegexApplication];
        }

        // Set verify username string as array for admin users.
        if (gettype($this->_userRegexAdmin) === 'string') {
            $this->_userRegexAdmin = [$this->_userRegexAdmin];
        }

        // Set verify password string as array for admin users.
        if (gettype($this->_passRegexAdmin) === 'string') {
            $this->_passRegexAdmin = [$this->_passRegexAdmin];
        }
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get used objects.
        $this->_database = objects::get('database');

        // Get used variables.
        $this->_config = objects::get('config');
        $this->_userRegexApplication = $this->_config->getUserRegexApplication();
        $this->_passRegexApplication = $this->_config->getPassRegexApplication();
        $this->_userRegexAdmin = $this->_config->getUserRegexAdmin();
        $this->_passRegexAdmin = $this->_config->getPassRegexAdmin();
    }

    /**
     * Set if is admin.
     *
     * @param bool $admin.
     */
    public function setAdmin($admin = false)
    {
        $this->admin = $admin;
    }

    /**
     * Create account.
     *
     * @param string $user username.
     * @param string $pass password.
     * @param string $mail address.
     * @return mixed bool or string user unlock code.
     * @throws exception. Error: Create user error.
     */
    public function create($user, $pass, $mail)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->createApplication($user, $pass, $mail);
        }

        // If is admin user account.
        else {
            return $this->createAdmin($user, $pass, $mail);
        }
    }

    /**
     * Create account application user.
     *
     * @param string $user username.
     * @param string $pass password.
     * @param string $mail address.
     * @return mixed bool or string user unlock code.
     * @throws exception. Error: Create user error.
     */
    protected function createApplication($user, $pass, $mail)
    {
        // Verify user.
        if (!$this->verifyUser($user)) {
            return false;
        }

        // Verify pass.
        if (!$this->verifyPass($pass)) {
            return false;
        }

        // Verify mail.
        if (!$this->verifyMail($mail)) {
            return false;
        }

        // Prepare parameters
        $userLower = mb_strtolower($user);
        $passSalt = md5(uniqid());
        $pass = md5(md5($pass) . $passSalt);
        $ip = $this->getIp();

        // If not force verify.
        if (!$this->forceVerify) {
            $active = 1;
            $code = md5(uniqid()) . md5(uniqid());
        }

        // If force unlock.
        else {
            $active = 1;
            $code = '';
        }

        // Get default group.
        $group = 0;
        $query = 'SELECT xt_id FROM application_groups WHERE xt_default=?';
        $row = $this->_database->selectRow($query, [1]);
        if ($row) {
            $group = (int)$row['xt_id'];
        }

        // Insert into database table "application_users".
        $query = 'INSERT INTO application_users (xt_user, xt_user_lower, xt_pass, xt_pass_salt, xt_mail, xt_image, xt_active, xt_sign_in_count, xt_error_count, xt_ip_first, xt_ts_first, xt_ip_last, xt_ts_last, xt_locked, xt_deleted, xt_code, xt_reset, xt_group, xt_data) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        if (!$this->_database->insert($query, [$user, $userLower, $pass, $passSalt, $mail, '', $active, 0, 0, $ip, time(), $ip, time(), 0, 0, $code, 0, $group, ''])) {

            // If is error.
            throw new exception('Create user error');
        }

        // Return.
        return $code;
    }

    /**
     * Create account admin user.
     *
     * @param string $user username.
     * @param string $pass password.
     * @param string $mail address.
     * @return mixed bool or string user unlock code.
     * @throws exception. Error: Create user error.
     */
    protected function createAdmin($user, $pass, $mail)
    {
        // Verify user.
        if (!$this->verifyUser($user)) {
            return false;
        }

        // Verify pass.
        if (!$this->verifyPass($pass)) {
            return false;
        }

        // Verify mail.
        if (!$this->verifyMail($mail)) {
            return false;
        }

        // Prepare parameters
        $passSalt = md5(uniqid());
        $pass = md5(md5($pass) . $passSalt);

        // Get default group.
        $group = 0;
        $query = 'SELECT xt_id FROM admin_groups WHERE xt_default=?';
        $row = $this->_database->selectRow($query, [1]);
        if ($row) {
            $group = (int)$row['xt_id'];
        }

        // Insert into database table "admin_users".
        $query = 'INSERT INTO admin_users (xt_user, xt_pass, xt_pass_salt, xt_mail, xt_active, xt_sign_in_count, xt_error_count, xt_ip_last, xt_ts_last, xt_group) VALUES (?,?,?,?,?,?,?,?,?,?)';
        if (!$this->_database->insert($query, [$user, $pass, $passSalt, $mail, 1, 0, 0, '', time(), $group])) {

            // If is error.
            throw new exception('Create user error');
        }

        // Return.
        return true;
    }

    /**
     * Verify account only application user.
     *
     * @param string $code account verify code.
     * @return bool.
     */
    public function verify($code)
    {
        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_code=?';
        $row = $this->_database->selectRow($query, [$code]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_code=? WHERE xt_code=?';
        return $this->_database->update($query, ['', $code]);
    }

    /**
     * Verify group.
     *
     * @param int $groupId user ID.
     * @return bool.
     */
    public function verifyGroup($groupId)
    {
        // If group ID is 0.
        if ($groupId === 0) {
            return true;
        }

        // If is application user account.
        if (!$this->admin) {
            return $this->verifyGroupApplication($groupId);
        }

        // If is admin user account.
        else {
            return $this->verifyGroupAdmin($groupId);
        }
    }

    /**
     * Verify group application.
     *
     * @param int $groupId group ID.
     * @return bool.
     */
    protected function verifyGroupApplication($groupId)
    {
        // Select from database table "application_groups".
        $query = 'SELECT xt_name FROM application_groups WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$groupId]);
        if ($row) {
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Verify group admin section.
     *
     * @param int $groupId group ID.
     * @return bool.
     */
    protected function verifyGroupAdmin($groupId)
    {
        // Select from database table "admin_groups".
        $query = 'SELECT xt_name FROM admin_groups WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$groupId]);
        if ($row) {
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Update group.
     *
     * @param string $id user id.
     * @param string $groupId group ID.
     * @return bool.
     */
    public function updateGroup($id, $groupId)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->updateGroupApplication($id, $groupId);
        }

        // If is admin user account.
        else {
            return $this->updateGroupAdmin($id, $groupId);
        }
    }

    /**
     * Update group application.
     *
     * @param string $id user id.
     * @param string $groupId group ID.
     * @return bool.
     */
    protected function updateGroupApplication($id, $groupId)
    {
        // Verify group.
        if ($groupId !== 0) {
            if (!$this->verifyGroup($groupId)) {
                return false;
            }
        }

        // Update database table "application_user".
        $query = 'UPDATE application_users SET xt_group=? WHERE xt_id=?';
        return $this->_database->update($query, [$groupId, $id]);
    }

    /**
     * Update group admin section.
     *
     * @param string $id user id.
     * @param string $groupId group ID.
     * @return bool.
     */
    protected function updateGroupAdmin($id, $groupId)
    {
        // Verify group.
        if ($groupId !== 0) {
            if (!$this->verifyGroup($groupId)) {
                return false;
            }
        }

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_group=? WHERE xt_id=?';
        return $this->_database->update($query, [$groupId, $id]);
    }

    /**
     * Verify image.
     *
     * @param string $file image upload file $_FILES['form_file_name'].
     * @return bool.
     */
    public function verifyImage($file)
    {
        // If file not exists.
        if (!$file) {
            return false;
        }
        if (!isset($_FILES)) {
            return false;
        }
        if (!isset($_FILES[$file])) {
            return false;
        }

        // Verify image data.
        if (!$_FILES[$file]['name'] || !$_FILES[$file]['type'] || !$_FILES[$file]['tmp_name'] || !$_FILES[$file]['size'] || $_FILES[$file]['error']) {
            return false;
        }

        // Verify image type.
        if (!$this->verifyImageType($file)) {
            return false;
        }

        // Verify image size.
        if (!$this->verifyImageSize($file)) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify image type.
     *
     * @param string $file image upload $_FILES['form_file_name'].
     * @return bool.
     */
    public function verifyImageType($file)
    {
        // Verify image type.
        if ($_FILES[$file]['type'] === 'image/jpeg') {
            return true;
        }
        if ($_FILES[$file]['type'] === 'image/png') {
            return true;
        }
        if ($_FILES[$file]['type'] === 'image/gif') {
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Verify image size.
     *
     * @param string $file image upload $_FILES['form_file_name'].
     * @return bool.
     */
    public function verifyImageSize($file)
    {
        // Verify image size.
        if ($_FILES[$file]['size'] > 2000000) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Update image.
     *
     * @param string $id user id.
     * @param string $file image upload file $_FILES['form_file_name'].
     * @return bool.
     */
    public function updateImage($id, $file)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->updateImageApplication($id, $file);
        }

        // If is admin user account.
        else {
            return $this->updateImageAdmin($id, $file);
        }
    }

    /**
     * Update image application.
     *
     * @param string $id user id.
     * @param string $file image upload file $_FILES['form_file_name'].
     * @return bool.
     */
    protected function updateImageApplication($id, $file)
    {
        // Verify image.
        if (!$this->verifyImage($file)) {
            return false;
        }

        // Verify image.
        if (!$this->verifyImage($file)) {
            return false;
        }

        // Select from database table "application_users".
        $query = 'SELECT xt_image FROM application_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);
        if (!$row) {
            return false;
        }

        // Create directories.
        if (!is_dir('out/img')) {
            mkdir('out/img');
        }
        if (!is_dir('out/img/appnetos')) {
            mkdir('out/img/appnetos');
        }
        if (!is_dir('out/img/appnetos/users')) {
            mkdir('out/img/appnetos/users');
        }
        if (!is_dir('out/img/appnetos/users/100')) {
            mkdir('out/img/appnetos/users/100');
        }
        if (!is_dir('out/img/appnetos/users/200')) {
            mkdir('out/img/appnetos/users/200');
        }
        if (!is_dir('out/img/appnetos/users/300')) {
            mkdir('out/img/appnetos/users/300');
        }
        if (!is_dir('out/img/appnetos/users/400')) {
            mkdir('out/img/appnetos/users/400');
        }

        // Delete images.
        if ($row['xt_image']) {
            if (file_exists('out/img/appnetos/users/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/' . $row['xt_image']);
            }
            if (file_exists('out/img/appnetos/users/100/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/100/' . $row['xt_image']);
            }
            if (file_exists('out/img/appnetos/users/200/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/200/' . $row['xt_image']);
            }
            if (file_exists('out/img/appnetos/users/300/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/300/' . $row['xt_image']);
            }
            if (file_exists('out/img/appnetos/users/400/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/400/' . $row['xt_image']);
            }
        }

        // Get image type.
        $type = null;
        switch($_FILES[$file]["type"]) {
            case 'image/jpeg' : case 'image/jpg':
            $type = 'jpg';
            break;
            case 'image/png' :
                $type = 'png';
                break;
            case 'image/gif' :
                $type = 'gif';
                break;
        }

        // Set image name.
        $name = md5(microtime()) . '.' . $type;

        // Resize images to square images and save.
        $this->resizeImage($file, 'out/img/appnetos/users/', $name, 500);
        $this->resizeImage($file, 'out/img/appnetos/users/100/', $name, 100);
        $this->resizeImage($file, 'out/img/appnetos/users/200/', $name, 200);
        $this->resizeImage($file, 'out/img/appnetos/users/300/', $name, 300);
        $this->resizeImage($file, 'out/img/appnetos/users/400/', $name, 400);

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_image=? WHERE xt_id=?';
        return $this->_database->update($query, [$name, $id]);
    }

    /**
     * Update image admin section.
     *
     * @param string $id user id.
     * @param string $file image upload file $_FILES['form_file_name'].
     * @return bool.
     */
    protected function updateImageAdmin($id, $file)
    {
        // Verify image.
        if (!$this->verifyImage($file)) {
            return false;
        }

        // Verify image.
        if (!$this->verifyImage($file)) {
            return false;
        }

        // Select from database table "admin_users".
        $query = 'SELECT xt_image FROM admin_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);
        if (!$row) {
            return false;
        }

        // Create directories.
        if (!is_dir('out/admin/img/appnetos/users')) {
            mkdir('out/admin/img/appnetos/users');
        }
        if (!is_dir('out/admin/img/appnetos/users/100')) {
            mkdir('out/admin/img/appnetos/users/100');
        }
        if (!is_dir('out/admin/img/appnetos/users/200')) {
            mkdir('out/admin/img/appnetos/users/200');
        }
        if (!is_dir('out/admin/img/appnetos/users/300')) {
            mkdir('out/admin/img/appnetos/users/300');
        }
        if (!is_dir('out/admin/img/appnetos/users/400')) {
            mkdir('out/admin/img/appnetos/users/400');
        }

        // Delete images.
        if ($row['xt_image']) {
            if (file_exists('out/admin/img/appnetos/users/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/' . $row['xt_image']);
            }
            if (file_exists('out/admin/img/appnetos/users/100/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/100/' . $row['xt_image']);
            }
            if (file_exists('out/admin/img/appnetos/users/200/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/200/' . $row['xt_image']);
            }
            if (file_exists('out/admin/img/appnetos/users/300/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/300/' . $row['xt_image']);
            }
            if (file_exists('out/admin/img/appnetos/users/400/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/400/' . $row['xt_image']);
            }
        }

        // Get image type.
        $type = null;
        switch($_FILES[$file]["type"]) {
            case 'image/jpeg' : case 'image/jpg':
            $type = 'jpg';
            break;
            case 'image/png' :
                $type = 'png';
                break;
            case 'image/gif' :
                $type = 'gif';
                break;
        }

        // Set image name.
        $name = md5(microtime()) . '.' . $type;

        // Resize images to square images and save.
        $this->resizeImage($file, 'out/admin/img/appnetos/users/', $name, 500);
        $this->resizeImage($file, 'out/admin/img/appnetos/users/100/', $name, 100);
        $this->resizeImage($file, 'out/admin/img/appnetos/users/200/', $name, 200);
        $this->resizeImage($file, 'out/admin/img/appnetos/users/300/', $name, 300);
        $this->resizeImage($file, 'out/admin/img/appnetos/users/400/', $name, 400);

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_image=? WHERE xt_id=?';
        return $this->_database->update($query, [$name, $id]);
    }

    /**
     * Delete image.
     *
     * @param string $id user id.
     * @return bool.
     */
    public function deleteImage($id)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->deleteImageApplication($id);
        }

        // If is admin user account.
        else {
            return $this->deleteImageAdmin($id);
        }
    }

    /**
     * Delete image application.
     *
     * @param string $id user id.
     * @return bool.
     */
    protected function deleteImageApplication($id)
    {
        // Select from database table "application_users".
        $query = 'SELECT xt_image FROM application_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);
        if (!$row) {
            return false;
        }

        // Delete images.
        if ($row['xt_image']) {
            if (file_exists('out/img/appnetos/users/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/' . $row['xt_image']);
            }
            if (file_exists('out/img/appnetos/users/100/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/100/' . $row['xt_image']);
            }
            if (file_exists('out/img/appnetos/users/200/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/200/' . $row['xt_image']);
            }
            if (file_exists('out/img/appnetos/users/300/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/300/' . $row['xt_image']);
            }
            if (file_exists('out/img/appnetos/users/400/' . $row['xt_image'])) {
                unlink('out/img/appnetos/users/400/' . $row['xt_image']);
            }
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_image=? WHERE xt_id=?';
        return $this->_database->update($query, ['', $id]);
    }

    /**
     * Delete image admin section.
     *
     * @param string $id user id.
     * @return bool.
     */
    protected function deleteImageAdmin($id)
    {
        // Select from database table "admin_users".
        $query = 'SELECT xt_image FROM admin_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);
        if (!$row) {
            return false;
        }

        // Delete images.
        if ($row['xt_image']) {
            if (file_exists('out/admin/img/appnetos/users/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/' . $row['xt_image']);
            }
            if (file_exists('out/admin/img/appnetos/users/100/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/100/' . $row['xt_image']);
            }
            if (file_exists('out/admin/img/appnetos/users/200/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/200/' . $row['xt_image']);
            }
            if (file_exists('out/admin/img/appnetos/users/300/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/300/' . $row['xt_image']);
            }
            if (file_exists('out/admin/img/appnetos/users/400/' . $row['xt_image'])) {
                unlink('out/admin/img/appnetos/users/400/' . $row['xt_image']);
            }
        }

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_image=? WHERE xt_id=?';
        return $this->_database->update($query, ['', $id]);
    }

    /**
     * Activate account.
     *
     * @param int $id user ID.
     * @return bool.
     */
    public function activate($id)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->activateApplication($id);
        }

        // If is admin user account.
        else {
            return $this->activateAdmin($id);
        }
    }

    /**
     * Activate account application user.
     *
     * @param int $id user ID.
     * @return bool.
     */
    protected function activateApplication($id)
    {
        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_active=?, xt_error_count=?, xt_locked=?, xt_code=? WHERE xt_id=?';
        return $this->_database->update($query, [1, 0, 0, '', $id]);
    }

    /**
     * Activate account admin user.
     *
     * @param int $id user ID.
     * @return bool.
     */
    protected function activateAdmin($id)
    {
        // Select from database table "admin_users".
        $query = 'SELECT xt_id FROM admin_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_active=?, xt_error_count=? WHERE xt_id=?';
        return $this->_database->update($query, [1, 0, $id]);
    }

    /**
     * Lock account.
     *
     * @param int $id user ID.
     * @return bool.
     */
    public function lock($id)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->lockApplication($id);
        }

        // If is admin user account.
        else {
            return $this->lockAdmin($id);
        }
    }

    /**
     * Lock account application user.
     *
     * @param int $id user ID.
     * @return bool.
     * @throws.
     */
    protected function lockApplication($id)
    {
        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_active=?, xt_locked=? WHERE xt_id=?';
        return $this->_database->update($query, [0, 1, $id]);
    }

    /**
     * Lock account admin user.
     *
     * @param int $id user ID.
     * @return bool.
     * @throws.
     */
    protected function lockAdmin($id)
    {
        // Select from database table "admin_users".
        $query = 'SELECT xt_id FROM admin_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // If is own account.
        $user = objects::get('user');
        if ($user->getId() === (int)$id) {
            return false;
        }

        // If is only one active admin account exists.
        $query = 'SELECT COUNT(*) FROM admin_users WHERE xt_active=?';
        $count = $this->_database->count($query, [1]);
        if ((int)$count === 1) {
            return false;
        }

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_active=? WHERE xt_id=?';
        return $this->_database->update($query, [0, $id]);
    }

    /**
     * Delete account.
     *
     * @param string $id user ID.
     * @return bool.
     */
    public function delete($id)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->deleteApplication($id);
        }

        // If is admin user account.
        else {
            return $this->deleteAdmin($id);
        }
    }

    /**
     * Delete account application user.
     *
     * @param string $id user ID.
     * @return bool.
     */
    protected function deleteApplication($id)
    {
        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_active=?, xt_deleted=? WHERE xt_id=?';
        return $this->_database->update($query, [0, 1, $id]);
    }

    /**
     * Delete account admin user.
     *
     * @param string $id user ID.
     * @return bool.
     * @throws.
     */
    protected function deleteAdmin($id)
    {
        // If is own account.
        $user = objects::get('user');
        if ($user->getId() === (int)$id) {
            return false;
        }

        // Select from database table "admin_users".
        $query = 'SELECT xt_id FROM admin_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If user not exists.
        if (!$row) {
            return false;
        }

        // If is only one admin account exists.
        $query = 'SELECT COUNT(*) FROM admin_users';
        $count = $this->_database->count($query, [1]);
        if ((int)$count === 1) {
            return false;
        }

        // Update database table "admin_users".
        $query = 'DELETE FROM admin_users WHERE xt_id=?';
        return $this->_database->delete($query, [$id]);
    }

    /**
     * Restore account only application user.
     *
     * @param string $id user ID.
     * @return bool.
     */
    public function restore($id)
    {
        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_deleted=? WHERE xt_id=?';
        return $this->_database->update($query, [0, $id]);
    }

    /**
     * Update username.
     *
     * @param string $id user id.
     * @param string $user username.
     * @return bool.
     */
    public function updateUser($id, $user)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->updateUserApplication($id, $user);
        }

        // If is admin user account.
        else {
            return $this->updateUserAdmin($id, $user);
        }
    }

    /**
     * Update username application user.
     *
     * @param string $id user id.
     * @param string $user username.
     * @return bool.
     */
    protected function updateUserApplication($id, $user)
    {
        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Verify user.
        if (!$this->verifyUser($user)) {
            return false;
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_user=?, xt_user_lower=? WHERE xt_id=?';
        return $this->_database->update($query, [$user, mb_strtolower($user), $id]);
    }

    /**
     * Update username admin user.
     *
     * @param string $id user id.
     * @param string $user username.
     * @return bool.
     */
    protected function updateUserAdmin($id, $user)
    {
        // Select from database table "admin_users".
        $query = 'SELECT xt_id FROM admin_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Verify user.
        if (!$this->verifyUser($user)) {
            return false;
        }

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_user=? WHERE xt_id=?';
        return $this->_database->update($query, [$user, $id]);
    }

    /**
     * Update mail address.
     *
     * @param string $id user id.
     * @param string $mail username.
     * @return bool.
     */
    public function updateMail($id, $mail)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->updateMailApplication($id, $mail);
        }

        // If is admin user account.
        else {
            return $this->updateMailAdmin($id, $mail);
        }
    }

    /**
     * Update mail address application user.
     *
     * @param string $id user id.
     * @param string $mail username.
     * @return bool.
     */
    protected function updateMailApplication($id, $mail)
    {
        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Verify mail.
        if (!$this->verifyMail($mail)) {
            return false;
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_mail=? WHERE xt_id=?';
        return $this->_database->update($query, [$mail, $id]);
    }

    /**
     * Update mail address admin user.
     *
     * @param string $id user id.
     * @param string $mail username.
     * @return bool.
     */
    protected function updateMailAdmin($id, $mail)
    {
        // Select from database table "admin_users".
        $query = 'SELECT xt_id FROM admin_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Verify mail.
        if (!$this->verifyMail($mail)) {
            return false;
        }

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_mail=? WHERE xt_id=?';
        return $this->_database->update($query, [$mail, $id]);
    }

    /**
     * Update password.
     *
     * @param string $id user id.
     * @param string $pass password.
     * @return bool.
     */
    public function updatePass($id, $pass)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->updatePassApplication($id, $pass);
        }

        // If is admin user account.
        else {
            return $this->updatePassAdmin($id, $pass);
        }
    }

    /**
     * Update password application user.
     *
     * @param string $id user id.
     * @param string $pass password.
     * @return bool.
     */
    protected function updatePassApplication($id, $pass)
    {
        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Verify pass.
        if (!$this->verifyPass($pass)) {
            return false;
        }

        // Prepare parameters.
        $passSalt = md5(uniqid());
        $pass = md5(md5($pass) . $passSalt);

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_pass=?, xt_pass_salt=? WHERE xt_id=?';
        return $this->_database->update($query, [$pass, $passSalt, $id]);
    }

    /**
     * Update password admin user.
     *
     * @param string $id user id.
     * @param string $pass password.
     * @return bool.
     */
    protected function updatePassAdmin($id, $pass)
    {
        // Select from database table "admin_users".
        $query = 'SELECT xt_id FROM admin_users WHERE xt_id=?';
        $row = $this->_database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            return false;
        }

        // Verify pass.
        if (!$this->verifyPass($pass)) {
            return false;
        }

        // Prepare parameters.
        $passSalt = md5(uniqid());
        $pass = md5(md5($pass) . $passSalt);

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_pass=?, xt_pass_salt=? WHERE xt_id=?';
        return $this->_database->update($query, [$pass, $passSalt, $id]);
    }

    /**
     * Verify username.
     *
     * @param string $user username.
     * @return bool.
     */
    public function verifyUser($user)
    {
        // Verify username entered.
        if (!$this->verifyUserEntered($user)) {
            return false;
        }

        // Verify username regular expression valid.
        if (!$this->verifyUserValid($user)) {
            return false;
        }

        // Verify username exists.
        if (!$this->verifyUserExists($user)) {
            return false;
        }

        // Verify username not in not usable user names.
        if (!$this->verifyUserUsable($user)) {
            return false;
        }

        // Return
        return true;
    }

    /**
     * Verify username entered.
     *
     * @param string $user username.
     * @return bool.
     */
    public function verifyUserEntered($user)
    {
        // Prepare parameters.
        $user = trim($user);

        // Verify username entered.
        if ($user === '') {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify user regular expression valid.
     *
     * @param string $user username.
     * @return bool.
     */
    public function verifyUserValid($user)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->verifyUserValidApplication($user);
        }

        // If is admin user account.
        else {
            return $this->verifyUserValidAdmin($user);
        }
    }

    /**
     * Verify user regular expression valid application user.
     *
     * @param string $user username.
     * @return bool.
     */
    protected function verifyUserValidApplication($user)
    {
        // If minimal username verify.
        if ($this->minUserVerify) {
            return true;
        }

        // Prepare parameters.
        $user = trim($user);

        // Verify username regular expression valid.
        foreach ($this->_userRegexApplication as $userRegex) {
            if (!preg_match($userRegex, $user)) {
                return false;
            }
        }

        // Return.
        return true;
    }

    /**
     * Verify user regular expression valid admin user.
     *
     * @param string $user username.
     * @return bool.
     */
    protected function verifyUserValidAdmin($user)
    {
        // If minimal username verify.
        if ($this->minUserVerify) {
            return true;
        }

        // Prepare parameters.
        $user = trim($user);

        // Verify username regular expression valid.
        foreach ($this->_userRegexAdmin as $userRegex) {
            if (!preg_match($userRegex, $user)) {
                return false;
            }
        }

        // Return.
        return true;
    }

    /**
     * Verify username exists.
     *
     * @param string $user username.
     * @return bool.
     */
    public function verifyUserExists($user)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->verifyUserExistsApplication($user);
        }

        // If is admin user account.
        else {
            return $this->verifyUserExistsAdmin($user);
        }
    }

    /**
     * Verify username exists application user.
     *
     * @param string $user username.
     * @return bool.
     */
    protected function verifyUserExistsApplication($user)
    {
        // Prepare parameters.
        $user = trim($user);

        // Select from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_user_lower=? OR xt_mail=?';
        $row = $this->_database->selectRow($query, [$user, mb_strtolower($user)]);
        if ($row) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify username exists admin user.
     *
     * @param string $user username.
     * @return bool.
     */
    protected function verifyUserExistsAdmin($user)
    {
        // Prepare parameters.
        $user = trim($user);

        // Select from database table "admin_users".
        $query = 'SELECT xt_id FROM admin_users WHERE xt_user=?';
        $row = $this->_database->selectRow($query, [$user]);
        if ($row) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify username not in not usable user names.
     *
     * @param string $user username.
     * @return bool.
     */
    public function verifyUserUsable($user)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->verifyUserUsableApplication($user);
        }

        // If is admin user account.
        else {
            return $this->verifyUserUsableAdmin($user);
        }
    }

    /**
     * Verify username not in not usable user names application user.
     *
     * @param string $user username.
     * @return bool.
     */
    protected function verifyUserUsableApplication($user)
    {
        // If minimal username verify.
        if ($this->minUserVerify) {
            return true;
        }

        // Prepare parameters.
        $user = trim($user);

        // Get list of no usable user names.
        if (!count($this->noUsableUserApplication)) {
            if (file_exists('application/components/nousableuser.php')) {
                include_once('application/components/nousableuser.php');
            }
            else {
                return true;
            }
        }

        // Set all users names in array to lower.
        for ($i = 0; $i < count($this->noUsableUserApplication); $i++) {
            $this->noUsableUserApplication[$i] = mb_strtolower($this->noUsableUserApplication[$i]);
        }

        // Check if user name in list with no usable user names.
        if (in_array(mb_strtolower($user), $this->noUsableUserApplication)) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify username not in not usable user names admin user.
     *
     * @param string $user username.
     * @return bool.
     */
    protected function verifyUserUsableAdmin($user)
    {
        // Return.
        return true;
    }

    /**
     * Verify password.
     *
     * @param string $pass password.
     * @return bool.
     */
    public function verifyPass($pass)
    {
        // Verify password entered.
        if (!$this->verifyPassEntered($pass)) {
            return false;
        }

        // Verify password regular expression valid.
        if (!$this->verifyPassValid($pass)) {
            return false;
        }

        // Verify password not in not usable passwords.
        if (!$this->verifyPassUsable($pass)) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify password entered.
     *
     * @param string $pass password.
     * @return bool.
     */
    public function verifyPassEntered($pass)
    {
        // Prepare parameters.
        $pass = trim($pass);

        // Verify password entered.
        if ($pass === "") {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify password regular expression valid.
     *
     * @param string $pass password.
     * @return bool.
     */
    public function verifyPassValid($pass)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->verifyPassValidApplication($pass);
        }

        // If is admin user account.
        else {
            return $this->verifyPassValidAdmin($pass);
        }
    }

    /**
     * Verify password regular expression valid application user.
     *
     * @param string $pass password.
     * @return bool.
     */
    protected function verifyPassValidApplication($pass)
    {
        // If minimal pass verify.
        if ($this->minPassVerify) {
            return true;
        }

        // Prepare parameters.
        $pass = trim($pass);

        // Verify password regular expression valid.
        foreach ($this->_passRegexApplication as $passRegex) {
            if (!preg_match($passRegex, $pass)) {
                return false;
            }
        }

        // Return.
        return true;
    }

    /**
     * Verify password regular expression valid admin user.
     *
     * @param string $pass password.
     * @return bool.
     */
    protected function verifyPassValidAdmin($pass)
    {
        // If minimal pass verify.
        if ($this->minPassVerify) {
            return true;
        }

        // Prepare parameters.
        $pass = trim($pass);

        // Verify password regular expression valid.
        foreach ($this->_passRegexAdmin as $passRegex) {
            if (!preg_match($passRegex, $pass)) {
                return false;
            }
        }

        // Return.
        return true;
    }

    /**
     * Verify password not in not usable passwords.
     *
     * @param string $pass password.
     * @return bool.
     */
    public function verifyPassUsable($pass)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->verifyPassUsableApplication($pass);
        }

        // If is admin user account.
        else {
            return $this->verifyPassUsableAdmin($pass);
        }
    }

    /**
     * Verify password not in not usable passwords application user.
     *
     * @param string $pass password.
     * @return bool.
     */
    protected function verifyPassUsableApplication($pass)
    {
        // If minimal pass verify.
        if ($this->minPassVerify) {
            return true;
        }

        // Prepare parameters.
        $pass = trim($pass);

        // Get list of no usable passwords.
        if (!count($this->noUsablePassApplication)) {
            if (file_exists('application/components/nousablepass.php')) {
                include_once('application/components/nousablepass.php');
            }
            else {
                return true;
            }
        }

        // Set all users names in array to lower.
        for ($i = 0; $i < count($this->noUsablePassApplication); $i++) {
            $this->noUsablePassApplication[$i] = mb_strtolower($this->noUsablePassApplication[$i]);
        }

        // Check if password in list with no usable passwords.
        if (in_array($pass, $this->noUsablePassApplication)) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify password not in not usable passwords admin user.
     *
     * @param string $pass password.
     * @return bool.
     */
    protected function verifyPassUsableAdmin($pass)
    {
        // If minimal pass verify.
        if ($this->minPassVerify) {
            return true;
        }

        // Prepare parameters.
        $pass = trim($pass);

        // Get list of no usable passwords.
        if (!count($this->noUsablePassAdmin)) {
            if (file_exists('admin/components/nousablepass.php')) {
                include_once('admin/components/nousablepass.php');
            }
            else {
                return true;
            }
        }

        // Set all users names in array to lower.
        for ($i = 0; $i < count($this->noUsablePassAdmin); $i++) {
            $this->noUsablePassAdmin[$i] = mb_strtolower($this->noUsablePassAdmin[$i]);
        }

        // Check if password in list with no usable passwords.
        if (in_array($pass, $this->noUsablePassAdmin)) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify mail address.
     *
     * @param string $mail mail address.
     * @return bool.
     */
    public function verifyMail($mail)
    {
        // Verify mail address entered.
        if (!$this->verifyMailEntered($mail)) {
            return false;
        }

        // Verify mail address syntax valid.
        if (!$this->verifyMailValid($mail)) {
            return false;
        }

        // Verify mail address exists.
        if (!$this->verifyMailExists($mail)) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify mail address entered.
     *
     * @param string $mail mail address.
     * @return bool.
     */
    public function verifyMailEntered($mail)
    {
        // Prepare parameters.
        $mail = trim($mail);

        // Verify mail entered.
        if ($mail === '') {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify mail address valid.
     *
     * @param string $mail mail address.
     * @return bool.
     */
    public function verifyMailValid($mail)
    {
        // If minimal mail verify.
        if ($this->minMailVerify) {
            return true;
        }

        // Verify mail address syntax valid.
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify mail address exists.
     *
     * @param string $mail mail address.
     * @return bool.
     */
    public function verifyMailExists($mail)
    {
        // If is application user account.
        if (!$this->admin) {
            return $this->verifyMailExistsApplication($mail);
        }

        // If is admin user account.
        else {
            return $this->verifyMailExistsAdmin($mail);
        }
    }

    /**
     * Verify mail address exists application user.
     *
     * @param string $mail mail address.
     * @return bool.
     */
    protected function verifyMailExistsApplication($mail)
    {
        // Prepare parameters.
        $mail = trim($mail);

        // Get data from database table "application_users".
        $query = 'SELECT xt_id FROM application_users WHERE xt_user_lower=? OR xt_mail=?';
        $row = $this->_database->selectRow($query, [mb_strtolower($mail), $mail]);

        if ($row) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Verify mail address exists admin user.
     *
     * @param string $mail mail address.
     * @return bool.
     */
    protected function verifyMailExistsAdmin($mail)
    {
        // Prepare parameters.
        $mail = trim($mail);

        // Get data from database table "admin_users".
        $query = 'SELECT xt_id FROM admin_users WHERE xt_mail=?';
        $row = $this->_database->selectRow($query, [$mail]);

        if ($row) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Get current IP.
     *
     * @return string.
     */
    protected function getIp()
    {
        // If REMOTE_ADDR is set.
        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if ($ip) {
            return $ip;
        }

        // If REMOTE_ADDR not is set.
        return 'unknown';
    }

    /**
     * Set min user verify.
     *
     * @param bool $bool.
     * @return bool.
     */
    public function setMinUserVerify($bool)
    {
        if (gettype($this->minUserVerify) === gettype($bool)) {
            $this->minUserVerify = $bool;
            return true;
        }
        return false;
    }

    /**
     * Set min pass verify.
     *
     * @param bool $minPassVerify.
     * @return bool.
     */
    public function setMinPassVerify($minPassVerify)
    {
        if (gettype($this->minPassVerify) === gettype($minPassVerify)) {
            $this->minPassVerify = $minPassVerify;
            return true;
        }
        return false;
    }

    /**
     * Set force verify.
     *
     * @param bool $forceVerify.
     * @return bool.
     */
    public function setForceVerify($forceVerify)
    {
        if (gettype($this->forceVerify) === gettype($forceVerify)) {
            $this->forceVerify = $forceVerify;
            return true;
        }
        return false;
    }

    /**
     * Set min mail verify.
     *
     * @param bool $minMailVerify.
     * @return bool.
     */
    public function setMinMailVerify($minMailVerify)
    {
        if (gettype($this->minMailVerify) === gettype($minMailVerify)) {
            $this->minMailVerify = $minMailVerify;
            return true;
        }
        return false;
    }

    /**
     * Set password reset code.
     *
     * @param string $mail.
     * @return bool or string reset code.
     */
    public function setResetPassCode($mail)
    {
        $query = 'SELECT xt_id, xt_active, xt_locked, xt_deleted FROM application_users WHERE xt_mail=?';
        $row = $this->_database->selectRow($query, [$mail]);
        if (!$row) {
            return false;
        }
        if (!(bool)$row['xt_active'] || (bool)$row['xt_locked'] || (bool)$row['xt_deleted']) {
            return false;
        }
        $code = md5(uniqid()) . md5(uniqid());
        $time = time();
        $query = 'UPDATE application_users SET xt_reset=?,xt_code=? WHERE xt_id=?';
        $this->_database->update($query, [$time, $code, $row['xt_id']]);
        return $code;
    }

    /**
     * Check password reset code.
     *
     * @param string $code.
     * @return bool.
     */
    public function checkResetPassCode($code)
    {
        $query = 'SELECT xt_active, xt_locked, xt_deleted, xt_reset FROM application_users WHERE xt_code=?';
        $row = $this->_database->selectRow($query, [$code]);
        if (!$row) {
            return false;
        }
        if ((bool)$row['xt_active'] && !(bool)$row['xt_locked'] && !(bool)$row['xt_deleted'] && (int)$row['xt_reset']) {
            $resetTime = $this->_config->getResetPasswordExpire();
            $reset = (int)$row['xt_reset'];
            $time = time();
            if (($resetTime + $reset) < $time) {
                $query = 'UPDATE application_users SET xt_code=?, xt_reset=? WHERE xt_code=?';
                $this->_database->update($query, ['', 0, $code]);
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Check password reset mail.
     *
     * @param string $mail.
     * @param string $code.
     * @return bool.
     */
    public function checkResetPassMail($mail, $code)
    {
        $query = 'SELECT xt_active, xt_locked, xt_deleted, xt_reset FROM application_users WHERE xt_mail=? AND xt_code=?';
        $row = $this->_database->selectRow($query, [$mail, $code]);
        if (!$row) {
            return false;
        }
        return true;
    }

    /**
     * Reset password.
     *
     * @param string $mail.
     * @param string $code.
     * @param string $pass.
     * @return bool.
     */
    public function resetPass($mail, $code, $pass)
    {
        if (!$this->verifyPass($pass)) {
            return false;
        }
        $query = 'SELECT xt_active, xt_locked, xt_deleted, xt_reset FROM application_users WHERE xt_mail=? AND xt_code=?';
        $row = $this->_database->selectRow($query, [$mail, $code]);
        if (!$row) {
            return false;
        }
        if ((bool)$row['xt_active'] && !(bool)$row['xt_locked'] && !(bool)$row['xt_deleted'] && (int)$row['xt_reset']) {
            $resetTime = $this->_config->getResetPasswordExpire();
            $reset = (int)$row['xt_reset'];
            $time = time();
            if (($resetTime + $reset) < $time) {
                $query = 'UPDATE application_users SET xt_code=?, xt_reset=? WHERE xt_code=?';
                $this->_database->update($query, ['', 0, $code]);
                return false;
            }
            $passSalt = md5(uniqid());
            $pass = md5(md5($pass) . $passSalt);
            $query = 'UPDATE application_users SET xt_pass=?, xt_pass_salt=?, xt_reset=?, xt_code=? WHERE xt_mail=? AND xt_code=?';
            if ($this->_database->update($query, [$pass, $passSalt, 0, '', $mail, $code])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Resize images to square images and save.
     *
     * @param array $file image upload file $_FILES['form_file_name'].
     * @param string $path path to save.
     * @param string $name name to save.
     * @param int $size image size in pixels.
     */
    protected function resizeImage($file, $path, $name, $size = 100)
    {
        // Prepare parameters.
        $source = $_FILES[$file]["tmp_name"];
        $target = $path . $name;

        // Create image from source.
        switch($_FILES[$file]["type"]) {
            case 'image/jpeg' : case 'image/jpg':
                $sourceImage = imagecreatefromjpeg($source);
                break;
            case 'image/png' :
                $sourceImage = imagecreatefrompng($source);
                break;
            case 'image/gif' :
                $sourceImage = imagecreatefromgif($source);
                break;
        }

        // Get image size.
        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);

        // Set new size.
        if($sourceHeight > $sourceWidth) {
            $targetHeight = $size;
            $percent = 100.0 / $sourceHeight * $targetHeight;
            $targetWidth = $sourceWidth / 100.0 * $percent;
        }
        elseif ($sourceWidth > $sourceHeight) {
            $targetWidth = $size;
            $percent = 100.0 / $sourceWidth * $targetWidth;
            $targetHeight = $sourceHeight / 100.0 * $percent;
        }
        else {
            $targetHeight = $size;
            $targetWidth = $size;
        }

        // Create new image.
        $targetImage = imagecreatetruecolor($targetWidth , $targetHeight);
        imagecopyresampled($targetImage , $sourceImage , 0, 0, 0, 0, $targetWidth , $targetHeight , $sourceWidth , $sourceHeight);

        // Save image.
        switch($_FILES[$file]["type"]) {
            case 'image/jpeg' : case 'image/jpeg':
                imagejpeg($targetImage , $target);
                break;
            case 'image/png' :
                imagepng($targetImage , $target);
                break;
            case 'image/gif' :
                imagegif($targetImage , $target);
                break;
        }

        // Destroy images.
        imagedestroy($targetImage);
        imagedestroy($sourceImage);
    }
}