<?php

class Package_Assigment extends Controller{
    public function getPackageAssigment() {
        echo json_encode($this->model('Package_Assigment_Model')->getPackageAssigment($_POST['id']));
    }
}