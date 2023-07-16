<?php
require_once "../PDODB/DBh.php";
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

    public function getstudentassignment($gradeid)
    {
        $query = "SELECT * FROM teacher_assignment
        WHERE teacher_assignment.grade_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$gradeid]);
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
    public function getstudentassignmentwithsubjectid($gradeid, $subjectid)
    {
        $query = "SELECT * FROM teacher_assignment
        WHERE teacher_assignment.grade_id = ? AND teacher_assignment.subject_id=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$gradeid, $subjectid]);
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
    public function getstudentgrade($email)
    {

        $query = "SELECT grade.grade_id,grade.grade_name FROM `student`
        INNER JOIN
        grade
        ON grade.grade_id = student.grade_id
         WHERE `student_email`=?  ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email]);
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

    public function insertassignment($today, $subjectID, $studentgradeid, $assignmentcode, $studentid, $folderpath)
    {
        $state = false;
        $random = rand();
        $studentresults = 1;
        $randomcode = hash('md5', $random);
        $getassignmentdetailsbycode =  $this->getassignmentdetailsbycode($assignmentcode);
        $getassignment_full_detailsbycode =  $this->getassignmentfulldetailsbycode($assignmentcode);


        if ($getassignmentdetailsbycode[0] !== "Nothing") {
            $getassignmentid = $getassignmentdetailsbycode;
            $assignmentid = $getassignmentid[0][0];
            $searchstudentassignment = $this->getstudentassignmentdetails($assignmentid, $studentid, $subjectID, $studentgradeid);
            if (!$searchstudentassignment) {
                $insertquery = "INSERT INTO `student_assignment`(`uploaded_date`,`subject_id`,`grade_id`,`assignment_id`,`uniquely_generated_code`,`student_results`,`student_id`,`assignmentsrc`)
                VALUES (?,?,?,?,?,?,?,?)";
                $insertStatement = $this->connect()->prepare($insertquery);
                $insertStatementresult = $insertStatement->execute([$today, $subjectID, $studentgradeid, $assignmentid, $randomcode, $studentresults, $studentid, $folderpath]);
                if ($insertStatementresult) {
                    echo "Success";
                    $state = true;
                }
            } else {
                $this->unsetthefolderpath($folderpath);
                echo "already entered so sorry";
            }
        }
        return $state;
    }
    public function unsetthefolderpath($folderpath)
    {
        unlink($folderpath);
    }
    public function getstudentassignmentdetails($assignmentid, $studentid, $subjectid, $gradeid)
    {
        $state = false;

        $searchquery = "SELECT * FROM `student_assignment` WHERE `assignment_id`=? AND
                       `subject_id`=? AND `grade_id`=? AND `student_id`=?";
        $searchquerystatement = $this->connect()->prepare($searchquery);
        $searchquerystatement->execute([$assignmentid, $subjectid, $gradeid, $studentid]);
        $rowcount = $searchquerystatement->rowCount();
        if ($rowcount == 1) {

            $state = true;
        }
        return $state;
    }
    public function getstudentassignmentdetailsbyid($id)
    {
        $query = "SELECT * FROM student_assignment
        WHERE student_assignment.student_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$id]);
        $rowFounds = $statement->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $statement->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array(0 => "Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }
    public function getassignmentfulldetailsbycode($code)
    {
        $query = "SELECT * FROM teacher_assignment
        WHERE teacher_assignment.assignment_unique_code = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$code]);
        $rowFounds = $statement->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $statement->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array(0 => "Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }
    public function getassignmentdetailsbycode($code)
    {
        $query = "SELECT * FROM teacher_assignment
        WHERE teacher_assignment.assignment_unique_code = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$code]);
        $rowFounds = $statement->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $statement->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array(0 => "Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
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

    public function getlessonnotes($gradeid)
    {
        $lessonCheckQuery = "SELECT * FROM teacher_lesson_notes
        INNER JOIN subject ON 
        subject.subject_id = teacher_lesson_notes.subject_id
        WHERE teacher_lesson_notes.grade_id =?";
        $lessonCheckStmt = $this->connect()->prepare($lessonCheckQuery);
        $lessonCheckStmt->execute([$gradeid]);
        $rowFounds = $lessonCheckStmt->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $lessonCheckStmt->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }
    public function getassignments($gradeid, $studentid)
    {
        $query = "SELECT * FROM  student_assignment
        INNER JOIN 
        teacher_assignment
        ON 
        teacher_assignment.assignmentSrc = student_assignment.assignment_id
        WHERE student_assignment.grade_id =  ? AND student_assignment.student_id =?";
        $assignmentstmt =  $this->connect()->prepare($query);
        $assignmentstmt->execute([$gradeid, $studentid]);
        $rowCount = $assignmentstmt->rowCount();
        if ($rowCount >= 1) {
            $fetchRows = $assignmentstmt->fetchAll();
            $this->rowCount = $rowCount;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }
        return $fetchRows;
    }
    public function getteacherassignments($gradeid)
    {
        $query = "SELECT * FROM  teacher_assignment
        INNER JOIN subject
        ON subject.subject_id = teacher_assignment.subject_id
        WHERE teacher_assignment.grade_id =  ?";
        $assignmentstmt =  $this->connect()->prepare($query);
        $assignmentstmt->execute([$gradeid]);
        $rowCount = $assignmentstmt->rowCount();
        if ($rowCount >= 1) {
            $fetchRows = $assignmentstmt->fetchAll();
            $this->rowCount = $rowCount;
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
    public function studentCheckEnP($email, $password)
    {
        $state = false;
        $studentCheckQuery = "SELECT * FROM `student` WHERE `student_email`=? ";
        $studentCheckStmt = $this->connect()->prepare($studentCheckQuery);
        $studentCheckStmt->execute([$email]);
        if ($studentCheckStmt->rowCount() == 1) {
            $studentRow = $studentCheckStmt->fetchAll(PDO::FETCH_ASSOC);
            $hashedPassword = $studentRow[0]["student_password"];

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
    public function updatefnameNlname($email, $fname, $lname)
    {
        $state = false;
        if (!$this->checkstudentEmail($email)) {
            $query = "UPDATE student SET `student_fname`=?,`student_lname`=? 
                     WHERE `student_email`=?";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $email]);
            if ($insertStatement) {
                $state = true;
            }
        }
        return $state;
    }

    public function updatestudentpropic($id, $src)
    {
        if ($this->checkpropic($id)) {
            $propicrow = $this->getpropic($id);
            $earilersrc = $propicrow[0]['student_pro_pic_src'];
            unlink($earilersrc);


            $query = "UPDATE student_pro_pic SET `student_pro_pic_src`=? 
            WHERE `student_id`=?";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$src, $id]);
            if ($insertStatement) {
                $state = true;
            }
        } else {
            $query = "INSERT INTO student_pro_pic  (`student_pro_pic_src`,`student_id`)
            VALUES(?,?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$src, $id]);
            if ($insertStatement) {
                $state = true;
            }
        }
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
    public function updatestudentstatus($email)
    {
        $state = false;
        $emailCheck =  $this->checkstudentEmail($email);
        if (!$emailCheck) {

            $state = false;

            $query = "UPDATE `student` SET `student_status`='1' WHERE `student_email`=? ";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$email]);
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
    public function updateStudentDueDate($email, $today)
    {

        $state = false;
        $emailCheck =  $this->checkstudentEmail($email);
        if (!$emailCheck) {

            $state = false;

            $query = "UPDATE `student` SET `student_due_date`=? WHERE `student_email`=? ";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$today, $email]);
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
    public function getstudentDetailsbyid($id)
    {
        $state = false;
        $studentCheckQuery = "SELECT * FROM `student` WHERE `student_id`=?";
        $studentCheckStmt = $this->connect()->prepare($studentCheckQuery);
        $studentCheckStmt->execute([$id]);
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


    public function checkVerificationCodebyemailNcode($email, $code)
    {
        $state = false;
        $CheckQuery = "SELECT * FROM verification_code_student
        INNER JOIN student
        ON student.student_id = verification_code_student.id
        WHERE student.student_email = ?
        AND verification_code_student.verify_code =?";
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
        $CheckQuery = "SELECT * FROM verification_code_student
        INNER JOIN student
        ON student.student_id = verification_code_student.id
        WHERE student.student_email = ? ";
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
        $query = "DELETE FROM `verification_code_student` WHERE `verify_code`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$code]);
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
        $query = "SELECT * FROM approved_results
        INNER JOIN student_assignment
        ON student_assignment.student_assignment_id = approved_results.student_assignment_id
        INNER JOIN teacher_assignment
        ON teacher_assignment.assignmentSrc = student_assignment.assignment_id
        INNER JOIN subject
        ON subject.subject_id = student_assignment.subject_id
        INNER JOIN result
        ON result.result_id = student_assignment.student_results
        WHERE student_assignment.student_id = ?";
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

    public function checkpropic($id)
    {
        $state = false;
        $CheckQuery = "SELECT * FROM student_pro_pic
        WHERE student_pro_pic.student_id = ? ";
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
            $query = "SELECT * FROM student_pro_pic
            WHERE student_pro_pic.student_id = ?";
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
            $earilersrc = $propicrow[0]['student_pro_pic_src'];
            unlink($earilersrc);
            $query = "DELETE FROM student_pro_pic
            WHERE student_pro_pic.student_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmtCheck = $stmt->execute([$id]);
            if ($stmtCheck) {
                $state = true;
            }
        }

        return $state;
    }
}
