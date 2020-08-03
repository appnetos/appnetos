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
 * @description     APPNET OS Marketplace.
 *}

{* User *}
{if $admin__apps__marketplace__user->user}

    {* If signed in *}
    <div class="text-light">
        {if $admin__apps__marketplace__user->image}
            <img src="{$admin__apps__marketplace__user->appnetosUrl}out/img/appnetos/users/100/{$admin__apps__marketplace__user->image}" class="admin__apps__marketplace__user_image rounded mr-2">
        {/if}
        {$admin__apps__marketplace__user->user}
    </div>

    <div class="mt-2">
        &nbsp;
    </div>

    {* My cart *}
    {if $admin__apps__marketplace__model->section !== 'marketplace__cart'}
        <li class="nav-item">
            <a class="nav-link text-light" href="{$render->getUrl($admin__apps__marketplace__model->uriId)}/{$strings->get('admin__apps__marketplace__cart')}">
                <i class="fas fa-shopping-cart fa-menu-size"></i>
                {$strings->get('admin__apps__marketplace__my_cart')}
                {if $admin__apps__marketplace__user->cart}
                    ({$admin__apps__marketplace__user->cart})
                {/if}
            </a>
        </li>
    {/if}

    {* Search *}
    {if $admin__apps__marketplace__model->section !== 'marketplace__apps_list'}
        <li class="nav-item">
            <a class="nav-link text-light" href="{$render->getUrl($admin__apps__marketplace__model->uriId)}">
                <i class="fas fa-download fa-menu-size"></i>
                {$strings->get('admin__apps__marketplace__search')}
            </a>
        </li>
    {/if}

    {* My apps *}
    {if $admin__apps__marketplace__model->section !== 'marketplace__downloads'}
        <li class="nav-item">
            <a class="nav-link text-light" href="{$render->getUrl($admin__apps__marketplace__model->uriId)}/{$strings->get('admin__apps__marketplace__downloads')}">
                <i class="fas fa-download fa-menu-size"></i>
                {$strings->get('admin__apps__marketplace__my_apps')}
            </a>
        </li>
    {/if}

    {* Sign out *}
    <li class="nav-item">
        <a class="nav-link text-light" href="" onclick="admin__apps__marketplace.so(event)">
            <i class="fas fa-sign-out-alt fa-menu-size"></i>
            {$strings->get('admin__apps__marketplace__sign_out')}
        </a>
    </li>

{else}

    {* If not signed in *}
    <li class="nav-item">
        <a class="nav-link text-light" href="" data-toggle="modal" data-target="#admin__apps__maketplace__modal_sign_in">
            <i class="fas fa-sign-in-alt fa-menu-size"></i>
            {$strings->get('admin__apps__marketplace__sign_in')}
        </a>
    </li>
    {assign var='admin__apps__marketplace__signup' value='https://www.appnetos.com'}
    {if $admin__apps__marketplace__url->get('signup')}
        {assign var='admin__apps__marketplace__signup' value=$admin__apps__marketplace__url->get('signup')}
    {/if}
    <li class="nav-item">
        <a class="nav-link text-light" href="{$admin__apps__marketplace__signup}" target="_blank">
            <i class="fas fa-user-plus fa-menu-size"></i>
            {$strings->get('admin__apps__marketplace__sign_up')}
        </a>
    </li>

    {* Search *}
    {if $admin__apps__marketplace__model->section !== 'marketplace__apps_list'}
        <li class="nav-item mt-4">
            <a class="nav-link text-light" href="{$render->getUrl($admin__apps__marketplace__model->uriId)}">
                <i class="fas fa-download fa-menu-size"></i>
                {$strings->get('admin__apps__marketplace__search')}
            </a>
        </li>
    {/if}

{/if}