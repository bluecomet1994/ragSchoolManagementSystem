<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if (isset($_POST["id"]) && isset($_POST["email"])) {
        require_once "../../inputValidations/ValidateInputs.php";
        //assingn the email and academic id to the variables called id and email
        //then do validations for those inputs
        $id = $_POST["id"];
        $email = $_POST["email"];
        $validation = new ValidateInputs();
        $valiStatus1 = $validation->intIDvalid($id);
        $valiStatus2 = $validation->mailVali($email);
        //if the validations met the requirements go inside the if block
        if ($valiStatus1 && $valiStatus2) {
            require_once "../../admin/adminPanel/AcademicQuery.php";
            $queryObject = new AcademicQuery();
            //check the academic email and id if it does exits in the academic table
            $queryObjectResults =  $queryObject->academicCheckEnM($email, $id);

            if ($queryObjectResults == false) {
                //generate a random code and hash it
                $random = rand();
                $code = hash('md5', $random);

                $random2 = rand();
                $verifyCode = hash('md5', $random2);
                //set academic passsword and update it
                $queryObject->setacademicPassword($email, $id, $code);
                //add the verification code in the academic verfication code table
                $academicDetails = $queryObject->getacademicDetails($email);
                $enterVerifyCode = $queryObject->addVerificationCode($id, $verifyCode);
                $userName = $academicDetails[0][1];

                require "../../SendMail/SendMail.php";
                //create the email object to send emails
                $emailSender = new SendMail();
                $emailSender->setSenderEmail($email);
                //set headers set bodies set the email set messages
                $emailSender->setBody("<h2 style='font-family: Impact, sans-serif;
                color: #CE5937;'>
                  Academic User_name and Verification Code 
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
                $emailSender->setHeader("Academic Verification Code Is");
                //send the email using send email
                $emailStatus = $emailSender->sendEmail();
            } else {
                echo "process stopped";
            }
        }
    }
}
