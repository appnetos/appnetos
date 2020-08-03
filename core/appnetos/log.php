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
 * @description     core/appnetos/log.php ->    Log class, collects exceptions and errors and warning and write these by
 *                  destruct over object "core\destruct" into into log file. Echo log in debug mode on bottom of
 *                  page.
 */

// Namespace.
namespace core;

// Class "core\log".
class log extends base
{

    /**
     * \stdClass with all logs.
     *
     * @var \stdClass.
     */
    protected $log = null;

    /**
     * Path to log file.
     *
     * @var string.
     */
    protected $_file = null;

    /**
     * Debug from object "core\config".
     *
     * @var bool.
     */
    protected $_debug = false;

    /**
     * log constructor.
     */
    public function __construct()
    {
        // Set log as \stdClass.
        $this->log = new \stdClass();

        // Get data from object "core\config".
        $config = objects::get('config');
        $this->_file = trim($config->getLogDir(), "\\/") . '/log.txt';
        $this->_debug = $config->getDebug();
    }

    /**
     * Add entry to log.
     *
     * @param string $message string of error massage to add.
     * @param string $type string type of log entry.
     * @param string $stacktrace string stacktrace.
     */
    public function add($message, $type = 'Error', $stacktrace = null)
    {
        // Generate log.
        $log = new \stdClass();
        $log->type = $type;
        $log->date = date("Y.m.d H:i:s", time());
        $log->message = $message;
        $log->stacktrace = $stacktrace;

        // Write log to log file.
        $this->write($log);

        // Set log to logs.
        $name = microtime();
        if (!isset($this->log->{$name})) {
            $this->log->{$name} = $log;
            return;
        }

        // If log already exists.
        for ($i = 0; $i === 0; $i = 0) {
            $newName = $name. '-' . $i;
            if (!isset($this->log->{$newName})) {
                $this->log->{$newName} = $log;
                return;
            }
        }
    }

    /**
     * Add error to log.
     *
     * @param string $message string of error massage to add.
     * @param string $stacktrace string stacktrace.
     */
    public function addError($message, $stacktrace = null)
    {
        // Add error to log.
        $this->add($message, 'Error', $stacktrace);
    }

    /**
     * Add warning to log.
     *
     * @param string $message string of error massage to add.
     * @param string $stacktrace string stacktrace.
     */
    public function addWarning($message, $stacktrace = null)
    {
        // Add error to log.
        $this->add($message, 'Warning', $stacktrace);
    }

    /**
     * Write log to log file.
     *
     * @param \stdClass $log.
     */
    protected function write($log)
    {
        // Prepare parameters.
        $logfile = '';

        // Get log file.
        if (file_exists(__DIR__. '/../../' . $this->_file)) {
            $logfile = file_get_contents(__DIR__. '/../../' . $this->_file);
        }

        // Generate entry.
        $buffer = "-->\nType: ". $log->type. "\nDate: " . $log->date . "\nMessage: " . $log->message;
        if (isset($log->stacktrace)) {
            $buffer .= "\nStack trace:\n" . $log->stacktrace;
        }
        $buffer .= "\n<---\n\n\n";
        $logfile = $buffer . $logfile;

        // Generate directories.
        $directories = explode('/log.txt', $this->_file)[0];
        $directories = explode('/', $directories);
        $directory = '';
        foreach ($directories as $value) {
            $directory .= '/' . $value;
            if (!is_dir(__DIR__. '/../..' . $directory)) {
                mkdir(__DIR__. '/../..' . $directory);
            }
        }

        // Set log file.
        file_put_contents(__DIR__. '/../../' . $this->_file, $logfile);
    }

    /**
     * Destruct by object "core\destruct".
     *
     * @return bool.
     * @echo log.
     */
    public function destruct()
    {
        // If no logs exists or debugger is not active.
        if (!count((array)$this->log) || !$this->_debug) {
            return false;
        }

        // Prepare parameters.
        $buffer = "";

        // Generate logs.
        $array = get_object_vars($this->log);
        foreach (array_reverse($array) as $value) {
            $buffer .= "-->\nType: ". $value->type. "\nDate: " . $value->date . "\nMessage: " . $value->message;
            if (isset($value->stacktrace)) {
                $buffer .= "\nStack trace:\n" . $value->stacktrace;
            }
            $buffer .= "\n<---\n\n\n";
        }

        // Echo logs.
        echo nl2br($buffer);
    }
}