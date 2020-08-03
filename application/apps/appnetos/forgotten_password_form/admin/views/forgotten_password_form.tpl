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

{* Menu *}
{$render->include('application/apps/appnetos/forgotten_password_form/admin/views/menu.tpl')}
<div class="container-sidebar">

    {* Info *}
    {if $admin__info}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 text-justify mt-4">
                    {$strings->get('appnetos__forgotten_password_form__info')}
                </div>
            </div>
        </div>
    {/if}

    {* Settings *}
    <div id="appnetos__forgotten_password_form__settings" class="container">
        {$render->include('application/apps/appnetos/forgotten_password_form/admin/views/settings.tpl')}
    </div>
</div>