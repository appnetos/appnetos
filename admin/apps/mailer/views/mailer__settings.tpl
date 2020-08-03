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
        {$strings->get('admin__mailer__mailer__settings__info')}
    </div>
{/if}

{* AJAX error *}
{if $admin__mailer__mailer__settings->getAjaxError()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_error">
        <div class="alert alert-danger m-0">
            {$admin__mailer__mailer__settings->getAjaxError()}
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $admin__mailer__mailer__settings->getAjaxConfirm()}
    <div class="col-12 mt-4 d-none" data-type="admin__mailer__mailer__ajax_confirm">
        <div class="alert alert-success m-0">
            {$admin__mailer__mailer__settings->getAjaxConfirm()}
        </div>
    </div>
{/if}

{* Settings *}
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="mt-2">
                {$strings->get('admin__mailer__mailer__menu_settings')}
            </h5>
        </div>

        {* Settings *}
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label>
                        {$strings->get('admin__mailer__mailer__settings__log_error')}
                    </label>
                    <select class="form-control" id="admin__mailer__mailer__settings__error_log">
                        <option value="0"{if $admin__mailer__mailer__settings->errorLogs === 0} selected{/if}>{$strings->get('admin__mailer__mailer__settings__unlimited')}</option>
                        <option value="100"{if $admin__mailer__mailer__settings->errorLogs === 100} selected{/if}>100</option>
                        <option value="250"{if $admin__mailer__mailer__settings->errorLogs === 250} selected{/if}>250</option>
                        <option value="500"{if $admin__mailer__mailer__settings->errorLogs === 500} selected{/if}>500</option>
                        <option value="1000"{if $admin__mailer__mailer__settings->errorLogs === 1000} selected{/if}>1000</option>
                        <option value="2500"{if $admin__mailer__mailer__settings->errorLogs === 2500} selected{/if}>2500</option>
                        <option value="5000"{if $admin__mailer__mailer__settings->errorLogs === 5000} selected{/if}>5000</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label>
                        {$strings->get('admin__mailer__mailer__settings__log_confirm')}
                    </label>
                    <select class="form-control" id="admin__mailer__mailer__settings__confirm_log">
                        <option value="0"{if $admin__mailer__mailer__settings->confirmLogs === 0} selected{/if}>{$strings->get('admin__mailer__mailer__settings__unlimited')}</option>
                        <option value="100"{if $admin__mailer__mailer__settings->confirmLogs === 100} selected{/if}>100</option>
                        <option value="250"{if $admin__mailer__mailer__settings->confirmLogs === 250} selected{/if}>250</option>
                        <option value="500"{if $admin__mailer__mailer__settings->confirmLogs === 500} selected{/if}>500</option>
                        <option value="1000"{if $admin__mailer__mailer__settings->confirmLogs === 1000} selected{/if}>1000</option>
                        <option value="2500"{if $admin__mailer__mailer__settings->confirmLogs === 2500} selected{/if}>2500</option>
                        <option value="5000"{if $admin__mailer__mailer__settings->confirmLogs === 5000} selected{/if}>5000</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-4">
                        {$strings->get('admin__mailer__mailer__settings__mailbox')}
                    </label>
                    <select class="form-control" id="admin__mailer__mailer__settings__default_mailbox">
                        <option value=""{if !$admin__mailer__mailer__settings->defaultMailbox} selected{/if}>{$strings->get('admin__mailer__mailer__settings__none')}</option>
                        {foreach from=$admin__mailer__mailer__mailboxes_list->mailboxesList item="admin__mailer__mailer__mailbox"}
                            <option value="{$admin__mailer__mailer__mailbox->uuid}"{if $admin__mailer__mailer__settings->defaultMailbox === $admin__mailer__mailer__mailbox->uuid} selected{/if}>{$admin__mailer__mailer__mailbox->name}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-12"></div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-4">
                        {$strings->get('admin__mailer__mailer__settings_ip_lock')}
                    </label>
                    <div class="row">
                        <div class="col-6">
                            <select class="form-control" id="admin__mailer__mailer__settings__lock_ip_request">
                                <option value="0"{if $admin__mailer__mailer__settings->lockIpRequests === 0} selected{/if}>{$strings->get('admin__mailer__mailer__settings__never')}</option>
                                <option value="3"{if $admin__mailer__mailer__settings->lockIpRequests === 3} selected{/if}>3 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="5"{if $admin__mailer__mailer__settings->lockIpRequests === 5} selected{/if}>5 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="10"{if $admin__mailer__mailer__settings->lockIpRequests === 10} selected{/if}>10 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="15"{if $admin__mailer__mailer__settings->lockIpRequests === 15} selected{/if}>15 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="25"{if $admin__mailer__mailer__settings->lockIpRequests === 25} selected{/if}>25 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="50"{if $admin__mailer__mailer__settings->lockIpRequests === 50} selected{/if}>50 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="100"{if $admin__mailer__mailer__settings->lockIpRequests === 100} selected{/if}>100 {$strings->get('admin__mailer__mailer__requests')}</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="admin__mailer__mailer__settings__lock_ip_time">
                                <option value="60"{if $admin__mailer__mailer__settings->lockIpTime === 60} selected{/if}>1 {$strings->get('admin__mailer__mailer__minute')}</option>
                                <option value="120"{if $admin__mailer__mailer__settings->lockIpTime === 120} selected{/if}>2 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="300"{if $admin__mailer__mailer__settings->lockIpTime === 300} selected{/if}>5 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="600"{if $admin__mailer__mailer__settings->lockIpTime === 600} selected{/if}>10 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="900"{if $admin__mailer__mailer__settings->lockIpTime === 900} selected{/if}>15 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="1500"{if $admin__mailer__mailer__settings->lockIpTime === 1500} selected{/if}>25 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="3000"{if $admin__mailer__mailer__settings->lockIpTime === 3000} selected{/if}>50 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="6000"{if $admin__mailer__mailer__settings->lockIpTime === 6000} selected{/if}>100 {$strings->get('admin__mailer__mailer__minutes')}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-4">
                        {$strings->get('admin__mailer__mailer__settings_ip_expire')}
                    </label>
                    <select class="form-control" id="admin__mailer__mailer__settings__lock_ip_expire">
                        <option value="0"{if $admin__mailer__mailer__settings->lockIpExpire === 0} selected{/if}>{$strings->get('admin__mailer__mailer__manually')}</option>
                        <option value="3600"{if $admin__mailer__mailer__settings->lockIpExpire === 3600} selected{/if}>1 {$strings->get('admin__mailer__mailer__hour')}</option>
                        <option value="7200"{if $admin__mailer__mailer__settings->lockIpExpire === 7200} selected{/if}>2 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="14400"{if $admin__mailer__mailer__settings->lockIpExpire === 14400} selected{/if}>4 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="28800"{if $admin__mailer__mailer__settings->lockIpExpire === 28800} selected{/if}>8 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="57600"{if $admin__mailer__mailer__settings->lockIpExpire === 57600} selected{/if}>16 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="86400"{if $admin__mailer__mailer__settings->lockIpExpire === 86400} selected{/if}>24 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="172800"{if $admin__mailer__mailer__settings->lockIpExpire === 172800} selected{/if}>48 {$strings->get('admin__mailer__mailer__hours')}</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-4">
                        {$strings->get('admin__mailer__mailer__settings_mail_lock')}
                    </label>
                    <div class="row">
                        <div class="col-6">
                            <select class="form-control" id="admin__mailer__mailer__settings__lock_email_request">
                                <option value="0"{if $admin__mailer__mailer__settings->lockEmailRequests === 0} selected{/if}>{$strings->get('admin__mailer__mailer__settings__never')}</option>
                                <option value="3"{if $admin__mailer__mailer__settings->lockEmailRequests === 3} selected{/if}>3 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="5"{if $admin__mailer__mailer__settings->lockEmailRequests === 5} selected{/if}>5 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="10"{if $admin__mailer__mailer__settings->lockEmailRequests === 10} selected{/if}>10 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="15"{if $admin__mailer__mailer__settings->lockEmailRequests === 15} selected{/if}>15 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="25"{if $admin__mailer__mailer__settings->lockEmailRequests === 25} selected{/if}>25 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="50"{if $admin__mailer__mailer__settings->lockEmailRequests === 50} selected{/if}>50 {$strings->get('admin__mailer__mailer__requests')}</option>
                                <option value="100"{if $admin__mailer__mailer__settings->lockEmailRequests === 100} selected{/if}>100 {$strings->get('admin__mailer__mailer__requests')}</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="admin__mailer__mailer__settings__lock_email_time">
                                <option value="60"{if $admin__mailer__mailer__settings->lockEmailTime === 60} selected{/if}>1 {$strings->get('admin__mailer__mailer__minute')}</option>
                                <option value="120"{if $admin__mailer__mailer__settings->lockEmailTime === 120} selected{/if}>2 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="300"{if $admin__mailer__mailer__settings->lockEmailTime === 300} selected{/if}>5 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="600"{if $admin__mailer__mailer__settings->lockEmailTime === 600} selected{/if}>10 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="900"{if $admin__mailer__mailer__settings->lockEmailTime === 900} selected{/if}>15 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="1500"{if $admin__mailer__mailer__settings->lockEmailTime === 1500} selected{/if}>25 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="3000"{if $admin__mailer__mailer__settings->lockEmailTime === 3000} selected{/if}>50 {$strings->get('admin__mailer__mailer__minutes')}</option>
                                <option value="6000"{if $admin__mailer__mailer__settings->lockEmailTime === 6000} selected{/if}>100 {$strings->get('admin__mailer__mailer__minutes')}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <label class="mt-4">
                        {$strings->get('admin__mailer__mailer__settings_ip_expire')}
                    </label>
                    <select class="form-control" id="admin__mailer__mailer__settings__lock_email_expire">
                        <option value="0"{if $admin__mailer__mailer__settings->lockEmailExpire === 0} selected{/if}>{$strings->get('admin__mailer__mailer__manually')}</option>
                        <option value="3600"{if $admin__mailer__mailer__settings->lockEmailExpire === 3600} selected{/if}>1 {$strings->get('admin__mailer__mailer__hour')}</option>
                        <option value="7200"{if $admin__mailer__mailer__settings->lockEmailExpire === 7200} selected{/if}>2 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="14400"{if $admin__mailer__mailer__settings->lockEmailExpire === 14400} selected{/if}>4 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="28800"{if $admin__mailer__mailer__settings->lockEmailExpire === 28800} selected{/if}>8 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="57600"{if $admin__mailer__mailer__settings->lockEmailExpire === 57600} selected{/if}>16 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="86400"{if $admin__mailer__mailer__settings->lockEmailExpire === 86400} selected{/if}>24 {$strings->get('admin__mailer__mailer__hours')}</option>
                        <option value="172800"{if $admin__mailer__mailer__settings->lockEmailExpire === 172800} selected{/if}>48 {$strings->get('admin__mailer__mailer__hours')}</option>
                    </select>
                </div>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-primary mt-4" onclick="admin__mailer__mailer.us()">
                    {$strings->get('admin__mailer__mailer__menu_save')}
                </button>
            </div>
        </div>
    </div>
</div>