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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 *}

{* Info *}
{if $admin__settings__system__model->getInfoAdmin()}
    <div class="container info-hide">
        <div class="row">
            <div class="col-12 mt-4 text-justify">
                {$strings->get('admin__settings__system__extend_info')}
            </div>
        </div>
    </div>
{/if}

{* AJAX error *}
{if $admin__settings__system__model->ajaxError}
    <div class="container">
        <div id="admin__settings__system__ajax_error" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-danger m-0">
                    {$admin__settings__system__model->ajaxError}
                </div>
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__settings__system__model->ajaxConfirm}
    <div class="container">
        <div id="admin__settings__system__ajax_confirm" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-success m-0">
                    {$admin__settings__system__model->ajaxConfirm}
                </div>
            </div>
        </div>
    </div>
{/if}

{* If extends available *}
{if $admin__settings__system__extends->extends|@count > 0}

    {* Modal remove *}
    <div class="modal fade" id="admin__settings__system__modal_remove" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__settings__system__remove')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {$strings->get('admin__settings__system__remove_warning')}
                    <div class="text-right mt-3">
                        <button class="btn btn-danger" onclick="admin__settings__system.rma()">
                            {$strings->get('admin__settings__system__remove')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__settings__system__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Extend settings *}
    <div class="container">
        <div class="row">
            {assign var='admin__settings__key' value=''}
            {assign var='admin__settings__index' value=0}
            {assign var='admin__settings__count' value=0}
            {foreach from=$admin__settings__system__extends->extends item='admin__settings__extend'}
                {if $admin__settings__key !== $admin__settings__extend->key}
                    {if $admin__settings__count !== 0}
                        </div>
                    </div>
                    {/if}
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-dark text-light">
                                <h5 class="mt-2 mr-4">
                                    {$admin__settings__extend->key}
                                </h5>
                            </div>
                            <div class="card-body bg-light">
                                <div class="float-left mb-2">
                                    <div>
                                        {$strings->get('admin__settings__system__class')}
                                    </div>
                                    <div class="text-secondary">
                                        {$admin__settings__extend->parent}
                                    </div>
                                </div>
                                <div class="float-right">
                                    {if $admin__settings__extend->active}
                                        <div class="mb-2">
                                            <span class="bg-success text-light rounded py-1 px-2">
                                                {$strings->get('admin__settings__system__activated')}
                                            </span>
                                        </div>
                                    {else}
                                        <div class="mb-2">
                                            <span class="bg-danger text-light rounded py-1 px-2">
                                                {$strings->get('admin__settings__system__deactivated')}
                                            </span>
                                        </div>
                                    {/if}
                                    {if !$admin__settings__extend->parentExists}
                                        <div class="mb-2">
                                            <span class="bg-danger text-light rounded py-1 px-2">
                                                {$strings->get('admin__settings__system__extends_not_exists')}
                                            </span>
                                        </div>
                                    {/if}
                                    {if !$admin__settings__extend->parentExists}
                                        <div class="text-right">
                                            <div class="tool-tip">
                                                <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__settings__system.rm({$admin__settings__count}, 'parent')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__settings__system__remove')}</span>
                                            </div>
                                        </div>
                                    {/if}
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        {/if}
                        <div class="card-body border-top border-gray">
                            <div class="float-left mb-2">
                                <div>
                                    {$strings->get('admin__settings__system__extends')}
                                </div>
                                <div class="text-secondary">
                                    {$admin__settings__extend->children}
                                </div>
                            </div>
                            <div class="float-right">
                                {if !$admin__settings__extend->childrenExists}
                                    <div class="mb-2">
                                        <span class="bg-danger text-light rounded py-1 px-2">
                                            {$strings->get('admin__settings__system__extends_not_exists')}
                                        </span>
                                    </div>
                                {/if}
                                <div class="text-right">
                                    {if $admin__settings__extend->active}
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__settings__system.of({$admin__settings__count})">
                                                <i class="fa fa-toggle-on"></i>
                                            </button>
                                            <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__settings__system__deactivate')}</span>
                                        </div>
                                    {else}
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__settings__system.on({$admin__settings__count})">
                                                <i class="fa fa-toggle-off"></i>
                                            </button>
                                            <span class="tool-tip-text bg-success text-light">{$strings->get('admin__settings__system__activate')}</span>
                                        </div>
                                    {/if}
                                    {if !$admin__settings__extend->childrenExists}
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__settings__system.rm({$admin__settings__count}, 'children')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__settings__system__remove')}</span>
                                        </div>
                                    {/if}
                                    {if !$admin__settings__extend->last}
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__settings__system.mc({$admin__settings__count}, 'down')">
                                                <i class="fa fa-arrow-down"></i>
                                            </button>
                                            <span class="tool-tip-text bg-primary text-light">&darr;</span>
                                        </div>
                                    {/if}
                                    {if !$admin__settings__extend->first}
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__settings__system.mc({$admin__settings__count}, 'up')">
                                                <i class="fa fa-arrow-up"></i>
                                            </button>
                                            <span class="tool-tip-text bg-primary text-light">&uarr;</span>
                                        </div>
                                    {/if}
                                </div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                        {if $admin__settings__key !== $admin__settings__extend->key}
                            {assign var='admin__settings__key' value=$admin__settings__extend->key}
                            {assign var='admin__settings__index' value=0}
                        {else}
                            {assign var='admin__settings__index' value=$admin__settings__index+1}
                        {/if}
                        {assign var='admin__settings__count' value=$admin__settings__count+1}
                    {/foreach}
                </div>
            </div>
        </div>
    </div>

{* If no entries available *}
{else}

    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="alert alert-warning m-0">
                    {$strings->get('admin__settings__system__no_extends')}
                </div>
            </div>
        </div>
    </div>

{/if}