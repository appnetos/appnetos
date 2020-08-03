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
 * @description     Admin app installer to install or reinstall apps with install events.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\install__apps_list".
class install__apps_list
{

    /**
     * Count.
     *
     * @var int.
     */
    public $count = null;

    /**
     * Areas.
     *
     * @var int.
     */
    public $areas = null;

    /**
     * Start.
     *
     * @var int.
     */
    public $start = null;

    /**
     * End.
     *
     * @var int.
     */
    public $end = null;

    /**
     * List.
     *
     * @var array.
     */
    public $appsList = [];

    /**
     * Directories of apps with installers.
     *
     * @var array.
     */
    protected $directories = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__install__apps_list', $this);

        // Get model "admin\apps\install__search".
        $installSearch = objects::get('admin/apps/install__search');

        // Get all directories of apps with install events.
        $directory = 'application/apps';
        $this->getDirectories($directory);

        // Sort directories by search.
        if ($installSearch->search !== '') {
            $array = [];
            foreach ($this->directories as $directory) {
                if (strpos($directory, $installSearch->search)) {
                    array_push($array, $directory);
                }
            }
            $this->directories = $array;
        }

        // Prepare parameters.
        $this->count = count($this->directories);
        $this->areas = round($this->count / $installSearch->number + 0.49999999999);
        if ($installSearch->area > $this->areas) {
            $installSearch->updateArea(1);
        }
        $this->start = $installSearch->area - 5;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $installSearch->area + 5;
        if ($this->end > $this->areas) {
            $this->end = $this->areas;
        }

        // Get range.
        $index = 0;
        $array = [];
        for ($i = ($installSearch->area * $installSearch->number - $installSearch->number); $index < $installSearch->number && $i < $this->count; $i++) {
            array_push($array, $this->directories[$i]);
            $index++;
        }
        $this->directories = $array;

        // If no directory exists.
        if (!count($this->directories)) {
            return;
        }

        // Get object "admin\apps\install__app".
        objects::get('admin/apps/install__app');

        // Initialize apps.
        foreach ($this->directories as $directory) {
            $installApp = objects::getNew('admin/apps/install__app');
            $installApp->directory = $directory;
            $installApp->init();
            array_push($this->appsList, $installApp);
        }
    }

    /**
     * Get all directories of apps with install events.
     *
     * @param string $directory.
     */
    protected function getDirectories($directory)
    {
        // If directory not exists.
        if (!is_dir($directory)) return;

        // Get all sub directories.
        $directories = glob($directory . '/*', GLOB_ONLYDIR);

        // Go through all directories.
        foreach ($directories as $directory) {

            // If installer exists.
            $arrayDirectory = explode('-', $directory);
            if (count($arrayDirectory) > 1) {
                continue;
            }
            if (file_exists($directory . '/admin/events/install.php')) {

                // Set app as \stdClass.
                $directory = str_replace('application/apps/' , '', $directory);
                array_push($this->directories, $directory);
            }

            // Recursively get all directories of apps with install events of sub directories.
            $this->getDirectories($directory);
        }
    }
}