<?php

class Home extends Controller{
    public function index(){
        $this->view('template/header',['nav' => 'home','title' => 'Home']);
        $data['average'] = $this->model("Home_Model")->getAverage();
        $data['remed'] = $this->model("Home_Model")->getRemed();
        $data['unscored'] = $this->model("Home_Model")->getCourseUnscoring();
        $this->view('home/home', $data);
        $this->view('template/footer');
    }
    public function summary_scores(){
        $this->view('template/header',['nav' => 'home','title' => 'Home']);
        $data['scores'] = $this->model("Home_Model")->getSummaryScores();
        $this->view('home/detail_scores', $data);
        $this->view('template/footer');
    }
}