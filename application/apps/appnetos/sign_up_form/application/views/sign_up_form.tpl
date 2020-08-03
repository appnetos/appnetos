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

{* Sign up form *}
{if !$appnetos__sign_up_form->error && !$appnetos__sign_up_form->confirm}
    <div id="app-{$appnetos__sign_up_form->appId}">
        {$render->include('application/apps/appnetos/sign_up_form/application/views/sign_up_form__form.tpl')}
    </div>

{* Error message *}
{elseif $appnetos__sign_up_form->error}
    <div id="app-{$appnetos__sign_up_form->appId}" class="alert alert-danger m-0">
        {$appnetos__sign_up_form->error}
    </div>

{* Confirm message *}
{elseif $appnetos__sign_up_form->confirm}
    <div id="app-{$appnetos__sign_up_form->appId}" class="alert alert-success m-0">
        {$appnetos__sign_up_form->confirm}
    </div>

{/if}