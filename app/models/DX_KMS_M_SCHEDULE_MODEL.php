<?php

class Schedule_Model{
    private $table = "KMS_M_SCHEDULE";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllDate($month = 0){
        if($month > 12 || $month < 1){
            $month = date("m");
        }
        $numberOfDate = [31, (date('Y')%4==0)?29:28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $listOfDate = [];
        for($i=1; $i<= $numberOfDate[$month-1]; $i++){
            $date = date("Y").'-'.str_pad($month, 2, "0", STR_PAD_LEFT).'-'.str_pad($i, 2, "0", STR_PAD_LEFT);
            $listOfDate[] = date_create($date);
        }

        return $listOfDate;
    }

    /**
     * Brief    : This function is to get pivot data to show monthly schelude
     * param    : month
     * type     : number (1-12)
     * return   : array data
     */
    public function getSchedule($month = 0){
        if($month > 12 || $month < 1){
            $month = date("m");
        }
        $numberOfDate = [31, (date('Y')%4==0)?29:28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $listOfDate = "";
        for($i=1; $i<= $numberOfDate[$month-1]; $i++){
            $listOfDate .= '['.date("Y").'-'.str_pad($month, 2, "0", STR_PAD_LEFT).'-'.str_pad($i, 2, "0", STR_PAD_LEFT).']';
            $listOfDate .= ($i== $numberOfDate[$month-1])?" ":", ";
        }

        $order = explode(',',$listOfDate);
        $order = array_reverse($order);
        $order = join(",",$order);

        $query = "SELECT name, class, trainer, room, $listOfDate from 
            (
                SELECT dbo.KMS_M_SCHEDULE.id, dbo.KMS_M_COURSES.name, class, dbo.KMS_M_USERS.nama AS trainer, room, date
                FROM dbo.KMS_M_SCHEDULE
				LEFT JOIN dbo.KMS_M_COURSES 
				ON  course_id = dbo.KMS_M_COURSES.id
				LEFT JOIN dbo.KMS_M_USERS 
				ON trainer_npk = npk
                WHERE MONTH(date) = $month
           ) x
            pivot 
            (
                 count(id)
                for date in ($listOfDate)
            ) p 
            ORDER BY name, class, $order";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getCourse($package, $class){
        $this->db->query("SELECT courseList.course_id, name FROM
                        (SELECT DISTINCT course_id, name, class
                        FROM KMS_M_SCHEDULE
                        JOIN KMS_M_COURSES ON KMS_M_COURSES.id = course_id
                        WHERE package_id = :package AND class = :class) AS courseList
                        LEFT JOIN (SELECT DISTINCT course_id, class
                        FROM KMS_T_SCORES
                        JOIN KMS_M_PACKAGE_ASSIGMENT 
                        ON trainee_id = trainee_npk) AS courseFinish
                        ON courseList.course_id = courseFinish.course_id
                        AND courseList.class = courseFinish.class
                        WHERE courseFinish.course_id IS NULL
                        ORDER BY name");
        
        $this->db->bind('package', $package);
        $this->db->bind('class', $class);
        return $this->db->resultSet();
    }
}