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

require __DIR__ . '/routes.php';

$request = new \Core\Routing\Request(explode('?', $_SERVER['REQUEST_URI'])[0]);
$renderer = new \Core\View\Renderer(dirname(__DIR__).'/views/');
//$router->handle($request);
$renderer->render('base', ['test'=>'Test message!']);

