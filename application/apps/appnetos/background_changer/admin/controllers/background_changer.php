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
     * App ID.
     *
     * @var int
     */
    public $appId = null;

    /**
     * Images.
     *
     * @var array.
     */
    public $images = [];

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
     * Used object "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * Used object "core\post".
     *
     * @var object.
     */
    protected $_post = null;

    /**
     * Used object "core\strings".
     *
     * @var object.
     */
    protected $_strings = null;

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
        $this->_extensions = objects::get('extensions');
        $this->_post = objects::get('post');
        $this->_strings = objects::get('strings');

        // Get app ID by object "core\objects".
        $this->appId = objects::getApp('appnetos/background_changer')->getId();

        // Get last process message.
        $session = objects::get('session');
        $this->errorMsg = ($session->get('appnetos__background_changer__errorMsg'));
        if ($this->errorMsg) {
            $session->delete('appnetos__background_changer__errorMsg');
        }
        $this->confirmMsg = ($session->get('appnetos__background_changer__confirmMsg'));
        if ($this->confirmMsg) {
            $session->delete('appnetos__background_changer__confirmMsg');
        }

        // Get images.
        $images = $this->_extensions->get('text', $this->appId, 'appnetos/background_changer');

        // If images exists.
        if ($images) {
            $decode = json_decode($images, true);
            foreach ($decode as $value) {
                $backgroundChangerImage = objects::getNew('appnetos/background_changer__image');
                $backgroundChangerImage->id = $value['id'];
                $backgroundChangerImage->image = $value['image'];
                $backgroundChangerImage->color = $value['color'];
                $backgroundChangerImage->repeat = $value['repeat'];
                $backgroundChangerImage->width = $value['width'];
                $backgroundChangerImage->height = $value['height'];
                $this->images[] = $backgroundChangerImage;
            }
        }

        // If images not exists.
        else {
            $this->set();
        }

        // Process data.
        $this->processData();
    }

    /**
     * Set images.
     */
    protected function set()
    {
        // Get app ID by object "core\objects".
        $this->_extensions->set(json_encode($this->images), 'text', $this->appId, 'appnetos/background_changer');
    }

    /**
     * Process data.
     *
     * @throws \core\exception.
     */
    protected function processData()
    {
        // Get POST parameters.
        $action = $this->_post->get('action');

        // Add image.
        if ($action === 'add') {
            $this->add();
        }

        // Delete image.
        elseif ($action === 'delete') {
            $this->delete();
        }

        // Edit image.
        elseif ($action === 'edit') {
            $this->edit();
        }
    }

    /**
     * Add image.
     *
     * @throws \core\exception.
     */
    protected function add()
    {
        // Prepare parameters.
        $image = null;
        $color = null;
        $repeat = 'no-repeat';
        $width = null;
        $height = null;

        // Get file.
        if (!empty($_FILES['add_image']['name']) && !empty($_FILES['add_image']['tmp_name'])) {

            // Check file.
            $name = $_FILES['add_image']['name'];
            $parts = pathinfo($name);

            // If extension is wrong.
            if (!isset($parts['extension'])) {
                $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_format');
            }

            // If extension not is wrong.
            else {

                // Set extension.
                $ext = $parts['extension'];

                // If extension is wrong.
                if ($ext !== 'png' && $ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'gif' && $ext !== 'svg') {
                    $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_format');
                }

                // If extension not is wrong.
                else {

                    // If img exists.
                    $image = $ext;
                }
            }
        }

        // Get color.
        if (!$this->errorMsg) {
            $color = trim($this->_post->get('add_color'));
            if (!$color || $color === '#') {
                $color = null;
            }
            else {
                if(!preg_match('/^#[a-f0-9]{6}$/i', $color)) {
                    $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_color');
                }
            }
        }

        // Check if image or color available.
        if (!$this->errorMsg) {
            if (!$image && !$color) {
                $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_image_or_color');
            }
        }

        // Check repeat.
        if (!$this->errorMsg) {
            $repeat = $this->_post->get('add_repeat');
        }

        // Check width.
        if (!$this->errorMsg) {
            $width = trim($this->_post->get('add_width'));
            if (!$width) {
                $width = null;
            }
            else {
                if (is_numeric($width)) {
                    $width = $width . 'px';
                }
                else {
                    $width = str_replace(' ', '', $width);
                    if (substr($width, -1) === '%') {
                        if (!is_numeric(substr($width, 0, -1))) {
                            $width = null;
                        }
                    }
                    elseif (substr($width, -2) === 'px') {
                        if (!is_numeric(substr($width, 0, -2))) {
                            $width = null;
                        }
                    }
                    else {
                        $width = null;
                    }
                }
            }
        }

        // Check height.
        if (!$this->errorMsg) {
            $height = trim($this->_post->get('add_height'));
            if (!$height) {
                $height = null;
            }
            else {
                if (is_numeric($height)) {
                    $height = $height . 'px';
                }
                else {
                    $height = str_replace(' ', '', $height);
                    if (substr($height, -1) === '%') {
                        if (!is_numeric(substr($height, 0, -1))) {
                            $height = null;
                        }
                    }
                    elseif (substr($height, -2) === 'px') {
                        if (!is_numeric(substr($height, 0, -2))) {
                            $height = null;
                        }
                    }
                    else {
                        $height = null;
                    }
                }
            }
        }

        // Set new image.
        if (!$this->errorMsg) {
            $id = $this->generateId();
            if ($image) {
                if (!is_dir('out')) {
                    mkdir('out');
                }
                if (!is_dir('out/img')) {
                    mkdir('out/img');
                }
                if (!is_dir('out/img/appnetos')) {
                    mkdir('out/img/appnetos');
                }
                if (!is_dir('out/img/appnetos/background_changer')) {
                    mkdir('out/img/appnetos/background_changer');
                }
                move_uploaded_file($_FILES['add_image']['tmp_name'], 'out/img/appnetos/background_changer/' . $this->appId . '_' . $id . '.' . $image);
            }
            $backgroundChangerImage = objects::getNew('appnetos/background_changer__image');
            $backgroundChangerImage->id = $id;
            $backgroundChangerImage->image = $image;
            $backgroundChangerImage->color = $color;
            $backgroundChangerImage->repeat = $repeat;
            $backgroundChangerImage->width = $width;
            $backgroundChangerImage->height = $height;
            $this->images[] = $backgroundChangerImage;
            $this->set();
            $this->confirmMsg = $this->_strings->get('appnetos__background_changer__conf_add');
        }

        // Redirect.
        $this->redirect();
    }

    /**
     * Edit image.
     *
     * @throws \core\exception.
     */
    protected function edit()
    {
        // Prepare parameters.
        $backgroundChangerModel = null;
        $image = null;
        $deleteImage = false;
        $color = null;
        $repeat = 'no-repeat';
        $width = null;
        $height = null;
        $editImage = false;

        // Get ID.
        $id = $this->_post->get('edit_id');
        if ($id) {
            foreach ($this->images as $value) {
                if ($value->id === $id) {
                    $image = $value->image;
                    $color = $value->color;
                    $repeat = $value->repeat;
                    $width = $value->width;
                    $height = $value->height;
                    $backgroundChangerModel = $value;
                    break;
                }
            }
        }
        if (!$backgroundChangerModel) {
            $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_edit');
        }

        // Get if delete image.
        if (!$this->errorMsg) {
            $deleteImageRaw = $this->_post->get('edit_delete_image');
            if ($deleteImageRaw === 'on') {
                $deleteImage = true;
                $image = null;
            }
        }

        // Get file.
        if (!$this->errorMsg && !$deleteImage) {
            if (!empty($_FILES['edit_image']['name']) && !empty($_FILES['edit_image']['tmp_name'])) {

                // Check file.
                $name = $_FILES['edit_image']['name'];
                $parts = pathinfo($name);

                // If extension is wrong.
                if (!isset($parts['extension'])) {
                    $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_format');
                }

                // If extension not is wrong.
                else {

                    // Set extension.
                    $ext = $parts['extension'];

                    // If extension is wrong.
                    if ($ext !== 'png' && $ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'gif' && $ext !== 'svg') {
                        $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_format');
                    } // If extension not is wrong.
                    else {

                        // If img exists.
                        $image = $ext;
                        $editImage = true;
                    }
                }
            }
        }

        // Get color.
        if (!$this->errorMsg) {
            $color = trim($this->_post->get('edit_color'));
            if (!$color || $color === '#') {
                $color = null;
            }
            else {
                if(!preg_match('/^#[a-f0-9]{6}$/i', $color)) {
                    $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_color');
                }
            }
        }

        // Check if image or color available.
        if (!$this->errorMsg) {
            if (!$image && !$color) {
                $this->errorMsg = $this->_strings->get('appnetos__background_changer__err_image_or_color');
            }
        }

        // Check repeat.
        if (!$this->errorMsg) {
            $repeat = $this->_post->get('edit_repeat');
        }

        // Check width.
        if (!$this->errorMsg) {
            $width = trim($this->_post->get('edit_width'));
            if (!$width) {
                $width = null;
            }
            else {
                if (is_numeric($width)) {
                    $width = $width . 'px';
                }
                else {
                    $width = str_replace(' ', '', $width);
                    if (substr($width, -1) === '%') {
                        if (!is_numeric(substr($width, 0, -1))) {
                            $width = null;
                        }
                    }
                    elseif (substr($width, -2) === 'px') {
                        if (!is_numeric(substr($width, 0, -2))) {
                            $width = null;
                        }
                    }
                    else {
                        $width = null;
                    }
                }
            }
        }

        // Check height.
        if (!$this->errorMsg) {
            $height = trim($this->_post->get('edit_height'));
            if (!$height) {
                $height = null;
            }
            else {
                if (is_numeric($height)) {
                    $height = $height . 'px';
                }
                else {
                    $height = str_replace(' ', '', $height);
                    if (substr($height, -1) === '%') {
                        if (!is_numeric(substr($height, 0, -1))) {
                            $height = null;
                        }
                    }
                    elseif (substr($height, -2) === 'px') {
                        if (!is_numeric(substr($height, 0, -2))) {
                            $height = null;
                        }
                    }
                    else {
                        $height = null;
                    }
                }
            }
        }

        // Set new image.
        if (!$this->errorMsg) {
            $images = [];
            foreach ($this->images as $value) {
                if ($value->id === $id) {
                    if ($editImage || $deleteImage) {
                        if (file_exists('out/img/appnetos/background_changer/' . $this->appId . '_' . $id . '.' . $image)) {
                            unlink('out/img/appnetos/background_changer/' . $this->appId . '_' . $id . '.' . $image);
                        }
                    }
                    if ($editImage) {
                        if (!is_dir('out')) {
                            mkdir('out');
                        }
                        if (!is_dir('out/img')) {
                            mkdir('out/img');
                        }
                        if (!is_dir('out/img/appnetos')) {
                            mkdir('out/img/appnetos');
                        }
                        if (!is_dir('out/img/appnetos/background_changer')) {
                            mkdir('out/img/appnetos/background_changer');
                        }
                        move_uploaded_file($_FILES['edit_image']['tmp_name'], 'out/img/appnetos/background_changer/' . $this->appId . '_' . $id . '.' . $image);
                        $value->image = $image;
                    }
                    if ($deleteImage) {
                        $value->image = null;
                    }
                    $value->color = $color;
                    $value->repeat = $repeat;
                    $value->width = $width;
                    $value->height = $height;
                }
                $images[] = $value;
            }
            $this->images = $images;
            $this->set();
            $this->confirmMsg = $this->_strings->get('appnetos__background_changer__conf_edit');
        }

        // Redirect.
        $this->redirect();
    }

    /**
     * Delete image.
     *
     * @throws \core\exception.
     */
    protected function delete()
    {
         $images = [];
         $id = $this->_post->get('delete_id');
         foreach ($this->images as $image) {
             if ($image->id === $id) {
                 if (file_exists('out/img/appnetos/background_changer/' . $this->appId . '_' . $id . '.' . $image->image)) {
                     unlink('out/img/appnetos/background_changer/' . $this->appId . '_' . $id . '.' . $image->image);
                 }
             }
             else {
                 $images[] = $image;
             }
         }
         $this->images = $images;
         $this->set();
         $this->confirmMsg = $this->_strings->get('appnetos__background_changer__conf_delete');
         $this->redirect();
    }

    /**
     * Set message and redirect.
     *
     * @throws \core\exception.
     */
    protected function redirect()
    {
        // Get objects.
        $session = objects::get('session');

        // Set messages.
        if ($this->errorMsg) {
            $session->set('appnetos__background_changer__errorMsg', $this->errorMsg);
        }
        if ($this->confirmMsg) {
            $session->set('appnetos__background_changer__confirmMsg', $this->confirmMsg);
        }

        // Redirect.
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    /**
     * Generate ID.
     *
     * @return string.
     */
    protected function generateId()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $token = '';
        for ($i = 0; $i < 32; $i++) {
            $token .= $characters[rand(0, $charactersLength - 1)];
        }
        return $token;
    }
}