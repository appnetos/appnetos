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
 * @description     Extended cookie note, with list of all cookies and their use. App admin settings to set kind of used
 *                  cookies and the notifications.
*}

{* Menu *}
{$render->include('application/apps/appnetos/cookie_note/admin/views/cookie_note__menu.tpl')}
<div class="container-sidebar">

    {* Info *}
    {if $admin__info}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 text-justify mt-4">
                    {$strings->get('appnetos__cookie_note__info')}
                </div>
            </div>
        </div>
    {/if}

    {* Settings *}
    <div id="appnetos__cookie_note__settings" class="container">
        {$render->include('application/apps/appnetos/cookie_note/admin/views/cookie_note__settings.tpl')}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="bg-light text-secondary text-justify p-3">
                    {$strings->get('appnetos__cookie_note__license')}
                </div>
            </div>
        </div>
    </div>
    {* Margin *}
    <div class="mt-4"></div>
</div>