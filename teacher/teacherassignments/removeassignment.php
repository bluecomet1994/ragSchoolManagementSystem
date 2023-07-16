<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
    if (isset($_POST["tid"]) && isset($_POST["lsnsrc"])) {
        require_once "../../inputValidations/ValidateInputs.php";
        //validation check the validation file
        $validation = new ValidateInputs();
        $teacherid = $_POST["tid"];
        $assignmentsrc = $_POST["lsnsrc"];
   
         $pathstringvalidation =$validation->pathstringcheckforassignments($assignmentsrc);
     
         $idvalidation =$validation->intIDvalid($teacherid);
         if($idvalidation && $pathstringvalidation){
            //if it reached the validations' requirments then run the remove query for the teacher assignemnt table 
            require_once "../../teacher/teacherQuery/teacherQuery.php";
            $query = new TeacherQuery();
            $removeassignment  = $query->removeassignment($teacherid,$assignmentsrc);
            if($removeassignment){
                echo "Success";
            }
         }else{
             echo "input values aren't valid";
         }

    }else{
        echo "Coudln't receive data properly";
    }
} else {
    echo "Coudln't receive data properly";
}
