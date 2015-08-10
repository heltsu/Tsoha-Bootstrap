<?php

$routes->get('/', function() {
    AskareController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/askare', function() {
    AskareController::index();
});

$routes->post('/askare', function() {
    AskareController::store();
});

$routes->get('/askare/new', function() {
    AskareController::create();
});

$routes->get('/askare/:id', function($id) {
    AskareController::show($id);
});

$routes->get('/askare/2', function() {
    HelloWorldController::askareet_muokkaus();
});

$routes->get('/login', function() {
    HelloWorldController::askareet_login();
});
