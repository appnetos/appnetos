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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 */

// Namespace.
namespace admin\settings;

// Use.
use core\objects;

// Model "admin\settings\system__extends".
class system__extends
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['move', 'remove', 'activate', 'deactivate'];

    /**
     * PHP extends.
     *
     * @var array.
     */
    public $extends = [];

    /**
     * Initialize.
     *
     * @param bool $set.
     * @throws \core\exception.
     */
    public function init($set = true)
    {
        // Prepare parameters.
        $this->extends = [];

        // Assign.
        $render = objects::get('render');
        $render->assign('admin__settings__system__extends', $this);

        // Get PHP class extends.
        $GLOBAL__APPNETOS__EXTENDS = null;
        if (file_exists('custom/extends.php')) {
            include ('custom/extends.php');
            if (!$GLOBAL__APPNETOS__EXTENDS) {
                $this->set();
                return;
            }
            elseif (!is_array($GLOBAL__APPNETOS__EXTENDS)) {
                $this->set();
                return;
            }
        }

        // Set extends as object "admin\settings\system__extend".
        $extends = [];
        foreach ($GLOBAL__APPNETOS__EXTENDS as $extend) {
            $systemExtend = objects::getNew('admin/settings/system__extend');
            $success = $systemExtend->init($extend);
            if ($success) {
                $extends[] = $systemExtend;
            }
        }

        // Sort extends by classes.
        $classes = [];
        foreach ($extends as $extend) {
            if (!in_array($extend->key, $classes)) {
                $classes[] = $extend->key;
            }
        }
        sort($classes);
        $sorted = [];
        foreach ($classes as $key) {
            $sorted[$key] = [];
        }
        foreach ($extends as $extend) {
            $exists = false;
            foreach ($sorted[$extend->key] as $entry) {
                if ($entry->key === $extend->key &&
                    $entry->parent === $extend->parent &&
                    $entry->children === $extend->children
                ) {
                    $exists = true;
                    break;
                }
            }
            if ($exists) {
                continue;
            }
            $sorted[$extend->key][] = $extend;
        }
        foreach ($sorted as $sort) {
            if (count($sort)) {
                reset($sort)->first = true;
                end($sort)->last = true;
            }
        }
        foreach ($sorted as $sort) {
            foreach ($sort as $entry) {
                $this->extends[] = $entry;
            }
        }

        // On error.
        if ($set) {
            $this->set();
        }
    }

    /**
     * Set PHP extends.
     */
    protected function set()
    {
        $extends = [];
        foreach ($this->extends as $systemExtend) {
            $extend = [];
            $extend['key'] = $systemExtend->key;
            $extend['parent'] = $systemExtend->parent;
            $extend['children'] = $systemExtend->children;
            $extend['active'] = $systemExtend->active;
            $extends[] = $extend;
        }
        $export = file_get_contents('core/files/extends_header.php');
        $export .= '$GLOBAL__APPNETOS__EXTENDS = ' . var_export($extends, true) . ';';
        file_put_contents('custom/extends.php', $export);
    }

    /**
     * Move extends.
     *
     * @throws \core\exception.
     */
    public function move()
    {
        // Initialize.
        $this->init();

        // Get used objects.
        $strings = objects::get('strings');
        $systemModel = objects::getNew('admin/settings/system__model');
        $render = objects::get('render');

        // Assign.
        $render->assign('admin__settings__system__model', $systemModel);

        // Get parameters.
        $post = objects::get('post');
        $index = $post->get('index');
        $direction = $post->get('direction');

        // If parameters not exists.
        if ($index === false || !$direction) {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_move_error');
            $this->render();
        }

        // If direction is up.
        if ($direction === 'up') {
            if (!isset($this->extends[(int)$index]) || !isset($this->extends[((int)$index - 1)])) {
                $systemModel->ajaxError = $strings->get('admin__settings__system__extends_move_error');
                $this->render();
            }
            $cache = $this->extends[(int)$index];
            $this->extends[(int)$index] = $this->extends[((int)$index - 1)];
            $this->extends[((int)$index - 1)] = $cache;
            $this->set();
        }

        // If direction is down.
        elseif ($direction === 'down') {
            if (!isset($this->extends[(int)$index]) || !isset($this->extends[((int)$index + 1)])) {
                $systemModel->ajaxError = $strings->get('admin__settings__system__extends_move_error');
                $this->render();
            }
            $cache = $this->extends[(int)$index];
            $this->extends[(int)$index] = $this->extends[((int)$index + 1)];
            $this->extends[((int)$index + 1)] = $cache;
            $this->set();
        }

        // If direction not exists.
        else {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_move_error');
            $this->render();
        }

        // Render.
        $this->init(false);
        $systemModel->ajaxConfirm = $strings->get('admin__settings__system__extends_move_confirm');
        $this->render();
    }

    /**
     * Remove extends.
     *
     * @throws \core\exception.
     */
    public function remove()
    {
        // Initialize.
        $this->init();

        // Get used objects.
        $strings = objects::get('strings');
        $systemModel = objects::getNew('admin/settings/system__model');
        $render = objects::get('render');

        // Assign.
        $render->assign('admin__settings__system__model', $systemModel);

        // Get parameters.
        $post = objects::get('post');
        $index = $post->get('index');
        $type = $post->get('type');

        // If parameters not exists.
        if ($index === false || !$type) {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_remove_error');
            $this->render();
        }

        // If type is parent.
        if ($type === 'parent') {
            if (!isset($this->extends[(int)$index])) {
                $systemModel->ajaxError = $strings->get('admin__settings__system__extends_remove_error');
                $this->render();
            }
            $key = $this->extends[(int)$index]->key;
            $count = count($this->extends);
            $new = [];
            foreach ($this->extends as $extend) {
                if ($extend->key !== $key) {
                    $new[] = $extend;
                }
            }
            if (count($new) === $count) {
                $systemModel->ajaxError = $strings->get('admin__settings__system__extends_remove_error');
                $this->render();
            }
            $this->extends = $new;
            $this->set();
        }

        // If type is children.
        elseif ($type === 'children') {
            if (!isset($this->extends[(int)$index])) {
                $systemModel->ajaxError = $strings->get('admin__settings__system__extends_remove_error');
                $this->render();
            }
            unset($this->extends[(int)$index]);
            $this->set();
        }

        // If type not exists.
        else {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_remove_error');
            $this->render();
        }

        // Render.
        $this->init(false);
        $systemModel->ajaxConfirm = $strings->get('admin__settings__system__extends_remove_confirm');
        $this->render();
    }

    /**
     * Activate extends.
     *
     * @throws \core\exception.
     */
    public function activate()
    {
        // Initialize.
        $this->init();

        // Get used objects.
        $strings = objects::get('strings');
        $systemModel = objects::getNew('admin/settings/system__model');
        $render = objects::get('render');

        // Assign.
        $render->assign('admin__settings__system__model', $systemModel);

        // Get parameters.
        $post = objects::get('post');
        $index = $post->get('index');

        // If parameters not exists.
        if ($index === false) {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_activate_error');
            $this->render();
        }

        // If extends not exists.
        if (!isset($this->extends[(int)$index])) {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_activate_error');
            $this->render();
        }

        // If extends has errors.
        if (!$this->extends[(int)$index]->parentExists ||
            !$this->extends[(int)$index]->childrenExists
        ) {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_activate_error_exists');
            $this->render();
        }

        // Activate extend.
        $this->extends[(int)$index]->active = true;
        $this->set();

        // Render.
        $systemModel->ajaxConfirm = $strings->get('admin__settings__system__extends_activate_confirm');
        $this->render();
    }

    /**
     * Deactivate extends.
     *
     * @throws \core\exception.
     */
    public function deactivate()
    {
        // Initialize.
        $this->init();

        // Get used objects.
        $strings = objects::get('strings');
        $systemModel = objects::getNew('admin/settings/system__model');
        $render = objects::get('render');

        // Assign.
        $render->assign('admin__settings__system__model', $systemModel);

        // Get parameters.
        $post = objects::get('post');
        $index = $post->get('index');

        // If parameters not exists.
        if ($index === false) {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_deactivate_error');
            $this->render();
        }

        // If extends not exists.
        if (!isset($this->extends[(int)$index])) {
            $systemModel->ajaxError = $strings->get('admin__settings__system__extends_deactivate_error');
            $this->render();
        }

        // Deactivate extend.
        $this->extends[(int)$index]->active = false;
        $this->set();

        // Render.
        $systemModel->ajaxConfirm = $strings->get('admin__settings__system__extends_deactivate_confirm');
        $this->render();
    }

    /**
     * AJAX Render template.
     */
    public function render()
    {
        $render = objects::get('render');
        $template = $render->fetch('admin/apps/settings/system/views/system__extends.tpl');
        header('Content-Type: application/json');
        echo json_encode($template);
        exit;
    }
}