<?php

//require 'app/models/askare.php';  
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
        $askare = Askare::all();
        $harkkatyo = Askare::find(1);
        
        Kint::dump($askare);
        Kint::dump($harkkatyo);
    }
    public static function askareet_esittely(){
        View::make('suunnitelmat/askare_esittely.html');
    }
    
    public static function askareet_list(){
        View::make('suunnitelmat/askare_list.html');
    }
    
    public static function askareet_login(){
        View::make('suunnitelmat/askare_login.html');
    }
    
    public static function askareet_muokkaus(){
        View::make('suunnitelmat/askare_muokkaus.html');
    }
  }
