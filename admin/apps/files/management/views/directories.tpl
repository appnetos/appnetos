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
 * @description     Admin files management. Create and delete folders. Upload and delete files. The folders to manage
 *                  files in the files manager must be defined in the config.inc.php.
 *}

{* Directories *}
<ul class="navbar-nav mr-auto">
    {assign var='admin__files__management__directories' value=$admin__files__management->getDirectories()}
    {if $admin__files__management__directories}
        {foreach from=$admin__files__management__directories item='admin__files__management__directory'}
            {if isset($admin__files__management__directory->parentOpen)}
                {if $admin__files__management__directory->parentOpen}
                    <li class="nav-item admin__files__management__nav-item">
                        <div class="nav-link text-light" style="white-space: nowrap">
                            {for $admin__files__management__start=0 to $admin__files__management__directory->deep}
                                &nbsp;&nbsp;
                            {/for}
                            {if $admin__files__management__directory->hasSubDirectories}
                                <a class="text-light text-decoration-none" href="" {if $admin__files__management__directory->open}onclick="admin__files__management__open(event, '{$admin__files__management__directory->path}')"{else}onclick="admin__files__management__open(event, '{$admin__files__management__directory->path}')"{/if}>
                                    <i class="{if $admin__files__management__directory->open}fa fa-caret-down{else}fa fa-caret-right{/if}" aria-hidden="true"></i>&nbsp;
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                </a>&nbsp;
                                <a class="text-light text-decoration-none" href="" onclick="admin__files__management__show(event, '{$admin__files__management__directory->path}')">
                                    {$admin__files__management__directory->name}
                                </a>
                            {else}
                                <i class="fa fa-caret-right text-dark" aria-hidden="true"></i>&nbsp;<i class="fa fa-folder" aria-hidden="true"></i>&nbsp;
                                <a class="text-light text-decoration-none" href="" onclick="admin__files__management__show(event, '{$admin__files__management__directory->path}')">
                                    {$admin__files__management__directory->name}
                                </a>
                            {/if}
                        </div>
                    </li>
                {/if}
            {/if}
        {/foreach}
        <li class="nav-item mt-3">
            <a class="nav-link text-light" href="" onclick="admin__files__management__sync(event)">
                <i class="fas fa-sync  fa-menu-size"></i>
                {$strings->get('admin__files__mgnt__refresh')}
            </a>
        </li>
    {/if}
</ul>
