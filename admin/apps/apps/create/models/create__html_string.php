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
 * @description     Admin app creator to build apps.
 */

// Namespace.
namespace admin\apps;

// Use.
use \core\objects;

// Model "admin\apps\create__html_string".
class create__html_string
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['build'];

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Description.
     *
     * @var string.
     */
    public $description = null;

    /**
     * Template language.
     *
     * @var string.
     */
    public $template = 'smarty';

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
    public $ajaxConfirm = '';

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign object.
        $render = objects::get('render');
        $render->assign('admin__apps__create__html_string', $this);
    }

    /**
     * Build application.
     */
    public function build()
    {
        // Initialize.
        $this->init();

        // Get POST parameters.
        $post = objects::get('post');
        $this->template = strip_tags(trim($post->get('template')));
        $this->name = strip_tags(trim($post->get('name')));
        $this->description = strip_tags(trim($post->get('description')));

        // Prepare parameters.
        $formattedName = strtolower(str_replace(' ', '_', $this->name));
        $compareTemplate = ['smarty', 'twig', 'php'];
        if (!in_array($this->template, $compareTemplate)) {
            $this->template = 'smarty';
        }

        // If parameters not exists.
        if (!$this->name || $this->name === '') {
            $this->render('admin__apps__create__err_no_name');
        }

        // If name is wrong.
        if (!preg_match('/^[A-Za-z_ ]+$/', $this->name)) {
            $this->render('admin__apps__create__err_name');
        }

        // If app with name exist.
        $directory = 'application/apps/html_string/';
        if (is_dir($directory . $formattedName)) {
            $this->render('admin__apps__create__err_name_exists');
        }

        // Select from database table "application_apps".
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM application_apps WHERE xt_name=? AND xt_namespace=?';
        $row = $database->selectRow($query, [$this->name, "appnetos\\html_string\\" . $this->name]);
        if ($row) {
            $this->render('admin__apps__create__err_name_exists');
        }

        // Copy app files.
        $this->copyFiles();

        // Get object "core\install".
        $install = objects::getNew('core/install');

        // Install application.
        $install->setNamespace("appnetos\\html_string\\" . $formattedName);
        $install->setDirectory('html_string');
        $install->setName($this->name);
        $install->setDescription($this->description);
        $install->setContainer(1);
        $install->setCacheable(1);
        $install->install();

        // Remove form parameters.
        $this->name = null;
        $this->description = null;

        // Render.
        $this->render(null, 'admin__apps__create__conf');
    }

    /**
     * Copy app files.
     */
    protected function copyFiles()
    {
        // Prepare parameters.
        $formattedName = strtolower(str_replace(' ', '_', $this->name));

        // Create directories.
        $source = 'admin/apps/apps/create/files/html_string/';
        $directory = 'application/apps/html_string/';
        if (!is_dir($directory)) {
            mkdir($directory);
        }
        $target = $directory . $formattedName;
        mkdir($target);
        mkdir($target . '/application');
        mkdir($target . '/application/css');
        mkdir($target . '/application/views');
        mkdir($target . '/application/strings');
        mkdir($target . '/admin');
        mkdir($target . '/admin/controllers');
        mkdir($target . '/admin/css');
        mkdir($target . '/admin/events');
        mkdir($target . '/admin/js');
        mkdir($target . '/admin/views');
        mkdir($target . '/admin/strings');

        // Copy admin files.
        $content = file_get_contents($source . 'admin/controllers/controller.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        file_put_contents($target . '/admin/controllers/' . $formattedName . '.php', $content);
        $content = file_get_contents($source . 'admin/events/delete.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        file_put_contents($target . '/admin/events/delete.php', $content);
        $content = file_get_contents($source . 'admin/js/js.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        file_put_contents($target . '/admin/js/' . $formattedName . '.js', $content);
        $content = file_get_contents($source . 'admin/css/css.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        file_put_contents($target . '/admin/css/' . $formattedName . '.css', $content);
        $content = file_get_contents($source . 'admin/views/menu.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        $content = str_replace('***NAME***', $this->name, $content);
        file_put_contents($target . '/admin/views/' . $formattedName . '__menu.tpl', $content);
        $content = file_get_contents($source . 'admin/views/view.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        file_put_contents($target . '/admin/views/' . $formattedName . '.tpl', $content);

        // Copy admin strings.
        $content = file_get_contents($source . '/admin/strings/global.txt');
        file_put_contents($target . '/admin/strings/global.php', $content);
        $content = file_get_contents($source . '/admin/strings/de.txt');
        file_put_contents($target . '/admin/strings/de.php', $content);
        $content = file_get_contents($source . '/admin/strings/en.txt');
        file_put_contents($target . '/admin/strings/en.php', $content);
        $content = file_get_contents($source . '/admin/strings/es.txt');
        file_put_contents($target . '/admin/strings/es.php', $content);
        $content = file_get_contents($source . '/admin/strings/fr.txt');
        file_put_contents($target . '/admin/strings/fr.php', $content);
        $content = file_get_contents($source . '/admin/strings/it.txt');
        file_put_contents($target . '/admin/strings/it.php', $content);
        $content = file_get_contents($source . '/admin/strings/ru.txt');
        file_put_contents($target . '/admin/strings/ru.php', $content);

        // Copy application files
        if ($this->template === 'smarty') {
            $content = file_get_contents($source . 'application/views/smarty.txt');
            $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
            file_put_contents($target . '/application/views/' . $formattedName . '.tpl', $content);
        }
        elseif ($this->template === 'twig') {
            $content = file_get_contents($source . 'application/views/twig.txt');
            $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
            file_put_contents($target . '/application/views/' . $formattedName . '.twig', $content);
        }
        elseif ($this->template === 'php') {
            $content = file_get_contents($source . 'application/views/php.txt');
            $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
            file_put_contents($target . '/application/views/' . $formattedName . '.php', $content);
        }
        $content = file_get_contents($source . 'application/css/css.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        file_put_contents($target . '/application/css/' . $formattedName . '.css', $content);
        $content = file_get_contents($source . 'application/strings/global.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        file_put_contents($target . '/application/strings/global.php', $content);
        $content = file_get_contents($source . 'application/strings/en.txt');
        $content = str_replace('***FORMATTED_NAME***', $formattedName, $content);
        file_put_contents($target . '/application/strings/en.php', $content);
    }

    /**
     * Render template.
     * Echo rendered template.
     *
     * @param string $error.
     * @param string $confirm.
     */
    protected function render($error = null, $confirm = null)
    {
        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }

        // Render template.
        $output = $render->fetch('admin/apps/apps/create/views/create__html_string.tpl');
        echo $output;
        exit();
    }

    /**
     * Get admin info.
     *
     * @return bool.
     */
    public function getInfoAdmin()
    {
        $config = objects::get('config');
        $infoAdmin = $config->getInfoAdmin();
        return $infoAdmin;
    }
}