<?php
require_once "../../inputValidations/ValidateInputs.php";
if (isset($_POST["SF"]) || isset($_POST["GF"])) {
    if (isset($_POST["SF"])) {
        //to add the subjects must receive the subject input
        //do validations 
        $subject = $_POST["SF"];
        $validation = new ValidateInputs();
        $stringvaliStatus = $validation->stringVali($subject);
        if ($stringvaliStatus==1) {
            //if the validations are true then insert it into the subject table
            require_once "../../admin/adminPanel/AdminQuery.php";
            $queryObject = new AdminQuery();
            $queryObject->insertSubject($subject);
            echo "Yss";
        }else{
            echo "couldn't validate";
        }
    } else if (isset($_POST["GF"])) {
         //to add the grades must receive the grade input
        //do validations 
        $grade = $_POST["GF"];
        $validation = new ValidateInputs();
        $stringvaliStatus = $validation->stringVali($grade);
        if ($stringvaliStatus==1) {
             //if the validations are true then insert it into the grade table
            require_once "../../admin/adminPanel/AdminQuery.php";
            $queryObject = new AdminQuery();
            $queryObject->insertGrade($grade);
            echo "Yss";
        }else{
            echo "couldn't validate";
        }
    }
}
