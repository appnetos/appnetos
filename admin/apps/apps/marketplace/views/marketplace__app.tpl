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
 * @description     APPNET OS Marketplace.
 *}

{* App *}
<div class="col-12 mt-4" data-type="admin__apps__marketplace__app">
    <div class="card admin__apps__marketplace__flex">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="float-left mt-2 mr-4">
                {if $admin__apps__marketplace__app->image}
                    <img class="admin__apps__marketplace__image rounded mr-2" src="{$admin__apps__marketplace__app->image}">
                {/if}
                {$admin__apps__marketplace__app->name}
            </h5>
            <div class="form-inline float-right">
                <div class="tool-tip">
                    <a class="text-decoration-none" href="{$admin__apps__marketplace__app->link}" target="_blank">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                            <i class="fas fa-store"></i>
                        </button>
                    </a>
                    <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__marketplace__open_in_marketplace')}</span>
                </div>
            </div>
        </div>

        {* Status *}
        <div class="card-body bg-light text-dark">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-2">
                        <strong>{$strings->get('admin__apps__marketplace__rating')}</strong>
                    </div>
                    {if $admin__apps__marketplace__app->reviewsCount}
                        <div class="float-left admin__apps__marketplace__rating_stars">
                            <ul style="background: url('{$render->getUrl()}/out/admin/img/appnetos/stars_empty.png');">
                                <li style="background: url('{$render->getUrl()}/out/admin/img/appnetos/stars_full.png'); width: {$admin__apps__marketplace__app->ratingWidth}px">
                                    &nbsp;
                                </li>
                            </ul>
                        </div>
                        <div class="float-left admin__apps__marketplace__rating_text">
                            &nbsp;{$admin__apps__marketplace__app->rating}/5&nbsp;({$admin__apps__marketplace__app->reviewsCount})
                        </div>
                        <div class="clear-both"></div>
                    {else}
                        <div class="text-secondary">
                            {$strings->get('admin__apps__marketplace__no_rating')}
                        </div>
                    {/if}
                </div>
                <div class="col-12 col-md-6 text-right">
                    {if $admin__apps__marketplace__app->downloadStatus === 'none'}
                        <span class="bg-primary text-light rounded py-1 px-2">{$strings->get('admin__apps__marketplace__download_status_none')}</span>
                    {elseif $admin__apps__marketplace__app->downloadStatus === 'unknown'}
                        <span class="bg-danger text-light rounded py-1 px-2">{$strings->get('admin__apps__marketplace__download_status_unknown')}</span>
                    {else}
                        <span class="bg-success text-light rounded py-1 px-2">{$strings->get('admin__apps__marketplace__download_available_version')}: {$admin__apps__marketplace__app->downloadStatus}</span>
                    {/if}

                </div>
            </div>
        </div>

        {* Menu *}
        <div class="card-body bg-light text-dark p-0">
            <div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="" data-nav="description" onclick="admin__apps__marketplace.tc(event, this, 'description')">
                            {$strings->get('admin__apps__marketplace__description')}
                        </a>
                    </li>
                    {if $admin__apps__marketplace__app->developer.name}
                        <li class="nav-item">
                            <a class="nav-link" href="" data-nav="developer" onclick="admin__apps__marketplace.tc(event, this, 'developer')">
                                {$strings->get('admin__apps__marketplace__developer')}
                            </a>
                        </li>
                    {/if}
                    <li class="nav-item">
                        <a class="nav-link" href="" data-nav="versions" onclick="admin__apps__marketplace.tc(event, this, 'versions')">
                            {$strings->get('admin__apps__marketplace__versions_licenses')}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {* Description *}
        <div class="card-body bg-white text-dark" data-type="description">
            <div class="row">
                <div class="col-12 col-md-5 col-lg-4 col-xl-3 mb-4">
                    {if $admin__apps__marketplace__app->image}
                        <img data-image-id="{$admin__apps__marketplace__app->id}" data-image="{$admin__apps__marketplace__app->image}" src="{$admin__apps__marketplace__app->image}" class="mb-2 admin__apps__marketplace__app_image w-100 border border-gray">
                    {/if}
                    {if $admin__apps__marketplace__app->images}
                        <div class="row">
                            {foreach from=$admin__apps__marketplace__app->images item='admin__apps__marketplace__app_image'}
                                <div class="col-4">
                                    <img data-thumb-id="{$admin__apps__marketplace__app->id}" data-image="{$admin__apps__marketplace__app_image.image}" src="{$admin__apps__marketplace__app_image.thumb}" class="mb-2 w-100 admin__apps__marketplace__app_image border border-gray">
                                </div>
                            {/foreach}
                        </div>
                    {/if}
                </div>
                <div class="col-12 col-md-7 col-lg-8 col-xl-6 mb-4">
                    <h5 class="mb-3">
                        {$admin__apps__marketplace__app->name}
                    </h5>
                    <div>
                        {$admin__apps__marketplace__app->description}
                    </div>
                    <div class="mt-4 text-right">
                        <h4 class="m-0">
                            <strong>
                                {$admin__apps__marketplace__app->price}
                            </strong>
                        </h4>
                        <small class="text-secondary">
                            {$strings->get('admin__apps__marketplace__tax_include')}
                        </small>
                    </div>
                </div>
                <div class="col-12 col-xl-3">
                    {foreach from=$admin__apps__marketplace__app->versions item='admin__apps__marketplace__app_versions'}
                        <div class="border border-gray mb-2">
                            <div class="p-3">
                                <div class="clear-both">
                                    <div class="float-left mt-2">
                                        <strong>
                                            {$strings->get('admin__apps__marketplace__version')} {$admin__apps__marketplace__app_versions->version}
                                        </strong>
                                        {$admin__apps__marketplace__app_versions->versionStatus}
                                        <br>
                                        {if $admin__apps__marketplace__app_versions->appnetosMinVersion !== $admin__apps__marketplace__app_versions->appnetosMaxVersion}
                                            {assign var='admin__apps__marketplace__appnetos_versions' value=$admin__apps__marketplace__app_versions->appnetosMinVersion|cat:'.x - '|cat: $admin__apps__marketplace__app_versions->appnetosMaxVersion|cat:'.x'}
                                        {else}
                                            {assign var='admin__apps__marketplace__appnetos_versions' value=$admin__apps__marketplace__app_versions->appnetosMinVersion|cat:'.x'}
                                        {/if}
                                        <small>
                                            APPNET OS {$admin__apps__marketplace__appnetos_versions}
                                        </small>
                                    </div>
                                    <div class="float-right mt-2">
                                        <h4 class="text-right m-0">
                                            <strong>
                                                {$admin__apps__marketplace__app_versions->price}
                                            </strong>
                                        </h4>
                                        <small class="text-secondary text-right">
                                            {$strings->get('admin__apps__marketplace__tax_include')}
                                        </small>
                                    </div>
                                    <div class="clear-both"></div>
                                </div>
                                <div class="text-right">
                                    {if $admin__apps__marketplace__user->user}
                                        <button type="submit" class="btn btn-primary ml-2 mt-3" onclick="admin__apps__marketplace.ac('{$admin__apps__marketplace__app_versions->id}')">
                                            <i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">{$strings->get('admin__apps__marketplace__add_to_cart')}</span>
                                        </button>
                                    {else}
                                        <button type="submit" class="btn btn-primary text-light ml-2 mt-3" data-toggle="modal" data-target="#admin__apps__maketplace__modal_sign_in" >
                                            <i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">{$strings->get('admin__apps__marketplace__add_to_cart_sign_in')}</span>
                                        </button>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>

        {* Developer *}
        {if $admin__apps__marketplace__app->developer.name}
            <div class="card-body bg-white text-dark d-none" data-type="developer">
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                        {if $admin__apps__marketplace__app->developer.image}
                            <img src="{$admin__apps__marketplace__app->developer.image}" class="mb-4 w-100 admin__apps__marketplace__developer_image">
                        {/if}
                    </div>
                    <div class="col-12 col-md-7 col-lg-8 col-xl-5">
                        <h5>
                            {$admin__apps__marketplace__app->developer.name}
                        </h5>
                        <br>
                        {if $admin__apps__marketplace__app->developer.uri}
                            <div class="mb-1">
                                <a href="{$admin__apps__marketplace__app->developer.uri}">
                                    <i class="fas fa-store fa-menu-size"></i> {$strings->get('admin__apps__marketplace__marketplace')}
                                </a>
                            </div>
                        {/if}
                        {if $admin__apps__marketplace__app->developer.web}
                            <div class="mb-1">
                                <a class="my-1" href="{$admin__apps__marketplace__app->developer.web}">
                                    <i class="fas fa-globe fa-menu-size"></i> {$admin__apps__marketplace__app->developer.web}
                                </a>
                            </div>
                        {/if}
                        {if $admin__apps__marketplace__app->developer.mail}
                            <div class="mb-1">
                                <a class="my-1" href="mailto: {$admin__apps__marketplace__app->developer.mail}">
                                    <i class="fas fa-envelope fa-menu-size"></i> {$admin__apps__marketplace__app->developer.mail}
                                </a>
                            </div>
                        {/if}
                        <br>
                        {if $admin__apps__marketplace__app->developer.address_1}
                            {$admin__apps__marketplace__app->developer.address_1}
                            <br>
                        {/if}
                        {if $admin__apps__marketplace__app->developer.address_2}
                            {$admin__apps__marketplace__app->developer.address_2}
                            <br>
                        {/if}
                        {if $admin__apps__marketplace__app->developer.city}
                            {$admin__apps__marketplace__app->developer.city}
                            {if $admin__apps__marketplace__app->developer.postcode}
                                {$admin__apps__marketplace__app->developer.postcode}
                            {/if}
                            <br>
                        {/if}
                        <br>
                        {if $admin__apps__marketplace__app->developer.country}
                            {$admin__apps__marketplace__app->developer.country}
                            <br>
                        {/if}
                        {if $admin__apps__marketplace__app->developer.zone}
                            {$admin__apps__marketplace__app->developer.zone}
                            <br>
                        {/if}
                    </div>
                </div>
            </div>
        {/if}

        {* Versions and licenses *}
        <div class="card-body bg-white text-dark d-none" data-type="versions">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select data-select="version_and_license" data-id="{$admin__apps__marketplace__app->id}" class="form-control">
                            {assign var='admin__apps__marketplace__index' value=1}
                            {foreach from=$admin__apps__marketplace__app->versions item='admin__apps__marketplace__app_versions'}
                                {if $admin__apps__marketplace__app_versions->appnetosMinVersion !== $admin__apps__marketplace__app_versions->appnetosMaxVersion}
                                    {assign var='admin__apps__marketplace__appnetos_versions' value=$admin__apps__marketplace__app_versions->appnetosMinVersion|cat:'.x - '|cat: $admin__apps__marketplace__app_versions->appnetosMaxVersion|cat:'.x'}
                                {else}
                                    {assign var='admin__apps__marketplace__appnetos_versions' value=$admin__apps__marketplace__app_versions->appnetosMinVersion|cat:'.x'}
                                {/if}
                                <option value="{$admin__apps__marketplace__index}">{$strings->get('admin__apps__marketplace__version')} {$admin__apps__marketplace__app_versions->version} {$admin__apps__marketplace__app_versions->versionStatus} :: APPNET OS {$admin__apps__marketplace__appnetos_versions}</option>
                                {assign var='admin__apps__marketplace__index' value=$admin__apps__marketplace__index+1}
                            {/foreach}
                        </select>
                        {assign var='admin__apps__marketplace__index' value=1}
                        {foreach from=$admin__apps__marketplace__app->versions item='admin__apps__marketplace__app_versions'}
                            <div data-div="version_and_license" data-id="{$admin__apps__marketplace__app->id}" data-index="{$admin__apps__marketplace__index}" class="mt-4{if $admin__apps__marketplace__index !== 1} d-none{/if}">
                                {$admin__apps__marketplace__app_versions->license}
                            </div>
                            {assign var='admin__apps__marketplace__index' value=$admin__apps__marketplace__index+1}
                        {/foreach}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>