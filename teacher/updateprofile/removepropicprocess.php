<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
    require_once "../../teacher/teacherQuery/teacherQuery.php";
    $teachermail = $_SESSION["teacher_logged_in_session"];
    $query = new TeacherQuery();
    $getteacherdetails = $query->getteacherDetails($teachermail);
    
    $teacherid = $getteacherdetails[0][0];
    $today = date("Y-m-d");
    $removeprocess = $query->removepropic($teacherid);
    if($removeprocess){
        echo "Success";
    }
}