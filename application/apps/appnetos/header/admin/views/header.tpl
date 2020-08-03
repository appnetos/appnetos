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
 * @description     Header application with selectable logo and selectable, animated social media icons.
*}

{* Modal add *}
<div class="modal fade" id="appnetos__header__modal_add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__header__add')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" id="appnetos__header__add_logo" name="header__add_logo">
                    <label>
                        {$strings->get('appnetos__header__link')}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="header__add_link" placeholder="{$strings->get('appnetos__header__link')}">
                        <div class="input-group-prepend" onclick="admin__cms__picker.pick('appnetos__header.pa')">
                            <div class="input-group-text">
                                <img class="appnetos__header__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label>
                            {$strings->get('appnetos__header__width')}
                        </label>
                        <input type="text" class="form-control" name="header__add_width" placeholder="Width">
                    </div>
                    <label class="mt-4">
                        {$strings->get('appnetos__header__file')} (.svg, .png, .jpg, .gif)
                    </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="header__add_img" name="header__add_img" aria-describedby="header__add_img" oninput="appnetos__header.oi(this)">
                            <label class="custom-file-label" for="header__add_img">{$strings->get('appnetos__header__file')}</label>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__header__add')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{$strings->get('appnetos__header__close')}</button>
            </div>
        </div>
    </div>
</div>

{* Modal edit *}
<div class="modal fade" id="appnetos__header__edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__header__edit')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" id="appnetos__header__edit_id" name="header__edit_id">
                    <label>
                        {$strings->get('appnetos__header__link')}
                    </label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="header__edit_link" id="appnetos__header__edit_link" placeholder="{$strings->get('appnetos__header__link')}">
                        <div class="input-group-prepend" onclick="admin__cms__picker.pick('appnetos__header.pe')">
                            <div class="input-group-text">
                                <img class="appnetos__header__search" src="{$render->getUrl()}/out/admin/img/appnetos/search.svg">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <label>
                            {$strings->get('appnetos__header__width')}
                        </label>
                        <input type="" class="form-control" name="header__edit_width" id="appnetos__header__edit_width" placeholder="Width">
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__header__edit')}
                        </button>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__header__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal edit image *}
<div class="modal fade" id="appnetos__header__modal_edit_images" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__header__edit_img')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit_images">
                    <input type="hidden" id="appnetos__header__edit_images_id" name="header__edit_images_id">
                    <label>
                        {$strings->get('appnetos__header__file')} (.svg, .png, .jpg, .gif)
                    </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="header__edit_images_img" name="header__edit_images_img" aria-describedby="header__edit_images_img" oninput="appnetos__header.oi(this)">
                            <label class="custom-file-label" for="header__edit_images_img">
                                {$strings->get('appnetos__header__file')}
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__header__edit_img')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__header__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal add language *}
<div class="modal fade" id="appnetos__header__modal_add_language" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <label class="modal-title">
                    {$strings->get('appnetos__header__add_lang')}
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add_language">
                    <input type="hidden" id="appnetos__header__add_language_id" name="header__add_language_id">
                    <div id="header__add_language_select"></div>
                    <label>
                        {$strings->get('appnetos__header__file')} (.svg, .png, .jpg, .gif)
                    </label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="header__add_language_img" name="header__add_language_img" aria-describedby="header__add_language_img" oninput="appnetos__header.oi(this)">
                            <label class="custom-file-label" for="header__add_language_img">
                                {$strings->get('appnetos__header__file')}
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">
                            {$strings->get('appnetos__header__add_lang')}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__header__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal delete *}
<div class="modal fade" id="appnetos__header__modal_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__header__remove')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-justify">
                    {$strings->get('appnetos__header__remove_conf')}<br>
                </div>
                <div class="mt-3 text-right">
                    <form action="" method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" id="appnetos__header__delete_id" name="header__delete_id">
                        <button type="submit" class="btn btn-danger">
                            {$strings->get('appnetos__header__remove')}
                        </button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__header__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Modal fast select *}
<div class="modal fade" id="appnetos__header__modal_fast_select" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">
                    {$strings->get('appnetos__header__add_fast_sel')}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {assign var="icons" value=$appnetos__header__list->fastSelect}
                {foreach from=$icons item="item"}
                    <div class="float-left">
                        <form action="" method="post">
                            <input type="hidden" name="action" value="fast_select">
                            <input type="hidden" name="header__selection" value="{$item}">
                            <button type="submit" class="mb-2 mr-2" style="border: 0; cursor: pointer"><img src="{$render->getUrl()}/{$item}" style="width: 50px; border: 0;"></button>
                        </form>
                    </div>
                {/foreach}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {$strings->get('appnetos__header__close')}
                </button>
            </div>
        </div>
    </div>
</div>

