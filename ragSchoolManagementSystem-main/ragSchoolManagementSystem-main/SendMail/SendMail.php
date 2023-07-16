<?php
require "../../vendor/autoload.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class SendMail
{
    private $emailSentStatus = false;
    private $email = "stiflerwedontgiveup@gmail.com";
    private $sendersEmail;
    private $body;
    private $receipient;
    private $bodyMessage;
    private $headerText;
    public function setMessageBodyForVerificationCode($B){
        $text = 'Your Verification Code is'."".$B;
        return $text;
    }
    public function setHeader($headerText){
       $this->headerText=$headerText;
    }

    public function setSenderEmail($E)
    {
        $this->sendersEmail = $E;
    }
    public function setBody($B)
    {
        $this->body = $B;
    }
    public function sendEmail()
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = "";
            $mail->Password   = '';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->setFrom("", '');
            $mail->addAddress($this->sendersEmail);
            $mail->addReplyTo("", '');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');
            $mail->isHTML(true);
            $mail->Subject = $this->headerText;
            $mail->Body    = $this->body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
       
            $this->emailSentStatus = true;
            echo "Success";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $this->emailSentStatus = false;
        }
        return $this->emailSentStatus;
    }
}
