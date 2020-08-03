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
 * @description     Admin app installer to install or reinstall apps with install events.
 *}


{* AJAX error *}
{if $admin__apps__install__app->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__apps__install__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__apps__install__app->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__apps__install__app->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__apps__install__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__apps__install__app->ajaxConfirm}
        </div>
    </div>
{/if}

{* App *}
<div class="col-12 mt-4" data-type="admin__apps__install__app">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="float-left mt-2 mr-4">
                {if $admin__apps__install__app->image}
                    <img class="admin__apps__install__icon rounded mr-2" src="{$render->getUrl()}/application/apps/{$admin__apps__install__app->directory}/image.{$admin__apps__install__app->image}">
                {/if}
                {$admin__apps__install__app->name}
            </h5>
            <div class="form-inline float-right">
                <div class="tool-tip">
                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__apps__install.ie(this, '{$admin__apps__install__app->directory}')">
                        <i class="fa fa-hdd"></i>
                    </button>
                    <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__install__install')}</span>
                </div>
            </div>
        </div>

        {* Information *}
        <div class="card-body bg-light text-dark">
            <div class="float-left">
                {if $admin__apps__install__app->ids|count > 0}
                    <div class="my-1">
                        <strong>
                            {$strings->get('admin__apps__install__id')}:
                        </strong>
                        {foreach from=$admin__apps__install__app->ids item='admin__apps__install__id' name='admin__apps__install__name'}
                            <a href="{$render->getUrl(306)}/{$admin__apps__install__id}">
                                {$admin__apps__install__id}
                            </a>
                            {if not $smarty.foreach.admin__apps__install__name.last} | {/if}
                        {/foreach}
                    </div>
                {else}
                    <div class="my-1">
                        {$strings->get('admin__apps__install__id')}: <span class="text-warning mt-2">{$strings->get('admin__apps__install__not_installed')}</span>
                    </div>
                {/if}
            </div>
            <div class="form-inline float-right">
                {if $admin__apps__install__app->installed}
                    <span class="bg-success text-light rounded py-1 px-2">{$strings->get('admin__apps__install__installed')}</span>
                {else}
                    <span class="bg-warning text-light rounded py-1 px-2">{$strings->get('admin__apps__install__not_installed')}</span>
                {/if}
            </div>
        </div>

        {* Menu *}
        <div class="card-body bg-light text-dark p-0">
            <div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="" data-nav="description" onclick="admin__apps__install.tc(event, this, 'description')">
                            {$strings->get('admin__apps__install__description')}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-nav="license" onclick="admin__apps__install.tc(event, this, 'license')">
                            {$strings->get('admin__apps__install__license')}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {* Description *}
        <div class="card-body bg-white text-dark" data-type="description">
            <div class="row">
                {assign var="admin__apps__install__col" value="col-12"}
                {if $admin__apps__install__app->image}
                    {assign var="admin__apps__install__col" value="col-12 col-md-8 col-lg-9 col-xl-10"}
                    <div class="col-12 col-md-4 col-lg-3 col-xl-2 mb-4">
                        <img src="{$render->getUrl()}/application/apps/{$admin__apps__install__app->directory}/image.{$admin__apps__install__app->image}" class="admin__apps__install__image_description mr-4">
                    </div>
                {/if}
                <div class="{$admin__apps__install__col}">
                    <div class="admin__apps__install__description_hide">
                        {if $admin__apps__install__app->description}
                            {$admin__apps__install__app->description}
                        {else}
                            {$strings->get('admin__apps__install__no_description')}
                        {/if}
                    </div>
                    <div class="mt-2">
                        <a href="#" data-text-hide="{$strings->get('admin__apps__install__show_less')}" data-text-show="{$strings->get('admin__apps__install__show_more')}" onclick="admin__apps__install.sh(event, this)">
                            {$strings->get('admin__apps__install__show_more')}
                            <i class="fas fa-caret-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {* License *}
        <div class="card-body bg-white text-dark d-none" data-type="license">
            {if $admin__apps__install__app->license}
                {$admin__apps__install__app->license}
            {else}
                {$strings->get('admin__apps__install__no_license')}
            {/if}
        </div>

    </div>
</div>