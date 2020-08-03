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

{* Menu *}
{$render->include('admin/apps/cms/edit_uri/views/edit_uri__menu.tpl')}

<div class="container-sidebar">

    {* Info *}
    {if $admin__cms__edit_uri__model->getInfoAdmin()}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 mt-4 text-justify">
                    {$strings->get('admin__cms__edit_uri__info')}
                </div>
            </div>
        </div>
    {/if}

    {* Modal remove *}
    <div class="modal fade" id="admin__cms__edit_uri__modal_remove" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__cms__edit_uri__remove_header')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__cms__edit_uri__remove_info')}
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" onclick="admin__cms__edit_uri.de()">
                            {$strings->get('admin__cms__edit_uri__remove')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__cms__edit_uri__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* List *}
    <div class="container">
        <div id="admin__cms__edit_uri__uris_list" class="row">
            {$render->include('admin/apps/cms/edit_uri/views/edit_uri__uris_list.tpl')}
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>