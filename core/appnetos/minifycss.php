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
 * @description     core/appnetos/minifycss.php ->    Class to minify css. Minify single CSS file or minify all
 *                  active apps CSS files to file "main.min.css".
 */

// Namespace.
namespace core;

// Class "core\minifycss".
class minifycss extends base
{

    /**
     * Path of min file.
     *
     * @var string.
     */
    protected $fileMin = 'out/css/main.min.css';

    /**
     * Path of files.
     *
     * @var array.
     */
    protected $files = [];

    /**
     * If is error.
     *
     * @var bool.
     */
    protected $error = false;

    /**
     * Minify CSS to "main.min.css".
     *
     * @return bool.
     * @throws exception.
     */
    public function minify()
    {
        // Initialize files.
        $this->initFiles();

        // Initialize file.
        $this->initFile();

        // If is error.
        if ($this->error) {
            return false;
        }

        // return.
        return true;
    }

    /**
     * Initialize files.
     */
    protected function initFiles()
    {
        // Get all app files from database table "application_apps".
        $database = objects::get('database');
        $query = 'SELECT xt_namespace, xt_directory, xt_name FROM application_apps WHERE xt_active=1 AND xt_css_cache=1';
        $array = $database->selectArray($query);

        // If data not exists.
        if (!$array) {
            return;
        }

        // Get files.
        $tmp = [];
        for ($i = 0; $i < count($array); $i++) {

            // Prepare parameters.
            $tmpName = str_replace('\\', '__', $array[$i]['xt_namespace']) . '__' . $array[$i]['xt_name'];
            $isSet = false;

            // Check if file already added.
            for ($iTmp = 0; $iTmp < count($tmp); $iTmp++) {
                if ($tmpName === $tmp[$iTmp]) {
                    $isSet = true;
                    break;
                }
            }

            // If file already added.
            if ($isSet) {
                continue;
            }

            // Add fle.
            array_push($tmp, $tmpName);
            $name = strtolower(str_replace(' ', '_', trim($array[$i]['xt_name'])));
            $directory = trim($array[$i]['xt_directory'], ' /\\');
            $directory = str_replace(['/\\'], '/', $directory);
            if (file_exists(BASEPATH . 'custom/application/apps/' . $directory . '/' . $name . '/application/css/' . $name . '.css')) {
                array_push($this->files, BASEPATH . 'custom/application/apps/' . $directory . '/' . $name . '/application/css/' . $name . '.css');
            }
            elseif (file_exists(BASEPATH . 'application/apps/' . $directory . '/' . $name . '/application/css/' . $name . '.css')) {
                array_push($this->files, BASEPATH . 'application/apps/' . $directory . '/' . $name . '/application/css/' . $name . '.css');
            }
        }
    }

    /**
     * Initialize files.
     *
     * @throws exception. Error: Save "main.min.css" error.
     */
    protected function initFile()
    {
        // Get all CSS files.
        $css = '';
        foreach ($this->files as $file) {
            $sub = explode('/', $file);
            $search = '';
            for ($i = 0; $i < count($sub); $i++) {
                $search .= '../';
            }
            $content = file_get_contents($file);
            $content = str_replace($search, '../../', $content);
            $css .= $content;
        }

        // Minify CSS.
        $css = $this->minifyCss($css);

        // Save file.
        if (file_put_contents($this->fileMin, $css)) {
            return;
        }

        // If is error.
        $this->error = true;
        throw new exception('Save "main.min.css" error');
    }

    /**
     * Minify CSS.
     *
     * @param string $css.
     * @return string.
     */
    public function minifyCss($css)
    {
        // Remove comments.
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);

        // Backup values within single or double quotes.
        preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
        for ($i = 0; $i < count($hit[1]); $i++) {
            $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
        }

        // Remove traling semicolon of selector's last property.
        $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);

        // Remove any whitespace between semicolon and property-name.
        $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);

        // Remove any whitespace surrounding property-colon.
        $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);

        // Remove any whitespace surrounding selector-comma.
        $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);

        // Remove any whitespace surrounding opening parenthesis.
        $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);

        // Remove any whitespace between numbers and units.
        $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);

        // Shorten zero-values.
        $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);

        // Constrain multiple whitespaces.
        $css = preg_replace('/\p{Zs}+/ims', ' ', $css);

        // Remove newlines
        $css = str_replace(array("\r\n", "\r", "\n"), '', $css);

        // Restore backupped values within single or double quotes.
        for ($i = 0; $i < count($hit[1]); $i++) {
            $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
        }

        // Return.
        return $css;
    }
}