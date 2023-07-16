<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    exit();
} else {
    if (isset($_POST["e"]) && isset($_POST["fn"]) && isset($_POST["ln"]) && isset($_POST["a"])  && isset($_POST["gn"])) {
       //receive the required inputs to update the student row
       //assign them to variables
       //validate them 
        $valiStatus =false;
        $e = $_POST["e"];
        $fn = $_POST["fn"];
        $ln = $_POST["ln"];
        $a = $_POST["a"];
        $gn = $_POST["gn"];
        require_once "../../inputValidations/ValidateInputs.php";

        $validation = new ValidateInputs();

        $emailStatus = $validation->mailVali($e);
        $fnameStatus = $validation->stringVali($fn);
        $lnameStatus = $validation->stringVali($ln);
        $ageVali = $validation->studentageVali($a,5,19);
        $genderVali = $validation->genderVali($gn);
     
        if($fn==$ln){
            echo "first name last name cannot be same";
            $valiStatus=false;
        }
        if(!$emailStatus){
            echo "email value is not valid";
            $valiStatus=false;
          
        }
        if(!$fnameStatus){
           echo "first name value is not valid ";
            $valiStatus=false;
           
        }
        if(!$lnameStatus){
            echo "last name value is not valid ";
             $valiStatus=false;
            
         }
        if(!$ageVali){
           
            echo "age value is not valid ";
            $valiStatus=false;
          
        }
        if(!$genderVali){
            echo "gender value is not valid ";
          
            $valiStatus=false;
           
        }

        if($fnameStatus && $lnameStatus && $emailStatus && $ageVali && $genderVali ){
            $valiStatus=true;
        }
  
        if($valiStatus){
            //if validations are success
            require_once "../../academic/studentQuery/studentQuery.php";
            $queryObject = new StudentQuery();
            //write the update query and update the student table
            $queryObject->updatestudent($fn,$ln,$e,$a,$gn);
            if($queryObject){
                echo "Update Success";
            }else{
                echo "failed";
            }
        }else{
            echo " could not validate";
        }

     
    }else{
        
    }
   
?>

<?php

} ?>