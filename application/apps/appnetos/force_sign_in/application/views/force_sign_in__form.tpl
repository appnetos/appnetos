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
 * @description     Force sign in. Use this app on first static top app to force a login.
*}

{* Force sign in *}
<div class="row">
    <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 mt-5">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark">
                <img class="mr-2 float-left appnetos_force_sign_in__logo" src="{$render->getUrl()}/out/img/appnetos/secure.svg"/>
                <h3 class="mt-2 text-light">
                    {$strings->get('appnetos__force_sign_in__secured')}
                </h3>
            </div>

            {* Form *}
            <div class="card-body">
                <form id="app-{$appnetos__force_sign_in->appId}-form">
                    <label>
                        {$strings->get('appnetos__force_sign_in__user')}
                    </label>
                    <input id="app-{$appnetos__force_sign_in->appId}-user" type="text" name="user" class="form-control" value="{$appnetos__force_sign_in->user}" placeholder="{$strings->get('appnetos__force_sign_in__user')}" onkeydown="appnetos__force_sign_in.kd(event, {$appnetos__force_sign_in->appId})">
                    <label class="mt-4">
                        {$strings->get('appnetos__force_sign_in__pass')}
                    </label>
                    <div class="input-group">
                        <input id="app-{$appnetos__force_sign_in->appId}-pass" type="password" name="pass" class="form-control" value="{$appnetos__force_sign_in->pass}" placeholder="{$strings->get('appnetos__force_sign_in__pass')}" onkeydown="appnetos__force_sign_in.kd(event, {$appnetos__force_sign_in->appId})">
                        <div class="input-group-prepend" onclick="appnetos__force_sign_in.sh({$appnetos__force_sign_in->appId})">
                            <div class="input-group-text">
                                <img class="appnetos__force_sign_in__eye" src="{$render->getUrl()}/out/img/appnetos/eye_open.svg">
                            </div>
                        </div>
                    </div>
                    <div class="form-check mt-4">
                        <label class="form-check-label text-dark">
                            <input id="app-{$appnetos__force_sign_in->appId}-stay" name="stay" type="checkbox"{if $appnetos__force_sign_in->stay} checked="true"{/if} class="form-check-input">
                            {$strings->get('appnetos__force_sign_in__stay')}
                        </label>
                    </div>
                    <button type="button" class="btn btn-primary btn-block mt-4 mb-2" onclick="appnetos__force_sign_in.si({$appnetos__force_sign_in->appId})">
                        {$strings->get('appnetos__force_sign_in__sign_in')}
                    </button>
                    {if $appnetos__force_sign_in->error}
                        <div id="appnetos__force_sign_in__error" class="alert alert-danger m-0 text-center mt-4 mb-2" style="display: none;">
                            {$appnetos__force_sign_in->error}
                        </div>
                    {/if}
                </form>
                <div id="app-{$appnetos__force_sign_in->appId}-loading" class="text-center" style="display:none">
                    <img class="my-4" src="{$render->getUrl()}/out/img/appnetos/loading.gif"/>
                </div>
            </div>
        </div>
    </div>
</div>