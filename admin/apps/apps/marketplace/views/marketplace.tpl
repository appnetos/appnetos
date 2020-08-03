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

{* Menu *}
{$render->include('admin/apps/apps/marketplace/views/marketplace__menu.tpl')}

<div class="container-sidebar">

    {* Info *}
    {if $admin__apps__marketplace__model->getInfoAdmin()}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 mt-4 text-justify">
                    {$strings->get('admin__apps__marketplace__info')}
                </div>
            </div>
        </div>
    {/if}

    {* Modal sign in *}
    {if !$admin__apps__marketplace__model->error}
        <div class="modal fade" id="admin__apps__maketplace__modal_sign_in" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title">
                            {$strings->get('admin__apps__marketplace__sign_in')}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="admin__apps__marketplace__form_sign_in">
                            <div class="text-secondary text-justify mb-4">
                                {$strings->get('admin__apps__marketplace__sign_in_info')}
                            </div>
                            <div id="admin__apps__marketplace__error_sign_in" class="alert alert-danger mb-4" style="display: none;"></div>
                            <label>
                                {$strings->get('admin__apps__marketplace__email_or_username')}
                            </label>
                            <input name="admin__apps__marketplace__sign_in_user" type="text" class="form-control" value="" placeholder="{$strings->get('admin__apps__marketplace__email_or_username')}">
                            <label class="mt-4">
                                {$strings->get('admin__apps__marketplace__password')}
                            </label>
                            <input name="admin__apps__marketplace__sign_in_pass" type="password" class="form-control" value="" placeholder="{$strings->get('admin__apps__marketplace__password')}">
                            <div class="mt-3 text-right">
                                <button type="button" class="btn btn-primary" onclick="admin__apps__marketplace.si()">
                                    {$strings->get('admin__apps__marketplace__sign_in')}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {$strings->get('admin__apps__marketplace__close')}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Sections *}
    <div class="container">


        {if !$admin__apps__marketplace__model->error}

            {* Apps List *}
            {if $admin__apps__marketplace__model->section === 'marketplace__apps_list'}
                <div id="admin__apps__marketplace__apps_list" class="row">
                    {$render->include('admin/apps/apps/marketplace/views/marketplace__apps_list.tpl')}
                </div>
            {/if}

            {* Downloads *}
            {if $admin__apps__marketplace__model->section === 'marketplace__downloads'}
                <div id="admin__apps__marketplace__apps_list" class="row">
                    {$render->include('admin/apps/apps/marketplace/views/marketplace__downloads.tpl')}
                </div>
            {/if}

            {* Cart *}
            {if $admin__apps__marketplace__model->section === 'marketplace__cart'}
                <div id="admin__apps__marketplace__cart" class="row">
                    {$render->include('admin/apps/apps/marketplace/views/marketplace__cart.tpl')}
                </div>
            {/if}

        {else}

            {* Connection failed error *}
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-warning m-0">
                        {$strings->get('admin__apps__marketplace__err_connection')}
                    </div>
                </div>
            </div>

        {/if}

    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>