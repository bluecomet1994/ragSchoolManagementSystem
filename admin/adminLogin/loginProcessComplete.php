<?php
session_start();
if($_SESSION["sessionVariableOnVerifyCode"]){
    if(isset($_POST["code"])){
        //receive the admin verify code as well as email 
        $code = $_POST["code"];
        $email =$_SESSION["sessionVariableOnVerifyCode"];

        require_once "../../inputValidations/ValidateInputs.php";
        //create a validation object to do the validations
        $validation = new ValidateInputs();
        $mailValiState = $validation->mailVali($email);
        $codeValiState = $validation->veriCodeVali($code);
        if($mailValiState==1 && $codeValiState==1){
            //if validations are success/true
            require_once "../../admin/adminPanel/AdminQuery.php";
                $queryFunction = new AdminQuery();
                //check the admin verify code table if there is a row found
                //according to the given inputs then echo success in the client side
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