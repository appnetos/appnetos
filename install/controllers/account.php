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
 * @description     install/controllers/account.php ->    APPNET OS installer controller "installer\account".
 */

// Namespace.
namespace installer;

// Controller "installer\account".
class account
{

    /**
     * Verify password regular expression pattern.
     *
     * @var string.
     */
    public $passRegex = ["/\d/", "/[^a-zA-Z\d]/", "/^(?=.{8,32}$).*/"];

    /**
     * Verify username regular expression pattern.
     *
     * @var string.
     */
    public $userRegex = ["/^(?=.{5,32}$).*/", "/^(?!.*  )/"];

    /**
     * Create account minimal username verify. Only check if username entered and not exists.
     *
     * @var bool.
     */
    public $minUserVerify = false;

    /**
     * Create account minimal password verify. Only check if password is entered.
     *
     * @var bool.
     */
    public $minPassVerify = false;

    /**
     * Create account minimal mail address verify. Only check if mail address is entered and not exists.
     *
     * @var bool.
     */
    public $minMailVerify = false;

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
        if ($user === "") {
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
        // If minimal username verify.
        if ($this->minUserVerify) {
            return true;
        }

        // Prepare parameters.
        $user = trim($user);

        // Verify username regular expression valid.
        foreach ($this->userRegex as $userRegex) {
            if (!preg_match($userRegex, $user)) {
                return false;
            }
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
        // If minimal pass verify.
        if ($this->minPassVerify) {
            return true;
        }

        // Prepare parameters.
        $pass = trim($pass);

        // Verify password regular expression valid.
        foreach ($this->passRegex as $passRegex) {
            if (!preg_match($passRegex, $pass)) {
                return false;
            }
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
        if ($mail === "") {
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
        if ($this->minMailVerify) return true;

        // Verify mail address syntax valid.
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Return.
        return true;
    }
}