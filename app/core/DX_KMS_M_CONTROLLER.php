<?php

class Controller{
    public function view($view, $data = []) {
        $view = explode('/',$view);

        switch($view[1]){
            case 'score' : $type = "_T_";break;
            case 'home' : $type = "_R_";break;
            default : $type = "_M_";break;
        }

        $view[1] = "DX_KMS".$type.strtoupper($view[1]).".php";
        $view = implode('/',$view);
        require_once "../app/views/".$view;
    }
    
    public function model($model) : object {
        $model = explode('_',$model);
        
        switch($model['0']){
            case 'Score' : $type = "_T_";break;
            case 'Home' : $type = "_R_";break;
            default : $type = "_M_";break;
        }
        $model = implode('_',$model);
        
        $fileName = "DX_KMS".$type.strtoupper($model).".php";
        require_once "../app/models/".$fileName;
        return new $model;
    }
}