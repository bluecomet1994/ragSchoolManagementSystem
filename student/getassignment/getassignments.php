<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    die();
} else {

    require_once "../../student/studentQuery/studentQuery.php";
    $studentmail = $_SESSION["student_logged_in_session"];
    $query = new StudentQuery();
    $getstudentdetails = $query->getstudentDetails($studentmail);
    $studentgradeid = $getstudentdetails[0]['grade_id'];
    $studentid = $getstudentdetails[0][0];
    $getstudentassignments = $query->getstudentassignmentdetailsbyid($studentid);
    if($getstudentassignments[0] !=="Nothing"){
        echo "Yess there is data";
    }
}
?>