<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if (isset($_POST["id"]) && isset($_POST["email"])) {
        require_once "../../inputValidations/ValidateInputs.php";
        echo "Yess";
        //assingn the email and student id to the variables called id and email
        //then do validations for those inputs
        $id = $_POST["id"];
        $email = $_POST["email"];
        $validation = new ValidateInputs();
        $valiStatus1 = $validation->intIDvalid($id);
        $valiStatus2 = $validation->mailVali($email);
        //if the validations met the requirements go inside the if block
        if ($valiStatus1 && $valiStatus2) {
            require_once "../../admin/adminPanel/StudentQuery.php";
            $queryObject = new StudentQuery();
            //check the student email and id if it does exits in the student table
            $queryObjectResults =  $queryObject->studentCheckEnM($email, $id);

            if ($queryObjectResults == false) {
                //generate a random code and hash it
                $random = rand();
                $code = hash('md5', $random);

                $random2 = rand();
                $verifyCode = hash('md5', $random2);
                //set student passsword and update it
                $queryObject->setstudentPassword($email, $id, $code);
                //add the verification code in the student verfication code table
                $studentDetails = $queryObject->getstudentDetails($email);
                $enterVerifyCode = $queryObject->addVerificationCode($id, $verifyCode);
                $userName = $studentDetails[0][1];
                $lastName = $studentDetails[0][2];

                require "../../SendMail/SendMail.php";
                $emailSender = new SendMail();
                //create the email object to send emails
                $emailSender->setSenderEmail($email);
                //set headers set bodies set the email set messages
                $emailSender->setBody("<h2 style='font-family: Impact, sans-serif;
                color: #CE5937;'>
                   Kind Reminder for payment due 
                  </h2>
                  <span>Hey $userName $lastName</span>
                  
                  <br>
                  <br>
                  <p>Just a friendly reminder that your payment is due on . The balance due is 50$.</p>
                  
                  <br>
                
                  <span>Please feel free to contact us if you have any questions or concerns.</span>
                  <br>
                  <span>Regards,</span> ");
                $emailSender->setHeader("Student Verification Code Is");
                //send the email using send email
                $emailStatus = $emailSender->sendEmail();
            } else {
                echo "process stopped";
            }
        }
    }
}
