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

$routes->get('/askare/:id', function($id){
    AskareController::show($id);
});

$routes->get('/askareet/2', function(){
HelloWorldController::askareet_muokkaus();
});

$routes->get('/login', function(){
HelloWorldController::askareet_login();
});

