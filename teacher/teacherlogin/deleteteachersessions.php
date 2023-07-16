<?php
session_start();
if(isset($_SESSION["teacher_session_mail"])){
    $_SESSION["teacher_logged_in_session"]=$_SESSION["teacher_session_mail"];

    unset($_SESSION["teacher_session_mail"]);
    header('Location: /webAssignment/teacher/teacherpanel/teacherpanel.php');
}
?>