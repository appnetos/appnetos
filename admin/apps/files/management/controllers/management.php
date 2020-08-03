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
 * @description     Admin files management. Create and delete folders. Upload and delete files. The folders to manage
 *                  files in the files manager must be defined in the config.inc.php.
 */

// Namespace.
namespace admin\files;

// Use.
use \core\objects;

// Controller "admin\files\management".
class management
{

    /**
     * Array of registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = [
        'openDirectory',
        'closeDirectory',
        'show',
        'delete',
        'renameDirectory',
        'renameFile',
        'addDirectory',
        'deleteDirectory',
        'sync'
    ];

    /**
     * Directories list template.
     *
     * @var string.
     */
    protected $tplDirectories = 'admin/apps/files/management/views/directories.tpl';

    /**
     * Files list template.
     *
     * @var string.
     */
    protected $tplList = 'admin/apps/files/management/views/list.tpl';

    /**
     * Files manager allowed directories.
     *
     * @var array.
     */
    public $filesDirectories = [];

    /**
     * File manager allowed file types.
     *
     * @var array.
     */
    protected $filesTypes = [];

    /**
     * Settings as array.
     *
     * @var array.
     */
    protected $settings = [];

    /**
     * Directories as \stdClass.
     *
     * @var \stdClass.
     */
    protected $directories = null;

    /**
     * Files as array.
     *
     * @var array.
     */
    public $files = [];

    /**
     * File path.
     *
     * @var string.
     */
    public $path = null;

    /**
     * Error message for AJAX request.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * Confirm massage for AJAX request.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     *  Used model "core\config".
     *
     * @var object.
     */
    public $_config = null;

    /** Used controller "core\extensions.
     *
     * @var object.
     */
    public $_extensions = null;

    /**
     * install constructor.
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
        // POST file upload.
        if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {
            $this->postUpload();
            return;
        }

        // Get and set used data.
        $this->getSet();

        // Get and set directories.
        $this->getSetDirectories();

        // Initialize directories.
        $this->initDirectories();

        // Set used scripts.
        $this->SetScripts();
    }

    /**
     * Get and set used data.
     */
    protected function getSet()
    {
        // Get and set used objects.
        $this->_config = objects::get('config');
        $this->_extensions = objects::get('extensions');

        // Get data from model "core\config".
        $this->filesDirectories = $this->_config->getFilesDirectories();
        $this->filesTypes = $this->_config->getFilesTypes();

        // Prepare parameters.
        for ($i = 0; $i < count($this->filesDirectories); $i++) {
            $this->filesDirectories[$i] = trim($this->filesDirectories[$i], '/');
        }
    }

    /**
     * Get and set directories.
     */
    protected function getSetDirectories()
    {
        // Set new \stdClass.
        $this->directories = new \stdClass();

        // Get extension settings.
        $settings = $this->_extensions->get('text', 1, 'appnetos/files/settings');
        if (!$settings) {
            $this->settings = $this->filesDirectories;
            $this->_extensions->set(json_encode($this->settings), 'text', 1, 'appnetos/files/settings');
        }
        else {
            $this->settings = json_decode($settings);
        }

        // Compare settings with directories.
        if (array_diff($this->settings, $this->filesDirectories)) {
            return $this->setDirectories();
        }

        // Get extension directories.
        $directories = $this->_extensions->get('text', 1, 'appnetos/files/directories');

        // If extension directories exists.
        if ($directories) {

            // Set directories.
            $this->directories = json_decode($directories);
            foreach($this->filesDirectories as $directory) {
                if (!isset($this->directories->{$directory})) {
                    return $this->setDirectories();
                }
            }
        }

        // If directories not exists.
        else {
            $this->setDirectories();
        }
    }

