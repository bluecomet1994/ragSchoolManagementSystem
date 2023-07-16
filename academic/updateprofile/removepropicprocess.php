<?php
session_start();
if (isset($_SESSION["academic_logged_in_session"])) {
    require_once "../../academic/academicQuery/academicQuery.php";
    $academicmail = $_SESSION["academic_logged_in_session"];
    $query = new AcademicQuery();
    //to remove the pro pic must check the academic details
    $getacademicdetails = $query->getacademicDetails($academicmail);
    
    $academicid = $getacademicdetails[0][0];
    $today = date("Y-m-d");
    //search by id in the academic pro pic table if its there
    //then remove the row as well as unset the file path
    $removeprocess = $query->removepropic($academicid);
    if($removeprocess){
        echo "Success";
    }
}