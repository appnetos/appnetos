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
 * @description     core/appnetos/config.php ->    Config class, get config data from file "config.inc.php", set to
 *                  object and manage configuration.
 */

// Core.
namespace core;

// Class "core\config".
class config extends base
{

    /**
     * Database type from "config.inc.php".
     *
     * @var string.
     */
    protected $dbType = 'mysql';

    /**
     * Database host name from "config.inc.php".
     *
     * @var string.
     */
    protected $dbHost = null;

    /**
     * Database name from "config.inc.php".
     *
     * @var string.
     */
    protected $dbName = null;

    /**
     * Database user name from "config.inc.php".
     *
     * @var string.
     */
    protected $dbUser = null;

    /**
     * Database password from "config.inc.php".
     *
     * @var string.
     */
    protected $dbPass = null;

    /**
     * Database port from "config.inc.php".
     *
     * @var string.
     */
    protected $dbPort = '';

    /**
     * Database charset from "config.inc.php".
     *
     * @var string.
     */
    protected $dbCharset = 'utf8';

    /**
     * Database table, COOKIE and SESSION prefix from "config.inc.php".
     *
     * @var string.
     */
    protected $prefix = '';

    /**
     * "index.php" url from "config.inc.php".
     *
     * @var string.
     */
    protected $url = null;

    /**
     * "index.php" directory from "config.inc.php".
     *
     * @var string.
     */
    protected $dir = null;

    /**
     * Cache directory from "config.inc.php".
     *
     * @var string.
     */
    protected $cacheDir = 'cache/';

    /**
     * Temporary directory from "config.inc.php".
     *
     * @var string.
     */
    protected $tmpDir = 'tmp/';

    /**
     * Log directory from "config.inc.php".
     *
     * @var string.
     */
    protected $logDir = 'log/';

    /**
     * Smarty and twig compile directory from "config.inc.php".
     *
     * @var string.
     */
    protected $compileDir = BASEPATH . 'compile/';

    /**
     * Smarty and twig configuration directory from "config.inc.php".
     *
     * @var string.
     */
    protected $configDir = BASEPATH . 'config/';

    /**
     * Use App cache from "config.inc.php".
     *
     * @var bool.
     */
    protected $appCache = false;

    /**
     * Cache expire time in seconds from "config.inc.php".
     *
     * @var int.
     */
    protected $cacheExpire = 3600;

    /**
     * Use file cache from "config.inc.php".
     *
     * @var bool.
     */
    protected $fileCache = false;

    /**
     * Use directory cache from "config.inc.php".
     *
     * @var bool.
     */
    protected $directoryCache = false;

    /**
     * Use string cache from "config.inc.php".
     *
     * @var bool.
     */
    protected $stringCache = false;

    /**
     * Use JavaScript cache from "config.inc.php".
     *
     * @var bool.
     */
    protected $jsCache = false;

    /**
     * Use CSS cache from "config.inc.php".
     *
     * @var bool.
     */
    protected $cssCache = false;

    /**
     * Minify styles and scripts when cache is not active from "config.inc.php".
     *
     * @var bool.
     */
    protected $minify = false;

    /**
     * HTML source code compressor from "config.inc.php".
     *
     * @var bool.
     */
    protected $compressor = true;

    /**
     * JavaScript head includes from "config.inc.php"..
     *
     * @var array.
     */
    protected $includeJs = [];

    /**
     * CSS head includes from "config.inc.php"..
     *
     * @var array.
     */
    protected $includeCss = [];

    /**
     * Autoloader directories from "config.inc.php".
     *
     * @var array.
     */
    protected $directories = [];

    /**
     * Sign in error count. Lock user by email address or user name from "config.inc.php".
     *
     * @var int.
     */
    protected $signInErrorCount = 10;

    /**
     * Reset password link expire time in seconds from "config.inc.php".
     *
     * @var int.
     */
    protected $resetPasswordExpire = 21600;

    /**
     * Use COOKIE to unlock to set COOKIES from "config.inc.php".
     *
     * @var bool.
     */
    protected $cookieLock = false;

    /**
     * Verify username regular expression pattern for application users from "config.inc.php".
     *
     * @var array.
     */
    protected $userRegexApplication = ['/^(?=.{5,32}$).*/', '/^(?!.*  )/'];

    /**
     * Verify password regular expression pattern for application users from "config.inc.php".
     *
     * @var array.
     */
    protected $passRegexApplication = ['/\d/', '/[^a-zA-Z\d]/', '/^(?=.{8,32}$).*/'];

