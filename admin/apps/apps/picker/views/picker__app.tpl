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
 * @description     Admin app picker. Open modal popup to pick an app ID.
 *                  Open:           "admin__apps__picker.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(APP ID);
*}

{* App *}
<div class="card mt-4 admin__apps__picker__pointer" onclick="admin__apps__picker.p({$admin__apps__picker__app->id})">

    {* Header *}
    <div class="card-header bg-dark text-light">
        <h5 class="mr-4 m-0">
            {$admin__apps__picker__app->name}
        </h5>
    </div>

    {* Information *}
    <div class="card-body bg-light text-dark">
        <h6>
            {$strings->get('admin__apps__picker__app_id')}: {$admin__apps__picker__app->id}
        </h6>
        {if $admin__apps__picker__app->description}
            <div class="card-subtitle text-muted">
                {$admin__apps__picker__app->description}
            </div>
        {else}
            <div class="card-subtitle text-muted"">
                {{$strings->get('admin__apps__picker__no_description')}}
            </div>
        {/if}
    </div>

</div>