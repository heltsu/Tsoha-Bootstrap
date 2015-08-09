<?php

//require 'app/models/askare.php';
class AskareController extends BaseController{
    
    public static function index(){
       $askare = Askare::all();
       View::make('askare/index.html', array('askare' =>$askare));
    }
    
    public static function show($id){
        $askare = Askare::find($id);
        View::make('askare/show.html', array('askare'=>$askare));
    }
}


