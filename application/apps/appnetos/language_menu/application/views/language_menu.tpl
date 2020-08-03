{*
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
 * @description     Language Menu, lists all languages and sets the language cookie by
 *                  selection.
*}

{* Button open close *}
<div id="app-{$appnetos__language_menu->appId}">
    <div class="text-right">
        <div id="app-{$appnetos__language_menu->appId}-btn" class="appnetos__language_menu__btn" onclick="appnetos__language_menu.to(event, {$appnetos__language_menu->appId})">
            <svg class="appnetos_language_menu_svg" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 75 75" x="0" y="100">
                <g
                        transform="scale(0.13837638)"
                        style="fill:currentColor">
                    <path
                            d="M 0,0 H 542 V 542 H 0 V 0 m 147.66,53.83 c -0.14,14.67 0,29.35 -0.07,44.02 -30.85,0.29 -61.71,-0.01 -92.57,0.15 -0.06,14.33 -0.04,28.65 -0.01,42.98 60.33,0.08 120.66,-0.05 180.99,0.06 -3.33,19.38 -9.38,38.45 -19.49,55.4 -13.94,23.96 -35.82,42.67 -60.66,54.64 -14.75,-8.31 -26.37,-21.25 -35.85,-35.09 -9.72,-14.71 -17.87,-31.24 -19.1,-49.09 -15.31,-0.09 -30.62,-0.07 -45.93,-0.02 0.3,14.1 4.06,27.91 9.08,41.01 8.91,22.52 21.72,43.77 39.19,60.7 -15.89,3.01 -32.09,3.66 -48.21,4.22 -0.05,14.64 -0.1,29.29 0.02,43.93 33.56,-0.59 67.04,-6.43 98.76,-17.38 29.61,11.55 61.38,17.16 93.13,17.4 0.17,-14.65 0.1,-29.3 0.04,-43.95 -11.96,-0.32 -23.93,-1.21 -35.73,-3.23 11.73,-8.87 23.23,-18.24 32.67,-29.62 23.88,-27.47 37.12,-62.98 41.07,-98.89 0.09,-14.35 0.07,-28.71 0,-43.06 -30.78,-0.12 -61.57,0.01 -92.36,-0.07 -0.23,-14.63 -0.07,-29.28 -0.07,-43.92 -14.95,-0.5 -29.94,-0.13 -44.9,-0.19 M 235,479.76 c 20.48,-0.13 40.97,0.16 61.46,-0.15 6.55,-18.15 12.85,-36.4 19.64,-54.47 33.56,0.04 67.13,-0.03 100.69,0.04 6.66,18.12 13.02,36.36 19.63,54.5 20.45,0.14 40.91,-0.01 61.37,0.08 C 462.96,392.07 428.07,304.4 393,216.81 c -17.69,-0.06 -35.39,0.03 -53.08,-0.05 -35.29,87.53 -69.99,175.32 -104.92,263 z"
                            style="opacity:1;fill:currentColor" />
                    <path
                            d="m 331.43,382.09 c 11.65,-32.81 22.81,-65.86 35.12,-98.4 11.66,32.77 23.39,65.52 34.79,98.39 -23.3,0.11 -46.61,0.09 -69.91,0.01 z"
                            style="opacity:1;fill:currentColor" />
                </g>
                <g
                        transform="scale(0.13837638)">
                    <path
                            d="m 147.66,53.83 c 14.96,0.06 29.95,-0.31 44.9,0.19 0,14.64 -0.16,29.29 0.07,43.92 30.79,0.08 61.58,-0.05 92.36,0.07 0.07,14.35 0.09,28.71 0,43.06 -3.95,35.91 -17.19,71.42 -41.07,98.89 -9.44,11.38 -20.94,20.75 -32.67,29.62 11.8,2.02 23.77,2.91 35.73,3.23 0.06,14.65 0.13,29.3 -0.04,43.95 -31.75,-0.24 -63.52,-5.85 -93.13,-17.4 -31.72,10.95 -65.2,16.79 -98.76,17.38 -0.12,-14.64 -0.07,-29.29 -0.02,-43.93 16.12,-0.56 32.32,-1.21 48.21,-4.22 -17.47,-16.93 -30.28,-38.18 -39.19,-60.7 -5.02,-13.1 -8.78,-26.91 -9.08,-41.01 15.31,-0.05 30.62,-0.07 45.93,0.02 1.23,17.85 9.38,34.38 19.1,49.09 9.48,13.84 21.1,26.78 35.85,35.09 24.84,-11.97 46.72,-30.68 60.66,-54.64 10.11,-16.95 16.16,-36.02 19.49,-55.4 -60.33,-0.11 -120.66,0.02 -180.99,-0.06 -0.03,-14.33 -0.05,-28.65 0.01,-42.98 30.86,-0.16 61.72,0.14 92.57,-0.15 0.07,-14.67 -0.07,-29.35 0.07,-44.02 z"
                            style="opacity:0;fill:#ffffff" />
                    <path
                            d="m 235,479.76 c 34.93,-87.68 69.63,-175.47 104.92,-263 17.69,0.08 35.39,-0.01 53.08,0.05 35.07,87.59 69.96,175.26 104.79,262.95 -20.46,-0.09 -40.92,0.06 -61.37,-0.08 -6.61,-18.14 -12.97,-36.38 -19.63,-54.5 -33.56,-0.07 -67.13,0 -100.69,-0.04 -6.79,18.07 -13.09,36.32 -19.64,54.47 -20.49,0.31 -40.98,0.02 -61.46,0.15 m 96.43,-97.67 c 23.3,0.08 46.61,0.1 69.91,-0.01 -11.4,-32.87 -23.13,-65.62 -34.79,-98.39 -12.31,32.54 -23.47,65.59 -35.12,98.4 z"
                            style="opacity:0;fill:#ffffff" />
                </g>
            </svg>
            <span>{$appnetos__language_menu->getName($appnetos__language_menu->getActive())}</span>
        </div>
    </div>

    {* Selection *}
    <div id="app-{$appnetos__language_menu->appId}-sel" class="appnetos__language_menu__sel text-right" style="display: none;" onclick="appnetos__language_menu.uf(event)">
        {assign var='appnetos__language_menu__languages' value=$appnetos__language_menu->getLanguages()}
        {foreach from=$appnetos__language_menu__languages item='appnetos__language_menu__language' name='appnetos__language_menu__language_name'}
            {if $appnetos__language_menu__language->key !== 'global'}
                <span onclick="appnetos__language_menu.se(event, '{$appnetos__language_menu__language->key}');">{$appnetos__language_menu->getName($appnetos__language_menu__language->key)}</span>
                {if not $smarty.foreach.appnetos__language_menu__language_name.last}
                    &nbsp&bull;&nbsp
                {/if}
            {/if}
        {/foreach}
    </div>
</div>