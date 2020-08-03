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
 * @description     Admin edit URI and languages URIs.
 */

// Namespace.
namespace admin\cms;

// Use.
use \core\objects;

// Model "admin\cms\edit_uri__model".
class edit_uri__model
{

    /**
     * Object "core\render".
     *
     * @var object.
     */
    private $_render = null;

    /**
     * Object "core\languages".
     *
     * @var object.
     */
    public $_languages = null;

    /**
     * Initialize.
     */
    public function init()
    {
        // Get used objects.
        $this->_languages = objects::get('languages');

        // Assign.
        objects::set('admin/edit_uri/edit_uri__model', $this);
        $this->_render = objects::get('render');
        $this->_render->assign('admin__apps__management__model', $this);

        // Get object "core\uri".
        $uri = objects::get('uri');
        $index = $uri->getRequestindex();

        // If uri ID not in URI.
        if (!isset($index[3])) {
            $this->redirect();
        }

        // Get model "admin\cms\edit_uri__uris_list".
        objects::get('admin/cms/edit_uri__uris_list');
        $editUriUrisList = objects::getNew('admin/cms/edit_uri__uris_list');
        $editUriUrisList->id = (int)$index[3];
        $editUriUrisList->init();

        // If is error.
        $editUriUri = objects::get('admin/cms/edit_uri__uri');
        if ($editUriUri->error || $editUriUri->parentId !== 0) {
            $this->redirect();
        }
    }

    /**
     * Redirect.
     */
    protected function redirect()
    {
        $render = objects::get('render');
        $url = $render->getUrl(1);
        header('Location: ' . $url);
        die();
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
     * Get language.
     *
     * @param string $languageKey.
     * @return string.
     */
    public function getLanguage($languageKey)
    {
        $output = $languageKey;
        $output .= '&nbsp;&nbsp;|&nbsp;&nbsp;' . $this->_languages->getName($languageKey);
        $output .= '&nbsp;&nbsp;|&nbsp;&nbsp;' . $this->_languages->getNameEn($languageKey);
        return $output;
    }
}