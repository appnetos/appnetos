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
 * @description     core/extends.php ->    Function for multiple extend classes. Classes will be extend recursive,
 *                                         backward up to the base class.
 */

// Include base class.
include_once('core/appnetos/base.php');

/**
 * Function to recursively extends classes.
 *
 * @return array.
 */
if (!function_exists('GLOBAL__APPNETOS__EXTEND')) {
    function GLOBAL__APPNETOS__EXTEND($appnetosExtends) {
        $extendedClasses = [];
        $extendedKeys = [];
        foreach ($appnetosExtends as $indexParent => $parent) {
            if (!isset($parent['key']) || !isset($parent['children']) || !isset($parent['parent'])) {
                continue;
            }
            if (in_array($parent['key'], $extendedKeys)) {
                continue;
            }
            if (!isset($parent['active'])) {
                $parent['active'] = true;
            }
            if (!$parent['active']) {
                continue;
            }
            $explode = explode('/', $parent['parent']);
            if (APPNETOS_ADMIN) {
                if ($explode[0] === 'application') {
                    if (!in_array('admin', $explode) && !in_array('widget', $explode)) {
                        continue;
                    }
                }
            }
            else {
                if ($explode[0] === 'admin') {
                    continue;
                }
                else if (in_array('admin', $explode) || in_array('widget', $explode)) {
                    continue;
                }
            }
            array_push($extendedKeys, $parent['key']);
            $fileParent = $parent['parent'];
            if (file_exists('custom/' . $parent['parent'])) {
                $fileParent = 'custom/' . $parent['parent'];
            }
            elseif (!file_exists($fileParent)) {
                continue;
            }
            $extends = [];
            array_push($extends, $parent);
            foreach ($appnetosExtends as $indexChildren => $children) {
                if ($indexParent === $indexChildren) {
                    continue;
                }
                if (!isset($children['key']) || !isset($children['children']) || !isset($children['parent'])) {
                    continue;
                }
                if ($parent['key'] === $children['key'] && $parent['parent'] === $children['parent']) {
                    array_push($extends, $children);
                }
            }
            $extends = array_reverse($extends);
            $arrayParent = explode('/', $parent['parent']);
            $nameParent = end($arrayParent);
            $classParent = str_replace('.php', '', $nameParent);
            $namespace = '';
            $arrayKey = explode('/', $parent['key']);
            if (count($arrayKey) > 1) {
                array_pop($arrayKey);
                $namespace = implode('\\', $arrayKey);
            }
            foreach ($extends as $extend) {
                $fileChildren = $extend['children'];
                if (file_exists('custom/' . $extend['children'])) {
                    $fileChildren = 'custom/' . $extend['children'];
                }
                elseif (!file_exists($fileChildren)) {
                    continue;
                }
                $arrayChildren = explode('/', $extend['children']);
                $nameChildren = end($arrayChildren);
                $classChildren = str_replace('.php', '', $nameChildren);
                if ($namespace !== '') {
                    $eval = 'namespace ' . $namespace . ' { class ' . $classChildren . '__parent extends ' . $classParent . ' {} }';
                } else {
                    $eval = 'class ' . $classChildren . '__parent extends ' . $classParent . ' {}';
                }
                include_once($fileParent);
                eval ($eval);
                include_once($fileChildren);
                $classParent = $classChildren;
                if ($namespace !== '') {
                    $className = '\\' . $namespace . '\\' . $classParent;
                }
                else {
                    $className = '\\' . $classParent;
                }
                $extendedClasses[$parent['key']] = $className;
            }
        }
        return $extendedClasses;
    }
}

// Recursively extends classes.
if (isset($GLOBAL__APPNETOS__EXTENDS)) {
    if (is_array($GLOBAL__APPNETOS__EXTENDS)) {
        if (count($GLOBAL__APPNETOS__EXTENDS)) {
            define('EXTENDED__CLASSES', GLOBAL__APPNETOS__EXTEND($GLOBAL__APPNETOS__EXTENDS));
        }
    }
}