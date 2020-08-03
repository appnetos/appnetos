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
 * @description     Admin section dashboard widget to show cache settings and cache options.
*}

{* Widget cache *}
<div id="app-{$appnetos__widgets__widget_cache->appId}" class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mt-4">
    <div class="card border border-dark">

        {* Header *}
        <div class="bg-dark p-2">
            <div class="float-left"><img class="appnetos__widget__widget_cache__icon mr-2" src="{$render->getUrl()}/out/admin/img/appnetos/widget_cache.svg"></div>
            <h5 class="float-left text-light mt-1">
                {$strings->get('appnetos__widgets__cache__header')}
            </h5>
        </div>

        {* List caches *}
        <div id="appnetos__widgets__widget_cache__list">
            {$render->include('application/apps/appnetos/widget_cache/widget/views/widget_cache__list.tpl')}
        </div>

        {* Menu *}
        <div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appnetos__widget__widget_cache__navbar" aria-controls="appnetos__widget__widget_cache__navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="appnetos__widget__widget_cache__navbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="appnetos__widgets__widget_cache.ex(event, 'clearAll')">
                                {$strings->get('appnetos__widgets__cache__clear_all')}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="appnetos__widget__widget_cache__dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {$strings->get('appnetos__widgets__cache__clear')}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="appnetos__widget__widget_cache__dropdown">
                                <a class="dropdown-item" href="#" onclick="appnetos__widgets__widget_cache.ex(event, 'clearData')">
                                    {$strings->get('appnetos__widgets__cache__clear_data')}
                                </a>
                                <a class="dropdown-item" href="#" onclick="appnetos__widgets__widget_cache.ex(event, 'clearCompile')">
                                    {$strings->get('appnetos__widgets__cache__clear_compile')}
                                </a>
                                <a class="dropdown-item" href="#" onclick="appnetos__widgets__widget_cache.ex(event, 'clearJs')">
                                    {$strings->get('appnetos__widgets__cache__clear_js')}</a>
                                <a class="dropdown-item" href="#" onclick="appnetos__widgets__widget_cache.ex(event, 'clearCss')">
                                    {$strings->get('appnetos__widgets__cache__clear_css')}</a>
                                <a class="dropdown-item" href="#" onclick="appnetos__widgets__widget_cache.ex(event, 'clearFile')">
                                    {$strings->get('appnetos__widgets__cache__clear_file')}
                                </a>
                                <a class="dropdown-item" href="#" onclick="appnetos__widgets__widget_cache.ex(event, 'clearDirectory')">
                                    {$strings->get('appnetos__widgets__cache__clear_directory')}
                                </a>
                                <a class="dropdown-item" href="#" onclick="appnetos__widgets__widget_cache.ex(event, 'clearString')">
                                    {$strings->get('appnetos__widgets__cache__clear_string')}
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>