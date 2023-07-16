<?php
session_start();
if (isset($_POST["email"])  && isset($_POST["password"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  require_once "../../inputValidations/ValidateInputs.php";
  //validate the received inputs email and password
  $validation = new ValidateInputs();
  $emailVali = $validation->mailVali($email);
  $passwordValid = $validation->passwordVali($password);
  if (!$emailVali) {
    exit("Not a Valid Email");
  }
  require_once "../../teacher/teacherQuery/teacherQuery.php";
  $query = new TeacherQuery();

  //check if the teacher password and email matched in the teacher table row
  $teacherCheck = $query->teacherCheckEnP($email, $password);
  if ($teacherCheck == true) {
    $teacherDetails = $query->getTeacherDetails($email);
    $teacherID = $teacherDetails[0][0];
    $teacherUserName = $teacherDetails[0][1];
    //create the session
    $_SESSION["teacher_session_mail"] = $email;
    //check the verfication code by the provided email and check wheater a row is 
    //exits or not
    $checkVerifyCodeTeacher = $query->checkVerificationCodebyemail($email);
    if (!$checkVerifyCodeTeacher) {
      //if its not generate this random code and hash it
      $random = rand();
      $code = hash('md5', $random);


      //then send the details (the code and password )via email to the given email
      require "../../SendMail/SendMail.php";
      $emailSender = new SendMail();
      $emailSender->setSenderEmail($email);

      $emailSender->setBody("<h2 style='font-family: Impact, sans-serif;
      color: #CE5937;'>
        Teacher User_name and Verification Code 
        </h2>
        <span>Verification Code</span>
        <input style='width:50%;outline:none;border:none;' value='$code' readonly>
        <br>
        <br>
        <span>Username</span>
        <input style='width:50%;outline:none;border:none;' value='$teacherUserName' readonly> ");
      $emailSender->setHeader("Teacher Verification Code Is");
      $emailStatus = $emailSender->sendEmail();
      //update the verification code in the teacher verification code table
      $query->addVerificationCode($teacherID, $code);
    } else {
    }
  }
} else {
}
