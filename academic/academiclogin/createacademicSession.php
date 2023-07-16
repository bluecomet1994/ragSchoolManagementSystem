<?php

session_start();

//session checking if its there assign assign sessionvariableonvarifycode to admin sesssion 
//unset the sessionvariableonvarifycode
if (!isset($_SESSION["verifyCodeEmail"]) || !isset($_SESSION["sessionVariableOnVerifyCode"])) {
    
    header('Location: /webAssignment/admin/adminLogin/login.php');
} else {
    $_SESSION["AdminSession"] = $_SESSION["sessionVariableOnVerifyCode"];
    unset($_SESSION["sessionVariableOnVerifyCode"]);
    unset($_SESSION["verifyCodeEmail"]);
    
    header('Location: /webAssignment/admin/adminPanel/AdminPanel.php');
}
