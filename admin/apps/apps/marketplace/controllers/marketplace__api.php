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

// Controller "admin\apps\marketplace__api".
class marketplace__api
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
     * APPNET OS API URL.
     *
     * @var string.
     */
    protected $url = null;

    /**
     * Used object "admin\apps\marketplace__user".
     *
     * @var object.
     */
    protected $_marketplaceUser = null;

    /**
     * marketplace_api constructor.
     */
    public function __construct()
    {
        // Set APPNET OS data.
        $this->version = APPNETOS_VERSION;
        $this->url = APPNETOS_URL . 'api/';
        $languages = objects::get('languages');
        $this->language = $languages->getAdminActiveMain();

        // Set used objects.
        $this->_marketplaceUser = objects::get('admin/apps/marketplace__user');
    }

    /**
     * Call APPNET OS API.
     *
     * @param string $call.
     * @param array $data.
     * @return mixed.
     * @throws.
     */
    public function call($call, $data = [])
    {
        // If call not is set.
        if (!$call) {
            return false;
        }

        // Set user data.
        $this->user = [
            'token'   => $this->_marketplaceUser->token,
            'secret'   => $this->_marketplaceUser->secret,
            'session' => $this->_marketplaceUser->session,
            'user'    => $this->_marketplaceUser->user
        ];

        // Call APPNET OS API.
        $this->data = $data;
        $content = json_encode($this);
        $url = $this->url . $call;
        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => $content
            ]
        ];
        $context = stream_context_create($options);
        $result = null;
        try {
            $resultRaw = @file_get_contents($url, false, $context);
            $result = json_decode($resultRaw, true);
        } catch (Exception $e) {
            return false;
        }

        // Check result.
        if (!is_array($result)) {
            return false;
        }
        if (!key_exists('user', $result) ||
            !key_exists('data', $result) ||
            !key_exists('url', $result))
        {
            return false;
        }

        // Set user data.
        if (!$this->_marketplaceUser->update($result['user'])) {
            return false;
        }

        // Set URL data.
        $marketplaceUrl = objects::get('admin/apps/marketplace__url', true);
        $marketplaceUrl->update($result['url']);

        // Return data.
        return $result['data'];
    }
}