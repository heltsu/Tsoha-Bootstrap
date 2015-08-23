<?php

function check_logged_in(){
    BaseController::check_logged_in();
}

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

//AskareControllerit

$routes->get('/', function() {
    AskareController::index();
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
    AskareController::edit($id);
});

$routes->post('/askare/:id/edit', function($id){
    AskareController::update($id);
});

$routes->post('/askare/new', function() {
    AskareController::store();
});

$routes->post('/askare/:id/destroy', function($id){
    AskareController::destroy($id);
});

//UserControllerit

$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function(){
    UserController::handle_login();
});

$routes->post('/logout', function(){
    UserController::logout();
});

//LuokkaControllerit

$routes->get('/', function() {
    LuokkaController::index();
});

$routes->get('/luokka', function() {
    LuokkaController::index();
});

$routes->post('/luokka', function() {
    LuokkaController::store();
});

$routes->get('/luokka/new', function() {
    LuokkaController::create();
});

$routes->post('/luokka/new', function() {
    LuokkaController::store();
});

$routes->get('/luokka/:id', function ($id){
    LuokkaController::show($id);
});

$routes->post('/luokka/:id/destroy', function ($id) {
    LuokkaController::destroy($id);    
});

$routes->get('/luokka/:id/edit', function ($id){
LuokkaController::edit($id);
});

$routes->post('/luokka/:id/edit', function($id) {
    LuokkaController::update($id);
});


