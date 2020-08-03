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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 */

// Namespace.
namespace admin\settings;

// Use.
use core\objects;

// Model "admin\settings\system__extend".
class system__extend
{

    /**
     * Class key.
     *
     * @var string.
     */
    public $key = null;

    /**
     * Class parent.
     *
     * @var string.
     */
    public $parent = null;

    /**
     * Parent exists.
     *
     * @var bool.
     */
    public $parentExists = false;

    /**
     * Children.
     *
     * @var string.
     */
    public $children = null;

    /**
     * Children exists.
     *
     * @var bool.
     */
    public $childrenExists = false;

    /**
     * Is active.
     *
     * @var bool.
     */
    public $active = false;

    /**
     * First extend.
     *
     * @var bool.
     */
    public $first = false;

    /**
     * Last extend.
     *
     * @var bool.
     */
    public $last = false;

    /**
     * Initialize.
     *
     * @param array $extend.
     * @return bool.
     */
    public function init($extend)
    {
        // In extend not is array.
        if (!is_array($extend)) {
            return false;
        }

        // If keys not exists.
        if (!isset($extend['key']) ||
            !isset($extend['parent']) ||
            !isset($extend['children']) ||
            !isset($extend['active']))
        {
            return false;
        }

        // Set variables.
        $this->key = $extend['key'];
        $this->parent = $extend['parent'];
        $this->children = $extend['children'];
        $this->active = $extend['active'];
        if (file_exists($this->parent)) {
            $this->parentExists = true;
        }
        if (file_exists($this->children)) {
            $this->childrenExists = true;
        }

        // Set active.
        if ($this->active && (!$this->parentExists || !$this->childrenExists)) {
            $this->active = false;
        }

        // Return.
        return true;
    }
}