<?php
session_start();
if (isset($_POST["email"])  && isset($_POST["password"])) {
  //get the student email and password from the client side
  $email = $_POST["email"];
  $password = $_POST["password"];
  require_once "../../inputValidations/ValidateInputs.php";
  // do validations
  $validation = new ValidateInputs();
  $emailVali = $validation->mailVali($email);
  $passwordValid = $validation->emptyCheck($password);
  if (!$emailVali) {
    exit("Not a Valid Email");
  }
  if (!$passwordValid) {
    exit("password is not valid");
  }


  require_once "../../student/studentQuery/studentQuery.php";
  $query = new StudentQuery();


  //check the student anyways if it exists
  $studentCheck = $query->studentCheckEnP($email, $password);

  if ($studentCheck == true) {
    //get the students further more details using the search query
    $studentDetails = $query->getstudentDetails($email);
    $studentID = $studentDetails[0][0];
    $studentUserName = $studentDetails[0][1];
    $_SESSION["student_session_mail"] = $email;
    $studentDueDate = $studentDetails[0]["student_due_date"];
    //check if the student verification table has this students key
    $checkVerifyCodestudent = $query->checkVerificationCodebyemail($email);
    if (!$checkVerifyCodestudent) {
      //if it doesnt have the key
      //then have to do some insert querys
      //created this randome code has been hashed
      $random = rand();
      $code = hash('md5', $random);
      $dateGap = $validation->getDateDifference($studentDueDate);
      //check if the date gap of the student payment due date if it more than
      //30 days do not let the student log in send him to the payment gateway
      if ($dateGap > 30) {
        echo " You have to pay for accessing this service";
      } else {
        //if the due date is lesser than 30 days 
        //send the student his/her verification code and stuffs
        require "../../SendMail/SendMail.php";
        $emailSender = new SendMail();
        $emailSender->setSenderEmail($email);

        $emailSender->setBody("<h2 style='font-family: Impact, sans-serif;
      color: #CE5937;'>
        Student User_name and Verification Code 
        </h2>
        <span>Verification Code</span>
        <input style='width:50%;outline:none;border:none;' value='$code' readonly>
        <br>
        <br>
        <span>Username</span>
        <input style='width:50%;outline:none;border:none;' value='$studentUserName' readonly> ");
        $emailSender->setHeader("Student Verification Code Is");
        $emailStatus = $emailSender->sendEmail();
        //enter that verfication code to the student student verification table
        $query->addVerificationCode($studentID, $code);
        //update the student status to 1 if its zero or one just update it to one 
        //so the student is recognized as a verified student
        $query->updatestudentstatus($email);
      }
    } else {
    }
  }
} else {
}
