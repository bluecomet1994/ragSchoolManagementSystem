<?php
session_start();

if (!isset($_SESSION["academic_logged_in_session"])) {
    exit();
} else {
    if (isset($_POST["e"]) && isset($_POST["g"]) && isset($_POST["duedate"]) && isset($_POST["fn"]) && isset($_POST["ln"]) && isset($_POST["a"])    && isset($_POST["gn"])) {
       //assign the values to the variables
        $valiStatus = false;
        $e = $_POST["e"];
        $fn = $_POST["fn"];
        $ln = $_POST["ln"];
        $a = $_POST["a"];
        $due = $_POST["duedate"];
        $g = $_POST["g"];
        $gn = $_POST["gn"];

      
        require_once "../../inputValidations/ValidateInputs.php";
       //validate input fields
        $validation = new ValidateInputs();

        $emailStatus = $validation->mailVali($e);
        $fnameStatus = $validation->stringVali($fn);
        $lnameStatus = $validation->stringVali($ln);
        $ageVali = $validation->studentageVali($a,5,19);
        $genderVali = $validation->genderVali($gn);
        $duedateVali = $validation->dateVali($due);
        $gradeVali = $validation->gradeVali($g);

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
        if (!$duedateVali) {

            echo "due date is not a valid date ";
            $valiStatus = false;
        }
        if (!$gradeVali) {
            echo "grade value is not a valid date ";

            $valiStatus = false;
        }
          //if every input field is valid then 
          //change the status vali to true;
        if ($fnameStatus && $lnameStatus && $emailStatus && $ageVali && $genderVali && $duedateVali && $gradeVali) {
            $valiStatus = true;
        }

        if ($valiStatus) {
            //insert query for student table
        
            require_once "../../academic/studentQuery/studentQuery.php";
            $queryObject = new StudentQuery();
            $queryObject->insertstudent($fn, $ln, $e, $a, $gn,$due, $g);
            if ($queryObject) {
                //echos abc to confirm in the client side
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