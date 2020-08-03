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
 * @description     Multilingual Navbar to create extended navigation menus on base of bootstrap Navbar.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Model "appnetos\navbar__list".
class navbar__list
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Navbar entries.
     *
     * @var array.
     */
    public $entries = null;

    /**
     * Used object "core\uri".
     *
     * @var object.
     */
    public $_uri = null;

    /**
     * Initialize.
     *
     * @param int $appId.
     * @throws.
     */
    public function init($appId)
    {
        // Get used objects.
        $this->_uri = objects::get('uri');

        // Get active languages.
        $languages = objects::get('core/languages');
        $active = $languages->getActive();
        $activeMain = $languages->getActiveMain();

        // Set app ID.
        $this->appId = $appId;

        // Select global data from database table "appnetos__navbar".
        $database = objects::get('database');
        $query = 'SELECT * FROM appnetos__navbar_' . $this->appId . ' WHERE xt_language_key=? OR xt_language_key=? OR xt_language_key=? ORDER BY xt_sort';
        $menus = $database->selectArray($query, ['global', $activeMain, $activeMain]);

        // If data not exists.
        if (!$menus) {
            return;
        }

        // Set global parents.
        foreach ($menus as $parent) {
            if ((int)$parent['xt_parent_id'] || $parent['xt_language_key'] !== 'global') {
                continue;
            }

            // Process link.
            $processedLink = $this->processLink($parent['xt_link']);

            // Set global parent.
            $entry = [];
            $entry['id'] = (int)$parent['xt_id'];
            $entry['sort'] = (int)$parent['xt_sort'];
            $entry['name'] = $parent['xt_name'];
            $entry['link'] = $processedLink['link'];
            $entry['target'] = $processedLink['target'];
            $entry['submenus'] = [];

            // Set active parent.
            foreach ($menus as $parentActive) {
                if (!(int)$parentActive['xt_parent_id'] || (int)$parentActive['xt_sort'] || $parentActive['xt_language_key'] !== $active) {
                    continue;
                }
                if ((int)$entry['id'] === (int)$parentActive['xt_parent_id']) {
                    $entry['name'] = $parentActive['xt_name'];
                }
            }

            // Set active main parent.
            if ($active !== $activeMain) {
                foreach ($menus as $parentActiveMain) {
                    if (!(int)$parentActiveMain['xt_parent_id'] || (int)$parentActiveMain['xt_sort'] || $parentActiveMain['xt_language_key'] !== $activeMain) {
                        continue;
                    }
                    if ((int)$entry['id'] === (int)$parentActiveMain['xt_parent_id']) {
                        $entry['name'] = $parentActiveMain['xt_name'];
                    }
                }
            }

            // Set global children.
            foreach ($menus as $child) {
                if ((int)$parent['xt_id'] !== (int)$child['xt_parent_id'] || !(int)$child['xt_sort'] || $child['xt_language_key'] !== 'global') {
                    continue;
                }

                // Process link.
                $processedLink = $this->processLink($child['xt_link']);

                // Set global child.
                $submenu = [];
                $submenu['id'] = (int)$child['xt_id'];
                $submenu['sort'] = (int)$child['xt_sort'];
                $submenu['name'] = $child['xt_name'];
                $submenu['link'] = $processedLink['link'];
                $submenu['target'] = $processedLink['target'];

                // Set active children.
                foreach ($menus as $childActive) {
                    if (!(int)$childActive['xt_parent_id'] || (int)$childActive['xt_sort'] || $childActive['xt_language_key'] !== $active) {
                        continue;
                    }
                    if ((int)$submenu['id'] === (int)$childActive['xt_parent_id']) {
                        $submenu['name'] = $childActive['xt_name'];
                    }
                }

                // Set active main parent.
                if ($active !== $activeMain) {
                    foreach ($menus as $childActiveMain) {
                        if (!(int)$childActiveMain['xt_parent_id'] || (int)$childActiveMain['xt_sort'] || $childActiveMain['xt_language_key'] !== $activeMain) {
                            continue;
                        }
                        if ((int)$submenu['id'] === (int)$childActiveMain['xt_parent_id']) {
                            $submenu['name'] = $childActiveMain['xt_name'];
                        }
                    }
                }

                // Set children as submenu.
                $entry['submenus'][$submenu['sort']] = $submenu;
            }

            // Set parent as entry.
            $this->entries[$entry['sort']] = $entry;
        }
    }

    /**
     * Process link.
     *
     * @param mixed $link.
     * @return array.
     */
    protected function processLink($link)
    {
        $result = [];
        $result['link'] = $link;
        $result['target'] = '_blank';

        // If link is not numeric.
        if (!is_numeric($link)) {
            return $result;
        }

        // Get multilingual URL by int of global URI.
        $uri = $this->_uri->getUrl((int)$link);

        // If URI not exists.
        if (!$uri) {
            return $result;
        }

        // If URI exists.
        $result['link'] = $uri;
        $result['target'] = '_self';
        return $result;
    }
}