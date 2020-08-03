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

// define objects
use core\objects;

// Model "appnetos\navbar".
class navbar
{

    /**
     * Array of registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['signIn', 'signOut'];

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Settings.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * Used controller "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * Used model "core\uri".
     *
     * @var object.
     */
    protected $_uri = null;

    /**
     * navbar constructor.
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
        $this->_extensions = objects::get('extensions');
        $this->_uri = objects::get('core/uri');

        // Initialize settings.
        $this->initSettings();

        // Initialize list.
        $this->initList();
    }

    /**
     * Initialize settings.
     */
    protected function initSettings()
    {
        // Set parameters as new \stdClass.
        $this->settings = new \stdClass();

        // Get settings.
        $settings = $this->_extensions->get('text', $this->appId);

        // If settings exists.
        if ($settings) {
            $this->settings = json_decode($settings);
        }

        // If settings not exists.
        else {
            $this->settings->design = 'dark';
            $this->settings->home = false;
            $this->settings->logon = false;
            $this->settings->signup = null;
            $this->settings->forgetPass = null;
            $this->_extensions->set(json_encode($this->settings), 'text', $this->appId);
        }
    }

    /*
     * Initialize list.
     */
    protected function initList()
    {
        // Initialize object "appnetos/navbar__list".
        $navbar__list = objects::getNew('appnetos/navbar__list');
        $navbar__list->init($this->appId);

        // Add object "appnetos/navbar__list" to object "core\objects" and object "core\render".
        objects::set('appnetos/navbar__list', $navbar__list);
        $render = objects::get('render');
        $render->assign('appnetos__navbar__list', $navbar__list);
    }

    /**
     * AJAX request sign in.
     *
     * @return bool.
     * @throws.
     */
    public function signIn()
    {
        // Set JSON header.
        header('Content-Type: application/json');

        // Get object "core\post".
        $post = objects::get('post');

        // Get POST parameter.
        $username = $post->get('user');
        $password = $post->get('pass');
        $stay = false;

        // Prepare parameters.
        if ($post->get('stay') !== '0') {
            $stay = true;
        }

        // If parameters exists.
        if ($username && $password) {

            // Sign in.
            $user = objects::get('user');

            // If signed in.
            if ($user->signIn($username, $password, $stay)) {
                echo '{"success":true}';
                exit;
            }

            // If not signed in.
            else {
                echo '{"success":false}';
                exit;
            }
        }

        // If not signed in.
        else {
            echo '{"success":false}';
            exit;
        }
    }

    /**
     * AJAX request sign out.
     *
     * @return bool.
     * @throws.
     */
    public function signOut()
    {
        // Set JSON header.
        header('Content-Type: application/json');

        // Get object "core\user".
        $user = objects::get('user');

        // Sign out.
        $user->signOut();
        echo '{"success":true}';
        return true;
    }

    /**
     * Get if user is active.
     *
     * @return bool.
     * @throws.
     */
    public function getActive()
    {
        // Get if user is active form object "core\user".
        $user = objects::get('user');
        return $user->getActive();
    }

    /**
     * Get link.
     *
     * @param string $link.
     * @return string.
     */
    public function getUrl($link)
    {
        // If link is not numeric.
        if (!is_numeric($link)) {
            return $link;
        }

        // Get multilingual URL by int of global URI.
        $tmp = $this->_uri->getUrl((int)$link);

        // Return URI.
        if ($tmp) {
            return $tmp;
        }
        return $link;
    }
}