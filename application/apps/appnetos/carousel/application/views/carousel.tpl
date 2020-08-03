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
 * @description     APPNET OS Bootstrap carousel. Simply create a picture carousel via the app admin section.
*}

{* Carousel *}
{assign var='appnetos__carousel__images' value=$appnetos__carousel->getImages()}
{if $appnetos__carousel__images}
    {if $appnetos__carousel->settings->random}
        {assign var='appnetos__carousel__start' value=$appnetos__carousel->getRandom()}
    {else}
        {assign var='appnetos__carousel__start' value=1}
    {/if}
    <div id="app-{$appnetos__carousel->appId}" class="carousel slide" data-interval="{$appnetos__carousel->settings->time * 1000}" data-ride="carousel">
        {if $appnetos__carousel->settings->indicators}
        <ol class="carousel-indicators">
            {foreach from=$appnetos__carousel__images item='appnetos__carousel__image'}
                <li data-target="#app-{$appnetos__carousel->appId}" data-slide-to="{$appnetos__carousel__image->sort-1}"{if $appnetos__carousel__image->sort === $appnetos__carousel__start} class="active"{/if}></li>
            {/foreach}
        </ol>
        {/if}
        <div class="carousel-inner">
            {foreach from=$appnetos__carousel__images item='appnetos__carousel__image'}
                <div class="carousel-item {if $appnetos__carousel__image->sort === $appnetos__carousel__start} active{/if}{if $appnetos__carousel__image->link} appnetos__carousel__pointer{/if}">
                    <img class="d-block w-100" src="{$render->getUrl()}/out/img/appnetos/carousel/{$appnetos__carousel->appId}_{$appnetos__carousel__image->id}.{$appnetos__carousel__image->img}" {if $appnetos__carousel__image->link} onclick="appnetos__carousel.cl('{$appnetos__carousel__image->link}')"{/if}>
                </div>
            {/foreach}
        </div>
        {if $appnetos__carousel->settings->controls}
            <a class="carousel-control-prev" href="#app-{$appnetos__carousel->appId}" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#app-{$appnetos__carousel->appId}" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        {/if}
    </div>
{/if}