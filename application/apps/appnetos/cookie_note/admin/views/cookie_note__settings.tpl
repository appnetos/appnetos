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

{* AJAX error *}
{if $appnetos__cookie_note->ajaxError}
    <div id="appnetos__cookie_note__ajax_error" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-danger m-0">
                {$appnetos__cookie_note->ajaxError}
            </div>
        </div>
    </div>
{/if}

{* AJAX confirm *}
{if $appnetos__cookie_note->ajaxConfirm}
    <div id="appnetos__cookie_note__ajax_confirm" class="row d-none">
        <div class="col-12 mt-4">
            <div class="alert alert-success m-0">
                {$appnetos__cookie_note->ajaxConfirm}
            </div>
        </div>
    </div>
{/if}

{* Settings *}
<form id="appnetos__cookie_note__form">
    <div class="row">

        {* Function cookies *}
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="card-title m-0">
                        {$strings->get('appnetos__cookie_note__function')}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="function" id="appnetos__cookie_note__function" {if $appnetos__cookie_note->settings->function}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__function">
                            {$strings->get('appnetos__cookie_note__display')}
                        </label>
                    </div>
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="function_on" id="appnetos__cookie_note__function_on" {if $appnetos__cookie_note->settings->functionOn}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__function_on">
                            {$strings->get('appnetos__cookie_note__selected')}
                        </label>
                    </div>
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="function_msg" id="appnetos__cookie_note__function_msg" {if $appnetos__cookie_note->settings->functionMsg}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__function_msg">
                            {$strings->get('appnetos__cookie_note__warning')}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {* Statistics cookies *}
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="card-title m-0">
                        {$strings->get('appnetos__cookie_note__statistics')}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="statistics" id="appnetos__cookie_note__statistics" {if $appnetos__cookie_note->settings->statistics}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__statistics">
                            {$strings->get('appnetos__cookie_note__display')}
                        </label>
                    </div>
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="statistics_on" id="appnetos__cookie_note__statistics_on" {if $appnetos__cookie_note->settings->statisticsOn}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__statistics_on">
                            {$strings->get('appnetos__cookie_note__selected')}
                        </label>
                    </div>
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="statistics_msg" id="appnetos__cookie_note__statistics_msg" {if $appnetos__cookie_note->settings->statisticsMsg}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__statistics_msg">
                            {$strings->get('appnetos__cookie_note__warning')}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {* Marketing cookies *}
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-4">
            <div class="card">
                <div class="card-header bg-dark text-light">
                    <h5 class="card-title m-0">
                        {$strings->get('appnetos__cookie_note__marketing')}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="marketing" id="appnetos__cookie_note__marketing" {if $appnetos__cookie_note->settings->marketing}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__marketing">
                            {$strings->get('appnetos__cookie_note__display')}
                        </label>
                    </div>
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="marketing_on" id="appnetos__cookie_note__marketing_on" {if $appnetos__cookie_note->settings->marketingOn}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__marketing_on">
                            {$strings->get('appnetos__cookie_note__selected')}
                        </label>
                    </div>
                    <div class="ml-4 mt-2">
                        <input class="form-check-input" type="checkbox" name="marketing_msg" id="appnetos__cookie_note__marketing_msg" {if $appnetos__cookie_note->settings->marketingMsg}checked{/if}>
                        <label class="form-check-label" for="appnetos__cookie_note__marketing_msg">
                            {$strings->get('appnetos__cookie_note__warning')}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {* Button save *}
        <div class="col-12 text-right mt-4">
            <button type="button" class="btn btn-primary" onclick="appnetos__cookie_note.ed()">
                {$strings->get('appnetos__cookie_note__save')}
            </button>
        </div>
    </div>
</form>