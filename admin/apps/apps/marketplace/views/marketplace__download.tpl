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
 * @description     APPNET OS Marketplace.
 *}

{* Download *}
<div class="col-12 mt-4" data-type="admin__apps__management__app">
    <div class="card admin__apps__marketplace__flex">

        {* Modal on install *}
        {if $admin__apps__marketplace__download->downloadStatus === 'none'}
            <div class="modal fade" id="admin__apps__marketplace__modal_{$admin__apps__marketplace__download->id}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-light">
                            <h5 class="modal-title">
                                {$strings->get('admin__apps__marketplace__download_and_install')}
                            </h5>
                            <button data-type="button-close" type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div data-type="element-text">
                                {if $admin__apps__marketplace__download->installWarning}
                                    <div class="alert alert-danger admin__apps__marketplace__modal_install_warning mb-4">
                                        {$admin__apps__marketplace__download->installWarning}
                                    </div>
                                {/if}
                                {$strings->get('admin__apps__marketplace__install_text')}
                                <div class="mt-4 text-right">
                                    {if $admin__apps__marketplace__download->installWarning}
                                        <button class="btn btn-danger" onclick="admin__apps__marketplace.in('{$admin__apps__marketplace__download->id}')">
                                            {$strings->get('admin__apps__marketplace__download_and_install')}
                                        </button>
                                    {else}
                                        <button class="btn btn-primary" onclick="admin__apps__marketplace.in('{$admin__apps__marketplace__download->id}')">
                                            {$strings->get('admin__apps__marketplace__download_and_install')}
                                        </button>
                                    {/if}
                                </div>
                            </div>
                            <div class="text-center mt-4" data-type="element-loading" style="display:none">
                                <img src="{$render->getUrl()}/out/admin/img/appnetos/loading.gif">
                                <h5 class="mt-4">
                                    {$strings->get('admin__apps__marketplace__installation')}
                                </h5>
                                <div class="mb-4">
                                    {$strings->get('admin__apps__marketplace__please_wait')}
                                </div>
                            </div>
                            <div data-type="element-error" style="display:none">
                                <div class="alert alert-danger admin__apps__marketplace__modal_install_warning mb-4">
                                </div>
                                <div class="mt-4 text-right">
                                    <button class="btn btn-primary" onclick="admin__apps__marketplace.ln()">
                                        {$strings->get('admin__apps__marketplace__next')}
                                    </button>
                                </div>
                            </div>
                            <div data-type="element-success" style="display:none">
                                <div class="alert alert-success admin__apps__marketplace__modal_install_warning mb-4">
                                    {$strings->get('admin__apps__marketplace__conf_install')}
                                </div>
                                <div class="mt-4 text-right">
                                    <button class="btn btn-primary" onclick="admin__apps__marketplace.ln()">
                                        {$strings->get('admin__apps__marketplace__next')}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button data-type="button-close" type="button" class="btn btn-secondary" data-dismiss="modal">
                                {$strings->get('admin__apps__marketplace__close')}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        {/if}

        {* Modal on update *}
        {if $admin__apps__marketplace__download->downloadStatus === 'lower' || $admin__apps__marketplace__download->downloadStatus === 'unknown'}
            <div class="modal fade" id="admin__apps__marketplace__modal_{$admin__apps__marketplace__download->id}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-light">
                            <h5 class="modal-title">
                                {$strings->get('admin__apps__marketplace__download_and_update')}
                            </h5>
                            <button data-type="button-close" type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div data-type="element-text">
                                {if $admin__apps__marketplace__download->installWarning}
                                    <div class="alert alert-danger admin__apps__marketplace__modal_install_warning mb-4">
                                        {$admin__apps__marketplace__download->installWarning}
                                    </div>
                                {/if}
                                {$strings->get('admin__apps__marketplace__install_text')}
                                <div class="mt-4 text-right">
                                    {if $admin__apps__marketplace__download->installWarning}
                                        <button class="btn btn-danger" onclick="admin__apps__marketplace.up('{$admin__apps__marketplace__download->id}')">
                                            {$strings->get('admin__apps__marketplace__download_and_update')}
                                        </button>
                                    {else}
                                        <button class="btn btn-primary" onclick="admin__apps__marketplace.up('{$admin__apps__marketplace__download->id}')">
                                            {$strings->get('admin__apps__marketplace__download_and_update')}
                                        </button>
                                    {/if}
                                </div>
                            </div>
                            <div class="text-center mt-4" data-type="element-loading" style="display:none">
                                <img src="{$render->getUrl()}/out/admin/img/appnetos/loading.gif">
                                <h5 class="mt-4">
                                    {$strings->get('admin__apps__marketplace__installation')}
                                </h5>
                                <div class="mb-4">
                                    {$strings->get('admin__apps__marketplace__please_wait')}
                                </div>
                            </div>
                            <div data-type="element-error" style="display:none">
                                <div class="alert alert-danger admin__apps__marketplace__modal_install_warning mb-4">
                                </div>
                                <div class="mt-4 text-right">
                                    <button class="btn btn-primary" onclick="admin__apps__marketplace.ln()">
                                        {$strings->get('admin__apps__marketplace__next')}
                                    </button>
                                </div>
                            </div>
                            <div data-type="element-success" style="display:none">
                                <div class="alert alert-success admin__apps__marketplace__modal_install_warning mb-4">
                                    {$strings->get('admin__apps__marketplace__conf_update')}
                                </div>
                                <div class="mt-4 text-right">
                                    <button class="btn btn-primary" onclick="admin__apps__marketplace.ln()">
                                        {$strings->get('admin__apps__marketplace__next')}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button data-type="button-close" type="button" class="btn btn-secondary" data-dismiss="modal">
                                {$strings->get('admin__apps__marketplace__close')}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        {/if}

        {* Modal on override *}
        {if $admin__apps__marketplace__download->downloadStatus === 'other_status'}
            <div class="modal fade" id="admin__apps__marketplace__modal_{$admin__apps__marketplace__download->id}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-light">
                            <h5 class="modal-title">
                                {$strings->get('admin__apps__marketplace__download_and_overwrite')}
                            </h5>
                            <button data-type="button-close" type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div data-type="element-text">
                                {if $admin__apps__marketplace__download->installWarning}
                                    <div class="alert alert-danger admin__apps__marketplace__modal_install_warning mb-4">
                                        {$admin__apps__marketplace__download->installWarning}
                                    </div>
                                {/if}
                                {$strings->get('admin__apps__marketplace__install_text')}
                                <div class="mt-4 text-right">
                                    <button class="btn btn-danger" onclick="admin__apps__marketplace.up('{$admin__apps__marketplace__download->id}')">
                                        {$strings->get('admin__apps__marketplace__download_and_overwrite')}
                                    </button>
                                </div>
                            </div>
                            <div class="text-center mt-4" data-type="element-loading" style="display:none">
                                <img src="{$render->getUrl()}/out/admin/img/appnetos/loading.gif">
                                <h5 class="mt-4">
                                    {$strings->get('admin__apps__marketplace__installation')}
                                </h5>
                                <div class="mb-4">
                                    {$strings->get('admin__apps__marketplace__please_wait')}
                                </div>
                            </div>
                            <div data-type="element-error" style="display:none">
                                <div class="alert alert-danger admin__apps__marketplace__modal_install_warning mb-4">
                                </div>
                                <div class="mt-4 text-right">
                                    <button class="btn btn-primary" onclick="admin__apps__marketplace.ln()">
                                        {$strings->get('admin__apps__marketplace__next')}
                                    </button>
                                </div>
                            </div>
                            <div data-type="element-success" style="display:none">
                                <div class="alert alert-success admin__apps__marketplace__modal_install_warning mb-4">
                                    {$strings->get('admin__apps__marketplace__conf_update')}
                                </div>
                                <div class="mt-4 text-right">
                                    <button class="btn btn-primary" onclick="admin__apps__marketplace.ln()">
                                        {$strings->get('admin__apps__marketplace__next')}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button data-type="button-close" type="button" class="btn btn-secondary" data-dismiss="modal">
                                {$strings->get('admin__apps__marketplace__close')}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        {/if}

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="float-left mt-2 mr-4">
                {if $admin__apps__marketplace__download->image}
                    <img class="admin__apps__marketplace__image rounded mr-2" src="{$admin__apps__marketplace__download->image}">
                {/if}
                {$admin__apps__marketplace__download->appnetosName}
            </h5>
            <div class="form-inline float-right">

                {* Download and install *}
                {if $admin__apps__marketplace__download->downloadStatus === 'none'}
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" data-toggle="modal" data-target="#admin__apps__marketplace__modal_{$admin__apps__marketplace__download->id}">
                            <i class="fas fa-download"></i>
                        </button>
                        <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__marketplace__download_and_install')}</span>
                    </div>
                {/if}

                {* Download and update *}
                {if $admin__apps__marketplace__download->downloadStatus === 'lower' || $admin__apps__marketplace__download->downloadStatus === 'unknown'}
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" data-toggle="modal" data-target="#admin__apps__marketplace__modal_{$admin__apps__marketplace__download->id}">
                            <i class="fas fa-sync"></i>
                        </button>
                        {if $admin__apps__marketplace__download->installWarning}
                            <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__apps__marketplace__download_and_update')}</span>
                        {else}
                            <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__marketplace__download_and_update')}</span>
                        {/if}
                    </div>
                {/if}

                {* Download and override *}
                {if $admin__apps__marketplace__download->downloadStatus === 'other_status'}
                    <div class="tool-tip">
                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" data-toggle="modal" data-target="#admin__apps__marketplace__modal_{$admin__apps__marketplace__download->id}">
                            <i class="fas fa-sync"></i>
                        </button>
                        <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__apps__marketplace__download_and_overwrite')}</span>
                    </div>
                {/if}

                {* Info on install *}
                {if !$admin__apps__marketplace__download->installStatus && $admin__apps__marketplace__download->downloadStatus !== 'unknown' && $admin__apps__marketplace__download->downloadStatus !== 'none'}
                    {assign var='admin__apps__marketplace__install_url' value=$render->getUrl(305)}
                    {if $admin__apps__marketplace__install_url}
                        <div class="tool-tip">
                            <a href="{$admin__apps__marketplace__install_url}">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                    <i class="fas fa-question-circle"></i>
                                </button>
                            </a>
                            <span class="tool-tip-text bg-primary text-light">{$strings->get('admin__apps__marketplace__info_install')}</span>
                        </div>
                    {/if}
                {/if}

            </div>
        </div>

        {* Body *}
        <div class="card-body bg-light text-dark">

            {* Install warning *}
            {if $admin__apps__marketplace__download->installWarning}
                <div class="alert alert-danger admin__apps__marketplace__install_warning mb-4">
                    {$admin__apps__marketplace__download->installWarning}
                </div>
            {/if}

            <div class="row">

                {* App data *}
                <div class="col-12 col-md-4">
                    <div>
                        {$strings->get('admin__apps__marketplace__version')}
                    </div>
                    <div class="text-secondary">
                        {$admin__apps__marketplace__download->version} {$admin__apps__marketplace__download->versionStatus}
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div>
                        {$strings->get('admin__apps__marketplace__size')}
                    </div>
                    <div class="text-secondary">
                        {$admin__apps__marketplace__download->size}
                    </div>
                </div>

                <div class="col-12 col-md-4 text-right">

                    {* Download status *}
                    <div class="mb-2">
                        {if $admin__apps__marketplace__download->downloadStatus === 'higher'}
                            <span class="bg-success text-light rounded py-1 px-2">
                                {$strings->get('admin__apps__marketplace__download_status_higher')}
                            </span>
                        {elseif $admin__apps__marketplace__download->downloadStatus === 'lower'}
                            <span class="bg-warning text-light rounded py-1 px-2">
                                {$strings->get('admin__apps__marketplace__download_status_lower')}
                            </span>
                        {elseif $admin__apps__marketplace__download->downloadStatus === 'same'}
                        <span class="bg-success text-light rounded py-1 px-2">
                                {$strings->get('admin__apps__marketplace__download_status_same')}
                            </span>
                        {elseif $admin__apps__marketplace__download->downloadStatus === 'unknown'}
                            <span class="bg-danger text-light rounded py-1 px-2">
                                {$strings->get('admin__apps__marketplace__download_status_unknown')}
                            </span>
                        {elseif $admin__apps__marketplace__download->downloadStatus === 'none'}
                            <span class="bg-warning text-light rounded py-1 px-2">
                                {$strings->get('admin__apps__marketplace__download_status_none')}
                            </span>
                        {elseif $admin__apps__marketplace__download->downloadStatus === 'other_status'}
                            <span class="bg-danger text-light rounded py-1 px-2">
                                {$strings->get('admin__apps__marketplace__download_status_other')}
                            </span>
                        {/if}
                    </div>

                    {* Install status *}
                    <div>
                        {if $admin__apps__marketplace__download->installStatus}
                            <span class="bg-success text-light rounded py-1 px-2">
                                {$strings->get('admin__apps__marketplace__install_status_true')}
                            </span>
                        {else}
                            <span class="bg-warning text-light rounded py-1 px-2">
                                {$strings->get('admin__apps__marketplace__install_status_false')}
                            </span>
                        {/if}
                    </div>

                </div>

                {* Consisting data *}
                {if $admin__apps__marketplace__download->marketplaceData}
                    <div class="col-12">
                        <hr class="admin__apps__marketplace__hr">
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div>
                            {$strings->get('admin__apps__marketplace__consisting_version')}
                        </div>
                        <div class="text-secondary">
                            {if $admin__apps__marketplace__download->marketplaceData && $admin__apps__marketplace__download->marketplaceData->version}
                                {$admin__apps__marketplace__download->marketplaceData->version}
                                {if $admin__apps__marketplace__download->marketplaceData->versionStatus}
                                    {$admin__apps__marketplace__download->marketplaceData->versionStatus}
                                {/if}
                            {else}
                                {$strings->get('admin__apps__marketplace__unknown')}
                            {/if}
                        </div>
                    </div>
                {/if}

                {* Consisting IDs *}
                {if $admin__apps__marketplace__download->getConsistingIds()}
                    <div class="col-12 col-md-10 mt-4">
                        {$strings->get('admin__apps__marketplace__app_id')}: {$admin__apps__marketplace__download->getConsistingIds()}
                    </div>
                {/if}

            </div>

        </div>

    </div>
</div>