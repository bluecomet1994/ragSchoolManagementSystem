<?php
if(isset($_POST["email"])){
    $e = $_POST["email"];
    $random = rand();
    $code = hash('md5', $random);
  //to send the verify code in the email create the email object
    require "../../SendMail/SendMail.php";
    $emailSender = new SendMail();
    $emailSender->setSenderEmail($e);
    $emailSender->setBody($code);
    $emailSender->setHeader("Admin Verification Code Is");
    $emailStatus =$emailSender->sendEmail();
    if($emailStatus){
        require_once "../../admin/adminPanel/AdminQuery.php";
     $query = new AdminQuery();
     $queryStatus = $query->updateAdminVerifyCode($e,$code);

     if($queryStatus==1){
        
        if(!isset($_SESSION)){
            session_start();             
        }
        $_SESSION["verifyCodeEmail"]=$e;
        exit(); 
     }
     
    }
}
