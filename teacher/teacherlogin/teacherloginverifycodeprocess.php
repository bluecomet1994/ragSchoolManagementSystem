<?php
session_start();

if (isset($_POST["verifycode"]) && isset($_SESSION["teacher_session_mail"])) {

    $verifycode = $_POST["verifycode"];
    $email = $_SESSION["teacher_session_mail"];
    require_once "../../teacher/teacherQuery/teacherQuery.php";
    $query = new TeacherQuery();
    //if the verification code is found and matched then remove the verifcation code
    //so only the verification code can be used one time 
    $teacherCheck = $query->checkVerificationCodebyemailNcode($email, $verifycode);
    if ($teacherCheck == true) {
        $teacherCheck = $query->removeverificationcoderow($verifycode);
        echo "Success";
    } else {
        echo "Wrong Code";
    }
} else {
    echo "Something Wrong please try again";
}
