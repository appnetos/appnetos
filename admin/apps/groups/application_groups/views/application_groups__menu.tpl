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
 * @description     Application user groups. Groups can be used to define which users can view which areas.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get("admin__groups__application_groups__menu_header")}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__groups__application_groups__navbar" aria-controls="admin__groups__application_groups__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__groups__application_groups__navbar">
        <ul class="navbar-nav mr-auto">

            {* Action Menu *}
            <li class="nav-item">
                <a class="nav-link text-light" href="" data-toggle="modal" data-target="#admin__groups__application_groups__modal_add">
                    <i class="fas fa-plus  fa-menu-size"></i>
                    {$strings->get("admin__groups__application_groups__add_group")}</a>
            </li>

            {* Search *}
            <h6 class="nav-item text-light mt-4">
                {$strings->get("admin__groups__application_groups__search")}
            </h6>
            <li>
                <div class="form-group">
                    <select class="form-control" id="admin__groups__application_groups__search_number" onchange="admin__groups__application_groups.se(0)">
                        <option value="10" {if $admin__groups__application_groups__search->number === 10}selected{/if}>10</option>
                        <option value="25" {if $admin__groups__application_groups__search->number === 25}selected{/if}>25</option>
                        <option value="50" {if $admin__groups__application_groups__search->number === 50}selected{/if}>50</option>
                        <option value="100" {if $admin__groups__application_groups__search->number === 100}selected{/if}>100</option>
                        <option value="250" {if $admin__groups__application_groups__search->number === 250}selected{/if}>250</option>
                        <option value="500" {if $admin__groups__application_groups__search->number === 500}selected{/if}>500</option>
                    </select>
                </div>
            </li>
            <li>
                <div class="form-group">
                    <select class="form-control" id="admin__groups__application_groups__search_order" onchange="admin__groups__application_groups.se(0)">
                        <option value="xt_id" {if $admin__groups__application_groups__search->order === "xt_id"}selected{/if}>{$strings->get("admin__groups__application_groups__id_up")}</option>
                        <option value="xt_id DESC" {if $admin__groups__application_groups__search->order === "xt_id DESC"}selected{/if}>{$strings->get("admin__groups__application_groups__id_down")}</option>
                        <option value="xt_name" {if $admin__groups__application_groups__search->order === "xt_name"}selected{/if}>{$strings->get("admin__groups__application_groups__name_up")}</option>
                        <option value="xt_name DESC" {if $admin__groups__application_groups__search->order === "xt_name DESC"}selected{/if}>{$strings->get("admin__groups__application_groups__name_down")}</option>
                    </select>
                </div>
            </li>
            <li>
                <input id="admin__groups__application_groups__search_search" class="form-control mr-sm-2" onkeydown="admin__groups__application_groups.sk(event)" placeholder="{$strings->get("admin__groups__application_groups__search")}" value="{$admin__groups__application_groups__search->search}">
                <button class="btn btn-primary" onclick="admin__groups__application_groups.se(0)">
                    {$strings->get('admin__groups__application_groups__search')}
                </button>
            </li>

        </ul>
    </div>
</nav>