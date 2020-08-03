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
     * Part ID.
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
        // Get and set used data.
        $this->getSet();

        // Process data and set settings.
        $this->processData();

        // Initialize list.
        $this->initList();
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
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
    }

    /*
     * Initialize.
     */
    protected function initList()
    {
        // Get object "appnetos/header__list".
        $header__list = objects::getNew('appnetos/header__list');
        $header__list->init($this->appId);

        // Add object "appnetos/header__list" to object "core\objects" and object "core\render".
        objects::set('appnetos/header__list', $header__list);
        $render = objects::get('render');
        $render->assign('appnetos__header__list', $header__list);

        // Get last process message.
        $session = objects::get('session');
        $this->errorMsg = ($session->get('appnetos__header__errorMsg'));
        if ($this->errorMsg) {
            $session->delete('appnetos__header__errorMsg');
        }
        $this->confirmMsg = ($session->get('appnetos__header__confirmMsg'));
        if ($this->confirmMsg) {
            $session->delete('appnetos__header__confirmMsg');
        }
    }

    /**
     * Process data.
     */
    protected function processData()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $action = $post->get('action');

        // Add entry.
        if ($action === 'add') {
            $this->add();
        }

        // Edit entry.
        if ($action === 'edit') {
            $this->edit();
        }

        // Delete entry.
        if ($action === 'delete') {
            $this->delete();
        }

        // Edit image.
        if ($action === 'edit_images') {
            $this->editImages();
        }

        // Add language.
        if ($action === 'add_language') {
            $this->addLanguage();
        }

        // Fast select.
        if ($action === 'fast_select') {
            $this->fastSelect();
        }

        // Move up.
        if ($action === 'move_up') {
            $this->moveUp();
        }

        // Move down.
        if ($action === 'move_down') {
            $this->moveDown();
        }
    }

    /**
     * Add entry.
     */
    protected function add()
    {
        // Prepare parameters.
        $img = null;
        $sort = 99999;

        // Generate out folder.
        $this->setOut();

        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // If is logo.
        $logo = $post->get('header__add_logo');
        if ($logo === 'true') {

            // Select from database table "appnetos__header".
            $logo = 1;
            $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_logo=?';
            $row = $database->selectRow($query, [1]);

            // If logo allready exists.
            if ($row) {
                $this->redirect('appnetos__header__err_exists');
            }

            // Set sort.
            $sort = 0;
        }

        // If is not logo.
        else {
            $logo = 0;
        }

        // If file not exists.
        if (!isset($_FILES['header__add_img'])) {
            $this->redirect('appnetos__header__err_file');
        }

        // Check img file.
        if (isset($_FILES['header__add_img'])) {

            // Check file.
            $name = $_FILES['header__add_img']['name'];
            $parts = pathinfo($name);

            // If extension is wrong.
            if (!isset($parts['extension'])) {
                $this->redirect('appnetos__header__err_format');
            }

            // Set extension.
            $ext = $parts['extension'];

            // If extension is wrong.
            if ($ext !== 'png' && $ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'gif' && $ext !== 'svg') {
                $this->redirect('appnetos__header__err_format');
            }

            // If img exists.
            $img = $ext;
        }

        // Get link.
        $link = trim(str_replace(' ', '', $post->get('header__add_link')));

        // If link not exists.
        if (!$link) {
            $this->redirect('appnetos__header__err_link');
        }

        // Get width.
        $width = intval($post->get('header__add_width'));

        // If width is wrong.
        if (!$width || $width === 0) {
            $this->redirect('appnetos__header__err_width');
        }

        // Insert into database table "appnetos__header".
        $query = 'INSERT INTO appnetos__header_' . $this->appId . ' (xt_parent_id, xt_active, xt_language_key, xt_logo, xt_sort, xt_img, xt_link, xt_width) VALUES (0,1,?,?,?,?,?,?)';
        $id = $database->insert($query, ['global', $logo, $sort, $img, $link, $width]);

        // Move uploaded file.
        if ($img !== '') {
            move_uploaded_file($_FILES['header__add_img']['tmp_name'], 'out/img/appnetos/header/' . $this->appId . '_' . $id . '.' . $img);
        }

        // Sort icons.
        $this->sort();

        // Redirect.
        $this->redirect(null, 'appnetos__header__add_conf');
    }

    /**
     * Edit entry.
     */
    protected function edit()
    {
        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $id = (int)$post->get('header__edit_id');

        // If parameters wrong or not exists.
        if (!$id) {
            $this->redirect('appnetos__header__err_exists');
        }
        $link = trim(str_replace(' ', '', $post->get('header__edit_link')));
        $width = intval($post->get('header__edit_width'));
        if (!$width || $width === 0) {
            $this->redirect('appnetos__header__err_width');
        }

        // If parameters wrong.
        if (!$link) {
            $this->redirect('appnetos__header__err_link');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);
        if (!$row) {
            $this->redirect('appnetos__header__err_exists');
        }

        // Update database table "appnetos__header".
        $query = 'UPDATE appnetos__header_' . $this->appId . ' SET xt_link=?, xt_width=? WHERE xt_id=?';
        $database->update($query, [$link, $width, $row['xt_id']]);

        // Redirect.
        $this->redirect(null, 'appnetos__header__add_edit');
    }

    /**
     * Delete entry.
     */
    protected function delete()
    {
        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $id = (int)$post->get('header__delete_id');

        // If parameters wrong or not exists.
        if (!$id) {
            $this->redirect('appnetos__header__err_exists');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id, xt_parent_id, xt_img FROM appnetos__header_' . $this->appId . ' WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->redirect('appnetos__header__err_exists');
        }

        // Delete from database table "appnetos__header".
        $query = 'DELETE FROM appnetos__header_' . $this->appId . ' WHERE xt_id=?';
        $database->delete($query, [$id]);

        // Delete image file.
        if (file_exists('out/img/appnetos/header/' . $this->appId . '_' . $id . '.' . $row['xt_img'])) {
            unlink('out/img/appnetos/header/' . $this->appId . '_' . $id . '.' . $row['xt_img']);
        }

        // If is not parent.
        if ((int)$row['xt_parent_id'] !== 0) {
            $this->redirect(null, 'appnetos__header__del_conf');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_parent_id=?';
        $arr = $database->selectArray($query, [$id]);

        // If data not exists.
        if (!$arr) {
            $this->redirect(null, 'appnetos__header__del_conf');
        }

        // Delete children.
        for ($i = 0; $i < count($arr); $i++) {

            // Delete from database table "appnetos__header".
            $query = 'DELETE FROM appnetos__header_' . $this->appId . ' WHERE xt_id=?';
            $database->delete($query, [(int)$arr[$i]['xt_id']]);

            // Delete image file.
            if (file_exists('out/img/appnetos/header/' . $this->appId . '_' . (int)$arr[$i]['xt_id'] . '.' . $row['xt_img'])) {
                unlink('out/img/appnetos/header/' . $this->appId . '_' . (int)$arr[$i]['xt_id'] . '.' . $row['xt_img']);
            }
        }

        // Redirect.
        $this->redirect(null, 'appnetos__header__del_conf');
    }

    /**
     * Edit images.
     */
    protected function editImages()
    {
        // Generate out folder.
        $this->setOut();

        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $id = (int)$post->get('header__edit_images_id');

        // If parameters wrong or not exists.
        if (!$id) {
            $this->redirect('appnetos__header__err_exists');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id, xt_img FROM appnetos__header_' . $this->appId . ' WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->redirect('appnetos__header__err_exists');
        }

        // Set img old.
        $imgOld = $row['xt_img'];

        // If file not exists.
        if (!isset($_FILES['header__edit_images_img'])) {
            $this->redirect('appnetos__header__err_format');
        }
        $name = $_FILES['header__edit_images_img']['name'];
        if (!$name) {
            $this->redirect('appnetos__header__err_format');
        }
        $parts = pathinfo($name);

        // If file is wrong.
        if (!isset($parts['extension'])) {
            $this->redirect('appnetos__header__err_format');
        }

        // Set extension.
        $ext = $parts['extension'];

        // If file is wrong.
        if ($ext !== 'png' && $ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'gif' && $ext !== 'svg') {
            $this->redirect('appnetos__header__err_format');
        }

        // Set img.
        $img = $ext;

        // Move uploaded file.
        if (file_exists('out/img/appnetos/header/' . $this->appId . '_' . $id . '.' . $imgOld)) {
            unlink('out/img/appnetos/header/' . $this->appId . '_' . $id . '.' . $imgOld);
        }
        move_uploaded_file($_FILES['header__edit_images_img']['tmp_name'], 'out/img/appnetos/header/' . $this->appId . '_' . $id . '.' . $img);

        // Update database table "appnetos__header".
        $query = 'UPDATE appnetos__header_' . $this->appId . ' SET xt_img=? WHERE xt_id=?';
        $database->update($query, [$img, $id]);

        // Redirect.
        $this->redirect(null, 'appnetos__header__img_conf');
    }

    /**
     * Add language.
     */
    protected function addLanguage()
    {
        // Prepare parameters.
        $img = null;

        // Generate out folder.
        $this->setOut();

        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $id = (int)$post->get('header__add_language_id');
        $languageKey = $post->get('header__add_language_key');

        // If parameters wrong or not exists.
        if (!$id) {
            $this->redirect('appnetos__header__err_exists');
        }
        if (!$languageKey || $languageKey === '' || $languageKey === 'global') {
            $this->redirect('appnetos__header__err_no_lang');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->redirect('appnetos__header__err_exists');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_language_key FROM appnetos__header_' . $this->appId . ' WHERE xt_parent_id=?';
        $array = $database->selectArray($query, [$id]);

        // If children already is set.
        if ($array) {
            for ($i = 0; $i < count($array); $i++) {
                if ($array[$i]['xt_language_key'] === $languageKey) {
                    $this->redirect('appnetos__header__err_lang');
                    break;
                }
            }
        }

        // Get languages from object "core\languages".
        $languages = (array)objects::get('languages')->languages;

        // Check if language not exists.
        $exist = false;
        foreach ($languages as $language) {
            if ($language->key === $languageKey) {
                $exist = true;
                break;
            }
        }

        // If language not exists.
        if (!$exist) {
            $this->redirect('appnetos__header__err_lang');
        }

        // Check img file.
        if (isset($_FILES['header__add_language_img'])) {
            $name = $_FILES['header__add_language_img']['name'];
            $parts = pathinfo($name);

            // If img is wrong.
            if (!isset($parts['extension'])) {
                $this->redirect('appnetos__header__err_format');
            }

            // Set parts.
            $ext = $parts['extension'];

            // If img is wrong.
            if ($ext !== 'png' && $ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'gif' && $ext !== 'svg') {
                $this->redirect('appnetos__header__err_format');
            }

            // Set img.
            $img = $ext;
        }

        // Insert into database table "appnetos__header".
        $query = 'INSERT INTO appnetos__header_' . $this->appId . ' (xt_parent_id, xt_active, xt_language_key, xt_logo, xt_sort, xt_img, xt_link, xt_width) VALUES (?,1,?,0,0,?,?,0)';
        $id = $database->insert($query, [$id, $languageKey, $img, '']);

        // Move uploaded file.
        if ($img !== '') {
            move_uploaded_file($_FILES['header__add_language_img']['tmp_name'], 'out/img/appnetos/header/' . $this->appId . '_' . $id . '.' . $img);
        }

        // Redirect.
        $this->redirect(null, 'appnetos__header__add_lang_conf');
    }

    /**
     * Fast select.
     */
    protected function fastSelect()
    {
        // Prepare parameters.
        $img = 'svg';

        // Generate out folder.
        $this->setOut();

        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $selection = $post->get('header__selection');

        // Insert into database table "appnetos__header".
        $query = 'INSERT INTO appnetos__header_' . $this->appId . ' (xt_parent_id, xt_active, xt_language_key, xt_logo, xt_sort, xt_img, xt_link, xt_width) VALUES (0,1,?,0,99999,?,?,50)';
        $id = $database->insert($query, ['global', $img, '']);

        // Copy file.
        copy($selection, 'out/img/appnetos/header/' . $this->appId . '_' . $id . '.svg');

        // Sort icons.
        $this->sort();

        // Redirect.
        $this->redirect(null, 'appnetos__header__add_conf');
    }

    /**
     * Move down.
     */
    protected function moveDown()
    {
        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $sort = $post->get('header__sort');

        // If sort not exists
        if (!$sort) {
            $this->redirect('appnetos__header__err_move');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_sort=?';
        $row = $database->selectRow($query, [$sort]);

        // If data not exists.
        if(!$row) {
            $this->redirect('appnetos__header__err_move');
        }

        // Prepare parameters.
        $id1 = $row['xt_id'];
        $sort1 = $sort;

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_sort=?';
        $row = $database->selectRow($query, [($sort + 1)]);

        // If entry not exists.
        if(!$row) {
            $this->redirect('appnetos__header__err_move');
        }

        // Prepare parameters.
        $id2 = $row['xt_id'];
        $sort2 = $sort + 1;

        // If parameters not exists.
        if (!$id1 || !$id2) {
            $this->redirect('appnetos__header__err_move');
        }

        // Switch entries.
        $this->switchEntries($id1, $id2, $sort1, $sort2);

        // Redirect.
        $this->redirect(null, 'appnetos__header__move_conf');
    }

    /**
     * Move up.
     */
    protected function moveUp()
    {
        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $sort = $post->get('header__sort');

        // If sort not exists.
        if(!$sort) {
            $this->redirect('appnetos__header__err_move');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_sort=?';
        $row = $database->selectRow($query, [$sort]);

        // If entry not exists.
        if (!$row) {
            $this->redirect('appnetos__header__err_move');
        }

        // Prepare parameters.
        $id1 = $row['xt_id'];
        $sort1 = $sort;

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_sort=?';
        $row = $database->selectRow($query, [($sort - 1)]);

        // If entry not exists.
        if (!$row) {
            $this->redirect('appnetos__header__err_move');
        }

        // Prepare parameters.
        $id2 = $row['xt_id'];
        $sort2 = $sort - 1;

        // If parameters not exists.
        if (!$id1 || !$id2) {
            $this->redirect('appnetos__header__err_move');
        }

        // Switch entries.
        $this->switchEntries($id1, $id2, $sort1, $sort2);

        // Redirect.
        $this->redirect(null, 'appnetos__header__move_conf');
    }

    /**
     * Switch entries.
     *
     * @param int $id1
     * @param int $id2
     * @param int $sort1
     * @param int $sort2
     */
    protected function switchEntries($id1, $id2, $sort1, $sort2)
    {
        // Get object "core\database".
        $database = objects::get('database');

        // Update database table "appnetos__header".
        $query = 'UPDATE appnetos__header_' . $this->appId . ' SET xt_sort=? WHERE xt_id=?';
        $database->update($query, [$sort1, $id2]);
        $query = 'UPDATE appnetos__header_' . $this->appId . ' SET xt_sort=? WHERE xt_id=?';
        $database->update($query, [$sort2, $id1]);

        // Sort entries.
        $this->sort();
    }

    /**
     * Set message and redirect.
     *
     * @param $errorMsg string.
     * @param $confirmMsg string.
     */
    protected function redirect($errorMsg = null, $confirmMsg = null)
    {
        // Get objects.
        $session = objects::get('session');
        $strings = objects::get('strings');

        // Set messages.
        if ($errorMsg) {
            $session->set('appnetos__header__errorMsg', $strings->get($errorMsg));
        }
        if ($confirmMsg) {
            $session->set('appnetos__header__confirmMsg', $strings->get($confirmMsg));
        }

        // Redirect.
        header('Location: ' . $_SERVER['REQUEST_URI']);
        die;
    }

    /**
     * Generate out folder.
     */
    protected function setOut()
    {
        if (!is_dir('out')) {
            mkdir('out');
        }
        if (!is_dir('out/img')) {
            mkdir('out/img');
        }
        if (!is_dir('out/img/appnetos')) {
            mkdir('out/img/appnetos');
        }
        if (!is_dir('out/img/appnetos/header')) {
            mkdir('out/img/appnetos/header');
        }
    }

    /**
     * Sort icons.
     */
    protected function sort()
    {
        // Select from database table "appnetos__header".
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM appnetos__header_' . $this->appId . ' WHERE xt_language_key=? AND xt_logo=? ORDER BY xt_sort';
        $array = $database->selectArray($query, ['global', 0]);

        // If entries not exists.
        if (!$array) {
            return;
        }

        // Sort entries.
        for ($i = 0; $i < count($array); $i++) {
            $query = 'UPDATE appnetos__header_' . $this->appId . ' SET xt_sort=' . ($i + 1) . ' WHERE xt_id=?';
            $database->update($query, [$array[$i]['xt_id']]);
        }
    }

    /**
     * Get language name.
     *
     * @param string $key.
     * @return string.
     */
    public function getLanguageName($key)
    {
        $languages = objects::get('languages');
        return $languages->getName($key);
    }
}