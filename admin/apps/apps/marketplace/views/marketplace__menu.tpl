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
 * @description     APPNET OS Marketplace.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get('admin__apps__marketplace__menu_header')}
    </div>
    {if !$admin__apps__marketplace__model->error}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__apps__marketplace__navbar" aria-controls="admin__apps__marketplace__navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="admin__apps__marketplace__navbar">
            <ul class="navbar-nav mr-auto">

                {* Menu user *}
                <div id="admin__apps__marketplace__menu_user">
                    {$render->include('admin/apps/apps/marketplace/views/marketplace__menu_user.tpl')}
                </div>

                {* Search *}
                {if $admin__apps__marketplace__model->section === 'marketplace__apps_list'}
                    <h6 class="nav-item text-light mt-4">
                        {$strings->get('admin__apps__marketplace__search')}
                    </h6>
                    <li>
                        <div class="form-group">
                            <select class="form-control" id="admin__apps__marketplace__search_category" onchange="admin__apps__marketplace.se(0)">
                                <option value="0" {if $admin__apps__marketplace__search->category === 0}selected{/if}>{$strings->get('admin__apps__marketplace__all_categories')}</option>
                                {assign var='admin__apps__marketplace__categories__categories' value=$admin__apps__marketplace__categories->categories}
                                {foreach from=$admin__apps__marketplace__categories__categories item='admin__apps__marketplace__categories__category'}
                                    <option value="{$admin__apps__marketplace__categories__category.category_id}" {if $admin__apps__marketplace__search->category == $admin__apps__marketplace__categories__category.category_id}selected{/if}>{$admin__apps__marketplace__categories__category.name}</option>
                                    {assign var='admin__apps__marketplace__categories__childrens' value=$admin__apps__marketplace__categories__category.children}
                                    {foreach from=$admin__apps__marketplace__categories__childrens item='admin__apps__marketplace__categories__children'}
                                        <option value="{$admin__apps__marketplace__categories__children.category_id}" {if $admin__apps__marketplace__search->category == $admin__apps__marketplace__categories__children.category_id}selected{/if}>&nbsp;-&nbsp;{$admin__apps__marketplace__categories__children.name}</option>
                                    {/foreach}
                                {/foreach}
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <select class="form-control" id="admin__apps__marketplace__search_order" onchange="admin__apps__marketplace.se(0)">
                                <option value="p.sort_order ASC" {if $admin__apps__marketplace__search->order === 'p.sort_order ASC'}selected{/if}>{$strings->get('admin__apps__marketplace__default')}</option>
                                <option value="pd.name ASC" {if $admin__apps__marketplace__search->order === 'pd.name ASC'}selected{/if}>{$strings->get('admin__apps__marketplace__name_up')}</option>
                                <option value="pd.name DESC" {if $admin__apps__marketplace__search->order === 'pd.name DESC'}selected{/if}>{$strings->get('admin__apps__marketplace__name_down')}</option>
                                <option value="p.price ASC" {if $admin__apps__marketplace__search->order === 'p.price ASC'}selected{/if}>{$strings->get('admin__apps__marketplace__price_up')}</option>
                                <option value="p.price DESC" {if $admin__apps__marketplace__search->order === 'p.price DESC'}selected{/if}>{$strings->get('admin__apps__marketplace__price_down')}</option>
                                <option value="rating DESC" {if $admin__apps__marketplace__search->order === 'rating DESC'}selected{/if}>{$strings->get('admin__apps__marketplace__rating_down')}</option>
                                <option value="rating ASC" {if $admin__apps__marketplace__search->order === 'rating ASC'}selected{/if}>{$strings->get('admin__apps__marketplace__rating_up')}</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <select class="form-control" id="admin__apps__marketplace__search_number" onchange="admin__apps__marketplace.se(0)">
                                <option value="10" {if $admin__apps__marketplace__search->number === 10}selected{/if}>10</option>
                                <option value="25" {if $admin__apps__marketplace__search->number === 25}selected{/if}>25</option>
                                <option value="50" {if $admin__apps__marketplace__search->number === 50}selected{/if}>50</option>
                                <option value="50" {if $admin__apps__marketplace__search->number === 75}selected{/if}>75</option>
                                <option value="50" {if $admin__apps__marketplace__search->number === 100}selected{/if}>100</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <input id="admin__apps__marketplace__search_search" class="form-control" onkeydown="admin__apps__marketplace.sk(event)" placeholder="{$strings->get('admin__apps__marketplace__search')}" value="{$admin__apps__marketplace__search->search}">
                        <button class="btn btn-primary" onclick="admin__apps__marketplace.se(0)">
                            {$strings->get('admin__apps__marketplace__search')}
                        </button>
                    </li>
                {/if}

            </ul>
        </div>
    {/if}
</nav>