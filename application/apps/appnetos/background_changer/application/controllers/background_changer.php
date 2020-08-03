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
 * @description     Background Changer. Define background to set as container-fluid CSS, container CSS or app CSS.
 *                  Defined background can set as random background.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Class "appnetos\background_changer".
class background_changer
{

    /**
     * background_changer constructor.
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
        // Get and set used objects.
        $extensions = objects::get('extensions');
        $css = objects::get('css');
        $render = objects::get('render');

        // Get app ID by object "core\objects".
        $appId = objects::getApp('appnetos/background_changer')->getId();

        // Get images.
        $images = $extensions->get('text', $appId, 'appnetos/background_changer');

        // If images exists.
        $buffer = '';
        if ($images) {
            $decode = json_decode($images, true);
            if (count($decode)) {
                $random = mt_rand(0, (count($decode) - 1));
                for ($i = 0; $i < count($decode); $i++) {
                    $buffer .= '.appnetos__background_changer__' . $decode[$i]['id'] . ' { ';
                    if ($decode[$i]['image']) {
                        $buffer .= 'background-image: url("' . $render->getUrl() . '/out/img/appnetos/background_changer/' . $appId . '_' . $decode[$i]['id'] . '.' . $decode[$i]['image'] . '"); ';
                    }
                    if ($decode[$i]['color']) {
                        $buffer .= 'background-color: ' . $decode[$i]['color'] . '; ';
                    }
                    $buffer .= 'background-repeat: ' . $decode[$i]['repeat'] . '; ';
                    $width = 'auto';
                    $height = 'auto';
                    if ($decode[$i]['width']) {
                        $width = $decode[$i]['width'];
                    }
                    if ($decode[$i]['height']) {
                        $height = $decode[$i]['height'];
                    }
                    $buffer .= 'background-size: ' . $width . ' ' . $height . '; ';
                    $buffer .= '} ';
                    if ($i === $random) {
                        $buffer .= '.appnetos__background_changer__' . $appId . ' { ';
                        if ($decode[$i]['image']) {
                            $buffer .= 'background-image: url("' . $render->getUrl() . '/out/img/appnetos/background_changer/' . $appId . '_' . $decode[$i]['id'] . '.' . $decode[$i]['image'] . '"); ';
                        }
                        if ($decode[$i]['color']) {
                            $buffer .= 'background-color: ' . $decode[$i]['color'] . '; ';
                        }
                        $buffer .= 'background-repeat: ' . $decode[$i]['repeat'] . '; ';
                        $width = 'auto';
                        $height = 'auto';
                        if ($decode[$i]['width']) {
                            $width = $decode[$i]['width'];
                        }
                        if ($decode[$i]['height']) {
                            $height = $decode[$i]['height'];
                        }
                        $buffer .= 'background-size: ' . $width . ' ' . $height . '; ';
                        $buffer .= '} ';
                    }
                }
            }
        }

        // Add CSS.
        if ($buffer) {
            $css->append($buffer);
        }
    }
}