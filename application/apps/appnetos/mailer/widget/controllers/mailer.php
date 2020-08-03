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
 * @description     Allows other apps to send messages through the set-up mailmail mailboxes. Creates logs for advanced
 *                  information and a widget for the dashboard.
 */

// Namespace.
namespace appnetos;

// Use.
use core\objects;

// Controller "appnetos\mailer"
class mailer
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = ['reset'];

    /**
     * App ID.
     *
     * @var int.
     */
    public $appId = null;

    /**
     * Latest confirm log.
     *
     * @var object.
     */
    public $confirmLog = null;

    /**
     * Latest error log.
     *
     * @var object.
     */
    public $errorLog = null;

    /**
     * Confirm counter.
     *
     * @var int.
     */
    public $confirmCount = 0;

    /**
     * Error counter.
     *
     * @var int.
     */
    public $errorCount = 0;

    /**
     * AJAX confirm.
     *
     * @var bool.
     */
    public $ajaxConfirm = false;

    /**
     * Used controller "core\extension".
     *
     * @var object.
     */
    protected $_extensions = null;

    /**
     * mailer constructor.
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
        // Get app ID by object "core\objects".
        $this->appId = objects::getApp('appnetos/mailer')->getId();

        // Get and set used objects.
        $this->_extensions = objects::get('extensions');

        // Get model "appnetos\mailer__logs_list";
        $mailerLogsList = objects::get('appnetos/mailer__logs_list');
        $mailerLogsList->init();

        // Get latest logs.
        if (count($mailerLogsList->errorsList)) {
            $this->errorLog = end($mailerLogsList->errorsList);
        }
        if (count($mailerLogsList->confirmsList)) {
            $this->confirmLog = end($mailerLogsList->confirmsList);
        }

        // Get log count.
        $logCount = $this->_extensions->get('varchar', 7, 'appnetos/mailer');
        if ($logCount) {
            $logCount = json_decode($logCount);
            $this->errorCount = $logCount->error;
            $this->confirmCount = $logCount->confirm;
        }
        else {
            $this->_extensions->set('{"error":0,"confirm":0}' ,'varchar', 7, 'appnetos/mailer');
        }
    }

    /**
     * Reset counter.
     */
    public function reset()
    {
        // Reset counter.
        $this->_extensions->set('{"error":0,"confirm":0}' ,'varchar', 7, 'appnetos/mailer');
        $this->ajaxConfirm = true;

        // Render.
        $this->render();
    }

    /**
     * Render.
     *
     * @echo rendered view.
     */
    protected function render()
    {
        // Initialize.
        $this->init();

        // Assign.
        $render = objects::get('render');
        $render->assign('appnetos__mailer', $this);

        // Render template.
        $template = $render->fetch('application/apps/appnetos/mailer/widget/views/mailer__count.tpl');
        header('Content-Type: application/json');
        echo json_encode($template);
    }
}