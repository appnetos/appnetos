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

{* If user signed in *}
{if $admin__apps__marketplace__user->token && $admin__apps__marketplace__user->user }

    {* Get downloads *}
    {assign var='admin__apps__marketplace__downloads__downloads' value=$admin__apps__marketplace__downloads->downloads}

    {* If downloads available *}
    {if $admin__apps__marketplace__downloads__downloads}

        {* Area *}
        <div class="col-12 d-inline-block">
            {if $admin__apps__marketplace__downloads->areas > 1}
                {if $admin__apps__marketplace__downloads->start > 1}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd(1)">
                        &#11207;&#11207;
                    </button>
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__downloads->area - 1})">
                        &#11207;
                    </button>
                {/if}
                {for $admin__apps__marketplace__areas = $admin__apps__marketplace__downloads->start to $admin__apps__marketplace__downloads->end}
                    {if $admin__apps__marketplace__areas === $admin__apps__marketplace__downloads->area}
                        <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__areas})">
                            {$admin__apps__marketplace__areas}
                        </button>
                    {else}
                        <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__areas})">
                            {$admin__apps__marketplace__areas}
                        </button>
                    {/if}
                {/for}
                {if $admin__apps__marketplace__downloads->end < $admin__apps__marketplace__downloads->areas}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__downloads->area + 1})">
                        &#11208;
                    </button>
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__downloads->areas})">
                        &#11208;&#11208;
                    </button>
                {/if}
            {/if}
        </div>

        {* List apps *}
        {foreach from=$admin__apps__marketplace__downloads__downloads item=$admin__apps__marketplace__download}
            {$admin__apps__marketplace__model->assign('admin__apps__marketplace__download', $admin__apps__marketplace__download)}
            {$render->include('admin/apps/apps/marketplace/views/marketplace__download.tpl')}
        {/foreach}

        {* Area *}
        <div class="col-12 d-inline-block">
            {if $admin__apps__marketplace__downloads->areas > 1}
                {if $admin__apps__marketplace__downloads->start > 1}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd(1)">
                        &#11207;&#11207;
                    </button>
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__downloads->area - 1})">
                        &#11207;
                    </button>
                {/if}
                {for $admin__apps__marketplace__areas = $admin__apps__marketplace__downloads->start to $admin__apps__marketplace__downloads->end}
                    {if $admin__apps__marketplace__areas === $admin__apps__marketplace__downloads->area}
                        <button type="button" class="btn btn-primary mt-4 text-decoration-none disabled" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__areas})">
                            {$admin__apps__marketplace__areas}
                        </button>
                    {else}
                        <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__areas})">
                            {$admin__apps__marketplace__areas}
                        </button>
                    {/if}
                {/for}
                {if $admin__apps__marketplace__downloads->end < $admin__apps__marketplace__downloads->areas}
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__downloads->area + 1})">
                        &#11208;
                    </button>
                    <button type="button" class="btn btn-sm btn-primary mt-4 text-decoration-none" onclick="admin__apps__marketplace.sd({$admin__apps__marketplace__downloads->areas})">
                        &#11208;&#11208;
                    </button>
                {/if}
            {/if}
        </div>

    {* If no apps available *}
    {else}

        {* On connection error *}
        {if $admin__apps__marketplace__model->error}
            <div class="col-12 mt-4">
                <div class="alert alert-warning m-0">
                    {$strings->get('admin__apps__marketplace__err_connection')}
                </div>
            </div>

        {* If no apps available *}
        {else}
            <div class="col-12 mt-4">
                <div class="alert alert-warning m-0">
                    {$strings->get('admin__apps__marketplace__no_apps')}
                </div>
            </div>
        {/if}

    {/if}

    {*$admin__apps__marketplace__apps_list->test()*}

{* If user not signed in *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-danger m-0">
            {$strings->get('admin__apps__marketplace__not_signed_in')}
        </div>
    </div>

{/if}