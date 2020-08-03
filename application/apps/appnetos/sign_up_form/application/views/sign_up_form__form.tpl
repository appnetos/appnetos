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
    <div id="app-{$appnetos__sign_up_form->appId}-error" class="alert alert-danger m-0{if $appnetos__sign_up_form->renderForm} mb-3{/if}" style="display: none;">
        {$appnetos__sign_up_form->ajaxError}
    </div>
{/if}

{* AJAX confirm *}
{if $appnetos__sign_up_form->ajaxConfirm}
    <div id="app-{$appnetos__sign_up_form->appId}-confirm" class="alert alert-success m-0" style="display: none;">
        {$appnetos__sign_up_form->ajaxConfirm}
    </div>
{/if}

{* Form *}
{if $appnetos__sign_up_form->renderForm}
    <div id="app-{$appnetos__sign_up_form->appId}-input">
        <div id="app-{$appnetos__sign_up_form->appId}-loading" class="col-12 py-4 text-center" style="display: none">
            <img class="appnetos__sign_up_form__loading" src="{$render->getUrl()}/out/img/appnetos/loading.gif">
        </div>
        <div id="app-{$appnetos__sign_up_form->appId}-form">
            {if !$appnetos__sign_up_form->settings->force}
                <div id="app-{$appnetos__sign_up_form->appId}-mid" class="d-none">
                    {$appnetos__sign_up_form->getMailerId()}
                </div>
            {/if}
            <div class="form-group">
                <label for="app-{$appnetos__sign_up_form->appId}-user">
                    {$strings->get('appnetos__sign_up_form__user')}
                </label>
                <input id="app-{$appnetos__sign_up_form->appId}-user" type="text" class="form-control" value="{$appnetos__sign_up_form->user}" placeholder="{$strings->get('appnetos__sign_up_form__user')}">
                {if $appnetos__sign_up_form->errorUser}
                    <div>
                        <small class="text-danger">{$appnetos__sign_up_form->errorUser}</small>
                    </div>
                {/if}
            </div>
            <div class="form-group">
                <label for="app-{$appnetos__sign_up_form->appId}-address">
                    {$strings->get('appnetos__sign_up_form__address')}
                </label>
                <input id="app-{$appnetos__sign_up_form->appId}-address" type="email" class="form-control" value="{$appnetos__sign_up_form->address}" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__sign_up_form__address')}">
                {if $appnetos__sign_up_form->errorAddress}
                    <div>
                        <small class="text-danger">{$appnetos__sign_up_form->errorAddress}</small>
                    </div>
                {/if}
            </div>
            <label for="app-{$appnetos__sign_up_form->appId}-pass">
                {$strings->get('appnetos__sign_up_form__pass')}
            </label>
            <div class="input-group">
                <input id="app-{$appnetos__sign_up_form->appId}-pass" type="password" class="form-control" value="{$appnetos__sign_up_form->pass}" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__sign_up_form__pass')}">
                <div class="input-group-prepend" onclick="appnetos__sign_up_form.sh({$appnetos__sign_up_form->appId})">
                    <div class="input-group-text">
                        <img class="appnetos__sign_up_form__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                    </div>
                </div>
            </div>
            {if $appnetos__sign_up_form->errorPass}
                <div>
                    <small class="text-danger">{$appnetos__sign_up_form->errorPass}</small>
                </div>
            {/if}
            <label class="mt-3" for="app-{$appnetos__sign_up_form->appId}-repeat">
                {$strings->get('appnetos__sign_up_form__pass_repeat')}
            </label>
            <div class="input-group">
                <input id="app-{$appnetos__sign_up_form->appId}-repeat" type="password" class="form-control" value="{$appnetos__sign_up_form->passRepeat}" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__sign_up_form__pass_repeat')}">
                <div class="input-group-prepend" onclick="appnetos__sign_up_form.sh({$appnetos__sign_up_form->appId})">
                    <div class="input-group-text">
                        <img class="appnetos__sign_up_form__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                    </div>
                </div>
            </div>
            {if $appnetos__sign_up_form->errorPassRepeat}
                <div>
                    <small class="text-danger">{$appnetos__sign_up_form->errorPassRepeat}</small>
                </div>
            {/if}
            {if $appnetos__sign_up_form->settings->terms}
                <div class="form-check mt-4">
                    <input type="checkbox" class="form-check-input" id="app-{$appnetos__sign_up_form->appId}-terms"{if $appnetos__sign_up_form->terms} checked{/if}>
                    <label class="form-check-label" for="app-{$appnetos__sign_up_form->appId}-terms">
                        {$strings->get('appnetos__sign_up_form__terms_accept')}<br>
                        <a href="{$appnetos__sign_up_form->getUrl($appnetos__sign_up_form->settings->terms)}">
                            {$strings->get('appnetos__sign_up_form__terms')}
                        </a>
                    </label>
                </div>
            {/if}
            {if $appnetos__sign_up_form->errorTerms}
                <div>
                    <small class="text-danger">{$appnetos__sign_up_form->errorTerms}</small>
                </div>
            {/if}
            <div class="mt-4">
                <button class="btn btn-primary" onclick="appnetos__sign_up_form.su({$appnetos__sign_up_form->appId})">
                    {$strings->get('appnetos__sign_up_form__submit')}
                </button>
            </div>
        </div>
    </div>
{/if}