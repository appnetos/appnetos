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
 * @description     Simple form to sign in by email or username and password.
*}

{* If user signed in *}
{if $appnetos__sign_in_form->active}
    <div id="app-{$appnetos__sign_in_form->appId}-button">
        <button class="btn btn-primary" onclick="appnetos__sign_in_form.so()">
            {$strings->get('appnetos__sign_in_form__sign_out')}
        </button>
    </div>

{* If user not signed in *}
{else}

    {* Form *}
    <div id="app-{$appnetos__sign_in_form->appId}-input">
        <div id="app-{$appnetos__sign_in_form->appId}-loading" class="col-12 my-4 text-center" style="display: none;">
            <img class="appnetos__sign_in_form__loading" src="{$render->getUrl()}/out/img/appnetos/loading.gif">
        </div>
        <div id="app-{$appnetos__sign_in_form->appId}-container">
            <form method="post" id="app-{$appnetos__sign_in_form->appId}-form" action="">
                <div class="form-group">
                    <label for="app-{$appnetos__sign_in_form->appId}-user">
                        {$strings->get('appnetos__sign_in_form__user')}
                    </label>
                    <input id="app-{$appnetos__sign_in_form->appId}-user" name="user" type="text" class="form-control" value="{$appnetos__sign_in_form->user}" placeholder="{$strings->get('appnetos__sign_in_form__user')}" onkeydown="appnetos__sign_in_form.kd(event, {$appnetos__sign_in_form->appId})">
                    {if $appnetos__sign_in_form->error}
                        <small class="text-danger">{$appnetos__sign_in_form->error}</small>
                    {/if}
                </div>
                <label for="app-{$appnetos__sign_in_form->appId}-pass">
                    {$strings->get('appnetos__sign_in_form__pass')}
                </label>
                <div class="input-group">
                    <input id="app-{$appnetos__sign_in_form->appId}-pass" name="pass" type="password" class="form-control" value="{$appnetos__sign_in_form->pass}" placeholder="{$strings->get('appnetos__sign_in_form__pass')}" onkeydown="appnetos__sign_in_form.kd(event, {$appnetos__sign_in_form->appId})">
                    <div class="input-group-prepend" onclick="appnetos__sign_in_form.sh({$appnetos__sign_in_form->appId})">
                        <div class="input-group-text">
                            <img class="appnetos__sign_in_form__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                        </div>
                    </div>
                </div>
                {if $appnetos__sign_in_form->error}
                    <small class="text-danger">{$appnetos__sign_in_form->error}</small>
                {/if}
                {if $appnetos__sign_in_form->settings->forgetPass}
                    <div class="mt-2">
                        <a href="{$render->getUrl($appnetos__sign_in_form->settings->forgetPass)}">
                            {$strings->get('appnetos__sign_in_form__forget_pass')}
                        </a>
                    </div>
                {/if}
                <div class="form-check mt-4">
                    <label class="form-check-label text-dark">
                        <input id="app-{$appnetos__sign_in_form->appId}-stay" name="stay" type="checkbox" class="form-check-input"{if $appnetos__sign_in_form->stay} checked{/if}>
                        {$strings->get('appnetos__sign_in_form__stay')}
                    </label>
                </div>
                <div class="d-inline-block w-100 mt-4">
                    <button type="button" class="btn btn-primary float-left" onclick="appnetos__sign_in_form.si({$appnetos__sign_in_form->appId})">
                        {$strings->get('appnetos__sign_in_form__sign_in')}
                    </button>
                    {if $appnetos__sign_in_form->settings->signup}
                        <div class="float-right">
                            <a href="{$render->getUrl($appnetos__sign_in_form->settings->signup)}">
                                <button type="button" class="btn btn-secondary">
                                    {$strings->get('appnetos__sign_in_form__sign_up')}
                                </button>
                            </a>
                        </div>
                    {/if}
                </div>
            </form>
        </div>
    </div>

{/if}