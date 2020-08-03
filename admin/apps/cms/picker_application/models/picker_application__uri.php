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
 * @description     Admin application cms multi picker. Open modal popup to pick an list of URI IDs.
 *                  Open:           "admin__cms__picker_application.pick('mynamespace.myfunction', array with excluded IDs);
 *                  Select: Execute "mynamespace.myfunction(URI ID);
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Controller "admin\cms\picker_application__uri".
class picker_application__uri
{

    /**
     * URI ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * URI.
     *
     * @var string.
     */
    public $uri = null;

    /**
     * URI languages as array of language keys.
     *
     * @var array.
     */
    public $languages = [];

    /**
     * Initialize.
     */
    public function init()
    {
        // Select from database table "application_cms".
        $database = objects::get('database');
        $query = 'SELECT xt_language_key FROM application_cms WHERE xt_parent_id=?';
        $array = $database->selectArray($query, [$this->id]);

        // If no entry exists.
        if (!$array) {
            return;
        }

        // Set languages.
        for ($i = 0; $i < count($array); $i++) {
            array_push($this->languages, $array[$i]['xt_language_key']);
        }
    }

    /**
     * Get languages.
     *
     * @return string.
     */
    public function getLanguages()
    {
        if (count($this->languages)) {
            return implode(' | ', $this->languages);
        }
    }
}