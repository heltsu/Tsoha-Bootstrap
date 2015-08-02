<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //View::make('home.html');
        echo "Tämä on etusivu!";
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      //echo 'Hello World!';
        View::make("helloworld.html");
    }
    public static function askareet_esittely(){
        View::make('suunnitelmat/askareet_esittely.html');
    }
    
    public static function askareet_list(){
        View::make('suunnitelmat/askareet_list.html');
    }
    
    public static function askareet_login(){
        View::make('suunnitelmat/askareet_login.html');
    }
    
    public static function askareet_muokkaus(){
        View::make('suunnitelmat/askareet_muokkaus.html');
    }
  }
