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
 * @description     core/appnetos/uuid.php ->    UUID class. Manage AJAX UUID and admin section UUID.
 */

// Namespace.
namespace core;

// Class "core\uuid".
class uuid extends base
{

    /**
     * New AJAX UUID.
     *
     * @var string.
     */
    protected $ajax = null;

    /**
     * uuid constructor.
     */
    public function __construct()
    {
        // Initialize
        $this->init();
    }

    /**
     * Initialize.
     */
    protected function init()
    {
        // Get object "core\session" and object "core\uri".
        $session = objects::get('session');

        // Get and set AJAX UUID.
        $this->ajax = $session->get('APPNETOS_AJAX_UUID');
        if (!$this->ajax) {
            $this->ajax = $this->generate();
            $session->set('APPNETOS_AJAX_UUID', $this->ajax);
        }
    }

    /**
     * Generate UUID.
     *
     * @return string.
     */
    public function generate()
    {
        return mb_strtoupper(
            sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
                mt_rand( 0, 0xffff ),
                mt_rand( 0, 0x0fff ) | 0x4000,
                mt_rand( 0, 0x3fff ) | 0x8000,
                mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
            ));
    }

    /**
     * Get AJAX UUID.
     *
     * @return string.
     */
    public function getAjax()
    {
        return $this->ajax;
    }
}