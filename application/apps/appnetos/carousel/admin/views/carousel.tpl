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

{* Modal settings *}
<div class="modal fade" id="appnetos__carousel__modal_settings" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__carousel__settings')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="action" value="carousel__edit_settings">
                    <div class="form-check mt-2">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="carousel__random"{if $appnetos__carousel->settings->random} checked{/if}>
                            {$strings->get('appnetos__carousel__random')}
                        </label>
                    </div>
                    <div class="form-check mt-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="carousel__controls"{if $appnetos__carousel->settings->controls} checked{/if}>
                            {$strings->get('appnetos__carousel__controls')}
                        </label>
                    </div>
                    <div class="form-check mt-3">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="carousel__indicators"{if $appnetos__carousel->settings->indicators} checked{/if}>
                            {$strings->get('appnetos__carousel__indicators')}
                        </label>
                    </div>
                    <div class="form-group mt-4">
                        <label class="text-dark">
                            {$strings->get('appnetos__carousel__time')}
                        </label>
                        <input type="" class="form-control" name="carousel__time" value="{$appnetos__carousel->settings->time}" placeholder="{$strings->get('appnetos__carousel__time')}">
                    </div>
                    <div class="mt-3 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__carousel__confirm')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__carousel__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal add *}
<div class="modal fade" id="appnetos__carousel__modal_add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__carousel__add')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    <label class="text-dark">
                        {$strings->get('appnetos__carousel__link')}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="carousel__add_link" placeholder="{$strings->get('appnetos__carousel__link')}">
                        <div class="input-group-prepend" onclick="admin__cms__picker.pick('appnetos__carousel.pa')">
                            <div class="input-group-text">
                                <img class="appnetos__carousel__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                            </div>
                        </div>
                    </div>
                    <label class="text-dark mt-4">
                        {$strings->get('appnetos__carousel__file')} (.png, .jpg, .gif)
                    </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="carousel__add_img" name="carousel__add_img" aria-describedby="carousel__add_img" oninput="appnetos__carousel.oi(this)">
                            <label class="custom-file-label" for="carousel__add_img">
                                {$strings->get('appnetos__carousel__file')}
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__carousel__add')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__carousel__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal edit *}
<div class="modal fade" id="appnetos__carousel__modal_edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__carousel__edit')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" id="appnetos__carousel__edit_id" name="carousel__edit_id">
                    <label class="text-dark">
                        {$strings->get('appnetos__carousel__link')}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="carousel__edit_link" placeholder="{$strings->get('appnetos__carousel__link')}">
                        <div class="input-group-prepend" onclick="admin__cms__picker.pick('appnetos__carousel.pe')">
                            <div class="input-group-text">
                                <img class="appnetos__carousel__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__carousel__edit')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__carousel__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal edit image *}
