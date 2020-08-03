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
 * @description     Admin app overview and app management.
 *}

{* Menu *}
{$render->include('admin/apps/apps/management/views/management__menu.tpl')}

<div class="container-sidebar">

    {* Info *}
    {if $admin__apps__management__model->getInfoAdmin()}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 mt-4 text-justify">
                    {$strings->get('admin__apps__management__info')}
                </div>
            </div>
        </div>
    {/if}

    {* App list *}
    <div class="container">
        <div id="admin__apps__management__apps_list" class="row">
            {$render->include('admin/apps/apps/management/views/management__apps_list.tpl')}
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>