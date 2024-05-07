<?php

class Home extends Controller{
    public function index(){
        $this->view('template/header',['nav' => 'home','title' => 'Home']);
        $data['average'] = $this->model("Home_Model")->getAverage();
        $data['remed'] = $this->model("Home_Model")->getRemed();
        $this->view('home/home', $data);
        $this->view('template/footer');
    }
}