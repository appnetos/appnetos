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
 * @description     Sign up form form to provide user information. Can be used with and without email confirmation.
 *                  Creates a user and sends a confirmation by the APPNET OS mailer with confirmation link.
 *}

{* AJAX error *}
{if $appnetos__sign_up_form->ajaxError}
    <div id="appnetos__sign_up_form__ajax_error" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-danger m-0">
                {$appnetos__sign_up_form->ajaxError}
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $appnetos__sign_up_form->ajaxConfirm}
    <div id="appnetos__sign_up_form__ajax_confirm" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-success m-0">
                {$appnetos__sign_up_form->ajaxConfirm}
            </div>
        </div>
    </div>
{/if}

{* Settings *}
<div class="row">
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header bg-dark text-light">
                <h5 class="card-title m-0">
                    {$strings->get('appnetos__sign_up_form__settings')}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="appnetos__sign_up_form__force"{if $appnetos__sign_up_form->settings->force} checked{/if} onchange="appnetos__sign_up_form.fc()">
                            <label class="form-check-label" for="appnetos__sign_up_form__force">
                                {$strings->get('appnetos__sign_up_form__directly')}
                            </label>
                        </div>
                    </div>
                    <div class="col-12" id="appnetos__sign_up_form__mail"{if $appnetos__sign_up_form->settings->force} style="display: none;"{/if}">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="form-group mt-4">
                                    <label for="appnetos__sign_up_form__mailbox">
                                        {$strings->get('appnetos__sign_up_form__mailbox')}
                                    </label>
                                    <select class="form-control" id="appnetos__sign_up_form__mailbox">
                                        <option value="">{$strings->get('appnetos__sign_up_form__select_mailbox')}</option>
                                        {if $appnetos__sign_up_form->getMailboxes()}
                                            {foreach from=$appnetos__sign_up_form->getMailboxes() item="appnetos__sign_up_form__mailbox"}
                                                <option value="{$appnetos__sign_up_form__mailbox->uuid}" {if $appnetos__sign_up_form__mailbox->uuid === $appnetos__sign_up_form->settings->mailbox} selected{/if}>{$appnetos__sign_up_form__mailbox->name}</option>
                                            {/foreach}
                                        {/if}
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <div class="form-group mt-4">
                                    <label for="appnetos__sign_up_form__name">
                                        {$strings->get('appnetos__sign_up_form__name')}
                                    </label>
                                    <input type="text" class="form-control" id="appnetos__sign_up_form__name" value="{$appnetos__sign_up_form->settings->name}" placeholder="{$strings->get('appnetos__sign_up_form__name')}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group mt-4">
                            <label for="appnetos__sign_up_form__terms">
                                {$strings->get('appnetos__sign_up_form__terms')}
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="appnetos__sign_up_form__terms" value="{$appnetos__sign_up_form->settings->terms}" placeholder="{$strings->get('appnetos__sign_up_form__terms_holder')}">
                                <div class="input-group-prepend" onclick="admin__cms__picker.pick('appnetos__sign_up_form.pc')">
                                    <div class="input-group-text">
                                        <img class="appnetos__sign_up_form__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                                    </div>
                                </div>
                            </div>
                            <small class="text-secondary" for="appnetos__sign_up_form__terms">
                                {$strings->get('appnetos__sign_up_form__terms_info')}
                            </small>
                        </div>
                    </div>
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-primary mt-4" onclick="appnetos__sign_up_form.sa()">
                            {$strings->get('appnetos__sign_up_form__save')}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{* License *}
<div class="row">
    <div class="col-12 mt-4">
        <div class="bg-light text-secondary text-justify p-3">
            {$strings->get('appnetos__sign_up_form__license')}
        </div>
    </div>
</div>