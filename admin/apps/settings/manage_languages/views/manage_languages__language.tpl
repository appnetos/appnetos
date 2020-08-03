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
 * @description     Admin language management.
 *}

{* AJAX error *}
{if $admin__settings__manage_languages__language->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__settings__manage_languages__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__settings__manage_languages__language->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__settings__manage_languages__language->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__settings__manage_languages__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__settings__manage_languages__language->ajaxConfirm}
        </div>
    </div>
{/if}

{* App *}
{if !$admin__settings__manage_languages__language->error}

    <div class="col-12 mt-4"  data-type="admin__settings__manage_languages__language">
        <div class="card">

            {* Header *}
            <div class="card-header bg-dark text-light">
                <h5 class="float-left mt-2 mr-4">
                    {$admin__settings__manage_languages__language->key}
                </h5>
                <div class="form-inline float-right">
                    <div class="tool-tip">
                        {if $admin__settings__manage_languages__language->active}
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__settings__manage_languages.dc(this, {$admin__settings__manage_languages__language->id})">
                                <i class="fas fa-toggle-on"></i>
                            </button>
                            <span class="tool-tip-text bg-danger text-light">
                                {$strings->get('admin__settings__manage_language__deactivate')}
                            </span>
                        {else}
                            <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__settings__manage_languages.ae('activate', this, {$admin__settings__manage_languages__language->id})">
                                <i class="fas fa-toggle-off"></i>
                            </button>
                            <span class="tool-tip-text bg-success text-light">
                                {$strings->get('admin__settings__manage_language__activate')}
                            </span>
                        {/if}
                    </div>
                </div>
            </div>

            {* Information *}
            <div class="card-body bg-light text-dark">
                <div class="form-inline float-right">
                    {if $admin__settings__manage_languages__language->default}
                        <span class="bg-primary text-light rounded py-1 px-2">{$strings->get('admin__settings__manage_language__default')}</span>
                    {/if}
                    {if $admin__settings__manage_languages__language->active}
                        <span class="bg-success text-light rounded py-1 px-2">{$strings->get('admin__settings__manage_language__activated')}</span>
                    {/if}
                </div>
            </div>

            {* Menu *}
            <div class="card-body bg-light text-dark p-0">
                <div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="" data-nav="properties">
                                {$strings->get('admin__settings__manage_language__properties')}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {* Properties *}
            <div class="card-body bg-white text-dark" data-type="properties">
                <div>
                    {$admin__settings__manage_languages__language->name}
                </div>
                <div class="text-secondary">
                    {$admin__settings__manage_languages__language->nameEn}
                </div>
            </div>

        </div>
    </div>

{/if}