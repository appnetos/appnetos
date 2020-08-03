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
 * @description     core/appnetos/container.php ->    Container class. Contains all used container apps as array of
 *                  object "core\app". Render container by view "core/views/container.tpl".
 */

// Namespace.
namespace core;

// Class "core\container".
class container extends base
{

    /**
     * Container ID build by added objects "core\app".
     *
     * @var string.
     */
    protected $id = '';

    /**
     * Container app IDs from added objects "core\app.
     *
     * @var array.
     */
    protected $appId = [];

    /**
     * Container views from added objects "core\app".
     *
     * @var array.
     */
    protected $views = [];

    /**
     * Container grid from added objects "core\app".
     *
     * @var array.
     */
    protected $grid = [];

    /**
     * Container CSS from added objects "core\app".
     *
     * @var string.
     */
    protected $containerCss = '';

    /**
     * Container fluid CSS from added objects "core\app".
     *
     * @var string.
     */
    protected $containerFluidCss = '';

    /**
     * Add app to container.
     *
     * @param $app object "core\app".
     */
    public function add($app)
    {
        // Add data to container.
        $appId = $app->getId();
        array_push($this->appId, $appId);
        $this->id .= "-" . $appId;
        array_push($this->views, $app->getView() . "\n");
        array_push($this->grid, $app->getContainerGrid());
        if ($app->getContainerCss()) {
            $this->containerCss .= ' ' . $app->getContainerCss();
        }
        if ($app->getContainerFluidCss()) {
            $this->containerFluidCss .= ' ' . $app->getContainerFluidCss();
        }
    }

    /**
     * Render container.
     *
     * @return string.
     * @throws exception.
     */
    public function render()
    {
        $render = objects::get('render');
        $render->assign('core__container', $this);
        return $render->fetch('core/views/container.tpl');
    }

    /**
     * Get container ID.
     *
     * @return string.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get container app IDs.
     *
     * @return array.
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * Get container views.
     *
     * @return array.
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Get container grid.
     *
     * @return array.
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * Get container CSS.
     *
     * @return string.
     */
    public function getContainerCSS()
    {
        return $this->containerCss;
    }

    /**
     * Get container fluid CSS.
     *
     * @return string.
     */
    public function getContainerFluidCSS()
    {
        return $this->containerFluidCss;
    }
}