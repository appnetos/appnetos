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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {if $admin__dashboard__dashboard__board->name === '{home}'}
            {$strings->get('admin__dashboard__dashboard__home')}
        {else}
            {$admin__dashboard__dashboard__board->name}
        {/if}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__dashboard__dashboard__navbar" aria-controls="admin__dashboard__dashboard__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__dashboard__dashboard__navbar">
        <ul class="navbar-nav mr-auto">

            {* Dashboards *}
            {foreach from=$admin__dashboard__dashboard__boards_list->boardsList item='admin__dashboard__dashboard__dashboards_list_board'}
                <li>

                    {* Home Dashboard *}
                    {if $admin__dashboard__dashboard__dashboards_list_board->name === '{home}'}
                        {if $admin__dashboard__dashboard__board->uuid === $admin__dashboard__dashboard__dashboards_list_board->uuid && $admin__dashboard__dashboard__model->part !== 'edit'}
                            <div class="nav-link active">
                                {$strings->get('admin__dashboard__dashboard__home')}
                            </div>
                        {else}
                            <a class="nav-link" href="{$render->getUrl(1)}">
                                {$strings->get('admin__dashboard__dashboard__home')}
                            </a>
                        {/if}

                    {* Custom Dashboard *}
                    {else}
                        {if $admin__dashboard__dashboard__board->uuid === $admin__dashboard__dashboard__dashboards_list_board->uuid && $admin__dashboard__dashboard__model->part !== 'edit'}
                            <div class="nav-link active">
                                {$admin__dashboard__dashboard__dashboards_list_board->name}
                            </div>
                        {else}
                            <a class="nav-link" href="{$render->getUrl(1)}/{$admin__dashboard__dashboard__dashboards_list_board->uuid}">
                                {$admin__dashboard__dashboard__dashboards_list_board->name}
                            </a>
                        {/if}
                    {/if}
                </li>
            {/foreach}

            {* Actions *}
            {if $admin__dashboard__dashboard__model->part === 'dashboard'}
                {if $render->getUrl(2)}
                    <li class="nav-item mt-4">
                        <a class="nav-link text-light" href="{$render->getUrl(2)}/{$admin__dashboard__dashboard__board->uuid}">
                            <i class="fas fa-edit  fa-menu-size"></i>
                            {$strings->get('admin__dashboard__dashboard__edit')}
                        </a>
                    </li>
                {/if}
            {else}
                <li class="nav-item mt-4">
                    <a class="nav-link text-light" href="" onclick="admin__dashboard__dashboard.aw(event)">
                        <i class="fas fa-plus  fa-menu-size"></i>
                        {$strings->get('admin__dashboard__dashboard__add')}
                    </a>
                </li>
                {if $admin__dashboard__dashboard__board->name !== '{home}'}
                    <li class="nav-item">
                        <a class="nav-link text-light" href="" data-toggle="modal" data-target="#admin__dashboard__dashboard__modal_edit_name">
                            <i class="fas fa-edit  fa-menu-size"></i>
                            {$strings->get('admin__dashboard__dashboard__edit_name')}
                        </a>
                    </li>
                {/if}
                {if $admin__dashboard__dashboard__board->name !== '{home}'}
                    <li class="nav-item">
                        <a class="nav-link text-light" href="" data-toggle="modal" data-target="#admin__dashboard__dashboard__modal_remove">
                            <i class="fas fa-trash  fa-menu-size"></i>
                            {$strings->get('admin__dashboard__dashboard__remove_dashboard')}
                        </a>
                    </li>
                {/if}
                <li class="nav-item mt-4">
                    <a class="nav-link text-light" href="" data-toggle="modal" data-target="#admin__dashboard__dashboard__modal_create">
                        <i class="fas fa-plus  fa-menu-size"></i>
                        {$strings->get('admin__dashboard__dashboard__create')}
                    </a>
                </li>
            {/if}

        </ul>
    </div>
</nav>