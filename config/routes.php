<?php

function check_logged_in(){
    BaseController::check_logged_in();
}

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

$routes->get('/askare/:id/edit', function($id) {
    AskareController::edit();
});

$routes->post('/askare/:id/edit', function($id){
    AskareController::update($id);
});

$routes->post('/askare/:id/destroy', function($id){
    AskareController::destroy($id);
});

$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function(){
    UserController::handle_login();
});

$routes->post('/logout', function(){
    UserController::logout();
});

