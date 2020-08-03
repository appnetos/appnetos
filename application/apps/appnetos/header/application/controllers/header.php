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
 * @description     Header application with selectable logo and selectable, animated social media icons.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\header".
class header
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Icons.
     *
     * @var array.
     */
    public $icons = null;

    /**
     * Logo.
     *
     * @var array.
     */
    public $logo = null;

    /**
     * Used model "core\uri".
     *
     * @var object.
     */
    protected $_uri = null;

    /**
     * header constructor.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp()->getId();

        // Get and set used objects.
        $this->_uri = objects::get('uri');

        // Initialize list.
        $this->initList();
    }

    /**
     * Initialize list.
     */
    public function initList()
    {
        // Get objects "core\languages" and object "core\database".
        $languages = objects::get('languages');
        $database = objects::get('database');

        // Set parameters as \stdClass.
        $active = $languages->getActiveMain();

        // Prepare parameters.
        $row = null;

        // Select from database table "appnetos__header".
        $query = 'SELECT * FROM appnetos__header_' . $this->appId . ' WHERE xt_language_key=? OR xt_language_key=?  ORDER BY xt_sort';
        $entries = $database->selectArray($query, ['global', $active]);

        // If data not exists.
        if (!$entries) {
            return;
        }

        // Get global data.
        foreach ($entries as $entry) {
            if ($entry['xt_language_key'] !== 'global') {
                continue;
            }
            $entry = array_merge($entry, $this->getUrl($entry['xt_link']));
            if ($entry['xt_logo'] === '1') {
                $this->logo = $entry;
                continue;
            }
            $this->icons[$entry['xt_id']] = $entry;
        }

        // Set language data.
        foreach ($entries as $entry) {
            if ($entry['xt_language_key'] === 'global') {
                continue;
            }
            $entry = array_merge($entry, $this->getUrl($entry['xt_link']));
            if ($this->logo) {
                if ($entry['xt_parent_id'] === $this->logo['xt_id']) {
                    $this->logo['xt_id'] = $entry['xt_id'];
                    $this->logo['xt_img'] = $entry['xt_img'];
                    continue;
                }
            }
            if (isset($this->icons[$entry['xt_parent_id']])) {
                $this->icons[$entry['xt_parent_id']]['xt_id'] = $entry['xt_id'];
                $this->icons[$entry['xt_parent_id']]['xt_img'] = $entry['xt_img'];
            }
        }
    }

    /**
     * Get Url.
     *
     * @param int $link URL ID or link.
     * @return array.
     */
    protected function getUrl($link)
    {
        // Prepare parameter.
        $result = [];
        $result['xt_link'] = $link;
        $result['xt_target'] = '_blank';

        // If link is numeric.
        if (is_numeric($link)) {

            // Get URL by URI ID.
            $url = $this->_uri->getUrl((int)$link);

            // If URL exists.
            if ($url) {
                $result['xt_link'] = $url;
                $result['xt_target'] = '_self';
            }
        }

        // If key is not numeric.
        return $result;
    }
}