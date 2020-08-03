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
 * @description     HTML String App.
 *}

{* Menu *}
{$render->include("application/apps/html_string/demo_forgotten_password/admin/views/demo_forgotten_password__menu.tpl")}
<div class="container-sidebar">

    {* Info and messages *}
    <div class="container info-hide">
        <div class="row">
            <div class="col-12 text-justify mt-4">
                <div class="text-dark text-justify">
                    {$strings->get("admin__apps__html_string__info")}
                </div>
            </div>
        </div>
    </div>

    {* Warning *}
    {if $appnetos__html_string__demo_forgotten_password__demo_forgotten_password->html}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-warning m-0 text-justify">
                        {$strings->get("admin__apps__html_string__warning")}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Confirm message *}
    {if $appnetos__html_string__demo_forgotten_password__demo_forgotten_password->confirmMsg}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-success m-0">
                        {$appnetos__html_string__demo_forgotten_password__demo_forgotten_password->confirmMsg}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* Error message *}
    {if $appnetos__html_string__demo_forgotten_password__demo_forgotten_password->errorMsg}
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="alert alert-danger m-0">
                        {$appnetos__html_string__demo_forgotten_password__demo_forgotten_password->errorMsg}
                    </div>
                </div>
            </div>
        </div>
    {/if}

    {* HTML Editor *}
    {if !$appnetos__html_string__demo_forgotten_password__demo_forgotten_password->html}
        <form data-html="true" action="" method="post">
            <input type="hidden" name="appnetos__html_string__action" value="edit">
            <div class="container">
                <div class="row">

                    {* HTML entry *}
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-dark text-light">
                                <h5 class="float-left mt-2 mb-0 mr-4">
                                    HTML ({$appnetos__html_string__demo_forgotten_password__demo_forgotten_password->type})
                                </h5>
                                <div class="form-inline float-right">
                                    <div class="tool-tip">
                                        <button type="submit" class="btn btn-outline-light text-decoration-none">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <span class="tool-tip-text bg-primary text-light">{$strings->get("admin__apps__html_string__save")}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <textarea class="form-control" id="appnetos__html_string__html" name="appnetos__html_string__html" rows="24">{$appnetos__html_string__demo_forgotten_password__demo_forgotten_password->getContent()}</textarea>
                            </div>
                        </div>
                    </div>

                    {* Button save *}
                    <div class="col-12 text-right mt-4">
                        <button type="submit" class="btn btn-primary">{$strings->get("admin__apps__html_string__save")}</button>
                    </div>

                </div>
            <div>
        </form>

    {* Text editor *}
    {else}
        <div class="container">
            <div class="row">

                {* Global entry *}
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h5 class="float-left mt-2 mb-0 mr-4">
                                HTML ({$appnetos__html_string__demo_forgotten_password__demo_forgotten_password->type})
                            </h5>
                            <div class="form-inline float-right">
                                <div class="tool-tip">
                                    <button type="button" class="btn btn-outline-light text-decoration-none" onclick="appnetos__html_string__demo_forgotten_password__demo_forgotten_password__edit()">
                                        <i class="fas fa-save"></i>
                                    </button>
                                    <span class="tool-tip-text bg-primary text-light">{$strings->get("admin__apps__html_string__save")}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <textarea class="form-control" id="appnetos__html_string__html" name="appnetos__html_string__html" rows="10">{$appnetos__html_string__demo_forgotten_password__demo_forgotten_password->getContent()}</textarea>
                        </div>
                    </div>
                </div>

                {* CSS *}
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header bg-dark text-light">
                            <h5 class="float-left mt-2 mb-0 mr-4">
                                {$strings->get("admin__apps__html_string__edit_css")}
                            </h5>
                            <div class="form-inline float-right">
                                <div class="tool-tip">
                                    <button type="button" class="btn btn-outline-light text-decoration-none" onclick="appnetos__html_string__demo_forgotten_password__demo_forgotten_password__edit()">
                                        <i class="fas fa-save"></i>
                                    </button>
                                    <span class="tool-tip-text bg-primary text-light">{$strings->get("admin__apps__html_string__save")}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <textarea class="form-control" id="appnetos__html_string__css" name="appnetos__html_string__css" rows="10">{$appnetos__html_string__demo_forgotten_password__demo_forgotten_password->getCss()}</textarea>
                        </div>
                    </div>
                </div>

                {* Button save *}
                <div class="col-12 text-right mt-4">
                    <button type="submit" class="btn btn-primary" onclick="appnetos__html_string__demo_forgotten_password__demo_forgotten_password__edit()">
                        {$strings->get("admin__apps__html_string__save")}
                    </button>
                </div>
            </div>
        </div>
    {/if}

    {* Margin *}
    <div class="mt-4"></div>
</div>