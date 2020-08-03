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
 * @description     core/appnetos/authentication.php ->    Authentication class. Checks user authentication token for
 *                  authentication by SESSION or COOKIE and server data.
 */

// Namespace.
namespace core;

// Class "core\authentication".
Class authentication extends base
{

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
     * authentication constructor.
     */
    public function __construct()
    {
        // Get and set used objects.
        $this->_database = objects::get('database');
        $this->_config = objects::get('config');

        // Delete expired authentications.
        $authenticationLifetimeApplication = $this->_config->getAuthenticationLifetimeApplication();
        $query = 'DELETE from application_authentication WHERE xt_ts<?';
        $this->_database->delete($query, [(time() - $authenticationLifetimeApplication)]);
    }

    /**
     * Get credentials by authentication token.
     *
     * @param string $token.
     * @return mixed.
     */
    public function get($token)
    {
        // Get user agent.
        $userAgent = $this->getUserAgent();

        // Select from database table "application_authentication".
        $query = 'SELECT * FROM application_authentication WHERE xt_token=? AND xt_user_agent=?';
        $row = $this->_database->selectRow($query, [$token, $userAgent]);

        // If authentication not exists.
        if (!$row) {
            return false;
        }

        // Return credentials.
        $credentials = [
            'user' => $row['xt_user'],
            'pass' => $row['xt_pass'],
            'mail' => $row['xt_mail']
        ];
        return $credentials;
    }

    /**
     * Set authentication by user ID.
     *
     * @param string $user.
     * @param string $pass.
     * @param string $mail.
     * @return string.
     */
    public function set($user, $pass, $mail)
    {
        // Get user agent.
        $userAgent = $this->getUserAgent();

        // Select from database table "application_authentication".
        $query = 'SELECT * FROM application_authentication WHERE xt_user=? AND xt_pass=? AND xt_mail=? AND xt_user_agent=?';
        $row = $this->_database->selectRow($query, [$user, $pass, $mail, $userAgent]);

        // If authentication exists.
        if ($row) {
            $query = 'UPDATE application_authentication SET xt_ts=? WHERE xt_user=? AND xt_pass=? AND xt_mail=? AND xt_user_agent=?';
            $this->_database->update($query, [time(), $user, $pass, $mail, $userAgent]);
            return $row['xt_token'];
        }

        // Generate token.
        $token = null;
        while (!$token) {
            $token = $this->generateToken();
            $query = 'SELECT xt_token FROM application_authentication WHERE xt_token=?';
            $row = $this->_database->selectRow($query, [$token]);
            if ($row) {
                $token = null;
            }
        }

        // If authentication not exists.
        $query = 'INSERT INTO application_authentication SET xt_token=?, xt_user=?, xt_pass=?, xt_mail=?, xt_user_agent=?, xt_ts=?';
        $this->_database->insert($query, [$token, $user, $pass, $mail, $userAgent, time()]);

        // Return token.
        return $token;
    }

    /**
     * Delete authentication.
     *
     * @param string $token.
     */
    public function delete($token)
    {
        // Delete from database table "application_authentication".
        $query = "DELETE FROM application_authentication WHERE xt_token=?";
        $this->_database->delete($query, [$token]);
    }

    /**
     * Generate token.
     *
     * @return string.
     */
    protected function generateToken()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $token = '';
        for ($i = 0; $i < 64; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }
        return $token;
    }

    /**
     * Get user agent.
     *
     * @return string.
     */
    protected function getUserAgent()
    {
        // Set user agent.
        $userAgent = '';
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
        }

        // Set remote address.
        if (!$userAgent) {
            if (!empty($_SERVER['REMOTE_ADDR'])) {
                $userAgent = $_SERVER['REMOTE_ADDR'];
            }
        }

        // Set remote host.
        if (!$userAgent) {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $userAgent = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $userAgent = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $userAgent = $_SERVER['REMOTE_ADDR'];
            }
            try {
                $hostname = gethostbyaddr($userAgent);
                $userAgent = $hostname;
            }
            catch (\Exception $e) {
                $userAgent = md5($userAgent);
            }
        }

        // Return.
        return $userAgent;
    }
}