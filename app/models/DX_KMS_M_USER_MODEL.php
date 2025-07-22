<?php

class User_Model{
    public $db;
    protected $table = "KMS_M_USERS";

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getRole($role){

    }

    public function getUserByRole($role){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE role = :role');
        $this->db->bind('role', $role);
        return $this->db->resultSet();
    }
}