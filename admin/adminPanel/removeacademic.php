<?php
if (isset($_POST["id"]) && isset($_POST["email"])) {

    require_once "../../inputValidations/ValidateInputs.php";
    $id = $_POST["id"];
    $email = $_POST["email"];
    $validation = new ValidateInputs();
    //receive the inputs and assign it to varibles and do validations
    $valiStatus1 = $validation->intIDvalid($id);
    $valiStatus2 = $validation->mailVali($email);
    //if the validations are successful
    if ($valiStatus1 && $valiStatus2) {

        require_once "../../admin/adminPanel/AcademicQuery.php";
        $queryObject = new AcademicQuery();
        //execute the remove academic query
        $queryObject->blockacademic($id, $email);
        if ($queryObject) {
        } else {
            echo "failed";
        }
    } else {
        echo "No no";
    }
}
