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
 * @description     Admin app creator to build apps.
 *}

{* Overview *}
<div class="container">
    <div class="row">

        {* Info *}
        {if $admin__info}
            <div class="col-12 mt-4 text-justify info-hide">
                {$strings->get('admin__apps__create__info')}
            </div>
        {/if}

        {* HTML Template app *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-4">
            <a class="admin__apps__create__text" href="{$render->getUrl(304)}/html">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h5 class="m-0">
                            {$strings->get('admin__apps__create__html_header')}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="float-left">
                            <img class="admin__apps__create__img mr-4" src="{$render->getUrl()}/out/admin/img/appnetos/html.png" alt="" />
                        </div>
                        <div class="text-dark text-justify">
                            {$strings->get('admin__apps__create__html_description')}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {* HTML Template app *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-4">
            <a class="admin__apps__create__text" href="{$render->getUrl(304)}/html-string">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h5 class="m-0">
                            {$strings->get('admin__apps__create__html_string_header')}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="float-left">
                            <img class="admin__apps__create__img mr-4" src="{$render->getUrl()}/out/admin/img/appnetos/html-string.png" alt="" />
                        </div>
                        <div class="text-dark text-justify">
                            {$strings->get('admin__apps__create__html_sting_description')}
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {* Developer app *}
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-4">
            <a class="admin__apps__create__text" href="{$render->getUrl(304)}/developer">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h5 class="m-0">
                            {$strings->get('admin__apps__create__dev_header')}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="float-left">
                            <img class="admin__apps__create__img mr-4" src="{$render->getUrl()}/out/admin/img/appnetos/developer.png" alt="" />
                        </div>
                        <div class="text-dark text-justify">
                            {$strings->get('admin__apps__create__dev_description')}
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>