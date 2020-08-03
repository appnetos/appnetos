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
 * @description     install/models/languages.php ->    APPNET OS installer model "installer\languages".
 */

// Namespace.
namespace installer;

// Model "installer\languages".
class languages
{

    /**
     * Languages as array.
     *
     * @var array.
     */
    public $languages = null;

    /**
     * Active language.
     *
     * @var string.
     */
    public $active = null;

    /**
     * languages constructor.
     */
    public function __construct()
    {
        // Get object "installer\settings".
        $settings = objects::get("settings");

        // If language is set.
        if (isset($settings->settings->language)) {
            $this->active = $settings->settings->language;
        }

        // If language not is set.
        else {
            $this->initActive($settings);
        }

        // If settings template is language.
        if ($settings->settings->part === "language") {
            $this->initLanguages();
        }

        // Set active language.
        $this->active = $settings->settings->language;
    }

    /**
     * Initialize active language.
     *
     * @param object $settings object "settings".
     */
    private function initActive($settings)
    {
        // Initialize languages.
        $this->initLanguages();

        // Set english as language.
        $settings->settings->language = "en";

        // If browser language not exists.
        if (!isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
            return;
        }

        // Get browser language.
        $browser = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
        if (in_array($browser, $this->languages)) {
            $settings->settings->language = $browser;
        }
    }

    /**
     * Initialize languages.
     */
    public function initLanguages()
    {
        // If languages already is set.
        if ($this->languages !== null) {
            return;
        }

        // Prepare parameters.
        $this->languages = [];

        // Get all string files.
        $array = glob("strings/*.php");

        // Get all languages by string files.
        foreach ($array as $file) {
            $key = str_replace([".php","strings/"], "", $file);
            array_push($this->languages, $key);
        }
    }
}