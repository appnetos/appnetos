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

{* Menu *}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark admin__navbar__fix fixed-left">
    <div class="navbar-brand text-light">
        {$strings->get("appnetos__background_changer__header")} (1.0)
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appnetos__background_changer__navbar" aria-controls="appnetos__background_changer__navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="appnetos__background_changer__navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="#" data-toggle="modal" data-target="#appnetos__background_changer__modal_add">
                    <i class="fas fa-plus  fa-menu-size"></i>
                    {$strings->get("appnetos__background_changer__add")}
                </a>
            </li>
        </ul>
    </div>
</nav>