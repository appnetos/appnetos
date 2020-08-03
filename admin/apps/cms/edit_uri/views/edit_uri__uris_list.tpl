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
 * @description     Admin edit URI and languages URIs.
 *}

{* Menu add *}
{if $admin__cms__edit_uri__uri->uri !== ''}
    <div class="modal fade" id="admin__cms__edit_uri__modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__cms__edit_uri__add_lang')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__cms__edit_uri__add_info')}
                    </div>
                    {if $admin__cms__edit_uri__uris_list->languagesNew|count > 0}
                        <label class="mt-4">
                            {$strings->get('admin__cms__edit_uri__language')}
                        </label>
                        <select id="admin__cms__edit_uri__add_language" class="form-control">
                            {foreach from=$admin__cms__edit_uri__uris_list->languagesNew item="admin__cms__edit_uri__languages_new"}
                                <option value="{$admin__cms__edit_uri__languages_new}">
                                    {$admin__cms__edit_uri__model->getLanguage($admin__cms__edit_uri__languages_new)}
                                </option>
                            {/foreach}
                        </select>
                        <div>
                            <label class="mt-4">
                                {$strings->get('admin__cms__edit_uri__uri')}
                            </label>
                            <input id="admin__cms__edit_uri__add_uri" type="text" class="form-control" placeholder="{$strings->get('admin__cms__edit_uri__uri')}">
                        </div>
                        <label class="mt-4">
                            {$strings->get('admin__cms__edit_uri__title')}
                        </label>
                        <input id="admin__cms__edit_uri__add_title" type="text" class="form-control" placeholder="{$strings->get('admin__cms__edit_uri__title')}">
                        <label class="mt-4">
                            {$strings->get('admin__cms__edit_uri__favicon')}
                        </label>
                        <input id="admin__cms__edit_uri__add_favicon" type="text" class="form-control" placeholder="{$strings->get('admin__cms__edit_uri__favicon')}">
                        <div class="mt-3 text-right">
                            <button type="button" class="btn btn-primary" onclick="admin__cms__edit_uri.nc()">
                                {$strings->get('admin__cms__edit_uri__add')}
                            </button>
                        </div>
                    {else}
                        <div class="mt-4">
                            <div class="alert alert-warning m-0">
                                {$strings->get('admin__cms__edit_uri__no_lang')}
                            </div>
                        </div>
                    {/if}
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__cms__edit_uri__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>
{/if}

{* Global *}
{$render->include('admin/apps/cms/edit_uri/views/edit_uri__uri.tpl')}

{* AJAX error *}
{if $admin__cms__edit_uri__uris_list->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__edit_uri__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__cms__edit_uri__uris_list->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__cms__edit_uri__uris_list->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__cms__edit_uri__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__cms__edit_uri__uris_list->ajaxConfirm}
        </div>
    </div>
{/if}

{* If not home URI *}
{if $admin__cms__edit_uri__uri->uri !== ''}

    {* List URIs *}
    {if ($admin__cms__edit_uri__uri->languages|count > 0)}

        <div class="col-12 mt-4">
            <h4 class="ml-4 mt-0 mr-0 mb-0">
                {$strings->get('admin__cms__edit_uri__languages')}
            </h4>
        </div>
        {foreach from=$admin__cms__edit_uri__uri->languages item=$admin__cms__edit_uri__language}
            {$admin__cms__edit_uri__model->assign('admin__cms__edit_uri__uri', $admin__cms__edit_uri__language)}
            {$render->include('admin/apps/cms/edit_uri/views/edit_uri__uri.tpl')}
        {/foreach}

    {* If no language available *}
    {else}

        <div class="col-12 mt-4">
            <div class="alert alert-warning m-0">
                {$strings->get('admin__cms__edit_uri__no_languages')}
            </div>
        </div>

    {/if}

{* If home URI *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__cms__edit_uri__home_info')}
        </div>
    </div>

{/if}