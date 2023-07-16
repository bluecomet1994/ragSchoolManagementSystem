<?php
session_start();
if(isset($_SESSION["student_session_mail"])){
    $_SESSION["student_logged_in_session"]=$_SESSION["student_session_mail"];

    unset($_SESSION["student_session_mail"]);
    header('Location: /webAssignment/student/studentpanel/studentpanel.php');
}
?>