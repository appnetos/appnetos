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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 *}

{* Info *}
{if $admin__settings__system__model->getInfoAdmin()}
    <div class="container info-hide">
        <div class="row">
            <div class="col-12 mt-4 text-justify">
                {$strings->get('admin__settings__system__debug_info')}
            </div>
        </div>
    </div>
{/if}

{* AJAX error *}
{if $admin__settings__system__model->ajaxError}
    <div class="container">
        <div id="admin__settings__system__ajax_error" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-danger m-0">
                    {$admin__settings__system__model->ajaxError}
                </div>
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__settings__system__model->ajaxConfirm}
    <div class="container">
        <div id="admin__settings__system__ajax_confirm" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-success m-0">
                    {$admin__settings__system__model->ajaxConfirm}
                </div>
            </div>
        </div>
    </div>
{/if}

{* Debugging settings *}
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="mt-2 mr-4">
                        {$strings->get('admin__settings__system__menu_debug')}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="admin__settings__system__debug" name="admin__settings__system__debug"{if $admin__settings__system__settings->debug} checked{/if}>
                                <label class="form-check-label" for="admin__settings__system__debug">
                                    {$strings->get('admin__settings__system__debug_debug')}
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="admin__settings__system__debug_ajax" name="admin__settings__system__debug_ajax"{if $admin__settings__system__settings->debugAjax} checked{/if}>
                                <label class="form-check-label" for="admin__settings__system__debug_ajax">
                                    {$strings->get('admin__settings__system__debug_debug_ajax')}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-primary" onclick="admin__settings__system.ex('debug')">
                            {$strings->get('admin__settings__system__save')}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>