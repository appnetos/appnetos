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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 *}

{* Info *}
{if $admin__apps__settings__model->getInfoAdmin()}
    <div class="container info-hide">
        <div class="row">
            <div class="col-12 mt-4 text-justify">
                {$strings->get('admin__apps__settings__size_info')}
            </div>
        </div>
    </div>
{/if}

{* App *}
<div class="container info-hide">
    <div class="row">
        {$render->include('admin/apps/apps/settings/views/settings__app.tpl')}
    </div>
</div>

{* AJAX error *}
{if $admin__apps__settings__size->ajaxError}
    <div class="container">
        <div id="admin__apps__settings__ajax_error" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-danger m-0">
                    {$admin__apps__settings__size->ajaxError}
                </div>
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__apps__settings__size->ajaxConfirm}
    <div class="container">
        <div id="admin__apps__settings__ajax_confirm" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-success m-0">
                    {$admin__apps__settings__size->ajaxConfirm}
                </div>
            </div>
        </div>
    </div>
{/if}

{* Size *}
<div class="container" data-type="admin__apps__settings__size">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 mt-4">
            <div class="card">

                {* Header *}
                <div class="card-header bg-dark text-light">
                    <h5 class="m-0">
                        {$strings->get('admin__apps__settings__size_and_align')}
                    </h5>
                </div>

                {* Size *}
                <div class="card-body">

                    {* Bootstrap col *}
                    <label>
                        {$strings->get('admin__apps__settings__header_col')}
                    </label>
                    <div class="row admin__apps__settings__row">
                        {assign var='offset' value=$admin__apps__settings__size->offset[0]}
                        {assign var='col' value=$admin__apps__settings__size->col[0]}
                        {for $i=1 to 12}
                        {assign var='bg' value='bg-secondary'}
                        {assign var='val' value='0'}
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 admin__apps__settings__col">
                            {if $offset >= $i}
                            {assign var='bg' value='bg-dark'}
                            {assign var='val' value='1'}
                            {elseif ($offset + $col) >= $i}
                            {assign var='bg' value='bg-primary'}
                            {assign var='val' value='2'}
                            {/if}
                            <div class="admin__apps__settings__block {$bg}" data-object="block" data-size="-" data-block="{$i}" data-val="{$val}" onclick="admin__apps__settings.sacl(this)"></div>
                        </div>
                        {/for}
                    </div>

                    {* Bootstrap col-sm *}
                    <label class="mt-4">
                        {$strings->get('admin__apps__settings__header_col_sm')}
                    </label>
                    <div class="row admin__apps__settings__row">
                        {assign var='offset' value=$admin__apps__settings__size->offset[1]}
                        {assign var='col' value=$admin__apps__settings__size->col[1]}
                        {for $i=1 to 12}
                        {assign var='bg' value='bg-secondary'}
                        {assign var='val' value='0'}
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 admin__apps__settings__col">
                            {if $offset >= $i}
                            {assign var='bg' value='bg-dark'}
                            {assign var='val' value='1'}
                            {elseif ($offset + $col) >= $i}
                            {assign var='bg' value='bg-primary'}
                            {assign var='val' value='2'}
                            {/if}
                            <div class="admin__apps__settings__block {$bg}" data-object="block" data-size="-sm-" data-block="{$i}" data-val="{$val}" onclick="admin__apps__settings.sacl(this)"></div>
                        </div>
                        {/for}
                    </div>

                    {* Bootstrap col-md *}
                    <label class="mt-4">
                        {$strings->get('admin__apps__settings__header_col_md')}
                    </label>
                    <div class="row admin__apps__settings__row">
                        {assign var='offset' value=$admin__apps__settings__size->offset[2]}
                        {assign var='col' value=$admin__apps__settings__size->col[2]}
                        {for $i=1 to 12}
                        {assign var='bg' value='bg-secondary'}
                        {assign var='val' value='0'}
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 admin__apps__settings__col">
                            {if $offset >= $i}
                            {assign var='bg' value='bg-dark'}
                            {assign var='val' value='1'}
                            {elseif ($offset + $col) >= $i}
                            {assign var='bg' value='bg-primary'}
                            {assign var='val' value='2'}
                            {/if}
                            <div class="admin__apps__settings__block {$bg}" data-object="block" data-size="-md-" data-block="{$i}" data-val="{$val}" onclick="admin__apps__settings.sacl(this)"></div>
                        </div>
                        {/for}
                    </div>

                    {* Bootstrap col-lg *}
                    <label class="mt-4">
                        {$strings->get('admin__apps__settings__header_col_lg')}
                    </label>
                    <div class="row admin__apps__settings__row">
                        {assign var='offset' value=$admin__apps__settings__size->offset[3]}
                        {assign var='col' value=$admin__apps__settings__size->col[3]}
                        {for $i=1 to 12}
                        {assign var='bg' value='bg-secondary'}
                        {assign var='val' value='0'}
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 admin__apps__settings__col">
                            {if $offset >= $i}
                            {assign var='bg' value='bg-dark'}
                            {assign var='val' value='1'}
                            {elseif ($offset + $col) >= $i}
                            {assign var='bg' value='bg-primary'}
                            {assign var='val' value='2'}
                            {/if}
                            <div class="admin__apps__settings__block {$bg}" data-object="block" data-size="-lg-" data-block="{$i}" data-val="{$val}" onclick="admin__apps__settings.sacl(this)"></div>
                        </div>
                        {/for}
                    </div>

                    {* Bootstrap col-xl *}
                    <label class="mt-4">
                        {$strings->get('admin__apps__settings__header_col_xl')}
                    </label>
                    <div class="row admin__apps__settings__row">
                        {assign var='offset' value=$admin__apps__settings__size->offset[4]}
                        {assign var='col' value=$admin__apps__settings__size->col[4]}
                        {for $i=1 to 12}
                        {assign var='bg' value='bg-secondary'}
                        {assign var='val' value='0'}
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 admin__apps__settings__col">
                            {if $offset >= $i}
                            {assign var='bg' value='bg-dark'}
                            {assign var='val' value='1'}
                            {elseif ($offset + $col) >= $i}
                            {assign var='bg' value='bg-primary'}
                            {assign var='val' value='2'}
                            {/if}
                            <div class="admin__apps__settings__block {$bg}" data-object="block" data-size="-xl-" data-block="{$i}" data-val="{$val}" onclick="admin__apps__settings.sacl(this)"></div>
                        </div>
                        {/for}
                    </div>

                    {* Button save *}
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-primary" onclick="admin__apps__settings.saex()">
                            {$strings->get('admin__apps__settings__save')}
                        </button>
                    </div>

                </div>
            </div>

        </div>

        {* Preview *}
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3 mt-4">
            <div class="card">
                <div class="card-header bg-light text-dark">
                    <h5 class="m-0">
                        {$strings->get('admin__apps__settings__grid_css')}
                    </h5>
                </div>
                <div id="admin__apps__settings__css" class="card-body"></div>
            </div>
        </div>
    </div>
</div>