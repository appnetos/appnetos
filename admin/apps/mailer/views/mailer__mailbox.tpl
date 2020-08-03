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
 * @description     Mailer logs, blacklist, settings, mailboxes.
 *}

{* AJAX error *}
{if $admin__mailer__mailer__mailbox->getAjaxError()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__mailer__mailer->getAjaxError()}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__mailer__mailer__mailbox->getAjaxConfirm()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__mailer__mailer__mailbox->getAjaxConfirm()}
        </div>
    </div>
{/if}

{* Mailbox *}
<div class="col-12 mt-4" data-type="admin__mailer__mailer__mailbox">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="mt-2 mr-4 float-left">
                {$admin__mailer__mailer__mailbox->name}
            </h5>
            <div class="form-inline float-right">
                <div class="tool-tip">
                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__mailer__mailer.dc('{$admin__mailer__mailer__mailbox->uuid}')">
                        <i class="fa fa-trash"></i>
                    </button>
                    <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__mailer__mailer__delete')}</span>
                </div>
                <div class="tool-tip">
                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__mailer__mailer.tc(event, this, 'edit')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <span class="tool-tip-text bg-warning text-light">{$strings->get('admin__mailer__mailer__edit')}</span>
                </div>
            </div>
        </div>

        {* Information *}
        <div class="card-body bg-light text-dark">
            <div>
                {$strings->get('admin__mailer__mailer__mailboxes__sent')}
                <div class="badge badge-success badge-pill rounded mr-4">
                    {$admin__mailer__mailer__mailbox->confirmCount}
                </div>
                {$strings->get('admin__mailer__mailer__mailboxes__failed')}
                <div class="badge badge-danger badge-pill rounded">
                    {$admin__mailer__mailer__mailbox->errorCount}
                </div>
            </div>
        </div>

        {* Menu *}
        <div class="card-body bg-light text-dark p-0">
            <div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="" data-nav="properties" onclick="admin__mailer__mailer.tc(event, this, 'properties')">
                            {$strings->get('admin__mailer__mailer__properties')}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-nav="edit" onclick="admin__mailer__mailer.tc(event, this, 'edit')">
                            {$strings->get('admin__mailer__mailer__edit')}
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
                        {$strings->get('admin__mailer__mailer__mailboxes__mail')}
                    </div>
                    <div class="text-secondary">
                        {$admin__mailer__mailer__mailbox->name}
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-4">
                    <div>
                        {$strings->get('admin__mailer__mailer__mailboxes_from_name')}
                    </div>
                    <div class="text-secondary">
                        {if $admin__mailer__mailer__mailbox->fromName}
                            {$admin__mailer__mailer__mailbox->fromName}
                        {else}
                            {$strings->get('admin__mailer__mailer__mailboxes_not_defined')}
                        {/if}
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-4">
                    <div>
                        {$strings->get('admin__mailer__mailer__mailboxes__host')}
                    </div>
                    <div class="text-secondary">
                        {$admin__mailer__mailer__mailbox->host}
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-4">
                    <div>
                        {$strings->get('admin__mailer__mailer__mailboxes__user')}
                    </div>
                    <div class="text-secondary">
                        {$admin__mailer__mailer__mailbox->user}
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-4">
                    <label class="form-group form-check pl-0">
                        <input type="checkbox" disabled {if $admin__mailer__mailer__mailbox->smtp}checked{/if}>
                        {$strings->get('admin__mailer__mailer__mailboxes__is_smtp')}
                    </label>
                </div>
                <div class="col-sm-12 col-md-4 mb-4">
                    <label class="form-group form-check pl-0">
                        <input type="checkbox" disabled {if $admin__mailer__mailer__mailbox->smtpAuthentication}checked{/if}>
                        {$strings->get('admin__mailer__mailer__mailboxes__smtp_auth')}
                    </label>
                </div>
            </div>
        </div>

        {* Edit *}
        <div class="card-body bg-white text-dark d-none" data-type="edit">
            <div class="row">
                <input type="hidden" data-type="admin__mailer__mailer__mailbox__edit_uuid" value="{$admin__mailer__mailer__mailbox->uuid}">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes__name')}
                    </label>
                    <input data-type="admin__mailer__mailer__mailbox__edit_name" type="text" class="form-control d-block" value="{$admin__mailer__mailer__mailbox->name}" placeholder="{$strings->get("admin__mailer__mailer__mailboxes__name")}">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes_from_name')}
                    </label>
                    <input data-type="admin__mailer__mailer__mailbox__edit_from_name" type="text" class="form-control d-block" value="{$admin__mailer__mailer__mailbox->fromName}" placeholder="{$strings->get("admin__mailer__mailer__mailboxes_from_name")}">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes__mail')}
                    </label>
                    <input data-type="admin__mailer__mailer__mailbox__edit_address" type="email" class="form-control d-block" value="{$admin__mailer__mailer__mailbox->address}" placeholder="{$strings->get("admin__mailer__mailer__mailboxes__mail")}">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes__host')}
                    </label>
                    <input data-type="admin__mailer__mailer__mailbox__edit_host" type="text" class="form-control d-block" value="{$admin__mailer__mailer__mailbox->host}" placeholder="{$strings->get("admin__mailer__mailer__mailboxes__host")}">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes__port')}
                    </label>
                    <input data-type="admin__mailer__mailer__mailbox__edit_port" type="number" class="form-control d-block" value="{$admin__mailer__mailer__mailbox->port}" placeholder="{$strings->get("admin__mailer__mailer__mailboxes__port")}">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes__user')}
                    </label>
                    <input data-type="admin__mailer__mailer__mailbox__edit_user" type="text" class="form-control d-block" value="{$admin__mailer__mailer__mailbox->user}" placeholder="{$strings->get("admin__mailer__mailer__mailboxes__user")}">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes__pass')}
                    </label>
                    <div class="input-group">
                        <input data-type="admin__mailer__mailer__mailbox__edit_pass" type="password" class="form-control d-block" placeholder="{$strings->get('admin__mailer__mailer__mailboxes__pass')}">
                        <div class="input-group-prepend" onclick="admin__mailer__mailer.sh(this, '{$render->getUrl()}')">
                            <div class="input-group-text">
                                <img class="admin__mailer__mailer__eye" src="{$render->getUrl()}/out/admin/img/appnetos/eye_open.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <small class="text-secondary">
                        {$strings->get('admin__mailer__mailer__pass_info')}
                    </small>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes__timeout')}
                    </label>
                    <input data-type="admin__mailer__mailer__mailbox__edit_timeout" type="number" class="form-control d-block" value="{$admin__mailer__mailer__mailbox->timeout}" placeholder="{$strings->get("admin__mailer__mailer__mailboxes__timeout")}">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input data-type="admin__mailer__mailer__mailbox__edit_is_smtp" type="checkbox" class="form-check-input d-block"{if $admin__mailer__mailer__mailbox->smtp} checked{/if}>
                            {$strings->get('admin__mailer__mailer__mailboxes__is_smtp')}
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input data-type="admin__mailer__mailer__mailbox__edit_smtp_auth" type="checkbox" class="form-check-input d-block"{if $admin__mailer__mailer__mailbox->smtpAuthentication} checked{/if}>
                            {$strings->get('admin__mailer__mailer__mailboxes__smtp_auth')}
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <div class="form-group">
                        <label>
                            {$strings->get('admin__mailer__mailer__mailboxes__secure')}
                        </label>
                        <select class="form-control d-block" data-type="admin__mailer__mailer__mailboxes__edit_smtp_secure">
                            <option class="d-block" value="none">{$strings->get('admin__mailer__mailer__mailboxes__none')}</option>
                            <option class="d-block" value="tls" {if $admin__mailer__mailer__mailbox->smtpSecure === 'tls'} selected{/if}>tls</option>
                            <option class="d-block" value="ssl" {if $admin__mailer__mailer__mailbox->smtpSecure === 'ssl'} selected{/if}>ssl</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                    <label>
                        {$strings->get('admin__mailer__mailer__mailboxes_firewall')}
                    </label>
                    <div class="form-check">
                        <input class="form-check-input d-block" type="radio" data-type="admin__mailer__mailer__mailboxes__edit_firewall_1" id="{$admin__mailer__mailer__mailbox->uuid}_1" name="{$admin__mailer__mailer__mailbox->uuid}" value="1"{if $admin__mailer__mailer__mailbox->firewall} checked{/if}>
                        <label class="form-check-label" for="{$admin__mailer__mailer__mailbox->uuid}_1">
                            {$strings->get('admin__mailer__mailer__mailboxes_firewall_true')}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input d-block" type="radio" data-type="admin__mailer__mailer__mailboxes__edit_firewall_2" id="{$admin__mailer__mailer__mailbox->uuid}_2" name="{$admin__mailer__mailer__mailbox->uuid}" value="2"{if !$admin__mailer__mailer__mailbox->firewall} checked{/if}>
                        <label class="form-check-label" for="{$admin__mailer__mailer__mailbox->uuid}_2">
                            {$strings->get('admin__mailer__mailer__mailboxes_firewall_false')}
                        </label>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-primary" onclick="admin__mailer__mailer.em(this)">
                        {$strings->get('admin__mailer__mailer__menu_save')}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>