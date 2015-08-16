<?php

//require 'app/models/askare.php';  
class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //View::make('home.html');
        echo "Tämä on etusivu!";
    }

    public static function sandbox(){
        $askare = new Askare(array(
            'nimi' => 'soita',
            'tarkeys' => '6',
            'valmis' => '17.8.2015',
            'muuta' => 'soita'
            ));
        $errors = $askare->errors();
        
        Kint::dump($errors);
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
