<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if(isset($_POST["id"]) && isset($_POST["email"])){
        require_once "../../inputValidations/ValidateInputs.php";
        //assingn the email and teacher id to the variables called id and email
        //then do validations for those inputs
        $id = $_POST["id"];
        $email =$_POST["email"];
        $validation = new ValidateInputs();
        $valiStatus1 = $validation->intIDvalid($id);
        $valiStatus2 = $validation->mailVali($email);
        //if the validations met the requirements go inside the if block
        if($valiStatus1 && $valiStatus2){
            require_once "../../admin/adminPanel/AdminQuery.php";
            $queryObject = new AdminQuery();
            //check the teacher email and id if it does exits in the teacher table
            $queryObjectResults=  $queryObject->teacherCheckEnM($email,$id);
            
            if($queryObjectResults==false){
                //generate a random code and hash it
                $random = rand();
                $code = hash('md5', $random);

                $random2 = rand();
                $verifyCode = hash('md5', $random2);
                //set teacher passsword and update it 
                $queryObject->setTeacherPassword($email,$id,$code);
                //get the teacher details
                $teacherDetails =$queryObject->getTeacherDetails($email);
                //add the verification code in the teacher verfication code table
                $enterVerifyCode = $queryObject->addVerificationCode($id,$verifyCode);
                $userName = $teacherDetails[0][1];
                    
                require "../../SendMail/SendMail.php";
                $emailSender = new SendMail();
                //create the email object to send emails
                $emailSender->setSenderEmail($email);
                //set headers set bodies set the email set messages
            
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
                $emailSender->setHeader("Teacher Verification Code Is");
                //send the email using send email
                $emailStatus =$emailSender->sendEmail();
            }else{
                echo "process stopped";
            }
        }
    }
}