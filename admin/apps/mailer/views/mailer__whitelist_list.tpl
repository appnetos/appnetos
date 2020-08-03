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
        {$strings->get('admin__mailer__mailer__whitelist__info')}
    </div>
{/if}

{* AJAX error *}
{if $admin__mailer__mailer__whitelist_list->getAjaxError()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__mailer__mailer__whitelist_list->getAjaxError()}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__mailer__mailer__whitelist_list->getAjaxConfirm()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__mailer__mailer__whitelist_list->getAjaxConfirm()}
        </div>
    </div>
{/if}

{* Whitelist *}
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="mt-2">
                {$strings->get('admin__mailer__mailer__menu_whitelist')}
            </h5>
        </div>

        {* Options *}
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-2">
                        {$strings->get('admin__mailer__mailer__email_or_ip')}
                    </label>
                    <input id="admin__mailer__mailer__whitelist__add_email_or_ip" type="text" class="form-control" value="" placeholder="{$strings->get('admin__mailer__mailer__email_or_ip')}">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-2">
                        &nbsp;
                    </label>
                    <div>
                        <button type="button" class="btn btn-primary" onclick="admin__mailer__mailer.aw()">
                            {$strings->get('admin__mailer__mailer__add')}
                        </button>
                    </div>
                </div>
                <div class="col-12 mt-2"></div>
            </div>
        </div>

        {* Whiltelist *}
        <div class="card-body p-0" data-type="admin__mailer__mailer__whitelist_list">

            {* If entry exists *}
            {if $admin__mailer__mailer__whitelist_list->ips|count !== 0 || $admin__mailer__mailer__whitelist_list->emails|count !== 0}

                {assign var='admin__mailer__mailer__whitelist_list_count' value=1}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">&nbsp;</th>
                                    <th scope="col">{$strings->get('admin__mailer__mailer__address')}</th>
                                    <th scope="col">{$strings->get('admin__mailer__mailer__type')}</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>

                                {* IP addresses *}
                                {if $admin__mailer__mailer__whitelist_list->ips|count !== 0}

                                    {foreach from=$admin__mailer__mailer__whitelist_list->ips item='admin__mailer__mailer__whitelist_list_ip'}
                                        <tr>
                                            <th scope="row">
                                                <span class="ml-2">{$admin__mailer__mailer__whitelist_list_count}</span>
                                            </th>
                                            <td class="text-left pl-2">
                                                <span>{$admin__mailer__mailer__whitelist_list_ip}</span>
                                            </td>
                                            <td class="text-left">
                                                <span>{$strings->get('admin__mailer__mailer__ip')}</span>
                                            </td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-sm btn-danger mr-2" onclick="admin__mailer__mailer.rw('{$admin__mailer__mailer__whitelist_list_ip}')">
                                                    {$strings->get('admin__mailer__mailer__remove')}
                                                </button>
                                            </td>
                                        </tr>
                                        {assign var='admin__mailer__mailer__whitelist_list_count' value=$admin__mailer__mailer__whitelist_list_count+1}
                                    {/foreach}

                                {/if}

                                {* Email addresses *}
                                {if $admin__mailer__mailer__whitelist_list->emails|count !== 0}

                                    {foreach from=$admin__mailer__mailer__whitelist_list->emails item='admin__mailer__mailer__whitelist_list_email'}
                                        <tr>
                                            <th scope="row">
                                                <span class="ml-2">{$admin__mailer__mailer__whitelist_list_count}</span>
                                            </th>
                                            <td class="text-left">
                                                <span>{$admin__mailer__mailer__whitelist_list_email}</span>
                                            </td>
                                            <td class="text-left">
                                                <span>{$strings->get('admin__mailer__mailer__email')}</span>
                                            </td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-sm btn-danger mr-2" onclick="admin__mailer__mailer.rw('{$admin__mailer__mailer__whitelist_list_email}')">
                                                    {$strings->get('admin__mailer__mailer__remove')}
                                                </button>
                                            </td>
                                        </tr>
                                        {assign var='admin__mailer__mailer__whitelist_list_count' value=$admin__mailer__mailer__whitelist_list_count+1}
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