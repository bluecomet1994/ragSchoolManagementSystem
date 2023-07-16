<?php
if (isset($_POST["id"]) && isset($_POST["email"])) {

    require_once "../../inputValidations/ValidateInputs.php";
    $id = $_POST["id"];
    $email = $_POST["email"];
    //receive the inputs and assign it to varibles and do validations
    $validation = new ValidateInputs();
    $valiStatus1 = $validation->intIDvalid($id);
    $valiStatus2 = $validation->mailVali($email);
    //if the validations are successful
    if ($valiStatus1 && $valiStatus2) {

        require_once "../../admin/adminPanel/StudentQuery.php";
        $queryObject = new StudentQuery();
        //execute the remove student query
        $queryObject->blockstudent($id, $email);
        if ($queryObject) {
        } else {
            echo "failed";
        }
    } else {
        echo "No no";
    }
}