    /**
     * Set directories
     */
    protected function setDirectories()
    {
        // Set directories and files as new \stdClass.
        $this->directories = new \stdClass();

        // Sort files directories.
        $new = [];
        foreach ($this->filesDirectories as $directory) {
            $set = true;
            for ($i = 0; $i < count($new); $i++) {
                if (strpos($new[$i], $directory) === 0) {
                    $new[$i] = $directory;
                    $set = false;
                    break;
                }
                if (strpos($directory, $new[$i]) === 0) {
                    $set = false;
                    break;
                }
            }
            if ($set) array_push($new, $directory);
        }

        // Add directory to directories as \stdClass.
        foreach ($new as $directory) {
            $subDirectories = explode('/', $directory);
            $newDirectory = new \stdClass;
            $newDirectory->path = $directory;
            $newDirectory->name = end($subDirectories);
            $newDirectory->open = false;
            $newDirectory->deep = 0;
            $newDirectory->parentOpen = true;
            $newDirectory->hasSubDirectories = false;
            $this->directories->{$directory} = $newDirectory;
        }

        // Set settings by object core extensions.
        $this->_extensions->set(json_encode($this->directories), 'text', 1, 'appnetos/files/directories');
    }

    /**
     * Initialize directories.
     */
    protected function initDirectories()
    {
        // Get all sub directories.
        $directories = (array)$this->directories;
        foreach ($directories as $directory) {

            // If directory not exists.
            if (!isset($directory->path)) {
                return $this->setDirectories();
            }
            if ($directory->path === '') {
                return $this->setDirectories();
            }

            // Initialize sub directories.
            $hasSubDirectories = $this->initSubDirectories($directory);
            if (!isset($this->directories->{$directory->path})) {
                $this->directories->{$directory->path} = new \stdClass();
            }
            if ($hasSubDirectories) {
                $this->directories->{$directory->path}->hasSubDirectories = true;
            }
            else {
                $this->directories->{$directory->path}->hasSubDirectories = false;
            }
        }

        // Set directories by object core extensions.
        $this->_extensions->set(json_encode($this->directories), 'text', 1, 'appnetos/files/directories');
    }

    /**
     * Recursively get sub directories.
     *
     * @var \stdClass $directory.
     * @return bool.
     */
    protected function initSubDirectories($directory)
    {
        // If directory not exists.
        if (!is_dir($directory->path)) {
            if (isset($this->directories->{$directory->path})) {
                unset($this->directories->{$directory->path});
            }
            return false;
        }

        // Get all sub directories.
        $subDirectories = array_filter(glob($directory->path . '/*'), 'is_dir');

        // If no sub directories.
        if (!count($subDirectories)) {
            return false;
        }

        // Go through all sub directories.
        foreach ($subDirectories as $subDirectory) {

            // Prepare parameters.
            $path = str_replace([" //", "\\"], "/", $subDirectory);
            $path = trim($path, '/');
            $array = explode('/', $path);
            $name = end($array);
            $deep = $directory->deep + 1;
            $parentOpen = $directory->open;

            // If directory is set.
            if (isset($this->directories->{$path})) {
                $this->directories->{$path}->parentOpen = $parentOpen;
            }

            // If directory not is set.
            else {
                $new = new \stdClass();
                $new->path = $path;
                $new->name = $name;
                $new->open = false;
                $new->parentOpen = $parentOpen;
                $new->deep = $deep;
                $new->hasSubDirectories = false;
                $this->directories->{$path} = $new;
            }

            // Get all sub directories.
            $hasSubdirectories = $this->initSubDirectories($this->directories->{$path});
            if ($hasSubdirectories) {
                $this->directories->{$path}->hasSubDirectories = true;
            }
            else {
                $this->directories->{$path}->hasSubDirectories = false;
            }
        }

        // Return.
        return true;
    }

    /**
     * Set used scripts.
     */
    protected function setScripts()
    {
        // Set used scripts and styles.
        $js = objects::get('js');
        $render = objects::get('render');
        $js->add($render->getUrl() . '/out/admin/js/libs/jquery.knob.js');
        $js->add($render->getUrl() . '/out/admin/js/libs/jquery.ui.widget.js');
        $js->add($render->getUrl() . '/out/admin/js/libs/jquery.iframe-transport.js');
        $js->add($render->getUrl() . '/out/admin/js/libs/jquery.fileupload.js');
    }

