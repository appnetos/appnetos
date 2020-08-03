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
 * @description     Admin menu.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="{$render->getUrl()}/admin">
        <img class="admin__header_logo" src="{$render->getUrl()}/out/admin/img/appnetos/logo_560_black.svg"/>
    </a>
    <button class="navbar-toggler text-right" type="button" data-toggle="collapse" data-target="#admin__menu_navbar" aria-controls="admin__menu_navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__menu_navbar">
        <ul class="navbar-nav mr-auto">

            {* User *}
            {if $render->getUrl(100) || $render->getUrl(101) || $render->getUrl(102) || $render->getUrl(103)}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {$strings->get('admin__menu__menu__user')}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {if $render->getUrl(100)}
                            <a class="dropdown-item" href="{$render->getUrl(100)}">
                                {$strings->get('admin__menu__menu__user_management')}
                            </a>
                        {/if}
                        {if $render->getUrl(101)}
                            <a class="dropdown-item" href="{$render->getUrl(101)}">
                                {$strings->get('admin__menu__menu__user_groups')}
                            </a>
                        {/if}
                        {if ($render->getUrl(100) || $render->getUrl(101)) && ($render->getUrl(102) || $render->getUrl(103))}
                            <div class="dropdown-divider"></div>
                        {/if}
                        {if $render->getUrl(102)}
                            <a class="dropdown-item" href="{$render->getUrl(102)}">
                                {$strings->get('admin__menu__menu__admin_management')}
                            </a>
                        {/if}
                        {if $render->getUrl(103)}
                            <a class="dropdown-item" href="{$render->getUrl(103)}">
                                {$strings->get('admin__menu__menu__admin_groups')}
                            </a>
                        {/if}
                    </div>
                </li>
            {/if}

            {* CMS *}
            {if $render->getUrl(200)}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {$strings->get('admin__menu__menu__cms')}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{$render->getUrl(200)}">
                            {$strings->get('admin__menu__menu__uri_management')}
                        </a>
                    </div>
                </li>
            {/if}

            {* Apps *}
            {if $render->getUrl(300) || $render->getUrl(301) || $render->getUrl(302) || $render->getUrl(305) || $render->getUrl(304)}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {$strings->get('admin__menu__menu__apps')}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {if $render->getUrl(300)}
                            <a class="dropdown-item" href="{$render->getUrl(300)}">
                                {$strings->get('admin__menu__menu__app_management')}
                            </a>
                        {/if}
                        {if $render->getUrl(310) && $render->getUrl(300)}
                            <div class="dropdown-divider"></div>
                        {/if}
                        {if $render->getUrl(310)}
                            <a class="dropdown-item" href="{$render->getUrl(310)}">
                                {$strings->get('admin__menu__menu__app_marketplace')}
                            </a>
                        {/if}
                        {if $render->getUrl(300) && ($render->getUrl(301) || $render->getUrl(302))}
                            <div class="dropdown-divider"></div>
                        {/if}
                        {if $render->getUrl(301)}
                            <a class="dropdown-item" href="{$render->getUrl(301)}">
                                {$strings->get('admin__menu__menu__app_static_top')}
                            </a>
                        {/if}
                        {if $render->getUrl(302)}
                            <a class="dropdown-item" href="{$render->getUrl(302)}">
                                {$strings->get('admin__menu__menu__app_static_bottom')}
                            </a>
                        {/if}
                        {if ($render->getUrl(301) || $render->getUrl(302)) && ($render->getUrl(305) || $render->getUrl(304))}
                            <div class="dropdown-divider"></div>
                        {/if}
                        {if $render->getUrl(305)}
                            <a class="dropdown-item" href="{$render->getUrl(305)}">
                                {$strings->get('admin__menu__menu__install_apps')}
                            </a>
                        {/if}
                        {if $render->getUrl(304)}
                            <a class="dropdown-item" href="{$render->getUrl(304)}">
                                {$strings->get('admin__menu__menu__create_new_app')}
                            </a>
                        {/if}
                    </div>
                </li>
            {/if}

            {* Files *}
            {if $render->getUrl(600)}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {$strings->get('admin__menu__menu__files')}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{$render->getUrl(600)}">
                            {$strings->get('admin__menu__menu__files_manager')}
                        </a>
                    </div>
                </li>
            {/if}

            {* Mailer *}
            {if $render->getUrl(500) || $render->getUrl(501) || $render->getUrl(502) || $render->getUrl(504) || $render->getUrl(503)}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {$strings->get('admin__menu__menu__mailer')}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {if $render->getUrl(500)}
                            <a class="dropdown-item" href="{$render->getUrl(500)}">
                                {$strings->get('admin__menu__menu__mailer_logs')}
                            </a>
                        {/if}
                        {if $render->getUrl(501)}
                            <a class="dropdown-item" href="{$render->getUrl(501)}">
                                {$strings->get('admin__menu__menu__mailer_blacklist')}
                            </a>
                        {/if}
                        {if $render->getUrl(502)}
                            <a class="dropdown-item" href="{$render->getUrl(502)}">
                                {$strings->get('admin__menu__menu__mailer_whitelist')}
                            </a>
                        {/if}
                        {if ($render->getUrl(500) || $render->getUrl(501) || $render->getUrl(502)) && ($render->getUrl(504) || $render->getUrl(503))}
                            <div class="dropdown-divider"></div>
                        {/if}
                        {if $render->getUrl(504)}
                            <a class="dropdown-item" href="{$render->getUrl(504)}">
                                {$strings->get('admin__menu__menu__mailer_mailboxes')}
                            </a>
                        {/if}
                        {if $render->getUrl(503)}
                            <a class="dropdown-item" href="{$render->getUrl(503)}">
                                {$strings->get('admin__menu__menu__mailer_settings')}
                            </a>
                        {/if}
                    </div>
                </li>
            {/if}

            {* Settings *}
            {if $render->getUrl(400) || $render->getUrl(404) || $render->getUrl(405) || $render->getUrl(406) || $render->getUrl(401)}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {$strings->get('admin__menu__menu__settings')}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {if $render->getUrl(400)}
                            <a class="dropdown-item" href="{$render->getUrl(400)}">
                                {$strings->get('admin__menu__menu__system_settings')}
                            </a>
                        {/if}
                        {if $render->getUrl(404)}
                            <a class="dropdown-item" href="{$render->getUrl(404)}">
                                {$strings->get('admin__menu__menu__cache_settings')}
                            </a>
                        {/if}
                        {if $render->getUrl(407)}
                            <a class="dropdown-item" href="{$render->getUrl(407)}">
                                {$strings->get('admin__menu__menu__class_extends')}
                            </a>
                        {/if}
                        {if $render->getUrl(405)}
                            <a class="dropdown-item" href="{$render->getUrl(405)}">
                                {$strings->get('admin__menu__menu__admin_settings')}
                            </a>
                        {/if}
                        {if $render->getUrl(406)}
                            <a class="dropdown-item" href="{$render->getUrl(406)}">
                                {$strings->get('admin__menu__menu__debugging_settings')}
                            </a>
                        {/if}
                        {if ($render->getUrl(400) || $render->getUrl(404) || $render->getUrl(405) || $render->getUrl(406)) && $render->getUrl(401)}
                            <div class="dropdown-divider"></div>
                        {/if}
                        {if $render->getUrl(401)}
                            <a class="dropdown-item" href="{$render->getUrl(401)}">
                                {$strings->get('admin__menu__menu__language_settings')}
                            </a>
                        {/if}
                    </div>
                </li>
            {/if}
        </ul>

        {* User and language menu *}
        <div class="form-inline">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog d-none d-lg-inline"></i>
                        <span class="d-lg-none">{$strings->get('admin__menu__menu__settings')}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <div class="dropdown-item">
                            {$render->include(3)}
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {$admin__menu__menu__model->user}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        {if $render->getUrl(1)}
                            <a class="dropdown-item" href="{$render->getUrl(1)}?signout=true">
                                <i class="fas fa-sign-out-alt"></i>
                                {$strings->get('admin__menu__menu__sign_out')}
                            </a>
                        {/if}
                    </div>
                </li>
            </ul>
            {if $admin__menu__menu__model->image}
                <img class="admin__menu__menu__user_img d-none d-lg-block rounded" src="{$render->getUrl()}/out/admin/img/appnetos/users/100/{$admin__menu__menu__model->image}">
            {/if}
        </div>

    </div>
</nav>