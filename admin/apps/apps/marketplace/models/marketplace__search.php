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

// Model "admin\apps\marketplace__search".
class marketplace__search
{

    /**
     * Apps search string.
     *
     * @var string.
     */
    public $search = '';

    /**
     * Apps category.
     *
     * @var int.
     */
    public $category = 0;

    /**
     * Search number of results.
     *
     * @var int.
     */
    public $number = 10;

    /**
     * Search area.
     *
     * @var int.
     */
    public $area = 1;

    /**
     * Search order.
     *
     * @var string.
     */
    public $order = 'p.sort_order ASC';

    /**
     * Object "core\session".
     *
     * @var object.
     */
    private $_session = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__marketplace__search', $this);

        // Get used objects.
        $this->_session = objects::get('session');

        // Get search.
        $search = $this->_session->get('apps__marketplace__search');

        // If search not is set.
        if (!$search) {
            $this->set();
            return;
        }

        // Set search.
        $array = json_decode($search, true);
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Set search.
     */
    protected function set()
    {
        // Set search to SESSION.
        $this->_session->set('apps__marketplace__search', json_encode($this));
    }

    /**
     * Reset search.
     */
    public function reset()
    {
        // Reset parameters.
        $this->search = '';
        $this->category = 0;
        $this->number = 10;
        $this->area = 1;
        $this->order = 'xt_id';

        // Set search.
        $this->set();
    }

    /**
     * Update search.
     */
    public function update()
    {
        // Order compare parameters.
        $orderCompare = [
            'p.sort_order ASC',
            'pd.name ASC',
            'pd.name DESC',
            'p.price ASC',
            'p.price DESC',
            'rating DESC ',
            'rating ASC'
        ];

        // Get object "core\post".
        $post = objects::get('post');

        // Get POST parameters.
        $category = $post->get('category');
        $category = $category;
        if (!$category) {
            $category = '0';
        }
        $number = $post->get('number');
        $number = (int)$number;
        $search = $post->get('search');
        $area = $post->get('area');
        $area = (int)$area;
        $order = $post->get('order');
        if (!in_array($order, $orderCompare)) {
            $order = 'p.sort_order ASC';
        }

        // Update search.
        if ($category !== null) {
            $this->category = $category;
        }
        if ($number) {
            $this->number = $number;
        }
        if ($search !== null) {
            $this->search = $search;
        }
        if ($area) {
            $this->area = $area;
        }
        if ($order) {
            $this->order = $order;
        }

        // Set search.
        $this->set();

        // Get model "admin\apps\marketplace__apps_list".
        $marketplaceAppsList = objects::get('admin/apps/marketplace__apps_list', true);
        $marketplaceAppsList->get();

        // Prepare parameters.
        $render = objects::get('render');
        $data = [];
        $data['menu_user'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl');
        $data['apps_list'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__apps_list.tpl');

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Update area.
     *
     * @param int $area area.
     */
    public function updateArea($area)
    {
        // Set area.
        $this->area = $area;

        // Set search.
        $this->set();
    }
}