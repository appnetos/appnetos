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
 * @description     Extended cookie note, with list of all cookies and their use. App admin settings to set kind of used
 *                  cookies and the notifications.
*}

{* If cookie note error *}
{if (!$appnetos__cookie_note->cookie || $appnetos__cookie_note->getErrors()) && $appnetos__cookie_note->cookieLock}
    <form id="app-{$appnetos__cookie_note->appId}-form">

        {* Modal cookie error message *}
        {if $appnetos__cookie_note->cookie && $appnetos__cookie_note->getErrors()}
            <div class="modal fade" id="app-{$appnetos__cookie_note->appId}-modal_error" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content text-dark">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                {$strings->get('appnetos__cookie_note__header')}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div>
                                        {$strings->get('appnetos__cookie_note__warning')}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {if $appnetos__cookie_note->errors->function}
                                    <div class="col-md-12 mb-3 ml-4">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="function" id="app-{$appnetos__cookie_note->appId}-function" {if $appnetos__cookie_note->settings->functionOn}checked{/if}>
                                            <label class="form-check-label small" for="app-{$appnetos__cookie_note->appId}-function">
                                                {$strings->get('appnetos__cookie_note__function')}
                                            </label>
                                        </div>
                                    </div>
                                {/if}
                                {if $appnetos__cookie_note->errors->statistics}
                                    <div class="col-md-12 mb-3 ml-4">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="statistics" id="app-{$appnetos__cookie_note->appId}-statistics" {if $appnetos__cookie_note->settings->statisticsOn}checked{/if}>
                                            <label class="form-check-label small" for="app-{$appnetos__cookie_note->appId}-statistics">
                                                {$strings->get('appnetos__cookie_note__statistics')}
                                            </label>
                                        </div>
                                    </div>
                                {/if}
                                {if $appnetos__cookie_note->errors->marketing}
                                    <div class="col-md-12 mb-3 ml-4">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="marketing" id="app-{$appnetos__cookie_note->appId}-marketing" {if $appnetos__cookie_note->settings->marketingOn}checked{/if}>
                                            <label class="form-check-label small" for="app-{$appnetos__cookie_note->appId}-marketing">
                                                {$strings->get('appnetos__cookie_note__marketing')}
                                            </label>
                                        </div>
                                    </div>
                                {/if}
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-success btn-sm" onclick="appnetos__cookie_note.ac({$appnetos__cookie_note->appId})">
                                        {$strings->get('appnetos__cookie_note__button_ok')}
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="appnetos__cookie_note.sh({$appnetos__cookie_note->appId})">
                                        {$strings->get('appnetos__cookie_note__button_details')}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">
                                {$strings->get('appnetos__cookie_note__close')}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {* Modal cookie error message *}
            <div class="py-2">
                <div class="float-left mt-1 mr-3">
                    <div>
                        {$strings->get('appnetos__cookie_note__warning')}
                    </div>
                </div>
                <div class="float-left">
                    <button class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#app-{$appnetos__cookie_note->appId}-modal_error">
                        {$strings->get('appnetos__cookie_note__check')}
                    </button>
                </div>
            </div>

        {/if}

        {* Modal information *}
        <div class="modal fade" id="app-{$appnetos__cookie_note->appId}-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {$strings->get('appnetos__cookie_note__header')}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div>
                                    {$strings->get('appnetos__cookie_note__info')}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div>
                                    {$strings->get('appnetos__cookie_note__info_necessary')}
                                </div>
                            </div>
                        </div>
                        {if $appnetos__cookie_note->settings->function || $appnetos__cookie_note->errors->function}
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div>
                                        {$strings->get('appnetos__cookie_note__info_function')}
                                    </div>
                                </div>
                            </div>
                        {/if}
                        {if $appnetos__cookie_note->settings->statistics || $appnetos__cookie_note->errors->statistics}
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div>
                                        {$strings->get('appnetos__cookie_note__info_statistics')}
                                    </div>
                                </div>
                            </div>
                        {/if}
                        {if $appnetos__cookie_note->settings->marketing || $appnetos__cookie_note->errors->marketing}
                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div>
                                        {$strings->get('appnetos__cookie_note__info_marketing')}
                                    </div>
                                </div>
                            </div>
                        {/if}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                            {$strings->get('appnetos__cookie_note__close')}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {* Cookie note *}
        {if !$appnetos__cookie_note->errors || !$appnetos__cookie_note->cookie}
            <div class="py-2">
                <div class="small text-justify">
                    {$strings->get('appnetos__cookie_note__text')}
                </div>
                <div class="form-check mt-2">
                    <div class="float-left">
                        <div class="float-left mr-5 mt-1">
                            <input class="form-check-input" disabled checked type="checkbox" id="app-{$appnetos__cookie_note->appId}-necessary">
                            <label class="form-check-label small appnetos__cookie_note__current_color" for="app-{$appnetos__cookie_note->appId}-necessary">
                                {$strings->get('appnetos__cookie_note__necessary')}
                            </label>
                        </div>
                        {if $appnetos__cookie_note->settings->function}
                            <div class="float-left mr-5 mt-1">
                                <input class="form-check-input" type="checkbox" name="function" id="app-{$appnetos__cookie_note->appId}-function" {if $appnetos__cookie_note->settings->functionOn}checked{/if}>
                                <label class="form-check-label small" for="app-{$appnetos__cookie_note->appId}-function">
                                    {$strings->get('appnetos__cookie_note__function')}
                                </label>
                            </div>
                        {/if}
                        {if $appnetos__cookie_note->settings->statistics}
                            <div class="float-left mr-5 mt-1">
                                <input class="form-check-input" type="checkbox" name="statistics" id="app-{$appnetos__cookie_note->appId}-statistics" {if $appnetos__cookie_note->settings->statisticsOn}checked{/if}>
                                <label class="form-check-label small" for="app-{$appnetos__cookie_note->appId}-statistics">
                                    {$strings->get('appnetos__cookie_note__statistics')}
                                </label>
                            </div>
                        {/if}
                        {if $appnetos__cookie_note->settings->marketing}
                            <div class="float-left mr-5 mt-1">
                                <input class="form-check-input" type="checkbox" name="marketing" id="app-{$appnetos__cookie_note->appId}-marketing" {if $appnetos__cookie_note->settings->marketingOn}checked{/if}>
                                <label class="form-check-label small" for="app-{$appnetos__cookie_note->appId}-marketing">
                                    {$strings->get('appnetos__cookie_note__marketing')}
                                </label>
                            </div>
                        {/if}
                    </div>
                </div>
                <div class="float-left mt-1">
                    <button type="button" class="btn btn-success btn-sm mb-2" onclick="appnetos__cookie_note.ac({$appnetos__cookie_note->appId})">
                        {$strings->get('appnetos__cookie_note__button_ok')}
                    </button>
                    <button type="button" class="btn btn-primary btn-sm mb-2" onclick="appnetos__cookie_note.sh({$appnetos__cookie_note->appId})">
                        {$strings->get('appnetos__cookie_note__button_details')}
                    </button>
                </div>
            </div>
        {/if}

    </form>

{* Empty children *}
{else}
    <div id="app-{$appnetos__cookie_note->appId}" data-name="appnetos__cookie_note__children"></div>
{/if}