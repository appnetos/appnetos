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
 * @description     install/views/additional.php ->    APPNET OS installer view "additional".
 */
?>
<?php
$additional = \installer\objects::get("additional");
$license = file_get_contents($additional->license);
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1 mt-4">
            <form class="m-0" action="" method="post">
                <div class="card">
                    <div class="card-header bg-dark">
                        <img style="width:200px" src="../out/admin/img/appnetos/logo_560_white.svg">
                    </div>
                    <?php if ($settings->error) { ?>
                        <div class="card-header p-0">
                            <div class="alert alert-danger m-0">
                                <?php echo $strings[$this->getError()];?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="card-header">
                        <h5 class="mb-0">
                            <?php echo $strings["installer__additional"];?>
                        </h5>
                    </div>
                    <div class="card-body border-bottom border-light p-0">
                        <div class="p-3 text-justify" style="height: 450px; overflow-y: scroll;">
                            <?php echo $license;?>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <input type="hidden" name="action" value="<?php echo $settings->part;?>">
                        <div class="form-check">
                            <input type="checkbox" name="license__checkbox" class="form-check-input" id="license__checkbox">
                            <label class="form-check-label" for="license__checkbox"><?php echo $strings["installer__accept_checkbox"];?></label>
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
                                <?php echo $strings["installer__accept"];?>
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
