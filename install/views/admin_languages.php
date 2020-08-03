<?php
/**
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
 * @description     install/views/admin_languages.php ->    APPNET OS installer view "admin_languages".
 */
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4">
            <form class="m-0" action="" method="post">
                <div class="card">
                    <div class="card-header bg-dark">
                        <img style="width:200px" src="../out/admin/img/appnetos/logo_560_white.svg">
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0">
                            <?php echo $strings["installer__languages"];?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <input type="hidden" name="action" value="<?php echo $settings->part;?>">
                            <label>
                                <?php echo $strings["installer__languages_info"];?>
                            </label>
                            <div class="form-check mt-4">
                                <input type="checkbox" id="global" class="form-check-input" checked disabled>
                                <label class="form-check-label" for="global"><?php echo $strings["installer__languages_global"];?></label>
                            </div>
                            <div class="form-check mt-4">
                                <input type="checkbox" id="de" name="de" class="form-check-input" <?php if ($settings->admin_languages->de) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="de"><?php echo $strings["installer__languages_de"];?></label>
                            </div>
                            <div class="form-check mt-4">
                                <input type="checkbox" id="en" name="en" class="form-check-input" <?php if ($settings->admin_languages->en) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="en"><?php echo $strings["installer__languages_en"];?></label>
                            </div>
                            <div class="form-check mt-4">
                                <input type="checkbox" id="es" name="es" class="form-check-input" <?php if ($settings->admin_languages->es) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="es"><?php echo $strings["installer__languages_es"];?></label>
                            </div>
                            <div class="form-check mt-4">
                                <input type="checkbox" id="fr" name="fr" class="form-check-input" <?php if ($settings->admin_languages->fr) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="fr"><?php echo $strings["installer__languages_fr"];?></label>
                            </div>
                            <div class="form-check mt-4">
                                <input type="checkbox" id="it" name="it" class="form-check-input" <?php if ($settings->admin_languages->it) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="it"><?php echo $strings["installer__languages_it"];?></label>
                            </div>
                            <div class="form-check mt-4">
                                <input type="checkbox" id="ru" name="ru" class="form-check-input" <?php if ($settings->admin_languages->ru) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="ru"><?php echo $strings["installer__languages_ru"];?></label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-left">
                            <button type="button" class="btn btn-dark" onclick="document.getElementById('form_back').submit();">
                                ⯇ <?php echo $strings["installer__back"];?>
                            </button>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">
                                <?php echo $strings["installer__next"];?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 offset-md-3 text-center mt-2">
            APPNET OS by xtrose Media Studio <a href="https://www.appnetos.com" target="_blank">www.appnetos.com</a>
        </div>
    </div>
</div>
<form id="form_back" class="d-none" action="" method="post">
    <input type="hidden" name="action" value="back">
</form>
