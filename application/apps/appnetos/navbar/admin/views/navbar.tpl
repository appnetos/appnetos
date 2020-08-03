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
 * @description     Multilingual Navbar to create extended navigation menus on base of bootstrap Navbar.
 *}

{* Modal settings *}
<div class="modal fade" id="appnetos__navbar__modal_settings" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__navbar__settings')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="action" value="navbar__edit_settings">
                    <fieldset class="form-group">
                        <label>
                            {$strings->get('appnetos__navbar__design_header')}
                        </label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="navbar__design" value="dark"{if $appnetos__navbar->settings->design === "dark"} checked{/if}>
                                {$strings->get('appnetos__navbar__design_dark')}
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="navbar__design" value="light" {if $appnetos__navbar->settings->design === "light"} checked{/if}>
                                {$strings->get('appnetos__navbar__design_light')}
                            </label>
                        </div>
                    </fieldset>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="navbar__home"{if $appnetos__navbar->settings->home} checked{/if}>
                            {$strings->get('appnetos__navbar__design_home')}
                        </label>
                    </div>
                    <label class="mt-4">{$strings->get('appnetos__navbar__logon_header')}</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="navbar__logon" {if $appnetos__navbar->settings->logon} checked{/if}>
                            {$strings->get('appnetos__navbar__logon_sign_in')}
                        </label>
                    </div>
                    <div class="form-group mt-4">
                        <label>
                            {$strings->get('appnetos__navbar__sign_up_link')}
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="navbar__signup" placeholder="{$strings->get('appnetos__navbar__sign_up_link')}" value="{$appnetos__navbar->settings->signup}">
                            <div class="input-group-prepend" onclick="appnetos__navbar.pp('navbar__signup')">
                                <div class="input-group-text">
                                    <img class="appnetos__navbar__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                                </div>
                            </div>
                        </div>
                        <small class="text-secondary">
                            {$strings->get('appnetos__navbar__sign_up')}
                        </small>
                    </div>
                    <div class="form-group mt-4">
                        <label>
                            {$strings->get('appnetos__navbar__forget_pass_link')}
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="navbar__forgetPass" placeholder="{$strings->get('appnetos__navbar__forget_pass_link')}" value="{$appnetos__navbar->settings->forgetPass}">
                            <div class="input-group-prepend" onclick="appnetos__navbar.pp('navbar__forgetPass')">
                                <div class="input-group-text">
                                    <img class="appnetos__navbar__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                                </div>
                            </div>
                        </div>
                        <small class="text-secondary">
                            {$strings->get('appnetos__navbar__forget_pass')}
                        </small>
                    </div>
                    <div class="mt-3 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__navbar__confirm')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__navbar__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal add *}
<div class="modal fade" id="appnetos__navbar__modal_add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__navbar__add_menu')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="text-justify">
                        {$strings->get('appnetos__navbar__add_info')}
                    </div>
                    <input type="hidden" name="action" value="navbar__add">
                    <input id="appnetos__navbar__add_id" type="hidden" name="navbar__id" value="">
                    <div class="form-group mt-4">
                        <label>
                            {$strings->get('appnetos__navbar__add_name')}
                        </label>
                        <input id="appnetos__navbar__add_name" type="text" class="form-control" name="navbar__name" placeholder="{$strings->get('appnetos__navbar__add_name')}">
                    </div>
                    <label>
                        {$strings->get('appnetos__navbar__add_link')}
                    </label>
                    <div class="input-group">
                        <input id="appnetos__navbar__add_link" type="text" class="form-control" name="navbar__link" placeholder="{$strings->get('appnetos__navbar__add_link')}">
                        <div class="input-group-prepend" onclick="appnetos__navbar.pp('navbar__link')">
                            <div class="input-group-text">
                                <img class="appnetos__navbar__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__navbar__add')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{$strings->get('appnetos__navbar__close')}</button>
            </div>
        </div>
    </div>
</div>

