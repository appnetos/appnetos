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

// Model "admin\apps\marketplace__downloads".
class marketplace__downloads
{

    /**
     * Downloads.
     *
     * @var array.
     */
    public $downloads = [];

    /**
     * Area.
     *
     * @var int.
     */
    public $area = null;

    /**
     * Areas.
     *
     * @var int.
     */
    public $areas = null;

    /**
     * Areas start.
     *
     * @var int.
     */
    public $start = null;

    /**
     * Areas end.
     *
     * @var int.
     */
    public $end = null;

    /**
     * Used object marketplace "admin\apps\marketplace_user".
     *
     * @var object.
     */
    protected $_marketplaceUser = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $render = objects::get('render');
        $render->assign('admin__apps__marketplace__downloads', $this);

        // Get object marketplace user.
        $this->_marketplaceUser = objects::get('admin/apps/marketplace__user');

        // If user not signed in.
        if (!$this->_marketplaceUser->token || !$this->_marketplaceUser->user) {
            return;
        }

        // If is ajax.
        $uri = objects::get('uri');
        if ($uri->getAjax()) {
            return;
        }

        // Get downloads.
        $this->getDownloads();
    }

    /**
     * Get downloads.
     */
    protected function getDownloads()
    {
        // Get apps by object "admin\apps\marketplace__api".
        $data = [
            'area' => 1,
        ];
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('downloads', $data);

        // On no result.
        if (!$result) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }
        if (!isset($result['downloads'])) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }

        // If user not signed in.
        if (!$this->_marketplaceUser->token || !$this->_marketplaceUser->user) {
            return;
        }

        // Set downloads.
        foreach ($result['downloads'] as $data) {
            $download = objects::getNew('admin/apps/marketplace__download');
            $download->init($data);
            $this->downloads[] = $download;
        }

        // Set area.
        $this->areas = 1;
        $this->area = 1;
        if (isset($result['pagination']['total']) &&
            isset($result['pagination']['page']) &&
            isset($result['pagination']['limit'])
        ) {
            $total = (int)$result['pagination']['total'];
            $this->area = (int)$result['pagination']['page'];
            $limit = (int)$result['pagination']['limit'];
            if ($total && $total > $limit) {
                $this->areas = ceil((float)$total / (float)$limit);
                if ($this->area > $this->areas) {
                    $this->area = 1;
                }
            }
        }

        // Set start and end.
        if ($this->areas > 1) {
            $this->start = $this->area - 5;
            $this->end = $this->area + 5;
            if ($this->start < 1) {
                $this->start = 1;
            }
            if ($this->end > $this->areas) {
                $this->end = $this->areas;
            }
        }
    }

    /**
     * Get downloads by area.
     */
    public function getDownloadsByArea()
    {
        // Get selected area.
        $post = objects::get('post');
        $area = (int)$post->get('area');
        if (!$area) {
            $area = 1;
        }

        // Get apps by object "admin\apps\marketplace__api".
        $data = [
            'area' => $area,
        ];
        $marketplaceApi = objects::getNew('admin/apps/marketplace__api');
        $result = $marketplaceApi->call('downloads', $data);

        // On no result.
        if (!$result) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }
        if (!isset($result['downloads'])) {
            $marketplaceModel = objects::get('admin/apps/marketplace__model');
            $marketplaceModel->error = true;
            return;
        }

        // If user not signed in.
        if (!$this->_marketplaceUser->token || !$this->_marketplaceUser->user) {
            return;
        }

        // Set downloads.
        foreach ($result['downloads'] as $data) {
            $download = objects::getNew('admin/apps/marketplace__download');
            $download->init($data);
            $this->downloads[] = $download;
        }

        // Set area.
        $this->areas = 1;
        $this->area = 1;
        if (isset($result['pagination']['total']) &&
            isset($result['pagination']['page']) &&
            isset($result['pagination']['limit'])
        ) {
            $total = (int)$result['pagination']['total'];
            $this->area = (int)$result['pagination']['page'];
            $limit = (int)$result['pagination']['limit'];
            if ($total && $total > $limit) {
                $this->areas = ceil((float)$total / (float)$limit);
                if ($this->area > $this->areas) {
                    $this->area = 1;
                }
            }
        }

        // Set start and end.
        if ($this->areas > 1) {
            $this->start = $this->area - 5;
            $this->end = $this->area + 5;
            if ($this->start < 1) {
                $this->start = 1;
            }
            if ($this->end > $this->areas) {
                $this->end = $this->areas;
            }
        }

        // Prepare parameters.
        $render = objects::get('render');
        $data = [];
        $data['menu_user'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl');
        $data['apps_list'] = $render->fetch('admin/apps/apps/marketplace/views/marketplace__downloads.tpl');

        // Echo JSON.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}