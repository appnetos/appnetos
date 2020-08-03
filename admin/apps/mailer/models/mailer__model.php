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
 * @description     Mailer logs, blacklist, settings, mailboxes.
 */

// Namespace.
namespace admin\mailer;

// Use.
use \core\objects;

// Model "admin\mailer\mailer__model".
class mailer__model
{

    /**
     * Registered AJAX functions.
     *
     * @var array.
     */
    public $ajax = [
        'addMailbox',
        'editMailbox',
        'deleteMailbox',
        'updateSettings',
        'addWhitelist',
        'removeWhitelist',
        'addBlacklist',
        'removeBlacklist',
        'clearError',
        'clearConfirm'
    ];

    /**
     * Uri ID.
     *
     * @var int.
     */
    public $uriId = null;

    /**
     * Template to render.
     *
     * @var string.
     */
    public $template = null;

    /**
     * Part.
     *
     * @var string.
     */
    public $part = 'logs';

    /**
     * Object "core\render".
     *
     * @var object.
     */
    private $_render = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Assign.
        $this->_render = objects::get('render');
        $this->_render->assign('admin__mailer__mailer__model', $this);

        // Get URI.
        $uri = objects::get('uri');
        $this->uriId = $uri->getId();

        // Logs.
        if ($this->uriId === 500) {

            // Set part.
            $this->part = 'logs';

            // Get model "admin\mailer\mailer__logs".
            $mailerLogs = objects::get('admin/mailer/mailer__logs_list');
            $mailerLogs->init();

            // Set template.
            $this->template = 'admin/apps/mailer/views/mailer__logs_list.tpl';
        }

        // Blacklist.
        elseif ($this->uriId === 501) {

            // Set part.
            $this->part = 'blacklist';

            // Get model "admin\mailer\mailer__blacklist".
            $mailerBlacklistList = objects::get('admin/mailer/mailer__blacklist_list');
            $mailerBlacklistList->init();

            // Set template.
            $this->template = 'admin/apps/mailer/views/mailer__blacklist_list.tpl';
        }

        // Whitelist.
        elseif ($this->uriId === 502) {

            // Set part.
            $this->part = 'whitelist';

            // Get model "admin\mailer\mailer__whitelist".
            $mailerWhitelistList = objects::get('admin/mailer/mailer__whitelist_list');
            $mailerWhitelistList->init();

            // Set template.
            $this->template = 'admin/apps/mailer/views/mailer__whitelist_list.tpl';
        }

        // Settings.
        elseif ($this->uriId === 503) {

            // Set part.
            $this->part = 'settings';

            // Get model "admin\mailer\mailer__settings".
            $mailerSettings = objects::get('admin/mailer/mailer__settings');
            $mailerSettings->init();

            // Get model "admin\mailer\mailer__mailboxes_list".
            $mailerSettings = objects::get('admin/mailer/mailer__mailboxes_list');
            $mailerSettings->init();

            // Set template.
            $this->template = 'admin/apps/mailer/views/mailer__settings.tpl';
        }

        // Mailboxes.
        elseif ($this->uriId === 504) {

            // Set part.
            $this->part = 'mailboxes';

            // Get model "admin\mailer\mailer__mailboxes".
            $mailerMailboxesList = objects::get('admin/mailer/mailer__mailboxes_list');
            $mailerMailboxesList->init();

            // Set template.
            $this->template = 'admin/apps/mailer/views/mailer__mailboxes_list.tpl';
        }

        // If URI wrong.
        else {
            $this->redirect();
        }
    }

    /**
     * Add mailbox.
     */
    public function addMailbox()
    {
        // Initialize.
        $this->init();

        // Add mailbox.
        $mailerMailboxesList = objects::get('admin/mailer/mailer__mailboxes_list');
        $mailerMailboxesList->add();
    }

    /**
     * Edit mailbox.
     */
    public function editMailbox()
    {
        // Initialize.
        $this->init();

        // Get parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__mailer__mailer__parameters');

        // If parameters not exists.
        if (!is_array($parameters)) {
            return;
        }

        // If UUID not exists.
        if (!isset($parameters['admin__mailer__mailer__mailbox__edit_uuid'])) {
            return;
        }

        // Edit mailbox.
        $mailerMailboxesList = objects::get('admin/mailer/mailer__mailboxes_list');
        foreach ($mailerMailboxesList->mailboxesList as $mailerMailbox) {
            if ($mailerMailbox->uuid === $parameters['admin__mailer__mailer__mailbox__edit_uuid']) {
                $mailerMailbox->edit();
            }
        }

        return;
    }

    /**
     * Delete mailbox.
     */
    public function deleteMailbox()
    {
        // Initialize.
        $this->init();

        // Delete mailbox.
        $mailerMailboxesList = objects::get('admin/mailer/mailer__mailboxes_list');
        $mailerMailboxesList->delete();
    }

    /**
     * Update settings.
     */
    public function updateSettings()
    {
        // Initialize.
        $this->init();

        // Update settings.
        $mailerSettings = objects::get('admin/mailer/mailer__settings');
        $mailerSettings->update();
    }

    /**
     * Add to whitelist.
     */
    public function addWhitelist()
    {
        // Initialize.
        $this->init();

        // Add to whitelist.
        $mailerWhitelistList = objects::get('admin/mailer/mailer__whitelist_list');
        $mailerWhitelistList->add();
    }

    /**
     * Remove from whitelist.
     */
    public function removeWhitelist()
    {
        // Initialize.
        $this->init();

        // Remove from whitelist.
        $mailerWhitelistList = objects::get('admin/mailer/mailer__whitelist_list');
        $mailerWhitelistList->remove();
    }

    /**
     * Add to blacklist.
     */
    public function addBlacklist()
    {
        // Initialize.
        $this->init();

        // Add to blacklist.
        $mailerBlacklistList = objects::get('admin/mailer/mailer__blacklist_list');
        $mailerBlacklistList->add();
    }

    /**
     * Remove from blacklist.
     */
    public function removeBlacklist()
    {
        // Initialize.
        $this->init();

        // Remove from blacklist.
        $mailerBlacklistList = objects::get('admin/mailer/mailer__blacklist_list');
        $mailerBlacklistList->remove();
    }

    /**
     * Clear error logs.
     */
    public function clearError()
    {
        // Initialize.
        $this->init();

        // CLear error logs.
        $mailerLogsList = objects::get('admin/mailer/mailer__logs_list');
        $mailerLogsList->init();
        $mailerLogsList->clearError();
    }

    /**
     * Clear confirm logs.
     */
    public function clearConfirm()
    {
        // Initialize.
        $this->init();

        // CLear confirm logs.
        $mailerLogsList = objects::get('admin/mailer/mailer__logs_list');
        $mailerLogsList->init();
        $mailerLogsList->clearConfirm();
    }

    /**
     * Redirect.
     */
    protected function redirect()
    {
        $url = $this->_render->getUrl(1);
        header('Location: ' . $url);
        die();
    }

    /**
     * Assign object.
     *
     * @param string $name.
     * @param object $object.
     */
    public function assign($name, $object)
    {
        $this->_render->assign($name, $object);
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