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

// Model "admin\apps\marketplace__app".
class marketplace__app
{

    /**
     * Marketplace ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Marketplace name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Marketplace description.
     *
     * @var string.
     */
    public $description = null;

    /**
     * Marketplace image.
     *
     * @var string.
     */
    public $image = null;

    /**
     * Marketplace images.
     *
     * @var array.
     */
    public $images = null;

    /**
     * Marketplace price.
     *
     * @var string.
     */
    public $price = null;

    /**
     * Marketplace link.
     *
     * @var string.
     */
    public $link = null;

    /**
     * Marketplace reviews count.
     *
     * @var int.
     */
    public $reviewsCount = null;

    /**
     * Marketplace rating.
     *
     * @var float.
     */
    public $rating = null;

    /**
     * Rating width.
     *
     * @var int.
     */
    public $ratingWidth = null;

    /**
     * Marketplace manufacturer.
     *
     * @var string.
     */
    public $developer = null;

    /**
     * APPNET OS name.
     *
     * @var string.
     */
    public $appnetosName = null;

    /**
     * APPNET OS namespace.
     *
     * @var string.
     */
    public $appnetosNamespace = null;

    /**
     * APPNET OS directory.
     *
     * @var string.
     */
    public $appnetosDirectory = null;

    /**
     * API Key.
     *
     * @var string.
     */
    public $api = null;

    /**
     * Versions.
     *
     * @var array.
     */
    public $versions = [];

    /**
     * Marketplace data.
     *
     * @var object.
     */
    public $marketplaceData = null;

    /**
     * APPNET OS download status.
     *
     * @var string.
     */
    public $downloadStatus = 'none';

    /**
     * Initialize.
     *
     * @param array $data.
     * @throws.
     */
    public function init($data)
    {
        // Set marketplace data.
        $this->id = (int)$data['product_id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->image = $data['thumb'];
        $this->images = $data['images'];
        $this->price = $data['price'];
        $this->link = $data['href'];
        $this->reviewsCount = (int)$data['reviews_count'];
        $this->rating = (float)$data['rating'];
        $this->ratingWidth = 80 / 5.0 * $this->rating;
        $this->appnetosName = $data['appnetos_name'];
        $this->appnetosNamespace = $data['appnetos_namespace'];
        $this->appnetosDirectory = $data['appnetos_directory'];
        $this->api = $data['api'];
        $this->developer = $data['developer'];

        // Set version.
        foreach ($data['versions'] as $version) {
            $marketplaceAppVersion = objects::getNew('admin/apps/marketplace__app_version');
            $marketplaceAppVersion->init($version);
            $this->versions[] = $marketplaceAppVersion;
        }

        // Initialize APPNET OS data.
        $this->initAppnetos();
    }

    /**
     * Initialize APPNET OS data.
     */
    protected function initAppnetos()
    {
        // Set APPNET OS install status.
        if (!$this->appnetosName || !$this->appnetosDirectory) {
            return;
        }
        $directory = 'application/apps/' . $this->appnetosDirectory . '/' . str_replace(' ', '_', strtolower($this->appnetosName));
        if (is_dir($directory)) {
            $this->downloadStatus = 'unknown';
            $marketplaceFile = $directory . '/marketplace.php';
            if (file_exists($marketplaceFile)) {
                $marketplaceMarketplaceData = objects::getNew('admin/apps/marketplace__marketplace_data');
                $marketplaceMarketplaceData->init($marketplaceFile);
                $this->marketplaceData = $marketplaceMarketplaceData;
                $this->downloadStatus = $marketplaceMarketplaceData->version . ' ' . $marketplaceMarketplaceData->versionStatus;
            }
        }
    }
}