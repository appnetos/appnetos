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
 * @description     Admin application to manage static bottom apps.
 *}

{* AJAX error *}
{if $admin__apps__static_bottom__model->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__apps__static_bottom__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__apps__static_bottom__model->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__apps__static_bottom__model->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__apps__static_bottom__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__apps__static_bottom__model->ajaxConfirm}
        </div>
    </div>
{/if}

{* If apps available *}
{if $admin__apps__static_bottom__apps_list->appsList|count > 0}

    {* View *}
    <div class="col-12">
        <div class="text-right">
            <button type="button" class="btn{if $admin__apps__static_bottom__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__apps__static_bottom.se('details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__apps__static_bottom__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__apps__static_bottom.se('list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

    {* List apps *}
    {foreach from=$admin__apps__static_bottom__apps_list->appsList item=$admin__apps__static_bottom__app}
        {$admin__apps__static_bottom__model->assign('admin__apps__static_bottom__app', $admin__apps__static_bottom__app)}
        {$render->include('admin/apps/apps/static_bottom/views/static_bottom__app.tpl')}
    {/foreach}

    {* View *}
    <div class="col-12">
        <div class="text-right">
            <button type="button" class="btn{if $admin__apps__static_bottom__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__apps__static_bottom.se('details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__apps__static_bottom__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__apps__static_bottom.se('list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

{* If no entries available *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__apps__static_bottom__no_apps')}
        </div>
    </div>

{/if}