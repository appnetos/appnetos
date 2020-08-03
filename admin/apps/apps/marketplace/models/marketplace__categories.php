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
 * @description     APPNET OS Marketplace.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\marketplace__categories".
class marketplace__categories
{

    /**
     * Categories.
     *
     * @var array.
     */
    public $categories = [];

    /**
     * Used object "core/session".
     *
     * @var object.
     */
    protected $_session = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__marketplace__categories', $this);

        // Get used objects.
        $this->_session = objects::get('session');

        // Get categories.
        $categories = $this->_session->get('apps__marketplace__categories');

        // If categories is set.
        if ($categories) {
            $this->categories = $categories;
            return;
        }

        // Set categories
        $this->set();
    }

    /**
     * Get categories and set.
     */
    protected function set()
    {
        // Get categories by object "admin\apps\marketplace__api".
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('categories');

        // On no result.
        if (!$result) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }
        if (!isset($result['categories'])) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }

        // Set categories.
        $this->_session->set('apps__marketplace__categories', $result['categories']);
        $this->categories = $result['categories'];
    }
}