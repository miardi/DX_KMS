<?php

class Login extends Controller{
    public function index() {
        $this->view('login/Login');
    }

    public function auth(){
        print_r($_POST);    
    }
}