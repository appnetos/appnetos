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

// Model "appnetos\forgotten_password_form__mail".
class forgotten_password_form__mail
{

    /**
     * Name.
     *
     * @var string.
     */
    public $name = '';

    /**
     * Subject.
     *
     * @var string.
     */
    public $subject = null;

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