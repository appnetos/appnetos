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
 * @description     core/appnetos/group.php ->    User group. Contains all user specify group data. Get group data from
 *                  user or load default group.
 */

// Namespace.
namespace core;

// Class "core\group".
Class group extends base
{

    /**
     * Group ID.
     */
    protected $id = null;

    /**
     * Granted sites.
     *
     * @var array.
     */
    protected $granted = [];

    /**
     * Denied sited.
     *
     * @var array.
     */
    protected $denied = [];

    /**
     * If groups disabled.
     *
     * @var bool.
     */
    protected $disabled = false;

    /**
     * Used object "core\database".
     *
     * @var object.
     */
    protected $_database = null;

    /**
     * Used object "core\config".
     *
     * @var object.
     */
    protected $_config = null;

    /**
     * Used object "core\uri".
     *
     * @var object.
     */
    protected $_uri = null;

    /**
     * Used object "core\user".
     *
     * @var object.
     */
    protected $_user = null;

    /**
     * group constructor.
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
        // Get used objects.
        $this->_database = objects::get('database');
        $this->_config = objects::get('config');
        $this->_uri = objects::get('uri');
        $this->_user = objects::get('user');

        // Initialize application.
        if (!$this->_uri->getAdmin()) {
            $this->initApplication();
        }

        // Initialize admin section.
        else  {
            $this->initAdmin();
        }
    }

    /**
     * Initialize application.
     *
     * @return bool.
     */
    protected function initApplication()
    {
        // If groups disabled.
        if ($this->_config->getDisableGroupsApplication()) {
            $this->disabled = true;
            return false;
        }

        // If user is active.
        if ($this->_user->getActive()) {

            // Get user group.
            $id = $this->_user->getGroup();
            if ($id) {
                $query = 'SELECT xt_granted, xt_denied FROM application_groups WHERE xt_id=?';
                $row = $this->_database->selectRow($query, [$id]);
                if ($row) {
                    $this->id = $id;
                    if ($row['xt_granted']) {
                        $this->granted = array_map('intval', explode(',', $row['xt_granted']));
                    }
                    if ($row['xt_denied']) {
                        $this->denied = array_map('intval', explode(',', $row['xt_denied']));
                    }
                    return true;
                }
            }
        }

        // Get default group.
        $query = 'SELECT xt_id, xt_granted, xt_denied FROM application_groups WHERE xt_default=?';
        $row = $this->_database->selectRow($query, [1]);
        if ($row) {
            $this->id = (int)$row['xt_id'];
            if ($row['xt_granted']) {
                $this->granted = array_map('intval', explode(',', $row['xt_granted']));
            }
            if ($row['xt_denied']) {
                $this->denied = array_map('intval', explode(',', $row['xt_denied']));
            }
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Initialize admin.
     *
     * @return bool.
     */
    protected function initAdmin()
    {
        // If groups disabled.
        if ($this->_config->getDisableGroupsAdmin()) {
            $this->disabled = true;
            return false;
        }

        // If user is active.
        if ($this->_user->getActive()) {

            // Get administrator group
            $id = $this->_user->getGroup();
            if ($id) {
                $query = 'SELECT xt_granted, xt_denied FROM admin_groups WHERE xt_id=?';
                $row = $this->_database->selectRow($query, [$id]);
                if ($row) {
                    $this->id = $id;
                    if ($row['xt_granted']) {
                        $this->granted = array_map('intval', explode('|', $row['xt_granted']));
                    }
                    if ($row['xt_denied']) {
                        $this->denied = array_map('intval', explode('|', $row['xt_denied']));
                    }
                    return true;
                }
            }

            // Get default group.
            $query = 'SELECT xt_id, xt_granted, xt_denied FROM admin_groups WHERE xt_default=?';
            $row = $this->_database->selectRow($query, [1]);
            if ($row) {
                $this->id = (int)$row['xt_id'];
                if ($row['xt_granted']) {
                    $this->granted = array_map('intval', explode('|', $row['xt_granted']));
                }
                if ($row['xt_denied']) {
                    $this->denied = array_map('intval', explode('|', $row['xt_denied']));
                }
                return true;
            }
        }

        // Return.
        return false;
    }

    /**
     * Get if URI is granted.
     *
     * @param int $id URI ID.
     * @return bool.
     */
    public function getGranted($id = null)
    {
        // Get current URI ID if not is set.
        if (!$id) {
            $id = $this->_uri->getId();
        }

        // If no granted and no denied URIs exists.
        if (!$this->granted && !$this->denied) {
            return true;
        }

        // If granted and denied URIs exists.
        elseif ($this->granted && $this->denied) {
            if (in_array($id, $this->granted)) {
                return true;
            }
        }

        // If only granted URIs exists.
        elseif ($this->granted) {
            if (in_array($id, $this->granted)) {
                return true;
            }
        }

        // If only denied URIs exists.
        elseif ($this->denied) {
            if (!in_array($id, $this->denied)) {
                return true;
            }
        }

        // Return.
        return false;
    }

    /**
     * Get if URI is denied.
     *
     * @param int $id URI ID.
     * @return bool.
     */
    public function getDenied($id = null)
    {
        // Get current URI ID if not is set.
        if (!$id) {
            $id = $this->_uri->getId();
        }

        // If no granted and no denied URIs exists.
        if (!$this->granted && !$this->denied) {
            return false;
        }

        // If granted and denied URIs exists.
        elseif ($this->granted && $this->denied) {
            if (in_array($id, $this->granted)) {
                return false;
            }
        }

        // If only granted URIs exists.
        elseif ($this->granted) {
            if (in_array($id, $this->granted)) {
                return false;
            }
        }

        // If only denied URIs exists.
        elseif ($this->denied) {
            if (!in_array($id, $this->denied)) {
                return false;
            }
        }

        // Return.
        return true;
    }
}