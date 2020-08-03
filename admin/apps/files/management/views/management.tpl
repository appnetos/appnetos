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

{* Modal upload *}
<div class="modal fade" id="admin__files__management__modal_upload" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light border-bottom-0">
                <h4 class="modal-title">
                    {$strings->get('admin__files__mgnt__upload')}
                </h4>
                <button data-btn-close="true" type="button" class="close" data-dismiss="modal" aria-label="Close" style="display: none;">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <ul id="admin__files__management__upload_list" class="list-group">

                </ul>
            </div>
            <div class="modal-footer bg-light border-top-0">
                <button data-btn-abort="true" type="button" class="btn btn-danger" onclick="admin__files__management__cancel_all()">
                    {$strings->get('admin__files__mgnt__cancel')}
                </button>
                <button data-btn-close="true" type="button" class="btn btn-secondary" data-dismiss="modal" style="display: none;">
                    {$strings->get('admin__files__mgnt__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal delete files *}
<div class="modal fade" id="admin__files__management__modal_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h4 class="modal-title">
                    {$strings->get('admin__files__mgnt__delete_header')}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-secondary text-justify">
                    {$strings->get('admin__files__mgnt__delete_info')}
                </div>
                <div class="mt-3 text-right">
                    <button type="button" class="btn btn-danger" onclick="admin__files__management__delete_conf()">
                        {$strings->get('admin__files__mgnt__delete')}
                    </button>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('admin__files__mgnt__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal rename directory *}
<div class="modal fade" id="admin__files__management__modal_rename_directory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h4 class="modal-title">
                    {$strings->get('admin__files__mgnt__rename_directory')}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>
                    {$strings->get('admin__files__mgnt__new_name')}
                </h5>
                <input id="admin__files__management__rename_directory_name" type="text" class="form-control" placeholder="{$strings->get('admin__files__mgnt__new_name')}" onkeydown="admin__files__management__rename_directory_keydown(event)">
                <div class="mt-3 text-right">
                    <button type="button" class="btn btn-primary" onclick="admin__files__management__rename_directory_exec()">
                        {$strings->get('admin__files__mgnt__save')}
                    </button>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('admin__files__mgnt__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal rename file *}
<div class="modal fade" id="admin__files__management__modal_rename_file" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h4 class="modal-title">
                    {$strings->get('admin__files__mgnt__rename_file')}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>
                    {$strings->get('admin__files__mgnt__new_name')}
                </h5>
                <input id="admin__files__management__rename_file_name" type="text" class="form-control" placeholder="{$strings->get('admin__files__mgnt__new_name')}" onkeydown="admin__files__management__rename_file_keydown(event)">
                <div class="mt-3 text-right">
                    <button type="button" class="btn btn-primary" onclick="admin__files__management__rename_file_exec()">
                        {$strings->get('admin__files__mgnt__save')}
                    </button>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('admin__files__mgnt__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal add directory *}
<div class="modal fade" id="admin__files__management__modal_add_directory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h4 class="modal-title">
                    {$strings->get('admin__files__mgnt__add_directory')}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>
                    {$strings->get('admin__files__mgnt__name')}
                </h5>
                <input id="admin__files__management__add_directory_name" type="text" class="form-control" placeholder="{$strings->get('admin__files__mgnt__name')}" onkeydown="admin__files__management__add_directory_keydown(event)">
                <div class="mt-3 text-right">
                    <button type="button" class="btn btn-primary" onclick="admin__files__management__add_directory_conf()">
                        {$strings->get('admin__files__mgnt__add')}
                    </button>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('admin__files__mgnt__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal delete directory *}
<div class="modal fade" id="admin__files__management__modal_delete_directory" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h4 class="modal-title">
                    {$strings->get('admin__files__mgnt__delete_directory')}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-secondary text-justify">
                    {$strings->get('admin__files__mgnt__delete_dir_info')}
                </div>
                <div class="mt-3 text-right">
                    <button type="button" class="btn btn-danger" onclick="admin__files__management__delete_directory_conf()">
                        {$strings->get('admin__files__mgnt__delete')}
                    </button>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('admin__files__mgnt__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Hidden text elements *}
<div class="d-none">
    <div id="admin__files__management__text_cancel">
        {$strings->get('admin__files__mgnt__cancel')}
    </div>
</div>

{* Menu *}
{$render->include('admin/apps/files/management/views/menu.tpl')}
<div class="container-sidebar">

    {* Info *}
    {if $admin__info}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 mt-4 text-justify">
                    {$strings->get('admin__files__mgnt__info')}
                </div>
            </div>
        </div>
    {/if}

    {* List *}
    <div class="container">
        <div id="admin__files__management__list">
            {$render->include('admin/apps/files/management/views/list.tpl')}
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>
