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
 * @description     Application user groups. Groups can be used to define which users can view which areas..
 *}

{* AJAX error *}
{if $admin__groups__application_groups__group->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__groups__application_groups__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__groups__application_groups__group->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__groups__application_groups__group->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__groups__application_groups__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__groups__application_groups__group->ajaxConfirm}
        </div>
    </div>
{/if}

{* User *}
{if !$admin__groups__application_groups__group->error}

    <div class="col-12 mt-4" data-type="admin__groups__application_groups__group">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark text-light">
                <h5 class="float-left mt-2 mr-4">
                    {$admin__groups__application_groups__group->name}
                </h5>
                <div class="form-inline float-right">
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__groups__application_groups.dc(this, {$admin__groups__application_groups__group->id})">
                            <i class="fa fa-trash"></i>
                        </button>
                        <span class="tool-tip-text bg-danger text-light">
                            {$strings->get("admin__groups__application_groups__delete")}
                        </span>
                    </div>
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__groups__application_groups.sd({$admin__groups__application_groups__group->id})">
                            <i class="fas fa-star"></i>
                        </button>
                        <span class="tool-tip-text bg-primary text-light">
                                {$strings->get("admin__groups__application_groups__as_default")}
                        </span>
                    </div>
                </div>
            </div>

            {* Information *}
            <div class="card-body bg-light text-dark">
                <div class="row">
                    <div class="col-10">
                        <h6 class="mb-3">
                            <strong>
                                {$strings->get("admin__groups__application_groups__group_id")}: {$admin__groups__application_groups__group->id}
                            </strong>
                        </h6>
                    </div>
                    {if $admin__groups__application_groups__group->default}
                        <div class="col-2">
                            <div class="form-inline float-right">
                                <span class="bg-primary text-light rounded py-1 px-2">{$strings->get("admin__groups__application_groups__default")}</span>
                            </div>
                        </div>
                    {/if}
                    {if !$admin__groups__application_groups__group->deniedCount}
                        {if !$admin__groups__application_groups__group->grantedCount}
                            <div class="col-12 col-lg-6 mb-2">
                                <div class="mb-2">
                                    {$strings->get("admin__groups__application_groups__denied_uris")}
                                </div>
                                <div>
                                    <span class="bg-danger text-light rounded py-1 px-2">
                                        {$strings->get("admin__groups__application_groups__non")}
                                    </span>
                                </div>
                            </div>
                        {else}
                            <div class="col-12 col-lg-6 mb-2">
                                <div class="mb-2">
                                    {$strings->get("admin__groups__application_groups__denied_uris")}
                                </div>
                                <div>
                                    <span class="bg-danger text-light rounded py-1 px-2">
                                        {$strings->get("admin__groups__application_groups__all_but_granted")}
                                    </span>
                                </div>
                            </div>
                        {/if}
                    {else}
                        <div class="col-12 col-lg-6 mb-2">
                            <div class="mb-2">
                                {$strings->get("admin__groups__application_groups__denied_uris")}
                            </div>
                            <div>
                                <span class="bg-danger text-light rounded py-1 px-2">
                                    {$admin__groups__application_groups__group->deniedCount}
                                </span>
                            </div>
                        </div>
                    {/if}
                    {if !$admin__groups__application_groups__group->grantedCount}
                        {if !$admin__groups__application_groups__group->deniedCount}
                            <div class="col-12 col-lg-6 mb-2">
                                <div class="mb-2">
                                    {$strings->get("admin__groups__application_groups__granted_uris")}
                                </div>
                                <div>
                                    <span class="bg-success text-light rounded py-1 px-2">
                                        {$strings->get("admin__groups__application_groups__all")}
                                    </span>
                                </div>
                            </div>
                        {else}
                            <div class="col-12 col-lg-6 mb-2">
                                <div class="mb-2">
                                    {$strings->get("admin__groups__application_groups__granted_uris")}
                                </div>
                                <div>
                                    <span class="bg-success text-light rounded py-1 px-2">
                                        {$strings->get("admin__groups__application_groups__all_but_denied")}
                                    </span>
                                </div>
                            </div>
                        {/if}
                    {else}
                        <div class="col-12 col-lg-6 mb-2">
                            <div class="mb-2">
                                {$strings->get("admin__groups__application_groups__granted_uris")}
                            </div>
                            <div>
                                <span class="bg-success text-light rounded py-1 px-2">
                                    {$admin__groups__application_groups__group->grantedCount}
                                </span>
                            </div>
                        </div>
                    {/if}
                </div>
            </div>

            {* Details view *}
            {if $admin__groups__application_groups__search->view === 'details'}

                {* Used IDs as array *}
                <div class="d-none" data-type="used_array" data-id="{$admin__groups__application_groups__group->id}">{$admin__groups__application_groups__group->getUsed()}</div>

                {* Menu *}
                <div class="card-body bg-light text-dark p-0">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link{if $admin__groups__application_groups__group->tab === 'edit'} active{/if}" href="" data-nav="edit" onclick="admin__groups__application_groups.tc(event, this, 'edit')">
                                    {$strings->get('admin__groups__application_groups__edit')}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{if $admin__groups__application_groups__group->tab === 'denied'} active{/if}" href="" data-nav="denied" onclick="admin__groups__application_groups.tc(event, this, 'denied')">
                                    {$strings->get('admin__groups__application_groups__denied_uris')}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{if $admin__groups__application_groups__group->tab === 'granted'} active{/if}" href="" data-nav="granted" onclick="admin__groups__application_groups.tc(event, this, 'granted')">
                                    {$strings->get('admin__groups__application_groups__granted_uris')}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                {* Edit *}
                <div class="card-body bg-white text-dark-body{if $admin__groups__application_groups__group->tab !== 'edit'} d-none{/if}" data-type="edit">
                    <div class="d-block" data-type="form_edit" data-group-id="{$admin__groups__application_groups__group->id}">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-4">
                                <label>
                                    {$strings->get('admin__groups__application_groups__name')}
                                </label>
                                <input type="text" class="form-control d-block" maxlength="100" data-type="group_name" data-group-id="{$admin__groups__application_groups__group->id}" value="{$admin__groups__application_groups__group->name}" placeholder="{$strings->get('admin__groups__application_groups__name')}">
                            </div>
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-primary" onclick="admin__groups__application_groups.ed(this, '{$admin__groups__application_groups__group->id}')">
                                    {$strings->get("admin__groups__application_groups__edit")}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {* Denied URIs *}
                <div class="card-body bg-white text-dark-body{if $admin__groups__application_groups__group->tab !== 'denied'} d-none{/if}" data-type="denied">
                    <div class="d-block" data-type="form_denied" data-group-id="{$admin__groups__application_groups__group->id}">
                        <input type="hidden" name="group_id" value="{$admin__groups__application_groups__group->id}">
                        <div class="row">
                            {if $admin__groups__application_groups__group->deniedCount>0}
                                <div class="col-12 mt-3 table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="text-center admin__groups__application_groups__td_checkbox">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input d-block" data-type="denied_all" data-group-id="{$admin__groups__application_groups__group->id}" onclick="admin__groups__application_groups.cha(this, '{$admin__groups__application_groups__group->id}', 'denied')">
                                                    </div>
                                                </td>
                                                <td class="text-dark">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            {foreach from=$admin__groups__application_groups__group->denied key='admin__groups__application_groups__group_key' item='admin__groups__application_groups__group_name'}
                                                <tr class="admin__groups__application_groups__pointer" onclick="admin__groups__application_groups.ch('{$admin__groups__application_groups__group->id}', '{$admin__groups__application_groups__group_key}', 'denied')">
                                                    <td class="text-center admin__groups__application_groups__td_checkbox">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input d-block" data-type="denied" data-group-id="{$admin__groups__application_groups__group->id}" name="{$admin__groups__application_groups__group_key}" onclick="admin__groups__application_groups.ch('{$admin__groups__application_groups__group->id}', '{$admin__groups__application_groups__group_key}', 'denied')">
                                                        </div>
                                                    </td>
                                                    <td class="text-dark">
                                                        {$admin__groups__application_groups__group_name}
                                                    </td>
                                                </tr>
                                            {/foreach}
                                        </tbody>
                                    </table>
                                </div>
                            {else}
                                <div class="col-12">
                                    <div class="alert alert-warning">
                                        {$strings->get('admin__groups__application_groups__no_uris')}
                                    </div>
                                </div>
                            {/if}
                            <div class="col-12 mt-3">
                                {if $admin__groups__application_groups__group->deniedCount}
                                    <button type="button" class="btn btn-danger float-left mr-2" onclick="admin__groups__application_groups.rd(this, '{$admin__groups__application_groups__group->id}')">
                                        {$strings->get("admin__groups__application_groups__remove")}
                                    </button>
                                {/if}
                                <button type="button" class="btn btn-primary float-right" onclick="admin__groups__application_groups.ad(this, '{$admin__groups__application_groups__group->id}')">
                                    {$strings->get("admin__groups__application_groups__add")}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {* Granted URIs *}
                <div class="card-body bg-white text-dark-body{if $admin__groups__application_groups__group->tab !== 'granted'} d-none{/if}" data-type="granted">
                    <div class="d-block" data-type="form_granted" data-group-id="{$admin__groups__application_groups__group->id}">
                        <input type="hidden" name="group_id" value="{$admin__groups__application_groups__group->id}">
                        <div class="row">
                            {if $admin__groups__application_groups__group->grantedCount>0}
                                <div class="col-12 mt-3 table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="text-center admin__groups__application_groups__td_checkbox">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input d-block" data-type="granted_all" data-group-id="{$admin__groups__application_groups__group->id}" onclick="admin__groups__application_groups.cha(this, '{$admin__groups__application_groups__group->id}', 'granted')">
                                                    </div>
                                                </td>
                                                <td class="text-dark">
                                                    &nbsp;
                                                </td>
                                            </tr>
                                            {foreach from=$admin__groups__application_groups__group->granted key='admin__groups__application_groups__group_key' item='admin__groups__application_groups__group_name'}
                                                <tr class="admin__groups__application_groups__pointer" onclick="admin__groups__application_groups.ch('{$admin__groups__application_groups__group->id}', '{$admin__groups__application_groups__group_key}', 'granted')">
                                                    <td class="text-center admin__groups__application_groups__td_checkbox">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input d-block" data-type="granted" data-group-id="{$admin__groups__application_groups__group->id}" name="{$admin__groups__application_groups__group_key}" onclick="admin__groups__application_groups.ch('{$admin__groups__application_groups__group->id}', '{$admin__groups__application_groups__group_key}', 'granted')">
                                                        </div>
                                                    </td>
                                                    <td class="text-dark">
                                                        {$admin__groups__application_groups__group_name}
                                                    </td>
                                                </tr>
                                            {/foreach}
                                        </tbody>
                                    </table>
                                </div>
                            {else}
                                <div class="col-12">
                                    <div class="alert alert-warning">
                                        {$strings->get('admin__groups__application_groups__no_uris')}
                                    </div>
                                </div>
                            {/if}
                            <div class="col-12 mt-3">
                                {if $admin__groups__application_groups__group->grantedCount}
                                    <button type="button" class="btn btn-danger float-left mr-2" onclick="admin__groups__application_groups.rg(this, '{$admin__groups__application_groups__group->id}')">
                                        {$strings->get("admin__groups__application_groups__remove")}
                                    </button>
                                {/if}
                                <button type="button" class="btn btn-primary float-right" onclick="admin__groups__application_groups.ag(this, '{$admin__groups__application_groups__group->id}')">
                                    {$strings->get("admin__groups__application_groups__add")}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            {/if}

        </div>
    </div>

{/if}