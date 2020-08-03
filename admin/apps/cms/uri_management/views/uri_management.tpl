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
 * @description     Admin URI management to add and delete URIs.
 *}

{* Menu *}
{$render->include('admin/apps/cms/uri_management/views/uri_management__menu.tpl')}

<div class="container-sidebar">

    {* Info *}
    {if $admin__cms__uri_management__model->getInfoAdmin()}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 mt-4 text-justify">
                    {$strings->get('admin__cms__uri_management__info')}
                </div>
            </div>
        </div>
    {/if}

    {* Modal add *}
    <div class="modal fade" id="admin__cms__uri_management__modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__cms__uri_management__add')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__cms__uri_management__add_info')}
                    </div>
                    <label class="mt-4">
                        {$strings->get('admin__cms__uri_management__uri')}
                    </label>
                    <input id="admin__cms__uri_management__uri" type="text" class="form-control" value="" placeholder="{$strings->get('admin__cms__uri_management__uri')}">
                    <label class="mt-4">
                        {$strings->get('admin__cms__uri_management__title')}
                    </label>
                    <input id="admin__cms__uri_management__title" type="text" class="form-control" value="" placeholder="{$strings->get('admin__cms__uri_management__title')}">
                    <label class="mt-4">
                        {$strings->get('admin__cms__uri_management__favicon')}
                    </label>
                    <input id="admin__cms__uri_management__favicon" type="text" class="form-control" value="" placeholder="{$strings->get('admin__cms__uri_management__favicon')}">
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-primary" onclick="admin__cms__uri_management.nc()">
                            {$strings->get('admin__cms__uri_management__button_add')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__cms__uri_management__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* URIs list *}
    <div class="container">
        <div id="admin__cms__uri_management__uris_list" class="row">
            {$render->include('admin/apps/cms/uri_management/views/uri_management__uris_list.tpl')}
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>