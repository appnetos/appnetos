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
 * @description     Admin app picker. Open modal popup to pick an app ID.
 *                  Open:           "admin__apps__picker.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(APP ID);
*}

{* Picker modal *}
<div class="modal fade" id="admin__apps__picker__modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            {* Header *}
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('admin__apps__picker__header')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>

            {* Search *}
            <div class="modal-header bg-light">
                <div class="form-inline">
                    <div class="form-group mr-2">
                        <select class="form-control" id="admin__apps__picker__search_number" onchange="admin__apps__picker.se(0)">
                            <option value="10" {if $admin__apps__picker__search->number === 10}selected{/if}>10</option>
                            <option value="25" {if $admin__apps__picker__search->number === 25}selected{/if}>25</option>
                            <option value="50" {if $admin__apps__picker__search->number === 50}selected{/if}>50</option>
                            <option value="100" {if $admin__apps__picker__search->number === 100}selected{/if}>100</option>
                            <option value="250" {if $admin__apps__picker__search->number === 250}selected{/if}>250</option>
                            <option value="500" {if $admin__apps__picker__search->number === 500}selected{/if}>500</option>
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <select class="form-control" id="admin__apps__picker__search_order" onchange="admin__apps__picker.se(0)">
                            <option value="xt_id" {if $admin__apps__picker__search->order === 'xt_id'}selected{/if}>{$strings->get('admin__apps__picker__id_up')}</option>
                            <option value="xt_id DESC" {if $admin__apps__picker__search->order === 'xt_id DESC'}selected{/if}>{$strings->get('admin__apps__picker__id_down')}</option>
                            <option value="xt_name" {if $admin__apps__picker__search->order === 'xt_name'}selected{/if}>{$strings->get('admin__apps__picker__name_up')}</option>
                            <option value="xt_name DESC" {if $admin__apps__picker__search->order === 'xt_name DESC'}selected{/if}>{$strings->get('admin__apps__picker__name_down')}</option>
                            <option value="xt_description" {if $admin__apps__picker__search->order === 'xt_description'}selected{/if}>{$strings->get('admin__apps__picker__description_up')}</option>
                            <option value="xt_description DESC" {if $admin__apps__picker__search->order === 'xt_description DESC'}selected{/if}>{$strings->get('admin__apps__picker__description_down')}</option>
                        </select>
                    </div>
                    <input id="admin__apps__picker__search_search" class="form-control" onkeydown="admin__apps__picker.sk(event)" placeholder="{$strings->get('admin__apps__picker__search')}" value="{$admin__apps__picker__search->search}">
                    <button class="btn btn-primary" onclick="admin__apps__picker.se(0)">
                        {$strings->get('admin__apps__picker__search')}
                    </button>
                </div>
            </div>

            {* Apps list *}
            <div class="modal-body">
                <div id="admin__apps__picker__apps_list">
                    {$render->include('admin/apps/apps/picker/views/picker__apps_list.tpl')}
                </div>
            </div>

            {* Close *}
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('admin__apps__picker__close')}
                </button>
            </div>

        </div>
    </div>
</div>