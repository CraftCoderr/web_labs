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
})->route('GET', '/test/results', function($request) {
    (new \App\TestController())->showResults();
})->route('POST', '/test', function($request) {
    (new \App\TestController())->checkTest($request);
})->route('GET', '/contacts', function($request) {
    (new \App\ContactsController())->showPage();
})->route('POST', '/contacts', function($request) {
    (new \App\ContactsController())->sendMessage($request);
})->route('GET', '/history', function($request) {
    (new \App\MainController())->history();
})->route('GET', '/feedback', function($request) {
    (new \App\FeedbackController())->showFeedback();
})->route('POST', '/feedback', function($request) {
    (new \App\FeedbackController())->addFeedback($request);
})->route('GET', '/feedback/upload', function($request) {
    (new \App\FeedbackController())->showUploadForm();
})->route('POST', '/feedback/upload', function($request) {
    (new \App\FeedbackController())->uploadFeedback($request);
})->route('GET', '/blog', function($request) {
    (new \App\BlogController)->show(1);
})->route('GET', '/blog/page/{page}', function($request) {
    (new \App\BlogController)->show($request->get('page'));
})->route('GET', '/blog/post', function($request) {
    (new \App\BlogController)->postForm();
})->route('POST', '/blog/post', function($request) {
    (new \App\BlogController)->makePost($request);
})->route('POST', '/blog/comment', function($request) {
    (new \App\BlogController)->makeComment($request);
})->route('GET', '/uploaded/{id}', function($request) {
    (new \App\ResourcesController())->uploaded($request->get('id'));
})->route('POST', '/blog/import', function($request) {
    (new \App\BlogController())->import();
})->route('GET', '/register', function($request) {
    (new \App\AuthController())->showRegisterForm();
})->route('POST', '/register', function($request) {
    (new \App\AuthController())->register($request);
})->route('POST', '/register/check', function($request) {
    (new \App\AuthController())->checkRegister($request);
})->route('GET', '/auth', function($request) {
    (new \App\AuthController())->showLoginForm();
})->route('POST', '/auth', function($request) {
    (new \App\AuthController())->login($request);
})->route('GET', '/logout', function($request) {
    (new \App\AuthController())->logout();
})->route('GET', '/admin/stats', function($request) {
    (new \App\AdminPageController())->showStatistics(1);
})->route('GET', '/admin/stats/page/{page}', function($request) {
    (new \App\AdminPageController())->showStatistics($request->get('page'));
});
