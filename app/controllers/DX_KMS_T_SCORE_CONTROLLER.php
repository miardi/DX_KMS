<?php

class Score extends Controller{
    public function index(){
        $this->view('template/header',['nav' => 'score','title' => 'Score']);
        $data = $this->model("Score_Model")->getAllScore();
        $this->view('score/score', $data);
        $this->view('template/footer');
    }

    public function input($courseID, $class = 'ALL', $packageID = 1){
        $this->view('template/header',['nav' => 'score','title' => 'Input Score']);
        $data['dataInput'] = $this->model("Score_Model")->getDataInput($courseID, $class, $packageID);
        $data['trainer'] = $this->model("User_Model")->getUserByRole(1);
        $this->view('score/input_score', $data);
        $this->view('template/footer');
    }

    public function submitScore(){
        if(isset($_POST['inputScore'])){
            $course_id = $_POST['courseID'];
            $package_id = $_POST['packageID'];
            $trainer_id = $_POST['trainerNPK'];
            $start_date = $_POST['startDate'];
            $end_date = $_POST['endDate'];
            $trainee = $_POST['trainee'];

            foreach($trainee as $index => $val){
                $res[$index] = $this->model('Score_Model')->addScore([
                    'trainee_id'    => $val['npk']
                    ,'course_id'    => $course_id
                    ,'package_id'   => $package_id
                    ,'trainer_id'   => $trainer_id
                    ,'start_date'   => $start_date
                    ,'end_date'     => $end_date
                    ,'score_pt'     => isset($val['PT'])?$val['PT']:NULL
                    ,'score_ht'     => isset($val['HT'])?$val['HT']:NULL
                    ,'note'         => $val['note']
                    ,'status'       => (($val['PT'] < 70 && isset($val['PT'])) || ($val['HT'] < 70 && isset($val['HT'])))?"Remidi":"Pass"
                ]);
            }

            if($err = array_filter($res, function($val){
                return $val == 0;
            })){
                echo "Failed to add score. <br>";
                die(print_r($err));
            }

            header("location:" . BASE_URL . "/score");
        }
    }

    public function remidial(){
        $this->view('template/header',['nav' => 'score','title' => 'Remidial']);
        $data['remidial'] = $this->model("Score_Model")->getAllRemidial();
        $this->view('score/remidial', $data);
        $this->view('template/footer');
    }
}