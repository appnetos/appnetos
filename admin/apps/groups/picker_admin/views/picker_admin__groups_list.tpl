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
 * @description     Admin admin group picker. Open modal popup to pick an app ID.
 *                  Open:           "admin__groups__picker_admin.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(APP ID);
*}

{* If groups available *}
{if $admin__groups__picker_admin__groups_list->count > 0}

    {* Area *}
    {if $admin__groups__picker_admin__groups_list->areas > 1}
        <div>
            {if $admin__groups__picker_admin__groups_list->start > 1}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se(1)">
                    &#11207;&#11207;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__search->area - 1})">
                    &#11207;
                </button>
            {/if}
            {for $admin__groups__picker_admin__areas = $admin__groups__picker_admin__groups_list->start to $admin__groups__picker_admin__groups_list->end}
                {if $admin__groups__picker_admin__areas === $admin__groups__picker_admin__search->area}
                    <button type="button" class="btn btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__areas})">
                        {$admin__groups__picker_admin__areas}
                    </button>
                {else}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__areas})">
                        {$admin__groups__picker_admin__areas}
                    </button>
                {/if}
            {/for}
            {if $admin__groups__picker_admin__groups_list->end < $admin__groups__picker_admin__groups_list->areas}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__search->area + 1})">
                    &#11208;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__groups_list->areas})">
                    &#11208;&#11208;
                </button>
            {/if}
        </div>
    {/if}

    {* List groups *}
    {foreach from=$admin__groups__picker_admin__groups_list->groupsList item=$admin__groups__picker_admin__group}
        {$admin__groups__picker_admin__model->assign('admin__groups__picker_admin__group', $admin__groups__picker_admin__group)}
        {$render->include('admin/apps/groups/picker_admin/views/picker_admin__group.tpl')}
    {/foreach}

    {if $admin__groups__picker_admin__groups_list->areas > 1}
        <div>
            {if $admin__groups__picker_admin__groups_list->start > 1}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se(1)">
                    &#11207;&#11207;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__search->area - 1})">
                    &#11207;
                </button>
            {/if}
            {for $admin__groups__picker_admin__areas = $admin__groups__picker_admin__groups_list->start to $admin__groups__picker_admin__groups_list->end}
                {if $admin__groups__picker_admin__areas === $admin__groups__picker_admin__search->area}
                    <button type="button" class="btn btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__areas})">
                        {$admin__groups__picker_admin__areas}
                    </button>
                {else}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__areas})">
                        {$admin__groups__picker_admin__areas}
                    </button>
                {/if}
            {/for}
            {if $admin__groups__picker_admin__groups_list->end < $admin__groups__picker_admin__groups_list->areas}
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__search->area + 1})">
                    &#11208;
                </button>
                <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__groups__picker_admin.se({$admin__groups__picker_admin__groups_list->areas})">
                    &#11208;&#11208;
                </button>
            {/if}
        </div>
    {/if}

{/if}

{* Margin *}
<div class="mt-4"></div>