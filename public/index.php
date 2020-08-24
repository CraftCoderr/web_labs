<?php

function exception_handler(Throwable $e) {
    echo 'Unhandled exception:<br>';
    echo 'Type:'.get_class($e).'<br>';
    echo 'Message: '.$e->getMessage().'<br>';
    echo 'Trace:<br>';
    echo $e->getTraceAsString();
}

set_exception_handler('exception_handler');

require __DIR__ . '/autoload.php';
require __DIR__ . '/config.php';
global $config;

if ($config['debug']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require __DIR__ . '/routes.php';
global $router;

$request = new \Core\Routing\Request(explode('?', $_SERVER['REQUEST_URI'])[0]);
$renderer = new \Core\View\Renderer(dirname(__DIR__).'/views/');
session_start();
$router->handle($request);

