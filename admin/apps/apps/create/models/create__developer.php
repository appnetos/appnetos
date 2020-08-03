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

// Model "admin\apps\create__developer".
class create__developer
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['build'];

    /**
     * Development.
     *
     * @var string.
     */
    public $development = 'smarty';

    /**
     * Widget.
     *
     * @var bool.
     */
    public $widget = true;

    /**
     * Cache.
     *
     * @var bool.
     */
    public $cache = true;

    /**
     * Container.
     *
     * @var bool.
     */
    public $container = true;

    /**
     * Name.
     *
     * @var string.
     */
    public $name = null;

    /**
     * Directory.
     *
     * @var string.
     */
    public $directory = null;

    /**
     * Namespace.
     *
     * @var string.
     */
    public $namespace = null;

    /**
     * Description.
     *
     * @var string.
     */
    public $description = null;

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
     * Forbidden namespaces.
     *
     * @var array.
     */
    protected $forbiddenNamespaces = ['core', 'namespace', 'admin', 'appnetos', 'xtrose', 'html', 'html_string', 'developer'];

    /**
     * Forbidden directory names.
     *
     * @var array.
     */
    protected $forbiddenDirectoryNames = ['core', 'namespace', 'admin', 'appnetos', 'xtrose', 'html', 'html_string', 'developer', 'CON', 'PRN', 'AUX', 'NUL', 'COM1', 'COM2', 'COM3', 'COM4', 'COM5', 'COM6', 'COM7', 'COM8', 'COM9', 'LPT1', 'LPT2', 'LPT3', 'LPT4', 'LPT5', 'LPT6', 'LPT7', 'LPT8', 'LPT9'];

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign object.
        $render = objects::get('render');
        $render->assign('admin__apps__create__developer', $this);
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
        $development = strip_tags(trim($post->get('development')));
        if ($development === 'php') {
            $this->development = 'php';
        }
        elseif ($development === 'twig') {
            $this->development = 'twig';
        }
        else {
            $this->development = 'smarty';
        }
        if (strip_tags(trim($post->get('widget'))) === 'on') {
            $this->widget = true;
        }
        else {
            $this->widget = false;
        }
        if (strip_tags(trim($post->get('cache'))) === 'on') {
            $this->cache = true;
        }
        else {
            $this->cache = false;
        }
        if (strip_tags(trim($post->get('container'))) === 'on') {
            $this->container = true;
        }
        else {
            $this->container = false;
        }
        $this->name = strip_tags(trim($post->get('name')));
        $this->directory = strtolower(strip_tags(trim($post->get('directory'), "/\\ ")));
        $this->namespace = strip_tags(trim($post->get('namespace'), "/\\ "));
        $this->description = strip_tags(trim($post->get('description')));

        // Prepare parameters.
        $formattedName = strtolower(str_replace(' ', '_', $this->name));
        $this->directory = str_replace('\\', '/', $this->directory);
        $this->directory = str_replace(' ', '_', $this->directory);
        $this->namespace = str_replace('/', '\\', $this->namespace);

        // If name not exists.
        if (!$this->name || $this->name === '') {
            $this->render('admin__apps__create__err_no_name');
        }

        // if name is wrong.
        if (!preg_match("/^[A-Za-z_ ]+$/", $this->name)) {
            $this->render('admin__apps__create__err_name');
        }

        // If directory is wrong.
        if ($this->directory === '') {
            $this->render('admin__apps__create__err_dir');
        }
        if (!preg_match("/^[A-Za-z0-9_ ]+$/", $this->directory)) {
            $this->render('admin__apps__create__err_dir');
        }
        foreach ($this->forbiddenDirectoryNames as $forbiddenDirectoryName) {
            if ($this->directory === $forbiddenDirectoryName) {
                $this->render('admin__apps__create__err_dir');
            }
        }

        // If namespace is wrong.
        if ($this->namespace !== '') {
            if (!preg_match("/^[A-Za-z_\\\\]+$/", $this->namespace)) {
                $this->render('admin__apps__create__err_ns_wrong');
            }
            $tmp = strtolower($this->namespace);
            foreach ($this->forbiddenNamespaces as $forbiddenNamespace) {
                if (strpos($tmp, $forbiddenNamespace)) {
                    $this->render('admin__apps__create__err_ns_wrong');
                }
            }
        }

        // If app with name exists.
        $directory = 'application/apps/' . $this->directory . '/';
        if (is_dir($directory . $formattedName)) {
            $this->render('admin__apps__create__err_dev_name_ex');
        }
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM application_apps WHERE xt_name=? AND  xt_namespace=?';
        $row = $database->selectRow($query, [$this->name, $this->namespace]);
        if ($row) {
            $this->render('admin__apps__create__err_ns_exists');
        }

        // Copy developer app files.
        $this->copyDev();

        // Get object "core\install".
        $install = objects::getNew('core/install');

        // Install application.
        $install->setNamespace($this->namespace);
        $install->setDirectory($this->directory);
        $install->setName($this->name);
        $install->setDescription($this->description);
        if ($this->widget) {
            $install->setWidget(1);
        }
        else {
            $install->setWidget(0);
        }
        $install->setContainer($this->container);
        $install->setCacheable($this->cache);
        $install->install();

        // Remove form parameters.
        $this->namespace = null;
        $this->directory = null;
        $this->name = null;
        $this->description = null;
        $this->widget = 1;
        $this->cache = true;
        $this->container = true;

        // Render ajax template.
        $this->render(null, 'admin__apps__create__conf');
    }

    /**
     * Copy developer app files.
     */
    protected function copyDev()
    {
        // Prepare parameters.
        $formattedName = strtolower(str_replace(' ', '_', $this->name));

        // Set directories.
        $source = 'admin/apps/apps/create/files/developer/';
        $directory = 'application/apps/';
        $target = $directory . $this->directory . '/' . $formattedName;

        // Recursively create app directory.
        $sub = explode('/', $target);
        for ($i = 0; $i < count($sub); $i++) {
            $dir = '';
            for ($is = 0; $is < $i; $is++) {
                $dir .= $sub[$is] . '/';
            }
            $dir .= $sub[$i];
            if (!is_dir($dir)) {
                mkdir($dir);
            }
        }

        // Create description directory.
        mkdir($target . '/description');

        // Create license directory.
        mkdir($target . '/license');

        // Create application directories.
        mkdir($target . '/application');
        mkdir($target . '/application/controllers');
        mkdir($target . '/application/css');
        mkdir($target . '/application/js');
        mkdir($target . '/application/models');
        mkdir($target . '/application/strings');
        mkdir($target . '/application/views');

        // Create admin directories
        mkdir($target . '/admin');
        mkdir($target . '/admin/css');
        mkdir($target . '/admin/events');
        mkdir($target . '/admin/js');
        mkdir($target . '/admin/models');
        mkdir($target . '/admin/strings');
        mkdir($target . '/admin/views');
        mkdir($target . '/admin/controllers');

        // Create widget directories
        if ($this->widget) {
            mkdir($target . '/widget');
            mkdir($target . '/widget/controllers');
            mkdir($target . '/widget/css');
            mkdir($target . '/widget/js');
            mkdir($target . '/widget/models');
            mkdir($target . '/widget/strings');
            mkdir($target . '/widget/views');
        }

        // Copy logo.
        copy($source . 'logo.png', $target . '/logo.png');

        // Copy description files.
        copy($source . 'description/global.txt', $target . '/description/global.txt');
        copy($source . 'description/de.txt', $target . '/description/de.txt');
        copy($source . 'description/en.txt', $target . '/description/en.txt');

        // Copy license files.
        copy($source . 'license/global.txt', $target . '/license/global.txt');
        copy($source . 'license/de.txt', $target . '/license/de.txt');
        copy($source . 'license/en.txt', $target . '/license/en.txt');

        // Copy application files.
        $content = file_get_contents($source . 'application/controllers/controller.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/application/controllers/' . $formattedName . '.php', $content);
        $content = file_get_contents($source . 'application/css/css.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/application/css/' . $formattedName . '.css', $content);
        $content = file_get_contents($source . 'application/js/js.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/application/js/' . $formattedName . '.js', $content);
        $content = file_get_contents($source . 'application/models/model.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/application/models/' . $formattedName . '__model.php', $content);
        $content = file_get_contents($source . 'application/strings/de.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/application/strings/de.php', $content);
        $content = file_get_contents($source . 'application/strings/en.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/application/strings/en.php', $content);
        $content = file_get_contents($source . 'application/strings/global.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/application/strings/global.php', $content);

        // Copy admin files.
        $content = file_get_contents($source . 'admin/controllers/controller.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/controllers/' . $formattedName . '.php', $content);
        $content = file_get_contents($source . 'admin/css/css.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/css/' . $formattedName . '.css', $content);
        $content = file_get_contents($source . 'admin/events/activate.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/events/activate.php', $content);
        $content = file_get_contents($source . 'admin/events/deactivate.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/events/deactivate.php', $content);
        $content = file_get_contents($source . 'admin/events/delete.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/events/delete.php', $content);
        $content = file_get_contents($source . 'admin/events/activate.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/events/activate.php', $content);
        $content = file_get_contents($source . 'admin/events/install.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/events/install.php', $content);
        $content = file_get_contents($source . 'admin/events/remove.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/events/remove.php', $content);
        $content = file_get_contents($source . 'admin/events/revert.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/events/revert.php', $content);
        $content = file_get_contents($source . 'admin/js/js.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/js/' . $formattedName . '.js', $content);
        $content = file_get_contents($source . 'admin/models/model.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/models/' . $formattedName . '__model.php', $content);
        $content = file_get_contents($source . 'admin/strings/de.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/strings/de.php', $content);
        $content = file_get_contents($source . 'admin/strings/en.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/strings/en.php', $content);
        $content = file_get_contents($source . 'admin/strings/global.txt');
        $content = $this->formatContent($content);
        file_put_contents($target . '/admin/strings/global.php', $content);

        // Copy widget files.
        if ($this->widget) {
            $content = file_get_contents($source . 'widget/controllers/controller.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/widget/controllers/' . $formattedName . '.php', $content);
            $content = file_get_contents($source . 'widget/css/css.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/widget/css/' . $formattedName . '.css', $content);
            $content = file_get_contents($source . 'widget/js/js.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/widget/js/' . $formattedName . '.js', $content);
            $content = file_get_contents($source . 'widget/models/model.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/widget/models/' . $formattedName . '__model.php', $content);
            $content = file_get_contents($source . 'widget/strings/de.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/widget/strings/de.php', $content);
            $content = file_get_contents($source . 'widget/strings/en.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/widget/strings/en.php', $content);
            $content = file_get_contents($source . 'widget/strings/global.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/widget/strings/global.php', $content);
        }

        // Copy Smarty templates.
        if ($this->development === 'smarty') {

            // Application files.
            $content = file_get_contents($source . 'application/views/smarty/view.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/application/views/' . $formattedName . '.tpl', $content);
            $content = file_get_contents($source . 'application/views/smarty/include.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/application/views/' . $formattedName . '__include.tpl', $content);

            // Admin Files.
            $content = file_get_contents($source . 'admin/views/smarty/view.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/admin/views/' . $formattedName . '.tpl', $content);
            $content = file_get_contents($source . 'admin/views/smarty/menu.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/admin/views/' . $formattedName . '__menu.tpl', $content);

            // Widget Files.
            if ($this->widget) {
                $content = file_get_contents($source . 'widget/views/smarty/view.txt');
                $content = $this->formatContent($content);
                file_put_contents($target . '/widget/views/' . $formattedName . '.tpl', $content);
                $content = file_get_contents($source . 'widget/views/smarty/include.txt');
                $content = $this->formatContent($content);
                file_put_contents($target . '/widget/views/' . $formattedName . '__include.tpl', $content);
            }
        }

        // Copy Twig templates.
        elseif ($this->development === 'twig') {

            // Application files.
            $content = file_get_contents($source . 'application/views/twig/view.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/application/views/' . $formattedName . '.twig', $content);
            $content = file_get_contents($source . 'application/views/twig/include.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/application/views/' . $formattedName . '__include.twig', $content);

            // Admin Files.
            $content = file_get_contents($source . 'admin/views/twig/view.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/admin/views/' . $formattedName . '.twig', $content);
            $content = file_get_contents($source . 'admin/views/twig/menu.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/admin/views/' . $formattedName . '__menu.twig', $content);

            // Widget Files.
            if ($this->widget) {
                $content = file_get_contents($source . 'widget/views/twig/view.txt');
                $content = $this->formatContent($content);
                file_put_contents($target . '/widget/views/' . $formattedName . '.twig', $content);
                $content = file_get_contents($source . 'widget/views/twig/include.txt');
                $content = $this->formatContent($content);
                file_put_contents($target . '/widget/views/' . $formattedName . '__include.twig', $content);
            }
        }

        // Copy PHP templates.
        else {

            // Application files.
            $content = file_get_contents($source . 'application/views/php/view.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/application/views/' . $formattedName . '.php', $content);
            $content = file_get_contents($source . 'application/views/php/include.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/application/views/' . $formattedName . '__include.php', $content);

            // Admin files.
            $content = file_get_contents($source . 'admin/views/php/view.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/admin/views/' . $formattedName . '.php', $content);
            $content = file_get_contents($source . 'admin/views/php/menu.txt');
            $content = $this->formatContent($content);
            file_put_contents($target . '/admin/views/' . $formattedName . '__menu.php', $content);

            // Widget files.
            if ($this->widget) {
                $content = file_get_contents($source . 'widget/views/php/view.txt');
                $content = $this->formatContent($content);
                file_put_contents($target . '/widget/views/' . $formattedName . '.php', $content);
                $content = file_get_contents($source . 'widget/views/php/include.txt');
                $content = $this->formatContent($content);
                file_put_contents($target . '/widget/views/' . $formattedName . '__include.php', $content);
            }
        }
    }

    /**
     * Format content.
     *
     * @param string $content.
     * @return string.
     */
    protected function formatContent($content)
    {
        // Prepare parameters.
        $formattedName = strtolower(str_replace(' ', '_', $this->name));

        // Format content.
        $content = str_replace('***NAME***', $this->name, $content);
        $content = str_replace('***FORMATTED_NAME***', strtolower(str_replace(' ', '_', $formattedName)), $content);
        $content = str_replace('***DIRECTORY***', $this->directory, $content);
        $content = str_replace('***NAMESPACE***', $this->namespace, $content);
        $formattedNamespace = '';
        if ($this->namespace !== '') {
            $formattedNamespace = str_replace("\\", "__", $this->namespace) . '__';
        } else {
            $content = str_replace('namespace', '// namespace', $content);
            $content = str_replace('// // namespace', '// namespace', $content);
        }
        $content = str_replace('***FORMATTED_NAMESPACE***', $formattedNamespace, $content);
        return $content;
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
        $output = $render->fetch('admin/apps/apps/create/views/create__developer.tpl');
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
        $infoAdmin= $config->getInfoAdmin();
        return $infoAdmin;
    }
}