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

{* Contact Form *}
{if !$appnetos__contact_form->error}
    <div id="app-{$appnetos__contact_form->appId}">
        {$render->include('application/apps/appnetos/contact_form/application/views/contact_form__form.tpl')}
    </div>

{* If is error *}
{else}
    <div id="app-{$appnetos__contact_form->appId}" class="alert alert-danger m-0">
        {$appnetos__contact_form->error}
    </div>
{/if}