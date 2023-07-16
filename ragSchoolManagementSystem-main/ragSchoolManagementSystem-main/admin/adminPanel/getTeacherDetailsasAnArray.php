<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if(isset($_POST["id"]) && isset($_POST["email"])){
        $id = $_POST["id"];
        $email =$_POST["email"];
        require_once "../../admin/adminPanel/AdminQuery.php";
        $query = new AdminQuery();
        $queryTeacher = $query->getSingleTeacher($id, $email);
        $rowCount = $query->rowCount;
      
            $teacherID =  $queryTeacher[0][0];
            
            $teacherID =  $queryTeacher[0][0];
            $teacherFName = $queryTeacher[0][1];
            $teacherGrade = $queryTeacher[0][5];
            $teacherSubject = $queryTeacher[0][6];
            $teacherGender = $queryTeacher[0][8];
            $teacherLName = $queryTeacher[0][2];
            $teacherEmail = $queryTeacher[0][7];
            $teacherAge = $queryTeacher[0][4];

            $teacherArray = array($teacherID,$teacherEmail,$teacherFName,$teacherLName,$teacherSubject,$teacherGrade,$teacherGender,$teacherAge);

            echo json_encode($teacherArray);
        

    } 

}
?>