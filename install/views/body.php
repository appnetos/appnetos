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
 * @description     install/views/body.php ->    APPNET OS installer view "body".
 */
?>
<html>
    <head>
        <title>APPNET OS</title>
        <link rel="shortcut icon" href="../out/admin/img/general/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="../out/admin/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/fontawosome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/install.min.css" />
        <script src="../out/admin/js/jquery.min.js"></script>
        <script src="../out/admin/js/bootstrap.min.js"></script>
        <script src="js/install.js"></script>
    </head>
    <body>
        <?php include_once "views/" . $settings->part . ".php"; ?>
    <div class="mt-4"></div>
    </body>
</html>