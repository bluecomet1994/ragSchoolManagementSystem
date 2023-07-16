<?php
//queries that are related with admin table or admin related stuffs
//used to PDO drivers instead of mysqli 
//also used prepared statements to prevent sql injections, hopefully
require_once "../../PDODB/DBh.php";
class AdminQuery extends DBh
{
    private $adminEmail = "stiflerwedontgiveup@gmail.com";
    public $rowCount;
    public function checkAdminVerifyCode($e, $code)
    {
        $state = false;
        $query = "SELECT * FROM `admin` WHERE `admin_Email`=? AND `admin_Verify_Code`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$e, $code]);
        $rowFounds = $statement->rowCount();
        if ($rowFounds == 1) {
            $state = 1;
        } else {
            $state = 0;
        }
        return $state;
    }
    public function updateAdminVerifyCode($e, $code)
    {
        $state = false;
        if ($e == $this->adminEmail) {
            $query = "UPDATE `admin`  SET `admin_Verify_Code` =? WHERE `admin_Email`=?";
            $statement = $this->connect()->prepare($query);
            $statement->execute([$code, $e]);
            $rowFounds = $statement->rowCount();
            if ($rowFounds == 1) {
                $state = true;
            } else {
                $state = false;
            }
        } else {
            exit("Wrong Email");
        }
        return $state;
    }
    public function getSubjects()
    {

        $query = "SELECT * FROM `subject` ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $rowFounds = $statement->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $statement->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }
    public function getGrades()
    {

        $query = "SELECT * FROM `grade` ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $rowFounds = $statement->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $statement->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }
    public function getGender()
    {
        $query = "SELECT * FROM `gender` ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $rowFounds = $statement->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $statement->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }

    public function insertSubject($subject)
    {
        $state = false;
        $subjectCheckQuery = "SELECT * FROM `subject` WHERE `subject_name`=?";
        $subjectCheckStmt = $this->connect()->prepare($subjectCheckQuery);
        $subjectCheckStmt->execute([$subject]);
        if ($subjectCheckStmt->rowCount() == 1) {
            echo "Already a subject is there with the given name";
            $state = false;
        } else {
            $query = "INSERT INTO `subject` (`subject_name`) VALUES(?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$subject]);
            if ($insertStatement) {
                $state = true;
            } else {
                $state = false;
            }
        }
        return $state;
    }
    public function insertGrade($grade)
    {
        $state = false;
        $gradeCheckQuery = "SELECT * FROM `grade` WHERE `grade_name`=?";
        $gradeCheckStmt = $this->connect()->prepare($gradeCheckQuery);
        $gradeCheckStmt->execute([$grade]);
        if ($gradeCheckStmt->rowCount() == 1) {
            echo "Already a grade name is there with the given name";
            $state = false;
        } else {
            $query = "INSERT INTO `grade` (`grade_name`) VALUES(?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$grade]);
            if ($insertStatement) {
                $state = true;
            } else {
                $state = false;
            }
        }
        return $state;
    }

    public function getTeachers()
    {

        $query = "SELECT * FROM `teacher` ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $rowFounds = $statement->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $statement->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }


    public function insertTeacher($fname, $lname, $email, $age, $gender, $subject)
    {
        $emailCheck =  $this->checkTeacherEmailForEmail($email);
        if ($emailCheck) {
            $random = rand();
            $code = hash('md5', $random);
            $hashPassword = password_hash($code, PASSWORD_DEFAULT);
            $state = false;
            $status = 0;
            $query = "INSERT INTO `teacher` (`teacher_fname`,`teacher_lname`,`teacher_email`,`teacher_age`,`teacher_gender`,`subject_id`,`teacher_password`,`teacher_status`)
            VALUES (?,?,?,?,?,?,?,?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $email, $age, $gender, $subject, $hashPassword, $status]);
            if ($insertStatement) {
                $state = true;
            } else {
                $state = false;
            }
        } else {
            $state = false;
        }

        return $state;
    }
    public function checkTeacherEmail($e)
    {
        $state = false;
        $teacherCheckQuery = "SELECT * FROM `teacher` WHERE `teacher_email`=?";
        $teacherCheckStmt = $this->connect()->prepare($teacherCheckQuery);
        $teacherCheckStmt->execute([$e]);
        if ($teacherCheckStmt->rowCount() == 1) {
        
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function checkTeacherEmailForEmail($e)
    {
        $state = false;
        $teacherCheckQuery = "SELECT * FROM `teacher` WHERE `teacher_email`=?";
        $teacherCheckStmt = $this->connect()->prepare($teacherCheckQuery);
        $teacherCheckStmt->execute([$e]);
        if ($teacherCheckStmt->rowCount() == 1) {
            echo "Already a teacher name is there with the given name";
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function removeTeacher($id, $email)
    {

        $state = false;

        $emailCheck =  $this->checkTeacherEmail($email);
        if (!$emailCheck) {
            $teacherQuery = "DELETE FROM `teacher` WHERE `teacher_id`=? AND `teacher_email`=?";
            $teacherStatement = $this->connect()->prepare($teacherQuery);
            $teacherDeleteStatus = $teacherStatement->execute([$id, $email]);
            if ($teacherDeleteStatus) {
                echo "Success";
                $state = true;
            } else {
                echo "Failed";
                $state = false;
            }
        } else {
            echo "No Email Found in the DB";
        }
        return $state;
    }

    public function getSingleTeacher($id, $email)
    {
        $emailCheck =  $this->checkTeacherEmail($email);
        if (!$emailCheck) {
            $teacherQuery = "SELECT * FROM `teacher` WHERE `teacher_id`=? AND `teacher_email`=?";
            $teacherStatement = $this->connect()->prepare($teacherQuery);
            $teacherSearchStatus = $teacherStatement->execute([$id, $email]);
            $teacherRowsFound = $teacherStatement->rowCount();
            if ($teacherRowsFound == 1) {
                $resultsArray = $teacherStatement->fetchAll();
               
            } else {
                echo "Failed";
            }
        } else {
            echo "No Email Found in the DB";
        }
        return $resultsArray;
    }
    public function updateTeacher($fname, $lname, $email, $age, $gender,  $subject)
    {
        $state = false;
        $emailCheck =  $this->checkTeacherEmail($email);
        if (!$emailCheck) {

            $state = false;

            $query = "UPDATE `teacher` SET `teacher_fname`=?,`teacher_lname`=?,`teacher_age`=?,`teacher_gender`=?,`subject_id`=? WHERE `teacher_email`=? ";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $age, $gender,  $subject, $email]);
            if ($insertStatement) {
         
                $state = true;
            } else {
            
                $state = false;
            }
        } else {
            $state = false;
        }

        return $state;
    }
    public function teacherCheckEnM($email,$id){
        $state = false;
        $teacherCheckQuery = "SELECT * FROM `teacher` WHERE `teacher_email`=? AND `teacher_Id`=?";
        $teacherCheckStmt = $this->connect()->prepare($teacherCheckQuery);
        $teacherCheckStmt->execute([$email,$id]);
        if ($teacherCheckStmt->rowCount() == 1) {
         
            $state = false;
           
        } else {
            $state = true;
        }
        return $state;
    }
    public function setTeacherPassword($email,$id,$p){
        $hashPassword = password_hash($p, PASSWORD_DEFAULT);
        $teacherCheck= $this->teacherCheckEnM($email,$id);
        if(!$teacherCheck){
            
            $teacherCheckQuery = "UPDATE `teacher` SET `teacher_password`=? WHERE `teacher_id`=? AND `teacher_email`=? ";
            $teacherCheckStmt = $this->connect()->prepare($teacherCheckQuery);
            $teacherCheckStmt->execute([$hashPassword,$id,$email]);
            echo "password set successfully";
        }
    }
    public function getTeacherDetails($email){
        $state = false;
        $teacherCheckQuery = "SELECT * FROM `teacher` WHERE `teacher_email`=?";
        $teacherCheckStmt = $this->connect()->prepare($teacherCheckQuery);
        $teacherCheckStmt->execute([$email]);
        $rowFounds = $teacherCheckStmt ->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $teacherCheckStmt ->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }
    public function addVerificationCode($id,$code){
        $userCheck = $this->checkVerificationCode($id);
        if($userCheck){
            $tablename ="verification_code_teacher";
            $query ="UPDATE `".$tablename."` SET `verify_code`=? WHERE `id`=?";
            $queryStatement = $this->connect()->prepare($query);
            $queryStatement->execute([$code,$id]);
        }else{
            $tablename ="verification_code_teacher";
            $query ="INSERT INTO `".$tablename."` (`verify_code`,`id`) VALUES(?,?)";
            $queryStatement = $this->connect()->prepare($query);
            $queryStatement->execute([$code,$id]);
        }
    
    }
    public function checkVerificationCode($id){
        $state = false;
        $tablename ="verification_code_teacher";
        $CheckQuery = "SELECT * FROM `$tablename` WHERE `id`=?";
        $CheckStmt = $this->connect()->prepare($CheckQuery);
        $CheckStmt->execute([$id]);
        $rowFounds = $CheckStmt ->rowCount();
        if ($rowFounds == 1) {
               $state =true;
        } else {
             $state =false;
        }

        return $state;
    }
}
