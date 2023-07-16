<?php

session_start();


if (!isset($_SESSION["verifyCodeEmail"]) || !isset($_SESSION["sessionVariableOnVerifyCode"])) {
    
    header('Location: /webAssignment/admin/adminLogin/login.php');
} else {
    //sessionvariableonverifycode variable would be created during the sign in process
    //however it would be deleted and assigned to a session variable called
    //adminsession it would the main session that hangs around with the admin activities
    
    $_SESSION["AdminSession"] = $_SESSION["sessionVariableOnVerifyCode"];
    unset($_SESSION["sessionVariableOnVerifyCode"]);
    unset($_SESSION["verifyCodeEmail"]);
    
    header('Location: /webAssignment/admin/adminPanel/AdminPanel.php');
}
