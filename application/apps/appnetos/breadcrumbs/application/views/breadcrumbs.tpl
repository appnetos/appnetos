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
 * @description     Automatic breadcrumbs. Loads and shows breadcrumbs by URI index.
*}

{* Breadcrumbs *}
<nav id="app-{$appnetos__breadcrumbs->id}" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        {foreach from=$appnetos__breadcrumbs->breadcrumbs key="appnetos__breadcrumbs__key" item="appnetos__breadcrumbs__item" name="appnetos__breadcrumbs__name"}
            <li>
                {if !$appnetos__breadcrumbs__item}
                    {$appnetos__breadcrumbs__key}
                {else}
                    {if $smarty.foreach.appnetos__breadcrumbs__name.last}
                        {$appnetos__breadcrumbs__key}
                    {else}
                        <a href="{$appnetos__breadcrumbs__item}">
                            {$appnetos__breadcrumbs__key}
                        </a>
                    {/if}
                {/if}
            </li>
        {/foreach}
    </ol>
</nav>
