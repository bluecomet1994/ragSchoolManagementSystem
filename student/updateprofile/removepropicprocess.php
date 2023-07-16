<?php
session_start();
if (isset($_SESSION["student_logged_in_session"])) {
    require_once "../../student/studentQuery/studentQuery.php";
    $studentmail = $_SESSION["student_logged_in_session"];
    $query = new StudentQuery();
    $getstudentdetails = $query->getstudentDetails($studentmail);
    $studentgradeid = $getstudentdetails[0]['grade_id'];
    $studentid = $getstudentdetails[0][0];
    $today = date("Y-m-d");
    $removeprocess = $query->removepropic($studentid);
    if($removeprocess){
        echo "Success";
    }
}