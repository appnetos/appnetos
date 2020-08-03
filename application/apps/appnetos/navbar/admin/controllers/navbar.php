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

// Model "appnetos\navbar".
class navbar
{

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Page ID.
     *
     * @var int.
     */
    public $partId = null;

    /**
     * Error message.
     *
     * @var string.
     */
    public $errorMsg = null;

    /**
     * Confirm message.
     *
     * @var string.
     */
    public $confirmMsg = null;

    /**
     * Settings.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * Used \stdClass languages form model "core\languages".
     *
     * @var object.
     */
    protected $_languages = null;

    /**
     * Used controller "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

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
        // Get and set used data.
        $this->getSet();

        // Initialize settings.
        $this->initSettings();

        // Process data and set settings.
        $this->processData();

        // Initialize.
        $this->initList();
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get and set used objects.
        $this->_extensions = objects::get('extensions');

        // Get and set used variables.
        $languages = objects::get('languages');
        $this->_languages = $languages->getLanguages();

        // Get last process message.
        $session = objects::get('session');
        $this->errorMsg = ($session->get('appnetos__navbar__errorMsg'));
        if ($this->errorMsg) {
            $session->delete('appnetos__navbar__errorMsg');
        }
        $this->confirmMsg = ($session->get('appnetos__navbar__confirmMsg'));
        if ($this->confirmMsg) {
            $session->delete('appnetos__navbar__confirmMsg');
        }
    }

    /**
     * Initialize.
     */
    protected function initSettings()
    {
        // Get app ID by index from object "core\uri".
        $uri = objects::get('uri');
        $index = $uri->getRequestIndex();
        if (isset($index[3])) {
            $this->appId = (int)$index[3];
        }
        if (isset($index[4])) {
            $this->partId = (int)$index[4];
        }

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
     * Process data and set settings.
     */
    protected function processData()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $action = $post->get('action');

        // Edit settings.
        if ($action === 'navbar__edit_settings') {
            $this->navbarEditSettings();
        }

        // Add menu item.
        if ($action === 'navbar__add') {
            $this->navbarAdd();
        }

        // Apply changes.
        if ($action === 'navbar__apply') {
            $this->navbarApply();
        }

        // Delete menu items.
        if ($action === 'navbar__delete') {
            $this->navbarDelete();
        }

        // Move menu item.
        if ($action === 'navbar__move') {
            $this->navbarMove();
        }

        // Move submenu item.
        if ($action === 'navbar__move_sub') {
            $this->navbarMoveSub();
        }
    }

    /**
     * Edit settings.
     */
    protected function navbarEditSettings()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $design = $post->get('navbar__design');
        $home = $post->get('navbar__home');
        $logon = $post->get('navbar__logon');
        $signup = trim($post->get('navbar__signup'));
        $signup = str_replace("\\", "/", $signup);
        $forgetPass = trim($post->get('navbar__forgetPass'));
        $forgetPass = str_replace("\\", "/", $forgetPass);

        // Verifying settings.
        if ($design !== 'dark' && $design !== 'light') {
            $this->redirect('appnetos__navbar__settings_err');
        }
        if (is_numeric($signup)) {
            $signup = (int)$signup;
            $uri = objects::get('uri');
            $seoUrl = $uri->getUrlApplication($signup);
            if (!$seoUrl) {
                $this->redirect('appnetos__navbar__settings_err_seo');
            }
        }
        elseif (strlen($signup) === 0) {
            $signup = null;
        }

        if (is_numeric($forgetPass)) {
            $forgetPass = (int)$forgetPass;
            $uri = objects::get('uri');
            $seoUrl = $uri->getUrlApplication($forgetPass);
            if (!$seoUrl) {
                $this->redirect('appnetos__navbar__settings_err_seo');
            }
        }
        elseif (strlen($forgetPass) === 0) {
            $forgetPass = null;
        }

        // Set settings.
        $this->settings->design = $design;
        if ($home === 'on') {
            $this->settings->home = true;
        }
        else {
            $this->settings->home = false;
        }
        if ($logon === 'on') {
            $this->settings->logon = true;
        }
        else {
            $this->settings->logon = false;
        }
        $this->settings->signup = $signup;
        $this->settings->forgetPass = $forgetPass;

