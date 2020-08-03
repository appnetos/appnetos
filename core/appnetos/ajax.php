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
 * @description     core/appnetos/ajax.php extends render extends Smarty ->    Ajax rendering object. Process ajax
 *                  requests and render default ajax template.
 */

// Namespace.
namespace core;

// Class "core\ajax" extends class "core\render" extends class "Smarty".
class ajax extends render
{

    /**
     * AJAX request namespace name "$_POST["ns"]".
     *
     * @var string.
     */
    protected $ns = null;

    /**
     * AJAX request class name $_POST["cl"]".
     *
     * @var string.
     */
    protected $cl = null;

    /**
     * AJAX request function name $_POST["fn"]".
     *
     * @var string.
     */
    protected $fn = null;

    /**
     * If is error.
     *
     * @var bool.
     */
    protected $error = false;

    /**
     * Used object "core\post".
     */
    protected $_post = null;

    /**
     * ajax constructor.
     */
    public function __construct()
    {
        // Object "core\render" constructor.
        parent::__construct();

        // Get and set used objects.
        $this->_post = objects::get('post');
    }

    /**
     * Initialize application.
     *
     * @return bool.
     * @throws exception.
     */
    public function initApplication()
    {
        // If AJAX error in object "core\uri".
        if ($this->_uri->getAjaxError()) {
            $this->error = true;
            return false;
        }

        // Initialize parameters.
        if (!$this->error) {
            $this->initParameters();
        }

        // Run AJAX request.
        if (!$this->error) {
            $this->runApplication();
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Initialize admin section.
     *
     * @return bool.
     * @throws \SmartyException.
     * @throws \Twig\Error\LoaderError.
     * @throws \Twig\Error\RuntimeError.
     * @throws \Twig\Error\SyntaxError.
     * @throws exception.
     */
    public function initAdmin()
    {
        // If AJAX error in object "core\uri".
        if ($this->_uri->getAjaxError()) {
            $this->error = true;
            return false;
        }

        // Initialize parameters.
        if (!$this->error) {
            $this->initParameters();
        }

        // If user is not admin.
        $user = objects::get('user');
        if (!$user->getActive()) {
            $config = objects::get('core/config');
            $allowed = false;
            foreach ($config->getAllowedAdminAjax() as $allowedAdminAjax) {
                if (!isset($allowedAdminAjax['ns']) || !isset($allowedAdminAjax['cl']) || !isset($allowedAdminAjax['fn'])) {
                    continue;
                }
                if ($allowedAdminAjax['ns'] !== $this->ns || $allowedAdminAjax['cl'] !== $this->cl || $allowedAdminAjax['fn'] !== $this->fn) {
                    continue;
                }
                $allowed = true;
                break;
            }
            if (!$allowed) {

                // Add app "admin\ajax_error" to object "core\apps".
                $apps = objects::get('apps');
                $apps->addAdmin(5);

                // Render app view.
                $this->include('admin/apps/ajax_error/views/ajax_error.tpl');
                exit();
            }
        }

        // Run AJAX request.
        if (!$this->error) {
            $this->runAdmin();
            return true;
        }

        // Return.
        return false;
    }

    /**
     * Initialize parameters.
     *
     * @return bool.
     * @throws exception. Errors: AJAX class "cl" not sent error,
     *                            AJAX function "fn" not sent error.
     */
    protected function initParameters()
    {
        // Get parameters.
        $this->ns = trim($this->_post->get('ns'), '\\/ ');
        $this->cl = trim($this->_post->get('cl'), '\\/ ');
        $this->fn = trim($this->_post->get('fn'));

        // If parameters not exists.
        if (!$this->cl || !$this->fn) {
            $this->error = true;
            return false;
        }
        if (!$this->cl) {
            throw new exception('AJAX class "cl" not sent error');
        }
        if (!$this->fn) {
            throw new exception('AJAX function "fn" not sent error');
        }

        // Return.
        return true;
    }

    /**
     * Run AJAX request application.
     *
     * @throws exception. Errors: Requested class not registered in object "core\objects" error,
     *                            Requested function not registered in requested object error.
     *
     */
    protected function runApplication()
    {
        // Prepare parameters.
        if ($this->ns) {
            $this->cl = str_replace('\\', '/', $this->ns) . '/' . $this->cl;
        }

        // If requested class not exists.
        $class = objects::get($this->cl, true);

        // If class not exists.
        if (!$class) {
            throw new exception('Requested class not registered in object "core\objects" error');
        }

        // If requested function is not an registered ajax function in requested controller.
        if (!isset($class->ajax)) {
            throw new exception('Requested function not registered in requested class error');
        }
        if (!is_array($class->ajax)) {
            throw new exception('Requested function not registered in requested class error');
        }
        if (!in_array($this->fn, $class->ajax)) {
            throw new exception('Requested function not registered in requested class error');
        }

        // If requested function not exists in requested controller.
        if (!method_exists($class, $this->fn)) {
            throw new exception('Requested function not exists in requested class error');
        }

        // Run AJAX function.
        $class->{$this->fn}();
    }

    /**
     * Run AJAX request admin section.
     *
     * @throws exception. Errors: Requested class not registered in object "core\objects" error,
     *                            Requested function not registered in requested class error.
     */
    protected function runAdmin()
    {
        // Prepare parameters.
        if ($this->ns) {
            $this->cl = str_replace('\\', '/', $this->ns) . '/' . $this->cl;
        }

        // If requested class not exists.
        $class = objects::get($this->cl, true);

        // If class not exists.
        if (!$class) {
            throw new exception('Requested class not registered in object "core\objects\" error');
        }

        // If requested function is not an registered ajax function in requested class.
        if (!isset($class->ajax)) {
            throw new exception('Requested function not registered in requested class error');
        }
        if (!is_array($class->ajax)) {
            throw new exception('Requested function not registered in requested class error');
        }
        if (!in_array($this->fn, $class->ajax)) {
            throw new exception('Requested function not registered in requested class error');
        }

        // If requested function not exists in requested controller.
        if (!method_exists($class, $this->fn)) {
            throw new exception('Requested function not exists in requested class error');
        }

        // Run AJAX function.
        $class->{$this->fn}();
    }
}