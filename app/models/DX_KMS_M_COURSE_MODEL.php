<?php

class Course_Model{
    private $table = "KMS_M_COURSES";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllCourses() {
        $this->db->query('SELECT * FROM ' . $this->table . " ORDER BY name ASC");
        return $this->db->resultSet();
    }

    public function getCourseById($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id',$id);
        return $this->db->single();
    }

    public function addCourse($data){
        $this->db->query("INSERT INTO " . $this->table . " VALUES( :name, :type, :sub_type )");
        $this->db->bind('name', $data['name']);
        $this->db->bind('type', $data['type']);
        $this->db->bind('sub_type', $data['sub_type']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateCourse($data){
        $this->db->query("UPDATE " . $this->table . " SET name = :name, type = :type, sub_type = :sub_type WHERE id = :id ");
        $this->db->bind('name', $data['name']);
        $this->db->bind('type', $data['type']);
        $this->db->bind('sub_type', $data['sub_type']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteCourse($id){
        $this->db->query("DELETE FROM " . $this->table . " WHERE id=:id");
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}