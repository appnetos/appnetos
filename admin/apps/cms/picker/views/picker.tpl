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
 * @description     Admin cms picker. Open modal popup to pick an URI ID.
 *                  Open:           "admin__cms__picker.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(URI ID);
 *}

{* Modal URI picker *}
<div class="modal fade" id="admin__cms__picker__modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('admin__cms__picker__header')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>

            {* Search *}
            <div class="modal-header bg-light">
                <div class="form-inline">
                    <div class="form-group mr-2">
                        <select class="form-control" id="admin__cms__picker__search_number" onchange="admin__cms__picker.se(0)">
                            <option value="10" {if $admin__cms__picker__search->number === 10}selected{/if}>10</option>
                            <option value="25" {if $admin__cms__picker__search->number === 25}selected{/if}>25</option>
                            <option value="50" {if $admin__cms__picker__search->number === 50}selected{/if}>50</option>
                            <option value="100" {if $admin__cms__picker__search->number === 100}selected{/if}>100</option>
                            <option value="250" {if $admin__cms__picker__search->number === 250}selected{/if}>250</option>
                            <option value="500" {if $admin__cms__picker__search->number === 500}selected{/if}>500</option>
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <select class="form-control" id="admin__cms__picker__search_order" onchange="admin__cms__picker.se(0)">
                            <option value="xt_uri" {if $admin__cms__picker__search->order === 'xt_uri'}selected{/if}>{$strings->get('admin__cms__picker__uri_up')}</option>
                            <option value="xt_uri DESC" {if $admin__cms__picker__search->order === 'xt_uri DESC'}selected{/if}>{$strings->get('admin__cms__picker__uri_down')}</option>
                        </select>
                    </div>
                    <input id="admin__cms__picker__search_search" class="form-control mr-2" onkeydown="admin__apps__picker.sk(event)" placeholder="{$strings->get('admin__cms__picker__search')}" value="{$admin__cms__picker__search->search}">
                    <button class="btn btn-primary" onclick="admin__cms__picker.se(0)">
                        {$strings->get('admin__cms__picker__search')}
                    </button>
                </div>
            </div>

            {* URI picker URI list *}
            <div class="modal-body">
                <div id="admin__cms__picker__uris_list">
                    {$render->include('admin/apps/cms/picker/views/picker__uris_list.tpl')}
                </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('admin__cms__picker__close')}
                </button>
            </div>
        </div>
    </div>
</div>