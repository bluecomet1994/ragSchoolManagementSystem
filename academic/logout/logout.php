<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    header('Location: /webAssignment/academic/academiclogin/academiclogin.php');
} else {
    $email = $_SESSION["academic_logged_in_session"];
    //this would remove the students current logged in session variables
    unset($_SESSION["academic_logged_in_session"]);
    header('Location: /webAssignment/academic/academiclogin/academiclogin.php');

}