<?php

class App {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    private function pathDir($name){
        $controllerDir = "../app/controllers/DX_KMS";
        
        switch($name){
            case 'score' : $type = "_T_";break;
            case 'home' : $type = "_R_";break;
            default : $type = "_M_";break;
        }
        
        return $controllerDir.$type.strtoupper($name)."_CONTROLLER.php";
    }
    
    public function __construct() {
        $url = $this->parseURL();

        //Controller
        if(file_exists($this->pathDir($url[0]))){
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once $this->pathDir($this->controller);
        $this->controller = new $this->controller;

        //Method
        if( isset($url[1]) ){
            if(method_exists($this->controller, $url[1]) ){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //Parameters
        if(!empty($url)){
            $this->params = array_values($url);
        }

        //Jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }
        return $url=["Home"];
    }
}