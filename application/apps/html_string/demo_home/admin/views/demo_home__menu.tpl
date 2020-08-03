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
 * @description     HTML string App.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">Demo Home</div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appnetos__html_string__demo_home__demo_home" aria-controls="appnetos__html_string__demo_home__demo_home" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="appnetos__html_string__demo_home__demo_home">
        <ul class="navbar-nav mr-auto">
            {if $appnetos__html_string__demo_home__demo_home->html}
            <li class="nav-item">
                <a class="nav-link text-light" href="{$render->getUrl(303)}/{$appnetos__html_string__demo_home__demo_home->id}/wysiwyg">
                    <i class="fas fa-file-code  fa-menu-size"></i>
                    {$strings->get("admin__apps__html_string__text_mode")}
                </a>
            </li>
            {else}
            <li class="nav-item">
                <a class="nav-link text-light" href="{$render->getUrl(303)}/{$appnetos__html_string__demo_home__demo_home->id}">
                    <i class="fas fa-file-code  fa-menu-size">
                    </i>{$strings->get("admin__apps__html_string__html_mode")}
                </a>
            </li>
            {/if}
        </ul>
    </div>
</nav>