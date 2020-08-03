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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 *}

{* Info *}
{if $admin__apps__settings__model->getInfoAdmin()}
    <div class="container info-hide">
        <div class="row">
            <div class="col-12 mt-4 text-justify">
                {$strings->get('admin__apps__settings__data_info')}
            </div>
        </div>
    </div>
{/if}

{* App *}
<div class="container info-hide">
    <div class="row">
        {$render->include('admin/apps/apps/settings/views/settings__app.tpl')}
    </div>
</div>

{* AJAX error *}
{if $admin__apps__settings__data->ajaxError}
    <div class="container">
        <div id="admin__apps__settings__ajax_error" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-danger m-0">
                    {$admin__apps__settings__data->ajaxError}
                </div>
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__apps__settings__data->ajaxConfirm}
    <div class="container">
        <div id="admin__apps__settings__ajax_confirm" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-success m-0">
                    {$admin__apps__settings__data->ajaxConfirm}
                </div>
            </div>
        </div>
    </div>
{/if}

{* Data *}
<div class="col-12 mt-4" data-type="admin__apps__settings__app">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="m-0">
                {$strings->get('admin__apps__settings__app_data')}
            </h5>
        </div>

        {* Settings *}
        <div class="card-body bg-light text-dark">

            {* Description *}
            <label>
                {$strings->get('admin__apps__settings__description')}
            </label>
            <input id="admin__apps__settings__description" type="text" class="form-control mb-4" value="{$admin__apps__settings__app->description}" placeholder="{$strings->get('admin__apps__settings__description')}">

            {* App cache *}
            <div class="row">
                <div class="col-12 col-md-4">
                    {if $admin__apps__settings__app->cacheable}
                        <div class="form-group form-check mb-2 pl-0">
                            <input type="checkbox" id="admin__apps__settings__cache" name="admin__apps__settings__cache"{if $admin__apps__settings__app->cache} checked{/if}>
                            <label class="form-check-label" for="admin__apps__settings__cache">
                                {$strings->get('admin__apps__settings__cache')}
                            </label>
                        </div>
                    {/if}
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group form-check mb-2 pl-0">
                        <input type="checkbox" id="admin__apps__settings__js_cache" name="admin__apps__settings__js_cache"{if $admin__apps__settings__app->jsCache} checked{/if}>
                        <label class="form-check-label" for="admin__apps__settings__js_cache">
                            {$strings->get('admin__apps__settings__js_cache')}
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group form-check mb-2 pl-0">
                        <input type="checkbox" id="admin__apps__settings__css_cache" name="admin__apps__settings__css_cache"{if $admin__apps__settings__app->cssCache} checked{/if}>
                        <label class="form-check-label" for="admin__apps__settings__css_cache">
                            {$strings->get('admin__apps__settings__css_cache')}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {* Data *}
        <div class="card-body bg-white text-dark">
            <div class="row">

                {* Legend *}
                <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 mb-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 bg-dark">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12 bg-secondary">
                                                    <div class="row">
                                                        <div class="col-12 pb-3">
                                                            <div class="bg-primary admin__apps__settings__h50"></div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="bg-primary admin__apps__settings__h100"></div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="bg-primary admin__apps__settings__h100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="bg-dark float-left mr-2 admin__apps__settings__dot"></div>
                            <div class="float-left">
                                {$strings->get('admin__apps__settings__container_fluid')}
                            </div>
                            <div class="admin__apps__settings__clear"></div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="bg-secondary float-left mr-2 admin__apps__settings__dot"></div>
                            <div class="float-left">
                                {$strings->get('admin__apps__settings__container')}
                            </div>
                            <div class="admin__apps__settings__clear"></div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="bg-primary float-left mr-2 admin__apps__settings__dot"></div>
                            <div class="float-left">
                                {$strings->get('admin__apps__settings__apps')}
                            </div>
                            <div class="admin__apps__settings__clear"></div>
                        </div>
                    </div>
                </div>

                {* Options *}
                <div class="col-12 col-sm-6 col-md-7 col-lg-8 col-xl-9">
                    <label>
                        {$strings->get('admin__apps__settings__css_container_fluid')}
                    </label>
                    <input id="admin__apps__settings__css_container_fluid" type="text" class="form-control mb-4" value="{$admin__apps__settings__app->containerFluidCss}" placeholder="{$strings->get('admin__apps__settings__css_container_fluid')}">
                    <label>
                        {$strings->get('admin__apps__settings__css_container')}
                    </label>
                    <input id="admin__apps__settings__css_container" type="text" class="form-control mb-4" value="{$admin__apps__settings__app->containerCss}" placeholder="{$strings->get('admin__apps__settings__css_container')}">
                    <label>
                        {$strings->get('admin__apps__settings__css_app')}
                    </label>
                    <input id="admin__apps__settings__css_app" type="text" class="form-control mb-4" value="{$admin__apps__settings__app->appCss}" placeholder="{$strings->get('admin__apps__settings__css_app')}">
                </div>

            </div>

            {* Button Save *}
            <div class="text-right">
                <button type="button" class="btn btn-primary" onclick="admin__apps__settings.daex()">
                    {$strings->get('admin__apps__settings__save')}
                </button>
            </div>

        </div>

    </div>
</div>