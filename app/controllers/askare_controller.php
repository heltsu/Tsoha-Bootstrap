<?php

//require 'app/models/askare.php';
class AskareController extends BaseController{
    
    public static function index(){
       $askareet = Askare::all();
       View::make('askare/index.html', array('askareet' =>$askareet));
    }
    
    public static function show($id){
        $askare = Askare::find($id);
        View::make('askare/show.html', array('askare'=>$askare));
    }
}


