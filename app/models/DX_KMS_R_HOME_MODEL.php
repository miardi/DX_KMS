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

    public function getCourseUnscoring(){
        $today = date('Y-m-d');
        

        $this->db->query("WITH ScoreInputed AS
                            (
                                SELECT	s.course_id,
                                        pa.class AS Class
                                FROM KMS_T_SCORES s
                                JOIN KMS_M_PACKAGE_ASSIGMENT pa
                                    ON s.trainee_id = pa.trainee_npk
                                GROUP BY pa.class, s.course_id
                            ), CourseSchedule AS
                            (
                                SELECT	s.course_id,
                                        s.class,
                                        s.package_id,
                                        MAX(s.date) AS date_end
                                FROM KMS_M_SCHEDULE s
                                JOIN KMS_M_USERS t
                                    ON s.trainer_npk = t.npk
                                GROUP BY s.class, s.package_id,s.course_id
                            ), ScoreUninputed AS
                            (
                                SELECT	cs.course_id,
                                        cs.class,
                                        cs.package_id,
                                        cs.date_end
                                FROM CourseSchedule cs
                                FULL JOIN ScoreInputed  si
                                    ON cs.course_id = si.course_id
                                    AND (cs.Class = si.Class OR cs.Class = 'ALL')
                                WHERE cs.date_end < GETDATE() AND si.course_id is NULL
                            )

                            SELECT	su.course_id,
                                    c.name AS course_name,
                                    s.trainer_npk,
                                    u.nama AS trainer_name,
                                    su.class,
                                    su.package_id,
                                    su.date_end
                            FROM ScoreUninputed su
                            JOIN KMS_M_COURSES c
                                ON su.course_id = c.id
                            JOIN KMS_M_SCHEDULE s
                                ON su.course_id = s.course_id
                                AND su.class = s.class
                                AND su.date_end = s.date
                            JOIN KMS_M_USERS u
                                ON s.trainer_npk = u.npk
");
        $oldQuery = "SELECT	 
                                courseTable.course_id
                                ,course_name
                                ,trainer_npk
                                ,nama AS trainer_name
                                ,courseTable.package_id
                                ,courseTable.class
                                ,date_end 
                        FROM 
                            (
                            SELECT DISTINCT 
                                course_id
                                ,name AS course_name
                                ,class
                                ,package_id
                                ,MAX(date) AS date_end
                            FROM 
                                KMS_M_SCHEDULE
                            JOIN 
                                KMS_M_COURSES 
                                ON 
                                    KMS_M_COURSES.id = course_id
                            GROUP BY 
                                course_id, name
                                ,class
                                ,package_id
                            ) AS courseTable
                        LEFT JOIN 
                            (
                            SELECT 
                                KMS_T_SCORES.id
                                ,trainee_id
                                ,course_id
                                ,KMS_T_SCORES .package_id
                                ,class
                            FROM 
                                KMS_T_SCORES 
                            JOIN
                                KMS_M_PACKAGE_ASSIGMENT
                                ON KMS_T_SCORES.trainee_id = KMS_M_PACKAGE_ASSIGMENT.trainee_npk
                            ) AS scoreTable
                            ON 
                                scoreTable.course_id = courseTable.course_id AND
                                scoreTable.class = courseTable.class
                        JOIN 
                            KMS_M_SCHEDULE
                            ON
                                KMS_M_SCHEDULE.date = date_end AND
                                KMS_M_SCHEDULE.course_id = courseTable.course_id
                        JOIN 
                            KMS_M_USERS
                            ON
                                KMS_M_USERS.npk = trainer_npk
                        WHERE 
                            scoreTable.id IS NULL AND 
                            date_end < :today";
        // $this->db->bind('today', $today);
        return $this->db->resultSet();
    }

    public function getSummaryScores(){
        $this->db->query("
            DECLARE @pacakgeID INT;
            SET @pacakgeID = 1;

            WITH 
            courseList AS (
                SELECT id, name FROM KMS_M_COURSES
                WHERE id IN (
                    SELECT course_id FROM KMS_M_PACKAGE_COURSES
                    WHERE package_id = @pacakgeID
                )
            ),
            trainee AS (
                SELECT npk, nama AS name, class FROM KMS_M_USERS U
                RIGHT JOIN KMS_M_PACKAGE_ASSIGMENT PA 
                    ON U.npk = PA.trainee_npk
            ),
            score AS (
                SELECT	trainee_id, 
                        course_id,
                        actual_trainer_id,
                        score_pt,
                        score_ht,
                        note
                FROM KMS_T_SCORES
            )

            SELECT	courseList.name AS COURSE,
                    score.trainee_id AS NPK,
                    trainee.name AS NAME,
                    trainee.class AS CLASS,
                    score_pt AS PT,
                    score_ht AS HT,
                    u.nama AS TRAINER,
                    note AS NOTE
            FROM score
            RIGHT JOIN courseList ON score.course_id = courseList.id
            LEFT JOIN trainee ON score.trainee_id = trainee.npk
            LEFT JOIN KMS_M_USERS u ON score.actual_trainer_id = u.npk
            ORDER BY COURSE, class
        ");
        return $this->db->resultSet();
    }
}