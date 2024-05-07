<?php

class Package_Model{
    private $table = "KMS_M_PACKAGES";
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPackages() {
        $this->db->query('SELECT * FROM ' . $this->table . " ORDER BY fiscal_year DESC");
        return $this->db->resultSet();
    }

    public function getPackageById($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id',$id);
        return $this->db->single();
    }

    public function addPackage($data){
        $this->db->query("INSERT INTO " . $this->table . " VALUES( :name, :fiscal_year )");
        $this->db->bind('name', $data['name']);
        $this->db->bind('fiscal_year', $data['fiscal_year']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePackage($data){
        $this->db->query("UPDATE " . $this->table . " SET name = :name, fiscal_year = :fiscal_year WHERE id = :id ");
        $this->db->bind('name', $data['name']);
        $this->db->bind('fiscal_year', $data['fiscal_year']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletePackage($id){
        $this->db->query("DELETE FROM " . $this->table . " WHERE id=:id");
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}