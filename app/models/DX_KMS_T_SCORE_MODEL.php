<?php

class Score_Model {
    private $table = "KMS_T_SCORES";
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAllScore() {
        $this->db->query('SELECT KMS_T_SCORES.id
        ,trainee_id
        ,nama
        ,course_id
        ,KMS_M_COURSES.name AS course_name
        ,KMS_T_SCORES.package_id AS package_id
        ,KMS_M_PACKAGES.name AS package_name
        ,class
        ,score_pt
        ,score_ht 
        FROM ' . $this->table . " JOIN KMS_M_USERS
        ON trainee_id = npk
        JOIN KMS_M_PACKAGES
        ON package_id = KMS_M_PACKAGES.id
        JOIN KMS_M_COURSES
        ON course_id = KMS_M_COURSES.id
        JOIN KMS_M_PACKAGE_ASSIGMENT
        ON KMS_M_PACKAGE_ASSIGMENT.package_id = KMS_T_SCORES.package_id
        AND KMS_M_PACKAGE_ASSIGMENT.trainee_npk = KMS_T_SCORES.trainee_id
        ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getDataInput($courseID, $class = 'ALL', $packageID = 1){
        $filter = (strtoupper($class) == 'ALL')?"":" AND class = '$class'";
        $this->db->query("SELECT 
                            classSchedule.package_id
                            ,KMS_M_PACKAGES.name AS package_name
                            ,KMS_M_SCHEDULE.class
                            ,classSchedule.course_id
                            ,KMS_M_COURSES.name AS course_name
                            ,KMS_M_SCHEDULE.trainer_npk
                            ,KMS_M_USERS.nama AS trainer_name
                            ,trainee_npk
                            ,trainee_name
                            ,date_start
                            ,date_end
                        FROM
                            (
                            SELECT 
                                traineeList.package_id
                                ,traineeList.course_id
                                ,trainee_npk
                                ,trainee_name
                                ,MIN(date) as date_start
                                ,MAX(date) AS date_end
                            FROM
                                (
                                SELECT 
                                    KMS_M_PACKAGE_COURSES.package_id
                                    ,course_id
                                    ,trainee_npk
                                    ,KMS_M_USERS.nama AS trainee_name
                                FROM 
                                    KMS_M_PACKAGE_COURSES
                                JOIN 
                                    KMS_M_PACKAGE_ASSIGMENT
                                    ON 
                                        KMS_M_PACKAGE_COURSES.package_id = KMS_M_PACKAGE_ASSIGMENT.package_id
                                JOIN 
                                    KMS_M_USERS 
                                    ON 
                                        npk = trainee_npk
                                WHERE 
                                    course_id = :courseID $filter AND 
                                    KMS_M_PACKAGE_COURSES.package_id = :packageID
                                ) as traineeList
                            JOIN 
                                KMS_M_SCHEDULE
                                ON
                                    traineeList.course_id = KMS_M_SCHEDULE.course_id AND
                                    KMS_M_SCHEDULE.class = :class 
                            GROUP BY 
                                traineeList.package_id
                                ,traineeList.course_id
                                ,trainee_npk
                                ,trainee_name
                            ) as classSchedule
                        JOIN 
                            KMS_M_SCHEDULE 
                            ON 
                                KMS_M_SCHEDULE.date = date_end AND
                                KMS_M_SCHEDULE.class = :clas AND
		                        KMS_M_SCHEDULE.course_id = classSchedule.course_id
                        JOIN 
                            KMS_M_PACKAGES 
                            ON 
                                KMS_M_PACKAGES.id = classSchedule.package_id
                        JOIN 
                            KMS_M_COURSES 
                            ON 
                                KMS_M_COURSES.id = classSchedule.course_id
                        JOIN 
                            KMS_M_USERS 
                            ON 
                                KMS_M_USERS.npk = KMS_M_SCHEDULE.trainer_npk
                        ORDER BY 
                            trainee_name");

        $oldQuery = "SELECT scoreTable.package_id
                            ,KMS_M_PACKAGES.name AS package_name
                            ,KMS_M_SCHEDULE.class
                            ,scoreTable.course_id
                            ,KMS_M_COURSES.name AS course_name
                            ,KMS_M_SCHEDULE.trainer_npk
                            ,KMS_M_USERS.nama AS trainer_name
                            ,trainee_npk
                            ,trainee_name
                            ,MIN(date) AS date_start
                            ,MAX(date) AS date_end
                        FROM
                        (SELECT KMS_M_PACKAGE_COURSES.package_id
                            ,course_id
                            ,trainee_npk
                            ,KMS_M_USERS.nama AS trainee_name
                        FROM KMS_M_PACKAGE_COURSES
                        JOIN KMS_M_PACKAGE_ASSIGMENT
                        ON KMS_M_PACKAGE_COURSES.package_id = KMS_M_PACKAGE_ASSIGMENT.package_id
                        JOIN KMS_M_USERS ON npk = trainee_npk
                        WHERE course_id = :courseID $filter AND KMS_M_PACKAGE_COURSES.package_id = :packageID) AS scoreTable
                        JOIN KMS_M_PACKAGES ON KMS_M_PACKAGES.id = package_id
                        JOIN KMS_M_COURSES ON KMS_M_COURSES.id = course_id
                        JOIN KMS_M_SCHEDULE ON KMS_M_SCHEDULE.course_id = scoreTable.course_id AND KMS_M_SCHEDULE.class = :class
                        JOIN KMS_M_USERS ON KMS_M_USERS.npk = KMS_M_SCHEDULE.trainer_npk
                        GROUP BY scoreTable.package_id
                            ,KMS_M_PACKAGES.name 
                            ,KMS_M_SCHEDULE.class
                            ,scoreTable.course_id
                            ,KMS_M_COURSES.name
                            ,KMS_M_SCHEDULE.trainer_npk
                            ,KMS_M_USERS.nama
                            ,trainee_npk
                            ,trainee_name
                        ORDER BY trainee_name";
        $this->db->bind('courseID', $courseID, PDO::PARAM_INT);
        $this->db->bind('packageID', $packageID, PDO::PARAM_INT);
        $this->db->bind('class', $class, PDO::PARAM_STR);
        $this->db->bind('clas', $class, PDO::PARAM_STR);
        return $this->db->resultSet();
    }

    public function addRemidial($id){
        $this->db->query("INSERT INTO KMS_T_REMIDIAL (score_id) VALUES (:scoreID)");
        $this->db->bind('scoreID', $id);    
    }

    public function getScoreID($data){
        $this->db->query("SELECT id
                        FROM KMS_T_SCORES
                        WHERE	trainee_id = :trainee_id AND
                                course_id = :course_id AND
                                package_id = :package_id AND
                                actual_trainer_id = :trainer_id AND
                                actual_start_date = :start_date AND
                                actual_end_date = :end_date AND
                                score_pt = :score_pt AND
                                score_ht = :score_ht");

        $this->db->bind('trainee_id', $data['trainee_id']);
        $this->db->bind('course_id', $data['course_id']);
        $this->db->bind('package_id', $data['package_id']);
        $this->db->bind('trainer_id', $data['trainer_id']);
        $this->db->bind('start_date', $data['start_date']);
        $this->db->bind('end_date', $data['end_date']);
        $this->db->bind('score_pt', $data['score_pt']);
        $this->db->bind('score_ht', $data['score_ht']);
        
        return $this->db->single();
    }

    public function addScore($data){
        $this->db->query("INSERT INTO KMS_T_SCORES
                        VALUES (:trainee_id
                            ,:course_id
                            ,:package_id
                            ,:trainer_id
                            ,:start_date
                            ,:end_date
                            ,:score_pt
                            ,:score_ht
                            ,:note
                            ,:status)");

        $this->db->bind('trainee_id', $data['trainee_id']);
        $this->db->bind('course_id', $data['course_id']);
        $this->db->bind('package_id', $data['package_id']);
        $this->db->bind('trainer_id', $data['trainer_id']);
        $this->db->bind('start_date', $data['start_date']);
        $this->db->bind('end_date', $data['end_date']);
        $this->db->bind('score_pt', $data['score_pt']);
        $this->db->bind('score_ht', $data['score_ht']);
        $this->db->bind('note', $data['note']);
        $this->db->bind('status', $data['status']);
        
        $this->db->execute();
        $rowCount =  $this->db->rowCount();
        if($data['status'] == 'Remidi'){
            $id = $this->getScoreID($data);
            $this->addRemidial($id['id']);
        }

        

        return $rowCount;
    }

    public function getAllRemidial(){
        $this->db->query("SELECT
                            KMS_T_REMIDIAL.id
                            ,KMS_T_SCORES.trainee_id
                            ,KMS_M_USERS.nama AS trainee_name
                            ,KMS_T_SCORES.course_id
                            ,KMS_M_COURSES.name AS course_name
                            ,KMS_T_SCORES.package_id
                            ,KMS_M_PACKAGES.name AS package_name
                            ,class
                            ,KMS_T_SCORES.actual_trainer_id AS trainer_id
                            ,trainerList.nama AS trainer_name
                            ,IIF(KMS_T_SCORES.score_pt >= 70, NULL, KMS_T_SCORES.score_pt) AS score_pt
                            ,IIF(KMS_T_SCORES.score_ht >= 70, NULL, KMS_T_SCORES.score_ht) AS score_ht
                            ,KMS_T_REMIDIAL.remidial_date
                            ,KMS_T_REMIDIAL.remidial_pt
                            ,KMS_T_REMIDIAL.remidial_ht
                            ,KMS_T_REMIDIAL.note
                        FROM 
                            KMS_T_SCORES
                        JOIN 
                            KMS_T_REMIDIAL
                            ON 
                                KMS_T_SCORES.id = KMS_T_REMIDIAL.score_id
                        JOIN
                            KMS_M_USERS
                            ON 
                                KMS_M_USERS.npk = KMS_T_SCORES.trainee_id
                        JOIN
                            KMS_M_COURSES
                            ON
                                KMS_M_COURSES.id = KMS_T_SCORES.course_id
                        JOIN
                            KMS_M_PACKAGES
                            ON 
                                KMS_M_PACKAGES.id = KMS_T_SCORES.package_id
                        JOIN
                            (SELECT * FROM KMS_M_USERS WHERE role = 1) AS trainerList
                            ON 
                                trainerList.npk = KMS_T_SCORES.actual_trainer_id
                        JOIN
                            KMS_M_PACKAGE_ASSIGMENT
                            ON
                                KMS_M_PACKAGE_ASSIGMENT.trainee_npk = KMS_T_SCORES.trainee_id
                        ORDER BY trainee_name");
        return $this->db->resultSet();
    }
}