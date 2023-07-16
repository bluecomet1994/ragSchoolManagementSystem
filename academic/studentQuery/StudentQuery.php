<?php
require_once "../../PDODB/DBh.php";
class StudentQuery extends DBh
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
    public function getstudentgrade($id)
    {

        $query = "SELECT * FROM student
        INNER JOIN
        grade
        ON grade.grade_id = student.grade_id
         WHERE `student_id`=?  ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
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

    public function getstudents()
    {

        $query = "SELECT * FROM `student` ";
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
    public function getstudentsbygrade($grade_id)
    {

        $query = "SELECT * FROM `student` WHERE `grade_id`=? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$grade_id]);
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
    public function getstudentbystudentid($id)
    {
        $query = "SELECT * FROM `student` WHERE student.student_id =? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
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

    public function insertstudent($fname, $lname, $email, $age, $gender, $date, $gradeid)
    {
        $emailCheck =  $this->checkstudentEmailForEmail($email);
        if ($emailCheck) {
            $random = rand();
            $code = hash('md5', $random);
            $hashPassword = password_hash($code, PASSWORD_DEFAULT);
            $state = false;
            $status = 0;
            $query = "INSERT INTO `student` (`student_fname`,`student_lname`,`student_email`,`student_age`,`student_gender`,`student_password`,`student_status`,`student_due_date`,`grade_id`)
            VALUES (?,?,?,?,?,?,?,?,?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $email, $age, $gender, $hashPassword, $status, $date, $gradeid]);
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
    public function checkstudentEmail($e)
    {
        $state = false;
        $studentCheckQuery = "SELECT * FROM `student` WHERE `student_email`=?";
        $studentCheckStmt = $this->connect()->prepare($studentCheckQuery);
        $studentCheckStmt->execute([$e]);
        if ($studentCheckStmt->rowCount() == 1) {

            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function checkstudentEmailForEmail($e)
    {
        $state = false;
        $studentCheckQuery = "SELECT * FROM `student` WHERE `student_email`=?";
        $studentCheckStmt = $this->connect()->prepare($studentCheckQuery);
        $studentCheckStmt->execute([$e]);
        if ($studentCheckStmt->rowCount() == 1) {
            echo "Already a student name is there with the given name";
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function removestudent($id, $email)
    {

        $state = false;

        $emailCheck =  $this->checkstudentEmail($email);
        if (!$emailCheck) {
            $studentQuery = "DELETE FROM `student` WHERE `student_id`=? AND `student_email`=?";
            $studentStatement = $this->connect()->prepare($studentQuery);
            $studentDeleteStatus = $studentStatement->execute([$id, $email]);
            if ($studentDeleteStatus) {
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
    public function blockstudent($id, $email)
    {
        $state = false;

        $emailCheck =  $this->checkstudentEmail($email);
        if (!$emailCheck) {
            $studentBlockStatusValue = 0;
            $studentDetails = $this->getstudentDetails($email);
            $studentBlockStatus = $studentDetails[0]["student_status"];
            if ($studentBlockStatus == 1) {
                $studentBlockStatusValue = 0;
            } else {
                $studentBlockStatusValue = 1;
            }
            $studentQuery = "UPDATE `student` SET `student_status`='" . $studentBlockStatusValue . "' WHERE `student_id`=? AND `student_email`=?";
            $studentStatement = $this->connect()->prepare($studentQuery);
            $studentDeleteStatus = $studentStatement->execute([$id, $email]);
            if ($studentDeleteStatus) {
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
    public function changestudentstatus($id, $email)
    {
        $emailCheck =  $this->checkstudentEmail($email);
    }
    public function getSinglestudent($id, $email)
    {
        $emailCheck =  $this->checkstudentEmail($email);
        if (!$emailCheck) {
            $studentQuery = "SELECT * FROM `student` WHERE `student_id`=? AND `student_email`=?";
            $studentStatement = $this->connect()->prepare($studentQuery);
            $studentSearchStatus = $studentStatement->execute([$id, $email]);
            $studentRowsFound = $studentStatement->rowCount();
            if ($studentRowsFound == 1) {
                $resultsArray = $studentStatement->fetchAll();
            } else {
                echo "Failed";
            }
        } else {
            echo "No Email Found in the DB";
        }
        return $resultsArray;
    }
    public function updatestudent($fname, $lname, $email, $age, $gender)
    {
        $state = false;
        $emailCheck =  $this->checkstudentEmail($email);
        if (!$emailCheck) {

            $state = false;

            $query = "UPDATE `student` SET `student_fname`=?,`student_lname`=?,`student_age`=?,`student_gender`=? WHERE `student_email`=? ";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $age, $gender, $email]);
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
    public function studentCheckEnM($email, $id)
    {
        $state = false;
        $studentCheckQuery = "SELECT * FROM `student` WHERE `student_email`=? AND `student_Id`=?";
        $studentCheckStmt = $this->connect()->prepare($studentCheckQuery);
        $studentCheckStmt->execute([$email, $id]);
        if ($studentCheckStmt->rowCount() == 1) {

            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function setstudentPassword($email, $id, $p)
    {
        $hashPassword = password_hash($p, PASSWORD_DEFAULT);
        $studentCheck = $this->studentCheckEnM($email, $id);
        echo "Hey";
        $studentCheckQuery = "UPDATE `student` SET `student_password`=? WHERE `student_id`=? AND `student_email`=? ";
        $studentCheckStmt = $this->connect()->prepare($studentCheckQuery);
        $studentCheckStmt->execute([$hashPassword, $id, $email]);
        if ($studentCheckStmt) {
            echo "Yess changed";
        } else {
            echo "nope";
        }
    }
    public function getstudentDetails($email)
    {
        $state = false;
        $studentCheckQuery = "SELECT * FROM `student` WHERE `student_email`=?";
        $studentCheckStmt = $this->connect()->prepare($studentCheckQuery);
        $studentCheckStmt->execute([$email]);
        $rowFounds = $studentCheckStmt->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $studentCheckStmt->fetchAll();
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
            $tablename = "verification_code_student";
            $query = "UPDATE `" . $tablename . "` SET `verify_code`=? WHERE `id`=?";
            $queryStatement = $this->connect()->prepare($query);
            $queryStatement->execute([$code, $id]);
        } else {
            $tablename = "verification_code_student";
            $query = "INSERT INTO `" . $tablename . "` (`verify_code`,`id`) VALUES(?,?)";
            $queryStatement = $this->connect()->prepare($query);
            $queryStatement->execute([$code, $id]);
        }
    }
    public function checkVerificationCode($id)
    {
        $state = false;
        $tablename = "verification_code_student";
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

    public function getsubmittedstudentbygradeid($gradeid)
    {
        $query = "SELECT * FROM student_assignment WHERE 
        student_assignment.grade_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$gradeid]);
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
    public function getsumittedstudentbystudentid($studentid)
    {
        $query = "SELECT * FROM student_assignment
        INNER JOIN teacher_assignment
        ON teacher_assignment.assignmentSrc = student_assignment.assignment_id
        INNER JOIN student
        ON student.student_id = student_assignment.student_id 
        INNER JOIN subject
        ON subject.subject_id = student_assignment.subject_id
        INNER JOIN result 
        ON result.result_id = student_assignment.student_results
        WHERE 
        student_assignment.student_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$studentid]);
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
    public function getstudentbygrade($gradeid)
    {
        $query = "SELECT * FROM student WHERE 
        student.grade_id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$gradeid]);
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

    public function approveresult($student_assignment_id)
    {
        $state = false;
        if (!$this->checkapproveresult($student_assignment_id)) {
            $query = "INSERT INTO approved_results (`student_assignment_id`)
            VALUES (?)";
            $stmt = $this->connect()->prepare($query);
            $stmtState = $stmt->execute([$student_assignment_id]);
            if ($stmtState) {
                $state = true;
            }
        } else {
            echo "Already approved this result";
        }
        return $state;
    }
    public function checkapproveresult($student_assignment_id)
    {
        $state = false;

        $CheckQuery = "SELECT * FROM approved_results WHERE approved_results.student_assignment_id=?";
        $CheckStmt = $this->connect()->prepare($CheckQuery);
        $CheckStmt->execute([$student_assignment_id]);
        $rowFounds = $CheckStmt->rowCount();
        if ($rowFounds == 1) {
            $state = true;
        } else {
            $state = false;
        }

        return $state;
    }
}
