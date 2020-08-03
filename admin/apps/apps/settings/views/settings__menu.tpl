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
 * @description     Admin app settings. App CSS settings, description, CSS, JavaScript, size and align.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get('admin__apps__settings__menu_header')}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__apps__settings__navbar" aria-controls="admin__apps__settings__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__apps__settings__navbar">
        <ul class="navbar-nav mr-auto">

            {* Links *}
            {if $render->getUrl(300)}
                <li class="nav-item">
                    <a class="nav-link text-light" href="{$render->getUrl(300)}">
                        {$strings->get('admin__apps__settings__management')}
                    </a>
                </li>
                <div class="mt-4"></div>
            {/if}

            {* App admin area *}
            {if $admin__apps__settings__app->adminViews > 0 && $render->getUrl(303)}
                <li class="nav-item">
                    <a class="nav-link text-light" href="{$render->getUrl(303)}/{$admin__apps__settings__app->id}">
                        <i class="fas fa-user  fa-menu-size"></i>
                        {$strings->get('admin__apps__settings__admin_area')}
                    </a>
                </li>
                <div class="mt-4"></div>
            {/if}

            {* App data *}
            {if $admin__apps__settings__model->uriId !== 306 && $render->getUrl(306)}
                <li class="nav-item">
                    <a class="nav-link text-light" href="{$render->getUrl(306)}/{$admin__apps__settings__app->id}">
                        <i class="fa fa-edit  fa-menu-size"></i>
                        {$strings->get('admin__apps__settings__menu_header')}
                    </a>
                </li>
            {/if}

            {* App size and alignment *}
            {if $admin__apps__settings__model->uriId !== 307 && $render->getUrl(307) && $admin__apps__settings__app->container}
                <li class="nav-item">
                    <a class="nav-link text-light" href="{$render->getUrl(307)}/{$admin__apps__settings__app->id}">
                        <i class="fas fa-vector-square  fa-menu-size"></i>
                        {$strings->get('admin__apps__settings__size_and_align')}
                    </a>
                </li>
            {/if}

            {* Expert mode *}
            {if $admin__apps__settings__model->getExpertModeAdmin()}

                {* App CSS *}
                {if $admin__apps__settings__model->uriId !== 308 && $render->getUrl(308)}
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{$render->getUrl(308)}/{$admin__apps__settings__app->id}">
                            <i class="far fa-file-code  fa-menu-size"></i>
                            {$strings->get('admin__apps__settings__edit_css')}
                        </a>
                    </li>
                {/if}

                {* App JavaScript *}
                {if $admin__apps__settings__model->uriId !== 309 && $render->getUrl(309)}
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{$render->getUrl(309)}/{$admin__apps__settings__app->id}">
                            <i class="far fa-file-code  fa-menu-size"></i>
                            {$strings->get('admin__apps__settings__edit_js')}
                        </a>
                    </li>
                {/if}

            {/if}
        </ul>
    </div>
</nav>