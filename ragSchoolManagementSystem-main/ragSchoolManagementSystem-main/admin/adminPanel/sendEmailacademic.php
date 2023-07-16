<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if(isset($_POST["id"]) && isset($_POST["email"])){
        require_once "../../inputValidations/ValidateInputs.php";
        $id = $_POST["id"];
        $email =$_POST["email"];
        $validation = new ValidateInputs();
        $valiStatus1 = $validation->intIDvalid($id);
        $valiStatus2 = $validation->mailVali($email);
        if($valiStatus1 && $valiStatus2){
            require_once "../../admin/adminPanel/AcademicQuery.php";
            $queryObject = new AcademicQuery();
            $queryObjectResults=  $queryObject->academicCheckEnM($email,$id);
            
            if($queryObjectResults==false){
                $random = rand();
                $code = hash('md5', $random);

                $random2 = rand();
                $verifyCode = hash('md5', $random2);

                $queryObject->setacademicPassword($email,$id,$code);
                $academicDetails =$queryObject->getacademicDetails($email);
                $enterVerifyCode = $queryObject->addVerificationCode($id,$verifyCode);
                $userName = $academicDetails[0][1];
                    
                require "../../SendMail/SendMail.php";
                $emailSender = new SendMail();
                $emailSender->setSenderEmail($email);
            
                $emailSender->setBody("<h2 style='font-family: Impact, sans-serif;
                color: #CE5937;'>
                  Your User_name and Verification Code 
                  </h2>
                  <span>Verification Code</span>
                  <input style='width:50%;outline:none;border:none;' value='$verifyCode' readonly>
                  <br>
                  <br>
                  <span>Password</span>
                  <input style='width:50%;outline:none;border:none;' value='$code' readonly>
                  <br>
                  <br>
                  <span>Username</span>
                  <input style='width:50%;outline:none;border:none;' value='$userName' readonly> ");
                $emailSender->setHeader("Admin Verification Code Is");
                $emailStatus =$emailSender->sendEmail();
            }else{
                echo "process stopped";
            }
        }
    }
}