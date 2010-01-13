<?php

define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

set_include_path(implode(PATH_SEPARATOR, array(
            APPLICATION_PATH . '/../library',
            get_include_path()
)));

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

$getopt = new Zend_Console_Getopt(array(
    'withdata|w' => 'Load database with sample data',
    'env|e-s'    => 'Application environment for which to create database (defaults to development)',
    'help|h'     => 'Help -- usage message'
));

try {
    $getopt->parse();
} catch (Zend_Console_Getopt_Exception $e) {
    echo $e->getUsageMessage();
    return false;
}

if ($getopt->getOption('h')) {
    echo $getopt->getUsageMessage();
    return true;
}

$with_data = $getopt->getOption('w');
$env       = $getopt->getOption('env');

define('APPLICATION_ENV', (null === $env) ? 'development' : $env);

$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$bootstrap = $application->getBootstrap();
$bootstrap->bootstrap('db');
$db_adapter = $bootstrap->getResource('db');

if ('testing' == APPLICATION_ENV) {
    echo 'Writing Database Guestbook in (control-c to cancel): ' .PHP_EOL;
    for ($x = 5; $x > 0; $x--) {
        echo $x . "\r"; sleep(1);
    }
}

try {
    $schema_sql = file_get_contents(dirname(__FILE__) . '/schema.sql');
    $db_adapter->getConnection()->exec($schema_sql);

    if ('testing' != APPLICATION_ENV) {
        echo PHP_EOL;
        echo 'Database Created';
        echo PHP_EOL;
    }

    if ($with_data) {
        $data_sql = file_get_contents(dirname(__FILE__) . '/data.sql');
        $db_adapter->getConnection()->exec($data_sql);
        if ('testing' != APPLICATION_ENV) {
            echo 'Database Loaded.';
            echo PHP_EOL;
        }
    }

} catch (Exception $e) {
    echo 'AN ERROR HAS OCCURED:' . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
    return false;
}

return true;

?>