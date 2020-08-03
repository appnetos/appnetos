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
 * @description     Automatic breadcrumbs. Loads and shows breadcrumbs by URI index.
*}

{* AJAX error *}
{if $appnetos__breadcrumbs->ajaxError}
    <div id="appnetos__breadcrumbs__ajax_error" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-danger m-0">
                {$appnetos__breadcrumbs->ajaxError}
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $appnetos__breadcrumbs->ajaxConfirm}
    <div id="appnetos__breadcrumbs__ajax_confirm" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-success m-0">
                {$appnetos__breadcrumbs->ajaxConfirm}
            </div>
        </div>
    </div>
{/if}

{* Settings *}
<form id="appnetos__breadcrumbs__form" action="" method="post">
    <div class="row">

        {* Color settings *}
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="card-title m-0">
                        {$strings->get('appnetos__breadcrumbs__settings')}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mt-4">
                                <label for="appnetos__breadcrumbs__background">{$strings->get('appnetos__breadcrumbs__background')} (#HEX)</label>
                                <input type="text" class="form-control" maxlength="7" name="background" value="{$appnetos__breadcrumbs->settings->background}" placeholder="{$strings->get('appnetos__breadcrumbs__background')}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mt-4">
                                <label for="appnetos__breadcrumbs__border">{$strings->get('appnetos__breadcrumbs__border')} (#HEX)</label>
                                <input type="text" class="form-control" maxlength="7"  name="border" value="{$appnetos__breadcrumbs->settings->border}" placeholder="{$strings->get('appnetos__breadcrumbs__border')}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mt-4">
                                <label for="appnetos__breadcrumbs__color">{$strings->get('appnetos__breadcrumbs__color')} (#HEX)</label>
                                <input type="text" class="form-control" maxlength="7"  name="color" value="{$appnetos__breadcrumbs->settings->color}" placeholder="{$strings->get('appnetos__breadcrumbs__color')}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mt-4">
                                <label for="appnetos__breadcrumbs__link">{$strings->get('appnetos__breadcrumbs__link')} (#HEX)</label>
                                <input type="text" class="form-control" maxlength="7"  name="link" value="{$appnetos__breadcrumbs->settings->link}" placeholder="{$strings->get('appnetos__breadcrumbs__link')}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {* Button save *}
        <div class="col-12 text-right mt-4">
            <button type="button" class="btn btn-primary" onclick="appnetos__breadcrumbs.ed()">
                {$strings->get('appnetos__breadcrumbs__save')}
            </button>
        </div>
    </div>
</form>