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
 * @description     Admin language menu.
*}

{* Language *}
<div class="card mb-4 admin__menu__language_menu__pointer" onclick="admin__menu__language_menu.ex('{$admin__menu__language_menu__language->key}')">
    <div class="card-header bg-dark text-light">
        <h5 class="mt-2">
            {$admin__menu__language_menu__language->key}
        </h5>
    </div>
    <div class="card-header">
        <div class="float-left">
            <div>
                {$admin__menu__language_menu__language->name}
            </div>
            <div class="text-secondary">
                {$admin__menu__language_menu__language->nameEn}
            </div>
        </div>
        {if $admin__menu__language_menu__model->getAdminDefault() === $admin__menu__language_menu__language->key}
            <div class="form-inline float-right">
                <span class="bg-primary text-light rounded py-1 px-2 mt-2">
                    {$strings->get("admin__menu__language_menu__default")}
                </span>
            </div>
        {/if}
    </div>
    <div class="admin__menu__language_menu__clear_both"></div>
</div>