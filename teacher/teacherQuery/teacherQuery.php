<?php
require_once "../../PDODB/DBh.php";
class TeacherQuery extends DBh
{
    public function bro()
    {
        echo "echo";
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
    public function getstudentsbygrade($gradeid)
    {
        $query = "SELECT * FROM student WHERE grade_id =?";
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

    public function getsubmittedstudentbygrade($gradeid, $subjectid)
    {
        $query = "SELECT * FROM student
        INNER JOIN student_assignment
        ON student.student_id = student_assignment.student_id
        WHERE student_assignment.grade_id = ? AND subject_id =?";
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
    public function addresultsforstudent($results, $assignment_id, $subject_id, $student_id)
    {
        $state = false;
        $query = "UPDATE student_assignment 
        SET student_assignment.student_results =(SELECT result.result_id FROM result WHERE result.result_name =?)
        WHERE student_assignment.student_assignment_id =? AND student_assignment.subject_id =?
        AND student_assignment.student_id = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$results, $assignment_id, $subject_id, $student_id]);
        if ($statement) {
            return $state;
        }
    }
    public function getstudentsubmissionsbystudentidNteacherid($studentid, $subjectid, $assignment_id)
    {

        $query = "
        SELECT student_assignment.assignmentsrc,
student_assignment.uploaded_date,
student_assignment.student_id,
student_assignment.student_results,
student_assignment.grade_id,
student_assignment.subject_id,
student_assignment.assignment_id,
student_assignment.student_assignment_id,
student.student_fname,
student.grade_id,
student.student_email,
teacher_assignment.assignment_name,
teacher_assignment.assignment_due_date
        FROM student
        INNER JOIN student_assignment
        ON student.student_id = student_assignment.student_id
        INNER JOIN teacher_assignment
        ON teacher_assignment.assignmentSrc = student_assignment.assignment_id
        WHERE  student_assignment.subject_id =? AND student_assignment.student_id =?
        AND student_assignment.student_assignment_id =?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$subjectid, $studentid, $assignment_id]);
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
    public function getstudentsubmissionsbystudentid($studentid, $subjectid)
    {

        $query = "
        SELECT student_assignment.assignmentsrc,
student_assignment.uploaded_date,
student_assignment.student_id,
student_assignment.student_results,
student_assignment.grade_id,
student_assignment.subject_id,
student_assignment.assignment_id,
student_assignment.student_assignment_id,
student.student_fname,
student.grade_id,
student.student_email,
teacher_assignment.assignment_name,
teacher_assignment.assignment_due_date,
subject.subject_name,
result.result_name        
        FROM student
        INNER JOIN student_assignment
        ON student.student_id = student_assignment.student_id
        INNER JOIN teacher_assignment
        ON teacher_assignment.assignmentSrc = student_assignment.assignment_id
        INNER JOIN subject
        ON subject.subject_id = student_assignment.subject_id
        INNER JOIN result
        ON result.result_id = student_assignment.student_results
        WHERE  student_assignment.subject_id =? AND student_assignment.student_id =?
        ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$subjectid, $studentid]);
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

    public function insertTeacher($fname, $lname, $email, $age, $gender, $grade, $subject)
    {
        $emailCheck =  $this->checkTeacherEmailForEmail($email);
        if ($emailCheck) {
            $random = rand();
            $code = hash('md5', $random);
            $hashPassword = password_hash($code, PASSWORD_DEFAULT);
            $state = false;
            $status = 0;
            $query = "INSERT INTO `teacher` (`teacher_fname`,`teacher_lname`,`teacher_email`,`teacher_age`,`teacher_gender`,`grade_id`,`subject_id`,`teacher_password`,`teacher_status`)
            VALUES (?,?,?,?,?,?,?,?,?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $email, $age, $gender, $grade, $subject, $hashPassword, $status]);
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
    public function updatefnameNlname($email, $fname, $lname)
    {
        $state = false;
        if (!$this->checkteacherEmail($email)) {
            $query = "UPDATE teacher SET `teacher_fname`=?,`teacher_lname`=? 
                     WHERE `teacher_email`=?";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $email]);
            if ($insertStatement) {
                $state = true;
            }
        }
        return $state;
    }

    public function updateteacherpropic($id, $src)
    {
        if ($this->checkpropic($id)) {
            $propicrow = $this->getpropic($id);
            $earilersrc = $propicrow[0]['teacher_pro_pic_src'];
            unlink($earilersrc);


            $query = "UPDATE teacher_pro_pic SET `teacher_pro_pic_src`=? 
            WHERE `teacher_id`=?";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$src, $id]);
            if ($insertStatement) {
                $state = true;
            }
        } else {
            $query = "INSERT INTO teacher_pro_pic  (`teacher_pro_pic_src`,`teacher_id`)
            VALUES(?,?)";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$src, $id]);
            if ($insertStatement) {
                $state = true;
            }
        }
    }
    public function updateTeacher($fname, $lname, $email, $age, $gender, $grade, $subject)
    {
        $state = false;
        $emailCheck =  $this->checkTeacherEmail($email);
        if (!$emailCheck) {

            $state = false;

            $query = "UPDATE `teacher` SET `teacher_fname`=?,`teacher_lname`=?,`teacher_age`=?,`teacher_gender`=?,`grade_id`=?,`subject_id`=? WHERE `teacher_email`=? ";
            $statement = $this->connect()->prepare($query);
            $insertStatement = $statement->execute([$fname, $lname, $age, $gender, $grade, $subject, $email]);
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
    public function teacherCheckEnM($email, $id)
    {
        $state = false;
        $teacherCheckQuery = "SELECT * FROM `teacher` WHERE `teacher_email`=? AND `teacher_Id`=?";
        $teacherCheckStmt = $this->connect()->prepare($teacherCheckQuery);
        $teacherCheckStmt->execute([$email, $id]);
        if ($teacherCheckStmt->rowCount() == 1) {

            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function teacherCheckEnP($email, $password)
    {
        $state = false;
        $teacherCheckQuery = "SELECT * FROM `teacher` WHERE `teacher_email`=? ";
        $teacherCheckStmt = $this->connect()->prepare($teacherCheckQuery);
        $teacherCheckStmt->execute([$email]);
        if ($teacherCheckStmt->rowCount() == 1) {
            $teacherRow = $teacherCheckStmt->fetchAll(PDO::FETCH_ASSOC);
            $hashedPassword = $teacherRow[0]["teacher_password"];
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
    public function setTeacherPassword($email, $id, $p)
    {
        $hashPassword = password_hash($p, PASSWORD_DEFAULT);
        $teacherCheck = $this->teacherCheckEnM($email, $id);
        if (!$teacherCheck) {
        }
    }
    public function getTeacherDetails($email)
    {
        $state = false;
        $teacherCheckQuery = "SELECT * FROM `teacher` WHERE `teacher_email`=?";
        $teacherCheckStmt = $this->connect()->prepare($teacherCheckQuery);
        $teacherCheckStmt->execute([$email]);
        $rowFounds = $teacherCheckStmt->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $teacherCheckStmt->fetchAll();
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
            $tablename = "verification_code_teacher";
            $query = "UPDATE `" . $tablename . "` SET `verify_code`=? WHERE `id`=?";
            $queryStatement = $this->connect()->prepare($query);
            $queryStatement->execute([$code, $id]);
        } else {
            $tablename = "verification_code_teacher";
            $query = "INSERT INTO `" . $tablename . "` (`verify_code`,`id`) VALUES(?,?)";
            $queryStatement = $this->connect()->prepare($query);
            $queryStatement->execute([$code, $id]);
        }
    }
    public function checkVerificationCode($id)
    {
        $state = false;
        $tablename = "verification_code_teacher";
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
        $CheckQuery = "SELECT * FROM verification_code_teacher
        INNER JOIN teacher
        ON teacher.teacher_id = verification_code_teacher.id
        WHERE teacher.teacher_email = ?
        AND verification_code_teacher.verify_code =?";
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
        $CheckQuery = "SELECT * FROM verification_code_teacher
        INNER JOIN teacher
        ON teacher.teacher_id = verification_code_teacher.id
        WHERE teacher.teacher_email = ? ";
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
        $query = "DELETE FROM `verification_code_teacher` WHERE `verify_code`=?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$code]);
    }



    public function addlessonnotes($path, $lessonname, $gradeid, $subjectid, $teacherid)
    {
        $state = false;
        $query = "INSERT INTO `teacher_lesson_notes` 
                   (`lessonSrc`,`lesson_name`,`grade_id`,`subject_id`,`teacher_id`) VALUES (?,?,?,?,?)  ";
        $insertStatement = $this->connect()->prepare($query);
        $insertStatementResults = $insertStatement->execute([$path, $lessonname, $gradeid, $subjectid, $teacherid]);
        if ($insertStatementResults) {
            $state  = true;
        }
        return  $state;
    }
    public function checklessonNotes($teacherid, $src)
    {
        $state = false;
        $lessonCheckQuery = "SELECT * FROM `teacher_lesson_notes`  WHERE `teacher_id`=?
                          AND `lessonSrc`=?";
        $lessonCheckStmt = $this->connect()->prepare($lessonCheckQuery);
        $lessonCheckStmt->execute([$teacherid, $src]);
        if ($lessonCheckStmt->rowCount() == 1) {
            $state = true;
        }

        return $state;
    }
    public function getlessonnotes($lessonid)
    {
        $lessonCheckQuery = "SELECT * FROM `teacher_lesson_notes` 
        INNER JOIN
        grade
        ON grade.grade_id = teacher_lesson_notes.grade_id
        INNER JOIN
        subject
        ON subject.subject_id = teacher_lesson_notes.subject_id WHERE `teacher_id`=?";
        $lessonCheckStmt = $this->connect()->prepare($lessonCheckQuery);
        $lessonCheckStmt->execute([$lessonid]);
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

    public function removeLesson($teacherid, $lessonsrc)

    {
        $state = false;
        $checkLessonRow = $this->checklessonNotes($teacherid, $lessonsrc);
        if ($checkLessonRow) {
            $query = "DELETE FROM `teacher_lesson_notes` WHERE  `teacher_id`=? AND `lessonSrc`=?";
            $removeStatement = $this->connect()->prepare($query);
            $removeStatementResults = $removeStatement->execute([$teacherid, $lessonsrc]);
            if ($removeStatementResults) {
                unlink($lessonsrc);
                $state = true;
            }
        }


        return $state;
    }




    public function addassignment($path, $assignmentname, $gradeid, $subjectid, $teacherid, $assignmentduedate)
    {
        $random = rand();
        $code = hash('md5', $random);
        $state = false;
        $query = "INSERT INTO `teacher_assignment` 
                   (`assignmentSrc`,`assignment_name`,`grade_id`,`subject_id`,`teacher_id`,`assignment_due_date`,`assignment_unique_code`) VALUES (?,?,?,?,?,?,?)  ";
        $insertStatement = $this->connect()->prepare($query);
        $insertStatementResults = $insertStatement->execute([$path, $assignmentname, $gradeid, $subjectid, $teacherid, $assignmentduedate, $code]);
        if ($insertStatementResults) {
            $state  = true;
        }
        return  $state;
    }
    public function checkassignment($teacherid, $src)
    {
        $state = false;
        $assignmentCheckQuery = "SELECT * FROM `teacher_assignment`  WHERE `teacher_id`=?
                          AND `assignmentSrc`=?";
        $assignmentCheckStmt = $this->connect()->prepare($assignmentCheckQuery);
        $assignmentCheckStmt->execute([$teacherid, $src]);
        if ($assignmentCheckStmt->rowCount() == 1) {
            $state = true;
        }

        return $state;
    }
    public function getassignment($assignmentid)
    {
        $assignmentCheckQuery = "SELECT * FROM `teacher_assignment` 
        INNER JOIN
        grade
        ON grade.grade_id = teacher_assignment.grade_id
        INNER JOIN
        subject
        ON subject.subject_id = teacher_assignment.subject_id WHERE `teacher_id`=?";
        $assignmentCheckStmt = $this->connect()->prepare($assignmentCheckQuery);
        $assignmentCheckStmt->execute([$assignmentid]);
        $rowFounds = $assignmentCheckStmt->rowCount();
        if ($rowFounds >= 1) {
            $fetchRows = $assignmentCheckStmt->fetchAll();
            $this->rowCount = $rowFounds;
        } else {
            $fetchRows = array("Nothing");
            $this->rowCount = 0;
        }

        return $fetchRows;
    }

    public function removeassignment($teacherid, $assignmentsrc)

    {
        $state = false;
        $checkassignmentRow = $this->checkassignment($teacherid, $assignmentsrc);
        if ($checkassignmentRow) {
            $query = "DELETE FROM `teacher_assignment` WHERE  `teacher_id`=? AND `assignmentSrc`=?";
            $removeStatement = $this->connect()->prepare($query);
            $removeStatementResults = $removeStatement->execute([$teacherid, $assignmentsrc]);
            if ($removeStatementResults) {
                unlink($assignmentsrc);
                $state = true;
            }
        }


        return $state;
    }

    public function getteachersubject($email)
    {
        $query = "SELECT subject.subject_id,subject.subject_name FROM `teacher`
        INNER JOIN
        subject
        ON subject.subject_id = teacher.subject_id
        WHERE `teacher_email`= ? ";
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
    public function checkpropic($id)
    {
        $state = false;
        $CheckQuery = "SELECT * FROM teacher_pro_pic
        WHERE teacher_pro_pic.teacher_id = ? ";
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
            $query = "SELECT * FROM teacher_pro_pic
            WHERE teacher_pro_pic.teacher_id = ?";
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
            $earilersrc = $propicrow[0]['teacher_pro_pic_src'];
            unlink($earilersrc);
            $query = "DELETE FROM teacher_pro_pic
            WHERE teacher_pro_pic.teacher_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmtCheck = $stmt->execute([$id]);
            if ($stmtCheck) {
                $state = true;
            }
        }

        return $state;
    }
}
