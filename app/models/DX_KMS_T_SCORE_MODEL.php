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
}