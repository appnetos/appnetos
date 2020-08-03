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
 * @description     core/views/403.tpl ->    Status code 403, forbidden.
*}

{* Application *}
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html lang="{$render->getLanguage()}">
    <head>

        {* Set meta tags *}
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        {* Set title *}
        {assign var="title" value=$render->getTitle()}
        {if $title}
            <title>{$title}</title>
        {/if}

        {* Set favicon *}
        {assign var="favicon" value=$render->getFavicon()}
        {if $favicon}
            <link rel="shortcut icon" href="{$favicon}"/>
        {/if}

        {* Add link to cached CSS file *}
        {$render->getCssHead()}

        {* Add link to cached JavaScript file *}
        {$render->getJsHead()}

    </head>
    <body>
        <!--
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
        -->

        {* 404 page *}
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger mt-5 text-center" style="font-size:2rem">
                        <strong>⚠ 403 Forbidden</strong>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>