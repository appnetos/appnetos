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
 * @description     Automatic breadcrumbs. Loads and shows breadcrumbs by URI index.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\breadcrumbs".
class breadcrumbs
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Breadcrumbs.
     *
     * @var array.
     */
    public $breadcrumbs = [];

    /**
     * Background color.
     *
     * @var string.
     */
    public $background = '#f8f9fa';

    /**
     * Color.
     *
     * @var string.
     */
    public $color = '#6c757d';

    /**
     * Border color.
     *
     * @var string.
     */
    public $border = '#eeeeee';

    /**
     * Link color.
     *
     * @var string.
     */
    public $link = '#222222';

    /**
     * breadcrumbs constructor.
     */
    public function __construct()
    {
        // Get App ID.
        $this->id = objects::getApp('appnetos/breadcrumbs')->getId();

        // Get settings.
        $this->getSettings();

        // Build Breadcrumbs.
        $this->build();

        // Build CSS.
        $this->buildCss();
    }

    /**
     * Get settings.
     */
    public function getSettings()
    {
        // Get and set used objects.
        $extensions = objects::get('extensions');

        // Get app ID by object "core\objects".
        $id = objects::getApp('appnetos/breadcrumbs')->getId();

        // Get settings.
        $settings = $extensions->get('text', $id, 'appnetos/breadcrumbs');

        // If settings exists.
        if ($settings) {
            $settings = json_decode($settings);
            $this->background = $settings->background;
            $this->color = $settings->color;
            $this->border = $settings->border;
            $this->link = $settings->link;
        }
    }

    /**
     * Build breadcrumbs.
     */
    protected function build()
    {
        // Get URI index.
        $uri = objects::get('uri');
        $index = $uri->getRequestIndex();

        // Get links.
        $value = '';
        foreach ($index as $key) {
            $value .= '/' . $key;
            $value = trim($value, '/');
            $url = $uri->getUrl($value);
            $key = str_replace(['-', '_'], ' ', $key);
            $this->breadcrumbs[$key] = $url;
        }
    }

    /**
     * Build CSS.
     */
    public function buildCss()
    {
        // Build CSS.
        $file = 'application/apps/appnetos/breadcrumbs/application/css/breadcrumbs.txt';
        $styles = file_get_contents($file);
        $styles = str_replace('[ID]', $this->id, $styles);
        $styles = str_replace('[BORDER]', $this->border, $styles);
        $styles = str_replace('[BACKGROUND]', $this->background, $styles);
        $styles = str_replace('[COLOR]', $this->color, $styles);
        $styles = str_replace('[LINK]', $this->link, $styles);

        // Add CSS.
        $css = objects::get('css');
        $css->append($styles);
    }
}