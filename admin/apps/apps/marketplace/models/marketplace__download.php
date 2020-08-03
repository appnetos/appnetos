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

// Model "admin\apps\marketplace__download".
class marketplace__download
{

    /**
     * Download ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Download name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Download size.
     *
     * @var string.
     */
    public $size = null;

    /**
     * Download version.
     *
     * @var string.
     */
    public $version = null;

    /**
     * Download version status.
     *
     * @var string.
     */
    public $versionStatus = null;

    /**
     * Download image.
     *
     * @var string.
     */
    public $image = null;

    /**
     * Download APPNET OS version.
     *
     * @var string.
     */
    public $appnetosVersion = null;

    /**
     * Download APPNET OS minimum version.
     *
     * @var string.
     */
    public $appnetosMinVersion = null;

    /**
     * Download APPNET OS maximum version.
     *
     * @var string.
     */
    public $appnetosMaxVersion = null;

    /**
     * Download APPNET OS name.
     *
     * @var string.
     */
    public $appnetosName = null;

    /**
     * Download APPNET OS namespace.
     *
     * @var string.
     */
    public $appnetosNamespace = null;

    /**
     * Download APPNET OS directory.
     *
     * @var string.
     */
    public $appnetosDirectory = null;

    /**
     * Consisting IDs.
     *
     * @var array.
     */
    public $consistingIds = [];

    /**
     * Consisting directory.
     *
     * @var string.
     */
    public $consistingDirectory = null;

    /**
     * Marketplace data.
     *
     * @var object.
     */
    public $marketplaceData = null;

    /**
     * Download status.
     *
     * @var string.
     */
    public $downloadStatus = null;

    /**
     * Install status.
     *
     * @var string.
     */
    public $installStatus = null;

    /**
     * Consisting installer.
     *
     * @var bool.
     */
    public $consistingInstaller = null;

    /**
     * Install warning.
     *
     * @var string.
     */
    public $installWarning = null;

    /**
     * Initialize.
     *
     * @param array $data.
     */
    public function init($data)
    {
        // Set data.
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->size = $data['size'];
        $this->version = $data['version'];
        $this->versionStatus = $data['version_status'];
        $this->image = $data['image'];
        $this->appnetosVersion = $data['appnetos_version'];
        $this->appnetosMinVersion = $data['appnetos_min_version'];
        $this->appnetosMaxVersion = $data['appnetos_max_version'];
        $this->appnetosName = $data['appnetos_name'];
        $this->appnetosNamespace = $data['appnetos_namespace'];
        $this->appnetosDirectory = $data['appnetos_directory'];

        // Set consisting data.
        $this->setConsisting();
    }

    /**
     * Set consisting data.
     */
    public function setConsisting()
    {
        // Get used objects.
        $database = objects::get('database');
        $strings = objects::get('strings');

        // Get and set consisting information.
        $query = "SELECT xt_id, xt_name, xt_directory FROM application_apps WHERE LOWER(xt_name)=?";
        $array = $database->selectArray($query, [strtolower($this->appnetosName)]);
        if ($array) {
            $consistingIds = [];
            $consistingDirectory = null;
            foreach ($array as $consisting) {
                $consistingIds[] = (int)$consisting['xt_id'];
                $consistingDirectory = $consisting['xt_directory'];
            }
            if ($consistingDirectory === $this->appnetosDirectory) {
                $this->consistingIds = $consistingIds;
                $this->consistingDirectory = $consistingDirectory;
            }
        }

        // Get and set consisting store data by database data.
        if (count($this->consistingIds)) {
            $this->installStatus = true;
            $appnetosName = strtolower(str_replace(' ', '_', $this->appnetosName));
            $marketplaceFile =  BASEPATH . 'application/apps/' . $this->consistingDirectory . '/' . $appnetosName . '/marketplace.php';
            if (file_exists($marketplaceFile)) {
                $marketplaceMarketplaceData = objects::getNew('admin/apps/marketplace__marketplace_data');
                $marketplaceMarketplaceData->init($marketplaceFile);
                $this->marketplaceData = $marketplaceMarketplaceData;
            }
            if ($this->marketplaceData) {
                $versionMarketplace = (float)$this->version;
                $versionInstalled = (float)$this->marketplaceData->version;
                $versionStatusMarketplace = $this->versionStatus;
                $versionStatusInstalled = $this->marketplaceData->versionStatus;
                if ($versionMarketplace > $versionInstalled) {
                    $this->downloadStatus = 'lower';
                }
                elseif ($versionMarketplace < $versionInstalled) {
                    $this->downloadStatus = 'higher';
                }
                else {
                    if ($versionStatusMarketplace !== $versionStatusInstalled) {
                        $this->downloadStatus = 'other_status';
                        $this->installWarning = $strings->get('admin__apps__marketplace__warning_overwrite');
                    }
                    else {
                        $this->downloadStatus = 'same';
                    }
                }
            }
            else {
                $this->downloadStatus = 'unknown';
                $this->installWarning = $strings->get('admin__apps__marketplace__warning_installed _no_data');
            }
            return;
        }

        // Get and set consisting store data by path.
        $this->installStatus = false;
        $appnetosName = strtolower(str_replace(' ', '_', $this->appnetosName));
        $marketplaceFile = BASEPATH . 'application/apps/' . $this->appnetosDirectory . '/' .$appnetosName . '/marketplace.php';
        if (file_exists($marketplaceFile)) {
            $markeplaceMarketplaceData = objects::getNew('admin/apps/marketplace__marketplace_data');
            $markeplaceMarketplaceData->init($marketplaceFile);
            $this->marketplaceData = $markeplaceMarketplaceData;
        }
        if ($this->marketplaceData) {
            $versionMarketplace = (float)$this->version;
            $versionInstalled = (float)$this->marketplaceData->version;
            $versionStatusMarketplace = $this->versionStatus;
            $versionStatusInstalled = $this->marketplaceData->versionStatus;
            if ($versionMarketplace > $versionInstalled) {
                $this->downloadStatus = 'lower';
            }
            elseif ($versionMarketplace < $versionInstalled) {
                $this->downloadStatus = 'higher';
            }
            else {
                if ($versionStatusMarketplace !== $versionStatusInstalled) {
                    $this->downloadStatus = 'other_status';
                    $this->installWarning = $strings->get('admin__apps__marketplace__warning_overwrite');
                }
                else {
                    $this->downloadStatus = 'same';
                }
            }
            return;
        }

        // Get if filesystem exists.
        $appnetosName = strtolower(str_replace(' ', '_', $this->appnetosName));
        $directory = BASEPATH . 'application/apps/' . $this->appnetosDirectory . '/' .$appnetosName . '/';
        if (is_dir($directory . 'admin') ||
            is_dir($directory . 'application') ||
            is_dir($directory . 'widget') ||
            is_dir($directory . 'admin')
        ) {
            $this->downloadStatus = 'unknown';
            if (file_exists($directory . 'admin/events/install.php')) {
                $this->consistingInstaller = true;
                $this->installWarning = $strings->get('admin__apps__marketplace__consisting_filesystem_installer');
                return;
            }
            $this->installWarning = $strings->get('admin__apps__marketplace__consisting_filesystem');
            return;
        }

        // If app not installed.
        $this->downloadStatus = 'none';
    }

    /**
     * Get consisting IDs.
     */
    public function getConsistingIds()
    {
        if (count($this->consistingIds)) {
            return implode(' | ', $this->consistingIds);
        }
        return false;
    }
}