    /**
     * Disable groups application from "config.inc.php".
     *
     * @var bool.
     */
    protected $disableGroupsApplication = false;

    /**
     * Authentication lifetime in seconds application from "config.inc.php".
     *
     * @var int.
     */
    protected $authenticationLifetimeApplication = 2592000;

    /**
     * Session timeout in seconds application from "config.inc.php".
     *
     * @var inf.
     */
    protected $sessionTimeoutApplication = 3600;

    /**
     * Use expert mode from admin section from "config.inc.php".
     *
     * @var bool.
     */
    protected $expertModeAdmin = false;

    /**
     * Verify username regular expression pattern for admin users from "config.inc.php".
     *
     * @var array.
     */
    protected $userRegexAdmin = ['/^(?=.{5,32}$).*/', '/^(?!.*  )/'];

    /**
     * Verify password regular expression pattern for admin users from "config.inc.php".
     *
     * @var array.
     */
    protected $passRegexAdmin = ['/\d/', '/[^a-zA-Z\d]/', '/^(?=.{8,32}$).*/'];

    /**
     * File manager accepted directories from "config.inc.php".
     *
     * @var array.
     */
    protected $filesDirectories = ['out/img', 'out/css', 'out/js'];

    /**
     * File manager accepted types from "config.inc.php".
     *
     * @var array.
     */
    protected $filesTypes = ['svg', 'png', 'jpg', 'jpeg', 'gif', 'css', 'js'];

    /**
     * Disable groups admin section from "config.inc.php".
     *
     * @var bool.
     */
    protected $disableGroupsAdmin = false;

    /**
     * Admin section SESSION timeout from "config.inc.php".
     *
     * @var int.
     */
    protected $sessionTimeoutAdmin = 900;

    /**
     * Display info admin section from "config.inc.php".
     *
     * @var bool.
     */
    protected $infoAdmin = false;

    /**
     * Allowed admin section AJAX requests as not admin user from "config.inc.php".
     *
     * @var array.
     */
    protected $allowedAdminAjax = [
        [
            'ns' => 'admin',
            'cl' => 'sign_in',
            'fn' => 'signIn'
        ]
    ];

    /**
     * Debug. Throws any exceptions or write exceptions to error log from "config.inc.php".
     *
     * @var bool.
     */
    protected $debug = false;

    /**
     * Debug ajax. Displays AJAX ID on bottom of application from "config.inc.php".
     *
     * @var bool.
     */
    protected $debugAjax = false;

    /**
     * User name invalid characters.
     *
     * @var array.
     */
    protected $userInvalidCharacters = ['/', ':', '*', '?', '"', '<', '>', '|', '~'];

    /**
     * config constructor.
     *
     * @throws.
     */
    public function __construct()
    {
        // Initialize.
        $this->init();
    }

    /**
     * Initialize.
     *
     * @throws exception. Error: Configuration error.
     */
    protected function init()
    {
        // Require "config.inc.php".
        require_once (BASEPATH . 'config.inc.php');

        // Require "config.local.php" if exists.
        if (file_exists(BASEPATH . 'config.local.php')) {
            require_once (BASEPATH . 'config.local.php');
        }

        // Process parameters.
        $this->dbType = strtolower($this->dbType);

        // Add "\" to user name invalid characters.
        $char = '\\';
        array_push($this->userInvalidCharacters, substr($char, 0));

        // If URL not exists.
        if (!$this->url || $this->url === '') {
            throw new exception('Configuration error. URL is not set in "config.inc.php"');
        }

        // Process URL.
        $this->url = trim($this->url, "\\/");
        $this->url = str_replace("\\", "/", $this->url);
    }

    /**
     * Unset all caches.
     */
    public function unsetCache()
    {
        $this->appCache = false;
        $this->fileCache = false;
        $this->directoryCache = false;
        $this->stringCache = false;
        $this->jsCache = false;
        $this->cssCache = false;
    }

    /**
     * Set use app cache.
     *
     * @param bool $appCache.
     */
    public function setAppCache($appCache)
    {
        $this->appCache = $appCache;
    }

    /**
     * Set global app cache expire time in seconds.
     *
     * @param int $cacheExpire.
     */
    public function setCacheExpire($cacheExpire)
    {
        $this->cacheExpire = $cacheExpire;
    }

    /**
     * Set use file cache.
     *
     * @param bool $fileCache.
     */
    public function setFileCache($fileCache)
    {
        $this->fileCache = $fileCache;
    }

    /**
     * Set use directory cache.
     *
     * @param bool $directoryCache.
     */
    public function setDirectoryCache($directoryCache)
    {
        $this->directoryCache = $directoryCache;
    }

