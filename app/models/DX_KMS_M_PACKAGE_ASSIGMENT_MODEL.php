<?php

class Package_Assigment_Model
{
    private $table = 'KMS_M_PACKAGE_ASSIGMENT';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPackageAssigment($id)
    {
        $this->db->query('SELECT id
        ,trainee_npk
        ,nama
        ,class
        FROM ' . $this->table . '
        JOIN KMS_M_USERS
        ON trainee_npk = npk
        WHERE package_id = :id
        ORDER BY class');
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }
}
