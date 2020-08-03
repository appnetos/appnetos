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
 * @description     Admin section dashboard widget to show cache settings and cache options.
*}

{* AJAX confirm *}
{if $appnetos__widgets__widget_cache->ajaxConfirm}
    <div id="appnetos__widgets__widget_cache__confirm" class="alert alert-success m-0" style="display: none">
        {$appnetos__widgets__widget_cache->ajaxConfirm}
    </div>
{/if}

{* List *}
<div class="border-bottom">
    <table class="table ">
        <thead>
        <tr>
            <th scope="col">{$strings->get('appnetos__widgets__cache__type')}</th>
            <th scope="col">{$strings->get('appnetos__widgets__cache__active')}</th>
            <th scope="col">{$strings->get('appnetos__widgets__cache__exists')}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{$strings->get('appnetos__widgets__cache__apps')}</td>
            <td>{if $appnetos__widgets__widget_cache->appCache}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
            <td>{if $appnetos__widgets__widget_cache->dataCacheExists}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
        </tr>
        <tr>
            <td>{$strings->get('appnetos__widgets__cache__js')}</td>
            <td>{if $appnetos__widgets__widget_cache->jsCache}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
            <td>{if $appnetos__widgets__widget_cache->jsCacheExists}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
        </tr>
        <tr>
            <td>{$strings->get('appnetos__widgets__cache__css')}</td>
            <td>{if $appnetos__widgets__widget_cache->cssCache}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
            <td>{if $appnetos__widgets__widget_cache->cssCacheExists}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
        </tr>
        <tr>
            <td>{$strings->get('appnetos__widgets__cache__file')}</td>
            <td>{if $appnetos__widgets__widget_cache->fileCache}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
            <td>{if $appnetos__widgets__widget_cache->fileCacheExists}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
        </tr>
        <tr>
            <td>{$strings->get('appnetos__widgets__cache__directory')}</td>
            <td>{if $appnetos__widgets__widget_cache->directoryCache}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
            <td>{if $appnetos__widgets__widget_cache->directoryCacheExists}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
        </tr>
        <tr>
            <td>{$strings->get('appnetos__widgets__cache__string')}</td>
            <td>{if $appnetos__widgets__widget_cache->stringCache}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
            <td>{if $appnetos__widgets__widget_cache->stringCacheExists}<i class="fa fa-check" aria-hidden="true"></i>{/if}</td>
        </tr>
        </tbody>
    </table>
</div>