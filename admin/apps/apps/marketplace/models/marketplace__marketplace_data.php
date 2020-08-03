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

// Model "admin\apps\marketplace__marketplace_data".
class marketplace__marketplace_data
{

    /**
     * Marketplace data version.
     *
     * @var string.
     */
    public $version = null;

    /**
     * Marketplace data version status.
     *
     * @var string.
     */
    public $versionStatus = null;

    /**
     * Marketplace data APPNET OS min Version.
     *
     * @var string.
     */
    public $appnetosMinVersion = null;

    /**
     * Marketplace data APPNET OS max Version.
     *
     * @var string.
     */
    public $appnetosMaxVersion = null;

    /**
     * Marketplace data developer name.
     *
     * @param string.
     */
    public $developerName = null;

    /**
     * Marketplace data developer web.
     *
     * @param string.
     */
    public $developerWeb = null;

    /**
     * Marketplace data developer mail.
     *
     * @var string.
     */
    public $developerMail = null;

    /**
     * Marketplace data developer author.
     *
     * @var string.
     */
    public $developerAuthor = null;

    /**
     * Marketplace data marketplace key.
     *
     * @var string.
     */
    public $marketplaceKey = null;

    /**
     * Initialize.
     *
     * @param string $marketplaceFile.
     */
    public function init($marketplaceFile)
    {
        // Include marketplace file.
        if (file_exists($marketplaceFile)) {
            include $marketplaceFile;
        }
    }
}