    /**
     * Set use string cache.
     *
     * @param bool $stringCache.
     */
    public function setStringCache($stringCache)
    {
        $this->stringCache = $stringCache;
    }

    /**
     * Set use JavaScript cache.
     *
     * @param bool $jsCache.
     */
    public function setJsCache($jsCache)
    {
        $this->jsCache = $jsCache;
    }

    /**
     * Set use CSS cache.
     *
     * @param bool $cssCache.
     */
    public function setCssCache($cssCache)
    {
        $this->cssCache = $cssCache;
    }

    /**
     * Set minify application styles and script when cache is not active.
     *
     * @param bool $minify.
     */
    public function setMinify($minify)
    {
        $this->minify = $minify;
    }

    /**
     * Set HTML source code compressor.
     *
     * @param bool $compressor.
     */
    public function setCompressor($compressor)
    {
        $this->compressor = $compressor;
    }

    /**
     * Set sign in error count. Lock user by email address or user name.
     *
     * @param int $signInErrorCount.
     */
    public function setSignInErrorCount($signInErrorCount)
    {
        $this->signInErrorCount = $signInErrorCount;
    }

    /**
     * Set reset password expire time in seconds.
     *
     * @param int $resetPasswordExpire.
     */
    public function setResetPasswordExpire($resetPasswordExpire)
    {
        $this->resetPasswordExpire = $resetPasswordExpire;
    }

    /**
     * Set use COOKIE to unlock set COOKIES.
     *
     * @param bool $cookieLock.
     */
    public function setCookieLock($cookieLock)
    {
        $this->cookieLock = $cookieLock;
    }

    /**
     * Set use expert mod admin section.
     *
     * @param bool $expertModeAdmin.
     */
    public function setExpertModeAdmin($expertModeAdmin)
    {
        $this->expertModeAdmin = $expertModeAdmin;
    }

    /**
     * Set display info admin section.
     *
     * @param bool $infoAdmin.
     */
    public function setInfoAdmin($infoAdmin)
    {
        $this->infoAdmin = $infoAdmin;
    }

    /**
     * Set debug. Throws any exceptions or write exceptions to error log.
     *
     * @param bool $debug.
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * Set debug ajax. Displays AJAX ID on bottom of application.
     *
     * @param bool $debugAjax.
     */
    public function setDebugAjax($debugAjax)
    {
        $this->debugAjax = $debugAjax;
    }

    /**
     * Get database type.
     *
     * @return string.
     */
    public function getDbType()
    {
        return $this->dbType;
    }

    /**
     * Get database host.
     *
     * @return string.
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }

    /**
     * Get database name.
     *
     * @return string.
     */
    public function getDbName()
    {
        return $this->dbName;
    }

    /**
     * Get database user name.
     *
     * @return string.
     */
    public function getDbUser()
    {
        return $this->dbUser;
    }

    /**
     * Get database password.
     *
     * @return string.
     */
    public function getDbPass()
    {
        return $this->dbPass;
    }

    /**
     * Get database port.
     *
     * @return string.
     */
    public function getDbPort()
    {
        return $this->dbPort;
    }

    /**
     * Get database charset.
     *
     * @return string.
     */
    public function getDbCharset()
    {
        return $this->dbCharset;
    }

    /**
     * Get prefix.
     *
     * @return string.
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Get "index.php" url.
     *
     * @return string.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get "index.php" directory.
     *
     * @return string.
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Get cache directory.
     *
     * @return string.
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    /**
     * Get temporary directory.
     *
     * @return string.
     */
    public function getTmpDir()
    {
        return $this->tmpDir;
    }

    /**
     * Get log directory.
     *
     * @return string.
     */
    public function getLogDir()
    {
        return $this->logDir;
    }

    /**
     * Get smarty and twig compile directory.
     *
     * @return string.
     */
    public function getCompileDir()
    {
        return $this->compileDir;
    }

    /**
     * Get smarty and twig config directory.
     *
     * @return string.
     */
    public function getConfigDir()
    {
        return $this->configDir;
    }

    /**
     * Get use app cache.
     *
     * @return bool.
     */
    public function getAppCache()
    {
        return $this->appCache;
    }

    /**
     * Global app cache expire time in seconds.
     *
     * @return int.
     */
    public function getCacheExpire()
    {
        return $this->cacheExpire;
    }

    /**
     * Get use file cache.
     *
     * @return bool.
     */
    public function getFileCache()
    {
        return $this->fileCache;
    }

    /**
     * Get use directory cache.
     *
     * @return bool.
     */
    public function getDirectoryCache()
    {
        return $this->directoryCache;
    }

