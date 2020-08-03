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
 * @description     Multilingual Navbar to create extended navigation menus on base of bootstrap Navbar.
*}

{* Modal sign in *}
<div id="app-{$appnetos__navbar->appId}">

    {* Sign in *}
    {if !$appnetos__navbar->getActive() && $appnetos__navbar->settings->logon}
        <div id="app-{$appnetos__navbar->appId}-modal_sign_in" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="appnetos__navbar__modal_sign_in_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div id="app-{$appnetos__navbar->appId}-modal_sign_in_header" class="modal-header">
                        <h5 class="modal-title text-dark">{$strings->get('appnetos__navbar__sign_in')}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="app-{$appnetos__navbar->appId}-loading" class="col-12 my-4 text-center" style="display: none">
                                <img class="appnetos__navbar__loading" src="{$render->getUrl()}/out/img/appnetos/loading.gif">
                            </div>
                            <div id="app-{$appnetos__navbar->appId}-sign_in" class="col-12">
                                <div class="form-group">
                                    <label class="text-dark" for="app-{$appnetos__navbar->appId}-user">
                                        {$strings->get('appnetos__navbar__emailuser')}
                                    </label>
                                    <input type="text" class="form-control" id="app-{$appnetos__navbar->appId}-user" name="user" placeholder="{$strings->get('appnetos__navbar__emailuser')}" onkeydown="appnetos__navbar.kd(event, {$appnetos__navbar->appId})">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="text-dark" for="app-{$appnetos__navbar->appId}-pass">
                                        {$strings->get('appnetos__navbar__pass')}
                                    </label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="app-{$appnetos__navbar->appId}-pass" name="pass" placeholder="{$strings->get('appnetos__navbar__pass')}" onkeydown="appnetos__navbar.kd(event, {$appnetos__navbar->appId})">
                                        <div class="input-group-prepend" onclick="appnetos__navbar.sh({$appnetos__navbar->appId})">
                                            <div class="input-group-text">
                                                <img class="appnetos__navbar__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {if $appnetos__navbar->settings->forgetPass}
                                    <div class="mt-2">
                                        <a href="{$appnetos__navbar->getUrl($appnetos__navbar->settings->forgetPass)}">
                                            {$strings->get('appnetos__navbar__forget_pass')}
                                        </a>
                                    </div>
                                {/if}
                                <div class="form-check mt-4">
                                    <label class="form-check-label text-dark">
                                        <input id="app-{$appnetos__navbar->appId}-stay" type="checkbox" class="form-check-input">
                                        {$strings->get('appnetos__navbar__stay')}
                                    </label>
                                </div>
                            </div>
                            <div id="app-{$appnetos__navbar->appId}-error" class="col-12 my-4" style="display: none">
                                <div class="alert alert-danger m-0 text-center">
                                    {$strings->get('appnetos__navbar__denied')}
                                </div>
                            </div>
                            <div class="col-12 text-right" data-type="appnetos__navbar_sign_in">
                                <button type="button" class="btn btn-primary text-right" onclick="appnetos__navbar.si({$appnetos__navbar->appId})">
                                    {$strings->get('appnetos__navbar__sign_in')}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {$strings->get('appnetos__navbar__close')}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Navbar *}
    <nav class="navbar navbar-expand-lg{if $appnetos__navbar->settings->design === "dark"} navbar-dark bg-dark {else} navbar-light bg-light {/if} px-0">
        {if $appnetos__navbar->settings->home}
            <a class="navbar-brand" href="{$render->getUrl()}">
                {if $appnetos__navbar->settings->design === "dark"}
                    <img class="appnetos__navbar__icon" src="{$render->getUrl()}/out/img/appnetos/home_light.svg" />
                {else}
                    <img class="appnetos__navbar__icon" src="{$render->getUrl()}/out/img/appnetos/home_dark.svg" />
                {/if}
            </a>
        {/if}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-{$appnetos__navbar->appId}-navbar" aria-controls="appnetos__navbar__{$appnetos__navbar->appId}" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="app-{$appnetos__navbar->appId}-navbar" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                {if $appnetos__navbar__list->entries}
                    {foreach from=$appnetos__navbar__list->entries item='appnetos__navbar__entry' key='appnetos__navbar__key'}
                        {if !$appnetos__navbar__entry.submenus|count>0}
                            <li class="nav-item">
                                <a class="nav-link{if $appnetos__navbar->settings->design === 'dark'} text-light {else} text-dark {/if}" href="{$appnetos__navbar__entry.link}" target="{$appnetos__navbar__entry.target}">
                                    {$appnetos__navbar__entry.name}
                                </a>
                            </li>
                        {else}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle{if $appnetos__navbar->settings->design === 'dark'} text-light {else} text-dark {/if}" href="#" id="app-{$appnetos__navbar->appId}-dropdown{$appnetos__navbar__key}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {$appnetos__navbar__entry.name}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="app-{$appnetos__navbar->appId}-dropdown{$appnetos__navbar__key}">
                                    {foreach from=$appnetos__navbar__entry.submenus item='appnetos__navbar__submenus_entry' key='appnetos__navbar__submenus_key'}
                                        <a class="dropdown-item" href="{$appnetos__navbar__submenus_entry.link}" target="{$appnetos__navbar__submenus_entry.target}">
                                            {$appnetos__navbar__submenus_entry.name}
                                        </a>
                                    {/foreach}
                                </div>
                            </li>
                        {/if}
                    {/foreach}
                {/if}
            </ul>
            {if $appnetos__navbar->settings->logon}
                {if !$appnetos__navbar->getActive()}
                    <button class="btn btn-primary my-2 my-sm-0" type="button" data-toggle="modal" data-target="#app-{$appnetos__navbar->appId}-modal_sign_in">
                        {$strings->get('appnetos__navbar__sign_in')}
                    </button>
                    {if $appnetos__navbar->settings->signup}
                        <a href="{$appnetos__navbar->getUrl($appnetos__navbar->settings->signup)}">
                            <button class="btn btn-primary my-2 my-sm-0 ml-2" type="button">
                                {$strings->get('appnetos__navbar__sign_up')}
                            </button>
                        </a>
                    {/if}
                {else}
                    <button class="btn btn-primary my-2 my-sm-0" type="button" onclick="appnetos__navbar.so()">
                        {$strings->get('appnetos__navbar__sign_out')}
                    </button>
                {/if}
            {/if}
        </div>
    </nav>

</div>