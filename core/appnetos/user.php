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
 * @description     core/appnetos/user.php ->    User class. Handle authentication. Contains all user data.
 */

// Namespace.
namespace core;

// Class "core\user".
Class user extends base
{

    /**
     * User ID from database column "xt_id".
     *
     * @var int.
     */
    protected $id = null;

    /**
     * User name from database column "xt_user".
     *
     * @var string.
     */
    protected $user = null;

    /**
     * Password from database column "xt_pass".
     *
     * @var string.
     */
    protected $pass = null;

    /**
     * Pass salt from database column "xt_pass_salt".
     *
     * @var string.
     */
    protected $passSalt = null;

    /**
     * E-Mail address "xt_mail".
     *
     * @var string.
     */
    protected $mail = null;

    /**
     * Image "xt_image".
     *
     * @var string.
     */
    protected $image = null;

    /**
     * Sign in count.
     *
     * @var int.
     */
    protected $signInCount = null;

    /**
     * Is active from database column "xt_active".
     *
     * @var bool.
     */
    protected $active = false;

    /**
     * Is locked from database column "xt_locked".
     *
     * @var bool.
     */
    protected $locked = false;

    /**
     * Sign in error count from database column "xt_error_count".
     *
     * var int.
     */
    protected $errorCount = null;

    /**
     * User group from database column "xt_group".
     *
     * @var int.
     */
    protected $group = null;

    /**
     * Database table user extra data.
     *
     * @var array.
     */
    protected $data = [];

    /**
     * If update extra data.
     *
     * @var bool.
     */
    protected $_updateData = false;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * Used object "core/config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * Used object "core/uri".
     */
    protected $_uri = null;

    /**
     * Used object "core\session".
     *
     * @var object.
     */
    protected $_session = null;

    /**
     * Used object "core\cookie".
     *
     * @var object.
     */
    protected $_cookie = null;

    /**
     * Used object "core\authentication".
     *
     * @var object.
     */
    protected $_authentication = null;

    /**
     * user constructor.
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
        // Get used objects.
        $this->_database = objects::get('core\database');
        $this->_config = objects::get('core\config');
        $this->_uri = objects::get('core\uri');
        $this->_session = objects::get('core\session');
        $this->_cookie = objects::get('core\cookie');
        $this->_authentication = objects::get('core\authentication');

        // Initialize application.
        if (!$this->_uri->getAdmin()) {
            $this->initApplication();
        }

        // Initialize admin section.
        else  {
            $this->initAdmin();
        }
    }

    /**
     * Initialize application.
     */
    protected function initApplication()
    {
        // Get credentials from object "core\session".
        $credentials = $this->_session->get('APPNETOS_CREDENTIALS');
        if ($credentials) {
            if (isset($credentials['user']) && isset($credentials['pass']) && isset($credentials['mail'])) {
                $user = $credentials['user'];
                $pass = $credentials['pass'];
                $mail = $credentials['mail'];
                $this->signInAutoApplication($user, $pass, $mail);
            }
        }

        // If user is active.
        if ($this->active) {
            return true;
        }

        // Get authentication token from object "core\cookie".
        $token = $this->_cookie->get('APPNETOS_AUTH');
        if ($token) {
            $credentials = $this->_authentication->get($token);
            if ($credentials) {
                $user = $credentials['user'];
                $pass = $credentials['pass'];
                $mail = $credentials['mail'];
                $this->signInAutoApplication($user, $pass, $mail);
            }
        }

        // If user is active.
        if ($this->active) {
            return true;
        }

        // Return.
        return false;
    }

    /**
     * SESSION or COOKIE auto sign in application.
     *
     * @param string $user username.
     * @param string $pass password.
     * @param string $mail email.
     * @return bool.
     */
    protected function signInAutoApplication($user, $pass, $mail)
    {
        // Get user data from database table "application_users".
        $query = 'SELECT * FROM application_users WHERE xt_user=? AND xt_mail=?';
        $row = $this->_database->selectRow($query, [$user, $mail]);

        // If user exists.
        if ($row) {
            $this->signInVerifyingApplication($row, $pass, false);
            return true;
        }

        // Sign out.
        $this->signOut();

        // Return false.
        return false;
    }

    /**
     * Verifying user data application.
     *
     * @param array $row mysql select result.
     * @param string $pass password.
     * @param bool $count raise sign in count.
     * @return bool.
     */
    protected function signInVerifyingApplication($row, $pass, $count = false)
    {
        // If sign in data right.
        if ((bool)$row['xt_active'] && !(bool)$row['xt_locked'] && $pass === $row['xt_pass'] && (!$row['xt_code'] || (!$row['xt_code'] && (bool)$row['xt_reset']))) {

            // Set user data in object.
            $this->id = (int)$row['xt_id'];
            $this->user = $row['xt_user'];
            $this->pass = $row['xt_pass'];
            $this->passSalt = $row['xt_pass_salt'];
            $this->mail = $row['xt_mail'];
            $this->image = $row['xt_image'];
            $this->active = (bool)$row['xt_active'];
            $this->signInCount = (int)$row['xt_sign_in_count'];
            $this->group = (int)$row['xt_group'];
            $data = $row['xt_data'];
            if ($data) {
                $this->data = json_decode($data, true);
            }

            // Get and set group data.
            if ($this->group) {
                $query = 'SELECT xt_granted, xt_denied FROM xt_groups WHERE xt_id=?';
                $rowGroup = $this->_database->selectRow($query [$this->group]);
                if (!$rowGroup) {
                    $query = 'SELECT xt_granted, xt_denied FROM xt_groups WHERE xt_default=1';
                    $rowGroup = $this->_database->selectRow($query [$this->group]);
                }
                if ($rowGroup) {
                    $this->granted = array_map('intval', explode(',', $row['xt_granted']));
                    $this->denied = array_map('intval', explode(',', $row['xt_denied']));
                }
            }

            // Generate user data as array.
            $credentials = [];
            $credentials['user'] = $row['xt_user'];
            $credentials['pass'] = $pass;
            $credentials['mail'] = $row['xt_mail'];

            // Set user data in SESSION.
            $this->_session->set('APPNETOS_CREDENTIALS', $credentials);

            // Raise sign in count in database table "application_users".
            if ($count) {
                $this->signInCount++;
                $query = 'UPDATE application_users SET xt_sign_in_count=?, xt_error_count=?, xt_ip_last=?, xt_ts_last=? WHERE xt_id=?';
                $this->_database->update($query, [$this->signInCount, 0, $this->getIp(), time(), $this->id]);
            }

            // Unset code and reset password.
            if ($row['xt_code'] !== '' && (bool)$row['xt_reset']) {
                $query = 'UPDATE application_users SET xt_reset=?, xt_code=? WHERE xt_id=?';
                $this->_database->update($query, [0, '', $this->id]);
            }

            // Return.
            return true;
        }

        // Prepare parameters.
        $id = (int)$row['xt_id'];
        $this->errorCount = (int)$row['xt_error_count'] + 1;
        $this->active = (int)$row['xt_active'];
        $this->locked = (int)$row['xt_locked'];

        // If account is active.
        if ($this->active) {
            if ($this->errorCount > $this->_config->getSignInErrorCount()) {
                $this->active = 0;
            }
        }

        // Update database table "application_users".
        $query = 'UPDATE application_users SET xt_active=?, xt_error_count=?, xt_ip_last=?, xt_ts_last=? WHERE xt_id=?';
        $this->_database->update($query, [$this->active, $this->errorCount, $this->getIp(), time(), $id]);

        // Sign out.
        $this->signOut();

        // Return false.
        return false;
    }

    /**
     * Initialize admin section.
     */
    protected function initAdmin()
    {
        // Get credentials from object "core\session".
        $credentials = $this->_session->get('APPNETOS_ADMIN_CREDENTIALS');
        if ($credentials) {
            $token = $credentials['token'];
            $timestamp = $credentials['timestamp'];
            $mail = $credentials['mail'];
            $pass = $credentials['pass'];
            $this->signInAutoAdmin($token, $timestamp, $mail, $pass);
        }

        // If user is active.
        if ($this->active) {
            return true;
        }

        // Return.
        return false;
    }

    /**
     * SESSION or COOKIE auto sign in admin section.
     *
     * @param string $token Admin auth token.
     * @param int $timestamp Timestamp.
     * @param string $mail Email.
     * @param string $pass Password.
     * @return bool.
     */
    protected function signInAutoAdmin($token, $timestamp, $mail, $pass)
    {
        // Check admin SESSION timeout.
         if (($timestamp + $this->_config->getSessionTimeoutAdmin()) < time()) {
             $this->signOut();
             return false;
         }

        // Compare token.
        $cookieToken = $this->_cookie->get('APPNETOS_ADMIN_AUTH');
        if ($cookieToken !== $token) {
            $this->signOut();
            return false;
        }

        // Get user data from database table "admin_users".
        $query = 'SELECT * FROM admin_users WHERE xt_mail=?';
        $row = $this->_database->selectRow($query, [$mail]);

        // If user exists.
        if ($row) {
            $this->signInVerifyingAdmin($row, $pass, false);
            return true;
        }

        // Sign out.
        $this->signOut();

        // Return false.
        return false;
    }

    /**
     * Verifying user data admin section.
     *
     * @param array $row mysql select result.
     * @param string $pass password.
     * @param bool $count raise sign in count.
     * @return bool.
     */
    protected function signInVerifyingAdmin($row, $pass, $count = false)
    {
        // If sign in data right.
        if ((bool)$row['xt_active'] && $pass === $row['xt_pass']) {

            // Set user data in object.
            $this->id = (int)$row['xt_id'];
            $this->user = $row['xt_user'];
            $this->pass = $row['xt_pass'];
            $this->passSalt = $row['xt_pass_salt'];
            $this->mail = $row['xt_mail'];
            $this->image = $row['xt_image'];
            $this->active = (bool)$row['xt_active'];
            $this->signInCount = (int)$row['xt_sign_in_count'];
            $this->group = (int)$row['xt_group'];

            // Get token.
            $token = $this->_cookie->get('APPNETOS_ADMIN_AUTH');
            if (!$token) {
                $token = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true));
            }

            // Generate user data as array.
            $credentials = [];
            $credentials['token'] = $token;
            $credentials['timestamp'] = time();
            $credentials['mail'] = $row['xt_mail'];
            $credentials['pass'] = $pass;

            // Set user data in SESSION.
            $this->_session->set('APPNETOS_ADMIN_CREDENTIALS', $credentials);
            $this->_cookie->setAdmin('APPNETOS_ADMIN_AUTH', $token, true, (time() + $this->_config->getSessionTimeoutAdmin()));

            // Raise sign in count in database table "admin_users".
            if ($count) {
                $this->signInCount++;
                $query = 'UPDATE admin_users SET xt_sign_in_count=?, xt_error_count=?, xt_ip_last=?, xt_ts_last=? WHERE xt_id=?';
                $this->_database->update($query, [$this->signInCount, 0, $this->getIp(), time(), $this->id]);
            }

            // Return.
            return true;
        }

        // Prepare parameters.
        $id = (int)$row['xt_id'];
        $this->errorCount = (int)$row['xt_error_count'] + 1;
        $this->active = (int)$row['xt_active'];

        // If account is active.
        if ($this->active) {
            if ($this->errorCount > $this->_config->getSignInErrorCount()) {
                $this->active = 0;
            }
        }

        // Update database table "admin_users".
        $query = 'UPDATE admin_users SET xt_active=?, xt_error_count=?, xt_ip_last=?, xt_ts_last=? WHERE xt_id=?';
        $this->_database->update($query, [$this->active, $this->errorCount, $this->getIp(), time(), $id]);

        // Sign out.
        $this->signOut();

        // Return false.
        return false;
    }

    /**
     * Sign in.
     *
     * @param string $user username or email.
     * @param string $pass password.
     * @param bool $stay stay signed in.
     * @return bool.
     */
    public function signIn($user, $pass, $stay = false)
    {
        // sign in application.
        if (!$this->_uri->getAdmin()) {
            return $this->signInApplication($user, $pass, $stay);
        }

        // Initialize admin section.
        else  {
            return $this->signInAdmin($user, $pass);
        }
    }

    /**
     * Sign in application.
     *
     * @param string $user username.
     * @param string $pass password.
     * @param bool $stay stay signed in.
     * @return bool.
     */
    protected function signInApplication($user, $pass, $stay)
    {
        // Sign out.
        $this->signOut();

        // Encrypt pass.
        $pass = md5($pass);

        // Get data from database table "application_users".
        $query = 'SELECT * FROM application_users WHERE xt_mail=? OR xt_user_lower=?';
        $row = $this->_database->selectRow($query, [$user, mb_strtolower($user, mb_detect_encoding($user))]);
        if ($row) {
            $this->signInVerifyingApplication($row, md5($pass . $row['xt_pass_salt']), $stay, true);
        }

        // If user not is signed in.
        if (!$this->active) {
            return false;
        }

        // If user stay signed in.
        if ($stay) {
            $token = $this->_authentication->set($this->user, $this->pass, $this->mail);
            $this->_cookie->setCookie('APPNETOS_AUTH', $token);
        }

        // Return.
        return true;
    }

    /**
     * Sign in admin section.
     *
     * @param string $mail email.
     * @param string $pass password.
     * @return bool.
     */
    protected function signInAdmin($mail, $pass)
    {
        // Sign out.
        $this->signOut();

        // Encrypt pass.
        $pass = md5($pass);

        // Get data from database table "admin_users".
        $query = 'SELECT * FROM admin_users WHERE xt_mail=?';
        if ($row = $this->_database->selectRow($query, [$mail])) {
            $this->signInVerifyingAdmin($row, md5($pass . $row['xt_pass_salt']), true);
        }

        // If user not is signed in.
        if (!$this->active) {
            return false;
        }

        // Return.
        return true;
    }

    /**
     * Sign out.
     *
     * @return bool.
     */
    public function signOut()
    {
        // Sign in application.
        if (!$this->_uri->getAdmin()) {
            return $this->signOutApplication();
        }

        // Sign out admin section.
        else  {
            return $this->signOutAdmin();
        }
    }

    /**
     * Sign out user application.
     */
    protected function signOutApplication()
    {
        // Set user data in class.
        $this->id = null;
        $this->user = null;
        $this->pass = null;
        $this->passSalt = null;
        $this->active = false;
        $this->signInCount = null;
        $this->image = null;

        // Delete user data in SESSION.
        $this->_session->delete('APPNETOS_CREDENTIALS');

        // Delete user data in COOKIE.
        $token = $this->_cookie->get('APPNETOS_AUTH');
        if ($token) {
            $this->_authentication->delete($token);
            $this->_cookie->delete('APPNETOS_AUTH');
        }
    }

    /**
     * Sign out user admin section.
     */
    protected function signOutAdmin()
    {
        // Set user data in class.
        $this->id = null;
        $this->user = null;
        $this->pass = null;
        $this->passSalt = null;
        $this->active = false;
        $this->signInCount = null;
        $this->image = null;

        // Delete admin user data in SESSION.
        $this->_session->delete('APPNETOS_ADMIN_CREDENTIALS');

        // Delete admin user data in COOKIE.
        $this->_cookie->delete('APPNETOS_ADMIN_AUTH');
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
     * Get user ID.
     *
     * @return int.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get user name.
     *
     * @return string.
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get user mail.
     *
     * @return string.
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get user image.
     *
     * @return string.
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get if user is active.
     *
     * @return bool.
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get if user is locked.
     *
     * @return bool.
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Get sign in error count.
     *
     * @return int.
     */
    public function getErrorCount()
    {
        return $this->errorCount;
    }

    /**
     * Get sign in count.
     *
     * @return int.
     */
    public function getSignInCount()
    {
        return $this->signInCount;
    }

    /**
     * Get group.
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Check password.
     *
     * @param string $pass password compare with user password.
     * @return bool.
     */
    public function checkPass($pass)
    {
        // If password is right.
        if (md5(md5($pass) . $this->passSalt) === $this->pass) {
            return true;
        }

        // If password is wrong.
        return false;
    }

    /**
     * Set database user extra data.
     *
     * @param string $key.
     * @param mixed $value.
     * @return mixed.
     */
    public function setData($key, $value = null)
    {
        // If is admin section or user not active.
        if ($this->_uri->getAdmin() || !$this->active) {
            return false;
        }

        // If value is null.
        if ($value === null) {
            return $this->deleteData($key);
        }

        // Set data.
        $this->data[$key] = $value;
        $this->_updateData = true;

        // Return.
        return true;
    }

    /**
     * Get database user extra data.
     *
     * @param string $key.
     * @return object.
     */
    public function getData($key = null)
    {
        // If is admin section or user not active.
        if ($this->_uri->getAdmin() || !$this->active) {
            return false;
        }

        // If key not exists.
        if (!$key) {
            return $this->data;
        }

        // Return data by key.
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        // Return.
        return false;
    }

    /**
     * Delete database user extra data.
     *
     * @param string $key.
     * @return bool.
     */
    public function deleteData($key)
    {
        // If data not exists.
        if (!isset($this->data[$key])) {
            return false;
        }

        // If data exists.
        unset($this->data[$key]);
        $this->_updateData = true;

        // Return.
        return true;
    }

    /**
     * Destruct by object "core/destruct".
     *
     * @return bool.
     */
    public function destruct()
    {
        // If is admin section or user not active or not to update.
        if ($this->_uri->getAdmin() || !$this->active || !$this->_updateData) {
            return false;
        }

        // Update database table "application_users".
        $data = json_encode($this->data);
        $query = 'UPDATE application_users SET xt_data=? WHERE xt_id=?';
        $this->_database->update($query, [$data, $this->id]);

        // Return
        return false;
    }
}