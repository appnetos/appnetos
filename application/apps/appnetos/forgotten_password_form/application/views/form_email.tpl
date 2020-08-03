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

{* AJAX confirm *}
{if $appnetos__forgotten_password_form->ajaxConfirm}
    <div id="app-{$appnetos__forgotten_password_form->appId}-confirm" class="alert alert-success m-0" style="display: none;">
        {$appnetos__forgotten_password_form->ajaxConfirm}
    </div>
{else}

{* Form email *}
    <div id="app-{$appnetos__forgotten_password_form->appId}-input">
        <div id="app-{$appnetos__forgotten_password_form->appId}-loading" class="col-12 py-4 text-center" style="display: none">
            <img class="appnetos__forgotten_password_form__loading" src="{$render->getUrl()}/out/img/appnetos/loading.gif">
        </div>
        <div id="app-{$appnetos__forgotten_password_form->appId}-form">
            <div id="app-{$appnetos__forgotten_password_form->appId}-mid" class="d-none">
                {$appnetos__forgotten_password_form->getMailerId()}
            </div>
            <div class="form-group">
                <label for="app-{$appnetos__forgotten_password_form->appId}-address">
                    {$strings->get('appnetos__forgotten_password_form__address')}
                </label>
                <input id="app-{$appnetos__forgotten_password_form->appId}-address" type="email" name="email" class="form-control" aria-describedby="emailHelp" value="{$appnetos__forgotten_password_form->address}" placeholder="{$strings->get('appnetos__forgotten_password_form__address')}">
                {if $appnetos__forgotten_password_form->addressError}
                    <div>
                        <small class="text-danger">{$appnetos__forgotten_password_form->addressError}</small>
                    </div>
                {/if}
            </div>
            <div class="mt-4">
                <button class="btn btn-primary" onclick="appnetos__forgotten_password_form.se({$appnetos__forgotten_password_form->appId})">
                    {$strings->get('appnetos__forgotten_password_form__submit')}
                </button>
            </div>
        </div>
    </div>
{/if}