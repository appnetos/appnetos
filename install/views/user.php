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
 * @description     install/views/user.php ->    APPNET OS installer view "user".
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
                    <?php if ($settings->error) { ?>
                        <div class="card-body p-0">
                            <div class="alert alert-danger m-0">
                                <?php echo $this->getError();?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="card-header">
                        <h5 class="mb-0">
                            <?php echo $strings["installer__user"];?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="action" value="<?php echo $settings->part;?>">
                        <label>
                            <?php echo $strings["installer__user_name"];?>
                        </label>
                        <input type="text" class="form-control" name="user" value="<?php if (isset($settings->user)) echo $settings->user ?>">
                        <div class="form-check mt-2">
                            <input type="checkbox" name="userMin" class="form-check-input" id="userMin" <?php if ($settings->userMin) {?> checked <?php } ?>>
                            <label class="form-check-label" for="userMin">
                                <?php echo $strings["installer__user_min"];?>
                            </label>
                        </div>
                        <label class="mt-4">
                            <?php echo $strings["installer__mail"];?>
                        </label>
                        <input type="text" class="form-control" name="mail" value="<?php if (isset($settings->mail)) echo $settings->mail ?>">
                        <div class="form-check mt-2">
                            <input type="checkbox" name="mailMin" class="form-check-input" id="mailMin" <?php if ($settings->mailMin) {?> checked <?php } ?>>
                            <label class="form-check-label" for="mailMin">
                                <?php echo $strings["installer__mail_min"];?>
                            </label>
                        </div>
                        <label class="mt-4">
                            <?php echo $strings["installer__pass"];?>
                        </label>
                        <input type="password" class="form-control" name="pass" value="<?php if (isset($settings->pass)) echo $settings->pass ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__pass_2"];?>
                        </label>
                        <input type="password" class="form-control" name="pass2" value="<?php if (isset($settings->pass2)) echo $settings->pass2 ?>">
                        <div class="form-check mt-2">
                            <input type="checkbox" name="passMin" class="form-check-input" id="passMin" <?php if ($settings->passMin) {?> checked <?php } ?>>
                            <label class="form-check-label" for="passMin">
                                <?php echo $strings["installer__pass_min"];?>
                            </label>
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
    </div>
</div>
<form id="form_back" class="d-none" action="" method="post">
    <input type="hidden" name="action" value="back">
</form>