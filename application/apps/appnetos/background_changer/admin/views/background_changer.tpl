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
 * @description     Background Changer. Define background to set as container-fluid CSS, container CSS or app CSS.
 *                  Defined background can set as random background.
 *}

{* Modal add *}
<div class="modal fade" id="appnetos__background_changer__modal_add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__background_changer__add')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    <label class="text-dark">
                        {$strings->get('appnetos__background_changer__file')} (.svg, .png, .jpg, .gif) <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="background_changer_add_image" name="add_image" aria-describedby="background_changer_add_image" oninput="appnetos__background_changer.oi(this)">
                            <label class="custom-file-label" for="background_changer_add_image">
                                {$strings->get('appnetos__background_changer__file')}
                            </label>
                        </div>
                    </div>
                    <label class="text-dark mt-4">
                        {$strings->get('appnetos__background_changer__color')} (#hex) <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="add_color" maxlength="7" value="#" placeholder="{$strings->get('appnetos__background_changer__color')} (#hex)">
                    </div>
                    <label class="text-dark mt-4">
                        {$strings->get('appnetos__background_changer__repeat')} <span class="text-danger">*</span>
                    </label>
                    <div class="form-group">
                        <select class="form-control" name="add_repeat">
                            <option value="no-repeat">no-repeat</option>
                            <option value="repeat">repeat</option>
                            <option value="repeat-x">repeat-x</option>
                            <option value="repeat-y">repeat-y</option>
                        </select>
                    </div>
                    <label class="text-dark mt-4">
                        {$strings->get('appnetos__background_changer__width')} (px {$strings->get('appnetos__background_changer__or')} %)
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="add_width" maxlength="10" placeholder="{$strings->get('appnetos__background_changer__width')} (% {$strings->get('appnetos__background_changer__or')} px)">
                    </div>
                    <label class="text-dark mt-4">
                        {$strings->get('appnetos__background_changer__height')} (px {$strings->get('appnetos__background_changer__or')} %)
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="add_height" maxlength="10" placeholder="{$strings->get('appnetos__background_changer__height')} (% {$strings->get('appnetos__background_changer__or')} px)">
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__background_changer__add')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__background_changer__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Assign images *}
{assign var='appnetos__background_changer__images' value=$appnetos__background_changer->images}

{* Modal edit *}
{foreach from=$appnetos__background_changer__images item='appnetos__background_changer__image' key='appnetos__background_changer__image_key' name='appnetos__background_changer__image_name'}
    <div class="modal fade" id="appnetos__background_changer__modal_edit_{$appnetos__background_changer__image->id}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title">
                        {$strings->get('appnetos__background_changer__edit')}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="edit_id" value="{$appnetos__background_changer__image->id}">
                        <label class="text-dark">
                            {$strings->get('appnetos__background_changer__file')} (.svg, .png, .jpg, .gif) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="background_changer_edit_image_{$appnetos__background_changer__image->id}" name="edit_image" aria-describedby="background_changer_add_image" oninput="appnetos__background_changer.oi(this)">
                                <label class="custom-file-label" for="background_changer_edit_image_{$appnetos__background_changer__image->id}">
                                    {$strings->get('appnetos__background_changer__file')}
                                </label>
                            </div>
                        </div>
                        {if $appnetos__background_changer__image->image}
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="edit_delete_image" id="background_changer__edit_check_{$appnetos__background_changer__image->id}">
                                <label class="form-check-label" for="background_changer__edit_check_{$appnetos__background_changer__image->id}">{$strings->get('appnetos__background_changer__delete_image')}</label>
                            </div>
                        {/if}
                        <label class="text-dark mt-4">
                            {$strings->get('appnetos__background_changer__color')} (#hex) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="edit_color" maxlength="7" value="{$appnetos__background_changer__image->color}" placeholder="{$strings->get('appnetos__background_changer__color')} (#hex)">
                        </div>
                        <label class="text-dark mt-4">
                            {$strings->get('appnetos__background_changer__repeat')} <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <select class="form-control" name="edit_repeat">
                                <option value="no-repeat"{if $appnetos__background_changer__image->repeat === 'no-repeat'} selected{/if}>no-repeat</option>
                                <option value="repeat"{if $appnetos__background_changer__image->repeat === 'repeat'} selected{/if}>repeat</option>
                                <option value="repeat-x"{if $appnetos__background_changer__image->repeat === 'repeat-x'} selected{/if}>repeat-x</option>
                                <option value="repeat-y"{if $appnetos__background_changer__image->repeat === 'repeat-y'} selected{/if}>repeat-y</option>
                            </select>
                        </div>
                        <label class="text-dark mt-4">
                            {$strings->get('appnetos__background_changer__width')} (px {$strings->get('appnetos__background_changer__or')} %)
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="edit_width" maxlength="10" value="{$appnetos__background_changer__image->width}" placeholder="{$strings->get('appnetos__background_changer__width')} (% {$strings->get('appnetos__background_changer__or')} px)">
                        </div>
                        <label class="text-dark mt-4">
                            {$strings->get('appnetos__background_changer__height')} (px {$strings->get('appnetos__background_changer__or')} %)
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="edit_height" maxlength="10" value="{$appnetos__background_changer__image->height}" placeholder="{$strings->get('appnetos__background_changer__height')} (% {$strings->get('appnetos__background_changer__or')} px)">
                        </div>
                        <div class="mt-4 text-right">
                            <button type="submit" class="btn btn-primary">
                                {$strings->get('appnetos__background_changer__edit')}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {$strings->get('appnetos__background_changer__close')}
                    </button>
                </div>
            </div>
        </div>
    </div>
{/foreach}

{* Menu *}
{$render->include('application/apps/appnetos/background_changer/admin/views/background_changer__menu.tpl')}
<div class="container-sidebar">

    {* Info *}
    {if $admin__info}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 text-justify mt-4">
                    <div>
                        {$strings->get('appnetos__background_changer__info')}
                    </div>
                </div>
            </div>
        </div>
    {/if}
    <div class="container">
        <div class="row">
            {if $appnetos__background_changer->confirmMsg}
                <div class="col-12 mt-4">
                    <div class="alert alert-success m-0">
                        {$appnetos__background_changer->confirmMsg}
                    </div>
                </div>
            {/if}
            {if $appnetos__background_changer->errorMsg}
                <div class="col-12 mt-4">
                    <div class="alert alert-danger m-0">
                        {$appnetos__background_changer->errorMsg}
                    </div>
                </div>
            {/if}
        </div>
    </div>

    {* CSS info *}
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="alert alert-secondary m-0">
                    {$strings->get('appnetos__background_changer__css_info')}<br>
                    <strong>appnetos__background_changer__{$appnetos__background_changer->appId}</strong>
                </div>
            </div>
        </div>
    </div>

    {* Images *}
    {assign var='appnetos__background_changer__images_count' value=$appnetos__background_changer__images|@count}
    {assign var='appnetos__background_changer__images_index' value=1}
    {if $appnetos__background_changer__images_count > 0}
        {foreach from=$appnetos__background_changer__images item='appnetos__background_changer__image' key='appnetos__background_changer__image_key' name='appnetos__background_changer__image_name'}
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-dark text-light">
                                <h5 class="card-title mt-2 mr-4 float-left">
                                    {$strings->get('appnetos__background_changer__image')} {$appnetos__background_changer__images_index}
                                </h5>
                                <div class="form-inline float-right">
                                    <div class="tool-tip">
                                        <form method="post">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="delete_id" value="{$appnetos__background_changer__image->id}">
                                            <button type="submit" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        <span class="tool-tip-text bg-danger text-light">{$strings->get('appnetos__background_changer__delete')}</span>
                                    </div>
                                    <div class="tool-tip">
                                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" data-toggle="modal" data-target="#appnetos__background_changer__modal_edit_{$appnetos__background_changer__image->id}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__background_changer__edit')}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {if $appnetos__background_changer__image->image}
                                    <div class="float-left mr-4 mb-4">
                                        <div>
                                            <div>
                                                <img class="img-fluid appnetos__background_changer__image" src="{$render->getUrl()}/out/img/appnetos/background_changer/{$appnetos__background_changer->appId}_{$appnetos__background_changer__image->id}.{$appnetos__background_changer__image->image}?{$smarty.now}">
                                            </div>
                                        </div>
                                    </div>
                                {/if}
                                <div class="float-left">
                                    <div>
                                        <strong>ID:</strong> <span class="text-secondary">{$appnetos__background_changer__image->id}</span>
                                    </div>
                                    <div class="mt-2">
                                        <strong>{$strings->get('appnetos__background_changer__color')}:</strong>
                                        {if $appnetos__background_changer__image->color}
                                            <span class="text-secondary">{$appnetos__background_changer__image->color}</span>
                                        {else}
                                            <span class="text-secondary">{$strings->get('appnetos__background_changer__not_defined')}</span>
                                        {/if}
                                    </div>
                                    <div>
                                        <strong>CSS:</strong> <span class="text-secondary">appnetos__background_changer__{$appnetos__background_changer__image->id}</span>
                                    </div>
                                    <div class="mt-2">
                                        <strong>{$strings->get('appnetos__background_changer__color')}:</strong>
                                        {if $appnetos__background_changer__image->color}
                                            <span class="text-secondary">{$appnetos__background_changer__image->color}</span>
                                        {else}
                                            <span class="text-secondary">{$strings->get('appnetos__background_changer__not_defined')}</span>
                                        {/if}
                                    </div>
                                    <div class="mt-2">
                                        <strong>{$strings->get('appnetos__background_changer__repeat')}:</strong>
                                        {if $appnetos__background_changer__image->repeat}
                                            <span class="text-secondary">{$appnetos__background_changer__image->repeat}</span>
                                        {else}
                                            <span class="text-secondary">{$strings->get('appnetos__background_changer__not_defined')}</span>
                                        {/if}
                                    </div>
                                    <div class="mt-2">
                                        <strong>{$strings->get('appnetos__background_changer__width')}:</strong>
                                        {if $appnetos__background_changer__image->width}
                                            <span class="text-secondary">{$appnetos__background_changer__image->width}</span>
                                        {else}
                                            <span class="text-secondary">{$strings->get('appnetos__background_changer__not_defined')}</span>
                                        {/if}
                                    </div>
                                    <div class="mt-2">
                                        <strong>{$strings->get('appnetos__background_changer__height')}:</strong>
                                        {if $appnetos__background_changer__image->height}
                                            <span class="text-secondary">{$appnetos__background_changer__image->height}</span>
                                        {else}
                                            <span class="text-secondary">{$strings->get('appnetos__background_changer__not_defined')}</span>
                                        {/if}
                                    </div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {assign var='appnetos__background_changer__images_index' value=$appnetos__background_changer__images_index+1}
        {/foreach}

    {* If images not exists *}
    {else}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-warning m-0">
                        {$strings->get('appnetos__background_changer__no_image')}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* License *}
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="bg-light text-secondary text-justify p-3">
                    {$strings->get('appnetos__background_changer__license')}
                </div>
            </div>
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>