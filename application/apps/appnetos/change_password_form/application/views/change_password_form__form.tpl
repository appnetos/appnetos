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
 * @description     Form in which users can change their password when they are signed in.
*}

{* AJAX error *}
{if $appnetos__change_password_form->ajaxError}
    <div id="app-{$appnetos__change_password_form->appId}-error" class="alert alert-danger m-0{if $appnetos__change_password_form->renderForm} mb-3{/if}" style="display: none;">
        {$appnetos__change_password_form->ajaxError}
    </div>
{/if}

{* AJAX confirm *}
{if $appnetos__change_password_form->ajaxConfirm}
    <div id="app-{$appnetos__change_password_form->appId}-confirm" class="alert alert-success m-0" style="display: none;">
        {$appnetos__change_password_form->ajaxConfirm}
    </div>
{/if}

{* Form *}
{if $appnetos__change_password_form->renderForm}
    <div id="appnetos__change_password_form__input">
        <div id="app-{$appnetos__change_password_form->appId}-loading" class="py-4 text-center" style="display: none">
            <img class="appnetos__change_password_form__loading" src="{$render->getUrl()}/out/img/appnetos/loading.gif">
        </div>
        <form id="app-{$appnetos__change_password_form->appId}-form">
            <label for="app-{$appnetos__change_password_form->appId}-passOld">
                {$strings->get('appnetos__change_password_form__pass_old')} <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <input id="app-{$appnetos__change_password_form->appId}-passOld" name="passOld" type="password" value="{$appnetos__change_password_form->passOld}" class="form-control" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__change_password_form__pass_old')}">
                <div class="input-group-prepend" onclick="appnetos__change_password_form.sh({$appnetos__change_password_form->appId})">
                    <div class="input-group-text">
                        <img class="appnetos__change_password_form__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                    </div>
                </div>
            </div>
            {if $appnetos__change_password_form->errorPassOld}
                <div>
                    <small class="text-danger">{$appnetos__change_password_form->errorPassOld}</small>
                </div>
            {/if}
            <label class="mt-3" for="app-{$appnetos__change_password_form->appId}-pass">
                {$strings->get('appnetos__change_password_form__pass')} <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <input id="app-{$appnetos__change_password_form->appId}-pass" name="pass" type="password" value="{$appnetos__change_password_form->pass}"  class="form-control" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__change_password_form__pass')}">
                <div class="input-group-prepend" onclick="appnetos__change_password_form.sh({$appnetos__change_password_form->appId})">
                    <div class="input-group-text">
                        <img class="appnetos__change_password_form__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                    </div>
                </div>
            </div>
            {if $appnetos__change_password_form->errorPass}
                <div>
                    <small class="text-danger">{$appnetos__change_password_form->errorPass}</small>
                </div>
            {/if}
            <label class="mt-3" for="app-{$appnetos__change_password_form->appId}-repeat">
                {$strings->get('appnetos__change_password_form__pass_repeat')} <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <input id="app-{$appnetos__change_password_form->appId}-repeat" name="repeat" type="password" value="{$appnetos__change_password_form->repeat}"  class="form-control" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__change_password_form__pass_repeat')}">
                <div class="input-group-prepend" onclick="appnetos__change_password_form.sh({$appnetos__change_password_form->appId})">
                    <div class="input-group-text">
                        <img class="appnetos__change_password_form__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                    </div>
                </div>
            </div>
            {if $appnetos__change_password_form->errorRepeat}
                <div>
                    <small class="text-danger">{$appnetos__change_password_form->errorRepeat}</small>
                </div>
            {/if}
            <div class="mt-4">
                <button type="button" class="btn btn-primary" onclick="appnetos__change_password_form.sm({$appnetos__change_password_form->appId})">
                    {$strings->get('appnetos__change_password_form__change')}
                </button>
            </div>
        </form>
    </div>
{/if}