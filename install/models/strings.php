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
 * @description     install/models/strings.php ->    APPNET OS installer model "installer\strings".
 */

// Namespace.
namespace installer;

// Model "installer\strings".
class strings
{

    /**
     * Strings as array.
     *
     * @var array.
     */
    public $strings = null;

    /**
     * strings constructor.
     */
    public function __construct()
    {
        // Get object languages.
        $languages = objects::get("languages");

        // Prepare parameters.
        $strings = null;

        // Get strings.
        include "strings/" . $languages->active . ".php";

        // Set strings.
        $this->strings = $strings;
    }
}