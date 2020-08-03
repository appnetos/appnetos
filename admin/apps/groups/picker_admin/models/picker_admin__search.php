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
 * @description     Admin admin group picker. Open modal popup to pick an app ID.
 *                  Open:           "admin__groups__picker_admin.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(APP ID);
 */

// Namespace.
namespace admin\groups;

// Use.
use \core\objects;

// Model "admin\apps\picker_admin__search".
class picker_admin__search
{

    /**
     * Search string.
     *
     * @var string.
     */
    public $search = '';

    /**
     * Search number.
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
    public $order = 'xt_id';

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
        $render->assign('admin__groups__picker_admin__search', $this);

        // Get used objects.
        $this->_session = objects::get('session');

        // Get search.
        $search = $this->_session->get('groups__picker_admin__search');

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
        $this->_session->set('groups__picker_admin__search', json_encode($this));
    }

    /**
     * Reset search.
     */
    public function reset()
    {
        // Reset parameters.
        $this->search = '';
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
            'xt_id',
            'xt_id DESC',
            'xt_name',
            'xt_name DESC',
            'xt_description',
            'xt_description DESC'
        ];

        // Get object "core\post".
        $post = objects::get('post');

        // Get POST parameters.
        $number = $post->get('admin__groups__picker_admin__search_number');
        $number = (int)$number;
        $search = $post->get('admin__groups__picker_admin__search_search');
        $area = $post->get('admin__groups__picker_admin__search_area');
        $area = (int)$area;
        $order = $post->get('admin__groups__picker_admin__search_order');
        if (!in_array($order, $orderCompare)) {
            $order = null;
        }

        // Update search.
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