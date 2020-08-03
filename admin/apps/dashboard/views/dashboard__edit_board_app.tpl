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
 * @description     Admin start page and dashboards.
 *}

<div class="col-12 mt-4" data-type="admin__dashboard__dashboard__app">
    <div class="card">

        {* Header *}
        <div class="card-header bg-dark text-light">
            <h5 class="float-left mt-2 mr-4">
                {$admin__dashboard__dashboard__app->name}
            </h5>
            <div class="form-inline float-right">
                <div class="tool-tip">
                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__dashboard__dashboard.ax('removeWidget', {$admin__dashboard__dashboard__app->position}, null)">
                        <i class="fa fa-trash"></i>
                    </button>
                    <span class="tool-tip-text bg-warning text-light">{$strings->get('admin__dashboard__dashboard__remove')}</span>
                </div>
                {if !$admin__dashboard__dashboard__app->first}
                <div class="tool-tip">
                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__dashboard__dashboard.ax('moveWidgetUp', {$admin__dashboard__dashboard__app->position}, null)">
                        <i class="fa fa-arrow-up"></i>
                    </button>
                    <span class="tool-tip-text bg-primary text-light">&uarr;</span>
                </div>
                {/if}
                {if !$admin__dashboard__dashboard__app->last}
                <div class="tool-tip">
                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="admin__dashboard__dashboard.ax('moveWidgetDown', {$admin__dashboard__dashboard__app->position}, null)">
                        <i class="fa fa-arrow-down"></i>
                    </button>
                    <span class="tool-tip-text bg-primary text-light">&darr;</span>
                </div>
                {/if}
            </div>
        </div>

        {* Information *}
        <div class="card-body bg-light text-dark">
            <div class="float-left">
                <h6>
                    {$strings->get('admin__dashboard__dashboard__app_id')}: {$admin__dashboard__dashboard__app->id}
                </h6>
                {if $admin__dashboard__dashboard__app->description}
                <div class="card-subtitle text-muted" id="admin__apps_description_{$admin__dashboard__dashboard__app->id}">
                    {$admin__dashboard__dashboard__app->description}
                </div>
                {else}
                <div class="card-subtitle text-muted" id="admin__apps_description_{$admin__dashboard__dashboard__app->id}">
                    {{$strings->get('admin__dashboard__dashboard__no_description')}}
                </div>
                {/if}
            </div>
            <div class="form-inline float-right">
                {if $admin__dashboard__dashboard__app->active}
                <span class="bg-success text-light rounded py-1 px-2">{$strings->get('admin__dashboard__dashboard__activated')}</span>
                {else}
                <span class="bg-danger text-light rounded py-1 px-2">{$strings->get('admin__dashboard__dashboard__deactivated')}</span>
                {/if}
            </div>
        </div>

    </div>
</div>