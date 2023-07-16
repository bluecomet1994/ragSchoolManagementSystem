<?php
require_once "../../inputValidations/ValidateInputs.php";
if (isset($_POST["SF"]) || isset($_POST["GF"])) {
    if (isset($_POST["SF"])) {
        $subject = $_POST["SF"];
        $validation = new ValidateInputs();
        $stringvaliStatus = $validation->stringVali($subject);
        if ($stringvaliStatus==1) {
            require_once "../../admin/adminPanel/AdminQuery.php";
            $queryObject = new AdminQuery();
            $queryObject->insertSubject($subject);
            echo "Yss";
        }else{
            echo "couldn't validate";
        }
    } else if (isset($_POST["GF"])) {
        $grade = $_POST["GF"];
        $validation = new ValidateInputs();
        $stringvaliStatus = $validation->stringVali($grade);
        if ($stringvaliStatus==1) {
            require_once "../../admin/adminPanel/AdminQuery.php";
            $queryObject = new AdminQuery();
            $queryObject->insertGrade($grade);
            echo "Yss";
        }else{
            echo "couldn't validate";
        }
    }
}
