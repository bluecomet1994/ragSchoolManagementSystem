<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
    if (isset($_POST["tid"]) && isset($_POST["lsnsrc"])) {
        
        require_once "../../inputValidations/ValidateInputs.php";
        //validation check the validation file
        $validation = new ValidateInputs();
        $teacherid = $_POST["tid"];
        $lessonsrc = $_POST["lsnsrc"];
       
        $abc =true;
         $pathstringvalidation =$validation->pathstringcheckforassignments($lessonsrc);
         //$idvalidation =$validation->intIDvalid($teacherid);
         if($abc){
            require_once "../../teacher/teacherQuery/teacherQuery.php";
            $query = new TeacherQuery();
            $removeLesson  = $query->removeLesson($teacherid,$lessonsrc);
            if($removeLesson){
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
