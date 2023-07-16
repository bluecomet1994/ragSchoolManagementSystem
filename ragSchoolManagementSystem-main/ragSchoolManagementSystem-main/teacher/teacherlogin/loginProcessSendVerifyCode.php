<?php
if(isset($_POST["email"])){
    $e = $_POST["email"];
    $random = rand();
    $code = hash('md5', $random);

    require "../../SendMail/SendMail.php";
    $emailSender = new SendMail();
    $emailSender->setSenderEmail($e);
    $emailSender->setBody($code);
    $emailSender->setHeader("Teacher Verification Code Is");
    $emailStatus =$emailSender->sendEmail();
    if($emailStatus){
    require_once "../../teacher/teacherQuery.php";
     $query = new TeacherQuery();
     $queryStatus = $query->updateteacherVerifyCode($e,$code);

     if($queryStatus==1){
        
        if(!isset($_SESSION)){
            session_start();             
        }
        $_SESSION["teacherverifyCodeEmail"]=$e;
        exit(); 
     }
     
    }
}


?>