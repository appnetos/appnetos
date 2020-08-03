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
 * @description     Admin edit URI and languages URIs.
 *}

{* AJAX error *}
{if $admin__cms__edit_uri__uri->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__edit_uri__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__cms__edit_uri__uri->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__cms__edit_uri__uri->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__edit_uri__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__cms__edit_uri__uri->ajaxConfirm}
        </div>
    </div>
{/if}

{* URI *}
{if !$admin__cms__edit_uri__uri->error}

    <div class="col-12 mt-4" data-type="admin__cms__edit_uri__uri">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark text-light">
                <h5 class="float-left mt-2 mr-4">
                    {if $admin__cms__edit_uri__uri->parentId === 0}
                        {$strings->get('admin__cms__edit_uri__global')}
                    {else}
                        {$admin__cms__edit_uri__model->getLanguage($admin__cms__edit_uri__uri->languageKey)}
                    {/if}
                </h5>
                <div class="form-inline float-right">
                    {if $admin__cms__edit_uri__uri->parentId !== 0}
                        <div class="tool-tip">
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__cms__edit_uri.dc({$admin__cms__edit_uri__uri->id})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__cms__edit_uri__remove')}</span>
                        </div>
                    {/if}
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__cms__edit_uri.tc(event, this, 'edit')">
                            <i class="far fa-edit"></i>
                        </button>
                        <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__cms__edit_uri__edit')}</span>
                    </div>
                </div>
            </div>

            {* Information *}
            <div class="card-body bg-light text-dark">
                <h6 class="m-0">
                    <strong>
                        {$strings->get('admin__cms__edit_uri__id')}: {$admin__cms__edit_uri__uri->id}
                    </strong>
                </h6>
            </div>

            {* Menu *}
            <div class="card-body bg-light text-dark p-0">
                <div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link{if $admin__cms__edit_uri__uri->tab === 'properties'} active{/if}" href="" data-nav="properties" onclick="admin__cms__edit_uri.tc(event, this, 'properties')">
                                {$strings->get('admin__cms__edit_uri__properties')}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{if $admin__cms__edit_uri__uri->tab === 'edit'} active{/if}" href="" data-nav="edit" onclick="admin__cms__edit_uri.tc(event, this, 'edit')">
                                {$strings->get('admin__cms__edit_uri__edit')}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{if $admin__cms__edit_uri__uri->tab === 'meta'} active{/if}" href="" data-nav="meta" onclick="admin__cms__edit_uri.tc(event, this, 'meta')">
                                Meta
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {* Properties *}
            <div class="card-body bg-white text-dark{if $admin__cms__edit_uri__uri->tab !== 'properties'} d-none{/if}" data-type="properties">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div>
                            {$strings->get('admin__cms__edit_uri__uri')}
                        </div>
                        <div>
                            {if $admin__cms__edit_uri__uri->uri !== ""}
                                <a href="{$render->getUrl()}/{$admin__cms__edit_uri__uri->uri}" target="_blank">
                                    {$admin__cms__edit_uri__uri->uri}
                                </a>
                            {else}
                                <a href="{$render->getUrl()}" target="_blank">
                                    {{$strings->get('admin__cms__edit_uri__home')}}
                                </a>
                            {/if}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div>
                            {$strings->get('admin__cms__edit_uri__title')}
                        </div>
                        <div class="text-secondary word-break">
                            {if $admin__cms__edit_uri__uri->title !== ''}
                                {$admin__cms__edit_uri__uri->title}
                            {else}
                                {if $admin__cms__edit_uri__uri->parentId === 0}
                                    {{$strings->get('admin__cms__edit_uri__language_settings')}}
                                {else}
                                    {{$strings->get('admin__cms__edit_uri__global')}}
                                {/if}
                            {/if}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div>
                            {$strings->get('admin__cms__edit_uri__favicon')}
                        </div>
                        <div class="text-secondary word-break">
                            {if $admin__cms__edit_uri__uri->favicon !== ""}
                                {$admin__cms__edit_uri__uri->favicon}
                            {else}
                                {if $admin__cms__edit_uri__uri->parentId === 0}
                                    {{$strings->get('admin__cms__edit_uri__language_settings')}}
                                {else}
                                    {{$strings->get('admin__cms__edit_uri__global')}}
                                {/if}
                            {/if}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                        <div>
                            {$strings->get('admin__cms__edit_uri__canonical')}
                        </div>
                        <div class="text-secondary word-break">
                            {if $admin__cms__edit_uri__uri->canonical !== ""}
                                {$admin__cms__edit_uri__uri->canonical}
                            {else}
                                {{$strings->get('admin__cms__edit_uri__no_canonical')}}
                            {/if}
                        </div>
                    </div>
                </div>
            </div>

            {* Edit *}
            <div class="card-body bg-white text-dark{if $admin__cms__edit_uri__uri->tab !== 'edit'} d-none{/if}" data-type="edit">
                <form class="d-block" data-type="form_uri" data-uri-id="{$admin__cms__edit_uri__uri->id}">
                    <input type="hidden" name="id" value="{$admin__cms__edit_uri__uri->id}">
                    <div class="row">
                        {if $admin__cms__edit_uri__uri->uri !== ''}
                            <div class="col-12 mb-4">
                                <label>
                                    {$strings->get('admin__cms__edit_uri__uri')}
                                </label>
                                <input type="text" class="form-control d-block" name="uri" value="{$admin__cms__edit_uri__uri->uri}" placeholder="{$strings->get('admin__cms__edit_uri__uri')}">
                            </div>
                        {else}
                            <input type="hidden" name="uri" value="{$admin__cms__edit_uri__uri->uri}">
                        {/if}
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                            <label>
                                {$strings->get('admin__cms__edit_uri__title')}
                            </label>
                            <input type="text" class="form-control d-block" name="title" value="{$admin__cms__edit_uri__uri->title}" placeholder="{$strings->get('admin__cms__edit_uri__title')}">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                            <label>
                                {$strings->get('admin__cms__edit_uri__favicon')}
                            </label>
                            <input type="text" class="form-control d-block" name="favicon" value="{$admin__cms__edit_uri__uri->favicon}" placeholder="{$strings->get('admin__cms__edit_uri__favicon')}">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                            <label>
                                {$strings->get('admin__cms__edit_uri__canonical')}
                            </label>
                            <select name="canonical" class="form-control d-block">
                                <option value=""{if !$admin__cms__edit_uri__uri->canonical} selected{/if}>
                                    {$strings->get('admin__cms__edit_uri__no_canonical')}
                                </option>
                                {foreach from=$admin__cms__edit_uri__uris_list->languagesCanonical item="admin__cms__edit_uri__languages_canonical"}
                                    {if $admin__cms__edit_uri__languages_canonical !== $admin__cms__edit_uri__uri->id}
                                        <option value="{$admin__cms__edit_uri__languages_canonical}"{if $admin__cms__edit_uri__uri->canonical === $admin__cms__edit_uri__languages_canonical} selected{/if}>
                                            {$admin__cms__edit_uri__languages_canonical}
                                        </option>
                                    {/if}
                                {/foreach}
                            </select>
                        </div>
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-primary" onclick="admin__cms__edit_uri.ec(this, {$admin__cms__edit_uri__uri->id})">
                                {$strings->get('admin__cms__edit_uri__save')}
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            {* Meta *}
            <div class="card-body bg-white text-dark{if $admin__cms__edit_uri__uri->tab !== 'meta'} d-none{/if}" data-type="meta">
                <form class="d-block" data-type="form_meta" data-uri-id="{$admin__cms__edit_uri__uri->id}">
                    <input type="hidden" name="id" value="{$admin__cms__edit_uri__uri->id}">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-4">
                            <label>
                                Meta: {$strings->get('admin__cms__edit_uri__meta_title')}
                            </label>
                            <input type="text" class="form-control d-block" name="meta_title" value="{$admin__cms__edit_uri__uri->metaTitle}" placeholder="Meta: {$strings->get('admin__cms__edit_uri__meta_title')}" maxlength="70">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-4">
                            <label>
                                Meta: {$strings->get('admin__cms__edit_uri__meta_keywords')}
                            </label>
                            <input type="text" class="form-control d-block" name="meta_keywords" value="{$admin__cms__edit_uri__uri->metaKeywords}" placeholder="Meta: {$strings->get('admin__cms__edit_uri__meta_keywords')}" maxlength="100">
                        </div>
                        <div class="col-12 mb-5">
                            <label>
                                Meta: {$strings->get('admin__cms__edit_uri__meta_description')}
                            </label>
                            <input type="text" class="form-control d-block" name="meta_description" value="{$admin__cms__edit_uri__uri->metaDescription}" placeholder="Meta: {$strings->get('admin__cms__edit_uri__meta_description')}" maxlength="320">
                        </div>
                        <div class="col-12">
                            <label>
                                Meta
                            </label>
                        </div>
                        <div class="col-12 mb-4 table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td colspan="2" class="text-left border-bottom-0">
                                            {$strings->get('admin__cms__edit_uri__name')}
                                        </td>
                                        <td colspan="2" class="text-left border-bottom-0">
                                            {$strings->get('admin__cms__edit_uri__content')}
                                        </td>
                                        <td class="border-bottom-0">
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {assign var="admin__cms__edit_uri__meta_index" value=1}
                                    {foreach from=$admin__cms__edit_uri__uri->meta item="admin__cms__edit_uri__meta_object"}
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control d-block" name="meta_name_tag_{$admin__cms__edit_uri__meta_index}" data-type="meta_name_tag" data-uri-id="{$admin__cms__edit_uri__uri->id}" data-meta-id="{$admin__cms__edit_uri__meta_index}" value="{$admin__cms__edit_uri__meta_object->nameTag}" placeholder="{$strings->get('admin__cms__edit_uri__name')}" maxlength="50">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-block" name="meta_name_{$admin__cms__edit_uri__meta_index}" data-type="meta_name" data-uri-id="{$admin__cms__edit_uri__uri->id}" data-meta-id="{$admin__cms__edit_uri__meta_index}" value="{$admin__cms__edit_uri__meta_object->name}" placeholder="{$strings->get('admin__cms__edit_uri__name')}" maxlength="100">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-block" name="meta_content_tag_{$admin__cms__edit_uri__meta_index}" data-type="meta_content_tag" data-uri-id="{$admin__cms__edit_uri__uri->id}" data-meta-id="{$admin__cms__edit_uri__meta_index}" value="{$admin__cms__edit_uri__meta_object->contentTag}" placeholder="{$strings->get('admin__cms__edit_uri__content')}" maxlength="50">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-block" name="meta_content_{$admin__cms__edit_uri__meta_index}" data-type="meta_content" data-uri-id="{$admin__cms__edit_uri__uri->id}" data-meta-id="{$admin__cms__edit_uri__meta_index}" value="{$admin__cms__edit_uri__meta_object->content}" placeholder="{$strings->get('admin__cms__edit_uri__content')}" maxlength="100">
                                            </td>
                                            <td class="text-right">
                                                <div class="tool-tip">
                                                    <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__cms__edit_uri.cm({$admin__cms__edit_uri__uri->id}, {$admin__cms__edit_uri__meta_index})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__cms__edit_uri__clear')}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        {assign var="admin__cms__edit_uri__meta_index" value=$admin__cms__edit_uri__meta_index+1}
                                    {/foreach}
                                    {for $admin__cms__edit_uri__meta_add = 1 to 5}
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control d-block" name="meta_name_tag_{$admin__cms__edit_uri__meta_index}" data-type="meta_name_tag" data-uri-id="{$admin__cms__edit_uri__uri->id}" data-meta-id="{$admin__cms__edit_uri__meta_index}" value="name" placeholder="{$strings->get('admin__cms__edit_uri__name')}" maxlength="50">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-block" name="meta_name_{$admin__cms__edit_uri__meta_index}" data-type="meta_name" data-uri-id="{$admin__cms__edit_uri__uri->id}" data-meta-id="{$admin__cms__edit_uri__meta_index}" value="" placeholder="{$strings->get('admin__cms__edit_uri__name')}" maxlength="100">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-block" name="meta_content_tag_{$admin__cms__edit_uri__meta_index}" data-type="meta_content_tag" data-uri-id="{$admin__cms__edit_uri__uri->id}" data-meta-id="{$admin__cms__edit_uri__meta_index}" value="content" placeholder="{$strings->get('admin__cms__edit_uri__content')}" maxlength="50">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-block" name="meta_content_{$admin__cms__edit_uri__meta_index}" data-type="content" data-uri-id="{$admin__cms__edit_uri__uri->id}" data-meta-id="{$admin__cms__edit_uri__meta_index}" value="" placeholder="{$strings->get('admin__cms__edit_uri__content')}" maxlength="100">
                                            </td>
                                            <td class="text-right">
                                                <div class="tool-tip">
                                                    <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__cms__edit_uri.cm({$admin__cms__edit_uri__uri->id}, {$admin__cms__edit_uri__meta_index})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__cms__edit_uri__clear')}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        {assign var="admin__cms__edit_uri__meta_index" value=$admin__cms__edit_uri__meta_index+1}
                                    {/for}
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-primary" onclick="admin__cms__edit_uri.em(this, {$admin__cms__edit_uri__uri->id})">
                                {$strings->get('admin__cms__edit_uri__save')}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

{/if}