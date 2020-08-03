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
 * @description     Allows other apps to send messages through the set-up mailmail mailboxes. Creates logs for advanced
 *                  information and a widget for the dashboard.
*}

{* Widget mailer *}
<div id="app-{$appnetos__mailer->appId}" class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mt-4">
    <div class="card bg-light border border-dark">
        <div class="bg-dark p-2">
            <div class="float-left">
                <img class="appnetos__mailer__icon mr-2" src="{$render->getUrl()}/out/admin/img/appnetos/widget_mailer.svg">
            </div>
            <h5 class="float-left text-white mt-1">
                {$strings->get('appnetos__mailer__widget_header')}
            </h5>
        </div>

        {* Widget mailer count *}
        <div id="app-{$appnetos__mailer->appId}-mailer_count">
            {$render->include('application/apps/appnetos/mailer/widget/views/mailer__count.tpl')}
        </div>

        {* Menu bottom *}
        {if $render->getUrl(500)}
            <div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appnetos__mailer__navbar" aria-controls="appnetos__mailer__navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="appnetos__mailer__navbar">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="appnetos__mailer.re(event, '{$appnetos__mailer->appId}')">
                                    {$strings->get('appnetos__mailer__widget_reset_counter')}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{$render->getUrl(500)}">
                                    {$strings->get('appnetos__mailer__widget_logs')}
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        {/if}

    </div>
</div>