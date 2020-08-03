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
 * @description     APPNET OS Marketplace.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Controller "admin\apps\marketplace__install".
class marketplace__install
{

    /**
     * APPNET OS version.
     *
     * @var float.
     */
    public $version = null;

    /**
     * Used language.
     *
     * @var string.
     */
    public $language = null;

    /**
     * APPNET OS API marketplace user.
     *
     * @var object.
     */
    public $user = null;

    /**
     * APPNET OS API request data.
     *
     * @var array.
     */
    public $data = null;

    /**
     * Download file.
     *
     * @var string.
     */
    protected $file = null;

    /**
     * Download path.
     *
     * @var string.
     */
    protected $path = null;

    /**
     * Source path.
     *
     * @var string.
     */
    protected $sourcePath = null;

    /**
     * Target path.
     *
     * @var string.
     */
    protected $targetPath = null;

    /**
     * App install file.
     *
     * @var string.
     */
    protected $installFile = null;

    /**
     * App update file.
     *
     * @var string.
     */
    protected $updateFile = null;

    /**
     * Used object "core\strings".
     *
     * @var object.
     */
    protected $_strings = null;

    /**
     * Used object "admin\apps\marketplace__user".
     *
     * @var object.
     */
    protected $_marketplaceUser = null;

    /**
     * marketplace__install constructor.
     */
    public function __construct()
    {
        // Set APPNET OS data.
        $this->version = APPNETOS_VERSION;
        $this->_strings = objects::get('strings');
        $languages = objects::get('languages');
        $this->language = $languages->getActiveMain();

        // Get object marketplace user.
        $this->_marketplaceUser = objects::get('admin/apps/marketplace__user');
    }

    /**
     * Install.
     */
    public function install()
    {
        // If user not signed in.
        if (!$this->_marketplaceUser->token || !$this->_marketplaceUser->user) {
            return;
        }

        // Download app.
        $this->download();

        // Verify app.
        $this->verify();

        // Copy app.
        $this->copy('install');
    }

    /**
     * Update.
     */
    public function update()
    {
        // If user not signed in.
        if (!$this->_marketplaceUser->token || !$this->_marketplaceUser->user) {
            return;
        }

        // Download app.
        $this->download();

        // Verify app.
        $this->verify();

        // Copy app.
        $this->copy('update');
    }

