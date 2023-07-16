<?php
session_start();
//if the session for teacher logged in session is not exists 
if (!isset($_SESSION["teacher_logged_in_session"])) {
    //go to teacher log in page
    header('Location: /webAssignment/teacher/teacherlogin/teacherlogin.php');
} else {
    //if it exits unset the session variable
    $email = $_SESSION["teacher_logged_in_session"];
    unset($_SESSION["teacher_logged_in_session"]);
    header('Location: /webAssignment/teacher/teacherlogin/teacherlogin.php');

}