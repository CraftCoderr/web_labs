<?php

$router = new \Core\Routing\Router();

$router->route('GET', '/', function($request) {
    (new \App\MainController())->index();
})->route('GET', '/aboutme', function($request) {
    (new \App\MainController())->aboutme();
})->route('GET', '/interests', function($request) {
    (new \App\MainController())->interests();
})->route('GET', '/education', function($request) {
    (new \App\MainController())->education();
})->route('GET', '/photos', function($request) {
    (new \App\PhotosController())->showPhotos();
})->route('GET', '/test', function($request) {
    (new \App\TestController())->showTest();
})->route('POST', '/test', function($request) {
    (new \App\TestController())->checkTest($request);
})->route('GET', '/contacts', function($request) {
    (new \App\ContactsController())->showPage();
})->route('POST', '/contacts', function($request) {
    (new \App\ContactsController())->sendMessage($request);
})->route('GET', '/history', function($request) {
    (new \App\MainController())->history();
});