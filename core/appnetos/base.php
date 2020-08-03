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
 * @description     core/appnetos/base.php ->    Base class. Contains magic setter and magic getter.
 */

// Namespace.
namespace core;

// Class "core\base".
abstract class base
{

    /**
     * Magic setter.
     *
     * @param string $name variable name.
     * @param mixed $value variable value.
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * Magic getter.
     *
     * @param string $name variable name.
     * @return mixed.
     */
    public function __get($name)
    {
        return $this->{$name};
    }
}