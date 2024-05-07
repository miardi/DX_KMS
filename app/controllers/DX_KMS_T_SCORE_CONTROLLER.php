<?php

class Score extends Controller{
    public function index(){
        $this->view('template/header',['nav' => 'score','title' => 'Score']);
        $data = $this->model("Score_Model")->getAllScore();
        $this->view('score/score', $data);
        $this->view('template/footer');
    }
}