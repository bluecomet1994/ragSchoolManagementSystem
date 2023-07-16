<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    header('Location: /webAssignment/student/studentlogin/studentlogin.php');
} else {
    $email = $_SESSION["student_logged_in_session"];
    unset($_SESSION["student_logged_in_session"]);
    header('Location: /webAssignment/student/studentlogin/studentlogin.php');

}