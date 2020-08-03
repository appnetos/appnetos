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
 * @description     Admin admin group picker. Open modal popup to pick an app ID.
 *                  Open:           "admin__groups__picker_admin.pick('mynamespace.myfunction');
 *                  Select: Execute "mynamespace.myfunction(APP ID);
*}

{* Group *}
<div class="card mt-4 admin__groups__picker_admin__pointer" onclick="admin__groups__picker_admin.p({$admin__groups__picker_admin__group->id})">

    {* Header *}
    <div class="card-header bg-dark text-light">
        <h5 class="mr-4 m-0">
            {$admin__groups__picker_admin__group->name}
        </h5>
    </div>

    {* Information *}
    <div class="card-body bg-light text-dark">
        <h6>
            {$strings->get('admin__groups__picker_admin__group_id')}: {$admin__groups__picker_admin__group->id}
        </h6>
        <div class="row">
            {if !$admin__groups__picker_admin__group->deniedCount}
                {if !$admin__groups__picker_admin__group->grantedCount}
                    <div class="col-sm-12 col-md-6 my-2">
                        <div class="mb-2">
                            {$strings->get("admin__groups__picker_admin__denied_uris")}
                        </div>
                        <div>
                            <span class="bg-danger text-light rounded py-1 px-2">
                                {$strings->get("admin__groups__picker_admin__non")}
                            </span>
                        </div>
                    </div>
                {else}
                    <div class="col-sm-12 col-md-6 my-2">
                        <div class="mb-2">
                            {$strings->get("admin__groups__picker_admin__denied_uris")}
                        </div>
                        <div>
                            <span class="bg-danger text-light rounded py-1 px-2">
                                {$strings->get("admin__groups__picker_admin__all_but_granted")}
                            </span>
                        </div>
                    </div>
                {/if}
            {else}
                <div class="col-sm-12 col-md-6 my-2">
                    <div class="mb-2">
                        {$strings->get("admin__groups__picker_admin__denied_uris")}
                    </div>
                    <div>
                        <span class="bg-danger text-light rounded py-1 px-2">
                            {$admin__groups__picker_admin__group->deniedCount}
                        </span>
                    </div>
                </div>
            {/if}
            {if !$admin__groups__picker_admin__group->grantedCount}
                {if !$admin__groups__picker_admin__group->deniedCount}
                    <div class="col-sm-12 col-md-6 my-2">
                        <div class="mb-2">
                            {$strings->get("admin__groups__picker_admin__granted_uris")}
                        </div>
                        <div>
                            <span class="bg-success text-light rounded py-1 px-2">
                                {$strings->get("admin__groups__picker_admin__all")}
                            </span>
                        </div>
                    </div>
                {else}
                    <div class="col-sm-12 col-md-6 my-2">
                        <div class="mb-2">
                            {$strings->get("admin__groups__picker_admin__granted_uris")}
                        </div>
                        <div>
                            <span class="bg-success text-light rounded py-1 px-2">
                                {$strings->get("admin__groups__picker_admin__all_but_denied")}
                            </span>
                        </div>
                    </div>
                {/if}
            {else}
                <div class="col-sm-12 col-md-6 my-2">
                    <div class="mb-2">
                        {$strings->get("admin__groups__picker_admin__granted_uris")}
                    </div>
                    <div>
                        <span class="bg-success text-light rounded py-1 px-2">
                            {$admin__groups__picker_admin__group->grantedCount}
                        </span>
                    </div>
                </div>
            {/if}
        </div>
    </div>

</div>