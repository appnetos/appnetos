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
 * @description     Admin app creator to build apps.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get('admin__apps__create__menu_header')}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__apps__create__navbar" aria-controls="admin__apps__create__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__apps__create__navbar">
        <ul class="navbar-nav mr-auto">

            {* Menu *}
            {if $render->getUrl(305)}
                <li class="nav-item">
                    <a class="nav-link" href="{$render->getUrl(305)}">
                        {$strings->get('admin__apps__create__install_apps')}
                    </a>
                </li>
            {/if}
            <li class="nav-item active">
                <a class="nav-link">
                    {$strings->get('admin__apps__create__menu_header')}
                </a>
            </li>
            <div class="mt-4"></div>

            {* Overview *}
            {if $admin__apps__create__model->part !== 'overview'}
                <li class="nav-item">
                    <a class="nav-link text-light" href="{$render->getUrl(304)}">
                        <i class="fa fa-th-large  fa-menu-size"></i>
                        {$strings->get('admin__apps__create__overview')}
                    </a>
                </li>
            {/if}

            {* HTML Template app *}
            {if $admin__apps__create__model->part !== 'html'}
                <li class="nav-item">
                    <a class="nav-link text-light" href="{$render->getUrl(304)}/html">
                        <i class="far fa-file-code  fa-menu-size"></i>
                        {$strings->get('admin__apps__create__html_header')}
                    </a>
                </li>
            {/if}

            {* HTML string app *}
            {if $admin__apps__create__model->part !== 'html_string'}
                <li class="nav-item">
                    <a class="nav-link text-light" href="{$render->getUrl(304)}/html-string">
                        <i class="far fa-file-code  fa-menu-size"></i>
                        {$strings->get('admin__apps__create__html_string_header')}
                    </a>
                </li>
            {/if}

            {* Developer app *}
            {if $admin__apps__create__model->part !== 'developer'}
                <li class="nav-item">
                    <a class="nav-link text-light" href="{$render->getUrl(304)}/developer">
                        <i class="far fa-file-code  fa-menu-size"></i>
                        {$strings->get('admin__apps__create__dev_header')}
                    </a>
                </li>
            {/if}

        </ul>
    </div>
</nav>
