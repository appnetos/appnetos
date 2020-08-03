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

// Model "appnetos\sign_up_form__mail".
class sign_up_form__mail
{

    /**
     * Subject.
     *
     * @var string.
     */
    public $subject = null;

    /**
     * User.
     *
     * @var string.
     */
    public $user = null;

    /**
     * Address.
     *
     * @var string.
     */
    public $address = null;

    /**
     * Link to complete.
     *
     * @var string.
     */
    public $link = null;

    /**
     * Code.
     */
    public $code = null;
}