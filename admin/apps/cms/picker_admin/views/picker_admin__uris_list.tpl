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
 * @description     Admin admin cms multi picker. Open modal popup to pick an list of URI IDs.
 *                  Open:           "admin__cms__picker_admin.pick('mynamespace.myfunction', array with excluded IDs);
 *                  Select: Execute "mynamespace.myfunction(URI ID);
 *}

{* If entries exists *}
{if $admin__cms__picker_admin__uris_list->urisList|count > 0}

    {* Area *}
    {if $admin__cms__picker_admin__uris_list->areas > 1}
        {if $admin__cms__picker_admin__uris_list->start > 1}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se(1)">
                &#11207;&#11207;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__search->area - 1})">
                &#11207;
            </button>
        {/if}
        {for $admin__cms__picker_admin__areas = $admin__cms__picker_admin__uris_list->start to $admin__cms__picker_admin__uris_list->end}
            {if $admin__cms__picker_admin__areas === $admin__cms__picker_admin__search->area}
                <button type="button" class="btn btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__areas})">
                    {$admin__cms__picker_admin__areas}
                </button>
            {else}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__areas})">
                    {$admin__cms__picker_admin__areas}
                </button>
            {/if}
        {/for}
        {if $admin__cms__picker_admin__uris_list->end < $admin__cms__picker_admin__uris_list->areas}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__search->area + 1})">
                &#11208;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__uris_list->areas})">
                &#11208;&#11208;
            </button>
        {/if}
    {/if}

    {* List URIs *}
    <div class="mt-4 table-responsive">
        <table class="table table-bordered">
            <tbody>
                {foreach from=$admin__cms__picker_admin__uris_list->urisList item=$admin__cms__picker_admin__uri}
                    {$admin__cms__picker_admin__model->assign('admin__cms__picker_admin__uri', $admin__cms__picker_admin__uri)}
                    {$render->include('admin/apps/cms/picker_admin/views/picker_admin__uri.tpl')}
                {/foreach}
            </tbody>
        </table>
    </div>

    {* Area *}
    {if $admin__cms__picker_admin__uris_list->areas > 1}
        {if $admin__cms__picker_admin__uris_list->start > 1}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se(1)">
                &#11207;&#11207;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__search->area - 1})">
                &#11207;
            </button>
        {/if}
        {for $admin__cms__picker_admin__areas = $admin__cms__picker_admin__uris_list->start to $admin__cms__picker_admin__uris_list->end}
            {if $admin__cms__picker_admin__areas === $admin__cms__picker_admin__search->area}
                <button type="button" class="btn btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__areas})">
                    {$admin__cms__picker_admin__areas}
                </button>
            {else}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__areas})">
                    {$admin__cms__picker_admin__areas}
                </button>
            {/if}
        {/for}
        {if $admin__cms__picker_admin__uris_list->end < $admin__cms__picker_admin__uris_list->areas}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__search->area + 1})">
                &#11208;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker_admin.se({$admin__cms__picker_admin__uris_list->areas})">
                &#11208;&#11208;
            </button>
        {/if}
    {/if}

    {* Button select *}
    <div class="mt-3 text-right">
        <button class="btn btn-primary" onclick="admin__cms__picker_admin.p()">
            {$strings->get('admin__cms__picker_admin__select')}
        </button>
    </div>

{/if}

{* Margin *}
<div class="mt-4"></div>