<?php

session_start();


if (!isset($_SESSION["verifyCodeEmail"]) || !isset($_SESSION["sessionVariableOnVerifyCode"])) {
    
    header('Location: /webAssignment/student/studentLogin/login.php');
} else {
    $_SESSION["studentSession"] = $_SESSION["sessionVariableOnVerifyCode"];
    unset($_SESSION["sessionVariableOnVerifyCode"]);
    unset($_SESSION["verifyCodeEmail"]);
    
    header('Location: /webAssignment/student/studentPanel/studentPanel.php');
}
