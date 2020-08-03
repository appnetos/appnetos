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
    <div id="app-{$appnetos__forgotten_password_form->appId}-error" class="alert alert-danger m-0{if $appnetos__forgotten_password_form->renderForm} mb-3{/if}" style="display: none;">
        {$appnetos__forgotten_password_form->ajaxError}
    </div>

{* AJAX confirm *}
{elseif $appnetos__forgotten_password_form->ajaxConfirm}
    <div id="app-{$appnetos__forgotten_password_form->appId}-confirm" class="alert alert-success m-0" style="display: none;">
        {$appnetos__forgotten_password_form->ajaxConfirm}
    </div>

{* Form *}
{else}
    <div id="app-{$appnetos__forgotten_password_form->appId}-input">
        <div id="app-{$appnetos__forgotten_password_form->appId}-loading" class="col-12 py-4 text-center" style="display: none">
            <img class="appnetos__forgotten_password_form__loading" src="{$render->getUrl()}/out/img/appnetos/loading.gif">
        </div>
        <div id="app-{$appnetos__forgotten_password_form->appId}-form">
            <div class="form-group">
                <label for="app-{$appnetos__forgotten_password_form->appId}-address">
                    {$strings->get('appnetos__forgotten_password_form__address')}
                </label>
                <input id="app-{$appnetos__forgotten_password_form->appId}-address" type="email" class="form-control" value="{$appnetos__forgotten_password_form->address}" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__forgotten_password_form__address')}">
                {if $appnetos__forgotten_password_form->addressError}
                    <div>
                        <small class="text-danger">{$appnetos__forgotten_password_form->addressError}</small>
                    </div>
                {/if}
            </div>
            <label for="app-{$appnetos__forgotten_password_form->appId}-pass">
                {$strings->get('appnetos__forgotten_password_form__pass')}
            </label>
            <div class="input-group">
                <input id="app-{$appnetos__forgotten_password_form->appId}-pass" type="password" class="form-control" value="{$appnetos__forgotten_password_form->pass}" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__forgotten_password_form__pass')}">
                <div class="input-group-prepend" onclick="appnetos__forgotten_password_form.sh({$appnetos__forgotten_password_form->appId})">
                    <div class="input-group-text">
                        <img class="appnetos__forgotten_password_form__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                    </div>
                </div>
            </div>
            {if $appnetos__forgotten_password_form->passError}
                <div>
                    <small class="text-danger">{$appnetos__forgotten_password_form->passError}</small>
                </div>
            {/if}
            <label class="mt-3" for="app-{$appnetos__forgotten_password_form->appId}-repeat">
                {$strings->get('appnetos__forgotten_password_form__pass_repeat')}
            </label>
            <div class="input-group">
                <input id="app-{$appnetos__forgotten_password_form->appId}-repeat" type="password" class="form-control" value="{$appnetos__forgotten_password_form->passRepeat}" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__forgotten_password_form__pass_repeat')}">
                <div class="input-group-prepend" onclick="appnetos__forgotten_password_form.sh({$appnetos__forgotten_password_form->appId})">
                    <div class="input-group-text">
                        <img class="appnetos__forgotten_password_form__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                    </div>
                </div>
            </div>
            {if $appnetos__forgotten_password_form->passRepeatError}
                <div>
                    <small class="text-danger">{$appnetos__forgotten_password_form->passRepeatError}</small>
                </div>
            {/if}
            <div class="mt-4">
                <button class="btn btn-primary" onclick="appnetos__forgotten_password_form.sp({$appnetos__forgotten_password_form->appId})">
                    {$strings->get('appnetos__forgotten_password_form__submit')}
                </button>
            </div>
        </div>
    </div>
{/if}