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
                {$strings->get('admin__apps__settings__js_info')}
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

{* Info *}
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="alert alert-warning m-0">
                {$strings->get('admin__apps__settings__warning')}
            </div>
        </div>
    </div>
</div>

{* AJAX error *}
{if $admin__apps__settings__js->ajaxError}
    <div class="container">
        <div id="admin__apps__settings__ajax_error" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-danger m-0">
                    {$admin__apps__settings__js->ajaxError}
                </div>
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__apps__settings__js->ajaxConfirm}
    <div class="container">
        <div id="admin__apps__settings__ajax_confirm" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-success m-0">
                    {$admin__apps__settings__js->ajaxConfirm}
                </div>
            </div>
        </div>
    </div>
{/if}

{* Editor *}
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="m-0">
                        {$strings->get('admin__apps__settings__edit_js')}
                    </h5>
                </div>
                <div class="border border-light">
                    <textarea class="w-100" id="admin__apps__settings__js" data-type="admin__apps__settings__js" rows="30">{$admin__apps__settings__app->getJs()}</textarea>
                </div>
                <div class="text-right m-4">
                    <button type="button" class="btn btn-primary text-light" onclick="admin__apps__settings.jsex()">
                        {$strings->get('admin__apps__settings__save')}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>