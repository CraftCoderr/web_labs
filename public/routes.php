<?php

$router = new \Core\Routing\Router();

$router->route('ANY', '/test/{id}/test1', function($request) {
   echo 'TEST 1 FROM ROUTED HANDLER: '.$request->get('id');
});

$router->route('ANY', '/test/{id}/test2', function($request) {
    echo 'TEST 2 FROM ROUTED HANDLER: '.$request->get('id');
});

$router->route('PUT', '/test/{data}', function($request) {
    echo 'PUT_DATA:<br>';
    echo $request->get('data');
});

$router->route('GET', '/test/{data}', function($request) {
    echo 'GET_DATA:<br>';
    echo $request->get('data');
});