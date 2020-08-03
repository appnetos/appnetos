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
 * @description     Admin app overview and app management.
 *}

{* AJAX error *}
{if $admin__apps__management__app->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__apps__management__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__apps__management__app->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__apps__management__app->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__apps__management__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__apps__management__app->ajaxConfirm}
        </div>
    </div>
{/if}

{* App *}
{if !$admin__apps__management__app->error}

    <div class="col-12 mt-4" data-type="admin__apps__management__app">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark text-light">
                <h5 class="float-left mt-2 mr-4">
                    {if $admin__apps__management__app->image}
                        <img class="admin__apps__management__icon rounded mr-2" src="{$admin__apps__management__app->image}">
                    {/if}
                    {$admin__apps__management__app->name}
                </h5>
                <div class="form-inline float-right">
                    <div class="tool-tip">
                        {if $admin__apps__management__app->active}
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__apps__management.ac('deactivate', this, {$admin__apps__management__app->id})">
                                <i class="fas fa-toggle-on"></i>
                            </button>
                            <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__apps__management__deactivate')}</span>
                        {else}
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none"  onclick="admin__apps__management.ae('activate', this, {$admin__apps__management__app->id})">
                                <i class="fas fa-toggle-off"></i>
                            </button>
                            <span class="tool-tip-text bg-success text-light">{$strings->get('admin__apps__management__activate')}</span>
                        {/if}
                    </div>
                    {if $admin__apps__management__app->adminViews > 0 && $render->getUrl(303)}
                        <div class="tool-tip">
                            <a class="text-decoration-none" href="{$render->getUrl(303)}/{$admin__apps__management__app->id}" target="_self">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                    <i class="fas fa-user"></i>
                                </button>
                            </a>
                            <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__management__admin')}</span>
                        </div>
                    {/if}
                    {if $render->getUrl(306)}
                        <div class="tool-tip">
                            <a class="text-decoration-none" href="{$render->getUrl(306)}/{$admin__apps__management__app->id}" target="_self">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                    <i class="fas fa-cog"></i>
                                </button>
                            </a>
                            <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__management__settings')}</span>
                        </div>
                    {/if}
                </div>
            </div>

            {* Information *}
            <div class="card-body bg-light text-dark">
                <div class="row">
                <div class="col-10 col-md-4">
                    <h6 class="mb-3">
                        <strong>
                            {$strings->get('admin__apps__management__app_id')}: {$admin__apps__management__app->id}
                        </strong>
                    </h6>
                    {if $admin__apps__management__app->description}
                        <div class="card-subtitle text-muted" id="admin__apps_description_{$admin__apps__management__app->id}">
                            {$admin__apps__management__app->description}
                        </div>
                    {else}
                        <div class="card-subtitle text-muted" id="admin__apps_description_{$admin__apps__management__app->id}">
                            {{$strings->get('admin__apps__management__no_description')}}
                        </div>
                    {/if}
                </div>
                <div class="col-12 col-md-4">
                    {if $admin__apps__management__app->version}
                        <h6 class="mb-3 mt-3 mt-md-0">
                            <strong>
                                {$strings->get('admin__apps__management__version')}: {$admin__apps__management__app->version}
                                {if $admin__apps__management__app->status}
                                    {$admin__apps__management__app->status}
                                {/if}
                            </strong>
                        </h6>
                    {/if}
                </div>
                <div class="col-12 col-md-4 text-right">
                    {if $admin__apps__management__app->active}
                        <span class="bg-success text-light rounded py-1 px-2">{$strings->get('admin__apps__management__activated')}</span>
                    {else}
                        <span class="bg-danger text-light rounded py-1 px-2">{$strings->get('admin__apps__management__deactivated')}</span>
                    {/if}
                </div>
                </div>
            </div>

            {* Details view *}
            {if $admin__apps__management__search->view === 'details'}

                {* Menu *}
                <div class="card-body bg-light text-dark p-0">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="" data-nav="properties" onclick="admin__apps__management.tc(event, this, 'properties')">
                                    {$strings->get('admin__apps__management__properties')}
                                </a>
                            </li>
                            {if $admin__apps__management__app->events|count > 0}
                                <li class="nav-item">
                                    <a class="nav-link" href="" data-nav="events" onclick="admin__apps__management.tc(event, this, 'events')">
                                        {$strings->get('admin__apps__management__events')}
                                    </a>
                                </li>
                            {/if}
                            <li class="nav-item">
                                <a class="nav-link" href="" data-nav="description" onclick="admin__apps__management.tc(event, this, 'description')">
                                    {$strings->get('admin__apps__management__description')}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="" data-nav="license" onclick="admin__apps__management.tc(event, this, 'license')">
                                    {$strings->get('admin__apps__management__license')}
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
                                {$strings->get('admin__apps__management__frontend')}
                            </div>
                            <div>
                                {if $admin__apps__management__app->controllers > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#C: {$admin__apps__management__app->controllers}</span>
                                {/if}
                                {if $admin__apps__management__app->models > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#M: {$admin__apps__management__app->models}</span>
                                {/if}
                                {if $admin__apps__management__app->views > 0}
                                <span class="bg-dark text-light rounded py-1 px-2">#V: {$admin__apps__management__app->views}</span>
                                {/if}
                                {if $admin__apps__management__app->css}
                                    <span class="bg-success text-light rounded py-1 px-2">.CSS</span>
                                {/if}
                                {if $admin__apps__management__app->js}
                                    <span class="bg-warning text-light rounded py-1 px-2">.JS</span>
                                {/if}
                                {if $admin__apps__management__app->controllers === 0 && $admin__apps__management__app->models === 0 && $admin__apps__management__app->views === 0 && !$admin__apps__management__app->css && !$admin__apps__management__app->js}
                                    <span class="bg-danger text-light rounded py-1 px-2">{$strings->get('admin__apps__management__no_content')}</span>
                                {/if}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div class="mb-2">
                                {$strings->get('admin__apps__management__admin_area')}
                            </div>
                            <div>
                                {if $admin__apps__management__app->adminControllers > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#C: {$admin__apps__management__app->adminControllers}</span>
                                {/if}
                                {if $admin__apps__management__app->adminModels > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#M: {$admin__apps__management__app->adminModels}</span>
                                {/if}
                                {if $admin__apps__management__app->adminViews > 0}
                                    <span class="bg-dark text-light rounded py-1 px-2">#V: {$admin__apps__management__app->adminViews}</span>
                                {/if}
                                {if $admin__apps__management__app->adminCss}
                                    <span class="bg-success text-light rounded py-1 px-2">.CSS</span>
                                {/if}
                                {if $admin__apps__management__app->adminJs}
                                    <span class="bg-warning text-light rounded py-1 px-2">.JS</span>
                                {/if}
                                {if $admin__apps__management__app->widget}
                                    <span class="bg-dark text-light rounded py-1 px-2">#W</span>
                                {/if}
                                {if $admin__apps__management__app->adminControllers === 0 && $admin__apps__management__app->adminModels === 0 && $admin__apps__management__app->adminViews === 0 && !$admin__apps__management__app->adminCss && !$admin__apps__management__app->adminJs && !$admin__apps__management__app->widget}
                                    <span class="bg-danger text-light rounded py-1 px-2">{$strings->get('admin__apps__management__no_content')}</span>
                                {/if}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div class="mb-2">
                                {$strings->get('admin__apps__management__static')}
                            </div>
                            <div>
                                {if $admin__apps__management__app->staticTop}
                                    <span class="bg-dark text-light rounded py-1 px-2">&#8593; : {$admin__apps__management__app->staticTop}</span>
                                {/if}
                                {if $admin__apps__management__app->staticBottom}
                                    <span class="bg-dark text-light rounded py-1 px-2">&#8595; : {$admin__apps__management__app->staticBottom}</span>
                                {/if}
                                {if !$admin__apps__management__app->staticTop && !$admin__apps__management__app->staticBottom}
                                    <span class="bg-dark text-light rounded py-1 px-2">{$strings->get('admin__apps__management__not_static')}</span>
                                {/if}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div>
                                {$strings->get('admin__apps__management__css_container_fluid')}
                            </div>
                            <div class="text-secondary">
                                {if $admin__apps__management__app->containerFluidCss}
                                    {$admin__apps__management__app->containerFluidCss}
                                {else}
                                    {{$strings->get('admin__apps__management__no_container_fluid_css')}}
                                {/if}
                            </div>
                        </div>
                        {if $admin__apps__management__app->container}
                            <div class="col-sm-12 col-md-4 mb-4">
                                <div>
                                    {$strings->get('admin__apps__management__container_css')}
                                </div>
                                <div class="text-secondary">
                                    {if $admin__apps__management__app->containerCss}
                                        {$admin__apps__management__app->containerCss}
                                    {else}
                                        {{$strings->get('admin__apps__management__no_container_css')}}
                                    {/if}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 mb-4">
                                <div>
                                    {$strings->get('admin__apps__management__app_css')}
                                </div>
                                <div class="text-secondary">
                                    {if $admin__apps__management__app->appCss}
                                        {$admin__apps__management__app->appCss}
                                    {else}
                                        {{$strings->get('admin__apps__management__no_app_css')}}
                                    {/if}
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    {$strings->get('admin__apps__management__size')}
                                </div>
                                <div class="text-secondary">
                                    {if $admin__apps__management__app->containerGrid}
                                        {$admin__apps__management__app->containerGrid}
                                    {else}
                                        offset-0 col-12 offset-sm-0 col-sm-12 offset-md-0 col-md-12 offset-lg-0 col-lg-12 offset-xl-0 col-xl-12
                                    {/if}
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>

                {* Events *}
                <div class="card-body bg-white text-dark d-none" data-type="events">
                    {if $admin__apps__management__app->eventDuplicate}
                    <button type="button" class="btn btn-primary my-2 mr-2" onclick="admin__apps__management.ae('duplicate', this, {$admin__apps__management__app->id})">
                        {$strings->get('admin__apps__management__duplicate')}
                    </button>
                    {/if}
                    <button type="button" class="btn btn-danger my-2 mr-2" onclick="admin__apps__management.ac('remove', this, {$admin__apps__management__app->id})">
                        {$strings->get('admin__apps__management__remove')}
                    </button>
                    {if $admin__apps__management__app->eventRevert}
                        <button type="button" class="btn btn-danger my-2 mr-2" onclick="admin__apps__management.ac('reset', this, {$admin__apps__management__app->id})">
                            {$strings->get('admin__apps__management__reset')}
                        </button>
                    {/if}
                    {if $admin__apps__management__app->eventDelete}
                        <button type="button" class="btn btn-danger my-2 mr-2" onclick="admin__apps__management.ac('delete', this, {$admin__apps__management__app->id})">
                            {$strings->get('admin__apps__management__delete')}
                        </button>
                    {/if}
                </div>

                {* Description *}
                <div class="card-body bg-white text-dark d-none" data-type="description">
                    <div class="row">
                        {assign var="admin__apps__management__col" value="col-12"}
                        {if $admin__apps__management__app->image}
                            {assign var="admin__apps__management__col" value="col-12 col-md-8 col-lg-9 col-xl-10"}
                            <div class="col-12 col-md-4 col-lg-3 col-xl-2 mb-4">
                                <img src="{$admin__apps__management__app->image}" class="admin__apps__management__image_description rounded mr-4">
                            </div>
                        {/if}
                        <div class="{$admin__apps__management__col}">
                            <h5>
                                {$admin__apps__management__app->name}
                            </h5>
                            {if $admin__apps__management__app->version}
                                <div>
                                    {$strings->get('admin__apps__management__version')}
                                    {$admin__apps__management__app->version}
                                    {if $admin__apps__management__app->status}
                                        {$admin__apps__management__app->status}
                                    {/if}
                                </div>
                            {/if}
                            {if $admin__apps__management__app->version}
                                <div>
                                    APPNET OS {$admin__apps__management__app->appnetos}
                                </div>
                            {/if}
                            {if $admin__apps__management__app->vendor || $admin__apps__management__app->web || $admin__apps__management__app->mail || $admin__apps__management__app->author || $admin__apps__management__app->store}
                                <div class="mt-4">
                                    {if $admin__apps__management__app->vendor}
                                        <div>
                                            {$admin__apps__management__app->vendor}
                                        </div>
                                    {/if}
                                    {if $admin__apps__management__app->author}
                                        <div>
                                            {$admin__apps__management__app->author}
                                        </div>
                                    {/if}
                                    {if $admin__apps__management__app->web}
                                        <div>
                                            <a href="{$admin__apps__management__app->web}">
                                                {$admin__apps__management__app->web}
                                            </a>
                                        </div>
                                    {/if}
                                    {if $admin__apps__management__app->mail}
                                        <div>
                                            <a href="mailto:{$admin__apps__management__app->mail}">
                                                {$admin__apps__management__app->mail}
                                            </a>
                                        </div>
                                    {/if}
                                    {if $admin__apps__management__app->store}
                                        <div>
                                            <a target="_blank" href="{$admin__apps__management__app->appnetosUrl}app/{$admin__apps__management__app->store}">
                                                {$admin__apps__management__app->appnetosUrl}app/{$admin__apps__management__app->store}
                                            </a>
                                        </div>
                                    {/if}
                                </div>
                            {/if}
                            <div class="mt-4">
                                {if $admin__apps__management__app->storeDescription}
                                    {$admin__apps__management__app->storeDescription}
                                {else}
                                    {$strings->get('admin__apps__management__no_store_description')}
                                {/if}
                            </div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                </div>

                {* License *}
                <div class="card-body bg-white text-dark d-none" data-type="license">
                    {if $admin__apps__management__app->storeLicense}
                        {$admin__apps__management__app->storeLicense}
                    {else}
                        {$strings->get('admin__apps__management__no_store_license')}
                    {/if}
                </div>

            {/if}

        </div>
    </div>

{/if}