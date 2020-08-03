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
 * @description     Admin URI management to add and delete URIs.
 *}

{* AJAX error *}
{if $admin__cms__uri_management__uris_list->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__uri_management__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__cms__uri_management__uris_list->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__cms__uri_management__uris_list->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__uri_management__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__cms__uri_management__uris_list->ajaxConfirm}
        </div>
    </div>
{/if}

{* If uris available *}
{if $admin__cms__uri_management__uris_list->count > 0}

    {* Modal delete *}
    <div class="modal fade" id="admin__cms__uri_management__modal_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__cms__uri_management__delete_header')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__cms__uri_management__delete_info')}
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" onclick="admin__cms__uri_management.ae('delete', 0, 0)">
                            {$strings->get('admin__cms__uri_management__delete')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__cms__uri_management__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Area *}
    <div class="col-12 d-inline-block">
        {if $admin__cms__uri_management__uris_list->areas > 1}
            {if $admin__cms__uri_management__uris_list->start > 1}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se(1)">
                    &#11207;&#11207;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__search->area - 1})">
                    &#11207;
                </button>
            {/if}
            {for $admin__cms__uri_management__areas = $admin__cms__uri_management__uris_list->start to $admin__cms__uri_management__uris_list->end}
                {if $admin__cms__uri_management__areas === $admin__cms__uri_management__search->area}
                    <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__areas})">
                        {$admin__cms__uri_management__areas}
                    </button>
                {else}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__areas})">
                        {$admin__cms__uri_management__areas}
                    </button>
                {/if}
            {/for}
            {if $admin__cms__uri_management__uris_list->end < $admin__cms__uri_management__uris_list->areas}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__search->area + 1})">
                    &#11208;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__uris_list->areas})">
                    &#11208;&#11208;
                </button>
            {/if}
        {/if}
        <div class="float-right">
            <button type="button" class="btn{if $admin__cms__uri_management__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__search->area}, 'details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__cms__uri_management__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__search->area}, 'list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

    {* List URIs *}
    {foreach from=$admin__cms__uri_management__uris_list->urisList item=$admin__cms__uri_management__uri}
        {$admin__cms__uri_management__model->assign('admin__cms__uri_management__uri', $admin__cms__uri_management__uri)}
        {$render->include('admin/apps/cms/uri_management/views/uri_management__uri.tpl')}
    {/foreach}

    {* Area *}
    <div class="col-12 d-inline-block">
        {if $admin__cms__uri_management__uris_list->areas > 1}
            {if $admin__cms__uri_management__uris_list->start > 1}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se(1)">
                    &#11207;&#11207;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__search->area - 1})">
                    &#11207;
                </button>
            {/if}
            {for $admin__cms__uri_management__areas = $admin__cms__uri_management__uris_list->start to $admin__cms__uri_management__uris_list->end}
                {if $admin__cms__uri_management__areas === $admin__cms__uri_management__search->area}
                    <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__areas})">
                        {$admin__cms__uri_management__areas}
                    </button>
                {else}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__areas})">
                        {$admin__cms__uri_management__areas}
                    </button>
                {/if}
            {/for}
            {if $admin__cms__uri_management__uris_list->end < $admin__cms__uri_management__uris_list->areas}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__search->area + 1})">
                    &#11208;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__uris_list->areas})">
                    &#11208;&#11208;
                </button>
            {/if}
        {/if}
        <div class="float-right">
            <button type="button" class="btn{if $admin__cms__uri_management__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__search->area}, 'details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__cms__uri_management__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__cms__uri_management.se({$admin__cms__uri_management__search->area}, 'list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

{* If no entries available *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__cms__uri_management__no_uris')}
        </div>
    </div>

{/if}