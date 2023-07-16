<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    exit();
} else {
    if (isset($_POST["id"]) && isset($_POST["email"])) {
        require_once "../../inputValidations/ValidateInputs.php";
        //validate input fields
        $id = $_POST["id"];
        $email = $_POST["email"];
        $validation = new ValidateInputs();
        $valiStatus1 = $validation->intIDvalid($id);
        $valiStatus2 = $validation->mailVali($email);
        if ($valiStatus1 && $valiStatus2) {
            //if validation is success check the student table with the received 
            //input fields
            require_once "../../academic/studentQuery/StudentQuery.php";
            $queryObject = new StudentQuery();
            $queryObjectResults =  $queryObject->studentCheckEnM($email, $id);

            if ($queryObjectResults == false) {
                //create a random code to this would be set as a new password
                $random = rand();
                $code = hash('md5', $random);
                //generatae a random code, this would be sent by the email as a verifcation code
                $random2 = rand();
                $verifyCode = hash('md5', $random2);
                //update the password
                $queryObject->setstudentPassword($email, $id, $code);
                $studentDetails = $queryObject->getstudentDetails($email);
                //add verification code in the student verificatio table
                $enterVerifyCode = $queryObject->addVerificationCode($id, $verifyCode);
                $userName = $studentDetails[0][1];
                $lastName = $studentDetails[0][2];

                require "../../SendMail/SendMail.php";
                //create email sending object
                $emailSender = new SendMail();
                $emailSender->setSenderEmail($email);

                $emailSender->setBody("<h2 style='font-family: Impact, sans-serif;
                color: #CE5937;'>
                  Your student User_name and Verification Code 
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
                $emailSender->setHeader("Student Verification Code Is");
            
                $emailStatus = $emailSender->sendEmail();
            } else {
                echo "process stopped";
            }
        }
    }
}
