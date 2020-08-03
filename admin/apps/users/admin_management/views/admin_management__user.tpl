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
 * @description     Admin overview and management for admin users.
 *}

{* AJAX error *}
{if $admin__users__admin_management__user->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__users__admin_management__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__users__admin_management__user->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__users__admin_management__user->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__users__admin_management__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__users__admin_management__user->ajaxConfirm}
        </div>
    </div>
{/if}

{* User *}
{if !$admin__users__admin_management__user->error}

    <div class="col-12 mt-4" data-type="admin__users__admin_management__user">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark text-light">
                <h5 class="float-left mt-2 mr-4">
                    {if $admin__users__admin_management__user->image}
                        <img class="admin__users__admin_management__icon rounded  mr-2" src="{$render->getUrl()}/out/admin/img/appnetos/users/100/{$admin__users__admin_management__user->image}">
                    {/if}
                    {$admin__users__admin_management__user->user}
                </h5>
                <div class="form-inline float-right">
                    {if !$admin__users__admin_management__user->active}
                        <div class="tool-tip">
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__users__admin_management.dc(this, {$admin__users__admin_management__user->id})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <span class="tool-tip-text bg-danger text-light">
                                {$strings->get("admin__users__admin_management__delete")}
                            </span>
                        </div>
                        <div class="tool-tip">
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__users__admin_management.te(this, {$admin__users__admin_management__user->id})">
                                <i class="fas fa-lock-open"></i>
                            </button>
                            <span class="tool-tip-text bg-success text-light">
                                {$strings->get("admin__users__admin_management__activate")}
                            </span>
                        </div>
                    {else}
                        <div class="tool-tip">
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__users__admin_management.dc(this, {$admin__users__admin_management__user->id})">
                                <i class="fa fa-trash"></i>
                            </button>
                            <span class="tool-tip-text bg-danger text-light">
                                {$strings->get("admin__users__admin_management__delete")}
                            </span>
                        </div>
                        <div class="tool-tip">
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__users__admin_management.lc(this, {$admin__users__admin_management__user->id})">
                                <i class="fas fa-lock"></i>
                            </button>
                            <span class="tool-tip-text bg-warning text-light">
                                {$strings->get("admin__users__admin_management__lock")}
                            </span>
                        </div>
                    {/if}
                    {if $admin__users__admin_management__search->view === 'details'}
                        <div class="tool-tip">
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__users__admin_management.tc(event, this, 'edit')">
                                <i class="far fa-edit"></i>
                            </button>
                            <span class="tool-tip-text bg-primary text-light">
                                {$strings->get("admin__users__admin_management__edit")}
                            </span>
                        </div>
                    {/if}
                </div>
            </div>

            {* Information *}
            <div class="card-body bg-light text-dark">
                <div class="row">
                    <div class="col-10">
                        <h6 class="mb-3">
                            <strong>
                                {$strings->get("admin__users__admin_management__user_id")}: {$admin__users__admin_management__user->id}
                            </strong>
                        </h6>
                    </div>
                    <div class="col-2">
                        <div class="form-inline float-right">
                            {if $admin__users__admin_management__user->active}
                                <span class="bg-success text-light rounded py-1 px-2 mt-2">{$strings->get("admin__users__admin_management__active")}</span>
                            {else}
                                <span class="bg-danger text-light rounded py-1 px-2 mt-2">{$strings->get("admin__users__admin_management__locked")}</span>
                            {/if}
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-2">
                        <div>
                            {$strings->get("admin__users__admin_management__mail")}
                        </div>
                        <a id="admin__users_mail_{$admin__users__admin_management__user->id}" href="mailto:{$admin__users__admin_management__user->mail}">
                            {$admin__users__admin_management__user->mail}
                        </a>
                    </div>
                    <div class="col-12 col-lg-6 mb-2">
                        <div>
                            {$strings->get("admin__users__admin_management__admin_group")}
                        </div>
                        <div class="text-secondary">
                            {if $admin__users__admin_management__user->groupId}
                                {$admin__users__admin_management__user->groupName}
                            {else}
                                {$strings->get("admin__users__admin_management__none")}
                            {/if}
                        </div>
                    </div>
                </div>
            </div>

            {* Details view *}
            {if $admin__users__admin_management__search->view === 'details'}

                {* Menu *}
                <div class="card-body bg-light text-dark p-0">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link{if $admin__users__admin_management__user->tab === 'properties'} active{/if}" href="" data-nav="properties" onclick="admin__users__admin_management.tc(event, this, 'properties')">
                                    {$strings->get('admin__users__admin_management__properties')}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{if $admin__users__admin_management__user->tab === 'edit'} active{/if}" href="" data-nav="edit" onclick="admin__users__admin_management.tc(event, this, 'edit')">
                                    {$strings->get('admin__users__admin_management__edit')}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{if $admin__users__admin_management__user->tab === 'information'} active{/if}" href="" data-nav="information" onclick="admin__users__admin_management.tc(event, this, 'information')">
                                    {$strings->get('admin__users__admin_management__information')}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


                {* Properties *}
                <div class="card-body bg-white text-dark-body{if $admin__users__admin_management__user->tab !== 'properties'} d-none{/if}" data-type="properties">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <div>
                                {$strings->get("admin__users__admin_management__last_sign_in")}
                            </div>
                            <div class="text-secondary">
                                {$admin__users__admin_management__user->tsLast|date_format:"%Y-%m-%d %H:%M:%S"}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <div>
                                {$strings->get("admin__users__admin_management__sign_in_count")}
                            </div>
                            <div class="text-secondary">
                                {$admin__users__admin_management__user->signInCount}
                            </div>
                        </div>
                    </div>
                </div>

                {* Edit *}
                <div class="card-body bg-white text-dark-body{if $admin__users__admin_management__user->tab !== 'edit'} d-none{/if}" data-type="edit">
                    <div class="d-block">
                        <form method="post" action="" id="form_edit_{$admin__users__admin_management__user->id}" autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="ns" value="admin/users">
                            <input type="hidden" name="cl" value="admin_management">
                            <input type="hidden" name="fn" value="edit">
                            <input type="hidden" name="aid" value="{$render->getAjaxId()}">
                            <input type="hidden" name="user_id" value="{$admin__users__admin_management__user->id}">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="mb-4 text-left text-lg-right">
                                        {if $admin__users__admin_management__user->image}
                                            <img class="admin__users__admin_management__image rounded" src="{$render->getUrl()}/out/admin/img/appnetos/users/100/{$admin__users__admin_management__user->image}">
                                        {else}
                                            &nbsp;
                                        {/if}
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                                    <label>
                                        {$strings->get('admin__users__admin_management__image')} (.svg, .png, .jpg, .gif) (< 2MB)
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="admin__users__admin_management__image_{$admin__users__admin_management__user->id}" name="image" aria-describedby="admin__users__admin_management__image_{$admin__users__admin_management__user->id}" oninput="admin__users__admin_management.oi(this)">
                                            <label class="custom-file-label" for="admin__users__admin_management__image_{$admin__users__admin_management__user->id}">{$strings->get('admin__users__admin_management__image')}</label>
                                        </div>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input d-block" name="delete_image" id="admin__users__admin_management__delete_image_{$admin__users__admin_management__user->id}">
                                        <label class="form-check-label" for="admin__users__admin_management__delete_image_{$admin__users__admin_management__user->id}">
                                            {$strings->get("admin__users__admin_management__delete_image")}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                                    <label>
                                        {$strings->get('admin__users__admin_management__user')}
                                    </label>
                                    <input type="text" autocomplete="off" class="form-control d-block" name="user" value="{$admin__users__admin_management__user->user}" placeholder="{$strings->get('admin__users__admin_management__user')}">
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input d-block" name="min_user_verify" id="admin__users__admin_management__min_user_{$admin__users__admin_management__user->id}">
                                        <label class="form-check-label" for="admin__users__admin_management__min_user_{$admin__users__admin_management__user->id}">
                                            {$strings->get('admin__users__admin_management__edit_min_user')}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                                    <label>
                                        {$strings->get('admin__users__admin_management__mail')}
                                    </label>
                                    <input type="email" autocomplete="off" class="form-control d-block" name="mail" value="{$admin__users__admin_management__user->mail}" placeholder="{$strings->get("admin__users__admin_management__mail")}">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                                    <label>
                                        {$strings->get('admin__users__admin_management__pass')}
                                    </label>
                                    <div class="input-group">
                                        <input type="password" autocomplete="new-password" class="form-control d-block" name="pass" placeholder="{$strings->get('admin__users__admin_management__pass')}">
                                        <div class="input-group-prepend" onclick="admin__users__admin_management.sh(this, '{$render->getUrl()}')">
                                            <div class="input-group-text">
                                                <img class="admin__users__admin_management__eye" src="{$render->getUrl()}/out/admin/img/appnetos/eye_open.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <small>{$strings->get('admin__users__admin_management__pass_info')}</small>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input d-block" name="min_pass_verify" id="admin__users__admin_management__min_pass_{$admin__users__admin_management__user->id}">
                                        <label class="form-check-label" for="admin__users__admin_management__min_pass_{$admin__users__admin_management__user->id}">
                                            {$strings->get("admin__users__admin_management__edit_min_pass")}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                                    <label>
                                        {$strings->get('admin__users__admin_management__group_id')}
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control d-block" name="group_id" value="{if $admin__users__admin_management__user->groupId}{$admin__users__admin_management__user->groupId}{/if}" placeholder="{$strings->get('admin__users__admin_management__group_id')}" onclick="admin__users__admin_management.ug(this)">
                                        <div class="input-group-prepend" onclick="admin__users__admin_management.dg(this, '{$render->getUrl()}')">
                                            <div class="input-group-text">
                                                <img class="admin__users__admin_management__eye" src="{$render->getUrl()}/out/admin/img/appnetos/trash.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-primary" onclick="admin__users__admin_management.ec(this, {$admin__users__admin_management__user->id})">
                                        {$strings->get("admin__users__admin_management__save")}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {* Information *}
                <div class="card-body bg-white text-dark-body{if $admin__users__admin_management__user->tab !== 'information'} d-none{/if}" data-type="information">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <div>
                                {$strings->get("admin__users__admin_management__last_sign_in")}
                            </div>
                            <div class="text-secondary">
                                {$admin__users__admin_management__user->tsLast|date_format:"%Y-%m-%d %H:%M:%S"}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4 my-2">
                            <div>
                                {$strings->get("admin__users__admin_management__ip_sign_in")}
                            </div>
                            <div class="text-secondary">
                                {$admin__users__admin_management__user->ipLast}
                            </div>
                        </div>
                    </div>
                </div>

            {/if}

        </div>
    </div>

{/if}