    /**
     * Get use string cache.
     *
     * @return bool.
     */
    public function getStringCache()
    {
        return $this->stringCache;
    }

    /**
     * Get use JavaScript cache.
     *
     * @return bool.
     */
    public function getJsCache()
    {
        return $this->jsCache;
    }

    /**
     * Get use CSS cache.
     *
     * @return bool.
     */
    public function getCssCache()
    {
        return $this->cssCache;
    }

    /**
     * Get minify styles and scripts when cache is not active
     *
     * @return bool.
     */
    public function getMinify()
    {
        return $this->minify;
    }

    /**
     * Get HTML source code compressor.
     *
     * @return bool.
     */
    public function getCompressor()
    {
        return $this->compressor;
    }

    /**
     * Get JavaScript head includes.
     *
     * @return array.
     */
    public function getIncludeJs()
    {
        return $this->includeJs;
    }

    /**
     * Get CSS head includes.
     *
     * @return array.
     */
    public function getIncludeCss()
    {
        return $this->includeCss;
    }

    /**
     * Get autoloader directories.
     *
     * @return array.
     */
    public function getDirectories()
    {
        return $this->directories;
    }

    /**
     * Get sign in error count. Lock user by email address or user name.
     *
     * @return int.
     */
    public function getSignInErrorCount()
    {
        return $this->signInErrorCount;
    }

    /**
     * Get reset password link expire time in seconds.
     *
     * @return bool.
     */
    public function getResetPasswordExpire()
    {
        return $this->resetPasswordExpire;
    }

    /**
     * Get use COOKIE to unlock to set COOKIES.
     *
     * @return bool.
     */
    public function getCookieLock()
    {
        return $this->cookieLock;
    }

    /**
     * Get verify user name regular expression pattern for application users.
     *
     * @return array.
     */
    public function getUserRegexApplication()
    {
        return $this->userRegexApplication;
    }

    /**
     * Get verify password regular expression pattern for application users.
     *
     * @return array.
     */
    public function getPassRegexApplication()
    {
        return $this->passRegexApplication;
    }

    /**
     * Get disable groups application.
     *
     * @return int.
     */
    public function getDisableGroupsApplication()
    {
        return $this->disableGroupsApplication;
    }

    /**
     * Get application authentication lifetime in seconds.
     *
     * @return int.
     */
    public function getAuthenticationLifetimeApplication()
    {
        return $this->authenticationLifetimeApplication;
    }

    /**
     * Get SESSION timeout in seconds application.
     *
     * @return int.
     */
    public function getSessionTimeoutApplication()
    {
        return $this->sessionTimeoutApplication;
    }

    /**
     * Get use expert mode admin section.
     *
     * @return bool.
     */
    public function getExpertModeAdmin()
    {
        return $this->expertModeAdmin;
    }

    /**
     * Get verify user name regular expression pattern for admin users.
     *
     * @return array.
     */
    public function getUserRegexAdmin()
    {
        return $this->userRegexApplication;
    }

    /**
     * Get verify password regular expression pattern for admin users.
     *
     * @return array.
     */
    public function getPassRegexAdmin()
    {
        return $this->passRegexApplication;
    }

    /**
     * Get file manager accepted directories.
     *
     * @return array.
     */
    public function getFilesDirectories()
    {
        return $this->filesDirectories;
    }

    /**
     * Get file manager allowed file types.
     *
     * @return array.
     */
    public function getFilesTypes()
    {
        return $this->filesTypes;
    }

    /**
     * Get disable groups admin section.
     *
     * @return int.
     */
    public function getDisableGroupsAdmin()
    {
        return $this->disableGroupsAdmin;
    }

    /**
     * Get admin section SESSION timeout.
     *
     * @return int.
     */
    public function getSessionTimeoutAdmin()
    {
        return $this->sessionTimeoutAdmin;
    }

    /**
     * Get show admin section info.
     *
     * @return bool.
     */
    public function getInfoAdmin()
    {
        return $this->infoAdmin;
    }

    /**
     * Get allowed admin section AJAX requests as not admin user.
     *
     * @return array.
     */
    public function getAllowedAdminAjax()
    {
        return $this->allowedAdminAjax;
    }

    /**
     * Get debug.
     *
     * @return bool.
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * Get debug AJAX.
     *
     * @return bool.
     */
    public function getDebugAjax()
    {
        return $this->debugAjax;
    }

    /**
     * Get user name invalid characters.
     *
     * @return array.
     */
    public function getUserInvalidCharacters()
    {
        return $this->userInvalidCharacters;
    }

}