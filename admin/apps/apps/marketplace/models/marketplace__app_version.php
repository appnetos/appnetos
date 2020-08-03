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

// Model "admin\apps\marketplace__app_version".
class marketplace__app_version
{

    /**
     * Marketplace ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Version.
     *
     * @var string.
     */
    public $version = null;

    /**
     * Version status.
     *
     * @var string.
     */
    public $versionStatus = null;

    /**
     * APPNET OS min version.
     *
     * @var int.
     */
    public $appnetosMinVersion = null;

    /**
     * APPNET OS max version.
     *
     * @var int.
     */
    public $appnetosMaxVersion = null;

    /**
     * Marketplace price.
     *
     * @var string.
     */
    public $price = null;

    /**
     * Marketplace tax.
     *
     * @var string.
     */
    public $tax = null;

    /**
     * Marketplace license.
     *
     * @var string.
     */
    public $license = null;

    /**
     * Marketplace special.
     *
     * @var string.
     */
    public $special = null;

    /**
     * Initialize.
     *
     * @param array $data.
     */
    public function init($data)
    {
        // Set marketplace data.
        $this->id = $data['product_id'];
        $this->version = $data['version'];
        $this->versionStatus = $data['version_status'];
        $this->appnetosMinVersion = $data['appnetos_min_version'];
        $this->appnetosMaxVersion = $data['appnetos_max_version'];
        $this->price = $data['price'];
        $this->tax = $data['tax'];
        $this->license = $data['license'];
        $this->special = $data['special'];
    }
}