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
 * @description     Admin language management.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get('admin__settings__manage_language__menu_header')}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__settings__manage_languages__navbar" aria-controls="admin__settings__manage_languages__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__settings__manage_languages__navbar">
        <ul class="navbar-nav mr-auto">

            {* Menu *}
            {if $render->getUrl(401)}
                <li class="nav-item">
                    <a class="nav-link" href="{$render->getUrl(401)}">
                        {$strings->get('admin__settings__manage_language__language_settings')}
                    </a>
                </li>
            {/if}
            <li class="nav-item">
                <a class="nav-link active">
                    {$strings->get('admin__settings__manage_language__menu_header')}
                </a>
            </li>

            {* Search *}
            <h6 class="nav-item text-light mt-4">
                {$strings->get('admin__settings__manage_language__search')}
            </h6>
            <li>
                <div class="form-group">
                    <select class="form-control" id="admin__settings__manage_languages__search_number" onchange="admin__settings__manage_languages.se(0)">
                        <option value="10" {if $admin__settings__manage_languages__search->number === 10}selected{/if}>10</option>
                        <option value="25" {if $admin__settings__manage_languages__search->number === 25}selected{/if}>25</option>
                        <option value="50" {if $admin__settings__manage_languages__search->number === 50}selected{/if}>50</option>
                        <option value="100" {if $admin__settings__manage_languages__search->number === 100}selected{/if}>100</option>
                        <option value="250" {if $admin__settings__manage_languages__search->number === 250}selected{/if}>250</option>
                        <option value="500" {if $admin__settings__manage_languages__search->number === 500}selected{/if}>500</option>
                    </select>
                </div>
            </li>
            <li>
                <input id="admin__settings__manage_languages__search_search" class="form-control" onkeydown="admin__settings__manage_languages.sk(event)" placeholder="{$strings->get('admin__settings__manage_language__search')}" value="{$admin__settings__manage_languages__search->search}">
                <button class="btn btn-primary" onclick="admin__settings__manage_languages.se()">
                    {$strings->get('admin__settings__manage_language__search')}
                </button>
            </li>

        </ul>
    </div>
</nav>