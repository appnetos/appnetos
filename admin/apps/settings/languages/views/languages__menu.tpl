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
 * @description     Admin language settings.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get('admin__settings__languages__menu_header')}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__settings__languages__navbar" aria-controls="admin__settings__languages__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__settings__languages__navbar">
        <ul class="navbar-nav mr-auto">

            {* Menu *}
            <li class="nav-item">
                <a class="nav-link active">
                    {$strings->get('admin__settings__languages__menu_header')}
                </a>
            </li>
            {if $render->getUrl(402)}
                <li class="nav-item">
                    <a class="nav-link" href="{$render->getUrl(402)}">
                        {$strings->get('admin__settings__languages__manage_languages')}
                    </a>
                </li>
            {/if}

        </ul>
    </div>
</nav>