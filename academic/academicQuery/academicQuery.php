<?php
//academic requred search queries 
require_once "../../PDODB/DBh.php";
class AcademicQuery extends DBh
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

    public function getacademics()
    {

        $query = "SELECT * FROM `academic` ";
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


    public function insertacademic($fname, $lname, $email, $age, $gender)
    {     //instead of saving the password directly used hasing so 
           //even if the database get losts the password won't be broken 
        $emailCheck =  $this->checkacademicEmailForEmail($email);
        if ($emailCheck) {
            $random = rand();
            $code = hash('md5', $random);
            $hashPassword = password_hash($code, PASSWORD_DEFAULT);
            $state = false;
            $status = 0;
            $query = "INSERT INTO `academic` (`academic_fname`,`academic_lname`,`academic_email`,`academic_age`,`academic_gender`,`academic_password`,`academic_status`)
            VALUES (?,?,?,?,?,?,?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $email, $age, $gender, $hashPassword, $status]);
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
    public function checkacademicEmail($e)
    {
        $state = false;
        $academicCheckQuery = "SELECT * FROM `academic` WHERE `academic_email`=?";
        $academicCheckStmt = $this->connect()->prepare($academicCheckQuery);
        $academicCheckStmt->execute([$e]);
        if ($academicCheckStmt->rowCount() == 1) {

            $state = false;
        } else {

            $state = true;
        }
        return $state;
    }
    public function checkacademicEmailForEmail($e)
    {
        $state = false;
        $academicCheckQuery = "SELECT * FROM `academic` WHERE `academic_email`=?";
        $academicCheckStmt = $this->connect()->prepare($academicCheckQuery);
        $academicCheckStmt->execute([$e]);
        if ($academicCheckStmt->rowCount() == 1) {
            echo "Already a academic name is there with the given name";
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function removeacademic($id, $email)
    {

        $state = false;

        $emailCheck =  $this->checkacademicEmail($email);
        if (!$emailCheck) {
            $academicQuery = "DELETE FROM `academic` WHERE `academic_id`=? AND `academic_email`=?";
            $academicStatement = $this->connect()->prepare($academicQuery);
            $academicDeleteStatus = $academicStatement->execute([$id, $email]);
            if ($academicDeleteStatus) {
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

    public function getSingleacademic($id, $email)
    {
        $emailCheck =  $this->checkacademicEmail($email);
        if (!$emailCheck) {
            $academicQuery = "SELECT * FROM `academic` WHERE `academic_id`=? AND `academic_email`=?";
            $academicStatement = $this->connect()->prepare($academicQuery);
            $academicSearchStatus = $academicStatement->execute([$id, $email]);
            $academicRowsFound = $academicStatement->rowCount();
            if ($academicRowsFound == 1) {
                $resultsArray = $academicStatement->fetchAll();
            } else {
                echo "Failed";
            }
        } else {
            echo "No Email Found in the DB";
        }
        return $resultsArray;
    }
    public function academicCheckEnP($email, $password)
    {
        $state = false;
        $academicCheckQuery = "SELECT * FROM `academic` WHERE `academic_email`=? ";
        $academicCheckStmt = $this->connect()->prepare($academicCheckQuery);
        $academicCheckStmt->execute([$email]);
        if ($academicCheckStmt->rowCount() == 1) {
            $academicRow = $academicCheckStmt->fetchAll(PDO::FETCH_ASSOC);
            $hashedPassword = $academicRow[0]["academic_password"];

            $passwordMatchStatus = password_verify($password, $hashedPassword);
            if ($passwordMatchStatus) {
                $state = true;
                echo "Success";
            } else {
                echo "no";
                $state = false;
            }
        } else {
            $state = true;
        }
        return $state;
    }

    public function changestudentstatus($email)
    {
        if($this->checkstudentstatus($email)){
           
        }
    }
    public function getstudentstatus($email){

    }
    public function checkstudentstatus($email)
    {
        $state = false;
        $query = "SELECT * FROM student WHERE student.student_email=? ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$email]);
        if($stmt->rowCount()==1){
            $state = true;
        }                 
        return $state;
    }
    public function updatefnameNlname($email, $fname, $lname)
    {
        $state = false;
        if (!$this->checkacademicEmail($email)) {
            $query = "UPDATE academic SET `academic_fname`=?,`academic_lname`=? 
                     WHERE `academic_email`=?";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $email]);
            if ($insertStatement) {
                $state = true;
            }
        }
        return $state;
    }

    public function updateacademicpropic($id, $src)
    {
        if ($this->checkpropic($id)) {
            $propicrow = $this->getpropic($id);
            $earilersrc = $propicrow[0]['academic_pro_pic_src'];
            unlink($earilersrc);


            $query = "UPDATE academic_pro_pic SET `academic_pro_pic_src`=? 
            WHERE `academic_id`=?";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$src, $id]);
            if ($insertStatement) {
                $state = true;
            }
        } else {
            $query = "INSERT INTO academic_pro_pic  (`academic_pro_pic_src`,`academic_id`)
            VALUES(?,?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$src, $id]);
            if ($insertStatement) {
                $state = true;
            }
        }
    }
    public function updateacademic($fname, $lname, $email, $age, $gender)
    {
        $state = false;
        $emailCheck =  $this->checkacademicEmail($email);
        if (!$emailCheck) {

            $state = false;

            $query = "UPDATE `academic` SET `academic_fname`=?,`academic_lname`=?,`academic_age`=?,`academic_gender`=? WHERE `academic_email`=? ";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $age, $gender, $email]);
            echo $email;
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
    public function academicCheckEnM($email, $id)
    {
        $state = false;
        $academicCheckQuery = "SELECT * FROM `academic` WHERE `academic_email`=? AND `academic_Id`=?";
        $academicCheckStmt = $this->connect()->prepare($academicCheckQuery);
        $academicCheckStmt->execute([$email, $id]);
        if ($academicCheckStmt->rowCount() == 1) {

            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function setacademicPassword($email, $id, $p)
    {
        $hashPassword = password_hash($p, PASSWORD_DEFAULT);
        $academicCheck = $this->academicCheckEnM($email, $id);
        if (!$academicCheck) {
            $academicCheckQuery = "UPDATE `academic` SET `academic_password`=? WHERE `academic_id`=? AND `academic_email`=? ";
            $academicCheckStmt = $this->connect()->prepare($academicCheckQuery);
            $academicCheckStmt->execute([$hashPassword, $id, $email]);
        }
    }
    public function getacademicDetails($email)
    {
        $state = false;
        $academicCheckQuery = "SELECT * FROM `academic` WHERE `academic_email`=?";
        $academicCheckStmt = $this->connect()->prepare($academicCheckQuery);
        $academicCheckStmt->execute([$email]);
        $rowFounds = $academicCheckStmt->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $academicCheckStmt->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }
    public function addVerificationCode($id, $code)
    {
        $userCheck = $this->checkVerificationCode($id);
        if ($userCheck) {
            $tablename = "verification_code_academic";
            $query = "UPDATE `verification_code_academic` SET `verify_code`=? WHERE `id`=?";
            $queryStatement = $this->connect()->prepare($query);
            $queryStatement->execute([$code, $id]);
        } else {
            $tablename = "verification_code_academic";
            $query = "INSERT INTO `verification_code_academic` (`verify_code`,`id`) VALUES(?,?)";
            $queryStatement = $this->connect()->prepare($query);
            $queryStatement->execute([$code, $id]);
        }
    }
    public function checkVerificationCode($id)
    {
        $state = false;
        $tablename = "verification_code_academic";
        $CheckQuery = "SELECT * FROM `$tablename` WHERE `id`=?";
        $CheckStmt = $this->connect()->prepare($CheckQuery);
        $CheckStmt->execute([$id]);
        $rowFounds = $CheckStmt->rowCount();
        if ($rowFounds == 1) {
            $state = true;
        } else {
            $state = false;
        }

        return $state;
    }



    public function checkVerificationCodebyemailNcode($email, $code)
    {
        $state = false;
        $CheckQuery = "SELECT * FROM verification_code_academic
        INNER JOIN academic
        ON academic.academic_id = verification_code_academic.id
        WHERE academic.academic_email = ?
        AND verification_code_academic.verify_code =?";
        $CheckStmt = $this->connect()->prepare($CheckQuery);
        $CheckStmt->execute([$email, $code]);
        $rowFounds = $CheckStmt->rowCount();
        if ($rowFounds == 1) {
            $state = true;
        } else {
            $state = false;
        }

        return $state;
    }
    public function checkVerificationCodebyemail($email)
    {
        $state = false;
        $CheckQuery = "SELECT * FROM verification_code_academic
        INNER JOIN academic
        ON academic.academic_id = verification_code_academic.id
        WHERE academic.academic_email = ? ";
        $CheckStmt = $this->connect()->prepare($CheckQuery);
        $CheckStmt->execute([$email]);
        $rowFounds = $CheckStmt->rowCount();
        if ($rowFounds == 1) {
            $state = true;
        } else {
            $state = false;
        }

        return $state;
    }
    public function removeverificationcoderow($code)
    {
        $query = "DELETE FROM `verification_code_academic` WHERE `verify_code`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$code]);
    }
    public function checkpropic($id)
    {
        $state = false;
        $CheckQuery = "SELECT * FROM academic_pro_pic
        WHERE academic_pro_pic.academic_id = ? ";
        $CheckStmt = $this->connect()->prepare($CheckQuery);
        $CheckStmt->execute([$id]);
        $rowFounds = $CheckStmt->rowCount();
        if ($rowFounds == 1) {
            $state = true;
        } else {
            $state = false;
        }

        return $state;
    }
    public function getpropic($id)
    {
        if ($this->checkpropic($id)) {
            $query = "SELECT * FROM academic_pro_pic
            WHERE academic_pro_pic.academic_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$id]);
            $rowFounds = $stmt->rowCount();
            if ($rowFounds >= 1) {
                $fetchRows = $stmt->fetchAll();
                $this->rowCount = $rowFounds;
            } else {
                $fetchRows = array("Nothing");
                $this->rowCount = 0;
            }
            return $fetchRows;
        }
    }
    public function removepropic($id)
    {
        $state = false;
        if ($this->checkpropic($id)) {
            $propicrow = $this->getpropic($id);
            $earilersrc = $propicrow[0]['academic_pro_pic_src'];
            unlink($earilersrc);
            $query = "DELETE FROM academic_pro_pic
            WHERE academic_pro_pic.academic_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmtCheck = $stmt->execute([$id]);
            if ($stmtCheck) {
                $state = true;
            }
        }

        return $state;
    }
}