{* Menu *}
{$render->include('application/apps/appnetos/header/admin/views/header__menu.tpl')}
<div class="container-sidebar">

    {* Info *}
    {if $admin__info}
        <div class="container info-hide">
            <div class="row">
                <div class="col-12 text-justify mt-4">
                    {$strings->get('appnetos__header__info')}
                </div>
            </div>
        </div>
    {/if}
    <div class="container">
        <div class="row">
            {if $appnetos__header->confirmMsg}
                <div class="col-12 mt-4">
                    <div class="alert alert-success m-0">
                        {$appnetos__header->confirmMsg}
                    </div>
                </div>
            {/if}
            {if $appnetos__header->errorMsg}
                <div class="col-12 mt-4">
                    <div class="alert alert-danger m-0">
                        {$appnetos__header->errorMsg}
                    </div>
                </div>
            {/if}
        </div>
    </div>

    {* Logo *}
    {if $appnetos__header__list->logo}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h5 class="card-title mt-2 mr-4 float-left">
                                {$strings->get('appnetos__header__logo')}
                            </h5>
                            <div class="form-inline float-right">
                                <div class="tool-tip">
                                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__header.de({$appnetos__header__list->logo->id})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <span class="tool-tip-text bg-danger text-light">
                                        {$strings->get('appnetos__header__remove')}
                                    </span>
                                </div>
                                <div class="tool-tip">
                                    <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__header.al({$appnetos__header__list->logo->id})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <span class="tool-tip-text bg-primary text-light">
                                        {$strings->get('appnetos__header__add_lang')}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="float-left">
                                <div class="text-secondary">
                                    {$strings->get('appnetos__header__link')}
                                </div>
                                <div>
                                    {$appnetos__header__list->logo->link}
                                </div>
                                <div class="text-secondary mt-2">
                                    {$strings->get('appnetos__header__width')}
                                </div>
                                <div>
                                    {$appnetos__header__list->logo->width}
                                </div>
                            </div>
                            <div class="form-inline float-right">
                                <div class="tool-tip">
                                    <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__header.ed({$appnetos__header__list->logo->id}, '{$appnetos__header__list->logo->link}', {$appnetos__header__list->logo->width})">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__header___edit')}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="float-left">
                                <div>
                                    {$strings->get('appnetos__header__global')}
                                </div>
                                {if $appnetos__header__list->logo->img}
                                    <img class="img-fluid appnetos__carousel__image mt-2" src="{$render->getUrl()}/out/img/appnetos/header/{$appnetos__header->appId}_{$appnetos__header__list->logo->id}.{$appnetos__header__list->logo->img}?{$smarty.now}" style="max-width: 300px;">
                                {/if}
                            </div>
                            <div class="form-inline float-right">
                                <div class="tool-tip">
                                    <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__header.ei({$appnetos__header__list->logo->id})">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__header___edit')}</span>
                                </div>
                            </div>
                        </div>
                        {assign var="appnetos__header__children" value=$appnetos__header__list->logo->children}
                        {if $appnetos__header__children}
                            {foreach from=$appnetos__header__children item="appnetos__header__child" key="appnetos__header__child__key"}
                                <div class="card-body">
                                    <div class="float-left">
                                        <div>
                                            {$appnetos__header->getLanguageName($appnetos__header__child->languageKey)} ({$appnetos__header__child->languageKey})
                                        </div>
                                        {if $appnetos__header__child->img}
                                            <img class="img-fluid appnetos__carousel__image mt-2" src="{$render->getUrl()}/out/img/appnetos/header/{$appnetos__header->appId}_{$appnetos__header__child->id}.{$appnetos__header__child->img}?{$smarty.now}" style="max-width: 300px;">
                                        {/if}
                                    </div>
                                    <div class="form-inline float-right">
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__header.de({$appnetos__header__child->id})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <span class="tool-tip-text bg-danger text-light">{$strings->get('appnetos__header__remove')}</span>
                                        </div>
                                        <div class="tool-tip">
                                            <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__header.ei({$appnetos__header__child->id})">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__header___edit')}</span>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                        {/if}
                    </div>
                </div>

                {* List of unused languages *}
                {if $appnetos__header__list->logo->unused|@count > 0}
                    <div class="d-none" id="header__add_language_select_{$appnetos__header__list->logo->id}">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">
                                {$strings->get('appnetos__header__lang')}
                            </label>
                            <select class="form-control" name="header__add_language_key">
                                {foreach from=$appnetos__header__list->logo->unused item=$appnetos__header__unused}
                                    <option value="{$appnetos__header__unused}">{$appnetos__header->getLanguageName($appnetos__header__unused)} ({$appnetos__header__unused})</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                {/if}

            </div>
        </div>

    {* If logo not exists *}
    {else}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-warning m-0">
                        {$strings->get('appnetos__header__no_logo')}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Icons *}
    <div class="container mt-5"> </div>
    {assign var="appnetos__header__icons" value=$appnetos__header__list->getIcons()}
    {if $appnetos__header__icons}
        {$appnetos__header__icons_count = 1}
        {foreach from=$appnetos__header__icons item="appnetos__header__icon" key="appnetos__header__icon__key" name="appnetos__header__icon__name"}
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-dark text-light">
                                <h5 class="card-title mt-2 mr-4 float-left">
                                    {$strings->get('appnetos__header__icons')} {$appnetos__header__icons_count}
                                </h5>
                                <div class="form-inline float-right">
                                    <div class="tool-tip">
                                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__header.de({$appnetos__header__icon->id})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <span class="tool-tip-text bg-danger text-light">{$strings->get('appnetos__header__icon_remove')}</span>
                                    </div>
                                    <div class="tool-tip">
                                        <button type="button" class="btn btn-outline-light mt-1 ml-1 text-decoration-none" onclick="appnetos__header.al({$appnetos__header__icon->id})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__header__add_lang')}</span>
                                    </div>
                                    {if not $smarty.foreach.appnetos__header__icon__name.last}
                                        <form action="" method="post">
                                            <input type="hidden" name="action" value="move_down">
                                            <input type="hidden" name="header__sort" value="{$appnetos__header__icon->sort}">
                                            <div class="tool-tip">
                                                <button type="submit" class="btn btn-outline-light mt-1 ml-1 text-decoration-none">
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>
                                                <span class="tool-tip-text bg-primary text-light">&darr;</span>
                                            </div>
                                        </form>
                                    {/if}
                                    {if $appnetos__header__icon->sort > 1}
                                        <form action="" method="post">
                                            <input type="hidden" name="action" value="move_up">
                                            <input type="hidden" name="header__sort" value="{$appnetos__header__icon->sort}">
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
                                        {$strings->get('appnetos__header__link')}
                                    </div>
                                    <div>
                                        {$appnetos__header__icon->link}
                                    </div>
                                    <div class="text-secondary mt-2">
                                        {$strings->get('appnetos__header__width')}
                                    </div>
                                    <div>
                                        {$appnetos__header__icon->width}
                                    </div>
                                </div>
                                <div class="form-inline float-right">
                                    <div class="tool-tip">
                                        <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__header.ed({$appnetos__header__icon->id}, '{$appnetos__header__icon->link}', {$appnetos__header__icon->width})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__header___edit')}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="float-left">
                                    <div>
                                        {$strings->get('appnetos__header__global')}
                                    </div>
                                    {if $appnetos__header__icon->img}
                                        <img class="img-fluid appnetos__carousel__image mt-2" src="{$render->getUrl()}/out/img/appnetos/header/{$appnetos__header->appId}_{$appnetos__header__icon->id}.{$appnetos__header__icon->img}?{$smarty.now}" style="max-width: 100px">
                                    {/if}
                                </div>
                                <div class="form-inline float-right">
                                    <div class="tool-tip">
                                        <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__header.ei({$appnetos__header__icon->id})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__header___edit')}</span>
                                    </div>
                                </div>
                            </div>
                            {assign var="appnetos__header__children" value=$appnetos__header__icon->children}
                            {if $appnetos__header__children}
                                {foreach from=$appnetos__header__children item="appnetos__header__child" key="appnetos__header__child__key"}
                                    <div class="card-body">
                                        <div class="float-left">
                                            <div>
                                                {$appnetos__header->getLanguageName($appnetos__header__child->languageKey)} ({$appnetos__header__child->languageKey})
                                            </div>
                                            {if $appnetos__header__child->img}
                                                <img class="img-fluid appnetos__carousel__image mt-2" src="{$render->getUrl()}/out/img/appnetos/header/{$appnetos__header->appId}_{$appnetos__header__child->id}.{$appnetos__header__child->img}?{$smarty.now}" style="max-width: 100px">
                                            {/if}
                                        </div>
                                        <div class="form-inline float-right">
                                            <div class="tool-tip">
                                                <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__header.de({$appnetos__header__child->id})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <span class="tool-tip-text bg-danger text-light">{$strings->get('appnetos__carousel__remove')}</span>
                                            </div>
                                            <div class="tool-tip">
                                                <button type="button" class="btn btn-outline-dark mt-1 ml-1 text-decoration-none" onclick="appnetos__header.ei({$appnetos__header__child->id})">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <span class="tool-tip-text bg-primary text-light">{$strings->get('appnetos__header___edit')}</span>
                                            </div>
                                        </div>
                                    </div>
                                {/foreach}
                            {/if}
                        </div>
                    </div>

                    {* List of unused languages *}
                    {if $appnetos__header__icon->unused|@count > 0}
                        <div class="d-none" id="header__add_language_select_{$appnetos__header__icon->id}">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">
                                    {$strings->get('appnetos__header__lang')}
                                </label>
                                <select class="form-control" name="header__add_language_key">
                                    {foreach from=$appnetos__header__icon->unused item=$appnetos__header__unused}
                                        <option value="{$appnetos__header__unused}">{$appnetos__header->getLanguageName($appnetos__header__unused)} ({$appnetos__header__unused})</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    {/if}

                </div>
            </div>
            {$appnetos__header__icons_count=$appnetos__header__icons_count+1}
        {/foreach}

    {* If icons not exists *}
    {else}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-warning m-0">
                        {$strings->get('appnetos__header__no_icon')}
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
                    {$strings->get('appnetos__header__license')}
                </div>
            </div>
        </div>
    </div>

    {* Margin *}
    <div class="mt-4"></div>

</div>
