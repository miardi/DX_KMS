<?php

class Home_Model{
    private $table = "KMS_T_SCORES";
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function getAverage(){
        $this->db->query("SELECT   trainee_id
        ,nama
        ,class
        ,AVG(score_pt) AS PT
        ,AVG(score_ht) AS HT
		,AVG((score_ht+score_pt)/2) AS total
        FROM ". $this->table ." JOIN KMS_M_USERS
        ON trainee_id = npk
        JOIN KMS_M_PACKAGE_ASSIGMENT
        ON KMS_M_PACKAGE_ASSIGMENT.package_id = KMS_T_SCORES.package_id
        AND KMS_M_PACKAGE_ASSIGMENT.trainee_npk = KMS_T_SCORES.trainee_id
		WHERE KMS_T_SCORES.package_id = 1
		GROUP BY trainee_id, nama, class
		ORDER BY total DESC");
        return $this->db->resultSet();
    }

    public function getRemed(){
        $this->db->query("SELECT DISTINCT trainee_id
        ,nama
        ,class
		,ISNULL(HT, 0) AS HT
		,ISNULL(PT, 0) AS PT
		,ISNULL(PT, 0)+ISNULL(HT, 0) AS total
        FROM KMS_T_SCORES JOIN KMS_M_USERS
        ON trainee_id = npk
        JOIN KMS_M_PACKAGE_ASSIGMENT
        ON KMS_M_PACKAGE_ASSIGMENT.package_id = KMS_T_SCORES.package_id
        AND KMS_M_PACKAGE_ASSIGMENT.trainee_npk = KMS_T_SCORES.trainee_id
		LEFT JOIN  
		(SELECT   trainee_id AS npk_ht
        ,COUNT(score_ht)AS HT
        FROM KMS_T_SCORES 
		WHERE KMS_T_SCORES.package_id = 1 AND score_ht < 70 
		GROUP BY trainee_id) AS remed_ht
		ON npk_ht = trainee_id
		LEFT JOIN 
		(SELECT   trainee_id AS npk_pt
        ,COUNT(score_pt)AS PT
        FROM KMS_T_SCORES 
		WHERE KMS_T_SCORES.package_id = 1 AND score_pt < 70 
		GROUP BY trainee_id) AS remed_pt
		ON npk_pt = trainee_id
		ORDER BY total DESC");
        return $this->db->resultSet();
    }
}