{* Modal delete *}
<div class="modal fade" id="appnetos__navbar__modal_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__navbar__delete')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-justify">
                    {$strings->get('appnetos__navbar__delete_info')}<br>
                </div>
                <div class="mt-3 text-right">
                    <form action="" method="post">
                        <input type="hidden" name="action" value="navbar__delete">
                        <input type="hidden" id="appnetos__navbar__delete_id" name="navbar__delete_id">
                        <button type="submit" class="btn btn-danger">{$strings->get('appnetos__navbar__delete')}</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__navbar__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Menu *}
{$render->include('application/apps/appnetos/navbar/admin/views/navbar__menu.tpl')}
<div class="container-sidebar">

    {* Info and messages *}
    {if $admin__info}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 text-justify mt-4">
                    {$strings->get('appnetos__navbar__info')}
                </div>
            </div>
        </div>
    {/if}
    {if $appnetos__navbar->confirmMsg}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-success m-0">
                        {$appnetos__navbar->confirmMsg}
                    </div>
                </div>
            </div>
        </div>
    {/if}
    {if $appnetos__navbar->errorMsg}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-danger m-0">
                        {$appnetos__navbar->errorMsg}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Menus *}
    <form action="" method="post">
        <input type="hidden" name="action" value="navbar__apply">
        {assign var="appnetos__navbar__languages" value=$appnetos__navbar->getLanguages()}
        {assign var="appnetos__navbar__entries" value=$appnetos__navbar__list->getEntries()}

        {* If entries available *}
        {if $appnetos__navbar__entries}
            {assign var="appnetos__navbar__count" value=$appnetos__navbar__entries|count}
            {foreach from=$appnetos__navbar__entries item="appnetos__navbar__entry" key="appnetos__navbar__key"}
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="card">

                                {* Main menu *}
                                <div class="card-header bg-dark text-light">
                                    <h5 class="card-title mt-2 mr-4 float-left">
                                        {$strings->get('appnetos__navbar__main_menu')} &#9658; {$appnetos__navbar__entry->name}
                                    </h5>
                                    <div class="form-inline float-right">
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__navbar.de(event, {$appnetos__navbar__entry->id})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <span class="tool-tip-text bg-danger text-light">
                                                {$strings->get('appnetos__navbar__delete')}
                                            </span>
                                        </div>
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__navbar.ad(event, {$appnetos__navbar__entry->id})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__navbar__add_sub')}</span>
                                        </div>
                                        {if $appnetos__navbar__key|@intval != $appnetos__navbar__count}
                                            <div class="tool-tip">
                                                <button type="submit" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__navbar.mm(event, {$appnetos__navbar__entry->id}, 'down')">
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>
                                                <span class="tool-tip-text bg-primary text-light">&darr;</span>
                                            </div>
                                        {/if}
                                        {if $appnetos__navbar__key|@intval != 1}
                                            <div class="tool-tip">
                                                <button type="submit" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__navbar.mm(event, {$appnetos__navbar__entry->id}, 'up')">
                                                    <i class="fa fa-arrow-up"></i>
                                                </button>
                                                <span class="tool-tip-text bg-primary text-light">&uarr;</span>
                                            </div>
                                        {/if}
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="appnetos__navbar__overflow p-3" data-appnetos__navbar="scroll">
                                        <div class="appnetos__navbar__inline">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label>{$strings->get('appnetos__navbar__add_link')}</label>
                                                    </td>
                                                    <td>
                                                        <label>{$strings->get('appnetos__navbar__global')}</label>
                                                    </td>
                                                    {foreach from=$appnetos__navbar__languages item="appnetos__navbar__language"}
                                                        {if $appnetos__navbar__language->key !== "global"}
                                                            <td>
                                                                <label>{$appnetos__navbar__language->name} ({$appnetos__navbar__language->key})</label>
                                                            </td>
                                                        {/if}
                                                    {/foreach}
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group appnetos__navbar__col_link">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend" onclick="appnetos__navbar.pp('menu___{$appnetos__navbar__entry->id}___link')">
                                                                    <div class="input-group-text">
                                                                        <img class="appnetos__navbar__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control" name="menu___{$appnetos__navbar__entry->id}___link" placeholder="{$strings->get('appnetos__navbar___no_link')}" value="{$appnetos__navbar__entry->link}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group appnetos__navbar__col_name">
                                                            <input type="text" class="form-control" name="menu___{$appnetos__navbar__entry->id}___name" placeholder="{$strings->get('appnetos__navbar__add_name')}" value="{$appnetos__navbar__entry->name}">
                                                        </div>
                                                    </td>
                                                    {foreach from=$appnetos__navbar__languages item="appnetos__navbar__language"}
                                                        {if $appnetos__navbar__language->key !== "global"}
                                                            <td>
                                                                <div class="form-group appnetos__navbar__col_name">
                                                                    <input type="text" class="form-control" name="menu___{$appnetos__navbar__entry->id}___name___{$appnetos__navbar__language->key}" placeholder="{$appnetos__navbar->getPlaceholder($appnetos__navbar__language->key)}" value="{$appnetos__navbar->getName($appnetos__navbar__entry, $appnetos__navbar__language->key)}">
                                                                </div>
                                                            </td>
                                                        {/if}
                                                    {/foreach}
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {* Sub menus *}
                                {assign var="appnetos__navbar__submenus_entries" value=$appnetos__navbar__list->getSubmenus($appnetos__navbar__entry)}
                                {if $appnetos__navbar__submenus_entries}
                                    {assign var="appnetos__navbar__submenus_count" value=$appnetos__navbar__submenus_entries|@count}
                                    {foreach from=$appnetos__navbar__submenus_entries item="appnetos__navbar__submenus_entry" key="appnetos__navbar__submenus_key"}
                                        <div class="card-header">
                                            <h5 class="card-title mt-2 mr-4 float-left">
                                                {$strings->get('appnetos__navbar__sub_menu')} &#9658; {$appnetos__navbar__entry->name} &#9658; {$appnetos__navbar__submenus_entry->name}
                                            </h5>
                                            <div class="form-inline float-right">
                                                <div class="tool-tip">
                                                    <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__navbar.de(event, {$appnetos__navbar__submenus_entry->id})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <span class="tool-tip-text bg-danger text-light">{$strings->get('appnetos__navbar__delete')}</span>
                                                </div>
                                                {if $appnetos__navbar__submenus_key|@intval != $appnetos__navbar__submenus_count}
                                                    <div class="tool-tip">
                                                        <button type="submit" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__navbar.ms(event, {$appnetos__navbar__submenus_entry->id}, 'down')">
                                                            <i class="fa fa-arrow-down"></i>
                                                        </button>
                                                        <span class="tool-tip-text bg-primary text-light">&darr;</span>
                                                    </div>
                                                {/if}
                                                {if $appnetos__navbar__submenus_key|@intval != 1}
                                                    <div class="tool-tip">
                                                        <button type="submit" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__navbar.ms(event, {$appnetos__navbar__submenus_entry->id}, 'up')">
                                                            <i class="fa fa-arrow-up"></i>
                                                        </button>
                                                        <span class="tool-tip-text bg-primary text-light">&uarr;</span>
                                                    </div>
                                                {/if}
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="appnetos__navbar__overflow p-3" data-appnetos__navbar="scroll">
                                                <div class="appnetos__navbar__inline">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <label>{$strings->get('appnetos__navbar__add_link')}</label>
                                                            </td>
                                                            <td>
                                                                <label>{$strings->get('appnetos__navbar__global')}</label>
                                                            </td>
                                                            {foreach from=$appnetos__navbar__languages item="appnetos__navbar__language"}
                                                                {if $appnetos__navbar__language->key !== "global"}
                                                                    <td>
                                                                        <label>{$appnetos__navbar__language->name} ({$appnetos__navbar__language->key})</label>
                                                                    </td>
                                                                {/if}
                                                            {/foreach}
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-group appnetos__navbar__col_link">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend" onclick="appnetos__navbar.pp('menu___{$appnetos__navbar__submenus_entry->id}___link')">
                                                                            <div class="input-group-text">
                                                                                <img class="appnetos__navbar__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" class="form-control" name="menu___{$appnetos__navbar__submenus_entry->id}___link" placeholder="{$strings->get('appnetos__navbar___no_link')}" value="{$appnetos__navbar__submenus_entry->link}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group appnetos__navbar__col_name">
                                                                    <input type="text" class="form-control" name="menu___{$appnetos__navbar__submenus_entry->id}___name" placeholder="{$strings->get('appnetos__navbar__add_name')}" value="{$appnetos__navbar__submenus_entry->name}">
                                                                </div>
                                                            </td>
                                                            {foreach from=$appnetos__navbar__languages item="appnetos__navbar__submenus_language"}
                                                                {if $appnetos__navbar__submenus_language->key !== "global"}
                                                                    <td>
                                                                        <div class="form-group appnetos__navbar__col_name">
                                                                            <input type="text" class="form-control" name="menu___{$appnetos__navbar__submenus_entry->id}___name___{$appnetos__navbar__submenus_language->key}" placeholder="{$appnetos__navbar->getPlaceholder($appnetos__navbar__submenus_language->key)}" value="{$appnetos__navbar->getName($appnetos__navbar__submenus_entry, $appnetos__navbar__submenus_language->key)}">
                                                                        </div>
                                                                    </td>
                                                                {/if}
                                                            {/foreach}
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    {/foreach}
                                {/if}

                            </div>
                        </div>
                    </div>
                </div>
            {/foreach}

            {* Button save *}
            <div class="container">
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary mt-4">
                            {$strings->get('appnetos__navbar__apply')}
                        </button>
                    </div>
                </div>
            </div>

        {* If no entries available *}
        {else}
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="alert alert-warning m-0">{$strings->get('appnetos__navbar__no_entries')}</div>
                    </div>
                </div>
            </div>
        {/if}

    </form>

    {* License *}
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="bg-light text-secondary text-justify p-3">{$strings->get('appnetos__navbar__license')}</div>
            </div>
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>