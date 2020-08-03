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
 * @description     Admin files management. Create and delete folders. Upload and delete files. The folders to manage
 *                  files in the files manager must be defined in the config.inc.php.
 *}

{* AJAX error *}
{if $admin__files__management->ajaxError}
    <div id="admin__files__management__ajax_error" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-danger m-0">
                {$admin__files__management->ajaxError}
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__files__management->ajaxConfirm}
    <div id="admin__files__management__ajax_confirm" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-success m-0">
                {$admin__files__management->ajaxConfirm}
            </div>
        </div>
    </div>
{/if}

{* List *}
{if $admin__files__management->path}
    <div id="admin__files__management__path" class="d-none">
        {$admin__files__management->path}
    </div>
    <div id="admin__files__management__max_upload_size" class="d-none">
        {$admin__files__management->getMaxUploadSize()}
    </div>
    <div id="admin__files__management__max_upload_err" class="d-none">
        {$strings->get('admin__files__mgnt__err_to_large')}
    </div>
    <div id="admin__files__management__files_types" class="d-none">
        {$admin__files__management->getFilesTypes()}
    </div>
    <div id="admin__files__management__files_types_err" class="d-none">
        {$strings->get('admin__files__mgnt__err_format')}
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <form id="admin__files__management__upload" method="post" enctype="multipart/form-data">
                    <div id="admin__files__management__dropzone" class="card-body bg-light text-center p-0 admin__files__management__drop_zone">
                        <input id="admin__files__management__upload_path" name="path" value="{$admin__files__management->path}" type="hidden" />
                        <i class="fa fa-arrow-circle-down admin__files__management__drop_icon mt-4"></i>
                        <h5 class="mt-2">
                            {$strings->get('admin__files__mgnt__drop')}
                        </h5>
                        <div class="admin__files__management__margin"></div>
                        <input id="admin__files__management__upload_btn" class="d-none" type="file" name="upl" multiple onclick="admin__files__management__upload_btn_click(event);" />
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 mt-4">
            <form method="post">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h5 class="card-title mt-2 mr-4 float-left">
                            {$admin__files__management->path}
                        </h5>
                        <div class="form-inline float-right text-light">
                            <div class="tool-tip">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__files__management__delete_directory('{$admin__files__management->path}');">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <span class="tool-tip-text bg-danger text-light">
                                    {$strings->get('admin__files__mgnt__delete_directory')}
                                </span>
                            </div>
                            <div class="tool-tip">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__files__management__rename_directory('{$admin__files__management->getDirectoryName()}')">
                                    <i class="far fa-edit"></i>
                                </button>
                                <span class="tool-tip-text bg-primary text-light">
                                    {$strings->get('admin__files__mgnt__rename_directory')}
                                </span>
                            </div>
                            <div class="tool-tip">
                                <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__files__management__add_directory()">
                                    <i class="fas fa-plus"></i></i>
                                </button>
                                <span class="tool-tip-text bg-primary text-light">
                                    {$strings->get('admin__files__mgnt__add_directory')}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        {assign var='admin__files__management__files' value=$admin__files__management->getFiles()}
                        {if $admin__files__management__files}
                            <ul class="list-group">
                                {foreach from=$admin__files__management__files item='admin__files__management__file'}
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="float-left">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" data-file="{$admin__files__management__file}" onclick="admin__files__management__select(this, event)">
                                                <a href="{$render->getUrl()}/{$admin__files__management->path}/{$admin__files__management__file}" target="_blank">
                                                    {$admin__files__management__file}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-inline float-right text-light">
                                            <div class="tool-tip">
                                                <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__files__management__delete_file('{$admin__files__management__file}');">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__files__mgnt__delete_file')}</span>
                                            </div>
                                            <div class="tool-tip">
                                                <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__files__management__rename_file('{$admin__files__management__file}')">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <span class="tool-tip-text bg-primary text-light">
                                                    {$strings->get('admin__files__mgnt__rename_file')}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                {/foreach}
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="float-left">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" data-files-all="true" onclick="admin__files__management__select_all()">
                                            <div>
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-inline float-right text-light">
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="admin__files__management__delete_selection();">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <span class="tool-tip-text bg-danger text-light">
                                                {$strings->get('admin__files__mgnt__delete_selection')}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        {else}
                            <div class="alert alert-warning m-0">
                                {$strings->get('admin__files__mgnt__no_files')}
                            </div>
                        {/if}
                    </div>
                </div>
            </form>
        </div>
    </div>
{/if}