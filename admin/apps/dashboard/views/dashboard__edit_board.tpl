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
 * @description     Admin start page and dashboards.
 *}

{* Info *}
{if $admin__dashboard__dashboard__model->getInfoAdmin()}
    <div class="col-12 mt-4 text-justify info-hide">
        {$strings->get('admin__dashboard__dashboard__info')}
    </div>
    {/if}

{* AJAX error *}
{if $admin__dashboard__dashboard__boards_list->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__dashboard__dashboard__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__dashboard__dashboard__boards_list->ajaxError}
        </div>
    </div>
    {/if}

{* AJAX confirm *}
{if $admin__dashboard__dashboard__boards_list->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__dashboard__dashboard__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__dashboard__dashboard__boards_list->ajaxConfirm}
        </div>
    </div>
    {/if}

{* If dashboards available *}
{if $admin__dashboard__dashboard__board->appsList|count > 0}

    {* List URIs *}
    {foreach from=$admin__dashboard__dashboard__board->getApps()|@array_reverse item=$admin__dashboard__dashboard__app}
        {$admin__dashboard__dashboard__model->assign('admin__dashboard__dashboard__app', $admin__dashboard__dashboard__app)}
        {$render->include('admin/apps/dashboard/views/dashboard__edit_board_app.tpl')}
    {/foreach}

{* If no entries available *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__dashboard__dashboard__no_widgets')}
        </div>
    </div>

{/if}