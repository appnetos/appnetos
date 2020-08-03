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
 * @description     HTML String App.
 */

// Namespace.
namespace appnetos\html_string\demo_sign_in;

// Use.
use core\objects;

// Controller.
class demo_sign_in
{

    /**
     * App name.
     *
     * @var string.
     */
    public $name = 'demo_sign_in';

    /**
     * App ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * App template.
     *
     * @var string.
     */
    public $template = '';

    /**
     * App template type.
     *
     * @var string.
     */
    public $type = '';

    /**
     * Is HTML editor.
     *
     * @var bool.
     */
    public $html = true;

    /**
     * Directory views.
     *
     * @var string.
     */
    public $directoryViews = null;

    /**
     * Directory CSS.
     *
     * @var string.
     */
    public $directoryCss = null;

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
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * constructor.
     */
    public function __construct()
    {
        // Initialize ID.
        $this->Init();

        // Do some actions.
        if ($this->error) {
            return;
        }
        $this->action();

        // Initialize.
        if ($this->error) {
            return;
        }
        $this->initContent();

        // Add external.
        if ($this->error) {
            return;
        }
        $this->AddExternal();
    }

    /**
     * Initialize.
     */
    private function init()
    {
        // Get ID by seo index.
        $uri = objects::get('uri');
        $index = $uri->getRequestIndex();

        // If index exists.
        if (isset($index[3])) {
            $this->id = (int)$index[3];

            // If is HTML.
            if (isset($index[4])) {
                $this->html = false;
            }
        }

        // If index not exists.
        else {
            $this->error = true;
        }
    }

    /**
     * Initialize content.
     */
    private function initContent()
    {
        // Get views.
        $this->directoryViews = str_replace('admin/controllers', '', str_replace(DIRECTORY_SEPARATOR, '/', __DIR__)) . 'application/views/';
        $this->directoryCss = str_replace('admin/controllers', '', str_replace(DIRECTORY_SEPARATOR, '/', __DIR__)) . 'application/css/';

        // Get template.
        if (file_exists($this->directoryViews . $this->name . '.tpl')) {
            $this->template = $this->directoryViews . $this->name . '.tpl';
            $this->type = 'Smarty';
        }
        else if (file_exists($this->directoryViews . $this->name . '.twig')) {
            $this->template = $this->directoryViews . $this->name . '.twig';
            $this->type = 'Twig';
        }
        else if (file_exists($this->directoryViews . $this->name . '.php')) {
            $this->template = $this->directoryViews . $this->name . '.php';
            $this->type = 'PHP';
        }
        else {
            file_put_contents($this->directoryViews . $this->name . '.tpl', '');
            $this->template = $this->directoryViews . $this->name . '.tpl';
            $this->type = 'Smarty';
        }
    }

    /**
     * Add external scripts and styles.
     */
    private function addExternal()
    {
        // Get object "core\config".
        $config = objects::get('config');

        // Add external scripts and styles.
        $js = objects::get('js');
        $js->add($config->getUrl() . '/out/nicedit/nicedit.js');
        $js->add($config->getUrl() . '/out/codemirror/codemirror.js');
        $js->add($config->getUrl() . '/out/codemirror/modes/css/css.js');
        $js->add($config->getUrl() . '/out/codemirror/modes/htmlmixed/htmlmixed.js');
        $css = objects::get('css');
        $css->add($config->getUrl() . '/out/codemirror/codemirror.css');
    }

    /**
     * Do some actions.
     */
    private function action()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $action = $post->get('appnetos__html_string__action');

        // If action is set.
        if ($action === 'edit') {
            $this->edit();
        }
    }

    /**
     * Edit all templates.
     */
    private function edit()
    {
        // Initialize content.
        $this->initContent();

        // Get POST parameters.
        $post = objects::get('post');
        $all = $post->getAll();

        // Set template.
        if (isset($all['appnetos__html_string__html'])) {
            $this->editTemplate($all['appnetos__html_string__html']);
        }

        // Set CSS file.
        if (isset($all['appnetos__html_string__css'])) {
            $this->editCss($all['appnetos__html_string__css']);
        }
    }

    /**
     * Edit template file.
     *
     * @param $content string content.
     */
    private function editTemplate($content)
    {
        // Get template in directory.
        $this->directoryViews = str_replace('admin/controllers', '', str_replace(DIRECTORY_SEPARATOR, '/', __DIR__)) . 'application/views/';
        $content = trim($content);

        // If content exists.
        if ($content === '' || $content === '<br>') {
            $content = '';
        }
        // Remove HTML arrow right.
        $content = str_replace('&gt;', '>', $content);

        // Save template.
        if ($this->type === 'Smarty') {
            file_put_contents($this->template, $content);
        }
        elseif ($this->type === 'Twig') {
            file_put_contents($this->template, $content);
        }
        elseif ($this->type === 'PHP') {
            file_put_contents($this->template, $content);
        }
    }

    /**
     * Edit CSS file.
     *
     * @param $content string.
     */
    public function editCss($content)
    {
        // Get CSS file in directory.
        $this->directoryCss = str_replace('admin/controllers', '', str_replace(DIRECTORY_SEPARATOR, '/', __DIR__)) . 'application/css/';
        $content = trim($content);

        // If directory exists.
        if ($content === '') {
            $source = 'admin/apps/apps/create/files/html_string/css/css.txt';
            if (file_exists($source)) {
                $content = file_get_contents($source);
            }
        }

        // Create CSS file.
        file_put_contents($this->directoryCss . 'demo_sign_in.css', $content);
    }

    /**
     * Get content.
     *
     * @return string or null.
     */
    public function getContent()
    {
        if (file_exists($this->template)) {
            return file_get_contents($this->template);
        }
    }

    /**
     * Get CSS.
     *
     * @return string or null.
     */
    public function getCss()
    {
        if (file_exists($this->directoryCss . 'demo_sign_in.css')) {
            return file_get_contents($this->directoryCss . 'demo_sign_in.css');
        }
    }
}