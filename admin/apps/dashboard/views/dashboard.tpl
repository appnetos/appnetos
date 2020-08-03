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

{* Menu *}
{$render->include('admin/apps/dashboard/views/dashboard__menu.tpl')}

<div class="container-sidebar">

    {* Modal add dashboard *}
    {if $admin__dashboard__dashboard__model->part === 'edit'}
        <div class="modal fade" id="admin__dashboard__dashboard__modal_create" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title">
                            {$strings->get('admin__dashboard__dashboard__create_header')}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>
                            {$strings->get('admin__dashboard__dashboard__name')}
                        </label>
                        <input id="admin__dashboard__dashboard__create_name" type="text" class="form-control" value="" placeholder="{$strings->get('admin__dashboard__dashboard__name')}" onkeydown="admin__dashboard__dashboard.ck(event)">
                        <div class="mt-3 text-right">
                            <button type="button" class="btn btn-primary" onclick="admin__dashboard__dashboard.cd();">
                                {$strings->get('admin__dashboard__dashboard__create')}
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {$strings->get('admin__dashboard__dashboard__close')}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Modal remove dashboard *}
    {if $admin__dashboard__dashboard__model->part === 'edit' && $admin__dashboard__dashboard__board->name !== '{home}'}
        <div class="modal fade" id="admin__dashboard__dashboard__modal_remove" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title">
                            {$strings->get('admin__dashboard__dashboard__remove_dashboard')}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-dark">
                            {$strings->get('admin__dashboard__dashboard__remove_dashboard_info')}
                        </div>
                        <div class="mt-3 text-right">
                            <button type="button" class="btn btn-danger" onclick="admin__dashboard__dashboard.ax('removeDashboard', '{$admin__dashboard__dashboard__board->uuid}', null);">
                                {$strings->get('admin__dashboard__dashboard__remove')}
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {$strings->get('admin__dashboard__dashboard__close')}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Modal edit name *}
    {if $admin__dashboard__dashboard__model->part === 'edit' && $admin__dashboard__dashboard__board->name !== '{home}'}
        <div class="modal fade" id="admin__dashboard__dashboard__modal_edit_name" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title">
                            {$strings->get('admin__dashboard__dashboard__edit_name')}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>
                            {$strings->get('admin__dashboard__dashboard__name')}
                        </label>
                        <input id="admin__dashboard__dashboard__edit_name_name" type="text" class="form-control" value="{$admin__dashboard__dashboard__board->name}" placeholder="{$strings->get('admin__dashboard__dashboard__name')}" onkeydown="admin__dashboard__dashboard.ec(event)">
                        <div class="mt-3 text-right">
                            <button type="button" class="btn btn-primary" onclick="admin__dashboard__dashboard.en();">
                                {$strings->get('admin__dashboard__dashboard__edit')}
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {$strings->get('admin__dashboard__dashboard__close')}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Template *}
    <div class="container">
        <div id="admin__dashboard__dashboard__template" class="row">
            {$render->include($admin__dashboard__dashboard__model->template)}
        </div>
    </div>

</div>

{* Margin *}
<div class="mt-4"></div>