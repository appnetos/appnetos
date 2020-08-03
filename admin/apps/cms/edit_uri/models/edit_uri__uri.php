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

// Model "admin\cms\edit_uri__uri".
class edit_uri__uri
{

    /**
     * ID.
     *
     * @var int.
     */
    public $id = null;

    /**
     * Parent ID.
     *
     * @var int.
     */
    public $parentId = null;

    /**
     * Language key.
     *
     * @var int.
     */
    public $languageKey = null;

    /**
     * Title.
     *
     * @var string.
     */
    public $title = null;

    /**
     * Favicon.
     *
     * @var string.
     */
    public $favicon = null;

    /**
     * Canonical URI ID.
     *
     * @var string.
     */
    public $canonical = 0;

    /**
     * Meta title.
     *
     * @var string.
     */
    public $metaTitle = '';

    /**
     * Meta description.
     *
     * @var string.
     */
    public $metaDescription = '';

    /**
     * Meta keywords.
     *
     * @var string.
     */
    public $metaKeywords = '';

    /**
     * Meta.
     *
     * @var array.
     */
    public $meta = [];

    /**
     * URI.
     *
     * @var string.
     */
    public $uri = null;

    /**
     * Apps.
     *
     * @var array.
     */
    public $apps = [];

    /**
     * Apps count.
     *
     * @var int.
     */
    public $appsCount = 0;

    /**
     * Include apps.
     *
     * @var array.
     */
    public $include = [];

    /**
     * Include apps count.
     *
     * @var int.
     */
    public $includeCount = 0;

    /**
     * Views.
     *
     * @var int.
     */
    public $views = 0;

    /**
     * Languages children.
     *
     * @var array.
     */
    public $languages = [];

    /**
     * Languages children count.
     *
     * @var int.
     */
    public $languagesCount = 0;

    /**
     * Protected level.
     *
     * @var int.
     */
    public $protected = null;

    /**
     * Tab open.
     */
    public $tab = 'properties';

    /**
     * If is error.
     *
     * @var bool.
     */
    public $error = false;

    /**
     * AJAX error message.
     *
     * @var string.
     */
    public $ajaxError = null;

    /**
     * AJAX confirm message.
     *
     * @var string.
     */
    public $ajaxConfirm = null;

    /**
     * URI illegal characters.
     *
     * @var array
     */
    protected $illegalCharacters = [";", "?", ":", "@", "=", "&", "'", "\\", "\"", "<", ">", "#", "%", "{", "}", "|", "^", "~", "[", "]", "`", " "];

    /**
     * Initialize.
     */
    public function init()
    {
        // Select from database table "application_cms".
        $database = objects::get('database');
        $query = 'SELECT * FROM application_cms WHERE xt_id=?';
        $row = $database->selectRow($query, [$this->id]);

        // If data not exists.
        if (!$row) {
            $this->error = true;
            return;
        }

        // Set data to class.
        $this->title = $row['xt_title'];
        $this->parentId = $row['xt_parent_id'];
        $this->parentId = (int)$this->parentId;
        $this->languageKey = $row['xt_language_key'];
        $this->favicon = $row['xt_favicon'];
        $this->canonical = $row['xt_canonical_id'];
        $this->canonical = (int)$this->canonical;
        $this->uri = $row['xt_uri'];
        $apps = trim($row['xt_apps']);
        if ($apps) {
            $this->apps = array_map('intval', explode('|', $apps));
        }
        $include = trim($row['xt_include']);
        if ($include) {
            $this->include = array_map('intval', explode('|', $include));
        }
        $this->views = $row['xt_views'];
        $this->protected = $row['xt_protected'];
        $this->protected = (int)$this->protected;
        $meta = $row['xt_meta'];
        if ($meta) {
            $meta = json_decode($meta);
            foreach ($meta as $object) {
                if ($object->nameTag === 'name' && $object->name === 'title' && $object->contentTag === 'content') {
                    $this->metaTitle = $object->content;
                }
                elseif ($object->nameTag === 'name' && $object->name === 'description' && $object->contentTag === 'content') {
                    $this->metaDescription = $object->content;
                }
                elseif ($object->nameTag === 'name' && $object->name === 'keywords' && $object->contentTag === 'content') {
                    $this->metaKeywords = $object->content;
                }
                else {
                    array_push($this->meta, $object);
                }
            }
        }

        // Get languages.
        if (!$this->parentId) {

            // Select from database table "application_cms".
            $query = 'SELECT xt_id FROM application_cms WHERE xt_parent_id=?';
            $array = $database->selectArray($query, [$this->id]);

            // Set languages.
            if ($array) {
                for ($i = 0; $i < count($array); $i++) {
                    $editUriUri = objects::getNew('admin/cms/edit_uri__uri');
                    $editUriUri->id = (int)$array[$i]['xt_id'];
                    $editUriUri->init();
                    array_push($this->languages, $editUriUri);
                }
            }
        }
        $this->languagesCount = count($this->languages);
    }

