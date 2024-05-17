<?php

class Login_Model{
    private $table = "KMS_M_USERS";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function checkUser($npk){
        $this->db->query('SELECT npk FROM ' . $this->table . ' WHERE npk=:npk');
        $this->db->bind('npk',$npk);
        return $this->db->single();
    }
}