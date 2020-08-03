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
 * @description     Header application with selectable logo and selectable, animated social media icons.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark admin__navbar__fix fixed-left">
    <div class="navbar-brand text-light">{$strings->get('appnetos__header__header')} (1.0)</div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appnetos__header__navbar" aria-controls="appnetos__header__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="appnetos__header__navbar">

        {* Menu *}
        <ul class="navbar-nav mr-auto">
            {if !$appnetos__header__list->logo}
                <li class="nav-item">
                    <a class="nav-link text-light" href="" onclick="appnetos__header.ad(event, 'true')">
                        <i class="fas fa-plus  fa-menu-size"></i>
                        {$strings->get('appnetos__header__add_logo')}</a>
                </li>
            {/if}
            <li class="nav-item">
                <a class="nav-link text-light" href="" onclick="appnetos__header.ad(event, 'false')">
                    <i class="fas fa-plus  fa-menu-size"></i>{$strings->get('appnetos__header__add_icon')}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#" data-toggle="modal" data-target="#appnetos__header__modal_fast_select">
                    <i class="fas fa-angle-double-right  fa-menu-size"></i>{$strings->get('appnetos__header__add_fast_sel')}
                </a>
            </li>
        </ul>

    </div>
</nav>