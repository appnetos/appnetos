<?php
/**
 * START LICENSE HEADER
 *
 * The license header may not be removed.
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
 */

/**
 * HTML source code compressor for smarty template engine.
 * Activate: Smarty->loadFilter('output', 'xtrose_compress');
 *
 * @param $source string.
 * @return string.
 */
function smarty_outputfilter_xtrose_compress($source)
{
    $result = '';
    $lines = explode("\n", $source);
    foreach ($lines as $line) {
        $line = trim($line);
        if (strlen($line)) {
            $result .= $line . "\n";
        }
    }

    return $result;
}