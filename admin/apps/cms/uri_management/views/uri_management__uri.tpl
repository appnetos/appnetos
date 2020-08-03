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
 * @description     Admin URI management to add and delete URIs.
 *}

{* AJAX error *}
{if $admin__cms__uri_management__uri->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__uri_management__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__cms__uri_management__uri->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__cms__uri_management__uri->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__uri_management__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__cms__uri_management__uri->ajaxConfirm}
        </div>
    </div>
{/if}

{* URI *}
{if !$admin__cms__uri_management__uri->error}

    <div class="col-12 mt-4" data-type="admin__cms__uri_management__uri">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark text-light">
                {if $admin__cms__uri_management__uri->uri !== ""}
                    <a class="float-left mt-2 mr-4" href="{$render->getUrl()}/{$admin__cms__uri_management__uri->uri}" target="_blank">
                        <h5 class="word-break">
                            {$admin__cms__uri_management__uri->uri}
                        </h5>
                    </a>
                {else}
                    <a class="float-left mt-2 mr-4" href="{$render->getUrl()}" target="_blank">
                        <h5 class="word-break">
                            {{$strings->get('admin__cms__uri_management__home')}}
                        </h5>
                    </a>
                {/if}
                <div class="form-inline float-right">
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__cms__uri_management.ac('delete', this, {$admin__cms__uri_management__uri->id})">
                            <i class="fa fa-trash"></i>
                        </button>
                        <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__cms__uri_management__delete')}</span>
                    </div>
                    {if $render->getUrl(201)}
                        <div class="tool-tip">
                            <a class="text-decoration-none" href="{$render->getUrl(201)}/{$admin__cms__uri_management__uri->id}" target="_self">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                    <i class="far fa-edit"></i>
                                </button>
                            </a>
                            <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__cms__uri_management__edit_seo')}</span>
                        </div>
                    {/if}
                    {if $render->getUrl(202)}
                        <div class="tool-tip">
                            <a class="text-decoration-none" href="{$render->getUrl(202)}/{$admin__cms__uri_management__uri->id}" target="_self">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                    <i class="fa fa-th-large"></i>
                                </button>
                            </a>
                            <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__cms__uri_management__button_apps')}</span>
                        </div>
                    {/if}
                </div>
            </div>

            {* Information *}
            <div class="card-body bg-light text-dark">
                <h6 class="m-0">
                    <strong>
                        {$strings->get('admin__cms__uri_management__uri_id')}: {$admin__cms__uri_management__uri->id}
                    </strong>
                </h6>
            </div>

            {* Details view *}
            {if $admin__cms__uri_management__search->view === 'details'}

                {* Menu *}
                <div class="card-body bg-light text-dark p-0">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="" data-nav="properties" onclick="event.preventDefault()">
                                    {$strings->get('admin__cms__uri_management__properties')}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {* Properties *}
                <div class="card-body bg-white text-dark" data-type="properties">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div>
                                {$strings->get('admin__cms__uri_management__views')}
                            </div>
                            <div class="text-secondary">
                                {$admin__cms__uri_management__uri->views}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div>
                                {$strings->get('admin__cms__uri_management__apps')}
                            </div>
                            <div class="text-secondary">
                                {$admin__cms__uri_management__uri->appsCount}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-4">
                            <div>
                                {$strings->get('admin__cms__uri_management__languages')}
                            </div>
                            <div class="text-secondary">
                                {$admin__cms__uri_management__uri->languagesCount}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-4">
                            <div>
                                {$strings->get('admin__cms__uri_management__title')}
                            </div>
                            <div class="text-secondary word-break">
                                {if $admin__cms__uri_management__uri->title !== ''}
                                    {$admin__cms__uri_management__uri->title}
                                {else}
                                    {{$strings->get('admin__cms__uri_management__language_settings')}}
                                {/if}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-4">
                            <div>
                                {$strings->get('admin__cms__uri_management__favicon')}
                            </div>
                            <div class="text-secondary word-break">
                                {if $admin__cms__uri_management__uri->favicon !== ""}
                                    {$admin__cms__uri_management__uri->favicon}
                                {else}
                                    {{$strings->get('admin__cms__uri_management__language_settings')}}
                                {/if}
                            </div>
                        </div>
                        {assign var="admin__cms__uri_management__languages" value=$admin__cms__uri_management__uri->getLanguages()}
                        {if $admin__cms__uri_management__languages}
                            <div class="col-sm-12">
                                <div>
                                    {$strings->get('admin__cms__uri_management__languages')}
                                </div>
                                <div class="text-secondary">
                                    {$admin__cms__uri_management__languages}
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>

            {/if}

        </div>
    </div>

{/if}