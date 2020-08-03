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
 * @description     install/views/install.php ->    APPNET OS installer view "install".
 */

// Debugging.
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// Install.
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4">
            <form action="" method="post">
                <div class="card">
                    <div class="card-header bg-dark">
                        <img style="width:200px" src="../out/admin/img/appnetos/logo_560_white.svg">
                    </div>
                    <?php if ($settings->error) { ?>
                        <div class="card-body p-0">
                            <div class="alert alert-danger m-0">
                                <?php echo $this->getError();?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="card-header">
                        <h5 class="mb-0">
                            <?php echo $strings["installer__install_header"];?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php echo $strings["installer__install_text"];?>
                        <input type="hidden" name="action" value="<?php echo $settings->part;?>">

                    </div>
                    <div class="card-footer">
                        <div class="float-left">
                            <button type="button" class="btn btn-dark" onclick="document.getElementById('form_back').submit();">
                                ⯇ <?php echo $strings["installer__back"];?>
                            </button>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">
                                <?php echo $strings["installer__install"];?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<form id="form_back" class="d-none" action="" method="post">
    <input type="hidden" name="action" value="back">
</form>
