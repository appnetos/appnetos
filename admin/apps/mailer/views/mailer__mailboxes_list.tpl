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
 * @description     Mailer logs, blacklist, settings, mailboxes.
 *}

{* Info *}
{if $admin__mailer__mailer__model->getInfoAdmin()}
    <div class="col-12 mt-4 text-justify info-hide">
        {$strings->get('admin__mailer__mailer__mailboxes__info')}
    </div>
{/if}

{* AJAX error *}
{if $admin__mailer__mailer__mailboxes_list->ajaxError}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__mailer__mailer__mailboxes_list->ajaxError}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__mailer__mailer__mailboxes_list->ajaxConfirm}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__mailer__mailer__mailboxes_list->ajaxConfirm}
        </div>
    </div>
{/if}

{* If mailbxes available *}
{if $admin__mailer__mailer__mailboxes_list->mailboxesList|@count > 0}

    {* Modal delete *}
    <div class="modal fade" id="admin__mailer__mailer__modal_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('admin__mailer__mailer__mailboxes_delete_header')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-secondary text-justify">
                        {$strings->get('admin__mailer__mailer__mailboxes__delete_info')}
                    </div>
                    <div class="mt-3 text-right">
                        <button type="button" class="btn btn-danger" onclick="admin__mailer__mailer.de()">
                            {$strings->get('admin__mailer__mailer__delete')}
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('admin__mailer__mailer__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {* List URIs *}
    {foreach from=$admin__mailer__mailer__mailboxes_list->mailboxesList item=$admin__mailer__mailer__mailbox}
        {$admin__mailer__mailer__model->assign('admin__mailer__mailer__mailbox', $admin__mailer__mailer__mailbox)}
        {$render->include('admin/apps/mailer/views/mailer__mailbox.tpl')}
    {/foreach}

{* If no entries available *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-warning m-0">
            {$strings->get('admin__mailer__mailer__mailboxes_no_mailboxes')}
        </div>
    </div>

{/if}