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

{* If languages available *}
{if $admin__menu__language_menu__languages_list->languagesList|count > 0}

    {* List languages *}
    {foreach from=$admin__menu__language_menu__languages_list->languagesList item=$admin__menu__language_menu__language}
        {$admin__menu__language_menu__model->assign('admin__menu__language_menu__language', $admin__menu__language_menu__language)}
        {$render->include('admin/apps/menu/language_menu/views/language_menu__language.tpl')}
    {/foreach}

{* If no entries available *}
{else}

    <div class="alert alert-warning m-0">
        {$strings->get('admin__menu__language_menu__no_languages')}
    </div>

{/if}