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
 * @description     Admin URI apps management.
 *}

{* URI *}
<div class="col-12 mt-4" data-type="admin__cms__manage_apps__uri">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            {if $admin__cms__manage_apps__uri->uri !== ""}
                <a href="{$render->getUrl()}/{$admin__cms__manage_apps__uri->uri}" target="_blank">
                    <h5 class="mt-2 word-break">
                        {$admin__cms__manage_apps__uri->uri}
                    </h5>
                </a>
            {else}
                <a href="{$render->getUrl()}" target="_blank">
                    <h5 class="mt-2 word-break">
                        {{$strings->get('admin__cms__manage_apps__home')}}
                    </h5>
                </a>
            {/if}
        </div>

        {* Information *}
        <div class="card-body bg-light text-dark">
            <h6 class="m-0">
                <strong>
                    {$strings->get('admin__cms__manage_apps__uri_id')}: {$admin__cms__manage_apps__uri->id}
                </strong>
            </h6>
        </div>

        {* Details view *}
        {if $admin__cms__manage_apps__search->view === 'details'}

            {* Menu *}
            <div class="card-body bg-light text-dark p-0">
                <div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="" data-nav="properties" onclick="event.preventDefault()">
                                {$strings->get('admin__cms__manage_apps__properties')}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {* Properties *}
            <div class="card-body bg-white text-dark" data-type="properties">
                <div class="row">
                    <div class="col-sm-12 col-md-4 mb-4">
                        <div>
                            {$strings->get('admin__cms__manage_apps__views')}
                        </div>
                        <div class="text-secondary">
                            {$admin__cms__manage_apps__uri->views}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-4">
                        <div>
                            {$strings->get('admin__cms__manage_apps__apps')}
                        </div>
                        <div class="text-secondary">
                            {$admin__cms__manage_apps__uri->appsCount}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-4">
                        <div>
                            {$strings->get('admin__cms__manage_apps__languages')}
                        </div>
                        <div class="text-secondary">
                            {$admin__cms__manage_apps__uri->languagesCount}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-4">
                        <div>
                            {$strings->get('admin__cms__manage_apps__title')}
                        </div>
                        <div class="text-secondary word-break">
                            {if $admin__cms__manage_apps__uri->title !== ''}
                                {$admin__cms__manage_apps__uri->title}
                            {else}
                                {{$strings->get('admin__cms__manage_apps__language_settings')}}
                            {/if}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mb-4">
                        <div>
                            {$strings->get('admin__cms__manage_apps__favicon')}
                        </div>
                        <div class="text-secondary word-break">
                            {if $admin__cms__manage_apps__uri->favicon !== ""}
                                {$admin__cms__manage_apps__uri->favicon}
                            {else}
                                {{$strings->get('admin__cms__manage_apps__language_settings')}}
                            {/if}
                        </div>
                    </div>
                    {assign var="admin__cms__manage_apps__languages" value=$admin__cms__manage_apps__uri->getLanguages()}
                    {if $admin__cms__manage_apps__languages}
                        <div class="col-sm-12">
                            <div>
                                {$strings->get('admin__cms__manage_apps__languages')}
                            </div>
                            <div class="text-secondary">
                                {$admin__cms__manage_apps__languages}
                            </div>
                        </div>
                    {/if}
                </div>
            </div>

        {/if}

    </div>
</div>