<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    //input validations
    if (isset($_POST["id"]) && isset($_POST["grade"])) {
        $studentID = $_POST["id"];
        $gradeID = $_POST["grade"];

        require_once "../../inputValidations/ValidateInputs.php";
        $validation = new ValidateInputs();
        $valiStatus1 = $validation->intIDvalid($studentID);
        $valiStatus2 = $validation->intIDvalid($gradeID);
        if ($valiStatus1 && $valiStatus2) {
            require_once "../../admin/adminPanel/StudentQuery.php";
            $studentdetails = new StudentQuery();
            $changeGradeQuery = $studentdetails->updateStudentGrade($studentID, $gradeID);
            if($changeGradeQuery){
                echo "SuccessFully Changed Grade";
            }
        }
    }
}
