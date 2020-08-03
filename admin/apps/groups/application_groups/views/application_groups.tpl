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
 * @description     Application user groups. Groups can be used to define which users can view which areas.
 *}

{* Menu *}
{$render->include('admin/apps/groups/application_groups/views/application_groups__menu.tpl')}

<div class="container-sidebar">

    {* Info *}
    {if $admin__groups__application_groups__model->getInfoAdmin()}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 mt-4">
                    {$strings->get('admin__groups__application_groups__info')}
                </div>
            </div>
        </div>
    {/if}

    {* Modal add *}
    <div class="modal fade" id="admin__groups__application_groups__modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" data-type="form_add_user">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__groups__application_groups__add')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>
                        {$strings->get('admin__groups__application_groups__name')}
                    </label>
                    <input type="text" name="name" maxlength="100" class="form-control" id="admin__groups__application_groups__name" value="" placeholder="{$strings->get('admin__groups__application_groups__name')}" onkeydown="admin__groups__application_groups.ak(event)">
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-primary" onclick="admin__groups__application_groups.ac()">
                            {$strings->get('admin__groups__application_groups__add')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__groups__application_groups__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Groups list *}
    <div class="container">
        <div id="admin__groups__application_groups__groups_list" class="row">
            {$render->include('admin/apps/groups/application_groups/views/application_groups__groups_list.tpl')}
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>