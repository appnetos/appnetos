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
 * @description     core/appnetos/run.php ->    Class to define request if is application or admin section. Initialize
 *                  appropriate object. Run destruction object to complete request.
 */

// Namespace.
namespace core;

// Class "core\run".
class run extends base
{

    /**
     * Initialize.
     */
    public function init()
    {
        // Define object "core\objects".
        $objects = 'core\\objects';
        if (defined('EXTENDED__CLASSES')) {
            $array = EXTENDED__CLASSES;
            if (isset($array['core/objects'])) {
                $objects = $array['core/objects'];
            }
        }

        // Initialize object "core\objects".
        new $objects();

        // Initialize controller.
        $this->initController();

        // Destruct by object "core\destruct".
        $this->destruct();
    }

    /**
     * Initialize controller.
     */
    protected function initController()
    {
        // Get object "core/uri".
        $uri = objects::get('uri');
        $admin = $uri->getAdmin();


        // If is admin section.
        if ($admin) {

            // Initialize object "core\admin".
            $controller = objects::getNew('core/admin');
            objects::set("core/admin", $controller);
        }

        // If is not admin section.
        else {

            // Initialize object "core\application".
            $controller = objects::getNew('core/application');
            objects::set('core/application', $controller);
        }

        // Initialize controller.
        $controller->init();
    }

    /**
     * Destruct by object "core\destruct".
     */
    protected function destruct()
    {
        $destruct = objects::get('destruct');
        $destruct->run();
    }
}