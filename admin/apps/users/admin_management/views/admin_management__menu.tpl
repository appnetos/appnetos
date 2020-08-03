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
 * @description     Admin overview and management for admin users.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get("admin__users__admin_management__menu_header")}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__users__admin_management__navbar" aria-controls="admin__users__admin_management__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__users__admin_management__navbar">
        <ul class="navbar-nav mr-auto">

            {* Action Menu *}
            <li class="nav-item">
                <a class="nav-link text-light" href="" data-toggle="modal" data-target="#admin__users__admin_management__modal_add">
                    <i class="fas fa-plus  fa-menu-size"></i>
                    {$strings->get("admin__users__admin_management__add_user")}</a>
            </li>

            {* Search *}
            <h6 class="nav-item text-light mt-4">
                {$strings->get("admin__users__admin_management__search")}
            </h6>
            <li>
                <div class="form-group">
                    <select class="form-control" id="admin__users__admin_management__search_number" onchange="admin__users__admin_management.se(0)">
                        <option value="10" {if $admin__users__admin_management__search->number === 10}selected{/if}>10</option>
                        <option value="25" {if $admin__users__admin_management__search->number === 25}selected{/if}>25</option>
                        <option value="50" {if $admin__users__admin_management__search->number === 50}selected{/if}>50</option>
                        <option value="100" {if $admin__users__admin_management__search->number === 100}selected{/if}>100</option>
                        <option value="250" {if $admin__users__admin_management__search->number === 250}selected{/if}>250</option>
                        <option value="500" {if $admin__users__admin_management__search->number === 500}selected{/if}>500</option>
                    </select>
                </div>
            </li>
            <li>
                <div class="form-group">
                    <select class="form-control" id="admin__users__admin_management__search_selection" onchange="admin__users__admin_management.se(0)">
                        <option value="active" {if $admin__users__admin_management__search->selection === "active"}selected{/if}>{$strings->get("admin__users__admin_management__search_active")}</option>
                        <option value="unactive" {if $admin__users__admin_management__search->selection === "unactive"}selected{/if}>{$strings->get("admin__users__admin_management__search_unactive")}</option>
                        <option value="all" {if $admin__users__admin_management__search->selection === "all"}selected{/if}>{$strings->get("admin__users__admin_management__search_all")}</option>
                    </select>
                </div>
            </li>
            <li>
                <div class="form-group">
                    <select class="form-control" id="admin__users__admin_management__search_order" onchange="admin__users__admin_management.se(0)">
                        <option value="xt_id" {if $admin__users__admin_management__search->order === "xt_id"}selected{/if}>{$strings->get("admin__users__admin_management__id_up")}</option>
                        <option value="xt_id DESC" {if $admin__users__admin_management__search->order === "xt_id DESC"}selected{/if}>{$strings->get("admin__users__admin_management__id_down")}</option>
                        <option value="xt_name" {if $admin__users__admin_management__search->order === "xt_user"}selected{/if}>{$strings->get("admin__users__admin_management_username_up")}</option>
                        <option value="xt_name DESC" {if $admin__users__admin_management__search->order === "xt_user DESC"}selected{/if}>{$strings->get("admin__users__admin_management_username_down")}</option>
                        <option value="xt_description" {if $admin__users__admin_management__search->order === "xt_mail"}selected{/if}>{$strings->get("admin__users__admin_management__mail_up")}</option>
                        <option value="xt_description DESC" {if $admin__users__admin_management__search->order === "xt_mail DESC"}selected{/if}>{$strings->get("admin__users__admin_management__mail_down")}</option>
                        <option value="xt_description" {if $admin__users__admin_management__search->order === "xt_ts_first"}selected{/if}>{$strings->get("admin__users__admin_management__ts_first_up")}</option>
                        <option value="xt_description DESC" {if $admin__users__admin_management__search->order === "xt_ts_first DESC"}selected{/if}>{$strings->get("admin__users__admin_management__ts_first_down")}</option>
                    </select>
                </div>
            </li>
            <li>
                <input id="admin__users__admin_management__search_search" class="form-control mr-sm-2" onkeydown="admin__users__admin_management.sk(event)" placeholder="{$strings->get("admin__users__admin_management__search")}" value="{$admin__users__admin_management__search->search}">
                <button class="btn btn-primary" onclick="admin__users__admin_management.se(0)">
                    {$strings->get('admin__users__admin_management__search')}
                </button>
            </li>

        </ul>
    </div>
</nav>