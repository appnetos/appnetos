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
 * @description     core/views/application.tpl ->    Application main template. Render application with all apps from
 *                  model "core\apps", all container apps with model "core\container".
*}

{* Application *}
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html lang="{$render->getLanguage()}">
    <head>

        {* Set meta tags *}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {assign var="meta" value=$render->getMeta()}
        {foreach from=$meta item="meta_object"}
            <meta {$meta_object->nameTag}="{$meta_object->name}" {$meta_object->contentTag}="{$meta_object->content}">
        {/foreach}

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

        {* Add canonical *}
        {assign var="canonical" value=$render->getCanonical()}
        {if $canonical}
            <link rel="canonical" href="{$canonical}"/>
        {/if}

        {* Add link to cached CSS file *}
        {$render->getCssHead()}

        {* Add link to cached JavaScript file *}
        {$render->getJsHead()}

        {* Add all CSS files as string *}
        {$render->getCssFiles()}

    </head>
    <body>
        {* START LICENSE HEADER
         *
         * The license header may not be removed.
        *}
        <!-- Created with -->
        <!-- APPNET OS (Application Internet Operating System) -->
        <!-- @link: https://www.appnetos.com -->
        <!-- @mail: info@appnetos.com -->
        <!-- -->
        <!-- Licensed under the Apache License, Version 2.0 (the "License"). -->
        <!-- You may not use this file except in compliance with the License. -->
        <!-- You may obtain a copy of the License at -->
        <!-- http://www.apache.org/licenses/LICENSE-2.0 -->
        <!-- -->
        <!-- @copyright: (C) xtrose Media Studio 2019 -->
        <!-- @author: Moses Rivera -->
        <!-- @mail: media.studio@xtrose.de -->
        {* END LICENSE HEADER *}

        {* Add apps *}
        {assign var="core__apps__apps" value=$core__apps->getApps()}
        {assign var="core__container" value=0}
        {foreach from=$core__apps__apps item="core__apps__app"}
            {assign var="core__apps__app_view" value=$core__apps__app->getView()}
            {if $core__apps__app_view}
                {assign var="core__apps__app_container" value=$core__apps__app->getContainer()}
                {if $core__apps__app_container}
                    {if $core__container === 0}
                        {assign var="core__container" value=$core__apps->getContainer()}
                    {/if}
                    {$core__container->add($core__apps__app)}
                {else}
                    {if $core__container}
                        {$core__container->render()}
                        {assign var="core__container" value=0}
                    {/if}
                    {$core__apps__app_view}
                {/if}
            {/if}
        {/foreach}
        {if $core__container !== 0}
            {$core__container->render()}
        {/if}

        {* Add AJAX UUID *}
        <div data-ajax-id="{$render->getAjaxId()}" class="d-none"></div>

        {* Application url *}
        <div data-application-url="{$render->getUrl()}" class="d-none"></div>

        {* Add all append CSS styles as string *}
        {$render->getCssAppend()}

        {* Add all JavaScript files as string *}
        {$render->getJsFiles()}

        {* Add all append JavaScripts as string *}
        {$render->getJsAppend()}

        {* Add AJAX Debug *}
        {if !$render->getDebugAjax()}
            <script>
                var APPNETOS_DEBUG_AJAX = true;
                console.log('APPNETOS AJAX UUID: {$render->getAjaxId()}');
            </script>
        {/if}

    </body>
</html>