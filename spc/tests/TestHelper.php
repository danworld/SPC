<?php

ob_start();

define('BASE_PATH', realpath(dirname(__FILE__) . '/../'));
define('APPLICATION_PATH', BASE_PATH . '/application');
define('APPLICATION_ENV', 'testing');

set_include_path(
    '.'
    . PATH_SEPARATOR . BASE_PATH . '/library'
    . PATH_SEPARATOR . get_include_path()
);

error_reporting(E_ALL|E_STRICT);

require_once 'application/controllers/ControllerTestCase.php';