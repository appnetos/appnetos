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
 * @description     Password recovery form. Resets the password and sends an email with a link to recover the password
 *                  by using APPNET OS Mailer.
 *}

{* AJAX error *}
{if $appnetos__forgotten_password_form->ajaxError}
    <div id="appnetos__forgotten_password_form__ajax_error" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-danger m-0">
                {$appnetos__forgotten_password_form->ajaxError}
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $appnetos__forgotten_password_form->ajaxConfirm}
    <div id="appnetos__forgotten_password_form__ajax_confirm" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-success m-0">
                {$appnetos__forgotten_password_form->ajaxConfirm}
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
                    {$strings->get('appnetos__forgotten_password_form__settings')}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group mt-2">
                            <label for="appnetos__forgotten_password_form__mailbox">
                                {$strings->get('appnetos__forgotten_password_form__mailbox')}
                            </label>
                            <select class="form-control" id="appnetos__forgotten_password_form__mailbox">
                                <option value="">{$strings->get('appnetos__forgotten_password_form__select_mailbox')}</option>
                                {if $appnetos__forgotten_password_form->getMailboxes()}
                                    {foreach from=$appnetos__forgotten_password_form->getMailboxes() item="appnetos__forgotten_password_form__mailbox"}
                                        <option value="{$appnetos__forgotten_password_form__mailbox->uuid}" {if $appnetos__forgotten_password_form__mailbox->uuid === $appnetos__forgotten_password_form->settings->mailbox} selected{/if}>{$appnetos__forgotten_password_form__mailbox->name}</option>
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group mt-2">
                            <label for="appnetos__forgotten_password_form__name">
                                {$strings->get('appnetos__forgotten_password_form__name')}
                            </label>
                            <input type="text" class="form-control" id="appnetos__forgotten_password_form__name" value="{$appnetos__forgotten_password_form->settings->name}" placeholder="{$strings->get('appnetos__forgotten_password_form__name')}">
                        </div>
                    </div>
                    <div class="col-12 text-right mt-3">
                        <button type="button" class="btn btn-primary" onclick="appnetos__forgotten_password_form.ed()">
                            {$strings->get('appnetos__forgotten_password_form__save')}
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
            {$strings->get('appnetos__forgotten_password_form__license')}
        </div>
    </div>
</div>