    /**
     * Download app.
     */
    protected function download()
    {
        // Get used objects.
        $config = objects::get('config');
        $post = objects::get('post');

        // Get install data.
        $this->data = $post->get('data');

        // If data not exists.
        if (!$this->data) {
            exit;
        }

        // Prepare download.
        $url = APPNETOS_URL . 'api/install';
        $tmpDir = $config->getTmpDir();
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir);
        }
        $this->path = $tmpDir . '/install';
        if (is_dir($this->path)) {
            $this->deleteDirectory($this->path);
        }
        mkdir($this->path);
        $this->file = $tmpDir . '/install.zip';
        if (file_exists($this->file)) {
            unlink($this->file);
        }

        // Set user data.
        $this->user = [
            'token'   => $this->_marketplaceUser->token,
            'secret'   => $this->_marketplaceUser->secret,
            'session' => $this->_marketplaceUser->session,
            'user'    => $this->_marketplaceUser->user
        ];

        // Download file.
        $content = json_encode($this);
        $resource = fopen($this->file, "w");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER,true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_FILE, $resource);
        $result = curl_exec($curl);

        // If no result.
        if(!$result) {
            $this->error($this->_strings->get('admin__apps__marketplace__err_connection'));
        }
        curl_close($curl);

        // Create ZIP archive.
        $zip = null;
        try {
            $zip = new \ZipArchive;
        }
        catch (\Exception $e) {
            $this->error($this->_strings->get('admin__apps__marketplace__err_zip_extension'));
        }

        // Extract ZIP archive.
        if($zip->open($this->file) != "true")
        {
            $this->error($this->_strings->get('admin__apps__marketplace__err_zip_open'));
        }
        $zip->extractTo($this->path);
        $zip->close();
    }

    /**
     * Verify app.
     */
    protected function verify()
    {
        // Verify app.
        $this->sourcePath = $this->path . '/application';
        $this->targetPath = 'application';
        if (!is_dir($this->sourcePath)) {
            $this->error($this->_strings->get('admin__apps__marketplace__err_zip_open'));
        }
        $this->sourcePath .= '/apps';
        $this->targetPath .= '/apps';
        if (!is_dir($this->sourcePath)) {
            $this->error($this->_strings->get('admin__apps__marketplace__err_zip_open'));
        }
        $directories = glob($this->sourcePath . '/*', GLOB_ONLYDIR);
        if (count($directories) !== 1) {
            $this->error($this->_strings->get('admin__apps__marketplace__err_zip_open'));
        }
        $directoryArray = explode('/', str_replace('\\', '/', $directories[0]));
        $this->sourcePath .= '/' . end($directoryArray);
        $this->targetPath .= '/' . end($directoryArray);

        // Get install file.
        while (!$this->installFile) {
            $directories = glob($this->sourcePath . '/*', GLOB_ONLYDIR);
            if (!count($directories)) {
                break;
            }
            if (count($directories) > 1) {
                if (file_exists($this->sourcePath . '/admin/events/install.php')) {
                    $this->installFile = true;
                    if (file_exists($this->sourcePath . '/admin/events/update.php')) {
                        $this->updateFile = true;
                    }
                    break;
                }
            }
            $directoryArray = explode('/', str_replace('\\', '/', $directories[0]));
            $this->sourcePath .= '/' . end($directoryArray);
            $this->targetPath .= '/' . end($directoryArray);
        }

        // If install file not exists.
        if (!$this->installFile) {
            $this->error($this->_strings->get('admin__apps__marketplace__err_file'));
        }
    }

    /**
     * Copy files.
     *
     * @param string $action.
     */
    protected function copy($action)
    {
        // Backup on update.
        if (is_dir($this->targetPath)) {
            $date = new \DateTime();
            rename ($this->targetPath, $this->targetPath . '-' . $date->format('YmdHis'));
        }

        // Copy files.
        $targetPathArray = explode('/', $this->targetPath);
        $path = '';
        foreach ($targetPathArray as $value) {
            $path .= $value . '/';
            if (!is_dir($path)) {
                @mkdir($path);
            }
        }
        $this->copyDirectory($this->sourcePath, $this->targetPath);

        // On install.
        if ($action === 'install' && $this->installFile) {
            include $this->targetPath . '/admin/events/install.php';
            install();
        }

        // On update.
        elseif ($action === 'update' && $this->updateFile) {
            include $this->targetPath . '/admin/events/update.php';
            update();
        }

        // Success.
        $this->success();
    }

    /**
     * On success.
     *.
     * Echo JSON success.
     */
    protected function success()
    {
        // Remove downloaded files.
        if ($this->file) {
            if (file_exists($this->file)) {
                unlink($this->file);
            }
        }
        if ($this->path) {
            if (is_dir($this->path)) {
                $this->deleteDirectory($this->path);
            }
        }

        // Build error message.
        $data = [];
        $data['success'] = true;

        // Echo JSON data.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * On error.
     *
     * @param string $error.
     * Echo JSON error message.
     */
    protected function error($error)
    {
        // Remove downloaded files.
        if ($this->file) {
            if (file_exists($this->file)) {
                unlink($this->file);
            }
        }
        if ($this->path) {
            if (is_dir($this->path)) {
                $this->deleteDirectory($this->path);
            }
        }

        // Build error message.
        $data = [];
        $data['error'] = $error;

        // Echo JSON data.
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Delete directory with all files.
     *
     * @param string $directory.
     * @return bool.
     */
    function deleteDirectory($directory)
    {
        $handle = null;
        if (is_dir($directory)) {
            $handle = opendir($directory);
        }
        if (!$handle) {
            return false;
        }
        while($file = readdir($handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($directory."/".$file))
                    unlink($directory."/".$file);
                else
                    $this->deleteDirectory($directory.'/'.$file);
            }
        }
        closedir($handle);
        rmdir($directory);
        return true;
    }

    /**
     * Copy directory with all files.
     *
     * @param $source.
     * @param $target.
     */
    function copyDirectory($source,$target) {
        $directory = opendir($source);
        @mkdir($target);
        while(false !== ($file = readdir($directory))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($source . '/' . $file)) {
                    $this->copyDirectory($source . '/' . $file,$target . '/' . $file);
                }
                else {
                    copy($source . '/' . $file,$target . '/' . $file);
                }
            }
        }
        closedir($directory);
    }
}
