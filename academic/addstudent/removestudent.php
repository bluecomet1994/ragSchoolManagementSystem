<?php
if(isset($_POST["id"]) && isset($_POST["email"])){
    //get the student specific id and email
    //check the student id and email if its exits in the student table
    //then write a delete query and delete the student row echo nothing
    //capture it in the client 
    require_once "../../inputValidations/ValidateInputs.php";
    $id = $_POST["id"];
    $email =$_POST["email"];
    $validation = new ValidateInputs();
    $valiStatus1 = $validation->intIDvalid($id);
    $valiStatus2 = $validation->mailVali($email);
    if($valiStatus1 && $valiStatus2){
    
        require_once "../../academic/studentQuery/studentQuery.php";
        $queryObject = new StudentQuery();
  
        $queryObject->blockstudent($id,$email);
        if($queryObject){
           
        }else{
            echo "failed";
        }
    }else{
        echo "No no";
    }

}

?>