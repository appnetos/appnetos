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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get('admin__apps__management__menu_header')}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__apps__management__navbar" aria-controls="admin__apps__management__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__apps__management__navbar">
        <ul class="navbar-nav mr-auto">

            {* Search *}
            <h6 class="nav-item text-light mt-4">
                {$strings->get('admin__apps__management__search')}
            </h6>
            <li>
                <div class="form-group">
                    <select class="form-control" id="admin__apps__management__search_number" onchange="admin__apps__management.se(0)">
                        <option value="10" {if $admin__apps__management__search->number === 10}selected{/if}>10</option>
                        <option value="25" {if $admin__apps__management__search->number === 25}selected{/if}>25</option>
                        <option value="50" {if $admin__apps__management__search->number === 50}selected{/if}>50</option>
                        <option value="100" {if $admin__apps__management__search->number === 100}selected{/if}>100</option>
                        <option value="250" {if $admin__apps__management__search->number === 250}selected{/if}>250</option>
                        <option value="500" {if $admin__apps__management__search->number === 500}selected{/if}>500</option>
                    </select>
                </div>
            </li>
            <li>
                <div class="form-group">
                    <select class="form-control" id="admin__apps__management__search_order" onchange="admin__apps__management.se(0)">
                        <option value="xt_id" {if $admin__apps__management__search->order === 'xt_id'}selected{/if}>{$strings->get('admin__apps__management__id_up')}</option>
                        <option value="xt_id DESC" {if $admin__apps__management__search->order === 'xt_id DESC'}selected{/if}>{$strings->get('admin__apps__management__id_down')}</option>
                        <option value="xt_name" {if $admin__apps__management__search->order === 'xt_name'}selected{/if}>{$strings->get('admin__apps__management__name_up')}</option>
                        <option value="xt_name DESC" {if $admin__apps__management__search->order === 'xt_name DESC'}selected{/if}>{$strings->get('admin__apps__management__name_down')}</option>
                        <option value="xt_description" {if $admin__apps__management__search->order === 'xt_description'}selected{/if}>{$strings->get('admin__apps__management__description_up')}</option>
                        <option value="xt_description DESC" {if $admin__apps__management__search->order === 'xt_description DESC'}selected{/if}>{$strings->get('admin__apps__management__description_down')}</option>
                    </select>
                </div>
            </li>
            <li>
                <input id="admin__apps__management__search_search" class="form-control" onkeydown="admin__apps__management.sk(event)" placeholder="{$strings->get('admin__apps__management__search')}" value="{$admin__apps__management__search->search}">
                <button class="btn btn-primary" onclick="admin__apps__management.se(0)">
                    {$strings->get('admin__apps__management__search')}
                </button>
            </li>

        </ul>
    </div>
</nav>