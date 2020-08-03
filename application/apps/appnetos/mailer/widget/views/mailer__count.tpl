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
 * @description     Allows other apps to send messages through the set-up mailmail mailboxes. Creates logs for advanced
 *                  information and a widget for the dashboard.
*}

{* AJAX confirm *}
{if $appnetos__mailer->ajaxConfirm}
    <div id="appnetos__mailer__confirm" class="alert alert-success m-0" style="display: none">
        {$strings->get('appnetos__mailer__widget_conf_counter_reset')}
    </div>
{/if}

<div>
    <ul class="list-group">

        {* Log count *}
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {$strings->get('appnetos__mailer__widget_sent')}
            <span class="badge badge-success badge-pill rounded">{$appnetos__mailer->confirmCount}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {$strings->get('appnetos__mailer__widget_failed')}
            <span class="badge badge-danger badge-pill rounded">{$appnetos__mailer->errorCount}</span>
        </li>

        {* Last error log *}
        {if $appnetos__mailer->errorLog}
            <div class="list-group-item">
                <div class="text-danger">
                    <strong>{$strings->get('appnetos__mailer__widget_last_failed')}</strong>
                </div>
                <div class="mt-2">
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_mailbox')}:</strong> {$appnetos__mailer__logs_list->getMailboxName($appnetos__mailer->errorLog->mailboxUuid)}
                    </div>
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_datetime')}:</strong> {$appnetos__mailer->errorLog->timestamp|date_format:"%A, %B %e, %Y, %H:%M:%S"}
                    </div>
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_address')}:</strong> {$appnetos__mailer->errorLog->address}
                    </div>
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_ip')}:</strong> {$appnetos__mailer->errorLog->ip}
                    </div>
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_message')}:</strong> {$strings->get($appnetos__mailer->errorLog->message)}{if $appnetos__mailer->errorLog->phpMailerInfo}: {$appnetos__mailer->errorLog->phpMailerInfo}{/if}
                    </div>
                </div>
            </div>
        {/if}

        {* Last confirm log *}
        {if $appnetos__mailer->confirmLog}
            <div class="list-group-item">
                <div class="text-success">
                    <strong>{$strings->get('appnetos__mailer__widget_last_sent')}</strong>
                </div>
                <div class="mt-2">
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_mailbox')}:</strong> {$appnetos__mailer__logs_list->getMailboxName($appnetos__mailer->confirmLog->mailboxUuid)}
                    </div>
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_datetime')}:</strong> {$appnetos__mailer->confirmLog->timestamp|date_format:"%A, %B %e, %Y, %H:%M:%S"}
                    </div>
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_address')}:</strong> {$appnetos__mailer->confirmLog->address}
                    </div>
                    <div>
                        <strong>{$strings->get('appnetos__mailer__widget_ip')}:</strong> {$appnetos__mailer->confirmLog->ip}
                    </div>
                </div>
            </div>
        {/if}

    </ul>
</div>