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
 * @description     Admin settings. Show, edit, APPNET OS settings.
 *}

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-left">
    <div class="navbar-brand text-light">
        {if $admin__settings__system__model->part === 'system'}
            {$strings->get('admin__settings__system__menu_system')}
        {elseif $admin__settings__system__model->part === 'cache'}
            {$strings->get('admin__settings__system__menu_cache')}
        {elseif $admin__settings__system__model->part === 'admin'}
            {$strings->get('admin__settings__system__menu_admin')}
        {elseif $admin__settings__system__model->part === 'debug'}
            {$strings->get('admin__settings__system__menu_debug')}
        {/if}
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin__settings__system__navbar" aria-controls="admin__settings__system__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="admin__settings__system__navbar">
        <ul class="navbar-nav mr-auto">

            {* Menu *}
            {if $render->getUrl(400)}
                <li>
                    {if $admin__settings__system__model->part !== 'system'}
                        <a class="nav-link" href="{$render->getUrl(400)}">
                            {$strings->get('admin__settings__system__menu_system')}
                        </a>
                    {else}
                        <div class="nav-link active">
                            {$strings->get('admin__settings__system__menu_system')}
                        </div>
                    {/if}
                </li>
            {/if}
            {if $render->getUrl(404)}
                <li>
                    {if $admin__settings__system__model->part !== 'cache'}
                        <a class="nav-link" href="{$render->getUrl(404)}">
                            {$strings->get('admin__settings__system__menu_cache')}
                        </a>
                    {else}
                        <div class="nav-link active">
                            {$strings->get('admin__settings__system__menu_cache')}
                        </div>
                    {/if}
                </li>
            {/if}
            {if $render->getUrl(407)}
                <li>
                    {if $admin__settings__system__model->part !== 'extends'}
                        <a class="nav-link" href="{$render->getUrl(407)}">
                            {$strings->get('admin__settings__system__class_extends')}
                        </a>
                    {else}
                        <div class="nav-link active">
                            {$strings->get('admin__settings__system__class_extends')}
                        </div>
                    {/if}
                </li>
            {/if}
            {if $render->getUrl(405)}
                <li>
                    {if $admin__settings__system__model->part !== 'admin'}
                        <a class="nav-link" href="{$render->getUrl(405)}">
                            {$strings->get('admin__settings__system__menu_admin')}
                        </a>
                    {else}
                        <div class="nav-link active">
                            {$strings->get('admin__settings__system__menu_admin')}
                        </div>
                    {/if}
                </li>
            {/if}
            {if $render->getUrl(406)}
                <li>
                    {if $admin__settings__system__model->part !== 'debug'}
                        <a class="nav-link" href="{$render->getUrl(406)}">
                            {$strings->get('admin__settings__system__menu_debug')}
                        </a>
                    {else}
                        <div class="nav-link active">
                            {$strings->get('admin__settings__system__menu_debug')}
                        </div>
                    {/if}
                </li>
            {/if}
        </ul>
    </div>
</nav>