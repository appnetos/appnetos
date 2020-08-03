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
 * @description     Admin language management.
 *}

{* If languages available *}
{if $admin__settings__manage_languages__languages_list->count > 0}

    {* Modal deaktivate *}
    <div class="modal fade" id="admin__settings__manage_languages__modal_deactivate" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__settings__manage_language__remove')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {$strings->get('admin__settings__manage_language__remove_info')}
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" onclick="admin__settings__manage_languages.de()">
                            {$strings->get('admin__settings__manage_language__deactivate')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__settings__manage_language__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Area *}
    {if $admin__settings__manage_languages__languages_list->areas > 1}
    <div class="col-12">
        {if $admin__settings__manage_languages__languages_list->start > 1}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se(1)">
                &#11207;&#11207;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__search->area - 1})">
                &#11207;
            </button>
        {/if}
        {for $admin__settings__manage_languages__areas = $admin__settings__manage_languages__languages_list->start to $admin__settings__manage_languages__languages_list->end}
            {if $admin__settings__manage_languages__areas === $admin__settings__manage_languages__search->area}
                <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__areas})">
                    {$admin__settings__manage_languages__areas}
                </button>
            {else}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__areas})">
                    {$admin__settings__manage_languages__areas}
                </button>
            {/if}
        {/for}
        {if $admin__settings__manage_languages__languages_list->end < $admin__settings__manage_languages__languages_list->areas}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__search->area + 1})">
                &#11208;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__languages_list->areas})">
                &#11208;&#11208;
            </button>
        {/if}
    </div>
    {/if}

    {* List languages *}
    {foreach from=$admin__settings__manage_languages__languages_list->languagesList item=$admin__settings__manage_languages__language}
        {$admin__settings__manage_languages__model->assign('admin__settings__manage_languages__language', $admin__settings__manage_languages__language)}
        {$render->include('admin/apps/settings/manage_languages/views/manage_languages__language.tpl')}
    {/foreach}

    {* Area *}
    {if $admin__settings__manage_languages__languages_list->areas > 1}
    <div class="col-12">
        {if $admin__settings__manage_languages__languages_list->start > 1}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se(1)">
                &#11207;&#11207;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__search->area - 1})">
                &#11207;
            </button>
        {/if}
        {for $admin__settings__manage_languages__areas = $admin__settings__manage_languages__languages_list->start to $admin__settings__manage_languages__languages_list->end}
            {if $admin__settings__manage_languages__areas === $admin__settings__manage_languages__search->area}
                <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__areas})">
                    {$admin__settings__manage_languages__areas}
                </button>
            {else}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__areas})">
                    {$admin__settings__manage_languages__areas}
                </button>
            {/if}
        {/for}
        {if $admin__settings__manage_languages__languages_list->end < $admin__settings__manage_languages__languages_list->areas}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__search->area + 1})">
                &#11208;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__settings__manage_languages.se({$admin__settings__manage_languages__languages_list->areas})">
                &#11208;&#11208;
            </button>
        {/if}
    </div>
    {/if}

{* If no entries available *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__settings__manage_language__no_languages')}
        </div>
    </div>

{/if}