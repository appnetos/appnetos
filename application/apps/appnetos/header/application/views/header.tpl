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

{* Header *}
<div id="app-{$appnetos__header->appId}" class="row">

    {* Logo *}
    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 my-2">
        {if $appnetos__header->logo}
            <a class="appnetos__header__a" href="{$appnetos__header->logo.xt_link}" target="{$appnetos__header->logo.xt_target}">
                <img id="app-{$appnetos__header->appId}-logo" src="{$render->getUrl()}/out/img/appnetos/header/{$appnetos__header->appId}_{$appnetos__header->logo.xt_id}.{$appnetos__header->logo.xt_img}" style="width: {$appnetos__header->logo.xt_width}px; position: relative;">
            </a>
        {/if}
    </div>

    {* Icons *}
    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 my-2 appnetos__header__bar">
        {if $appnetos__header->icons}
            {assign var='appnetos__header__icon_key' value=0}
            {foreach from=$appnetos__header->icons item='appnetos__header__icon'}
                <a class="appnetos__header__a ml-1" href="{$appnetos__header__icon.xt_link}" target="{$appnetos__header__icon.xt_target}">
                    <img id="app-{$appnetos__header->appId}-icon{$appnetos__header__icon_key}" data-set="app-{$appnetos__header->appId}-icon" class="appnetos__header__a appnetos__header__icons" src="{$render->getUrl()}/out/img/appnetos/header/{$appnetos__header->appId}_{$appnetos__header__icon.xt_id}.{$appnetos__header__icon.xt_img}" onmouseover="appnetos__header.ov({$appnetos__header__icon_key}, {$appnetos__header->appId})" onmouseout="appnetos__header.oo({$appnetos__header->appId})" style="width: {$appnetos__header__icon.xt_width}px; position: relative;">
                </a>
                {$appnetos__header__icon_key=$appnetos__header__icon_key+1}
            {/foreach}
        {/if}
    </div>

</div>