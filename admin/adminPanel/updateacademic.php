<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if (isset($_POST["e"]) && isset($_POST["fn"]) && isset($_POST["ln"]) && isset($_POST["a"]) && isset($_POST["gn"])) {
       $valiStatus =false;
       //to update the academic row must receive them first then have to assinn the values to variables
       $e = $_POST["e"];
        $fn = $_POST["fn"];
        $ln = $_POST["ln"];
        $a = $_POST["a"];

        $gn = $_POST["gn"];
        require_once "../../inputValidations/ValidateInputs.php";

        $validation = new ValidateInputs();
        //have to do validations for those received values
        $emailStatus = $validation->mailVali($e);
        $fnameStatus = $validation->stringVali($fn);
        $lnameStatus = $validation->stringVali($ln);
        $ageVali = $validation->ageVali($a);
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
        //if all these validations met the requirements 
        //set the valistatus variable true else set false
        if($fnameStatus && $lnameStatus && $emailStatus && $ageVali  && $genderVali ){
            $valiStatus=true;
        }
  
        if($valiStatus){
            
            require_once "../../admin/adminPanel/AcademicQuery.php";
            $queryObject = new AcademicQuery();
            //run the update academic query 
            $queryObject->updateacademic($fn,$ln,$e,$a,$gn);
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