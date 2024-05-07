<?php

class Package extends Controller{
    public function index(){
        $this->view('template/header',['nav' => 'package','title' => 'Package']);
        $data = $this->model('Package_Model')->getAllPackages();
        $this->view('package/Package',$data);
        $this->view('template/footer');
    }
    
    public function addPackage(){
        if($this->model('Package_Model')->addPackage($_POST) > 0){
            header("location:" . BASE_URL . "/package");
            exit();
        }

    }

    public function getPackageById(){
        echo json_encode($this->model('Package_Model')->getPackageById($_POST['id']));
    }
    
    public function updatePackage(){
        if($this->model('Package_Model')->updatePackage($_POST) > 0){
            header("location:" . BASE_URL . "/package");
            exit();
        }
    }

    public function deletePackage(){
        if($this->model('Package_Model')->deletePackage($_POST['id']) > 0){
            header("location:" . BASE_URL . "/package");
            exit();
        }
    }

}