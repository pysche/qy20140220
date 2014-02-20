<?php
date_default_timezone_set('Asia/Shanghai');

define('BC_VER', '201402181955');
define('BC_ONE_DAY', 86400);
define('BC_START_TIME', microtime());
define('BC_FORCE_RELOAD_CONFIG', getenv('BC_FORCE_RELOAD_CONFIG') ? (bool)getenv('BC_FORCE_RELOAD_CONFIG') : false);
define('BC_LOCAL_CACHER', getenv('BC_LOCAL_CACHER') ? getenv('BC_LOCAL_CACHER') : 'apc');

defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

require_once 'Bc' . DIRECTORY_SEPARATOR . 'Loader.php';
Bc_Loader::getInstance()->register();

Bc_Timer::start('application');

$config = &Bc_Config::getInstance();

$application = new Bc_Application(APPLICATION_ENV, $config);
$application->bootstrap()->run();