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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">

    {* Header *}
    {if $admin__mailer__mailer__model->part === 'logs'}
        <div class="navbar-brand text-light">
            {$strings->get('admin__mailer__mailer__menu_header_logs')}
        </div>
    {elseif $admin__mailer__mailer__model->part === 'blacklist'}
        <div class="navbar-brand text-light">
            {$strings->get('admin__mailer__mailer__menu_header_blacklist')}
        </div>
    {elseif $admin__mailer__mailer__model->part === 'whitelist'}
        <div class="navbar-brand text-light">
            {$strings->get('admin__mailer__mailer__menu_header_whitelist')}
        </div>
    {elseif $admin__mailer__mailer__model->part === 'mailboxes'}
        <div class="navbar-brand text-light">
            {$strings->get('admin__mailer__mailer__menu_header_mailboxes')}
        </div>
    {elseif $admin__mailer__mailer__model->part === 'settings'}
        <div class="navbar-brand text-light">
            {$strings->get('admin__mailer__mailer__menu_header_settings')}
        </div>
    {/if}

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__mailer__mailer__settings__navbar" aria-controls="admin__mailer__mailer__settings__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__mailer__mailer__settings__navbar">
        <ul class="navbar-nav mr-auto">

            {* Menus logs, blacklist, whitelist *}
            {if $admin__mailer__mailer__model->part === 'logs' || $admin__mailer__mailer__model->part === 'blacklist' || $admin__mailer__mailer__model->part === 'whitelist'}
                {if $render->getUrl(500)}
                    <li class="nav-item">
                        <a {if $admin__mailer__mailer__model->part === 'logs'}class="nav-link active"{else}class="nav-link" href="{$render->getUrl(500)}"{/if}>
                            {$strings->get('admin__mailer__mailer__menu_logs')}
                        </a>
                    </li>
                {/if}
                {if $render->getUrl(501)}
                    <li class="nav-item">
                        <a {if $admin__mailer__mailer__model->part === 'blacklist'}class="nav-link active"{else}class="nav-link" href="{$render->getUrl(501)}"{/if}>
                            {$strings->get('admin__mailer__mailer__menu_blacklist')}
                        </a>
                    </li>
                {/if}
                {if $render->getUrl(502)}
                    <li class="nav-item">
                        <a {if $admin__mailer__mailer__model->part === 'whitelist'}class="nav-link active"{else}class="nav-link" href="{$render->getUrl(502)}"{/if}>
                            {$strings->get('admin__mailer__mailer__menu_whitelist')}
                        </a>
                    </li>
                {/if}
            {/if}

            {* Menus mailboxes, settings *}
            {if $admin__mailer__mailer__model->part === 'mailboxes' || $admin__mailer__mailer__model->part === 'settings'}
                {if $render->getUrl(504)}
                    <li class="nav-item">
                        <a {if $admin__mailer__mailer__model->part === 'mailboxes'}class="nav-link active"{else}class="nav-link" href="{$render->getUrl(504)}"{/if}>
                            {$strings->get('admin__mailer__mailer__menu_mailboxes')}
                        </a>
                    </li>
                {/if}
                {if $render->getUrl(503)}
                    <li class="nav-item">
                        <a {if $admin__mailer__mailer__model->part === 'settings'}class="nav-link active"{else}class="nav-link" href="{$render->getUrl(503)}"{/if}>
                            {$strings->get('admin__mailer__mailer__menu_settings')}
                        </a>
                    </li>
                {/if}
            {/if}

            {* Action menu*}
            {if $admin__mailer__mailer__model->part === 'mailboxes'}
                <li class="nav-item mt-4">
                    <a class="nav-link text-light" href="" data-toggle="modal" data-target="#admin__mailer__mailer__mailboxes__modal_add">
                        <i class="fas fa-plus  fa-menu-size"></i>
                        {$strings->get('admin__mailer__mailer__mailboxes__add')}
                    </a>
                </li>
            {/if}

        </ul>
    </div>
</nav>