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
 * @description     Simple contact form to sending contact request by using APPNET OS mailer.
*}

{* AJAX error *}
{if $appnetos__contact_form->ajaxError}
    <div id="app-{$appnetos__contact_form->appId}-error" class="alert alert-danger m-0{if $appnetos__contact_form->renderForm} mb-3{/if}" style="display: none;">
        {$appnetos__contact_form->ajaxError}
    </div>
{/if}

{* AJAX confirm *}
{if $appnetos__contact_form->ajaxConfirm}
    <div id="app-{$appnetos__contact_form->appId}-confirm" class="alert alert-success m-0" style="display: none;">
        {$appnetos__contact_form->ajaxConfirm}
    </div>
{/if}

{* Form *}
{if $appnetos__contact_form->renderForm}
    <div id="app-{$appnetos__contact_form->appId}-input">
        <div id="app-{$appnetos__contact_form->appId}-loading" class="col-12 py-4 text-center" style="display: none">
            <img class="appnetos__contact_form__loading" src="{$render->getUrl()}/out/img/appnetos/loading.gif">
        </div>
        <form id="app-{$appnetos__contact_form->appId}-form">
            <input type="hidden" name="mid" value="{$appnetos__contact_form->getMailerId()}" style="display: none">
            <div class="form-group">
                <label for="app-{$appnetos__contact_form->appId}-name">
                    {$strings->get('appnetos__contact_form__name')} <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" name="name" value="{$appnetos__contact_form->name}" placeholder="{$strings->get('appnetos__contact_form__name')}">
                {if $appnetos__contact_form->errorName }
                    <small class="text-danger">{$appnetos__contact_form->errorName}</small>
                {/if}
            </div>
            <div class="form-group">
                <label for="app-{$appnetos__contact_form->appId}-address">
                    {$strings->get('appnetos__contact_form__address')} <span class="text-danger">*</span>
                </label>
                <input type="email" class="form-control" value="{$appnetos__contact_form->address}" name="address" aria-describedby="emailHelp" placeholder="{$strings->get('appnetos__contact_form__address')}">
                {if $appnetos__contact_form->errorAddress }
                    <small class="text-danger">{$appnetos__contact_form->errorAddress}</small>
                {/if}
            </div>
            <div class="form-group">
                <label for="app-{$appnetos__contact_form->appId}-message">
                    {$strings->get('appnetos__contact_form__message')} <span class="text-danger">*</span>
                </label>
                <textarea class="form-control" name="message" rows="10">{$appnetos__contact_form->message}</textarea>
                {if $appnetos__contact_form->errorMessage }
                    <small class="text-danger">{$appnetos__contact_form->errorMessage}</small>
                {/if}
            </div>
            <div>
                <button type="button" class="btn btn-primary" onclick="appnetos__contact_form.su({$appnetos__contact_form->appId})">
                    {$strings->get('appnetos__contact_form__submit')}
                </button>
            </div>
        </form>
    </div>
{/if}