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

// Model "admin\apps\marketplace__apps_list".
class marketplace__apps_list
{

    /**
     * Apps.
     *
     * @var array.
     */
    public $apps = null;

    /**
     * Areas.
     *
     * @var int.
     */
    public $areas = 0;

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
     * Error message.
     *
     * @var string.
     */
    public $error = null;

    /**
     * Success message.
     *
     * @var string.
     */
    public $success = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Reset apps.
        $this->apps = null;

        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__marketplace__apps_list', $this);

        // Get apps.
        $uri = objects::get('uri');
        if (!$uri->getAjax()) {
            $this->get();
        }
    }

    /**
     * Get apps.
     */
    public function get()
    {
        // Set search parameters.
        $data = [];
        $search = objects::get('admin/apps/marketplace__search');
        $data['search'] = urlencode($search->search);
        $category = $search->category;
        if ($category) {
            $data['category_id'] = $category;
            $data['sub_category'] = true;
        }
        $data['limit'] = $search->number;
        $data['page'] = $search->area;
        $order = explode(' ', $search->order);
        if (count($order) === 2) {
            $data['sort'] = $order[0];
            $data['order'] = $order[1];
        }

        // Get apps by object "admin\apps\marketplace__api".
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('search', $data);

        // On no result.
        if (!$result) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }
        if (!isset($result['products'])) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }

        // Set apps.
        foreach ($result['products'] as $app) {
            $marketplaceApp = objects::getNew('admin/apps/marketplace__app');
            $marketplaceApp->init($app);
            $this->apps[] = $marketplaceApp;
        }

        // Set area.
        $this->areas = 1;
        $area = 1;
        if (isset($result['pagination']['total']) &&
            isset($result['pagination']['page']) &&
            isset($result['pagination']['limit'])
        ) {
            $total = (int)$result['pagination']['total'];
            $area = (int)$result['pagination']['page'];
            $limit = (int)$result['pagination']['limit'];
            if ($total && $total > $limit) {
                $this->areas = ceil((float)$total / (float)$limit);
                if ($area > $this->areas) {
                    $area = 1;
                }
            }
        }

        // Set start and end.
        if ($this->areas > 1) {
            $this->start = $area - 5;
            $this->end = $area + 5;
            if ($this->start < 1) {
                $this->start = 1;
            }
            if ($this->end > $this->areas) {
                $this->end = $this->areas;
            }
        }

        // Update area.
        $search->updateArea($area);
    }

    /**
     * Add to cart.
     */
    public function addToCart()
    {
        // Prepare variables.
        $data = [];

        // Get object "admin/apps/marketplace__user".
        $marketplaceUser = objects::get('admin/apps/marketplace__user');
        $marketplaceUser->init();

        // If user not signed in.
        if (!$marketplaceUser->user) {
            $this->onError('admin__apps__marketplace__err_not_signed_in');
        }

        // Get used objects.
        $post = objects::get('post');

        // Set data.
        $data['id'] = $post->get('data');

        // If data not exists.
        if (!$data['id']) {
            $this->onError('admin__apps__marketplace__err_connection');
        }

        // Get apps by object "admin\apps\marketplace__api".
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('addtocart', $data);

        // On no result.
        if (!$result) {
            $this->onError('admin__apps__marketplace__err_connection');
        }
        if (!isset($result['success'])) {
            $this->onError('admin__apps__marketplace__err_connection');
        }
        if (!$result['success']) {
            $this->onError('admin__apps__marketplace__err_connection');
        }

        // On success.
        $this->onSuccess('admin__apps__marketplace__conf_add_to_cart');
    }

    /**
     * On error.
     *
     * @param string $error.
     * @throws.
     */
    public function onError($error)
    {
        // Get apps list.
        $this->get();

        // Get used objects.
        $render = objects::get('render');

        // Get error message.
        $strings = objects::get('strings');
        $this->error = $strings->get($error);

        // Build return.
        $data = [];
        $data['user'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl');
        $data['apps'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__apps_list.tpl');

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * On success.
     *
     * @param string $success.
     * @throws.
     */
    public function onSuccess($success)
    {
        // Get apps list.
        $this->get();

        // Get used objects.
        $render = objects::get('render');

        // Get success message.
        $strings = objects::get('strings');
        $this->success = $strings->get($success);

        // Build return.
        $data = [];
        $data['user'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl');
        $data['apps_list'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__apps_list.tpl');

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}