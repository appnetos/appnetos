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
 * @description     install/sql/user.php ->    APPNET OS installer sql queries "sql\user".
 */


// SQL queries.
$queries = [
    
    // Insert administration section user.
    "INSERT INTO `***PREFIX***_admin_users` VALUES (1,'***USER***','***PASS***','***PASSSALT***','***MAIL***','',1,0,0,'***IP***',***TS***,1)",

    // Insert application section user.
    "INSERT INTO `***PREFIX***_application_users` VALUES (1,'***USER***','***USERLOWER***','***PASS***','***PASSSALT***','***MAIL***','',1,0,0,'***IP***',***TS***,'***IP***',***TS***,0,0,'',0,1,'')",
    
];
