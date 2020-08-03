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
 * @copyright       (C) xtrose Media Studio 2013-2019
 * @description     core/views/container.tpl ->    Container template. Render container apps in a container.
*}

{* Container *}
<div id="container-fluid{$core__container->getId()}" data-id="container-fluid{$core__container->getId()}" class="container-fluid{$core__container->getContainerFluidCss()}">
    <div class="row" id="container-fluid-row{$core__container->getId()}" data-id="container-fluid-row{$core__container->getId()}">
        <div id="container{$core__container->getId()}" data-id="container{$core__container->getId()}" class="container{$core__container->getContainerCss()}">
            <div id="container-row{$core__container->getId()}" data-id="container-row{$core__container->getId()}" class="row">
                {assign var="core__container__views" value=$core__container->getViews()}
                {assign var="core__container__appId" value=$core__container->getAppId()}
                {assign var="core__container__grid" value=$core__container->getGrid()}
                {foreach from=$core__container__views item="core__container__view" key="core__container__key"}
                    <div id="container-app-{$core__container__appId[$core__container__key]}" class="{$core__container__grid[$core__container__key]}">
                        {$core__container__view}
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>