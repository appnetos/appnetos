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
 * @description     core/appnetos/statistic.php ->    Statistic class, manage time measurement and view statistics.
 */

// Namespace.
namespace core;

// Class "core\statistic".
class statistic extends base
{

    /**
     * Runtime start.
     *
     * @var int.
     */
    protected $timeStart = null;

    /**
     * statistics constructor.
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
        // Set start time.
        $this->timeStart = (int)MICROTIME__START;
    }

    /**
     * Get build time.
     */
    public function getBuildTime()
    {
        $buildTime = microtime(true) - $this->timeStart;
        return $buildTime;
    }

    /**
     * Destruct by object "core\destruct".
     *
     * @return bool.
     * @echo build time.
     * @throws exception.
     */
    public function destruct()
    {
        // If debugger is not active.
        $config = objects::get('config');
        if (!$config->getDebug()) {
            return false;
        }

        // Echo build time.
        $buildTime = $this->getBuildTime();
        echo 'Build in: ' . $buildTime . ' seconds.';

        // Return.
        return true;
    }
}