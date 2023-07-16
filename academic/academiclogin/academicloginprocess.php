<?php
session_start();
if (isset($_POST["email"])  && isset($_POST["password"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];


  require_once "../../inputValidations/ValidateInputs.php";
  //validate input fields
  $validation = new ValidateInputs();
  $emailVali = $validation->mailVali($email);
  if (!$emailVali) {
    exit("Not a Valid Email");
  }

  //get academicquery
  require_once "../../academic/academicQuery/academicQuery.php";
  $query = new AcademicQuery();
  //get academic details
  $academicDetails = $query->getacademicDetails($email);
  $academicID = $academicDetails[0][0];
  $academicUserName = $academicDetails[0][1];
   //check academic details
  $academicCheck = $query->academicCheckEnP($email, $password);
  if ($academicCheck == true) {
    $_SESSION["academic_session_mail"] = $email;
    $checkVerifyCodeacademic = $query->checkVerificationCodebyemail($email);
    //check verification code by email
    if (!$checkVerifyCodeacademic) {
      //create random code
      $random = rand();
      $code = hash('md5', $random);

      require "../../SendMail/SendMail.php";
      //create a email sending obect
      $emailSender = new SendMail();
      $emailSender->setSenderEmail($email);

      $emailSender->setBody("<h2 style='font-family: Impact, sans-serif;
      color: #CE5937;'>
        Your Academic User_name and Verification Code 
        </h2>
        <span>Verification Code</span>
        <input style='width:50%;outline:none;border:none;' value='$code' readonly>
        <br>
        <br>
        <span>Username</span>
        <input style='width:50%;outline:none;border:none;' value='$academicUserName' readonly> ");
      $emailSender->setHeader("Academic Verification");
      $emailStatus = $emailSender->sendEmail();
     //add verfication code to the academic table in the database
      $query->addVerificationCode($academicID, $code);
    } else {
    }
  }
} else {
}
