<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if (isset($_POST["e"]) && isset($_POST["fn"]) && isset($_POST["ln"]) && isset($_POST["a"])  && isset($_POST["s"])  && isset($_POST["gn"])) {
        //receive the required input values assign them to variables 
        $valiStatus = false;
        $e = $_POST["e"];
        $fn = $_POST["fn"];
        $ln = $_POST["ln"];
        $a = $_POST["a"];

        $s = $_POST["s"];
        $gn = $_POST["gn"];
        require_once "../../inputValidations/ValidateInputs.php";
        //create a new Validation object to do the input validations
        $validation = new ValidateInputs();

        $emailStatus = $validation->mailVali($e);
        $fnameStatus = $validation->stringVali($fn);
        $lnameStatus = $validation->stringVali($ln);
        $ageVali = $validation->ageVali($a);
        $genderVali = $validation->genderVali($gn);

        if ($fn == $ln) {
            echo "first name last name cannot be same";
            $valiStatus = false;
        }
        if (!$emailStatus) {
            echo "email value is not valid";
            $valiStatus = false;
        }
        if (!$fnameStatus) {
            echo "first name value is not valid ";
            $valiStatus = false;
        }
        if (!$lnameStatus) {
            echo "last name value is not valid ";
            $valiStatus = false;
        }
        if (!$ageVali) {

            echo "age value is not valid ";
            $valiStatus = false;
        }
        if (!$genderVali) {
            echo "gender value is not valid ";

            $valiStatus = false;
        }
        //if the validations are true then set the vali status to true
        if ($fnameStatus && $lnameStatus && $emailStatus && $ageVali && $genderVali) {
            $valiStatus = true;
        }

        if ($valiStatus) {
            //if the vali status is true then come to this block
            require_once "../../admin/adminPanel/AdminQuery.php";
            $queryObject = new AdminQuery();
            //insert the validated input values to the teacher table
            $queryObject->insertTeacher($fn, $ln, $e, $a, $gn, $s);
            if ($queryObject) {
                echo "abc";
            } else {
                echo "failed";
            }
        } else {
            echo " could not validate";
        }
    } else {
    }

?>

<?php

} ?>