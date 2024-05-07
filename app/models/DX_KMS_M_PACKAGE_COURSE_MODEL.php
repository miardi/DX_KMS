<?php

class Package_Course_Model{
    private $table = 'KMS_M_PACKAGE_COURSES';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPackageCourses() {
        $this->db->query('SELECT KMS_M_PACKAGE_COURSES.id
        ,course_id
        ,KMS_M_COURSES.name AS course_name
        ,trainer_npk
        ,KMS_M_USERS.nama AS trainer_name
        ,package_id
        ,durasi FROM ' . $this->table . '
        JOIN KMS_M_COURSES ON course_id=KMS_M_COURSES.id
        JOIN KMS_M_USERS ON npk=trainer_npk');
        return $this->db->resultSet();
    }

    public function getPackageCourse($id){
        $this->db->query('SELECT KMS_M_PACKAGE_COURSES.id
        ,course_id
        ,KMS_M_COURSES.name AS course_name
        ,trainer_npk
        ,KMS_M_USERS.nama AS trainer_name
        ,package_id
        ,durasi FROM ' . $this->table . '
        JOIN KMS_M_COURSES ON course_id=KMS_M_COURSES.id
        JOIN KMS_M_USERS ON npk=trainer_npk 
        WHERE package_id=:id');
        $this->db->bind('id',$id);
        return $this->db->resultSet();
    }
}