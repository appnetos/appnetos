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

{* Widget cache *}
<div id="app-{$appnetos__widgets__widget_remove_demo->appId}" class="col-sm-12 col-md-6 col-lg-6 col-xl-4 mt-4">

    {* Modal warning *}
    <div class="modal fade" id="appnetos__widget__widget_remove_demo__modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        {$strings->get('appnetos__widgets__remove_demo__warning')}
                    </div>
                    <div class="text-right mt-4">
                        <form action="" method="post">
                            <input type="hidden" name="appnetos__widget__widget_remove_demo__remove" value="on">
                            <button type="submit" class="btn btn-danger">
                                {$strings->get('appnetos__widgets__remove_demo__remove')}
                            </button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('appnetos__widgets__remove_demo__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card border border-dark">

        {* Header *}
        <div class="bg-dark p-2">
            <div class="float-left"><img class="appnetos__widget__widget_remove_demo__icon mr-2" src="{$render->getUrl()}/out/admin/img/appnetos/widget_remove_demo.svg"></div>
            <h5 class="float-left text-light mt-1">
                {$strings->get('appnetos__widgets__remove_demo__header')}
            </h5>
        </div>

        {* Body *}
        <div class="card-body">
            <div>
                {$strings->get('appnetos__widgets__remove_demo__text')}
            </div>
            <div class="text-right">
                <button class="btn btn-danger mt-4" data-toggle="modal" data-target="#appnetos__widget__widget_remove_demo__modal">
                    {$strings->get('appnetos__widgets__remove_demo__remove')}
                </button>
            </div>
        </div>

    </div>
</div>