    /**
     * Edit URI.
     */
    public function editUri()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__cms__edit_uri__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render(true,'admin__cms__edit_uri__err_load');
        }

        // Prepare parameters.
        $this->tab = 'edit';
        $this->id = null;
        $uri = null;
        $title = null;
        $favicon = null;
        $canonical = null;

        // Generate URI tags.
        foreach ($parameters as $parameter) {
            if ($parameter['name'] === 'id') {
                $this->id = (int)$parameter['value'];
            }
            elseif ($parameter['name'] === 'uri') {
                $uri = trim($parameter['value']);
            }
            elseif ($parameter['name'] === 'title') {
                $title = trim($parameter['value']);
            }
            elseif ($parameter['name'] === 'favicon') {
                $favicon = trim($parameter['value']);
            }
            elseif ($parameter['name'] === 'canonical') {
                $canonical = (int)$parameter['value'];
            }
        }

        // If parameters wrong.
        if (!$this->id) {
            $this->render(true,'admin__cms__edit_uri__err_edit');
        }

        // Initialize.
        $this->init();

        // If URI is invalid.
        foreach ($this->illegalCharacters as $illegalCharacter) {
            if (strpos($uri, $illegalCharacter)) {
                $this->render(false,'admin__cms__edit_uri__err_add_valid');
            }
        }

        // If URI already exists.
        $database = objects::get('database');
        $query = 'SELECT xt_id FROM application_cms WHERE xt_uri=?';
        $row = $database->selectRow($query, [$uri]);
        if ($row) {
            if ($this->id !== (int)$row['xt_id']) {
                $this->render(false,'admin__cms__edit_uri__add_exists');
            }
        }

        // Update database table "application_cms".
        $database = objects::get('database');
        $query = 'UPDATE application_cms SET xt_title=?, xt_favicon=?, xt_canonical_id=?, xt_uri=? WHERE xt_id=?';
        $database->update($query, [$title, $favicon, $canonical, $uri, $this->id]);

        // Render AJAX template.
        $this->meta = [];
        $this->init();
        $this->render(false, null, 'admin__cms__edit_uri__conf_edit');
    }

    /**
     * Edit meta.
     */
    public function editMeta()
    {
        // Get POST parameters.
        $post = objects::get('post');
        $parameters = $post->get('admin__cms__edit_uri__parameters');

        // If parameters wrong.
        if (gettype($parameters) !== 'array') {
            $this->render(true,'admin__cms__edit_uri__err_load');
        }

        // Prepare parameters.
        $this->tab = 'meta';
        $this->id = null;
        $meta = [];

        // Generate meta tags.
        foreach ($parameters as $parameter) {
            if ($parameter['name'] === 'id') {
                $this->id = (int)$parameter['value'];
                continue;
            }
            foreach ($this->illegalCharacters as $illegalCharacter) {
                if ($illegalCharacter !== ' ') {
                    $parameter['value'] = str_replace($illegalCharacter, '', $parameter['value']);
                }
            }
            $parameter['value'] = trim($parameter['value']);
            if ($parameter['name'] === 'meta_title') {
                if (strlen($parameter['value']) > 70) {
                    $parameter['value'] = substr($parameter['value'], 0, 70);
                }
                $this->metaTitle = $parameter['value'];
            }
            elseif ($parameter['name'] === 'meta_keywords') {
                if (strlen($parameter['value']) > 70) {
                    $parameter['value'] = substr($parameter['value'], 0, 100);
                }
                $this->metaKeywords = $parameter['value'];
            }
            elseif ($parameter['name'] === 'meta_description') {
                if (strlen($parameter['value']) > 320) {
                    $parameter['value'] = substr($parameter['value'], 0, 320);
                }
                $this->metaDescription = $parameter['value'];
            }
            elseif (strpos($parameter['name'], 'meta_name_tag_') !== false) {
                $index = str_replace('meta_name_tag_', '', $parameter['name']);
                $nameTag = trim($parameter['value']);
                $meta[$index]['name_tag'] = $nameTag;
            }
            elseif (strpos($parameter['name'], 'meta_name_') !== false) {
                $index = str_replace('meta_name_', '', $parameter['name']);
                $name = trim($parameter['value']);
                $meta[$index]['name'] = $name;
            }
            elseif (strpos($parameter['name'], 'meta_content_tag_') !== false) {
                $index = str_replace('meta_content_tag_', '', $parameter['name']);
                $contentTag = trim($parameter['value']);
                $meta[$index]['content_tag'] = $contentTag;
            }
            elseif (strpos($parameter['name'], 'meta_content_') !== false) {
                $index = str_replace('meta_content_', '', $parameter['name']);
                $content = trim($parameter['value']);
                $meta[$index]['content'] = $content;
            }
        }

        // If ID not exists.
        if (!$this->id) {
            $this->render(true,'admin__cms__edit_uri__err_load');
        }

        // Sort meta tags.
        $this->meta = [];
        foreach ($meta as $value) {
            if ($value['name_tag'] && $value['name'] && $value['content_tag'] && $value['content']) {
                $object = new \stdClass();
                $object->nameTag = $value['name_tag'];
                $object->name = $value['name'];
                $object->contentTag = $value['content_tag'];
                $object->content = $value['content'];
                array_push($this->meta, $object);
            }
        }

        // Add default meta tags.
        $meta = $this->meta;
        if ($this->metaTitle) {
            $object = new \stdClass();
            $object->nameTag = 'name';
            $object->name = 'title';
            $object->contentTag = 'content';
            $object->content = $this->metaTitle;
            array_push($meta, $object);
        }
        if ($this->metaKeywords) {
            $object = new \stdClass();
            $object->nameTag = 'name';
            $object->name = 'keywords';
            $object->contentTag = 'content';
            $object->content = $this->metaKeywords;
            array_push($meta, $object);
        }
        if ($this->metaDescription) {
            $object = new \stdClass();
            $object->nameTag = 'name';
            $object->name = 'description';
            $object->contentTag = 'content';
            $object->content = $this->metaDescription;
            array_push($meta, $object);
        }
        $json = json_encode($meta);

        // Update database table "application_cms".
        $database = objects::get('database');
        $query = 'UPDATE application_cms SET xt_meta=? WHERE xt_id=?';
        $database->update($query, [$json, $this->id]);

        // Render AJAX template.
        $this->meta = [];
        $this->init();
        $this->render(false, null, 'admin__cms__edit_uri__conf_edit');
    }

    /**
     * Render.
     * Echo rendered template.
     *
     * @param bool $setError.
     * @param string $confirm string.
     * @param string $error string.
     * @throws exception.
     */
    protected function render($setError = false, $error = null, $confirm = null)
    {
        // Prepare parameters.
        $strings = objects::get('strings');
        $render = objects::get('render');

        // Set object.
        if ($setError) {
            $this->error = true;
        }
        if ($error) {
            $this->ajaxError = $strings->get($error);
        }
        if ($confirm) {
            $this->ajaxConfirm = $strings->get($confirm);
        }
        $render->assign('admin__cms__edit_uri__uri', $this);

        // Render template.
        $output = $render->fetch('admin/apps/cms/edit_uri/views/edit_uri__uri.tpl');
        echo $output;
        exit;
    }

    /**
     * Get languages.
     *
     * @return string.
     */
    public function getLanguages()
    {
        $array = [];
        array_push($array, 'global');
        foreach ($this->languages as $language) {
            array_push($array, $language->languageKey);
        }
        if (count($array)) {
            return implode(' | ', $array);
        }
    }
}