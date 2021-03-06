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
 * @description     Admin section dashboard widget to show apps information.
*}

{* Widget Apps *}
<div id="app-{$appnetos__widgets__widget_apps->appId}" class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mt-4">
    <div class="card bg-light border border-dark">

        {* Header *}
        <div class="bg-dark p-2">
            <div class="float-left"><img class="appnetos__widget__widget_apps__icon mr-2" src="{$render->getUrl()}/out/admin/img/appnetos/widget_apps.svg"></div>
            <h5 class="float-left text-white mt-1">{$strings->get('appnetos__widgets__widget_apps__apps')}</h5>
        </div>

        {* List apps *}
        <div>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {$strings->get('appnetos__widgets__widget_apps__total')}
                    <span class="badge badge-primary badge-pill rounded">{$appnetos__widgets__widget_apps->total}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {$strings->get('appnetos__widgets__widget_apps__active')}
                    <span class="badge badge-primary badge-pill rounded">{$appnetos__widgets__widget_apps->active}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {$strings->get('appnetos__widgets__widget_apps__top')}
                    <span class="badge badge-primary badge-pill rounded">{$appnetos__widgets__widget_apps->staticTop}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {$strings->get('appnetos__widgets__widget_apps__bottom')}
                    <span class="badge badge-primary badge-pill rounded">{$appnetos__widgets__widget_apps->staticBottom}</span>
                </li>
            </ul>
        </div>

        {* Menu *}
        {if $render->getUrl(300) || $render->getUrl(301) || $render->getUrl(302)}
            <div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appnetos__widget__widget_apps__navbar" aria-controls="appnetos__widget__widget_apps__navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="appnetos__widget__widget_apps__navbar">
                        <ul class="navbar-nav mr-auto">
                            {if $render->getUrl(300)}
                                <li class="nav-item">
                                    <a class="nav-link" href="{$render->getUrl(300)}">{$strings->get('appnetos__widgets__widget_apps__app_management')}</a>
                                </li>
                            {/if}
                            {if $render->getUrl(301) || $render->getUrl(302)}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="appnetos__widget__widget_apps__dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {$strings->get('appnetos__widgets__widget_apps__static')}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="appnetos__widget__widget_apps__dropdown">
                                        {if $render->getUrl(301)}
                                            <a class="dropdown-item" href="{$render->getUrl(301)}">{$strings->get('appnetos__widgets__widget_apps__top')}</a>
                                        {/if}
                                        {if $render->getUrl(302)}
                                            <a class="dropdown-item" href="{$render->getUrl(302)}">{$strings->get('appnetos__widgets__widget_apps__bottom')}</a>
                                        {/if}
                                    </div>
                                </li>
                            {/if}
                        </ul>
                    </div>
                </nav>
            </div>
        {/if}

    </div>
</div>