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
 * @description     Admin application to manage static bottom apps.
 *}

{* App *}
{if !$admin__apps__static_bottom__app->error}

    <div class="col-12 mt-4" data-type="admin__apps__static_bottom__app">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark text-light">
                <h5 class="float-left mt-2 mr-4">
                    {$admin__apps__static_bottom__app->name}
                </h5>
                <div class="form-inline float-right">
                    {if $admin__apps__static_bottom__app->adminControllers>0 || $admin__apps__static_bottom__app->adminModels>0}
                        <div class="tool-tip">
                            <a class="text-decoration-none" href="{$render->getUrl(303)}/{$admin__apps__static_bottom__app->id}" target="_self">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                    <i class="fas fa-user"></i>
                                </button>
                            </a>
                            <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__static_bottom__admin')}</span>
                        </div>
                    {/if}
                    <div class="tool-tip">
                        <a class="text-decoration-none" href="{$render->getUrl(306)}/{$admin__apps__static_bottom__app->id}" target="_self">
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                <i class="fas fa-cog"></i>
                            </button>
                        </a>
                        <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__static_bottom__settings')}</span>
                    </div>
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__apps__static_bottom.ex(event, 'remove', {$admin__apps__static_bottom__app->position}, 0)">
                            <i class="fa fa-trash"></i>
                        </button>
                        <span class="tool-tip-text bg-warning text-light">{$strings->get('admin__apps__static_bottom__remove')}</span>
                    </div>
                    {if !$admin__apps__static_bottom__app->first}
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__apps__static_bottom.ex(event, 'move', {$admin__apps__static_bottom__app->position}, 'up')">
                            <i class="fa fa-arrow-up"></i>
                        </button>
                        <span class="tool-tip-text bg-primary text-light">&uarr;</span>
                    </div>
                    {/if}
                    {if !$admin__apps__static_bottom__app->last}
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__apps__static_bottom.ex(event, 'move', {$admin__apps__static_bottom__app->position}, 'down')">
                            <i class="fa fa-arrow-down"></i>
                        </button>
                        <span class="tool-tip-text bg-primary text-light">&darr;</span>
                    </div>
                    {/if}
                </div>
            </div>

            {* Information *}
            <div class="card-body bg-light text-dark">
                <div class="float-left">
                    <h6 class="mb-3">
                        <strong>
                            {$strings->get('admin__apps__static_bottom__app_id')}: {$admin__apps__static_bottom__app->id}
                        </strong>
                    </h6>
                    {if $admin__apps__static_bottom__app->description}
                        <div class="card-subtitle text-muted" id="admin__apps_description_{$admin__apps__static_bottom__app->id}">
                            {$admin__apps__static_bottom__app->description}
                        </div>
                    {else}
                        <div class="card-subtitle text-muted" id="admin__apps_description_{$admin__apps__static_bottom__app->id}">
                            {{$strings->get('admin__apps__static_bottom__no_description')}}
                        </div>
                    {/if}
                </div>
                <div class="form-inline float-right">
                    {if $admin__apps__static_bottom__app->active}
                        <span class="bg-success text-light rounded py-1 px-2">{$strings->get('admin__apps__static_bottom__activated')}</span>
                    {else}
                        <span class="bg-danger text-light rounded py-1 px-2">{$strings->get('admin__apps__static_bottom__deactivated')}</span>
                    {/if}
                </div>
            </div>

            {* Details view *}
            {if $admin__apps__static_bottom__search->view === 'details'}

                {* Menu *}
                <div class="card-body bg-light text-dark p-0">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="" data-nav="properties" onclick="event.preventDefault()">
                                    {$strings->get('admin__apps__static_bottom__properties')}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {* Properties *}
                <div class="card-body bg-white text-dark" data-type="properties">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div class="mb-2">
                                {$strings->get('admin__apps__static_bottom__frontend')}
                            </div>
                            <div>
                                {if $admin__apps__static_bottom__app->controllers > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#C: {$admin__apps__static_bottom__app->controllers}</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->models > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#M: {$admin__apps__static_bottom__app->models}</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->views > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#V: {$admin__apps__static_bottom__app->views}</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->css}
                                    <span class="bg-success text-light rounded py-1 px-2">.CSS</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->js}
                                    <span class="bg-warning text-light rounded py-1 px-2">.JS</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->controllers === 0 && $admin__apps__static_bottom__app->models === 0 && $admin__apps__static_bottom__app->views === 0 && !$admin__apps__static_bottom__app->css && !$admin__apps__static_bottom__app->js}
                                    <span class="bg-danger text-light rounded py-1 px-2">{$strings->get('admin__apps__static_bottom__no_content')}</span>
                                {/if}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div class="mb-2">
                                {$strings->get('admin__apps__static_bottom__admin_area')}
                            </div>
                            <div>
                                {if $admin__apps__static_bottom__app->adminControllers > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#C: {$admin__apps__static_bottom__app->adminControllers}</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->adminModels > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#M: {$admin__apps__static_bottom__app->adminModels}</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->adminViews > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#V: {$admin__apps__static_bottom__app->adminViews}</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->adminCss}
                                    <span class="bg-success text-light rounded py-1 px-2">.CSS</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->adminJs}
                                    <span class="bg-warning text-light rounded py-1 px-2">.JS</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->widget}
                                    <span class="bg-dark text-light rounded py-1 px-2">#W</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->adminControllers === 0 && $admin__apps__static_bottom__app->adminModels === 0 && $admin__apps__static_bottom__app->adminViews === 0 && !$admin__apps__static_bottom__app->adminCss && !$admin__apps__static_bottom__app->adminJs && !$admin__apps__static_bottom__app->widget}
                                    <span class="bg-danger text-light rounded py-1 px-2">{$strings->get('admin__apps__static_bottom__no_content')}</span>
                                {/if}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div class="mb-2">
                                {$strings->get('admin__apps__static_bottom__static')}
                            </div>
                            <div>
                                {if $admin__apps__static_bottom__app->staticTop}
                                    <span class="bg-dark text-light rounded py-1 px-2">&#8593; : {$admin__apps__static_bottom__app->staticTop}</span>
                                {/if}
                                {if $admin__apps__static_bottom__app->staticBottom}
                                    <span class="bg-dark text-light rounded py-1 px-2">&#8595; : {$admin__apps__static_bottom__app->staticBottom}</span>
                                {/if}
                                {if !$admin__apps__static_bottom__app->staticTop && !$admin__apps__static_bottom__app->staticBottom}
                                    <span class="bg-dark text-light rounded py-1 px-2">{$strings->get('admin__apps__static_bottom__not_static')}</span>
                                {/if}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div>
                                {$strings->get('admin__apps__static_bottom__css_container_fluid')}
                            </div>
                            <div class="text-secondary">
                                {if $admin__apps__static_bottom__app->containerFluidCss}
                                    {$admin__apps__static_bottom__app->containerFluidCss}
                                {else}
                                    {{$strings->get('admin__apps__static_bottom__no_container_fluid_css')}}
                                {/if}
                            </div>
                        </div>
                        {if $admin__apps__static_bottom__app->container}
                            <div class="col-sm-12 col-md-4 mb-4">
                                <div>
                                    {$strings->get('admin__apps__static_bottom__container_css')}
                                </div>
                                <div class="text-secondary">
                                    {if $admin__apps__static_bottom__app->containerCss}
                                        {$admin__apps__static_bottom__app->containerCss}
                                    {else}
                                        {{$strings->get('admin__apps__static_bottom__no_container_css')}}
                                    {/if}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-4">
                                <div>
                                    {$strings->get('admin__apps__static_bottom__app_css')}
                                </div>
                                <div class="text-secondary">
                                    {if $admin__apps__static_bottom__app->appCss}
                                        {$admin__apps__static_bottom__app->appCss}
                                    {else}
                                        {{$strings->get('admin__apps__static_bottom__no_app_css')}}
                                    {/if}
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    {$strings->get('admin__apps__static_bottom__size')}
                                </div>
                                <div class="text-secondary">
                                    {if $admin__apps__static_bottom__app->containerGrid}
                                            {$admin__apps__static_bottom__app->containerGrid}
                                    {else}
                                        offset-0 col-12 offset-sm-0 col-sm-12 offset-md-0 col-md-12 offset-lg-0 col-lg-12 offset-xl-0 col-xl-12
                                    {/if}
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>

            {/if}

        </div>
    </div>

{/if}