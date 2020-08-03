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
{if $admin__apps__create__developer->getInfoAdmin()}
    <div class="container info-hide">
        <div class="row">
            <div class="col-12 text-justify mt-4">
                {$strings->get('admin__apps__create__dev_info')}
            </div>
        </div>
    </div>
{/if}

{* AJAX error *}
{if $admin__apps__create__developer->ajaxError}
    <div class="container">
        <div id="admin__apps__create_developer__ajax_error" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-danger m-0">
                    {$admin__apps__create__developer->ajaxError}
                </div>
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__apps__create__developer->ajaxConfirm}
    <div class="container">
        <div id="admin__apps__create_developer__ajax_confirm" class="row d-none">
            <div class="col-12 mt-4">
                <div class="alert alert-success m-0">
                    {$admin__apps__create__developer->ajaxConfirm}
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

                {* Header *}
                <div class="card-header bg-dark text-light">
                    <h5 class="m-0">
                        {$strings->get('admin__apps__create__dev_header')}
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row">

                        {* Development *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__development')}
                            </label>
                            <fieldset class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__development" value="smarty"{if $admin__apps__create__developer->development === 'smarty'} checked{/if}>
                                        {$strings->get('admin__apps__create__smarty')}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__development" value="twig"{if $admin__apps__create__developer->development === 'twig'} checked{/if}>
                                        {$strings->get('admin__apps__create__twig')}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__development" value="php"{if $admin__apps__create__developer->development === 'php'} checked{/if}>
                                        {$strings->get('admin__apps__create__php')}
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        {* Widget *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__widget')}
                            </label>
                            <fieldset class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__widget" value="on"{if $admin__apps__create__developer->widget} checked{/if}>
                                        {$strings->get('admin__apps__create__widget_true')}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__widget" value="off"{if !$admin__apps__create__developer->widget} checked{/if}>
                                        {$strings->get('admin__apps__create__widget_false')}
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        {* Cache *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__cache')}
                            </label>
                            <fieldset class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__cache" value="on"{if $admin__apps__create__developer->cache} checked{/if}>
                                        {$strings->get('admin__apps__create__cache_true')}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__cache" value="off"{if !$admin__apps__create__developer->cache} checked{/if}>
                                        {$strings->get('admin__apps__create__cache_false')}
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        {* Container app *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__container_app')}
                            </label>
                            <fieldset class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__container" value="on"{if $admin__apps__create__developer->container} checked{/if}>
                                        {$strings->get('admin__apps__create__container_true')}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="admin__apps__create_developer__container" value=""{if !$admin__apps__create__developer->container} checked{/if}>
                                        {$strings->get('admin__apps__create__container_false')}
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        {* Name *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__name')}
                            </label>
                            <input id="admin__apps__create_developer__name" type="text" class="form-control" value="{$admin__apps__create__developer->name}" placeholder="{$strings->get('admin__apps__create__name')}" onkeydown="admin__apps__create.dk(event)">
                        </div>

                        {* Directory *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__directory')}
                            </label>
                            <input id="admin__apps__create_developer__directory" type="text" class="form-control" value="{$admin__apps__create__developer->directory}" placeholder="{$strings->get('admin__apps__create__directory')}" onkeydown="admin__apps__create.dk(event)">
                        </div>

                        {* Namespace *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__namespace')}
                            </label>
                            <input id="admin__apps__create_developer__namespace" type="text" class="form-control" value="{$admin__apps__create__developer->namespace}" placeholder="{$strings->get('admin__apps__create__namespace')}" onkeydown="admin__apps__create.dk(event)">
                        </div>

                        {* Description *}
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4">
                            <label>
                                {$strings->get('admin__apps__create__description')}
                            </label>
                            <input id="admin__apps__create_developer__description" type="text" class="form-control" value="{$admin__apps__create__developer->description}" placeholder="{$strings->get('admin__apps__create__description')}" onkeydown="admin__apps__create.dk(event)">
                        </div>

                    </div>

                    {* Button Build *}
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" onclick="admin__apps__create.de()">
                            {$strings->get('admin__apps__create__build')}
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>