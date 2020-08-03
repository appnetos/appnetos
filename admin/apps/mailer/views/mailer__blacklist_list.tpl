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
        {$strings->get('admin__mailer__mailer__blacklist__info')}
    </div>
{/if}

{* AJAX error *}
{if $admin__mailer__mailer__blacklist_list->getAjaxError()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__mailer__mailer__blacklist_list->getAjaxError()}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__mailer__mailer__blacklist_list->getAjaxConfirm()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__mailer__mailer__blacklist_list->getAjaxConfirm()}
        </div>
    </div>
{/if}

{* Blacklist *}
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="mt-2">
                {$strings->get('admin__mailer__mailer__menu_blacklist')}
            </h5>
        </div>

        {* Options *}
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-2">
                        {$strings->get('admin__mailer__mailer__email_or_ip')}
                    </label>
                    <input id="admin__mailer__mailer__blacklist__add_email_or_ip" type="text" class="form-control" value="" placeholder="{$strings->get('admin__mailer__mailer__email_or_ip')}">
                    <div class="form-check mt-4">
                        <label class="form-check-label">
                            <input id="admin__mailer__mailer__blacklist__add_static" type="checkbox" class="form-check-input">
                            {$strings->get('admin__mailer__mailer__blacklist_static')}
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-2">
                        &nbsp;
                    </label>
                    <div>
                        <button type="button" class="btn btn-primary" onclick="admin__mailer__mailer.ab()">
                            {$strings->get('admin__mailer__mailer__add')}
                        </button>
                    </div>
                </div>
                <div class="col-12 mt-2"></div>
            </div>
        </div>

        {* Blacklist *}
        <div class="card-body p-0" data-type="admin__mailer__mailer__blacklist_list">

            {* If entry exists *}
            {if $admin__mailer__mailer__blacklist_list->blacklistList|count !== 0}

            {assign var='admin__mailer__mailer__blacklist_list_count' value=1}
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">{$strings->get('admin__mailer__mailer__address')}</th>
                            <th scope="col">{$strings->get('admin__mailer__mailer__type')}</th>
                            <th scope="col">{$strings->get('admin__mailer__mailer__expiration')}</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>

                        {* Entries *}
                        {if $admin__mailer__mailer__blacklist_list->blacklistList|count !== 0}

                            {foreach from=$admin__mailer__mailer__blacklist_list->blacklistList item='admin__mailer__mailer__blacklist'}
                                <tr>
                                    <th scope="row">
                                        <span class="ml-2">{$admin__mailer__mailer__blacklist_list_count}</span>
                                    </th>
                                    {if $admin__mailer__mailer__blacklist->ip}
                                        <td class="text-left pl-2">
                                            <span>{$admin__mailer__mailer__blacklist->ip}</span>
                                        </td>
                                        <td class="text-left">
                                            <span>{$strings->get('admin__mailer__mailer__ip')}</span>
                                        </td>
                                        <td class="text-left">
                                            {if $admin__mailer__mailer__blacklist->static}
                                                {$strings->get('admin__mailer__mailer__static')}
                                            {else}
                                                {$admin__mailer__mailer__blacklist_list->getIpExpiration($admin__mailer__mailer__blacklist->timestamp)}
                                            {/if}
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-sm btn-danger mr-2" onclick="admin__mailer__mailer.rb('{$admin__mailer__mailer__blacklist->ip}')">
                                                {$strings->get('admin__mailer__mailer__remove')}
                                            </button>
                                        </td>
                                    {else}
                                        <td class="text-left pl-2">
                                            <span>{$admin__mailer__mailer__blacklist->address}</span>
                                        </td>
                                        <td class="text-left">
                                            <span>{$strings->get('admin__mailer__mailer__email')}</span>
                                        </td>
                                        <td class="text-left">
                                            {if $admin__mailer__mailer__blacklist->static}
                                                {$strings->get('admin__mailer__mailer__static')}
                                            {else}
                                                {$admin__mailer__mailer__blacklist_list->getEmailExpiration($admin__mailer__mailer__blacklist->timestamp)}
                                            {/if}
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-sm btn-danger mr-2" onclick="admin__mailer__mailer.rb('{$admin__mailer__mailer__blacklist->address}')">
                                                {$strings->get('admin__mailer__mailer__remove')}
                                            </button>
                                        </td>
                                    {/if}
                                </tr>
                                {assign var='admin__mailer__mailer__blacklist_list_count' value=$admin__mailer__mailer__blacklist_list_count+1}
                            {/foreach}

                        {/if}

                        </tbody>
                    </table>
                </div>
            </div>

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