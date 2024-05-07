<?php

class Package_Course extends Controller{
    public function index(){
        echo json_encode($this->model('Package_Course_Model')->getAllPackageCourses());
    }

    public function getPackageCourse(){
        echo json_encode($this->model('Package_Course_Model')->getPackageCourse($_POST['id']));
    }
}