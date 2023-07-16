<?php
session_start();
if($_SESSION["sessionVariableOnVerifyCode"]){
    if(isset($_POST["code"])){
        $code = $_POST["code"];
        $email =$_SESSION["sessionVariableOnVerifyCode"];

        require_once "../../inputValidations/ValidateInputs.php";
        $validation = new ValidateInputs();
        $mailValiState = $validation->mailVali($email);
        $codeValiState = $validation->veriCodeVali($code);
        if($mailValiState==1 && $codeValiState==1){
            require_once "../../admin/adminPanel/AdminQuery.php";
                $queryFunction = new AdminQuery();
                $checkAdminStatus = $queryFunction->checkAdminVerifyCode($email,$code);
        
                if($checkAdminStatus==1){
                    echo "Success";
                }else{
                    echo "UnSuccessful";
                }
        }

    }
}



?>