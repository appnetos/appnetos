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
 * @description     install/views/system.php ->    APPNET OS installer view "system".
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
                        <h5 class="mb-0 float-left">
                            <?php echo $strings["installer__basic_settings"];?>
                        </h5>
                        <div class="form-check mt-1 float-right">
                            <input type="checkbox" id="extend" class="form-check-input"<?php if ($settings->systemExtend) {?> checked<?php }?> onchange="document.getElementById('form_extend').submit()">
                            <label class="form-check-label" for="extend">
                                <?php echo $strings["installer__extend"];?>
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="action" value="<?php echo $settings->part;?>">
                        <label>
                            <?php echo $strings["installer__prefix"];?>
                        </label>
                        <input type="text" maxlength="3" class="form-control mb-1" name="prefix" value="<?php if (isset($settings->prefix)) echo $settings->prefix ?>">
                        <small class="text-secondary"><?php echo $strings["installer__prefix_info"];?></small>
                        <div class="form-check mt-4">
                            <input type="checkbox" id="cookieLock" name="cookieLock" class="form-check-input" <?php if ($settings->cookieLock) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="cookieLock">
                                <?php echo $strings["installer__cookie_lock"];?>
                            </label>
                        </div>
                    </div>
                    <div class="card-header border-top"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <h5 class="mb-0">
                            <?php echo $strings["installer__directory"];?>
                        </h5>
                    </div>
                    <div class="card-body p-0"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <div class="alert alert-warning m-0">
                            <?php echo $strings["installer__system_warning"];?>
                        </div>
                    </div>
                    <div class="card-body"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <label>
                            <?php echo $strings["installer__url"];?>
                        </label>
                        <input type="text" class="form-control" name="url" value="<?php if (isset($settings->url)) echo $settings->url ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__dir"];?>
                        </label>
                        <input type="text" class="form-control" name="dir" value="<?php if (isset($settings->dir)) echo $settings->dir ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__cache_dir"];?>
                        </label>
                        <input type="text" class="form-control" name="cacheDir" value="<?php if (isset($settings->cacheDir)) echo $settings->cacheDir ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__tmp_dir"];?>
                        </label>
                        <input type="text" class="form-control" name="tmpDir" value="<?php if (isset($settings->tmpDir)) echo $settings->tmpDir ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__log_dir"];?>
                        </label>
                        <input type="text" class="form-control" name="logDir" value="<?php if (isset($settings->logDir)) echo $settings->logDir ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__compile_dir"];?>
                        </label>
                        <input type="text" class="form-control" name="smartyCompileDir" value="<?php if (isset($settings->smartyCompileDir)) echo $settings->smartyCompileDir ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__config_dir"];?>
                        </label>
                        <input type="text" class="form-control" name="smartyConfigDir" value="<?php if (isset($settings->smartyConfigDir)) echo $settings->smartyConfigDir ?>">
                    </div>
                    <div class="card-header border-top"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <h5 class="mb-0">
                            <?php echo $strings["installer__security_settings"];?>
                        </h5>
                    </div>
                    <div class="card-body"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <label>
                            <?php echo $strings["installer__error_count"];?>
                        </label>
                        <input type="text" class="form-control" name="signInErrorCount" value="<?php if (isset($settings->signInErrorCount)) echo $settings->signInErrorCount ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__pass_expire"];?>
                        </label>
                        <input type="text" class="form-control" name="resetPasswordExpire" value="<?php if (isset($settings->resetPasswordExpire)) echo $settings->resetPasswordExpire ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__session_application"];?>
                        </label>
                        <input type="text" class="form-control" name="sessionTimeoutApplication" value="<?php if (isset($settings->sessionTimeoutApplication)) echo $settings->sessionTimeoutApplication ?>">
                        <label class="mt-4">
                            <?php echo $strings["installer__authenticator_lifetime"];?>
                        </label>
                        <input type="text" class="form-control" name="authenticationLifetimeApplication" value="<?php if (isset($settings->authenticationLifetimeApplication)) echo $settings->authenticationLifetimeApplication ?>">
                        <div class="form-check mt-4">
                            <input type="checkbox" id="disableGroupsApplication" name="disableGroupsApplication" class="form-check-input" <?php if ($settings->disableGroupsApplication) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="disableGroupsApplication">
                                <?php echo $strings["installer__groups_application"];?>
                            </label>
                        </div>
                        <label class="mt-4">
                            <?php echo $strings["installer__session_admin"];?>
                        </label>
                        <input type="text" class="form-control" name="sessionTimeoutAdmin" value="<?php if (isset($settings->sessionTimeoutAdmin)) echo $settings->sessionTimeoutAdmin ?>">
                        <div class="form-check mt-4">
                            <input type="checkbox" id="disableGroupsAdmin" name="disableGroupsAdmin" class="form-check-input" <?php if ($settings->disableGroupsAdmin) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="disableGroupsAdmin">
                                <?php echo $strings["installer__groups_admin"];?>
                            </label>
                        </div>
                    </div>
                    <div class="card-header border-top"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <h5 class="mb-0">
                            <?php echo $strings["installer__cache"];?>
                        </h5>
                    </div>
                    <div class="card-body"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <label>
                            <?php echo $strings["installer__cache_expire"];?>
                        </label>
                        <input type="text" class="form-control" name="cacheExpire" value="<?php if (isset($settings->cacheExpire)) echo $settings->cacheExpire ?>">
                        <div class="form-check mt-4">
                            <input type="checkbox" id="appCache" name="appCache" class="form-check-input" <?php if ($settings->appCache) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="appCache">
                                <?php echo $strings["installer__app_cache"];?>
                            </label>
                        </div>
                        <div class="form-check mt-4">
                            <input type="checkbox" id="fileCache" name="fileCache" class="form-check-input" <?php if ($settings->fileCache) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="fileCache">
                                <?php echo $strings["installer__file_cache"];?>
                            </label>
                        </div>
                        <div class="form-check mt-4">
                            <input type="checkbox" id="directoryCache" name="directoryCache" class="form-check-input" <?php if ($settings->directoryCache) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="directoryCache">
                                <?php echo $strings["installer__directory_cache"];?>
                            </label>
                        </div>
                        <div class="form-check mt-4">
                            <input type="checkbox" id="stringCache" name="stringCache" class="form-check-input" <?php if ($settings->stringCache) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="stringCache">
                                <?php echo $strings["installer__string_cache"];?>
                            </label>
                        </div>
                        <div class="form-check mt-4">
                            <input type="checkbox" id="jsCache" name="jsCache" class="form-check-input" <?php if ($settings->jsCache) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="jsCache">
                                <?php echo $strings["installer__js_cache"];?>
                            </label>
                        </div>
                        <div class="form-check mt-4">
                            <input type="checkbox" id="cssCache" name="cssCache" class="form-check-input" <?php if ($settings->cssCache) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="cssCache">
                                <?php echo $strings["installer__css_cache"];?>
                            </label>
                        </div>
                    </div>
                    <div class="card-header border-top"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <h5 class="mb-0">
                            <?php echo $strings["installer__compression"];?>
                        </h5>
                    </div>
                    <div class="card-body"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <div class="form-check">
                            <input type="checkbox" id="minify" name="minify" class="form-check-input" <?php if ($settings->minify) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="minify">
                                <?php echo $strings["installer__minify"];?>
                            </label>
                        </div>
                        <div class="form-check mt-4">
                            <input type="checkbox" id="compressor" name="compressor" class="form-check-input" <?php if ($settings->compressor) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="compressor">
                                <?php echo $strings["installer__html_compression"];?>
                            </label>
                        </div>
                    </div>
                    <div class="card-header border-top"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <h5 class="mb-0">
                            <?php echo $strings["installer__developer"];?>
                        </h5>
                    </div>
                    <div class="card-body"<?php if (!$settings->systemExtend) { ?> style="display: none;" <?php } ?>>
                        <div class="form-check">
                            <input type="checkbox" id="debug" name="debug" class="form-check-input" <?php if ($settings->debug) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="debug">
                                <?php echo $strings["installer__debug"];?>
                            </label>
                        </div>
                        <div class="form-check mt-4">
                            <input type="checkbox" id="expertMode" name="expertMode" class="form-check-input" <?php if ($settings->expertMode) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="expertMode">
                                <?php echo $strings["installer__expert"];?>
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
<form id="form_extend" class="d-none" action="" method="post">
    <input type="hidden" name="action" value="extend">
    <?php if (!$settings->systemExtend) {?>
        <input type="hidden" name="extend" value="on">
    <?php }?>
</form>