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
        {$strings->get('admin__mailer__mailer__logs__info')}
    </div>
{/if}

{* AJAX error *}
{if $admin__mailer__mailer__logs_list->getAjaxError()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__mailer__mailer__logs_list->getAjaxError()}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__mailer__mailer__logs_list->getAjaxConfirm()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__mailer__mailer__logs_list->getAjaxConfirm()}
        </div>
    </div>
{/if}

{* Modal delete *}
<div class="modal fade" id="admin__mailer__mailer__modal_clear" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title d-none" data-type="admin__mailer__mailer__modal_clear__error">
                    {$strings->get('admin__mailer__mailer__logs__clear_error')}
                </h5>
                <h5 class="modal-title d-none" data-type="admin__mailer__mailer__modal_clear__confirm">
                    {$strings->get('admin__mailer__mailer__logs__clear_confirm')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-secondary text-justify">
                    {$strings->get('admin__mailer__mailer__logs__clear_info')}
                </div>
                <div class="mt-3 text-right">
                    <button type="button" class="btn btn-danger" onclick="admin__mailer__mailer.cl()">
                        {$strings->get('admin__mailer__mailer__logs__clear')}
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

{* Error logs *}
<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-4">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="float-left mt-2 mr-4">
                {$strings->get('admin__mailer__mailer__logs__header_error')}
            </h5>
            <div class="form-inline float-right">
                <div class="tool-tip">
                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__mailer__mailer.ce()">
                        <i class="fa fa-trash"></i>
                    </button>
                    <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__mailer__mailer__logs__clear_error')}</span>
                </div>
            </div>
        </div>

        {* Error logs list *}
        <div class="card-body p-0">

            {* If entry exists *}
            {if $admin__mailer__mailer__logs_list->errorsList|count !== 0}

                {foreach from=$admin__mailer__mailer__logs_list->errorsList item="admin__mailer__mailer__logs_error"}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="text-danger px-4 py-3">
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__mailbox')}:</strong> {$admin__mailer__mailer__logs_list->getMailboxName($admin__mailer__mailer__logs_error->mailboxUuid)}
                                </div>
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__logs__datetime')}:</strong> {$admin__mailer__mailer__logs_error->timestamp|date_format:"%A, %B %e, %Y, %H:%M:%S"}
                                </div>
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__email')}:</strong> {$admin__mailer__mailer__logs_error->address}
                                </div>
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__ip')}:</strong> {$admin__mailer__mailer__logs_error->ip}
                                </div>
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__logs__message')}:</strong> {$strings->get($admin__mailer__mailer__logs_error->message)}{if $admin__mailer__mailer__logs_error->phpMailerInfo}: {$admin__mailer__mailer__logs_error->phpMailerInfo}{/if}
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}

            {* If not entry exists *}
            {else}

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning m-0">
                            {$strings->get('admin__mailer__mailer__no_entries')}
                        </div>
                    </div>
                </div>

            {/if}

        </div>

    </div>
</div>

{* Confirm logs *}
<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-4">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="float-left mt-2 mr-4">
                {$strings->get('admin__mailer__mailer__logs__header_confirm')}
            </h5>
            <div class="form-inline float-right">
                <div class="tool-tip">
                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__mailer__mailer.ce()">
                        <i class="fa fa-trash"></i>
                    </button>
                    <span class="tool-tip-text bg-danger text-light">{$strings->get('admin__mailer__mailer__logs__clear_confirm')}</span>
                </div>
            </div>
        </div>

        {* Confirm logs list *}
        <div class="card-body p-0">

            {* If entry exists *}
            {if $admin__mailer__mailer__logs_list->confirmsList|count !== 0}

                {foreach from=$admin__mailer__mailer__logs_list->confirmsList item="admin__mailer__mailer__logs_confirm"}
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="text-success px-4 py-3">
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__mailbox')}:</strong> {$admin__mailer__mailer__logs_list->getMailboxName($admin__mailer__mailer__logs_confirm->mailboxUuid)}
                                </div>
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__logs__datetime')}:</strong> {$admin__mailer__mailer__logs_confirm->timestamp|date_format:"%A, %B %e, %Y, %H:%M:%S"}
                                </div>
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__email')}:</strong> {$admin__mailer__mailer__logs_confirm->address}
                                </div>
                                <div>
                                    <strong>{$strings->get('admin__mailer__mailer__ip')}:</strong> {$admin__mailer__mailer__logs_confirm->ip}
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}

            {* If not entry exists *}
            {else}

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning m-0">
                            {$strings->get('admin__mailer__mailer__no_entries')}
                        </div>
                    </div>
                </div>

            {/if}

        </div>

    </div>
</div>