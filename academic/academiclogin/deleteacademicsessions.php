<?php
session_start();
if(isset($_SESSION["academic_session_mail"])){
    $_SESSION["academic_logged_in_session"]=$_SESSION["academic_session_mail"];

    unset($_SESSION["academic_session_mail"]);
    header('Location: /webAssignment/academic/academicpanel/academicpanel.php');
}
?>