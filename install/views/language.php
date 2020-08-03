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
 * @description     install/views/language.php ->    APPNET OS installer view "language".
 */
?>
<?php include_once "components/languages.php";?>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-3 mt-4">
            <form class="m-0" action="" method="post">
                <div class="card">
                    <div class="card-header bg-dark">
                        <img style="width:200px" src="../out/admin/img/appnetos/logo_560_white.svg">
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0">
                            <?php echo $strings["installer__language_header"];?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <label>
                            <?php echo $strings["installer__language"];?>
                        </label>
                        <input type="hidden" name="action" value="<?php echo $settings->part;?>">
                        <select class="form-control" name="language">
                            <?php foreach ($languages as $language) {?>
                            <option value="<?php echo $language;?>" <?php if ($settings->language === $language) { ?> selected <?php } ?>><?php echo $installLanguages[$language];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button button type="submit" class="btn btn-primary" type="submit">
                                <?php echo $strings["installer__select"];?>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 offset-md-3 text-center mt-2">
            APPNET OS by xtrose Media Studio <a href="https://www.appnetos.com" target="_blank">
                www.appnetos.com
            </a>
        </div>
    </div>
</div>
