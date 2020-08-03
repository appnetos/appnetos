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
                {$strings->get('admin__settings__system__info')}
            </div>
        </div>
    </div>
{/if}

{* Settings *}
<div class="container">
    <div class="row">

        {* System settings *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="mt-2">
                        {$strings->get('admin__settings__system__system')}
                    </h5>
                </div>
                <div class="card-body">
                    <div>
                        {$strings->get('admin__settings__system__url')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->url}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__data_path')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->dir}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__prefix')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->prefix}
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->cookieLock} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__cookie_lock')}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {* Database settings *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="mt-2">
                        {$strings->get('admin__settings__system__database')}
                    </h5>
                </div>
                <div class="card-body">
                    <div>
                        {$strings->get('admin__settings__system__database_type')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->dbType}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__database_host')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->dbHost}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__database_port')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->dbPort}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__database_name')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->dbName}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__database_user')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->dbUser}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__database_pass')}
                    </div>
                    <div class="text-secondary">
                        ********
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__database_charset')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->dbCharset}
                    </div>
                </div>
            </div>
        </div>

        {* Directories settings *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="mt-2">
                        {$strings->get('admin__settings__system__directories')}
                    </h5>
                </div>
                <div class="card-body">
                    <div>
                        {$strings->get('admin__settings__system__cache_dir')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->getCacheDir()}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__temp_dir')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->getTmpDir()}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__log_dir')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->getLogDir()}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__compile_dir')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->getCompileDir()}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__config_dir')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->getConfigDir()}
                    </div>
                </div>
            </div>
        </div>

        {* Cache settings *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="float-left mt-2 mr-4">
                        {$strings->get('admin__settings__system__cache')}
                    </h5>
                    {if $render->getUrl(404)}
                        <div class="form-inline float-right">
                            <div class="tool-tip">
                                <a href="{$render->getUrl(404)}">
                                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__settings__system__menu_cache')}</span>
                                </a>
                            </div>
                        </div>
                    {/if}
                </div>
                <div class="card-body">
                    <div>
                        {$strings->get('admin__settings__system__cache_expire')}
                    </div>
                    <div class="text-secondary">{$core__config->cacheExpire}</div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->appCache} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__app_cache')}
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->fileCache} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__file_cache')}
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->directoryCache} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__directory_cache')}
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->stringCache} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__string_cache')}
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->jsCache} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__js_cache')}
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->cssCache} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__css_cache')}
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->minify} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__minify')}
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->compressor} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__compressor')}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {* User settings *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="mt-2">
                        {$strings->get('admin__settings__system__user')}
                    </h5>
                </div>
                <div class="card-body">
                    <div>
                        {$strings->get('admin__settings__system__user_regex')}
                    </div>
                    <div class="text-secondary">
                        {foreach from=$core__config->userRegexApplication item="admin__settings__system__user_regex"}
                            {$admin__settings__system__user_regex}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {/foreach}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__pass_regex')}</div>
                    <div class="text-secondary">
                        {foreach from=$core__config->passRegexApplication item="admin__settings__system__pass_regex"}
                            {$admin__settings__system__pass_regex}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {/foreach}</div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__user_error_count')}
                    </div>
                    <div class="text-secondary">
                        {$core__config->signInErrorCount}
                    </div>
                </div>
            </div>
        </div>

        {* Files settings *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="mt-2">
                        {$strings->get('admin__settings__system__files')}
                    </h5>
                </div>
                <div class="card-body">
                    <div>
                        {$strings->get('admin__settings__system__files_dir')}
                    </div>
                    {foreach from=$core__config->getFilesDirectories() item="admin__settings__system__directories"}
                        <div class="text-secondary">
                            {$admin__settings__system__directories}
                        </div>
                    {/foreach}
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__files_types')}
                    </div>
                    <div class="text-secondary">
                        {foreach from=$core__config->getFilesTypes() item="admin__settings__system__types"}
                            {$admin__settings__system__types}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {/foreach}
                    </div>
                    <div class="mt-4">
                        {$strings->get('admin__settings__system__max_size')}
                    </div>
                    <div class="text-secondary">
                        {$admin__settings__system__model->getMaxUploadSize()}
                    </div>
                </div>
            </div>
        </div>

        {* Debugging settings *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-md-6 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="float-left mt-2 mr-4">
                        {$strings->get('admin__settings__system__debugging')}
                    </h5>
                    {if $render->getUrl(406)}
                        <div class="form-inline float-right">
                            <div class="tool-tip">
                                <a href="{$render->getUrl(406)}">
                                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__settings__system__menu_debug')}</span>
                                </a>
                            </div>
                        </div>
                    {/if}
                </div>
                <div class="card-body">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->debug} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__debug_mode')}
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input" disabled{if $core__config->debugAjax} checked{/if}>
                        <label class="form-check-label text-dark">
                            {$strings->get('admin__settings__system__debug_ajax')}
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>