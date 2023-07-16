<?php
if(isset($_POST["id"]) && isset($_POST["email"])){
    
    require_once "../../inputValidations/ValidateInputs.php";
    $id = $_POST["id"];
    $email =$_POST["email"];
    $validation = new ValidateInputs();
    $valiStatus1 = $validation->intIDvalid($id);
    $valiStatus2 = $validation->mailVali($email);
    if($valiStatus1 && $valiStatus2){
    
        require_once "../../admin/adminPanel/AdminQuery.php";
        $queryObject = new AdminQuery();
        $queryObject->removeTeacher($id,$email);
        if($queryObject){
           
        }else{
            echo "failed";
        }
    }else{
        echo "No no";
    }

}

?>