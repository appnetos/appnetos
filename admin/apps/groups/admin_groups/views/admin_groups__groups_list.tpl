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
 * @description     Admin user groups. Groups can be used to define which administrators can view which areas.
 *}

{* AJAX error *}
{if $admin__groups__admin_groups__groups_list->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__groups__admin_groups__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__groups__admin_groups__groups_list->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__groups__admin_groups__groups_list->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__groups__admin_groups__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__groups__admin_groups__groups_list->ajaxConfirm}
        </div>
    </div>
{/if}

{* If groups available *}
{if $admin__groups__admin_groups__groups_list->count > 0}

    {* Modal delete *}
    <div class="modal fade" id="admin__groups__admin_groups__modal_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get("admin__groups__admin_groups__delete_header")}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get("admin__groups__admin_groups__delete_info")}
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" onclick="admin__groups__admin_groups.de()">
                            {$strings->get("admin__groups__admin_groups__delete")}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get("admin__groups__admin_groups__close")}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Area *}
    <div class="col-12 d-inline-block">
        {if $admin__groups__admin_groups__groups_list->areas > 1}
            {if $admin__groups__admin_groups__groups_list->start > 1}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se(1)">
                    &#11207;&#11207;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__search->area - 1})">
                    &#11207;
                </button>
            {/if}
            {for $admin__groups__admin_groups__areas = $admin__groups__admin_groups__groups_list->start to $admin__groups__admin_groups__groups_list->end}
                {if $admin__groups__admin_groups__areas === $admin__groups__admin_groups__search->area}
                    <button type="button" class="btn btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__areas})">
                        {$admin__groups__admin_groups__areas}
                    </button>
                {else}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__areas})">
                        {$admin__groups__admin_groups__areas}
                    </button>
                {/if}
            {/for}
            {if $admin__groups__admin_groups__groups_list->end < $admin__groups__admin_groups__groups_list->areas}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__search->area + 1})">
                    &#11208;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__groups_list->areas})">
                    &#11208;&#11208;
                </button>
            {/if}
        {/if}
        <div class="float-right">
            <button type="button" class="btn{if $admin__groups__admin_groups__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__search->area}, 'details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__groups__admin_groups__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__search->area}, 'list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

    {* List groups *}
    {foreach from=$admin__groups__admin_groups__groups_list->groupsList item=$admin__groups__admin_groups__group}
        {$admin__groups__admin_groups__model->assign('admin__groups__admin_groups__group', $admin__groups__admin_groups__group)}
        {$render->include('admin/apps/groups/admin_groups/views/admin_groups__group.tpl')}
    {/foreach}

    {* Area *}
    <div class="col-12 d-inline-block">
        {if $admin__groups__admin_groups__groups_list->areas > 1}
            {if $admin__groups__admin_groups__groups_list->start > 1}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se(1)">
                    &#11207;&#11207;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__search->area - 1})">
                    &#11207;
                </button>
            {/if}
            {for $admin__groups__admin_groups__areas = $admin__groups__admin_groups__groups_list->start to $admin__groups__admin_groups__groups_list->end}
                {if $admin__groups__admin_groups__areas === $admin__groups__admin_groups__search->area}
                    <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__areas})">
                        {$admin__groups__admin_groups__areas}
                    </button>
                {else}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__areas})">
                        {$admin__groups__admin_groups__areas}
                    </button>
                {/if}
            {/for}
            {if $admin__groups__admin_groups__groups_list->end < $admin__groups__admin_groups__groups_list->areas}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__search->area + 1})">
                    &#11208;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__groups_list->areas})">
                    &#11208;&#11208;
                </button>
            {/if}
        {/if}
        <div class="float-right">
            <button type="button" class="btn{if $admin__groups__admin_groups__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__search->area}, 'details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__groups__admin_groups__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__groups__admin_groups.se({$admin__groups__admin_groups__search->area}, 'list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

{* If no entries available *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__groups__admin_groups__no_groups')}
        </div>
    </div>

{/if}