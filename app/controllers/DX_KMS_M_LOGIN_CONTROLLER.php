<?php

class Login extends Controller{
    public function index() {
        $this->view('login/Login');
    }

    public function auth(){
        $login = $this->model('Login_Model')->checkUser($_POST['NPK']);
        if($login) {
            $_SESSION['npk'] = $login['npk'];
            $_SESSION['nama'] = $login['nama'];
            $_SESSION['role'] = $login['role'];
            
            header("Location: " . BASE_URL . "/");
        }
        else {
            echo "login failed";
        }
    }
    
    public function logout(){
        session_unset();
        session_destroy();
        session_abort();
        header("Location: " . BASE_URL . "/");
    }
}