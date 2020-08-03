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

{* If apps available *}
{if $admin__apps__management__apps_list->count > 0}

    {* Modal deactivate *}
    <div class="modal fade" id="admin__apps__management__modal_deactivate" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__apps__management__deactivate_header')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__apps__management__deactivate_info')}
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger text-light" onclick="admin__apps__management.ae('deactivate', 0, 0)">
                            {$strings->get('admin__apps__management__deactivate')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__apps__management__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Modal delete *}
    <div class="modal fade" id="admin__apps__management__modal_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__apps__management__delete_header')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__apps__management__delete_info')}
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" onclick="admin__apps__management.ae('delete', 0, 0)">
                            {$strings->get('admin__apps__management__delete')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__apps__management__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Modal remove *}
    <div class="modal fade" id="admin__apps__management__modal_remove" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__apps__management__remove_header')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__apps__management__remove_info')}
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" onclick="admin__apps__management.ae('remove', 0, 0)">
                            {$strings->get('admin__apps__management__remove')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__apps__management__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Modal reset *}
    <div class="modal fade" id="admin__apps__management__modal_reset" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__apps__management__reset_header')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__apps__management__reset_info')}
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" onclick="admin__apps__management.ae('reset', 0, 0)">
                            {$strings->get('admin__apps__management__reset')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__apps__management__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Area *}
    <div class="col-12 d-inline-block">
        {if $admin__apps__management__apps_list->areas > 1}
            {if $admin__apps__management__apps_list->start > 1}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se(1)">
                    &#11207;&#11207;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__search->area - 1})">
                    &#11207;
                </button>
            {/if}
            {for $admin__apps__management__areas = $admin__apps__management__apps_list->start to $admin__apps__management__apps_list->end}
                {if $admin__apps__management__areas === $admin__apps__management__search->area}
                    <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__apps__management.se({$admin__apps__management__areas})">
                        {$admin__apps__management__areas}
                    </button>
                {else}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__areas})">
                        {$admin__apps__management__areas}
                    </button>
                {/if}
            {/for}
            {if $admin__apps__management__apps_list->end < $admin__apps__management__apps_list->areas}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__search->area + 1})">
                    &#11208;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__apps_list->areas})">
                    &#11208;&#11208;
                </button>
            {/if}
        {/if}
        <div class="float-right">
            <button type="button" class="btn{if $admin__apps__management__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__search->area}, 'details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__apps__management__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__search->area}, 'list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

    {* List apps *}
    {foreach from=$admin__apps__management__apps_list->appsList item=$admin__apps__management__app}
        {$admin__apps__management__model->assign('admin__apps__management__app', $admin__apps__management__app)}
        {$render->include('admin/apps/apps/management/views/management__app.tpl')}
    {/foreach}

    {* Area *}
    <div class="col-12 d-inline-block">
        {if $admin__apps__management__apps_list->areas > 1}
            {if $admin__apps__management__apps_list->start > 1}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se(1)">
                    &#11207;&#11207;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__search->area - 1})">
                    &#11207;
                </button>
            {/if}
            {for $admin__apps__management__areas = $admin__apps__management__apps_list->start to $admin__apps__management__apps_list->end}
                {if $admin__apps__management__areas === $admin__apps__management__search->area}
                    <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__apps__management.se({$admin__apps__management__areas})">
                        {$admin__apps__management__areas}
                    </button>
                {else}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__areas})">
                        {$admin__apps__management__areas}
                    </button>
                {/if}
            {/for}
            {if $admin__apps__management__apps_list->end < $admin__apps__management__apps_list->areas}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__search->area + 1})">
                    &#11208;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__apps_list->areas})">
                    &#11208;&#11208;
                </button>
            {/if}
        {/if}
        <div class="float-right">
            <button type="button" class="btn{if $admin__apps__management__search->view === 'details'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__search->area}, 'details')">
                <i class="fas fa-info mx-2"></i>
            </button>
            <button type="button" class="btn{if $admin__apps__management__search->view === 'list'} disabled{else} btn-sm{/if} btn-primary mt-4 text-decoration-none" onclick="admin__apps__management.se({$admin__apps__management__search->area}, 'list')">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>

{* If no entries available *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__apps__management__no_apps')}
        </div>
    </div>

{/if}