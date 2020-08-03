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
 * @description     Admin language settings.
 *}

{* AJAX error *}
{if $admin__settings__languages__language->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__settings__languages__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__settings__languages__language->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__settings__languages__language->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__settings__languages__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__settings__languages__language->ajaxConfirm}
        </div>
    </div>
{/if}

{* App *}
{if !$admin__settings__languages__language->error}

    <div class="col-12 mt-4"  data-type="admin__settings__languages__language">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark text-light">
                <h5 class="float-left mt-2 mr-4">
                    {$admin__settings__languages__language->key}
                </h5>
                <div class="form-inline float-right">
                    {if !$admin__settings__languages__language->default && $admin__settings__languages__language->key !== 'global'}
                        <div class="tool-tip">
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__settings__languages.dc(this, {$admin__settings__languages__language->id})">
                                <i class="fas fa-star"></i>
                            </button>
                            <span class="tool-tip-text bg-primary text-light">
                                {$strings->get('admin__settings__languages__as_default')}
                            </span>
                        </div>
                    {/if}
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__settings__languages.tc(event, this, 'edit')">
                            <i class="far fa-edit"></i>
                        </button>
                        <span class="tool-tip-text bg-primary text-light">
                            {$strings->get('admin__settings__languages__edit')}
                        </span>
                    </div>
                </div>
            </div>

            {* Information *}
            <div class="card-body bg-light text-dark">
                <div class="float-left">
                    <div>
                        {$admin__settings__languages__language->name}
                    </div>
                    <div class="text-secondary text-muted">
                        {$admin__settings__languages__language->nameEn}
                    </div>
                </div>
                <div class="form-inline float-right">
                    {if $admin__settings__languages__language->default}
                        <span class="bg-primary text-light rounded py-1 px-2 mt-2">
                            {$strings->get('admin__settings__languages__default')}
                        </span>
                    {/if}
                </div>
            </div>

            {* Menu *}
            <div class="card-body bg-light text-dark p-0">
                <div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="" data-nav="properties" onclick="admin__settings__languages.tc(event, this, 'properties')">
                                {$strings->get('admin__settings__languages__properties')}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" data-nav="edit" onclick="admin__settings__languages.tc(event, this, 'edit')">
                                {$strings->get('admin__settings__languages__edit')}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {* Properties *}
            <div class="card-body bg-white text-dark" data-type="properties">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                        <div>
                            {$strings->get('admin__settings__languages__title')}
                        </div>
                        <div class="text-secondary">
                            {if $admin__settings__languages__language->title}
                                {$admin__settings__languages__language->title}
                            {elseif $admin__settings__languages__languages_list->defaultTitle}
                                {{$strings->get('admin__settings__languages__default')}}
                            {elseif $admin__settings__languages__languages_list->globalTitle}
                                {{$strings->get('admin__settings__languages__global')}}
                            {else}
                                {{$strings->get('admin__settings__languages__not_defined')}}
                            {/if}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                        <div>
                            {$strings->get('admin__settings__languages__favicon')}
                        </div>
                        <div class="text-secondary">
                            {if $admin__settings__languages__language->favicon}
                                {$admin__settings__languages__language->favicon}
                            {elseif $admin__settings__languages__languages_list->defaultFavicon}
                                {{$strings->get('admin__settings__languages__default')}}
                            {elseif $admin__settings__languages__languages_list->globalFavicon}
                                {{$strings->get('admin__settings__languages__global')}}
                            {else}
                                {{$strings->get('admin__settings__languages__not_defined')}}
                            {/if}
                        </div>
                    </div>
                </div>
            </div>

            {* Edit *}
            <div class="card-body bg-white text-dark d-none" data-type="edit">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                        <label>
                            {$strings->get('admin__settings__languages__title')}
                        </label>
                        <input data-type="admin__settings__languages__title" type="text" class="form-control d-block" value="{$admin__settings__languages__language->title}" placeholder="{$strings->get('admin__settings__languages__title')}">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                        <label>
                            {$strings->get('admin__settings__languages__favicon')}
                        </label>
                        <input data-type="admin__settings__languages__favicon" type="text" class="form-control d-block" value="{$admin__settings__languages__language->favicon}" placeholder="{$strings->get('admin__settings__languages__favicon')}">
                    </div>
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-primary" onclick="admin__settings__languages.ec(this, {$admin__settings__languages__language->id})">
                            {$strings->get("admin__settings__languages__save")}
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

{/if}