    /**
     * AJAX request to open directory.
     */
    public function openDirectory()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $path = strip_tags(trim($post->get('path')));

        // If path not isset.
        if (!$path || $path === '') {
            return;
        }

        // Set directory to open.
        if (isset($this->directories->{$path})) {
            $this->directories->{$path}->open = true;
        }

        // Initialize directories.
        $this->initDirectories();

        // Render AJAX template.
        $this->renderAjax($this->tplDirectories);
    }

    /**
     * AJAX request to close directory.
     */
    public function closeDirectory()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $path = strip_tags(trim($post->get('path')));

        // If path not isset.
        if (!$path || $path === '') {
            return;
        }

        // Set directory to open.
        $directories = (array)$this->directories;
        $this->directories->{$path}->open = false;
        $this->directories->{$path}->parentOpen = true;
        foreach ($directories as $directory) {
            if ($directory->path !== $path) {
                if (strpos($directory->path, $path) === 0) {
                    $this->directories->{$directory->path}->open = false;
                    $this->directories->{$directory->path}->parentOpen = false;
                }
            }
        }

        // Initialize directories.
        $this->initDirectories();

        // Render AJAX template.
        $this->renderAjax($this->tplDirectories);
    }

    /**
     * AJAX request to show content.
     *
     * @param $path.
     * @throws.
     */
    public function show($path = null)
    {
        // Get POST parameters.
        $post = objects::get('post');
        if (!$path) {
            $path = strip_tags(trim($post->get('path')));
        }

        // If directory not exists.
        if (!is_dir($path)) {
            return;
        }

        // Set parameters.
        $files = array_filter(glob($path . '/*'), 'is_file');
        $files = json_decode(json_encode($files), true);

        // If directory not exists.
        if (!isset($this->directories->{$path})) {
            return;
        }

        // Set files.
        $this->path = $path;
        foreach ($files as $key => $value) {
            $value = str_replace(['\\', '//'], '/', $value);
            $array = explode('/', $value);
            $file = end($array);
            array_push($this->files, $file);
        }

        // Render AJAX template.
        $this->renderAjax($this->tplList);
    }

    /**
     * AJAX request synchronize directories.
     */
    public function sync()
    {
        // Prepare parameter.
        $this->getSet();
        $this->setDirectories();
        $this->init();

        // Render AJAX template.
        $this->renderAjax($this->tplDirectories);
    }

    /**
     * AJAX request delete file.
     */
    public function delete()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $path = strip_tags(trim($post->get('path')));

        // Prepare parameter.
        $strings = objects::get('strings');
        $files = $post->get('files');
        $this->getSet();
        $this->getSetDirectories();
        $this->initDirectories();

        // If parameters not exists.
        if (!$path || !$files) {
            $this->ajaxError = $strings->get('admin__files__mgnt__delete_err');
            $this->show();
            return;
        }

        // If directory not exists.
        if (!isset($this->directories->{$path})) {
            $this->ajaxError = $strings->get('admin__files__mgnt__err_path');
            $this->show();
            return;
        }

        // If files not an array.
        if (!is_array($files)) {
            $this->ajaxError = $strings->get('admin__files__mgnt__delete_err');
            $this->show();
            return;
        }

        // Delete all files.
        foreach ($files as $file) {

            // If file exists.
            if (file_exists($path . '/' . $file)) {
                unlink($path . '/' . $file);
                $this->ajaxConfirm = $strings->get('admin__files__mgnt__delete_conf');
            }

            // If file not exists.
            else {
                $this->ajaxError = $strings->get('admin__files__mgnt__delete_warn');
            }
        }
        $this->show();
    }

    /**
     * AJAX request rename file.
     */
    public function renameFile()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $path = strip_tags(trim($post->get('path')));
        $oldName = strip_tags(trim($post->get('oldName')));
        $newName = strip_tags(trim($post->get('newName')));

        // Prepare parameter.
        $strings = objects::get('strings');
        $this->getSet();
        $this->getSetDirectories();
        $this->initDirectories();

        // If parameters not exists.
        if (!$path || !$oldName || !$newName) {
            $this->ajaxError = $strings->get('admin__files__mgnt__file_rename_err');
            $this->show();
            return;
        }

        // If directory not exists.
        if (!isset($this->directories->{$path})) {
            $this->ajaxError = $strings->get('admin__files__mgnt__err_path');
            $this->show();
            return;
        }

        // If file not exists.
        if (!file_exists($path . '/' . $oldName)) {
            $this->ajaxError = $strings->get('admin__files__mgnt__file_rename_err');
            $this->show();
            return;
        }

        // If already a file exists with the new name.
        if (file_exists($path . '/' . $newName)) {
            $this->ajaxError = $strings->get('admin__files__mgnt__file_rename_err_ex');
            $this->show();
            return;
        }

        // Rename file.
        if (rename($path . '/' . $oldName, $path . '/' . $newName)) {
            $this->ajaxConfirm = $strings->get('admin__files__mgnt__file_rename_conf');
        }
        else {
            $this->ajaxError = $strings->get('admin__files__mgnt__file_rename_err');
        }

        // Render list.
        $this->show();
    }

    /**
     * AJAX request rename directory.
     */
    public function renameDirectory()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $path = strip_tags(trim($post->get('path')));
        $oldName = strip_tags(trim($post->get('oldName')));
        $newName = strip_tags(trim($post->get('newName')));

        // Prepare parameter.
        $strings = objects::get('strings');
        $this->getSet();
        $this->getSetDirectories();
        $this->initDirectories();

        // If parameters not exists.
        if (!$path || !$oldName || !$newName) {
            $this->ajaxError = $strings->get('admin__files__mgnt__directory_rename_err');
            $this->show();
            return;
        }

        // If directory not exists.
        if (!isset($this->directories->{$path})) {
            $this->ajaxError = $strings->get('admin__files__mgnt__err_path');
            $this->show();
            return;
        }

        // Prepare parameters.
        $array = explode('/', $path);
        $array[count($array) - 1] = $newName;
        $newPath = implode('/', $array);
        $array[count($array) - 1] = $oldName;
        $oldPath = implode('/', $array);

        // If old name not match with path.
        if ($oldPath !== $path) {
            $this->ajaxError = $strings->get('admin__files__mgnt__directory_rename_err');
            $this->show();
            return;
        }

        // If is root directory.
        foreach ($this->filesDirectories as $directory) {
            if ($directory === $oldPath) {
                $this->ajaxError = $strings->get('admin__files__mgnt__dir_rename_err_root');
                $this->show();
                return;
            }
        }
        if ($this->recursivelyCheckRoot($oldPath)) {
            $this->ajaxError = $strings->get('admin__files__mgnt__dir_rename_err_root');
            $this->show();
            return;
        }

        // If already a directory exists with the new name.
        if (is_dir($newPath)) {
            $this->ajaxError = $strings->get('admin__files__mgnt__dir_rename_err_ex');
            $this->show();
            return;
        }

        // Rename directories.
        if (rename($oldPath, $newPath)) {
            $directories = (array)$this->directories;
            foreach ($directories as $directory) {
                if (strpos($directory->path, $oldPath) === 0) {
                    $json = json_encode($directory);
                    $new = json_decode($json);
                    $new->path = substr_replace($new->path, $newPath, 0, strlen($oldPath));
                    if ($directory->path === $oldPath && $directory->name === $oldName) {
                        $new->name = $newName;
                    }
                    unset($this->directories->{$directory->path});
                    $this->directories->{$new->path} = $new;
                }
            }
            $this->_extensions->set(json_encode($this->directories), 'text', 1, 'appnetos/files/directories');
            $this->ajaxConfirm = $strings->get('admin__files__mgnt__directory_rename_conf');
        }
        else {
            $this->ajaxError = $strings->get('admin__files__mgnt__directory_rename_err');
        }

        // Render list.
        $this->show($newPath);
    }

    /**
     * AJAX request add directory.
     */
    public function addDirectory()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $path = strip_tags(trim($post->get('path')));
        $name = strip_tags(trim($post->get('name')));

        // Prepare parameter.
        $strings = objects::get('strings');
        $this->getSet();
        $this->getSetDirectories();
        $this->initDirectories();

        // If parameters not exists.
        if (!$path || !$name) {
            $this->ajaxError = $strings->get('admin__files__mgnt__add_dir_err');
            $this->show();
            return;
        }

        // If directory not exists.
        if (!isset($this->directories->{$path})) {
            $this->ajaxError = $strings->get('admin__files__mgnt__err_path');
            $this->show();
            return;
        }

        // If directory already exists.
        if(is_dir($path . '/' . $name)) {
            $this->ajaxError = $strings->get('admin__files__mgnt__add_dir_err_exists');
            $this->show();
            return;
        }

        // Add directory.
        if (mkdir($path . '/' . $name)) {
            $new = new \stdClass();
            $new->path = $path . '/' . $name;
            $new->name = $name;
            $new->open = false;
            $new->deep = $this->directories->{$path}->deep + 1;
            $new->parentOpen = true;
            $new->hasSubDirectories = false;
            $this->directories->{$path . '/' . $name} = $new;
            $this->_extensions->set(json_encode($this->directories), 'text', 1, 'appnetos/files/directories');
            $this->ajaxConfirm = $strings->get('admin__files__mgnt__add_dir_conf');
        }
        else {
            $this->ajaxError = $strings->get('admin__files__mgnt__add_dir_err');
        }

        // Render list.
        $this->show();
    }

    /**
     * AJAX request delete directory.
     */
    public function deleteDirectory()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $path = strip_tags(trim($post->get('path')));

        // Prepare parameter.
        $strings = objects::get('strings');
        $this->getSet();
        $this->getSetDirectories();
        $this->initDirectories();

        // If parameters not exists.
        if (!$path) {
            $this->ajaxError = $strings->get('admin__files__mgnt__delete_dir_err');
            $this->show();
            return;
        }

        // If directory not exists.
        if (!isset($this->directories->{$path})) {
            $this->ajaxError = $strings->get('admin__files__mgnt__delete_dir_err');
            $this->show();
            return;
        }

        // If directory not exists.
        if(!is_dir($path)) {
            $this->ajaxError = $strings->get('admin__files__mgnt__delete_dir_err_exists');
            $this->show();
            return;
        }

        // If is root directory.
        foreach ($this->filesDirectories as $directory) {
            if ($directory === $path) {
                $this->ajaxError = $strings->get('admin__files__mgnt__delete_dir_err_root');
                $this->show();
                return;
            }
        }
        if ($this->recursivelyCheckRoot($path)) {
            $this->ajaxError = $strings->get('admin__files__mgnt__delete_dir_err_root');
            $this->show();
            return;
        }

        // Recursively delete directory with sub directories and files.
        $this->recursivelyDelete($path);
        $this->_extensions->set(json_encode($this->directories), 'text', 1, 'appnetos/files/directories');

        // Render list.
        $this->show($this->filesDirectories[0]);
    }

    /**
     * Recursively check directory or sub directories if is root directory.
     *
     * @param string $path.
     * @return bool.
     */
    protected function recursivelyCheckRoot($path)
    {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            if (is_dir($file)) {
                foreach($this->filesDirectories as $directory) {
                    if ($file === $directory) {
                        return true;
                    }
                }
                if ($this->recursivelyCheckRoot($file)) {
                    return true;
                }
            }
        }

        // Return.
        return false;
    }

    /**
     * Recursively delete directory with sub directories and files.
     *
     * @param string $path.
     */
    protected function recursivelyDelete($path)
    {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? $this->recursivelyDelete($file) : unlink($file);
        }
        rmdir($path);
        if (isset($this->directories->{$path})) {
            unset ($this->directories->{$path});
        }
        return;
    }

    /**
     * Render AJAX template.
     * Echo rendered template.
     *
     * @param string $template.
     * @param string $confirm string.
     * @param string $error string.
     * @throws.
     */
    private function renderAjax($template, $error = null, $confirm = null) {

        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }
        $render->assign('admin__files__management', $this);

        // Render template.
        $render->include($template);
    }

    /**
     * POST upload.
     *
     * @echo Upload status.
     */
    protected function postUpload()
    {
        // Get path.
        $post = objects::get('post');
        $path = strip_tags(trim($post->get('path')));

        // Prepare parameter.
        $this->getSet();
        $this->getSetDirectories();
        $this->initDirectories();
        $strings = objects::get('strings');

        // If directory not exists.
        if (!isset($this->directories->{$path})) {
            echo '{"status":"error","error":"' . $strings->get('admin__files__mgnt__err_path') . '"}';
            exit;
        }

        // If path not exists.
        if (!$path) {
            echo '{"status":"error","error":"' . $strings->get('admin__files__mgnt__err_path') . '"}';
            exit;
        }

        // If extension is wrong.
        $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
        if(!in_array(strtolower($extension), $this->filesTypes)){
            echo '{"status":"error","error":"' . $strings->get('admin__files__mgnt__err_format') . '"}';
            exit;
        }

        // If file already exists.
        If (file_exists($path. '/' . $_FILES['upl']['name'])) {
            $tmp = $path. '/' . $_FILES['upl']['name'];
            $array = explode('.', $tmp);
            if (count($array) > 1) {
                $ext = end($array);
                $tmp = substr($tmp, 0, -(strlen($ext)+1));
                for ($i = 1; $i > 0; $i++) {
                    $new = $tmp . '_bak' . $i . '.' . $ext;
                    if (!file_exists($new)) {
                        rename($path. '/' . $_FILES['upl']['name'], $new);
                        break;
                    }
                }
            }
            else {
                for ($i = 1; $i >= 0; $i++) {
                    $new = $path. '/' . $_FILES['upl']['name'] . '_bak' . $i;
                    if (!file_exists($new)) {
                        rename($path. '/' . $_FILES['upl']['name'], $new);
                        break;
                    }
                }
            }
        }

        // Move uploaded file.
        if(move_uploaded_file($_FILES['upl']['tmp_name'], $path. '/' . $_FILES['upl']['name'])){
            echo '{"status":"success"}';
            exit;
        }
        else {
            echo '{"status":"error","error":"' . $strings->get('admin__files__mgnt__err_move') . '"}';
            exit;
        }
    }

    /**
     * Convert size to bytes.
     *
     * @param string $size.
     * @return int.
     */
    protected function convertSizeToBytes($size)
    {
        //
        $suffix = strtoupper(substr($size, -1));
        if (!in_array($suffix,array('P','T','G','M','K'))){
            return (int)$size;
        }
        $value = substr($size, 0, -1);
        switch ($suffix) {
            case 'P': $value *= 1024;
            case 'T': $value *= 1024;
            case 'G': $value *= 1024;
            case 'M': $value *= 1024;
            case 'K': $value *= 1024;
            break;
        }
        return (int)$value;
    }

    /**
     * Get max file size.
     *
     * @return int.
     */
    public function getMaxUploadSize()
    {
        return min($this->convertSizeToBytes(ini_get('post_max_size')), $this->convertSizeToBytes(ini_get('upload_max_filesize')));
    }

    /**
     * Get files types.
     *
     * @return string.
     */
    public function getFilesTypes()
    {
        $buffer = '[';
        foreach ($this->filesTypes as $fileType) {
            $buffer .= '"' . $fileType . '"';
            if ($fileType !== end($this->filesTypes)) $buffer .= ',';
        }
        $buffer .= ']';
        return $buffer;
    }

    /**
     * Get directories array.
     *
     * @return array.
     */
    public function getDirectories()
    {
        $array = (array)$this->directories;
        if (count($array)) {
            sort($array);
            return $array;
        }
    }

    /**
     * Get files array.
     *
     * @return array.
     */
    public function getFiles()
    {
        if (count($this->files)) {
            return $this->files;
        }
    }

    /**
     * Get directory name.
     *
     * @return string.
     */
    public function getDirectoryName()
    {
        $path = trim($this->path, '/ ');
        $array = explode('/', $path);
        return end($array);
    }
}