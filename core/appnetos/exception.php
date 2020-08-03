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
 * @description     core/appnetos/exception.php ->    APPNET OS exception handler. Get debug settings from object
 *                  "core\config" and throws exceptions or write it to error log.
 */

// Namespace.
namespace core;

// Use.
 use Throwable;

// Class "core\exception" extends "\Exception".
class exception extends \Exception
{

    /**
     * exception constructor.
     *
     * @param string $message.
     * @param int $code.
     * @param Throwable null $previous.
     * @throws exception.
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        // Set message.
        if ($message !== '') {
            $this->message = $message;
        }

        // Write error to log.
        $log = objects::get('log');
        $log->addError($message, $this->getTraceAsString());
        $log->destruct();
    }
}