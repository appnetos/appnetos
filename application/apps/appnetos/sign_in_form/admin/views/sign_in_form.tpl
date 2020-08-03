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
 * @description     Simple form to sign in by email or username and password.
 *}

{* Menu *}
{$render->include('application/apps/appnetos/sign_in_form/admin/views/menu.tpl')}
<div class="container-sidebar">

    {* Info and messages *}
    {if $admin__info}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 text-justify mt-4">
                    {$strings->get('appnetos__sign_in_form__info')}
                </div>
            </div>
        </div>
    {/if}
    {if $appnetos__sign_in_form->confirmMsg}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-success m-0">
                        {$appnetos__sign_in_form->confirmMsg}
                    </div>
                </div>
            </div>
        </div>
    {/if}
    {if $appnetos__sign_in_form->errorMsg}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-danger m-0">
                        {$appnetos__sign_in_form->errorMsg}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Menus *}
    <form action="" method="post">
        <input type="hidden" name="action" value="sign_in_form__edit_settings">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h5 class="card-title m-0">
                                {$strings->get('appnetos__sign_in_form__settings')}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="form-group mt-2">
                                        <label>
                                            {$strings->get('appnetos__sign_in_form__sign_up_link')}
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="sign_in_form__signup" name="sign_in_form__signup" value="{$appnetos__sign_in_form->settings->signup}" placeholder="{$strings->get('appnetos__sign_in_form__sign_up_link')}">
                                            <div class="input-group-prepend" onclick="admin__cms__picker.pick('appnetos__sign_in_form.pr')">
                                                <div class="input-group-text">
                                                    <img class="appnetos__sign_in_form__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-secondary">
                                            {$strings->get('appnetos__sign_in_form__sign_up')}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="form-group mt-2">
                                        <label>
                                            {$strings->get('appnetos__sign_in_form__forget_pass_link')}
                                        </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="sign_in_form__forgetPass" name="sign_in_form__forgetPass" value="{$appnetos__sign_in_form->settings->forgetPass}" placeholder="{$strings->get('appnetos__sign_in_form__forget_pass_link')}">
                                            <div class="input-group-prepend" onclick="admin__cms__picker.pick('appnetos__sign_in_form.pp')">
                                                <div class="input-group-text">
                                                    <img class="appnetos__sign_in_form__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-secondary">
                                            {$strings->get('appnetos__sign_in_form__forget_pass')}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        {$strings->get('appnetos__sign_in_form__confirm')}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {* License *}
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="bg-light text-secondary text-justify p-3">
                    {$strings->get('appnetos__sign_in_form__license')}
                </div>
            </div>
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>