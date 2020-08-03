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
 * @description     Admin overview and management for application users.
 *}

{* Menu *}
{$render->include('admin/apps/users/application_management/views/application_management__menu.tpl')}

<div class="container-sidebar">

    {* Info *}
    {if $admin__users__application_management__model->getInfoAdmin()}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 mt-4">
                    {$strings->get('admin__users__application_management__info')}
                </div>
            </div>
        </div>
    {/if}

    {* Modal add *}
    <div class="modal fade" id="admin__users__application_management__modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" data-type="form_add_user">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__users__application_management__add')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>
                        {$strings->get('admin__users__application_management__user')}
                    </label>
                    <input type="text" name="user" class="form-control" id="admin__users__application_management__add_user" value="" placeholder="{$strings->get('admin__users__application_management__user')}">
                    <div class="form-check mt-2">
                        <input type="checkbox" name="min_user_verify" class="form-check-input" id="admin__users__application_management__add_min_user">
                        <label class="form-check-label" for="admin__users__application_management__add_min_user">
                            {$strings->get("admin__users__application_management__edit_min_user")}
                        </label>
                    </div>
                    <label class="mt-4">
                        {$strings->get('admin__users__application_management__mail')}
                    </label>
                    <input type="text" name="mail" class="form-control" id="admin__users__application_management__add_mail" value="" placeholder="{$strings->get('admin__users__application_management__mail')}">
                    <label class="mt-4">
                        {$strings->get('admin__users__application_management__pass')}
                    </label>
                    <div class="input-group">
                        <input type="password" name="pass" id="admin__users__application_management__add_pass" class="form-control" placeholder="{$strings->get('admin__users__application_management__pass')}">
                        <div class="input-group-prepend" onclick="admin__users__application_management.sh(this, '{$render->getUrl()}')">
                            <div class="input-group-text">
                                <img class="admin__users__application_management__eye" src="{$render->getUrl()}/out/admin/img/appnetos/eye_open.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="form-check mt-2">
                        <input type="checkbox" name="min_pass_verify" class="form-check-input" id="admin__users__application_management__add_min_pass">
                        <label class="form-check-label" for="admin__users__application_management__add_min_pass">
                            {$strings->get('admin__users__application_management__edit_min_pass')}
                        </label>
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-primary" onclick="admin__users__application_management.ac()">
                            {$strings->get('admin__users__application_management__add')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__users__application_management__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* Users list *}
    <div class="container">
        <div id="admin__users__application_management__users_list" class="row">
            {$render->include('admin/apps/users/application_management/views/application_management__users_list.tpl')}
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>