        // Save settings.
        $this->_extensions->set(json_encode($this->settings), 'text', $this->appId);

        // Redirect.
        $this->redirect(null, 'appnetos__navbar__settings_conf');
    }

    /**
     * Add menu item.
     */
    protected function navbarAdd()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $id = $post->get('navbar__id');
        $name = trim($post->get('navbar__name'));
        $link = trim($post->get('navbar__link'));

        // If name not exists.
        if (strlen($name) === 0) {
            $this->redirect('appnetos__navbar__add_err_name');
        }

        // Check link.
        if (strlen($link) !== 0) {
            if (is_numeric($link)) {
                $uri = objects::get('uri');
                $tmp = $uri->getUrlApplication((int)$link);
                if (!$tmp) {
                    $this->redirect('appnetos__navbar__settings_err_seo');
                }
            }
        }

        // Generate menu.
        if ($id === '') {

            // Insert into database table "appnetos__navbar".
            $database = objects::get('database');
            $query = 'INSERT INTO appnetos__navbar_' . $this->appId . ' (xt_parent_id, xt_language_key, xt_sort, xt_name, xt_link) VALUES (?,?,?,?,?)';
            $database->insert($query, [0, 'global', 999999, $name, $link]);
            $this->sort();

            // Redirect.
            $this->redirect(null, 'appnetos__navbar__add_conf');
        }

        // Generate submenu.
        $database = objects::get('database');
        $query = 'INSERT INTO appnetos__navbar_' . $this->appId . ' (xt_parent_id, xt_language_key, xt_sort, xt_name, xt_link) VALUES (?,?,?,?,?)';
        $database->insert($query, [(int)$id, 'global', 999999, $name, $link]);
        $this->sort((int)$id);

        // Redirect.
        $this->redirect(null, 'appnetos__navbar__add_conf');
    }

    /**
     * Apply changes.
     */
    protected function navbarApply()
    {
        // Get all POST parameters.
        $database = objects::get('database');
        $post = objects::get('post');
        $param = $post->getAll();

        // Go through all POST parameters.
        foreach ($param as $key => $value) {

            // Split parameters to get menu parameters.
            $arr = explode('___', $key);

            // If not menu parameter.
            if ($arr[0] !== 'menu') {
                continue;
            }

            // Get menu parameters.
            $id = $arr[1];

            // If is link.
            if ($arr[2] === 'link') {

                // Select from database table "appnetos__navbar".
                $query = 'SELECT xt_id FROM appnetos__navbar_' . $this->appId . ' WHERE xt_id=? AND xt_language_key=?';
                $row = $database->selectRow($query, [$id, 'global']);

                // If data not exists.
                if (!$row) {
                    continue;
                }

                // Update database table "appnetos__navbar".
                $query = 'UPDATE appnetos__navbar_' . $this->appId . ' SET xt_link=? WHERE xt_id=? AND xt_language_key=?';
                $database->update($query, [$value, $id, 'global']);
            }

            // If is name.
            if ($arr[2] === 'name') {

                // If global entry.
                if (count($arr) === 3) {

                    // Select from database table "appnetos__navbar".
                    $query = 'SELECT xt_id FROM appnetos__navbar_' . $this->appId . ' WHERE xt_id=? AND xt_language_key=?';
                    $row = $database->selectRow($query, [$id, 'global']);

                    // If data not exists.
                    if (!$row) {
                        continue;
                    }

                    // Update database table "appnetos__navbar".
                    $query = 'UPDATE appnetos__navbar_' . $this->appId . ' SET xt_name=? WHERE xt_id=? AND xt_language_key=?';
                    $database->update($query, [$value, $id, 'global']);
                }

                // If language entry.
                if (count($arr) === 4) {

                    // If value is empty.
                    if ($value !== '') {

                        // Select from database table "appnetos__navbar".
                        $query = 'SELECT xt_id FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=?';
                        $row = $database->selectRow($query, [$id, $arr[3]]);

                        // If data exists.
                        if ($row) {

                            // Update database table "appnetos__navbar".
                            $query = 'UPDATE appnetos__navbar_' . $this->appId . ' SET xt_name=? WHERE xt_parent_id=? AND xt_language_key=?';
                            $database->update($query, [$value, $id, $arr[3]]);
                        }

                        // If data not exists.
                        else {

                            // Insert into database table "appnetos__navbar".
                            $query = 'INSERT INTO appnetos__navbar_' . $this->appId . ' (xt_parent_id, xt_language_key, xt_sort, xt_name, xt_link) VALUES (?,?,?,?,?)';
                            $database->insert($query, [$id, $arr[3], 0, $value, '']);
                        }
                    }

                    // If value not is empty.
                    else {

                        // Select from database table "appnetos__navbar".
                        $query = 'SELECT xt_id FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=?';
                        $row = $database->selectRow($query, [$id, $arr[3]]);

                        // If data not exists.
                        if (!$row) {
                            continue;
                        }

                        // Delete from database table "appnetos__navbar".
                        $query = 'DELETE FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=?';
                        $database->delete($query, [$id, $arr[3]]);
                    }
                }
            }
        }

        // Redirect.
        $this->redirect(null, 'appnetos__navbar__apply_conf');
    }

    /**
     * Delete menu items.
     */
    protected function navbarDelete()
    {
        // Get POST parameters.
        $database = objects::get('database');
        $post = objects::get('post');
        $id = $post->get('navbar__delete_id');

        // Prepare parameters.
        $parentId = 0;

        // Select from database table "appnetos__navbar".
        $query = 'SELECT xt_id, xt_parent_id FROM appnetos__navbar_' . $this->appId . ' WHERE xt_id=? OR xt_parent_id=?';
        $arr = $database->selectArray($query, [$id, $id]);

        // If data not exists.
        if (!$arr) {
            $this->redirect('appnetos__navbar__delete_err');
        }

        // Go through all children elements.
        for ($i = 0; $i < count($arr); $i++) {

            // If is a children element.
            if ($arr[$i]['xt_parent_id'] === $id) {

                // Delete from database table "appnetos__navbar".
                $query = 'DELETE FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=?';
                $database->delete($query, [$arr[$i]['xt_id']]);
            }

            // If is parent element.
            else {
                $parentId = $arr[$i]['xt_parent_id'];
            }
        }

        // Delete from database table "appnetos__navbar".
        $query = 'DELETE FROM appnetos__navbar_' . $this->appId . ' WHERE xt_id=? OR xt_parent_id=?';
        $database->delete($query, [$id, $id]);

        // Sort global entries.
        $this->sort($parentId);

        // Redirect.
        $this->redirect(null, 'appnetos__navbar__delete_conf');
    }

    /**
     * Move menu items.
     */
    protected function navbarMove()
    {
        // Get POST parameters.
        $database = objects::get('database');
        $post = objects::get('post');
        $id = (int)$post->get('navbar__id');
        $to = $post->get('navbar__to');

        // IF parameters exists.
        if ($id && $to) {

            // Select data from database table "appnetos__navbar".
            $query = 'SELECT xt_id, xt_sort FROM appnetos__navbar_' . $this->appId . ' WHERE xt_id=? AND xt_parent_id=? AND xt_language_key=?';
            $row = $database->selectRow($query, [$id, 0, 'global']);

            // If data exists.
            $row2 = null;
            if ($row) {

                // If move up.
                if ($to === 'up') {

                    // Select data from database table "appnetos__navbar".
                    $query = 'SELECT xt_id, xt_sort FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=? AND xt_sort=?';
                    $row2 = $database->selectRow($query, [0, 'global', ((int)$row['xt_sort'] - 1)]);

                // If move down.
                } elseif ($to === 'down') {

                    // Select data from database table "appnetos__navbar".
                    $query = 'SELECT xt_id, xt_sort FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=? AND xt_sort=?';
                    $row2 = $database->selectRow($query, [0, 'global', ((int)$row['xt_sort'] + 1)]);
                }
            }

            // If data exists.
            if ($row && $row2) {

                // Update data from database table "appnetos__navbar".
                $query = 'UPDATE appnetos__navbar_' . $this->appId . ' SET xt_sort=? WHERE xt_id=?';
                $database->update($query, [(int)$row2['xt_sort'], (int)$row['xt_id']]);
                $database->update($query, [(int)$row['xt_sort'], (int)$row2['xt_id']]);

                // Redirect.
                $this->redirect(null, 'appnetos__navbar__move_conf');
            }
        }

        // If is error.
        $this->redirect('appnetos__navbar__move_err');
    }

    /**
     * Move submenu items.
     */
    protected function navbarMoveSub()
    {
        // Get post parameters.
        $database = objects::get('database');
        $post = objects::get('post');
        $id = (int)$post->get('navbar__id');
        $to = $post->get('navbar__to');

        // If parameters exists.
        if ($id && $to) {

            // Select data from database table "appnetos__navbar".
            $query = 'SELECT xt_id, xt_parent_id, xt_sort FROM appnetos__navbar_' . $this->appId . ' WHERE xt_id=? AND xt_parent_id!=? AND xt_language_key=?';
            $row = $database->selectRow($query, [$id, 0, 'global']);

            // If data exists.
            $row2 = null;
            if ($row) {

                // If move up.
                if ($to === 'up') {

                    // Select data from database table "appnetos__navbar".
                    $query = 'SELECT xt_id, xt_sort FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=? AND xt_sort=?';
                    $row2 = $database->selectRow($query, [(int)$row['xt_parent_id'], 'global', ((int)$row['xt_sort'] - 1)]);
                }

                // If move down.
                elseif ($to === 'down') {

                    // Select data from database table "appnetos__navbar".
                    $query = 'SELECT xt_id, xt_sort FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=? AND xt_sort=?';
                    $row2 = $database->selectRow($query, [(int)$row['xt_parent_id'], 'global', ((int)$row['xt_sort'] + 1)]);
                }
            }

            // If data exists.
            if ($row && $row2) {

                // Update data from database table "appnetos__navbar".
                $query = 'UPDATE appnetos__navbar_' . $this->appId . ' SET xt_sort=? WHERE xt_id=?';
                $database->update($query, [(int)$row2['xt_sort'], (int)$row['xt_id']]);
                $database->update($query, [(int)$row['xt_sort'], (int)$row2['xt_id']]);

                // Redirect.
                $this->redirect(null, 'appnetos__navbar__move_conf');
            }
        }

        // If is error.
        $this->redirect('appnetos__navbar__move_err');
    }

    /**
     * Sort global entries.
     *
     * @param int $id.
     * @throws \core\exception.
     */
    protected function sort($id = 0)
    {
        // Select date from database table "appnetos__navbar".
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM appnetos__navbar_' . $this->appId . ' WHERE xt_parent_id=? AND xt_language_key=? ORDER BY xt_sort';
        $array = $database->selectArray($query, [$id, 'global']);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Sort entries
        for ($i = 0; $i < count($array); $i++) {
            $query = 'UPDATE appnetos__navbar_' . $this->appId . ' SET xt_sort=? WHERE xt_id=?';
            $database->update($query, [($i + 1), $array[$i]['xt_id']]);
        }
    }

    /**
     * Set message and redirect.
     *
     * @param $errorMsg string.
     * @param $confirmMsg string.
     * @throws \core\exception.
     */
    protected function redirect($errorMsg = null, $confirmMsg = null)
    {
        // Get objects.
        $session = objects::get('session');
        $strings = objects::get('strings');

        // Set messages.
        if ($errorMsg) {
            $session->set('appnetos__navbar__errorMsg', $strings->get($errorMsg));
        }
        if ($confirmMsg) {
            $session->set('appnetos__navbar__confirmMsg', $strings->get($confirmMsg));
        }

        // Redirect.
        header('Location: ' . $_SERVER['REQUEST_URI']);
        die;
    }

    /**
     * Get languages.
     *
     * @return array.
     */
    public function getLanguages()
    {
        // Return languages as array.
        return (array)$this->_languages;
    }

    /**
     * Get placeholder.
     *
     * @param string $key language key.
     * @return string.
     */
    public function getPlaceholder($key)
    {
        // Check if main key.
        if ($this->_languages->{$key}->key === $this->_languages->{$key}->mainKey) {
            return '{Global}';
        }
        else {
            return '{' . $this->_languages->{$key}->mainKey . '}';
        }
    }

    /**
     * Get name.
     *
     * @param object $entry language entry.
     * @param string $key language key.
     * @return string.
     */
    public function getName($entry, $key)
    {
        // Get language name by language key.
        if (isset ($entry->languages->{$key})) {
            return $entry->languages->{$key}->name;
        }
    }
}