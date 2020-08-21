<?php

$router = new \Core\Routing\Router();

$router->route('GET', '/', function($request) {
    (new \App\MainController())->index();
});

$router->route('GET', '/aboutme', function($request) {
    (new \App\MainController())->aboutme();
});

$router->route('GET', '/interests', function($request) {
    (new \App\MainController())->interests();
});

$router->route('GET', '/education', function($request) {
    (new \App\MainController())->education();
});

$router->route('GET', '/photos', function($request) {
    (new \App\PhotosController())->showPhotos();
});

$router->route('GET', '/test', function($request) {
    (new \App\MainController())->test();
});

$router->route('GET', '/contacts', function($request) {
    (new \App\MainController())->contacts();
});

$router->route('GET', '/history', function($request) {
    (new \App\MainController())->history();
});

$router->route('ANY', '/test/{id}/test1', function($request) {
   echo 'TEST 1 FROM ROUTED HANDLER: '.$request->get('id');
});

$router->route('ANY', '/test/{id}/test2', function($request) {
    echo 'TEST 2 FROM ROUTED HANDLER: '.$request->get('id');
});

$router->route('PUT', '/test/data/{data}', function($request) {
    echo 'PUT_DATA:<br>';
    echo $request->get('data');
});

$router->route('GET', '/test/data/{data}', function($request) {
    (new \App\TestController())->test($request);
//    echo 'GET_DATA:<br>';
//    echo $request->get('data');
});