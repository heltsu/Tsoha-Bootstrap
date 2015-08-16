<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['user'])){
          $user_id = $_SESSION['user'];
          $user = PerheenJasen::find($user_id);
          return $user;
      }
      return null;
    }
    
    public static function user_logged_in(){
        $user = self::get_user_logged_in();
        if($user){
            return $user;
        }
        Redirect::to('login');
        return null;
    }

    public static function check_logged_in(){
      if (!isset($_SESSION['user'])){
          Redirect::to('/login', array('error' => 'Kirjaudu ensin sisään!'));
      }
    }

  }
