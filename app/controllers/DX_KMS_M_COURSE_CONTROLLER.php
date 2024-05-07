<?php

class Course extends Controller{
    public function index(){
        $this->view('template/header',['nav' => 'course','title' => 'Course']);
        $data = $this->model('Course_Model')->getAllCourses();
        $this->view('course/Course',$data);
        $this->view('template/footer');
    }

    public function getCourseById(){
        echo json_encode($this->model('Course_Model')->getCourseById($_POST['id']));
    }
}