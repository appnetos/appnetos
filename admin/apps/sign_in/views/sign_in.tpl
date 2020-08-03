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
 * @description     Force sign in for admin section.
 *}

{* Sign in *}
<div class="row">
    <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 mt-5">
        <div class="card">
            <div class="card-header bg-dark">
                <img class="admin__sign_in__logo" src="{$render->getUrl()}/out/admin/img/appnetos/logo_560_white.svg"/>
            </div>
            <div class="card-body">
                <form id="admin__sign_in__form" action="{$render->getUrl()}" method="post">
                    <label>
                        {$strings->get('admin__sign_in__user')}
                    </label>
                    <input id="admin__sign_in__user" name="user" type="text" class="form-control" placeholder="{$strings->get('admin__sign_in__user')}">
                    <label class="mt-4">
                        {$strings->get('admin__sign_in__pass')}
                    </label>
                    <div class="input-group">
                        <input id="admin__sign_in__pass" name="pass" type="password" class="form-control" placeholder="{$strings->get('admin__sign_in__pass')}">
                        <div class="input-group-prepend" onclick="admin__sign_in.sh()">
                            <div class="input-group-text">
                                <img id="admin__sign_in__eye" class="admin__sign_in__eye" src="{$render->getUrl()}/out/admin/img/appnetos/eye_open.svg">
                            </div>
                        </div>
                    </div>
                    <button type="button" id="admin__sign_in__btn" class="btn btn-primary btn-block mt-4 mb-2">
                        {$strings->get('admin__sign_in__sign_in')}
                    </button>
                    <div id="admin__sign_in__error" class="alert alert-danger m-0 text-center mt-4 mb-2">
                        {$strings->get('admin__sign_in__access_denied')}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 offset-md-3 text-center mt-2">
    APPNET OS by xtrose Media Studio <a href="https://www.appnetos.com" target="_blank">www.appnetos.com</a>
</div>