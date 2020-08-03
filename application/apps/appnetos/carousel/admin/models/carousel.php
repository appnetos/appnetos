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
 * @description     APPNET OS Bootstrap carousel. Simply create a picture carousel via the app admin section.
 */

// Namespace.
namespace appnetos;

// Use.
use \core\objects;

// Model "appnetos\carousel".
class carousel
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
     * Settings as \stdClass.
     *
     * @var \stdClass.
     */
    public $settings = null;

    /**
     * If is error.
     *
     * @var bool
     */
    public $error = false;

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
     * Used controller "core\extensions".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * carousel constructor.
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
        if (!$this->error) {
            $this->initSettings();
        }

        // Process data and set settings.
        if (!$this->error) {
            $this->processData();
        }

        // Initialize.
        if (!$this->error) {
            $this->initList();
        }
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

        // Get and set used objects.
        $this->_extensions = objects::get('extensions');
    }

    /**
     * Initialize.
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
            $this->settings->random = true;
            $this->settings->indicators = true;
            $this->settings->controls = true;
            $this->settings->time = 5;
            $this->_extensions->set(json_encode($this->settings), 'text', $this->appId);
        }
    }

    /**
     * Initialize.
     */
    protected function initList()
    {
        // Get object "appnetos\carousel_list".
        $carousel_list = objects::getNew('appnetos/carousel_list');
        $carousel_list->init($this->appId);

        // Add object "appnetos/carousel_list" to object "core\objects" and object "core\render".
        objects::set('appnetos/carousel_list', $carousel_list);
        $render = objects::get('render');
        $render->assign('appnetos__carousel_list', $carousel_list);

        // Get last process message.
        $session = objects::get('session');
        $this->errorMsg = ($session->get('appnetos__carousel__errorMsg'));
        if ($this->errorMsg) {
            $session->delete('appnetos__carousel__errorMsg');
        }
        $this->confirmMsg = ($session->get('appnetos__carousel__confirmMsg'));
        if ($this->confirmMsg) {
            $session->delete('appnetos__carousel__confirmMsg');
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

        // Edit settings.
        if ($action === 'carousel__edit_settings') {
            $this->carouselEditSettings();
        }

        // Add entry.
        if ($action === "add") {
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
        if ($action === 'edit_image') {
            $this->editImage();
        }

        // Add language.
        if ($action === 'add_language') {
            $this->addLanguage();
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
     * Edit settings.
     */
    protected function carouselEditSettings()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $random = $post->get('carousel__random');
        $indicators = $post->get('carousel__indicators');
        $controls = $post->get('carousel__controls');
        $time = (int)trim($post->get('carousel__time'));

        // Check setting.
        if (!$time) {
            $this->redirect('appnetos__carousel__err_time');
        }

        // Set settings.
        if ($random === 'on') {
            $this->settings->random = true;
        }
        else {
            $this->settings->random = false;
        }
        if ($indicators === 'on') {
            $this->settings->indicators = true;
        }
        else {
            $this->settings->indicators = false;
        }
        if ($controls === 'on') {
            $this->settings->controls = true;
        }
        else {
            $this->settings->controls = false;
        }
        $this->settings->time = $time;

        // Save settings.
        $this->_extensions->set(json_encode($this->settings), 'text', $this->appId);

        // Redirect.
        $this->redirect(null, 'appnetos__carousel__settings_conf');
    }

    /**
     * Add entry.
     */
    protected function add()
    {
        // Prepare parameters.
        $img = '';
        $link = null;

        // Generate out folder
        $this->setOut();

        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get file.
        if (empty($_FILES['carousel__add_img']['name']) || empty($_FILES['carousel__add_img']['tmp_name'])) {
            $this->redirect('appnetos__carousel__err_file');
        }

        // Check image.
        if (isset($_FILES['carousel__add_img'])) {

            // Check file.
            $name = $_FILES['carousel__add_img']['name'];
            $parts = pathinfo($name);

            // If extension is wrong.
            if (!isset($parts['extension'])) {
                $this->redirect('appnetos__carousel__err_format');
            }

            // Set extension.
            $ext = $parts['extension'];

            // If extension is wrong.
            if ($ext !== 'png' && $ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'gif' && $ext !== 'svg') {
                $this->redirect('appnetos__carousel__err_format');
            }

            // If img exists.
            $img = $ext;
        }

        // Get link.
        $link = trim(str_replace(' ', '', $post->get('carousel__add_link')));

        // If link not exists.
        if (!$link) {
            $link = '';
        }

        // Insert into database table "appnetos__carousel".
        $query = 'INSERT INTO appnetos__carousel_' . $this->appId . ' (xt_parent_id, xt_language_key, xt_sort, xt_img, xt_link) VALUES (?,?,?,?,?)';
        $id = $database->insert($query, [0, 'global', 999999, $img, $link]);

        // Move uploaded file.
        if ($img !== '') {
            move_uploaded_file($_FILES['carousel__add_img']['tmp_name'], 'out/img/appnetos/carousel/' . $this->appId . '_' . $id . '.' . $img);
        }

        // Sort entries.
        $this->sort();

        // Redirect.
        $this->redirect(null, 'appnetos__carousel__add_conf');
    }

    /**
     * Edit entry.
     */
    protected function edit()
    {
        // Prepare parameters.
        $id = null;
        $link = null;

        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $id = (int)$post->get('carousel__edit_id');

        // If parameters wrong or not exists.
        if (!$id) {
            $this->redirect('appnetos__carousel__err_exists');
        }
        $link = trim(str_replace(' ', '', $post->get('carousel__edit_link')));

        // Select from database table 'appnetos__carousel'.
        $query = 'SELECT xt_id FROM appnetos__carousel_' . $this->appId . ' WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);
        if (!$row) {
            $this->redirect('appnetos__carousel__err_exists');
        }

        // Update database table "appnetos__carousel".
        $query = 'UPDATE appnetos__carousel_' . $this->appId . ' SET xt_link=? WHERE xt_id=?';
        $database->update($query, [$link, $row['xt_id']]);

        // Redirect.
        $this->redirect(null, 'appnetos__carousel__add_edit');
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
        $id = (int)$post->get('carousel__delete_id');

        // If parameters wrong or not exists.
        if (!$id) {
            $this->redirect('appnetos__carousel__err_exists');
        }

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_id, xt_parent_id, xt_img FROM appnetos__carousel_' . $this->appId . ' WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->redirect('appnetos__carousel__err_exists');
        }

        // Delete from database table "appnetos__carousel".
        $query = 'DELETE FROM appnetos__carousel_' . $this->appId . ' WHERE xt_id=?';
        $database->delete($query, [$id]);

        // Delete image file.
        if (file_exists('out/img/appnetos/carousel/' . $this->appId . '_' . $id . '.' . $row['xt_img'])) {
            unlink('out/img/appnetos/carousel/' . $this->appId . '_' . $id . '.' . $row['xt_img']);
        }

        // If is not parent.
        if ((int)$row['xt_parent_id'] !== 0) {
            $this->redirect(null, 'appnetos__carousel__del_conf');
        }

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_id FROM appnetos__carousel_' . $this->appId . ' WHERE xt_parent_id=?';
        $arr = $database->selectArray($query, [$id]);

        // If data not exists.
        if (!$arr) {
            $this->redirect(null, 'appnetos__carousel__del_conf');
        }

        // Delete children.
        for ($i = 0; $i < count($arr); $i++) {

            // Delete from database table "appnetos__carousel".
            $query = 'DELETE FROM appnetos__carousel_' . $this->appId . ' WHERE xt_id=?';
            $database->delete($query, [(int)$arr[$i]['xt_id']]);

            // Delete image file.
            if (file_exists('out/img/appnetos/carousel/' . $this->appId . '_' . (int)$arr[$i]['xt_id'] . '.' . $row['xt_img'])) {
                unlink('out/img/appnetos/carousel/' . $this->appId . '_' . (int)$arr[$i]['xt_id'] . '.' . $row['xt_img']);
            }
        }

        // Redirect.
        $this->redirect(null, 'appnetos__carousel__del_conf');
    }

    /**
     * Edit image.
     */
    protected function editImage()
    {
        // Generate out folder.
        $this->setOut();

        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $id = (int)$post->get('carousel__edit_image_id');

        // If parameters wrong or not exists.
        if (!$id) {
            $this->redirect('appnetos__carousel__err_exists');
        }

        // Select from database table "appnetos__header".
        $query = 'SELECT xt_id, xt_img FROM appnetos__carousel_' . $this->appId . ' WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->redirect('appnetos__carousel__err_exists');
        }

        // Set img old.
        $imgOld = $row['xt_img'];

        // If file not exists.
        if (!isset($_FILES['carousel__edit_image_img'])) {
            $this->redirect('appnetos__carousel__err_format');
        }
        // Get file.
        if (empty($_FILES['carousel__edit_image_img']['name']) || empty($_FILES['carousel__edit_image_img']['tmp_name'])) {
            $this->redirect('appnetos__carousel__err_file');
        }
        $name = $_FILES['carousel__edit_image_img']['name'];
        if (!$name) {
            $this->redirect('appnetos__carousel__err_format');
        }
        $parts = pathinfo($name);

        // If file is wrong.
        if (!isset($parts['extension'])) {
            $this->redirect('appnetos__carousel__err_format');
        }

        // Set extension.
        $ext = $parts['extension'];

        // If file is wrong.
        if ($ext !== 'png' && $ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'gif' && $ext !== 'svg') {
            $this->redirect('appnetos__carousel__err_format');
        }

        // Set img.
        $img = $ext;

        // Move uploaded file.
        if (file_exists('out/img/appnetos/carousel/' . $this->appId . '_' . $id . '.' . $imgOld)) {
            unlink('out/img/appnetos/carousel/' . $this->appId . '_' . $id . '.' . $imgOld);
        }
        move_uploaded_file($_FILES['carousel__edit_image_img']['tmp_name'], 'out/img/appnetos/carousel/' . $this->appId . '_' . $id . '.' . $img);

        // Update database table 'appnetos__carousel'.
        $query = 'UPDATE appnetos__carousel_' . $this->appId . ' SET xt_img=? WHERE xt_id=?';
        $database->update($query, [$img, $id]);

        // Redirect.
        $this->redirect(null, 'appnetos__carousel__img_conf');
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
        $id = (int)$post->get('carousel__add_language_id');
        $languageKey = $post->get('carousel__add_language_key');

        // If parameters wrong or not exists.
        if (!$id) {
            $this->redirect('appnetos__carousel__err_exists');
        }
        if (!$languageKey || $languageKey === '' || $languageKey === 'global') {
            $this->redirect('appnetos__carousel__err_lang');
        }

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_id FROM appnetos__carousel_' . $this->appId . ' WHERE xt_id=?';
        $row = $database->selectRow($query, [$id]);

        // If data not exists.
        if (!$row) {
            $this->redirect('appnetos__carousel__err_exists');
        }

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_language_key FROM appnetos__carousel_' . $this->appId . ' WHERE xt_parent_id=?';
        $array = $database->selectArray($query, [$id]);

        // If children already is set.
        if ($array) {
            for ($i = 0; $i < count($array); $i++) {
                if ($array[$i]['xt_language_key'] === $languageKey) {
                    $this->redirect('appnetos__carousel__err_lang');
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
            $this->redirect('appnetos__carousel__err_lang');
        }

        // Check img file.
        if (isset($_FILES['carousel__add_language_img'])) {
            $name = $_FILES['carousel__add_language_img']['name'];
            $parts = pathinfo($name);

            // If img is wrong.
            if (!isset($parts['extension'])) {
                $this->redirect('appnetos__carousel__err_format');
            }

            // Set parts.
            $ext = $parts['extension'];

            // If img is wrong.
            if ($ext !== 'png' && $ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'gif' && $ext !== 'svg') {
                $this->redirect('appnetos__carousel__err_format');
            }

            // Set img.
            $img = $ext;
        }

        // Insert into database table "appnetos__carousel".
        $query = 'INSERT INTO appnetos__carousel_' . $this->appId . ' (xt_parent_id, xt_language_key, xt_sort, xt_img, xt_link) VALUES (?,?,?,?,?)';
        $id = $database->insert($query, [$id, $languageKey, 0, $img, '']);

        // Move uploaded file.
        if ($img !== '') {
            move_uploaded_file($_FILES['carousel__add_language_img']['tmp_name'], 'out/img/appnetos/carousel/' . $this->appId . '_' . $id . '.' . $img);
        }

        // Redirect.
        $this->redirect(null, 'appnetos__carousel__add_lang_conf');
    }

    /**
     * move up
     */
    protected function moveUp()
    {
        // Get objects "core\post" and "core\database".
        $post = objects::get('post');
        $database = objects::get('database');

        // Get POST parameters.
        $sort = $post->get('carousel__sort');

        // If sort not exists.
        if(!$sort) {
            $this->redirect('appnetos__carousel__err_move');
        }

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_id FROM appnetos__carousel_' . $this->appId . ' WHERE xt_sort=?';
        $row = $database->selectRow($query, [$sort]);

        // If entry not exists.
        if (!$row) {
            $this->redirect('appnetos__carousel__err_move');
        }

        // Prepare parameters.
        $id1 = $row['xt_id'];
        $sort1 = $sort;

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_id FROM appnetos__carousel_' . $this->appId . ' WHERE xt_sort=?';
        $row = $database->selectRow($query, [($sort - 1)]);

        // If entry not exists.
        if (!$row) {
            $this->redirect('appnetos__carousel__err_move');
        }

        // Prepare parameters.
        $id2 = $row['xt_id'];
        $sort2 = $sort - 1;

        // If parameters not exists.
        if (!$id1 || !$id2) {
            $this->redirect('appnetos__carousel__err_move');
        }

        // Switch entries.
        $this->switchEntries($id1, $id2, $sort1, $sort2);

        // Redirect.
        $this->redirect(null, 'appnetos__carousel__move_conf');
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
        $sort = $post->get('carousel__sort');

        // If sort not exists
        if (!$sort) {
            $this->redirect('appnetos__carousel__err_move');
        }

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_id FROM appnetos__carousel_' . $this->appId . ' WHERE xt_sort=?';
        $row = $database->selectRow($query, [$sort]);

        // If data not exists.
        if(!$row) {
            $this->redirect('appnetos__carousel__err_move');
        }

        // Prepare parameters.
        $id1 = $row['xt_id'];
        $sort1 = $sort;

        // Select from database table "appnetos__carousel".
        $query = 'SELECT xt_id FROM appnetos__carousel_' . $this->appId . ' WHERE xt_sort=?';
        $row = $database->selectRow($query, [($sort + 1)]);

        // If entry not exists.
        if(!$row) {
            $this->redirect('appnetos__carousel__err_move');
        }

        // Prepare parameters.
        $id2 = $row['xt_id'];
        $sort2 = $sort + 1;

        // If parameters not exists.
        if (!$id1 || !$id2) {
            $this->redirect('appnetos__carousel__err_move');
        }

        // Switch entries.
        $this->switchEntries($id1, $id2, $sort1, $sort2);

        // Redirect.
        $this->redirect(null, 'appnetos__carousel__move_conf');
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

        // Update database table "appnetos__carousel".
        $query = 'UPDATE appnetos__carousel_' . $this->appId . ' SET xt_sort=? WHERE xt_id=?';
        $database->update($query, [$sort1, $id2]);
        $query = 'UPDATE appnetos__carousel_' . $this->appId . ' SET xt_sort=? WHERE xt_id=?';
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
            $session->set('appnetos__carousel__errorMsg', $strings->get($errorMsg));
        }
        if ($confirmMsg) {
            $session->set('appnetos__carousel__confirmMsg', $strings->get($confirmMsg));
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
        if (!is_dir('out/img/appnetos/carousel')) {
            mkdir('out/img/appnetos/carousel');
        }
    }

    /**
     * Sort images.
     */
    protected function sort()
    {
        // Select from database entry "appnetos__carousel".
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM appnetos__carousel_' . $this->appId . ' WHERE xt_sort>0 ORDER BY xt_sort';
        $array = $database->selectArray($query);

        // If entries not exists.
        if (!$array) {
            return;
        }

        // Sort entries.
        for ($i = 0; $i < count($array); $i++) {
            $query = 'UPDATE appnetos__carousel_' . $this->appId . '  SET xt_sort=? WHERE xt_id=?';
            $database->update($query, [($i + 1), $array[$i]['xt_id']]);
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