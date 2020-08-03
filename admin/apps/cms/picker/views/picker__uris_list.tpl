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
 * @description     Admin cms picker. Open modal popup to pick an URI ID.
 *                  Open:           "admin__cms__picker.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(URI ID);
 *}

{* If entries exists *}
{if $admin__cms__picker__uris_list->urisList|count > 0}

    {* Area *}
    {if $admin__cms__picker__uris_list->areas > 1}
        {if $admin__cms__picker__uris_list->start > 1}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se(1)">
                &#11207;&#11207;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__search->area - 1})">
                &#11207;
            </button>
        {/if}
        {for $admin__cms__picker__areas = $admin__cms__picker__uris_list->start to $admin__cms__picker__uris_list->end}
            {if $admin__cms__picker__areas === $admin__cms__picker__search->area}
                <button type="button" class="btn btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__areas})">
                    {$admin__cms__picker__areas}
                </button>
            {else}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__areas})">
                    {$admin__cms__picker__areas}
                </button>
            {/if}
        {/for}
        {if $admin__cms__picker__uris_list->end < $admin__cms__picker__uris_list->areas}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__search->area + 1})">
                &#11208;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__uris_list->areas})">
                &#11208;&#11208;
            </button>
        {/if}
    {/if}

    {* List URIs *}
    {foreach from=$admin__cms__picker__uris_list->urisList item=$admin__cms__picker__uri}
        {$admin__cms__picker__model->assign('admin__cms__picker__uri', $admin__cms__picker__uri)}
        {$render->include('admin/apps/cms/picker/views/picker__uri.tpl')}
    {/foreach}

    {* Area *}
    {if $admin__cms__picker__uris_list->areas > 1}
        {if $admin__cms__picker__uris_list->start > 1}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se(1)">
                &#11207;&#11207;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__search->area - 1})">
                &#11207;
            </button>
        {/if}
        {for $admin__cms__picker__areas = $admin__cms__picker__uris_list->start to $admin__cms__picker__uris_list->end}
            {if $admin__cms__picker__areas === $admin__cms__picker__search->area}
                <button type="button" class="btn btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__areas})">
                    {$admin__cms__picker__areas}
                </button>
            {else}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__areas})">
                    {$admin__cms__picker__areas}
                </button>
            {/if}
        {/for}
        {if $admin__cms__picker__uris_list->end < $admin__cms__picker__uris_list->areas}
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__search->area + 1})">
                &#11208;
            </button>
            <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__cms__picker.se({$admin__cms__picker__uris_list->areas})">
                &#11208;&#11208;
            </button>
        {/if}
    {/if}

{/if}

{* Margin *}
<div class="mt-4"></div>