<div class="modal fade" id="appnetos__carousel__modal_edit_image" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__carousel__edit_img')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit_image">
                    <input type="hidden" id="appnetos__carousel__edit_image_id" name="carousel__edit_image_id">
                    <label class="text-dark">
                        {$strings->get('appnetos__carousel__file')} (.png, .jpg, .gif)
                    </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="carousel__edit_image_img" name="carousel__edit_image_img" aria-describedby="carousel__edit_image_img">
                            <label class="custom-file-label" for="carousel__edit_image_img">
                                {$strings->get('appnetos__carousel__file')}
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__carousel__edit_img')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__carousel__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal add language *}
<div class="modal fade" id="appnetos__carousel__modal_add_language" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title text-dark">
                    {$strings->get('appnetos__carousel__add_lang')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add_language">
                    <input type="hidden" id="appnetos__carousel__add_language_id" name="carousel__add_language_id">
                    <div id="appnetos__carousel__add_language_select"></div>
                    <label class="text-dark mt-4">
                        {$strings->get('appnetos__carousel__file')} (.png, .jpg, .gif)
                    </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="carousel__add_language_img" name="carousel__add_language_img" aria-describedby="carousel__add_language_img" oninput="appnetos__carousel.oi(this)">
                            <label class="custom-file-label" for="carousel__add_language_img">
                                {$strings->get('appnetos__carousel__file')}
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__carousel__add_lang')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__carousel__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal delete *}
<div class="modal fade" id="appnetos__carousel__modal_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__carousel__remove')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-justify">
                    {$strings->get('appnetos__carousel__remove_conf')}<br>
                </div>
                <form action="" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" id="appnetos__carousel__delete_id" name="carousel__delete_id">
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-danger">
                            {$strings->get('appnetos__carousel__remove')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__carousel__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Menu *}
{$render->include('application/apps/appnetos/carousel/admin/views/carousel__menu.tpl')}
<div class="container-sidebar">

    {* Info *}
    {if $admin__info}
    <div class="container info-hide">
        <div class="row">
            <div class="col-12 text-justify mt-4">
                <div>
                    {$strings->get('appnetos__carousel__info')}
                </div>
            </div>
        </div>
    </div>
    {/if}
    <div class="container">
        <div class="row">
            {if $appnetos__carousel->confirmMsg}
            <div class="col-12 mt-4">
                <div class="alert alert-success m-0">
                    {$appnetos__carousel->confirmMsg}
                </div>
            </div>
            {/if}
            {if $appnetos__carousel->errorMsg}
            <div class="col-12 mt-4">
                <div class="alert alert-danger m-0">
                    {$appnetos__carousel->errorMsg}
                </div>
            </div>
            {/if}
        </div>
    </div>

    {* Images *}
    {assign var='appnetos__carousel__images' value=$appnetos__carousel_list->getData()}
    {if $appnetos__carousel__images}
        {assign var='appnetos__carousel__images_count' value=$appnetos__carousel__images|@count}
        {foreach from=$appnetos__carousel__images item='appnetos__carousel__image' key='appnetos__carousel__image_key' name='appnetos__carousel__image_name'}
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-dark text-light">
                                <h5 class="card-title mt-2 mr-4 float-left">
                                    {$strings->get('appnetos__carousel__img')} {$appnetos__carousel__image->sort}
                                </h5>
                                <div class="form-inline float-right">
                                    <div class="tool-tip">
                                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__carousel.de({$appnetos__carousel__image->id})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <span class="tool-tip-text bg-danger text-light">{$strings->get('appnetos__carousel__remove')}</span>
                                    </div>
                                    <div class="tool-tip">
                                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__carousel.al({$appnetos__carousel__image->id})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__carousel__add_lang')}</span>
                                    </div>
                                    {if $appnetos__carousel__images_count !== $appnetos__carousel__image->sort}
                                        <form action="" method="post">
                                            <input type="hidden" name="action" value="move_down">
                                            <input type="hidden" name="carousel__sort" value="{$appnetos__carousel__image->sort}">
                                            <div class="tool-tip">
                                                <button type="submit" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>
                                                <span class="tool-tip-text bg-primary text-light">&darr;</span>
                                            </div>
                                        </form>
                                    {/if}
                                    {if $appnetos__carousel__image->sort !== 1}
                                        <form action="" method="post">
                                            <input type="hidden" name="action" value="move_up">
                                            <input type="hidden" name="carousel__sort" value="{$appnetos__carousel__image->sort}">
                                            <div class="tool-tip">
                                                <button type="submit" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                                    <i class="fa fa-arrow-up"></i>
                                                </button>
                                                <span class="tool-tip-text bg-primary text-light">&uarr;</span>
                                            </div>
                                        </form>
                                    {/if}
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="float-left">
                                    <div class="text-secondary">
                                        {$strings->get('appnetos__carousel__link')}
                                    </div>
                                    {if $appnetos__carousel__image->link}
                                        <div class="text-dark">
                                            {$appnetos__carousel__image->link}
                                        </div>
                                    {else}
                                        <div class="text-dark">
                                            {$strings->get('appnetos__carousel__no_link')}
                                        </div>
                                    {/if}
                                </div>
                                <div class="form-inline float-right">
                                    <div class="tool-tip">
                                        <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__carousel.ed({$appnetos__carousel__image->id}, '{$appnetos__carousel__image->link}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <span class="tool-tip-text bg-primary text-light">
                                            {$strings->get('appnetos__carousel__edit')}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="float-left mr-4 mb-4 appnetos__carousel__image_set">
                                    <div>
                                        <div class="text-dark mb-2">
                                            {$strings->get('appnetos__carousel__global')}
                                        </div>
                                        <div>
                                            {if $appnetos__carousel__image->img}
                                                <img class="img-fluid appnetos__carousel__image" src="{$render->getUrl()}/out/img/appnetos/carousel/{$appnetos__carousel->appId}_{$appnetos__carousel__image->id}.{$appnetos__carousel__image->img}?{$smarty.now}">
                                            {/if}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__carousel.ei({$appnetos__carousel__image->id})">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__carousel__edit')}</span>
                                        </div>
                                    </div>
                                </div>
                                {assign var='appnetos__carousel__children' value=$appnetos__carousel__image->children}
                                {if $appnetos__carousel__children}
                                    {foreach from=$appnetos__carousel__children item='appnetos__carousel__child' key='appnetos__carousel__child_key'}
                                        <div class="float-left mr-4 mb-4 appnetos__carousel__image_set">
                                            <div>
                                                <div class="text-dark mb-2">
                                                    {$appnetos__carousel->getLanguageName($appnetos__carousel__child->languageKey)} ({$appnetos__carousel__child->languageKey})
                                                </div>
                                                <div>
                                                    {if $appnetos__carousel__child->img}
                                                        <img class="img-fluid mb-2 appnetos__carousel__image" src="{$render->getUrl()}/out/img/appnetos/carousel/{$appnetos__carousel->appId}_{$appnetos__carousel__child->id}.{$appnetos__carousel__child->img}?{$smarty.now}">
                                                    {/if}
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="tool-tip">
                                                    <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__carousel.de({$appnetos__carousel__child->id})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <span class="tool-tip-text bg-danger text-light">{$strings->get('appnetos__carousel__remove')}</span>
                                                </div>
                                                <div class="tool-tip">
                                                    <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__carousel.ei({$appnetos__carousel__child->id})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__carousel__edit')}</span>
                                                </div>
                                            </div>
                                        </div>
                                    {/foreach}
                                {/if}
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </div>
                    {if $appnetos__carousel__image->unused|@count > 0}
                        <div class="d-none" id="appnetos__carousel__add_language_select_{$appnetos__carousel__image->id}">
                            <div class="form-group">
                                <label>
                                    {$strings->get('appnetos__carousel__lang')}
                                </label>
                                <select class="form-control" name="carousel__add_language_key">
                                    {foreach from=$appnetos__carousel__image->unused item=$appnetos__carousel__unused}
                                        <option value="{$appnetos__carousel__unused}">{$appnetos__carousel->getLanguageName($appnetos__carousel__unused)} ({$appnetos__carousel__unused})</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    {/if}
                </div>
            </div>
        {/foreach}

    {* If images not exists *}
    {else}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-warning m-0">
                        {$strings->get('appnetos__carousel__no_img')}
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
                    {$strings->get('appnetos__carousel__license')}
                </div>
            </div>
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>