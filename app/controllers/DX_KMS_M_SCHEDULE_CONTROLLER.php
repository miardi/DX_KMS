<?php

class Schedule extends Controller{
    public function index($params = null){
        $this->view('template/header',['nav' => 'schedule','title' => 'schedule']);
        $data['schedule'] = $this->model('Schedule_Model')->getSchedule($params);
        $data['listOfDate'] = $this->model('Schedule_Model')->getAllDate($params);
        if($params > 12 || $params < 1){
            $data['month'] = date('m');
        }
        else {
            $data['month'] = $params;
        }
        $this->view("schedule/schedule", $data);
        $this->view('template/footer');
    }

    public function getCourse($package, $class){
        $data = $this->model('Schedule_Model')->getCourse($package, $class);
        echo json_encode($data);
    }
}