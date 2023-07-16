<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if (isset($_POST["e"]) && isset($_POST["fn"]) && isset($_POST["ln"]) && isset($_POST["a"]) && isset($_POST["g"]) && isset($_POST["s"])  && isset($_POST["gn"])) {
       $valiStatus =false;
        $e = $_POST["e"];
        $fn = $_POST["fn"];
        $ln = $_POST["ln"];
        $a = $_POST["a"];
        $g = $_POST["g"];
        $s = $_POST["s"];
        $gn = $_POST["gn"];
        require_once "../../inputValidations/ValidateInputs.php";

        $validation = new ValidateInputs();

        $emailStatus = $validation->mailVali($e);
        $fnameStatus = $validation->stringVali($fn);
        $lnameStatus = $validation->stringVali($ln);
        $ageVali = $validation->ageVali($a);
        $genderVali = $validation->genderVali($gn);
        $gradeVali = $validation->gradeVali($g);
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
        if(!$gradeVali){
            echo "grade value is not valid ";
            $valiStatus=false;
      
        }
        if($fnameStatus && $lnameStatus && $emailStatus && $ageVali && $genderVali && $gradeVali ){
            $valiStatus=true;
        }
  
        if($valiStatus){
            
            require_once "../../admin/adminPanel/AdminQuery.php";
            $queryObject = new AdminQuery();
            $queryObject->updateTeacher($fn,$ln,$e,$a,$gn,$g,$s);
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