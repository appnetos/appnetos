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
 * @description     install/views/sql.php ->    APPNET OS installer view "sql".
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
                    <?php if ($object->error !== "") { ?>
                    <div class="card-body p-0">
                        <div class="alert alert-danger m-0">
                            <?php echo $object->error;?>
                        </div>
                    </div>
                    <?php } else { ?>
                        <?php if ($settings->error) { ?>
                            <div class="card-body p-0">
                                <div class="alert alert-danger m-0">
                                    <?php echo $strings[$this->getError()];?>
                                </div>
                            </div>
                        <?php } ?>
                    <div class="card-header">
                        <h5 class="mb-0">
                            <?php echo $strings["installer__database"];?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="action" value="<?php echo $settings->part;?>">
                        <label>
                            <?php echo $strings["installer__db_type"];?>
                        </label>
                        <select class="form-control" name="dbType">
                            <option value="mysql">MySQL</option>
                        </select>
                        <label class="mt-4">
                            <?php echo $strings["installer__db_host"];?>
                        </label>
                        <input type="text" class="form-control" name="dbHost" value="<?php if (isset($settings->dbHost)) echo $settings->dbHost ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__db_port"];?>
                        </label>
                        <input type="text" class="form-control" name="dbPort" value="<?php if (isset($settings->dbPort)) { echo $settings->dbPort; } else { echo "3306"; } ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__db_name"];?>
                        </label>
                        <input type="text" class="form-control" name="dbName" value="<?php if (isset($settings->dbName)) echo $settings->dbName ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__db_user"];?>
                        </label>
                        <input type="text" class="form-control" name="dbUser" value="<?php if (isset($settings->dbUser)) echo $settings->dbUser ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__db_pass"];?>
                        </label>
                        <input type="password" class="form-control" name="dbPass" value="<?php if (isset($settings->dbPass)) echo $settings->dbPass ?>">
                    </div>
                    <?php } ?>
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
            APPNET OS by xtrose Media Studio <a href="https://www.appnetos.com" target="_blank">
                www.appnetos.com
            </a>
        </div>
    </div>
</div>
<form id="form_back" class="d-none" action="" method="post">
    <input type="hidden" name="action" value="back">
</form>
