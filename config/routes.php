<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/askareet', function() {
    HelloWorldController::askareet_list();
});

$routes->get('/askareet/1', function(){
    HelloWorldController::askareet_esittely();
});

$routes->get('/askareet/2', function(){
HelloWorldController::askareet_muokkaus();
});

$routes->get('/login', function(){
HelloWorldController::askareet_login();
});

