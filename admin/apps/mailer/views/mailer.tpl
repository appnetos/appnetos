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

{* Menu *}
{$render->include('admin/apps/mailer/views/mailer__menu.tpl')}

<div class="container-sidebar">

    {* Modal add *}
    {if $admin__mailer__mailer__model->part === 'mailboxes'}
        <div class="modal fade" id="admin__mailer__mailer__mailboxes__modal_add" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title">
                            {$strings->get('admin__mailer__mailer__mailboxes__add')}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>
                            {$strings->get('admin__mailer__mailer__mailboxes__name')}
                        </label>
                        <input id="admin__mailer__mailer__mailboxes__add_name" type="text" class="form-control" value="" placeholder="{$strings->get('admin__mailer__mailer__mailboxes__name')}">
                        <label class="mt-4">
                            {$strings->get('admin__mailer__mailer__mailboxes__mail')}
                        </label>
                        <input id="admin__mailer__mailer__mailboxes__add_address" type="email" class="form-control" value="" placeholder="{$strings->get('admin__mailer__mailer__mailboxes__mail')}">
                        <label class="mt-4">
                            {$strings->get('admin__mailer__mailer__mailboxes__host')}
                        </label>
                        <input id="admin__mailer__mailer__mailboxes__add_host" type="text" class="form-control" value="" placeholder="{$strings->get('admin__mailer__mailer__mailboxes__host')}">
                        <label class="mt-4">
                            {$strings->get('admin__mailer__mailer__mailboxes__port')}
                        </label>
                        <input id="admin__mailer__mailer__mailboxes__add_port" type="number" class="form-control" value="25" placeholder="{$strings->get('admin__mailer__mailer__mailboxes__port')}">
                        <label class="mt-4">
                            {$strings->get('admin__mailer__mailer__mailboxes__user')}
                        </label>
                        <input id="admin__mailer__mailer__mailboxes__add_user" type="text" class="form-control" value="" placeholder="{$strings->get('admin__mailer__mailer__mailboxes__user')}">
                        <label class="mt-4">
                            {$strings->get('admin__mailer__mailer__mailboxes__pass')}
                        </label>
                        <input id="admin__mailer__mailer__mailboxes__add_pass" type="password" class="form-control" value="" placeholder="{$strings->get('admin__mailer__mailer__mailboxes__pass')}">
                        <label class="mt-4">
                            {$strings->get('admin__mailer__mailer__mailboxes__timeout')}
                        </label>
                        <input id="admin__mailer__mailer__mailboxes__add_timeout" type="number" class="form-control" value="30" placeholder="{$strings->get('admin__mailer__mailer__mailboxes__timeout')}">
                        <div class="form-check mt-4">
                            <label class="form-check-label">
                                <input id="admin__mailer__mailer__mailboxes__add_is_smtp" type="checkbox" class="form-check-input">
                                {$strings->get('admin__mailer__mailer__mailboxes__is_smtp')}
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <label class="form-check-label">
                                <input id="admin__mailer__mailer__mailboxes__add_smtp_auth" type="checkbox" class="form-check-input">
                                {$strings->get('admin__mailer__mailer__mailboxes__smtp_auth')}
                            </label>
                        </div>
                        <div class="form-group mt-4">
                            <label>
                                {$strings->get('admin__mailer__mailer__mailboxes__secure')}
                            </label>
                            <select class="form-control" id="admin__mailer__mailer__mailboxes__add_smtp_secure">
                                <option value="none">{$strings->get('admin__mailer__mailer__mailboxes__none')}</option>
                                <option value="tls">tls</option>
                                <option value="ssl">ssl</option>
                            </select>
                        </div>
                        <label class="mt-4">
                            {$strings->get('admin__mailer__mailer__mailboxes_firewall')}
                        </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="admin__mailer__mailer__mailboxes__add_firewall" id="admin__mailer__mailer__mailboxes__add_firewall_1" value="1" checked>
                            <label class="form-check-label" for="admin__mailer__mailer__mailboxes__add_firewall_1">
                                {$strings->get('admin__mailer__mailer__mailboxes_firewall_true')}
                            </label>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="admin__mailer__mailer__mailboxes__add_firewall" id="admin__mailer__mailer__mailboxes__add_firewall_2" value="2">
                            <label class="form-check-label" for="admin__mailer__mailer__mailboxes__add_firewall_2">
                                {$strings->get('admin__mailer__mailer__mailboxes_firewall_false')}
                            </label>
                        </div>
                        <label>
                            {$strings->get('admin__mailer__mailer__mailboxes_from_name')}
                        </label>
                        <input id="admin__mailer__mailer__mailboxes__add_from_name" type="text" class="form-control" value="" placeholder="{$strings->get('admin__mailer__mailer__mailboxes_from_name')}">
                        <div class="mt-3 text-right">
                            <button type="button" class="btn btn-primary" onclick="admin__mailer__mailer.nm();">
                                {$strings->get('admin__mailer__mailer__add')}
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
    {/if}

    {* Template *}
    <div class="container">
        <div id="admin__mailer__mailer__template" class="row">
            {$render->include($admin__mailer__mailer__model->template)}
        </div>
    </div>

</div>

{* Margin *}
<div class="mt-4"></div>