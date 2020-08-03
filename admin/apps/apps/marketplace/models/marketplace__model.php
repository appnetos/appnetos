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

// Model "admin\apps\marketplace__model".
class marketplace__model
{
    /**
     * Section.
     *
     * @var string.
     */
    public $section = 'marketplace__apps_list';

    /**
     * URI ID.
     *
     * @var int.
     */
    public $uriId = null;

    /**
     * On marketplace error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * Object "core\uri".
     *
     * @var object.
     */
    protected $_uri = null;

    /**
     * Object "core\render".
     *
     * @var object.
     */
    protected $_render = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Get URI ID.
        $this->_uri = objects::get('uri');
        $this->uriId = $this->_uri->getId();

        // Assign.
        $this->_render = objects::get('render');
        $this->_render->assign('admin__apps__marketplace__model', $this);

        // Initialize objects.
        $marketplaceUser = objects::get('admin/apps/marketplace__user', true);
        $marketplaceUser->init();
        $marketplaceUrl = objects::get('admin/apps/marketplace__url', true);
        $marketplaceUrl->init();
        $marketplaceCategories = objects::get('admin/apps/marketplace__categories', true);
        $marketplaceCategories->init();

        // Get index.
        $strings = objects::get('strings');
        $index = $this->_uri->getIndex();

        // If sections.
        if (isset($index[0])) {

            // If my apps section.
            if ($index[0] === $strings->get('admin__apps__marketplace__downloads')) {
                $this->section = 'marketplace__downloads';
                $marketplaceDownloads = objects::get('admin/apps/marketplace__downloads', true);
                $marketplaceDownloads->init();
                return;
            }

            // If cart section.
            if ($index[0] === $strings->get('admin__apps__marketplace__cart')) {
                $this->section = 'marketplace__cart';
                $marketplaceCart = objects::get('admin/apps/marketplace__cart', true);
                $marketplaceCart->init();
                return;
            }
        }

        // If default section.
        if (!$this->error) {
            $marketplaceSearch = objects::get('admin/apps/marketplace__search', true);
            $marketplaceSearch->init();
        }
        if (!$this->error) {
            $marketplaceAppsList = objects::get('admin/apps/marketplace__apps_list', true);
            $marketplaceAppsList->init();
        }
    }

    /**
     * Get admin info.
     *
     * @return bool.
     * @throws.
     */
    public function getInfoAdmin()
    {
        $config = objects::get('config');
        $infoAdmin = $config->getInfoAdmin();
        return $infoAdmin;
    }

    /**
     * Assign object.
     *
     * @param string $name.
     * @param object $object.
     */
    public function assign($name, $object)
    {
        $this->_render->assign($name, $object);
    }
}