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
 * @description     Admin app creator to build apps.
 *}


{* Info *}
{if $admin__apps__create__html->getInfoAdmin()}
    <div class="container info-hide">
        <div class="row">
            <div class="col-12 text-justify mt-4">
                {$strings->get('admin__apps__create__html_info')}
            </div>
        </div>
    </div>
{/if}

{* AJAX error *}
{if $admin__apps__create__html->ajaxError}
    <div class="container">
        <div id="admin__apps__create_html__ajax_error" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-danger m-0">
                    {$admin__apps__create__html->ajaxError}
                </div>
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__apps__create__html->ajaxConfirm}
    <div class="container">
        <div id="admin__apps__create_html__ajax_confirm" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-success m-0">
                    {$admin__apps__create__html->ajaxConfirm}
                </div>
            </div>
        </div>
    </div>
{/if}

{* Form *}
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="m-0">
                        {$strings->get('admin__apps__create__html_header')}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        {* Name *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__name')}
                            </label>
                            <input id="admin__apps__create_html__name" type="text" class="form-control" value="{$admin__apps__create__html->name}" placeholder="{$strings->get('admin__apps__create__name')}" onkeydown="admin__apps__create.hk(event)">
                        </div>

                        {* Namespace *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__description')}
                            </label>
                            <input id="admin__apps__create_html__description" type="text" class="form-control" value="{$admin__apps__create__html->description}" placeholder="{$strings->get('admin__apps__create__description')}" onkeydown="admin__apps__create.hk(event)">
                        </div>

                    </div>

                    {* Button Build *}
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" onclick="admin__apps__create.he()">
                            {$strings->get('admin__apps__create__build')}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>