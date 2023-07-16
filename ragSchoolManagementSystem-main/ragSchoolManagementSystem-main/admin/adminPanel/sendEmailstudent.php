<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if(isset($_POST["id"]) && isset($_POST["email"])){
        require_once "../../inputValidations/ValidateInputs.php";
        echo "Yess";
        $id = $_POST["id"];
        $email =$_POST["email"];
        $validation = new ValidateInputs();
        $valiStatus1 = $validation->intIDvalid($id);
        $valiStatus2 = $validation->mailVali($email);
        if($valiStatus1 && $valiStatus2){
            require_once "../../admin/adminPanel/StudentQuery.php";
            $queryObject = new StudentQuery();
            $queryObjectResults=  $queryObject->studentCheckEnM($email,$id);
            
            if($queryObjectResults==false){
                $random = rand();
                $code = hash('md5', $random);

                $random2 = rand();
                $verifyCode = hash('md5', $random2);

                $queryObject->setstudentPassword($email,$id,$code);
                $studentDetails =$queryObject->getstudentDetails($email);
                $enterVerifyCode = $queryObject->addVerificationCode($id,$verifyCode);
                $userName = $studentDetails[0][1];
                $lastName = $studentDetails[0][2];
                echo $userName;    
                require "../../SendMail/SendMail.php";
                $emailSender = new SendMail();
                $emailSender->setSenderEmail($email);
            
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
                $emailSender->setHeader("Admin Verification Code Is");
                $emailStatus =$emailSender->sendEmail();
            }else{
                echo "process stopped";
            }
        }
    }
}