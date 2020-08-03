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
 * @description     Admin start page and dashboards.
 */

// Namespace.
namespace admin\dashboard;

// Use.
use \core\objects;

// Model "admin\dashboard\dashboard__board".
class dashboard__board
{

    /**
     * Board UUID.
     *
     * @var string.
     */
    public $uuid = null;

    /**
     * Board name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Apps list.
     *
     * @var array.
     */
    public $appsList = [];

    /**
     * Apps.
     */
    protected $apps = [];

    /**
     * Initialize.
     *
     * return bool.
     */
    public function init()
    {
        // Get apps as model "admin\dashboard\dashboard__edit_board_app".
        $errors = false;
        if (count($this->appsList)) {

            // Get app.
            foreach ($this->appsList as $key => $appId) {
                $editBoardApp = objects::getNew('admin/dashboard/dashboard__edit_board_app');
                $editBoardApp->id = $appId;
                $editBoardApp->init();
                if ($editBoardApp->error) {
                    unset($this->appsList[$key]);
                    $errors = true;
                    continue;
                }
                array_unshift($this->apps, $editBoardApp);
            }

            // Revise.
            $position = (count($this->apps) - 1);
            for ($i = 0; $i < count($this->apps); $i++) {
                if ($i === 0) {
                    $this->apps[$i]->last = true;
                }
                $this->apps[$i]->position = $position;
                if ($i === (count($this->apps) - 1)) {
                    $this->apps[$i]->first = true;
                }
                $position--;
            }
        }

        // Add widgets to model "core\widgets".
        $widgets = objects::getNew('core/widgets');
        $widgets->add($this->appsList);

        return $errors;
    }

    /**
     * Get apps.
     *
     * @return array.
     */
    public function getApps()
    {
        return $this->apps;
    }
}
