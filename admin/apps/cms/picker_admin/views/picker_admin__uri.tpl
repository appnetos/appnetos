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
 * @description     Admin admin cms multi picker. Open modal popup to pick an list of URI IDs.
 *                  Open:           "admin__cms__picker_admin.pick('mynamespace.myfunction', array with excluded IDs);
 *                  Select: Execute "mynamespace.myfunction(URI ID);
 *}

{* App *}
<tr class="admin__cms__picker_admin__pointer" onclick="admin__cms__picker_admin.ch({$admin__cms__picker_admin__uri->id})">

    {* Selection *}
    <td class="text-center admin__cms__picker_admin__td_checkbox">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" data-type="admin__cms__picker_admin_selection" name="{$admin__cms__picker_admin__uri->id}" onclick="admin__cms__picker_admin.ch({$admin__cms__picker_admin__uri->id})">
        </div>
    </td>
    <td class="text-dark">
        {if $admin__cms__picker_admin__uri->uri !== ''}
            {$admin__cms__picker_admin__uri->uri}
        {else}
            {$strings->get('admin__cms__picker_admin__home')}
        {/if}
    </td>

</tr>