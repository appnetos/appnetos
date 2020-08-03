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
 * @description     APPNET OS Marketplace.
 *}

{* On error *}
{if $admin__apps__marketplace__cart->error}
    <div class="col-12 mt-4">
        <div class="alert alert-danger m-0">
            {$admin__apps__marketplace__cart->error}
        </div>
    </div>
{/if}

{* On success *}
{if $admin__apps__marketplace__cart->success}
    <div class="col-12 mt-4">
        <div class="alert alert-success m-0">
            {$admin__apps__marketplace__cart->success}
        </div>
    </div>
{/if}

{* If user signed in *}
{if $admin__apps__marketplace__user->token && $admin__apps__marketplace__user->user }

    {* If cart is not empty *}
    {if $admin__apps__marketplace__cart->cart !== 'empty'}

        {* Modal update *}
        <div id="admin__apps__marketplace__modal_refresh" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h5 class="modal-title">
                            {$strings->get('admin__apps__marketplace__refresh')}
                        </h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            {$strings->get('admin__apps__marketplace__refresh_text')}
                        </div>
                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-primary" onclick="admin__apps__marketplace.ln()">
                                {$strings->get('admin__apps__marketplace__refresh')}
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {$strings->get('admin__apps__marketplace__close')}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {* Content *}
        <div class="col-12 mt-4">
            {$admin__apps__marketplace__cart->cart}
        </div>

        <div class="col-12 mt-4 text-right">
            <form action="{$admin__apps__marketplace__url->get('marketplace/checkout')}" method="post" target="_blank" onsubmit="$('#admin__apps__marketplace__modal_refresh').modal('show')">
                <input type="hidden" name="token" value="{$admin__apps__marketplace__user->token}">
                <input type="hidden" name="secret" value="{$admin__apps__marketplace__user->secret}">
                <input type="hidden" name="user" value="{$admin__apps__marketplace__user->user}">
                <button type="submit" class="btn btn-primary">
                    {$strings->get('admin__apps__marketplace__button_checkout')}
                </button>
            </form>
        </div>

    {* If cart is empty *}
    {else}
        <div class="col-12 mt-4">
            <div class="alert alert-warning m-0">
                {$strings->get('admin__apps__marketplace__cart_empty')}
            </div>
        </div>
    {/if}

    {* If user not signed in *}
{else}

    <div class="col-12 mt-4">
        <div class="alert alert-danger m-0">
            {$strings->get('admin__apps__marketplace__not_signed_in')}
        </div>
    </div>

{/if}