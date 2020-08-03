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
 * @description     Admin URI apps management.
 *}

{* URI *}
{$render->include('admin/apps/cms/manage_apps/views/manage_apps__uri.tpl')}

{* AJAX error *}
{if $admin__cms__manage_apps__apps_list->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__manage_apps__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__cms__manage_apps__apps_list->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__cms__manage_apps__apps_list->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__manage_apps__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__cms__manage_apps__apps_list->ajaxConfirm}
        </div>
    </div>
{/if}

{* List apps *}
{if $admin__cms__manage_apps__apps_list->appsList|count > 0}

    <div class="col-12 mt-4">
        <h4 class="ml-4 mt-0 mr-0 mb-0">
            {$strings->get('admin__cms__manage_apps__apps')}
        </h4>
    </div>

    {* View *}
    <div class="col-12">
        <div class="text-right">
            <button type="button" class="btn{if $admin__cms__manage_apps__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__cms__manage_apps.se('details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__cms__manage_apps__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__cms__manage_apps.se('list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

    {* List apps *}
    {foreach from=$admin__cms__manage_apps__apps_list->appsList item=$admin__cms__manage_apps__app}
        {$admin__cms__manage_apps__model->assign('admin__cms__manage_apps__app', $admin__cms__manage_apps__app)}
        {$render->include('admin/apps/cms/manage_apps/views/manage_apps__app.tpl')}
    {/foreach}

    {* View *}
    <div class="col-12">
        <div class="text-right">
            <button type="button" class="btn{if $admin__cms__manage_apps__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__cms__manage_apps.se('details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__cms__manage_apps__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__cms__manage_apps.se('list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

{* If no app available *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__cms__manage_apps__no_apps')}
        </div>
    </div>

{/if}